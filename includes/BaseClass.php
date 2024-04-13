<?php


namespace Plgn024\Core\includes;


abstract class BaseClass {


	protected static $instances = [];


	protected $plugin;


	public static function instance() {
		if ( ! isset( self::$instances[ static::class ] ) ) {
			self::$instances[ static::class ] = new static();
		}
		return self::$instances[ static::class ];
	}


	protected function __construct() {

		$this->plugin = Main::instance();
	}


	protected function plugin() {
		return $this->plugin;
	}
}
