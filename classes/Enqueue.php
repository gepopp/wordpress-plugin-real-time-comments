<?php

namespace RealTimeComments;

class Enqueue {


	public function __construct() {


			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );
			add_filter( 'rest_allow_anonymous_comments', '__return_true' );

	}


	public function enqueue_frontend_scripts() {


		if(!is_singular() && !is_single()) return;


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
			'submit'              => __( 'submit', 'real-time-comments' ),
			'submit_warning'      => __( 'please enter at least 3 charachters', 'real-time-comments' ),
			'comment_placeholder' => __( 'enter your comment', 'real-time-comments' ),
			'name_placeholder'    => __( 'your name', 'real-time-comments' ),
			'email_placeholder'   => __( 'your email', 'real-time-comments' ),
			'name_required'       => __( 'please enter your name', 'real-time-comments' ),
			'valid_email'         => __( 'please enter a valid email address', 'real-time-comments' ),
			'comment_succes'      => __( 'thank you for your comment', 'real-time-comments' ),
			'replies'             => __( 'replies:', 'real-time-comments' ),
			'reply_now'           => __( 'reply now', 'real-time-comments' ),
			'show_replies'        => __( 'show replies', 'real-time-comments' ),
			'close_replies'       => __( 'close replies', 'real-time-comments' ),
			'posted'              => __( 'Posted at:', 'real-time-comments' ),
			'load_more'           => __( 'load more', 'real-time-comments' ),
		] );
		wp_localize_script( 'real_time_comments_script', 'rtc_xhr', [
			'rootapiurl' => esc_url_raw( rest_url() ),
			'nonce'      => wp_create_nonce( 'wp_rest' ),
			'ajaxurl'    => admin_url( 'admin-ajax.php' ),
		] );
	}


}