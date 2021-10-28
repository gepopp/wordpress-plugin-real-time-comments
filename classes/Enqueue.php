<?php

namespace RealTimeComments;

class Enqueue {


	public function __construct() {

		add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
	}


	public function enqueue_frontend_scripts(){

		wp_enqueue_style(
			'real_time_comments_styles',
					trailingslashit(RTC_URL) . 'dist/main.css',
			[],
			RTC_VERSION
		);

		wp_enqueue_script('real_time_comments_script', RTC_URL . 'dist/main.js', [], RTC_VERSION, true);

	}


}