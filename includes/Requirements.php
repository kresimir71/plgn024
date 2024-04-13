<?php


namespace Plgn024\Core\includes;


class Requirements {


	public static function satisfied() {
		$env_details = self::get_env_details();

		return $env_details['satisfied'];
	}


	public static function get_env_details() {
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugin_data = get_plugin_data( PLGN024_MAIN_FILE );

		$data = [
			'PHP' => [
				'version' => PHP_VERSION,
				'min'     => $plugin_data['RequiresPHP'],
			],
			'WP'  => [
				'version' => get_bloginfo( 'version' ),
				'min'     => $plugin_data['RequiresWP'],
			],
		];

		$satisfied = true;

		foreach ( $data as &$details ) {
			$details['satisfied'] = version_compare( $details['version'], $details['min'], '>=' );

			if ( $satisfied && ! $details['satisfied'] ) {
				$satisfied = false;
			}
		}

		$extensions = [];

		foreach ( [ 'dom', 'mbstring' ] as $extension ) {
			$loaded = extension_loaded( $extension );

			$extensions[ $extension ] = $loaded;

			if ( $satisfied && ! $loaded ) {
				$satisfied = false;
			}
		}

		$data['PHP']['extensions'] = $extensions;

		return compact( 'data', 'satisfied' );
	}


	public static function get_missing_extensions() {
		$env_details = self::get_env_details();

		$missing = [];

		foreach ( $env_details['data']['PHP']['extensions'] as $extension => $loaded ) {
			if ( ! $loaded ) {
				$missing[] = $extension;
			}
		}

		return $missing;
	}


	public static function display_requirements() {
		$env_details = self::get_env_details();
		?>
		<tr class="plugin-update-tr">
			<td colspan="5" class="plugin-update colspanchange">
				<div class="update-message notice inline notice-error notice-alt" style="padding-block-end: 1rem;">
					<p>
						<?php esc_html_e( 'This plugin is not compatible with your website configuration.', 'plgn024' ); ?>
					</p>
					<span><?php esc_html_e( 'Missing requirements', 'plgn024' ); ?>&nbsp;👇</span>
					<ul style="list-style-type: disc; margin-inline-start: 2rem;">
						<?php
						foreach ( $env_details['data'] as $name => $requirement ) :
							if ( ! $requirement['satisfied'] ) :
								?>
								<li>
									<?php
									echo esc_html( $name );
									echo '&nbsp;&dash;&nbsp;';
									echo esc_html(
										sprintf(
										/* translators: %s: Version number */
											__( 'Current version: %s', 'plgn024' ),
											$requirement['version']
										)
									);
									echo '&nbsp;&comma;&nbsp;';
									echo esc_html(
										sprintf(
										/* translators: %s: Version number */
											__( 'Minimum required version: %s', 'plgn024' ),
											$requirement['min']
										)
									);
									?>
								</li>
								<?php
							endif;
						endforeach;
						$missing_extensions = self::get_missing_extensions();

						if ( ! empty( $missing_extensions ) ) :
							?>
							<li>
								<?php
								echo esc_html(
									sprintf(
									/* translators: %s: comma separated list of missing extensions */
										__( 'Missing PHP extensions: %s', 'plgn024' ),
										implode( ', ', $missing_extensions )
									)
								);
								?>
							</li>
							<?php
						endif;
						?>
					</ul>
					<span>
						<?php esc_html_e( 'Please contact your hosting provider to ensure the above requirements are met.', 'plgn024' ); ?>
					</span>
				</div>
			</td>
		</tr>
		<?php
	}
}
