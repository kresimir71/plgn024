<?php


namespace Plgn024\Core\includes;


class I18n {


	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plgn024',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
