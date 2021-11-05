<?php

namespace RealTimeComments;

class Enqueue {


	public function __construct() {


		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
		add_filter( 'rest_allow_anonymous_comments', '__return_true' );

	}

	public function enqueue_admin_scripts() {

		$ext = '.min';
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$ext = '';
		}

		wp_enqueue_script( 'rtc_admin_script', RTC_URL . "dist/admin{$ext}.js", [ 'jquery', 'wp-color-picker' ] );
	}

	public function enqueue_frontend_scripts() {


		if ( ! is_singular() && ! is_single() ) {
			return;
		}


		wp_enqueue_style(
			'real_time_comments_styles',
			trailingslashit( RTC_URL ) . 'dist/main.css',
			[],
			RTC_VERSION
		);

		$options    = get_option( 'rtc_general_settings' );
		$color      = $options['layout_main_color'] ?? '#707070'; //E.g. #FF0000
		$rounding   = $options['layout_avatar_rounding'] ?? '100';
		$custom_css = "
                .main-border{
                        border-color: {$color};
                }
                .main-bg{
                        background-color: {$color};
                }
                .avatar-radius{
                    border-radius: {$rounding}%;
                }
                ";
		wp_add_inline_style( 'real_time_comments_styles', $custom_css );


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
			'posted'              => __( 'Posted', 'real-time-comments' ),
			'load_more'           => __( 'load more', 'real-time-comments' ),
			'no_comments'         => __( 'Nobody commented yet, be the first', 'real-time-comments' ),
		] );
		wp_localize_script( 'real_time_comments_script', 'rtc_xhr', [
			'rootapiurl' => esc_url_raw( rest_url() ),
			'nonce'      => wp_create_nonce( 'wp_rest' ),
			'ajaxurl'    => admin_url( 'admin-ajax.php' ),
		] );
	}


}