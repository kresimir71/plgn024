<?php


namespace Plgn024\Core\modules;


abstract class BaseClass {


	protected static $instances = [];


	protected $module;


	public static function instance() {
				$relative_path = ltrim( str_replace( __NAMESPACE__, '', static::class ), '\\' );

		list( $module_name ) = explode( '\\', $relative_path );

		$main = __NAMESPACE__ . "\\{$module_name}\Main";

		if ( ! isset( self::$instances[ static::class ] ) ) {
			self::$instances[ static::class ] = new static( $main::instance() );
		}
		return self::$instances[ static::class ];
	}


	protected function __construct( $module ) {

		$this->module = $module;
	}


	protected function module() {
		return $this->module;
	}
}
