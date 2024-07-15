<?php

namespace Plgn024\Core\modules\FrontEndReactModule;

use Plgn024\Core\modules\BaseModule;

class Main extends BaseModule {


	protected function define_necessary_hooks() {

		$this->define_hooks();
		
	}
	
	protected function define_on_active_hooks() {

	}

	private function define_hooks() {

		$asset_manager = includes\AssetManager::instance();

		add_action( 'init', [ $asset_manager, 'register_assets' ] );

		add_action( 'wp_enqueue_scripts', [ $asset_manager, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $asset_manager, 'enqueue_scripts' ] );

		$front_end = includes\FrontEnd::instance();
		add_shortcode( 'plgn024-front', array( $front_end, 'shortcode_func' ) );

	}
}
