<?php

namespace Plgn024\Core\modules\FrontEndReactModule\includes;
use Plgn024\Core\includes\Assets;

class AssetManager extends FrontEndBaseClass {

        const MAIN_JS_HANDLE         = 'plgn024--front';
	
        private $assethandles = array( self::MAIN_JS_HANDLE => 'front' );

	/* For example: */
	/* const ADMIN_P2TG_GB_JS_HANDLE      = 'plgn024--p2tg-gb'; */
	/* const ADMIN_P2TG_CLASSIC_JS_HANDLE = 'plgn024--p2tg-classic'; */

	
	public function register_assets() {

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
	}


	public function enqueue_styles( ) {

		$handle = self::MAIN_JS_HANDLE;
		wp_enqueue_style( $handle );

		//$handle = other handle
		//wp_enqueue_style( $handle );

	}


	public function enqueue_scripts( ) {
	
		$handle = self::MAIN_JS_HANDLE;
		wp_enqueue_script( $handle );

	}

}
