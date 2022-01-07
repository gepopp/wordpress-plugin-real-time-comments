<?php

namespace RealTimeComments\Settings;

trait GeneralSettings {





	public static $load_via = 'comments_load_via';





	public static $paged = 'comments_page';





	public static $pusher_key = 'pusher_auth_key';





	public static $pusher_secret = 'pusher_secret';





	public static $pusher_cluster = 'pusher_cluster';





	public static $pusher_app_id = 'pusher_app_id';





	public static $layout_color = 'layout_main_color';





	public static $avatar_rounding = 'layout_avatar_rounding';





	public static $form_layout = 'layout_comments_and_form';





	public function rtc_general_options() {

		$default = [
			'comments_load_via'        => 'ajax',
			'comments_page'            => 10,
			'pusher_auth_key'          => '',
			'pusher_secret'            => '',
			'pusher_cluster'           => '',
			'pusher_app_id'            => '',
			'layout_main_color'        => '#000000',
			'layout_avatar_rounding'   => 0,
			'layout_comments_and_form' => 'main',
		];

		$saved = get_option( 'rtc_general_settings' );

		return array_merge( $default, (array) $saved );

	}





	public function rtc_general_single_option( $setting ) {

		$settings = $this->rtc_general_options();

		return $settings[ $setting ];
	}

}