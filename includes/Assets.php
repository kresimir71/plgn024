<?php


namespace Plgn024\Core\includes;


class Assets {

	const ASSET_EXT_CSS = '.css';

	const ASSET_EXT_JS = '.js';

	const ASSET_EXT_PHP = '.asset.php';

	const KEY_DEPENDENCIES = 'dependencies';

	const KEY_VERSION = 'version';
	
	private $assets_path;

	private $assets_url;

	public function __construct( $assets_path, $assets_url ) {
		$this->assets_path = untrailingslashit( $assets_path );
		$this->assets_url  = untrailingslashit( $assets_url );
	}

	public function path( $path = '' ) {
		return $this->assets_path . DIRECTORY_SEPARATOR . $path;
	}

	public function url( $path = '' ) {
		return $this->assets_url . '/' . $path;
	}

	public function get_asset_path( $entry_point, $type = self::ASSET_EXT_JS ) {
		return $this->path( $entry_point . $type );
	}

	public function get_asset_url( $entry_point, $type = self::ASSET_EXT_JS ) {
		return $this->url( $entry_point . $type );
	}

	public function get_asset_version( $entry_point, $type = self::ASSET_EXT_JS ) {
	        $script_asset_path = $this->get_asset_path( $entry_point, self::ASSET_EXT_PHP );
		if ( ! is_readable( $script_asset_path ) ) {
			throw new \Exception( 'Asset file not found or is not readable: ' . wp_kses( $script_asset_path) );
		}
		$script_asset = require( $script_asset_path );
		return self::ASSET_EXT_JS === $type && isset( $script_asset[ self::KEY_VERSION ] )
			? $script_asset[ self::KEY_VERSION ]
			: filemtime( $this->get_asset_path( $entry_point, $type ) );
	}

	public function has_asset( $entry_point, $type = self::ASSET_EXT_JS ) {
	        return is_readable( $this->get_asset_path( $entry_point, $type ) );
	}

	public function get_asset_dependencies( $entry_point ) {
	        $script_asset_path = $this->get_asset_path( $entry_point, self::ASSET_EXT_PHP );
		if ( ! is_readable( $script_asset_path ) ) {
			throw new \Exception( 'Asset file not found or is not readable: ' . wp_kses( $script_asset_path) );
		}
		$script_asset = require( $script_asset_path );
		if ( ! isset( $script_asset[ self::KEY_DEPENDENCIES ] ) ) {
			return [];
		}
		$dependencies = $script_asset[ self::KEY_DEPENDENCIES ];

		return $dependencies;
	}

}
