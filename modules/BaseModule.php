<?php


namespace Plgn024\Core\modules;

use Plgn024\Core\includes\Options;


abstract class BaseModule {


	protected static $instances = [];


	private static $initiated = [];


	protected $options;


	protected $module_name;


	public static function instance() {
				$relative_path = ltrim( str_replace( __NAMESPACE__, '', static::class ), '\\' );

		list( $module_name ) = explode( '\\', $relative_path );

		if ( ! isset( self::$instances[ $module_name ] ) ) {
			self::$instances[ $module_name ] = new static( $module_name );
		}
		return self::$instances[ $module_name ];
	}


	protected function __construct( $module_name ) {

		$this->module_name = $module_name;
	}


	public function init() {
		if ( ! empty( self::$initiated[ $this->module_name ] ) ) {
			return;
		}

		$this->define_necessary_hooks();

		if ( $this->options()->get( 'active' ) ) {
			$this->define_on_active_hooks();
		}

		self::$initiated[ $this->module_name ] = true;
	}


	protected function set_options() {
		$data = PLGNMAIN024()->options()->get( $this->module_name );

		$this->options = new Options();

		$this->options->set_data( (array) $data );
	}


	public function options() {
		if ( ! $this->options ) {
			$this->set_options();
		}
		return $this->options;
	}


	protected function define_necessary_hooks() {}


	protected function define_on_active_hooks() {}
}
