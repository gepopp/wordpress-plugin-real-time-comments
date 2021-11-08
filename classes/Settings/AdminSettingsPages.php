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
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <div class="wrap">
            <h2><?php _e( 'Real time comments settings', 'real-time-comments' ) ?></h2>
            <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
			<?php settings_errors(); ?>
            <!-- Create the form that will be used to render our options -->

            <div class="bg-white grid grid-cols-5 gap-5">
                <div class="col-span-4">
                    <form method="post" action="options.php">
                        <div x-data="{ tab : 'main' }">
                            <div class="flex border-b border-gray-800 w-full mt-10">
                                <div @click="tab = 'main'"
                                     :class="tab == 'main' ? 'border-b-2 border-blue-800' : ''"
                                     class="px-5 py-3 cursor-pointer">
                                    <?php _e('Main settings', 'real-time-comments') ?>
                                </div>
                                <div @click="tab = 'pusher'"
                                     :class="tab === 'pusher' ? 'border-b-2 border-blue-800' : ''"
                                     class="px-5 py-3 cursor-pointer">
                                    <?php _e('Pusher API settings', 'real-time-comments') ?>
                                </div>
                                <div @click="tab = 'layout'"
                                     :class="tab === 'layout' ? 'border-b-2 border-blue-800' : ''"
                                     class="px-5 py-3 cursor-pointer">
		                            <?php _e('Layout settings', 'real-time-comments') ?>
                                </div>
                            </div>
                            <div class="p-5 bg-gray-200">
                                <div x-show.transition="tab == 'main'">
									<?php settings_fields( 'rtc_main_settings_section' ); ?>
									<?php do_settings_sections( 'rtc_main_settings_page' ); ?>
                                </div>
                                <div x-show.transition="tab == 'pusher'">
									<?php settings_fields( 'rtc_pusher_settings_section' ); ?>
									<?php do_settings_sections( 'rtc_pusher_settings_page' ); ?>
                                </div>
                                <div x-show.transition="tab == 'layout'">
		                            <?php settings_fields( 'rtc_layout_settings_section' ); ?>
		                            <?php do_settings_sections( 'rtc_layout_settings_page' ); ?>
                                </div>
                            </div>

                        </div>

                </div>
                <div class="pt-10 px-5">
                    <img src="<?php echo RTC_URL  ?>dist/images/logo-full.svg" class="border-none w-full h-auto"/>
					<?php submit_button(); ?>
                    </form>
                </div>
            </div>


        </div>
		<?php
	}


}