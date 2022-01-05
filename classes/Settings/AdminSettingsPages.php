<?php

namespace RealTimeComments\Settings;

use RealTimeComments\Settings\Sections\MainSettings;
use RealTimeComments\Settings\Sections\PusherSettings;
use RealTimeComments\Settings\Sections\LayoutSettings;



class AdminSettingsPages {





	use SettingsFieldsOutput;



	public function __construct() {

		if ( false == get_option( 'rtc_general_settings' ) ) {
			add_option( 'rtc_general_settings' );
		}

		new MainSettings();
		new PusherSettings();
		new LayoutSettings();

		add_action( 'admin_menu', [ $this, 'add_settings_page' ] );


	}





	public function add_settings_page() {

		add_menu_page(
			__( 'Real Time Comments', 'real-time-comments' ),
			__( 'Comments Settings', 'real-time-comments' ),
			'administrator',
			'rtc_settings_page',
			[ $this, 'settings_page_content' ],
			'dashicons-admin-comments'
		);

	}





	public function settings_page_content() {

		?>
        <!-- wp class no namespace -->
        <div class="wrap">
            <h2><?php _e( 'Real time comments settings', 'real-time-comments' ) ?></h2>
            <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
			<?php settings_errors(); ?>
            <!-- Create the form that will be used to render our options -->
            <div>
                <div class="rtc-bg-white rtc-grid rtc-grid-cols-6 rtc-gap-5">
                    <div class="rtc-pt-10 rtc-px-5">
                        <img src="<?php echo RTC_URL ?>dist/images/logo-full.svg" class="rtc-border-none rtc-w-full rtc-h-auto"/>
                        <div class="rtc-flex rtc-flex-col rtc-w-full rtc-mt-10">
                            <div class="rtc-tab-button rtc-px-5 rtc-py-3 rtc-cursor-pointer hover:rtc-bg-plugin hover:rtc-bg-opacity-5"
                                 id="main">
								<?php _e( 'Main settings', 'real-time-comments' ) ?>
                            </div>
                            <div class="rtc-tab-button rtc-px-5 rtc-py-3 rtc-cursor-pointer hover:rtc-bg-plugin hover:rtc-bg-opacity-5"
                                 id="pusher">
								<?php _e( 'Pusher API settings', 'real-time-comments' ) ?>
                            </div>
                            <div class="rtc-tab-button rtc-px-5 rtc-py-3 rtc-cursor-pointer hover:rtc-bg-plugin hover:rtc-bg-opacity-5"
                                 id="layout">
								<?php _e( 'Layout settings', 'real-time-comments' ) ?>
                            </div>
                        </div>


                    </div>
                    <div class="rtc-col-span-5">
                        <form method="post" action="options.php">
                            <div>
                                <div class="rtc-p-5 rtc-bg-gray-200">
                                    <div class="rtc-tab" data-tab="main">
										<?php settings_fields( 'rtc_main_settings_section' ); ?>
										<?php do_settings_sections( 'rtc_main_settings_page' ); ?>
                                    </div>
                                    <div class="rtc-tab" data-tab="pusher">
										<?php settings_fields( 'rtc_pusher_settings_section' ); ?>
										<?php do_settings_sections( 'rtc_pusher_settings_page' ); ?>
                                    </div>
                                    <div class="rtc-tab" data-tab="layout">
										<?php settings_fields( 'rtc_layout_settings_section' ); ?>
										<?php do_settings_sections( 'rtc_layout_settings_page' ); ?>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="submit" id="submit"
                                   class="rtc-block rtc-w-full rtc-text-center rtc-bg-plugin rtc-py-3 rtc-text-center rtc-text-white rtc-my-10 rtc-shadow-lg hover:rtc-shadow cursor-pointer"
                                   value="<?php echo __( 'save', 'real-time-comments' ) ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}


}