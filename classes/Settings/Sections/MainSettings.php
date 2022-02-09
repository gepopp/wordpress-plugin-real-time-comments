<?php

namespace RealTimeComments\Settings\Sections;

use RealTimeComments\Settings\GeneralSettings;
use RealTimeComments\Settings\SettingsFieldsOutput;



class MainSettings {





	use SettingsFieldsOutput, GeneralSettings;



	public function __construct() {

		add_action( 'admin_init', [ $this, 'add_main_settings_section' ] );
	}





	public function add_main_settings_section() {

		add_settings_section(
			'rtc_main_settings_section',
			'',
			[ $this, 'main_settings_section_content' ],
			'rtc_main_settings_page'
		);


		add_settings_field(
			'comments_load_via',
			__( 'Load new comments via: ', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_radio_field',
			],
			'rtc_main_settings_page',
			'rtc_main_settings_section',
			[
				'type'    => 'radio',
				'name'    => 'rtc_general_settings[comments_load_via]',
				'options' => [
					[
						'value' => 'ajax',
						'label' => __( 'Load new comments via ajax calls', 'real-time-comments' ),
					],
					[
						'value' => 'pusher',
						'label' => __( 'Load new comments via pusher api', 'real-time-comments' ),
					],
				],
				'value' => self::rtc_general_single_option(GeneralSettings::$load_via)
			]
		);


		register_setting(
			'rtc_main_settings_section',
			'rtc_general_settings'
		);
	}





	public function main_settings_section_content() {

		_e( 'How comments should be displayed.', 'real-time-comments' );
	}

}