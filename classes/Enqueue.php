<?php

namespace RealTimeComments;

class Enqueue {


	public function __construct() {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );
		add_filter( 'body_class', function ( $classes ) {
			return array_merge( $classes, [ 'app' ] );
		} );
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
			'submit_warning'      => __( 'please enter at least 10 charachters', RTC_TEXTDOMAIN ),
			'comment_placeholder' => __( 'enter your comment', RTC_TEXTDOMAIN ),
		] );
		wp_localize_script( 'real_time_comments_script', 'rtc_xhr', [
			'rootapiurl' => esc_url_raw( rest_url() ),
			'nonce'      => wp_create_nonce( 'wp_rest' ),
			'ajaxurl'    => admin_url( 'admin-ajax.php' ),
		] );
	}


}