<?php

namespace RealTimeComments\Settings;

trait GeneralSettings {





	public static $load_via = 'comments_load_via';





	public static $page = 'comments_page';





	public static $paged = 'comments_paged';





	public static $pusher_key = 'pusher_auth_key';





	public static $pusher_secret = 'pusher_secret';





	public static $pusher_cluster = 'pusher_cluster';





	public static $pusher_app_id = 'pusher_app_id';





	public static $layout_color = 'layout_main_color';





	public static $avatar_rounding = 'layout_avatar_rounding';





	public static $form_layout = 'layout_comments_and_form';





	public static function rtc_general_options() {

		$default = [
			'comments_load_via'        => 'ajax',
			'comments_paged'           => true,
			'comments_page'            => 10,
			'pusher_auth_key'          => '',
			'pusher_secret'            => '',
			'pusher_cluster'           => '',
			'pusher_app_id'            => '',
			'layout_main_color'        => '#000000',
			'layout_avatar_rounding'   => 0,
			'layout_comments_and_form' => 'main',
		];

		$default = apply_filters( 'rtc-default-options', $default );

		$saved = get_option( 'rtc_general_settings' );


		$saved['comments_page']  = get_option( 'comments_per_page' );

		$paged = get_option('page_comments');
		$saved['comments_paged'] = empty($paged) ? 0 : 1;

		return array_merge( $default, (array) $saved );


	}


	public static function rtc_general_single_option( $setting ) {

		$settings = self::rtc_general_options();

		return $settings[ $setting ];
	}

}