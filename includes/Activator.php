<?php


namespace Plgn024\Core\includes;


class Activator {


	public static function activate( $network_wide = false ) {
		do_action( 'plgn024_activated', $network_wide );
	}
}
