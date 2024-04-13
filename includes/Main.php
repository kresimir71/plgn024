<?php


namespace Plgn024\Core\includes;

use Plgn024\Core\admin\Admin;


final class Main {


	protected static $instance = null;


	private static $initiated = false;


	protected $title;


	protected $plugin_name;


	protected $version;


	protected $options;


	protected $assets;


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}


	public function __clone() {}


	public function __wakeup() {}


	private function __construct() {

		$this->version     = PLGN024_VER;
		$this->plugin_name = 'plgn024';

		//$this->load_dependencies();

		$this->set_locale();
	}


	public function init() {
		if ( self::$initiated ) {
			return;
		}

		$plugin_upgrade = Upgrade::instance();

		add_action( 'plugins_loaded', [ $plugin_upgrade, 'do_upgrade' ], 10 );

		$modules = Modules::instance();
		add_action( 'plugins_loaded', [ $this, 'hookup' ], 20 );
		add_action( 'plugins_loaded', [ $modules, 'load' ], 20 );

		self::$initiated = true;
	}


	public function hookup() {
		if ( defined( 'PLGN024_DOING_UPGRADE' ) && PLGN024_DOING_UPGRADE ) {
			return;
		}
		$this->define_admin_hooks();
	}


	private function load_dependencies() {


		require_once $this->dir( '/includes/helper-functions.php' );


		require_once $this->dir( '/includes/bot-api/autoload-wp.php' );


		require_once $this->dir( '/includes/format-text/autoload-wp.php' );
	}


	private function set_locale() {

		$plugin_i18n = new I18n();

		add_action( 'plugins_loaded', [ $plugin_i18n, 'load_plugin_textdomain' ] );
	}


	private function set_options() {

		$this->options = new Options( $this->plugin_name, true );
	}


	public function options() {
		if ( ! $this->options ) {
			$this->set_options();
		}
		return $this->options;
	}


	private function set_assets() {
		$this->assets = new Assets( $this->dir( '/assets' ), $this->url( '/assets' ) );
	}


	public function assets() {
		if ( ! $this->assets ) {
			$this->set_assets();
		}

		return $this->assets;
	}


	private function define_admin_hooks() {

		$plugin_admin = Admin::instance();

		add_action( 'admin_menu', [ $plugin_admin, 'add_plugin_admin_menu' ], 8 );

		add_action( 'rest_api_init', [ $plugin_admin, 'register_rest_routes' ] );

		//add_filter( "rest_request_before_callbacks", [ Utils::class, 'filter_rest_errors' ], 10, 3 );

		add_filter( 'plugin_action_links_' . PLGN024_BASENAME, [ $plugin_admin, 'plugin_action_links' ] );

		add_filter( 'upgrader_process_complete', [ $plugin_admin, 'fire_plugin_version_upgrade' ], 10, 2 );

		add_action( 'after_setup_theme', [ $plugin_admin, 'initiate_logger' ] );

		$asset_manager = AssetManager::instance();

		add_action( 'admin_init', [ $asset_manager, 'register_assets' ] );

		add_action( 'admin_enqueue_scripts', [ $asset_manager, 'enqueue_admin_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $asset_manager, 'enqueue_admin_scripts' ] );

		//new Integrations();
	}


	public function title() {
				if ( ! $this->title ) {
			$this->title = __( 'Plgn Template 024', 'plgn024' );
		}
		return $this->title;
	}


	public function name() {
		return $this->plugin_name;
	}


	public function version() {
		return $this->version;
	}


	public function dir( $path = '' ) {
		return PLGN024_DIR . $path;
	}


	public function url( $path = '' ) {
		return PLGN024_URL . $path;
	}
}
