<?php
/**
 * @var $app_key
 * @var $load_via
 * @var $paged
 */

use RealTimeComments\Settings\GeneralSettings;



$wp_comments = get_comments( [
	'post_id' => get_the_ID(),
	'parent'  => 0,
	'status'  => 1,
	'count'   => true,
] );


?>
<div id="real-time-comments-container" class="rtc-w-full rtc-container rtc-mx-auto rtc-p-5">
	<?php do_action( 'comment_form_before' ); ?>
    <div class="rtc-flex rtc-flex-col">
        <h1 class="rtc-comment-form-heading rtc-main-color"><?php _e( 'Write a comment', 'real-time-comments' ) ?></h1>
		<?php do_action( 'comment_form_top' ); ?>
        <div>
			<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ): ?>

                <div class="rtc-bg-white rtc-flex rtc-justify-center rtc-py-16">
                    <p><?php _e( 'You must be logged in to comment.', 'real-time-comments' ) ?></p>
                </div>

			<?php else: ?>

                <comments-form :post_id="<?php echo get_the_ID() ?>" :user_id="<?php echo (int) get_current_user_id() ?>">
                    <template v-slot:user>
						<?php if ( is_user_logged_in() ): ?>
                            <user-commenting :user-id="<?php echo get_current_user_id() ?>"></user-commenting>
						<?php else: ?>
                            <no-user-comment-form></no-user-comment-form>
						<?php endif; ?>
                    </template>
					<?php do_action( 'comment_form_after_fields' ); ?>
                </comments-form>

			<?php endif; ?>
        </div>
        <hr class="rtc-py-3 rtc-my-3">
        <div class="rtc-w-full rtc-overflow-y-scroll rtc-overflow-x-hidden rtc-scrollbar rtc-scrollbar-thumb-gray-900 rtc-scrollbar-track-gray-100">
            <comments
                    :post_id="<?php echo get_the_ID() ?>"
                    :count="<?php echo esc_attr( $wp_comments ) ?>"
                    :user_id="<?php echo (int) get_current_user_id() ?>"
                    :is_paged="<?php echo esc_attr( GeneralSettings::rtc_general_single_option( GeneralSettings::$paged ) );  ?>"
                    :paged="<?php echo esc_attr( GeneralSettings::rtc_general_single_option( GeneralSettings::$page ) ) ?>"
                    app_key="<?php echo esc_attr( GeneralSettings::rtc_general_single_option( GeneralSettings::$pusher_app_id ) ) ?>"
                    load_via="<?php echo esc_attr( GeneralSettings::rtc_general_single_option( GeneralSettings::$load_via ) ) ?>"
            >
            </comments>
        </div>
		<?php do_action( 'comment_form' ); ?>
		<?php do_action( 'comment_form_after' ); ?>
    </div>
</div>
