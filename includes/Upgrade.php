<?php


namespace Plgn024\Core\includes;

use Plgn024\Core\modules\p2tg\restApi\RulesController;


class Upgrade extends BaseClass {


	public function do_upgrade() {

		/* $current_version = get_option( 'plgn024_ver', '1.9.4' ); */

		/* if ( ! version_compare( $current_version, $this->plugin()->version(), '<' ) ) { */
		/* 	return; */
		/* } */

		/* if ( ! defined( 'PLGN024_DOING_UPGRADE' ) ) { */
		/* 	define( 'PLGN024_DOING_UPGRADE', true ); */
		/* } */

		/* do_action( 'plgn024_before_do_upgrade', $current_version ); */

		/* $is_new_install = ! get_option( 'plgn024_telegram' ) && ! get_option( 'plgn024' ); */

		/* $version_upgrades = []; */
		/* if ( ! $is_new_install ) { */
		/* 				$version_upgrades = [ */
		/* 		'2.0.0', 				'2.1.9', */
		/* 		'2.2.0', */
		/* 		'3.0.0', */
		/* 		'3.0.8', */
		/* 		'4.0.0', */
		/* 	]; */
		/* } */

		/* if ( ! in_array( $this->plugin()->version(), $version_upgrades, true ) ) { */
		/* 	$version_upgrades[] = $this->plugin()->version(); */
		/* } */

		/* foreach ( $version_upgrades as $target_version ) { */

		/* 	if ( version_compare( $current_version, $target_version, '<' ) ) { */

		/* 		$this->upgrade_to( $target_version, $is_new_install ); */

		/* 		$current_version = $target_version; */
		/* 	} */
		/* } */

		/* do_action( 'plgn024_after_do_upgrade', $current_version ); */
	}


	private function upgrade_to( $version, $is_new_install ) {

		/* $_version = str_replace( '.', '_', $version ); */

		/* $method = [ $this, "upgrade_to_{$_version}" ]; */

		/* if ( ! $is_new_install && is_callable( $method ) ) { */

		/* 	call_user_func( $method ); */
		/* } */

		/* update_option( 'plgn024_ver', $version ); */
	}


