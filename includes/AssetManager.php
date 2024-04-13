<?php


namespace Plgn024\Core\includes;

use Plgn024\Core\includes\restApi\RESTController;
use Plgn024\Core\includes\restApi\SettingsController;
/* use ReflectionClass; */
/* use DOMDocument; */
/* use DOMXPath; */


class AssetManager extends BaseClass {

        const ADMIN_MAIN_JS_HANDLE         = 'plgn024--main';
	
        private $assethandles = array( self::ADMIN_MAIN_JS_HANDLE => 'index' );


	/* const ADMIN_P2TG_GB_JS_HANDLE      = 'plgn024--p2tg-gb'; */
	/* const ADMIN_P2TG_CLASSIC_JS_HANDLE = 'plgn024--p2tg-classic'; */


	public function register_assets() {

		/* $request_check = new ReflectionClass( self::class ); */

		/* $constants = $request_check->getConstants(); */

		$assets = $this->plugin()->assets();

		foreach ( $this->assethandles as $handle => $name) {
			wp_register_script(
				$handle,
				$assets->get_asset_url( $name ),
				$assets->get_asset_dependencies( $name ),
				$assets->get_asset_version( $name ),
				true
			);

			if ( $assets->has_asset( $name, Assets::ASSET_EXT_CSS ) ) {
				wp_register_style(
					$handle,
					$assets->get_asset_url( $name, Assets::ASSET_EXT_CSS ),
					[],
					$assets->get_asset_version( $name, Assets::ASSET_EXT_CSS ),
					'all'
				);
			}
		}

		/* style is handled in 'react' subsystem 
		wp_register_style(
			$this->plugin()->name() . '-menu',
			$assets->url( sprintf( '/css/admin-menu%s.css', wp_scripts_get_suffix() ) ), // wp_scripts_get_suffix() gives '.min' if not debugging 
			[],
			$this->plugin()->version(),
			'all'
		);
		*/
	}


	public static function add_dom_data( $handle, $data, $var = "plgn024" ) {
		wp_add_inline_script(
			$handle,
			sprintf( 'var %s = %s;', $var, wp_json_encode( $data ) ),
			'before'
		);
	}


	public function enqueue_admin_styles( $hook_suffix ) {

		//wp_enqueue_style( $this->plugin()->name() . '-menu' ); 		/* style is handled in 'react' subsystem */

		$handle = self::ADMIN_MAIN_JS_HANDLE;

		if ( $this->is_settings_page( $hook_suffix ) && wp_style_is( $handle, 'registered' ) ) {
			wp_enqueue_style( $handle );
		}
	}


	public function enqueue_admin_scripts( $hook_suffix ) {
		if ( $this->is_settings_page( $hook_suffix ) ) {
			$handle = self::ADMIN_MAIN_JS_HANDLE;

			wp_enqueue_script( $handle );

			$data = $this->get_dom_data();

			self::add_dom_data( $handle, $data );
		}
	}


	public function get_dom_data( $for = 'SETTINGS_PAGE' ) {
		$data = [
			'pluginInfo' => [
				'title'       => $this->plugin()->title(),
				'name'        => $this->plugin()->name(),
				'version'     => $this->plugin()->version(),
				'description' => __( 'With this plugin, you can ...', 'plgn024' ),
			],
			'api'        => [
				'admin_url'      => admin_url(),
				'nonce'          => wp_create_nonce( "plgn024" ),
				'use'            => 'SERVER',
 				'rest_namespace' => RESTController::REST_NAMESPACE,
				'wp_rest_url'    => esc_url_raw( rest_url() ),
			],
			'uiData'     => [
				'debug_info' => $this->get_debug_info(),
			],
			//'i18n'       => Utils::get_jed_locale_data( "plgn024" ),
		];

		/* if ( 'SETTINGS_PAGE' === $for ) { */
		/* 	$data['assets'] = [ */
		/* 		'logoUrl'        => $this->plugin()->assets()->url( '/icons/icon-128x128.png' ), */
		/* 		'tgIconUrl'      => $this->plugin()->assets()->url( '/icons/tg-icon.svg' ), */
		/* 		'editProfileUrl' => get_edit_profile_url( get_current_user_id() ), */
		/* 		'p2tgLogUrl'     => Logger::get_log_url( 'p2tg' ), */
		/* 		'botApiLogUrl'   => Logger::get_log_url( 'bot-api' ), */
		/* 	]; */
		/* } */

		if ( 'SETTINGS_PAGE' === $for && current_user_can( 'manage_options' ) ) {
			$data['savedSettings'] = SettingsController::get_default_settings();
		}

		return apply_filters( 'plgn024_assets_dom_data', $data, $for, $this->plugin() );
	}


	public function get_debug_info() {

		$info  = 'PHP:         ' . PHP_VERSION . PHP_EOL;
		$info .= 'WP:          ' . get_bloginfo( 'version' ) . PHP_EOL;
		$info .= 'Plugin:      ' . $this->plugin()->name() . ':v' . $this->plugin()->version() . PHP_EOL;
		/* $info .= 'DOMDocument: ' . ( class_exists( DOMDocument::class ) ? '✓' : '✕' ) . PHP_EOL; */
		/* $info .= 'DOMXPath:    ' . ( class_exists( DOMXPath::class ) ? '✓' : '✕' ) . PHP_EOL; */

		return $info;
	}


	public function is_settings_page( $hook_suffix ) {
		return 'toplevel_page_' . $this->plugin()->name() === $hook_suffix;
	}
}
