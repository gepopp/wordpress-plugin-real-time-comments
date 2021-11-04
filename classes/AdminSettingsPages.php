<?php

namespace RealTimeComments;

use phpseclib3\File\ASN1\Maps\AccessDescription;

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

	public function add_settings_section(){

		// If the theme options don't exist, create them.
		if ( false == get_option( 'rtc_general_settings' ) ) {
			add_option( 'rtc_general_settings' );
		} // end if

		add_settings_section(
			'rtc_comments_settings_section',
			__('Settings for comments output', 'real-time-comments'),
			[ $this, 'settings_section_comment_content' ],
			'rtc_settings_page'
		);


		add_settings_section(
			'rtc_general_settings_section',
			__('Connection Settings to pusher', 'real-time-comments'),
			[ $this, 'settings_section_content' ],
			'rtc_settings_page'
		);

		add_settings_field(
			'comments_paged',
			__('Comments displayed', 'real-time-comments'),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_settings_page',
			'rtc_comments_settings_section',
			[
				'type' => 'text',
				'name' => 'comments_page',
			]
		);

		add_settings_field(
			'pusher_auth_key',
			__('Puser auth key', 'real-time-comments'),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_settings_page',
			'rtc_general_settings_section',
			[
				'type' => 'text',
				'name' => 'pusher_auth_key',
			]
		);

		add_settings_field(
			'pusher_secret',
			__('Puser secret', 'real-time-comments'),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_settings_page',
			'rtc_general_settings_section',
			[
				'type' => 'text',
				'name' => 'pusher_secret',
			]
		);

		add_settings_field(
			'pusher_app_id',
			__('Puser app id', 'real-time-comments'),
			[
				$this,
				'rtc_settings_input_field',
			],
			'rtc_settings_page',
			'rtc_general_settings_section',
			[
				'type' => 'text',
				'name' => 'pusher_app_id',
			]
		);


		register_setting(
			'rtc_general_settings',
			'rtc_general_settings'
		);
	}

    public function settings_section_comment_content(){
       echo __('How comments should be displayed.', 'real-time-comments');
    }


	public function settings_page_content(){
		?>
		<div class="wrap">
			<h2><?php _e('Real time comments settings', 'real-time-comments') ?></h2>
			<!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
			<?php settings_errors(); ?>
			<!-- Create the form that will be used to render our options -->
			<form method="post" action="options.php">
				<?php settings_fields( 'rtc_general_settings' ); ?>
				<?php do_settings_sections( 'rtc_settings_page' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public function settings_section_content(){

		$link = sprintf( wp_kses( __( 'Real time comments uses Pusher as a websocket service to show new comments in real time. Setup your pusher account <a href="%s">here</a>', 'real-time-comments'), array(  'a' => array( 'href' => array() ) ) ), esc_url( 'https://pusher.com/' ) );
		echo $link;
	}

	public function rtc_settings_input_field( $args ) {
		// First, we read the options collection
		$options = get_option( 'rtc_general_settings' );
		?>
		<input type="<?php echo $args['type'] ?>"
		       id="<?php echo $args['name'] ?>"
		       name="rtc_general_settings[<?php echo $args['name'] ?>]"
		       value="<?php echo $options[ $args['name'] ] ?? '' ?>"
		       class="regular-text"
			<?php echo isset( $args['placeholder'] ) ? 'placeholder="' . $args['placeholder'] . '" ' : '' ?>
		/>
		<?php
		if ( isset( $args['label'] ) ) {
			echo $args['label'];
		}
	}

}