<?php


namespace Plgn024\Core\admin;

use Plgn024\Core\includes\restApi\SettingsController;
use Plgn024\Core\includes\BaseClass;



class Admin extends BaseClass {


	public function register_rest_routes() {
		$controller = new SettingsController();
		$controller->register_routes();
	}


	public function add_plugin_admin_menu() {
		add_menu_page(
			esc_html( $this->plugin->title() ),
			esc_html( $this->plugin->title() ),
			'manage_options',
			$this->plugin->name(),
			[ $this, 'display_plugin_admin_page' ],
			'none',
			80
		);
	}


	public function display_plugin_admin_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		?>
			<div id="plgn024-settings"></div>
		<?php
	}


	public function plugin_action_links( $links ) {
		$settings_link = sprintf(
			'<a href="%s">%s</a>',
			menu_page_url( $this->plugin->name(), false ),
			esc_html__( 'Settings', 'plgn024' )
		);

		array_unshift( $links, $settings_link );

		return $links;
	}


	public function fire_plugin_version_upgrade( $upgrader, $args ) {
		if ( 'update' === $args['action'] && 'plugin' === $args['type'] && ! empty( $args['plugins'] ) ) {
			foreach ( $args['plugins'] as $basename ) {
				if ( PLGN024_BASENAME === $basename ) {
					wp_remote_get(
						site_url(),
						[
							'timeout'   => 0.01,
							'blocking'  => false,
							'sslverify' => false,
						]
					);
					break;
				}
			}
		}
	}


	public function initiate_logger() {

		$active_logs = PLGNMAIN024()->options()->get_path( 'advanced.enable_logs', [] );

		//Logger::instance()->set_active_logs( $active_logs )->hookup();
	}
}