	protected function upgrade_to_2_0_0() {

		/* $telegram_opts = get_option( 'plgn024_telegram', [] ); */

		/* $plgn024['bot_token'] = $telegram_opts['bot_token']; */

		/* if ( ! empty( $telegram_opts['chat_ids'] ) ) { */

		/* 	$plgn024['modules'][0]['p2tg'] = 'on'; */

		/* 	$plgn024_p2tg['channels'] = $telegram_opts['chat_ids']; */
		/* } */

		/* $wordpress_opts = get_option( 'plgn024_wordpress', [] ); */


		/* if ( ! empty( $wordpress_opts['send_when'] ) ) { */

		/* 	if ( in_array( 'send_new', $wordpress_opts['send_when'], true ) ) { */
		/* 		$plgn024_p2tg['send_when'][] = 'new'; */
		/* 	} */
		/* 	if ( in_array( 'send_updated', $wordpress_opts['send_when'], true ) ) { */
		/* 		$plgn024_p2tg['send_when'][] = 'existing'; */
		/* 	} */
		/* } */

		/* if ( ! empty( $wordpress_opts['which_post_type'] ) ) { */

		/* 	$plgn024_p2tg['post_types'] = (array) $wordpress_opts['which_post_type']; */
		/* } */

		/* $author_rule = []; */

		/* if ( ! empty( $wordpress_opts['from_authors'][0] ) && 'all' !== $wordpress_opts['from_authors'][0] && ! empty( $wordpress_opts['authors'] ) ) { */

		/* 	$param    = 'post_author'; */
		/* 	$operator = ( 'selected' === $wordpress_opts['from_authors'][0] ) ? 'in' : 'not_in'; */
		/* 	$values   = $wordpress_opts['authors']; */

		/* 	$author_rule = compact( 'param', 'operator', 'values' ); */
		/* } */

		/* $taxonomy_rules = []; */

		/* if ( ! empty( $wordpress_opts['from_terms'][0] ) && 'all' !== $wordpress_opts['from_terms'][0] && ! empty( $wordpress_opts['terms'] ) ) { */

		/* 	$tax_terms = []; */

		/* 	foreach ( $wordpress_opts['terms'] as $term_tax ) { */

		/* 		list( $term_id, $taxonomy ) = explode( '@', $term_tax ); */
		/* 		if ( 'category' === $taxonomy ) { */
		/* 			$tax_terms[ $taxonomy ][] = $term_id; */
		/* 		} else { */
		/* 			$tax_terms[ 'tax:' . $taxonomy ][] = $term_id; */
		/* 		} */
		/* 	} */

		/* 	$operator = ( 'selected' === $wordpress_opts['from_terms'][0] ) ? 'in' : 'not_in'; */

		/* 	foreach ( $tax_terms as $taxonomy => $terms ) { */

		/* 		$param  = $taxonomy; */
		/* 		$values = $terms; */

		/* 		$taxonomy_rules[] = compact( 'param', 'operator', 'values' ); */
		/* 	} */
		/* } */

		/* $rule_groups = []; */

		/* foreach ( $taxonomy_rules as $tax_rule ) { */
		/* 	$rule_group = []; */

		/* 	$rule_group[] = $tax_rule; */

		/* 	if ( ! empty( $author_rule ) ) { */
		/* 		$rule_group[] = $author_rule; */
		/* 	} */

		/* 	$rule_groups[] = $rule_group; */
		/* } */

		/* if ( empty( $rule_groups ) && ! empty( $author_rule ) ) { */

		/* 	$rule_group = []; */

		/* 	$rule_group[] = $author_rule; */

		/* 	$rule_groups[] = $rule_group; */
		/* } */

		/* if ( ! empty( $rule_groups ) ) { */

		/* 	$plgn024_p2tg['rules'] = $rule_groups; */
		/* } */


		/* $message_opts = get_option( 'plgn024_message', [] ); */
		/* $keys         = [ */
		/* 	'message_template', */
		/* 	'excerpt_source', */
		/* 	'excerpt_length', */
		/* 	'parse_mode', */
		/* 	'inline_url_button', */
		/* 	'inline_button_text', */
		/* 	'send_featured_image', */
		/* 	'image_position', */
		/* 	'misc', */
		/* ]; */

		/* foreach ( $keys as $key ) { */

		/* 	if ( ! empty( $message_opts[ $key ] ) ) { */

		/* 		$plgn024_p2tg[ $key ] = ( 'off' === $message_opts[ $key ] ) ? 0 : $message_opts[ $key ]; */
		/* 	} */
		/* } */

		/* if ( ! empty( $plgn024_p2tg['message_template'] ) ) { */

		/* 	$template = json_decode( $plgn024_p2tg['message_template'] ); */

		/* 	$macros = [ */
		/* 		'title', */
		/* 		'author', */
		/* 		'excerpt', */
		/* 		'content', */
		/* 	]; */

		/* 	foreach ( $macros as $macro ) { */

		/* 		$template = str_replace( '{' . $macro . '}', '{post_' . $macro . '}', $template ); */
		/* 	} */

		/* 	if ( preg_match_all( '/(?>=\{\[)[a-z0-9_]+?(?=\]\})/iu', $template, $matches ) ) { */

		/* 		foreach ( $matches[0] as $taxonomy ) { */

		/* 			$template = str_replace( '{[' . $taxonomy . ']}', '{terms:' . $taxonomy . '}', $template ); */
		/* 		} */
		/* 	} */

		/* 	if ( preg_match_all( '/(?>=\{\[\[).+?(?=\]\]\})/u', $template, $matches ) ) { */

		/* 		foreach ( $matches[0] as $custom_field ) { */

		/* 			$template = str_replace( '{[[' . $custom_field . ']]}', '{cf:' . $custom_field . '}', $template ); */
		/* 		} */
		/* 	} */

		/* 	$plgn024_p2tg['message_template'] = Utils::sanitize_message_template( $template, false, true ); */
		/* } */

		/* $plgn024_p2tg['single_message'] = 0; */
		/* if ( ( ! empty( $message_opts['attach_image'] ) && 'on' === $message_opts['attach_image'] ) || ( ! empty( $message_opts['image_style'] ) && 'with_caption' === $message_opts['image_style'] ) ) { */

		/* 	$plgn024_p2tg['single_message'] = 'on'; */
		/* } */

		/* $notify_opts = get_option( 'plgn024_notify', [] ); */
		/* if ( ! empty( $notify_opts['chat_ids'] ) && ! empty( $notify_opts['watch_emails'] ) ) { */

		/* 	$plgn024['modules'][0]['notify'] = 'on'; */

		/* 	$plgn024_notify['chat_ids']           = $notify_opts['chat_ids']; */
		/* 	$plgn024_notify['watch_emails']       = $notify_opts['watch_emails']; */
		/* 	$plgn024_notify['user_notifications'] = empty( $notify_opts['user_notifications'] ) ? 0 : $notify_opts['user_notifications']; */

		/* 	$template = '🔔‌<b>{email_subject}</b>🔔' . PHP_EOL . PHP_EOL . '{email_message}'; */
		/* 	if ( ! empty( $notify_opts['hashtag'] ) ) { */
		/* 		$template .= PHP_EOL . PHP_EOL . $notify_opts['hashtag']; */
		/* 	} */

		/* 	$plgn024_notify['message_template'] = Utils::sanitize_message_template( $template, false, true ); */

		/* 	$plgn024_notify['parse_mode'] = 'HTML'; */
		/* } */

		/* if ( apply_filters( 'plgn024_bot_api_use_proxy', false ) ) { */
		/* 	$plgn024['modules'][0]['proxy'] = 'on'; */
		/* } */

		/* $proxy_opts = get_option( 'plgn024_proxy', [] ); */

		/* if ( ! empty( $proxy_opts ) ) { */

		/* 	$plgn024_proxy = $proxy_opts; */

		/* 	if ( ! empty( $proxy_opts['script_url'] ) ) { */
		/* 		$plgn024_proxy['proxy_method'] = 'google_script'; */
		/* 	} else { */
		/* 		$plgn024_proxy['proxy_method'] = 'php_proxy'; */
		/* 	} */
		/* } */

		/* $sections = [ */
		/* 	'telegram', */
		/* 	'wordpress', */
		/* 	'message', */
		/* 	'notify', */
		/* 	'proxy', */
		/* ]; */
		/* foreach ( $sections as $section ) { */
		/* 	delete_option( 'plgn024_' . $section ); */
		/* } */

		/* $options = compact( 'plgn024', 'plgn024_p2tg', 'plgn024_notify', 'plgn024_proxy' ); */
		/* foreach ( $options as $option => $value ) { */
		/* 	update_option( $option, $value ); */
		/* } */
	}


