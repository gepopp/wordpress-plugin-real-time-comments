<?php

namespace RealTimeComments\Settings\Sections;

use RealTimeComments\Settings\GeneralSettings;
use RealTimeComments\Settings\SettingsFieldsOutput;



class PusherSettings {




	use SettingsFieldsOutput, GeneralSettings;



	public function __construct() {

		add_action( 'admin_init', [ $this, 'add_settings_section' ] );
	}





	public function add_settings_section() {


		add_settings_section(
			'rtc_pusher_settings_section',
			__( 'Connection Settings to pusher', 'real-time-comments' ),
			[ $this, 'settings_section_content' ],
			'rtc_pusher_settings_page'
		);


		add_settings_field(
			'pusher_auth_key',
			__( 'Puser auth key', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_pusher_settings_page',
			'rtc_pusher_settings_section',
			[
				'type'  => 'text',
				'name'  => 'rtc_general_settings[pusher_auth_key]',
				'value' => self::rtc_general_single_option( GeneralSettings::$pusher_key ),
			]
		);

		add_settings_field(
			'pusher_secret',
			__( 'Puser secret', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_pusher_settings_page',
			'rtc_pusher_settings_section',
			[
				'type'  => 'text',
				'name'  => 'rtc_general_settings[pusher_secret]',
				'value' => self::rtc_general_single_option( GeneralSettings::$pusher_secret ),
			]
		);

		add_settings_field(
			'pusher_app_id',
			__( 'Puser app id', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_pusher_settings_page',
			'rtc_pusher_settings_section',
			[
				'type'  => 'text',
				'name'  => 'rtc_general_settings[pusher_app_id]',
				'value' => self::rtc_general_single_option( GeneralSettings::$pusher_app_id ),
			]
		);

		add_settings_field(
			'pusher_cluster',
			__( 'Puser Cluster', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_pusher_settings_page',
			'rtc_pusher_settings_section',
			[
				'type'  => 'text',
				'name'  => 'rtc_general_settings[pusher_cluster]',
				'value' => self::rtc_general_single_option( GeneralSettings::$pusher_cluster ),
			]
		);


		register_setting(
			'rtc_pusher_settings_section',
			'rtc_general_settings'
		);
	}





	public function settings_section_content() {

		$link = sprintf( __( 'Real time comments uses Pusher as a websocket service to show new comments in real time. Setup your pusher account <a href="%s">here</a>', 'real-time-comments' ), esc_url( 'https://pusher.com/' ) );
		echo wp_kses( $link, [ 'a' => [ 'href' => [] ] ] );
	}
}