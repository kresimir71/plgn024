<?php


namespace Plgn024\Core\includes\restApi;

use WP_REST_Request;
use WP_REST_Server;


class SettingsController extends RESTController {


	const PATTERN = '[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]';


	const REST_BASE = '/settings';


	protected $settings;


	public function __construct() {
		$this->settings = PLGNMAIN024()->options();
	}


	public function register_routes() {

		register_rest_route(
			self::REST_NAMESPACE,
			self::REST_BASE,
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_settings' ],
					'permission_callback' => [ $this, 'settings_permissions' ],
					'args'                => self::get_settings_params( 'view' ),
				],
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'update_settings' ],
					'permission_callback' => [ $this, 'settings_permissions' ],
					'args'                => self::get_settings_params( 'edit' ),
				],
			]
		);
	}


	public function settings_permissions() {
		return current_user_can( 'manage_options' );
	}


	public static function get_default_values() {
		$is_wp_cron_disabled = defined( 'DISABLE_WP_CRON' ) && constant( 'DISABLE_WP_CRON' );

		return [
			'token'    => '',
			'username' => '',
			'example1module'         => [
				'active'                   => false,
				'channels'                 => [],
				'send_when'                => [ 'new' ],
			],
			'example2module'       => [
				'active'             => false,
				'watch_emails'       => get_option( 'admin_email' ),
				'chat_ids'           => [],

			],
			'advanced'     => [
				'send_files_by_url' => true,
				'enable_logs'       => [],
				'clean_uninstall'   => true,
			],
		];
	}


	public static function get_default_settings() {

		$settings = PLGNMAIN024()->options()->get_data();

		if ( empty( $settings ) ) {
			$settings = self::get_default_values();
		}

		return $settings;
	}


	public function get_settings() {
		return rest_ensure_response( self::get_default_settings() );
	}


	public function update_settings( WP_REST_Request $request ) {
		$params = array_keys( self::get_default_values() );

		$settings = PLGNMAIN024()->options()->get_data();

		foreach ( $params as $key ) {
			$settings[ $key ] = $request->get_param( $key );
		}

		PLGNMAIN024()->options()->set_data( $settings )->update_data();

		return rest_ensure_response( $settings );
	}


	public static function get_settings_params( $context = 'edit' ) {

		return [
			'token'    => [
				'type'              => 'string',
				'required'          => ( 'edit' === $context ),
				'pattern'           => self::PATTERN,
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => 'rest_validate_request_arg',
			],
			'username' => [
				'type'              => 'string',
				'pattern'           => self::PATTERN,
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => 'rest_validate_request_arg',
			],
			'example1module'         => [
				'type'              => 'object',
				'sanitize_callback' => [ __CLASS__, 'sanitize_param' ],
				'validate_callback' => 'rest_validate_request_arg',
				'properties'        => [
					'active'                   => [
						'type' => 'boolean',
					],
					'channels'                 => [
						'type'  => 'array',
						'items' => [
							'type' => 'string',
						],
					],
					'send_when'                => [
						'type'  => 'array',
						'items' => [
							'type' => 'string',
							'enum' => [ 'new', 'existing' ],
						],
					],
				],
			],
			'example2module'       => [
				'type'              => 'object',
				'sanitize_callback' => [ __CLASS__, 'sanitize_param' ],
				'validate_callback' => 'rest_validate_request_arg',
				'properties'        => [
					'active'             => [
						'type' => 'boolean',
					],
					'watch_emails'       => [
						'type' => 'string',
					],
					'chat_ids'           => [
						'type'  => 'array',
						'items' => [
							'type' => 'string',
						],
					],
				],
			],
			'advanced'     => [
				'type'              => 'object',
				'sanitize_callback' => [ __CLASS__, 'sanitize_param' ],
				'validate_callback' => 'rest_validate_request_arg',
				'properties'        => [
					'send_files_by_url' => [
						'type' => 'boolean',
					],
					'enable_logs'       => [
						'type'  => 'array',
						'items' => [
							'type' => 'string',
							'enum' => [ 'api', 'example1module' ],
						],
					],
					'clean_uninstall'   => [
						'type' => 'boolean',
					],
				],
			],
		];
	}


	public static function sanitize_param( $value, WP_REST_Request $request, $param ) {
		$safe_value = $value;

		if ( in_array( $param, [ 'example1module', 'example2module' ], true ) ) {
			//$safe_value['message_template'] = Utils::sanitize_message_template( $value['message_template'] );
		}

		if ( 'example1module' === $param && ! empty( $safe_value['channels'] ) ) {
			$safe_value['channels'] = array_values( array_filter( $safe_value['channels'] ) );
		}
		if ( 'example2module' === $param && ! empty( $safe_value['chat_ids'] ) ) {
			$safe_value['chat_ids'] = array_values( array_filter( $safe_value['chat_ids'] ) );
		}

		return $safe_value;
	}
}