	protected function upgrade_to_2_1_9() {

		/* $types = [ 'p2tg', 'bot-api' ]; */

		/* foreach ( $types as $type ) { */
		/* 	$filename = WP_CONTENT_DIR . "/plgn024-{$type}.log"; */
		/* 	$filename = apply_filters( "plgn024_logger_{$type}_log_filename", $filename ); */
		/* 	if ( file_exists( $filename ) ) { */
		/* 		wp_delete_file( $filename ); */
		/* 	} */
		/* } */
	}


	protected function upgrade_to_2_2_0() {
		/* $old_meta_key = 'telegram_chat_id'; */

		/* $args  = [ */
		/* 	'fields'       => 'ID', */
		/* 	'meta_key'     => $old_meta_key, 			'meta_compare' => 'EXISTS', */
		/* 	'number'       => -1, */
		/* ]; */
		/* $users = get_users( $args ); */

		/* foreach ( $users as $id ) { */
		/* 	$meta_value = get_user_meta( $id, $old_meta_key, true ); */
		/* 	update_user_meta( $id, PLGN024_USER_ID_META_KEY, $meta_value ); */
		/* 	delete_user_meta( $id, $old_meta_key ); */
		/* } */
	}


	protected function upgrade_to_3_0_0() {
		/* $main_options = get_option( 'plgn024', [] ); */

		/* $modules = reset( $main_options['modules'] ); */
		/* unset( $modules['fake'] ); */

		/* $active_modules = array_keys( $modules ); */

		/* $p2tg_options     = get_option( 'plgn024_p2tg', [] ); */
		/* $notify_options   = get_option( 'plgn024_notify', [] ); */
		/* $proxy_options    = get_option( 'plgn024_proxy', [] ); */
		/* $advanced_options = []; */

		/* $upgraded_options = []; */

		/* foreach ( [ 'bot_token', 'bot_username' ] as $field ) { */
		/* 	if ( ! empty( $main_options[ $field ] ) ) { */
		/* 		$upgraded_options[ $field ] = $main_options[ $field ]; */
		/* 	} */
		/* } */


		/* $p2tg_options['active'] = in_array( 'p2tg', $active_modules, true ); */
		/* if ( ! empty( $p2tg_options['channels'] ) ) { */
		/* 	$p2tg_options['channels'] = array_map( 'trim', explode( ',', $p2tg_options['channels'] ) ); */
		/* } else { */
		/* 	$p2tg_options['channels'] = []; */
		/* } */
		/* if ( ! empty( $p2tg_options['message_template'] ) ) { */
		/* 	$p2tg_options['message_template'] = stripslashes( json_decode( $p2tg_options['message_template'] ) ); */
		/* } else { */
		/* 	$p2tg_options['message_template'] = ''; */
		/* } */
		/* $p2tg_bool_fields = [ */
		/* 	'excerpt_preserve_eol', */
		/* 	'send_featured_image', */
		/* 	'single_message', */
		/* 	'cats_as_tags', */
		/* 	'inline_url_button', */
		/* 	'post_edit_switch', */
		/* 	'plugin_posts', */
		/* 	'protect_content', */
		/* ]; */
		/* foreach ( $p2tg_bool_fields as $field ) { */
		/* 	$p2tg_options[ $field ] = ! empty( $p2tg_options[ $field ] ); */
		/* } */
		/* if ( ! empty( $p2tg_options['inline_button_text'] ) ) { */
		/* 	$p2tg_options['inline_button_text'] = '🔗 ' . $p2tg_options['inline_button_text']; */
		/* } */
		/* $p2tg_options['inline_button_url'] = '{full_url}'; */

		/* $is_wp_cron_disabled = defined( 'DISABLE_WP_CRON' ) && constant( 'DISABLE_WP_CRON' ); */

		/* $p2tg_numeric_fields = [ */
		/* 	'excerpt_length' => 55, */
		/* 	'delay'          => $is_wp_cron_disabled ? 0 : 0.5, */
		/* ]; */
		/* foreach ( $p2tg_numeric_fields as $field => $default ) { */
		/* 	$p2tg_options[ $field ] = ! empty( $p2tg_options[ $field ] ) ? (float) $p2tg_options[ $field ] : $default; */
		/* } */

		/* $misc = ! empty( $p2tg_options['misc'] ) ? $p2tg_options['misc'] : []; */

		/* $p2tg_options['disable_web_page_preview'] = in_array( 'disable_web_page_preview', $misc, true ); */
		/* $p2tg_options['disable_notification']     = in_array( 'disable_notification', $misc, true ); */
		/* unset( $p2tg_options['misc'] ); */


		/* add_action( */
		/* 	'init', */
		/* 	f unction () { */
		/* 		$p2tg = PLGNMAIN024()->options()->get( 'p2tg' ); */
		/* 		if ( ! empty( $p2tg['rules'] ) ) { */
		/* 			$rules = $p2tg['rules']; */

		/* 			$upgraded_rules = []; */

		/* 			foreach ( $rules as $rule_group ) { */
		/* 				$upgraded_rule_group = []; */

		/* 				foreach ( $rule_group as $rule ) { */
		/* 					$upgraded_rule = []; */

		/* 					if ( ! empty( $rule['values'] ) ) { */
		/* 						$param  = $rule['param']; */
		/* 						$values = $rule['values']; */

		/* 						$new_values = RulesController::get_rule_values( $param, '', $values ); */
		/* 						if ( ! empty( $new_values ) ) { */
		/* 							if ( 'post' === $param ) { */
		/* 								$new_values = wp_list_pluck( $new_values, 'options' ); */
		/* 								if ( ! empty( $new_values ) ) { */
		/* 									$new_values = call_user_func_array( 'array_merge', $new_values ); */
		/* 								} */
		/* 							} */
		/* 							$rule['values'] = $new_values; */

		/* 							$upgraded_rule = $rule; */
		/* 						} */
		/* 					} */

		/* 					if ( ! empty( $upgraded_rule ) ) { */
		/* 						$upgraded_rule_group[] = $upgraded_rule; */
		/* 					} */
		/* 				} */

		/* 				if ( ! empty( $upgraded_rule_group ) ) { */
		/* 					$upgraded_rules[] = $upgraded_rule_group; */
		/* 				} */
		/* 			} */

		/* 			$p2tg['rules'] = $upgraded_rules; */

		/* 			PLGNMAIN024()->options()->set( 'p2tg', $p2tg ); */
		/* 		} */
		/* 	}, */
		/* 	50 */
		/* ); */




		/* $notify_options['active'] = in_array( 'notify', $active_modules, true ); */
		/* if ( ! empty( $notify_options['chat_ids'] ) ) { */
		/* 	$notify_options['chat_ids'] = array_map( 'trim', explode( ',', $notify_options['chat_ids'] ) ); */
		/* } else { */
		/* 	$notify_options['chat_ids'] = []; */
		/* } */
		/* if ( ! empty( $notify_options['message_template'] ) ) { */
		/* 	$notify_options['message_template'] = stripslashes( json_decode( $notify_options['message_template'] ) ); */
		/* } else { */
		/* 	$notify_options['message_template'] = ''; */
		/* } */
		/* $notify_options['user_notifications'] = ! empty( $notify_options['user_notifications'] ); */



		/* $proxy_options['active'] = in_array( 'proxy', $active_modules, true ); */
		/* if ( ! empty( $proxy_options['script_url'] ) ) { */
		/* 	$proxy_options['google_script_url'] = $proxy_options['script_url']; */
		/* 	unset( $proxy_options['script_url'] ); */
		/* } */



		/* $advanced_options['send_files_by_url'] = ! empty( $main_options['send_files_by_url'] ); */
		/* $advanced_options['clean_uninstall']   = ! empty( $main_options['clean_uninstall'] ); */
		/* $advanced_options['enable_logs']       = []; */


		/* $upgraded_options['p2tg']     = $p2tg_options; */
		/* $upgraded_options['notify']   = $notify_options; */
		/* $upgraded_options['proxy']    = $proxy_options; */
		/* $upgraded_options['advanced'] = $advanced_options; */

		/* update_option( 'plgn024', wp_json_encode( $upgraded_options ) ); */

		/* foreach ( [ 'p2tg', 'notify', 'proxy' ] as $module ) { */
		/* 	delete_option( 'plgn024_' . $module ); */
		/* } */
	}


