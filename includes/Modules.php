<?php


namespace Plgn024\Core\includes;


class Modules extends BaseClass {


	public static function get_all_modules() {
		return [ 'example1module', 'example2module' ];
	}


	public function load() {
		if ( defined( 'PLGN024_DOING_UPGRADE' ) && PLGN024_DOING_UPGRADE ) {
			return;
		}

		$namespace = 'Plgn024\Core\modules';

		foreach ( self::get_all_modules() as $module ) {

			$main = "{$namespace}\\{$module}\Main";

			$main::instance()->init();

			define( 'PLGN024_' . strtoupper( $module ) . '_LOADED', true );
		}
	}
}
