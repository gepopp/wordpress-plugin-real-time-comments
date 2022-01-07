<?php

namespace RealTimeComments\Settings\Sections;

use RealTimeComments\Settings\GeneralSettings;
use RealTimeComments\Settings\SettingsFieldsOutput;



class LayoutSettings {





	use SettingsFieldsOutput, GeneralSettings;



	public function __construct() {

		add_action( 'admin_init', [ $this, 'add_layout_settings_section' ] );
	}





	public function add_layout_settings_section() {


		add_settings_section(
			'rtc_layout_settings_section',
			'',
			[ $this, 'layout_section_content' ],
			'rtc_layout_settings_page'
		);

		add_settings_field(
			'layout_main_color',
			__( 'Main color of Form and Comments', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_color_picker',
			],
			'rtc_layout_settings_page',
			'rtc_layout_settings_section',
			[
				'type' => 'text',
				'name' => 'rtc_general_settings[layout_main_color]',
				'value'=> $this->rtc_general_single_option(GeneralSettings::$layout_color)
			]
		);

		add_settings_field(
			'layout_avatar_rounding',
			__( 'Avatar image rounding', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_radio_field',
			],
			'rtc_layout_settings_page',
			'rtc_layout_settings_section',
			[
				'type'    => 'radio',
				'name'    => 'rtc_general_settings[layout_avatar_rounding]',
				'value'   => $this->rtc_general_single_option(GeneralSettings::$avatar_rounding),
				'options' => [
					[
						'value' => 0,
						'label' => __( 'No rounding', 'real-time-comments' ),
					],
					[
						'value' => '15',
						'label' => __( 'Rounded edges', 'real-time-comments' ),
					],
					[
						'value' => '100',
						'label' => __( 'Full rounding - circle', 'real-time-comments' ),
					],
				],
			]
		);

		add_settings_field(
			'layout_comments_and_form',
			__( 'Comments Form and List Layout', 'real-time-comments' ),
			[
				$this,
				'rtc_settings_radio_field',
			],
			'rtc_layout_settings_page',
			'rtc_layout_settings_section',
			[
				'type'    => 'radio',
				'name'    => 'rtc_general_settings[layout_comments_and_form]',
				'value'   => $this->rtc_general_single_option(GeneralSettings::$form_layout),
				'options' => [
					[
						'value' => 'main',
						'label' => __( 'Default Flat Layout', 'real-time-comments' ),
					],
					[
						'value' => 'classic',
						'label' => __( 'Classic Form and List Layout. Main Color setting applies to form.', 'real-time-comments' ),
					],
				],
			]
		);


		register_setting(
			'rtc_layout_settings_section',
			'rtc_general_settings'
		);
	}





	public function layout_section_content() {

		$link = sprintf( __( 'Real time comments uses Pusher as a websocket service to show new comments in real time. Setup your pusher account <a href="%s">here</a>', 'real-time-comments' ), esc_url( 'https://pusher.com/' ) );
		echo wp_kses( $link, [ 'a' => [ 'href' => [] ] ] );
	}
}