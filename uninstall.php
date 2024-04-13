<?php


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) || ! WP_UNINSTALL_PLUGIN || dirname( WP_UNINSTALL_PLUGIN ) !== dirname( plugin_basename( __FILE__ ) ) ) {

	status_header( 404 );
	exit;
}


$options = get_option( "plgn024", '' );

$options = json_decode( $options, true );


function uninstall_plgn024() {
	if ( isset( $options['advanced']['clean_uninstall'] ) && false === $options['advanced']['clean_uninstall'] ) {
		return;
	}

	$uninstall_options = [
		"plgn024",
		'plgn024_ver',
	];

	$uninstall_options = (array) apply_filters( 'plgn024_uninstall_options', $uninstall_options );

	foreach ( $uninstall_options as $option ) {
		delete_option( $option );
	}
}

uninstall_plgn024();