	protected function upgrade_to_3_0_8() {
		/* $advanced = PLGNMAIN024()->options()->get( 'advanced' ); */

		/* if ( empty( $advanced['enable_logs'] ) ) { */
		/* 	$advanced['enable_logs'] = []; */

		/* 	PLGNMAIN024()->options()->set( 'advanced', $advanced ); */
		/* } */
	}


	protected function upgrade_to_4_0_0() {
	/* 	$sections = [ 'p2tg', 'notify' ]; */

	/* 	$markdown_v1_to_html_map = [ */
	/* 		'*'   => 'b', */
	/* 		'_'   => 'i', */
	/* 		'```' => 'pre', */
	/* 		'`'   => 'code', */
	/* 	]; */

	/* 	foreach ( $sections as $section ) { */
	/* 		$options = PLGNMAIN024()->options()->get( $section ); */

	/* 		if ( isset( $options['parse_mode'] ) && 'Markdown' === $options['parse_mode'] ) { */

	/* 			$template = $options['message_template']; */

	/* 			$template = htmlspecialchars( $template, ENT_NOQUOTES, 'UTF-8' ); */

	/* 			$macro_map = []; */

	/* 			if ( preg_match_all( '/\{[^\}]+?\}/iu', $template, $matches ) ) { */

	/* 				$total = count( $matches[0] ); */
	/* 														for ( $i = 0; $i < $total; $i++ ) { */
	/* 					$macro_map[ "{:MACRO{$i}:}" ] = $matches[0][ $i ]; */
	/* 				} */
	/* 			} */

	/* 			$template = str_replace( array_values( $macro_map ), array_keys( $macro_map ), $template ); */

	/* 			$template = preg_replace( '/\[([^\]]+?)\]\(([^\)]+?)\)/ui', '<a href="${2}">${1}</a>', $template ); */

	/* 			foreach ( $markdown_v1_to_html_map as $char => $tag ) { */
	/* 				if ( false === strpos( $template, $char ) ) { */
	/* 					continue; */
	/* 				} */
	/* 				$placeholder = '{:' . $tag . ':}'; */
	/* 				$template = str_replace( '\\' . $char, $placeholder, $template ); */

	/* 				$regex_char = preg_quote( $char, '/' ); */

	/* 									$pattern = sprintf( '/%1$s([^%1$s]+?)%1$s/ius', $regex_char ); */
	/* 				$replace = sprintf( '<%1$s>${1}</%1$s>', $tag ); */

	/* 				$template = preg_replace( $pattern, $replace, $template ); */
	/* 				$template = str_replace( $placeholder, $char, $template ); */
	/* 			} */

	/* 			$template = str_replace( array_keys( $macro_map ), array_values( $macro_map ), $template ); */

	/* 			$template = stripslashes( $template ); */

	/* 			$options['message_template'] = $template; */
	/* 			$options['parse_mode'] = 'HTML'; */

	/* 			PLGNMAIN024()->options()->set( $section, $options ); */
	/* 		} */
	/* 	} */
	/* } */
}
}
