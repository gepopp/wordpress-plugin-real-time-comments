<?php

namespace RealTimeComments;


use RealTimeComments\Settings\GeneralSettings;



class Form {





	use GeneralSettings;



	public function __construct() {

		add_filter( 'comments_template', [ $this, 'swap_form' ] );
		add_action( 'comment_form_before', function () {

			$app_key  = $this->rtc_general_single_option( GeneralSettings::$pusher_key );
			$load_via = $this->rtc_general_single_option( GeneralSettings::$load_via );
			$paged    = $this->rtc_general_single_option( GeneralSettings::$paged );
		} );
	}





	public function swap_form() {


		#TODO make form conditional for loggedin users over a provided admin setting
		$form_template = RTC_DIR . '/templates/comments.php';

		$form_template = apply_filters( 'rtc_swap_form', $form_template );

		return $form_template;
	}

}