<?php

namespace RealTimeComments;

class Enqueue {


	public function __construct() {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );
		add_filter( 'body_class', function ( $classes ) {
			return array_merge( $classes, [ 'app' ] );
		} );
		add_filter( 'rest_allow_anonymous_comments', '__return_true' );
	}


	public function enqueue_frontend_scripts() {

		wp_enqueue_style(
			'real_time_comments_styles',
			trailingslashit( RTC_URL ) . 'dist/main.css',
			[],
			RTC_VERSION
		);

		$ext = '.min';
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$ext = '';
		}

		wp_enqueue_script( 'real_time_comments_script', RTC_URL . "dist/main{$ext}.js", [], RTC_VERSION, true );
		wp_localize_script( 'real_time_comments_script', 'translations', [
			'submit'              => __( 'submit', RTC_TEXTDOMAIN ),
			'submit_warning'      => __( 'please enter at least 3 charachters', RTC_TEXTDOMAIN ),
			'comment_placeholder' => __( 'enter your comment', RTC_TEXTDOMAIN ),
			'name_placeholder'    => __( 'your name', RTC_TEXTDOMAIN ),
			'email_placeholder'   => __( 'your email', RTC_TEXTDOMAIN ),
			'name_required'       => __( 'please enter your name', RTC_TEXTDOMAIN ),
			'valid_email'         => __( 'please enter a valid email address', RTC_TEXTDOMAIN ),
			'comment_succes'      => __( 'thank you for your comment', RTC_TEXTDOMAIN ),
			'replies'             => __( 'replies:', RTC_TEXTDOMAIN ),
			'reply_now'           => __( 'reply now', RTC_TEXTDOMAIN ),
			'show_replies'        => __( 'show replies', RTC_TEXTDOMAIN ),
			'close_replies'       => __( 'close replies', RTC_TEXTDOMAIN ),
			'posted'              => __( 'Posted at:', RTC_TEXTDOMAIN ),
			'load_more'           => __( 'load more', RTC_TEXTDOMAIN ),
		] );
		wp_localize_script( 'real_time_comments_script', 'rtc_xhr', [
			'rootapiurl' => esc_url_raw( rest_url() ),
			'nonce'      => wp_create_nonce( 'wp_rest' ),
			'ajaxurl'    => admin_url( 'admin-ajax.php' ),
		] );
	}


}