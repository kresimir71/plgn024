<?php


spl_autoload_register( 'plgn024_autoloader' );


function plgn024_autoloader( $class_name ) {

	$namespace = 'Plgn024\Core';

	if ( 0 !== strpos( $class_name, $namespace ) ) {
		return;
	}

	$class_name = str_replace( $namespace, '', $class_name );
	$class_name = str_replace( '\\', DIRECTORY_SEPARATOR, $class_name );

	$path = PLGN024_DIR . $class_name . '.php';

	include_once $path;
}
