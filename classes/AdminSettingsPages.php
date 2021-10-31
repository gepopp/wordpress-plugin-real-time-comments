<?php

namespace RealTimeComments;

class AdminSettingsPages {

	public function __construct() {

		add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
		add_action( 'admin_init', [ $this, 'add_settings_section' ] );

	}


	public function add_settings_page() {

		add_menu_page(
			__('Real Time Comments', 'real-time-comments'),
			__('Comments Settings', 'real-time-comments'),
			'administrator',
			'rtc_settings_page',
			[ $this, 'settings_page_content' ],
			'dashicons-admin-comments'
		);

	}

	public function add_settings_section(){}
	public function settings_page_content(){}

}