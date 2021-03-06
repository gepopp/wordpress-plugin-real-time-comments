<?php
$wp_comments = get_comments( [
	'post_id' => get_the_ID(),
	'parent'  => 0,
	'status'  => 1,
	'count'   => true,
] );

$options = get_option( 'rtc_general_settings' );





?>
<div id="real-time-comments-container" class="w-full container mx-auto p-5">
	<?php do_action( 'comment_form_before' ); ?>
    <div class="flex flex-col">
        <h1 class="comment-form-heading"><?php _e( 'Write a comment', 'real-time-comments' ) ?></h1>
		<?php do_action( 'comment_form_top' ); ?>
        <div>
            <comments-form :post_id="<?php echo get_the_ID() ?>" :user_id="<?php echo (int) get_current_user_id() ?>"></comments-form>
			<?php do_action( 'comment_form_after_fields' ); ?>
        </div>
        <hr class="py-3 my-3">
        <div class="w-full overflow-y-scroll overflow-x-hidden scrollbar scrollbar-thumb-gray-900 scrollbar-track-gray-100">
            <comments
                    :post_id="<?php echo get_the_ID() ?>"
                    :count="<?php echo esc_attr( $wp_comments ) ?>"
                    :user_id="<?php echo (int) get_current_user_id() ?>"
                    :paged="<?php echo empty( $options['comments_page'] ) ? 10 : esc_attr($options['comments_page']) ?>"
                    app_key="<?php echo esc_attr( $options['pusher_auth_key'] ) ?>"
                    load_via="<?php echo esc_attr( $options['comments_load_via'] ) ?>"
            >
            </comments>
        </div>
		<?php do_action( 'comment_form' ); ?>
		<?php do_action( 'comment_form_after' ); ?>
    </div>
</div>
