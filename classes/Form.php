<?php

namespace RealTimeComments;

class Form {


	public function __construct() {

		#TODO make this hook optional via admin setting option
		#TODO make this hook optional for CPT's and via meta field for single posts
		add_filter('comments_template', [$this,'swap_form']);
	}


	public function swap_form(){

		#TODO make form conditional for loggedin users over a provided admin setting
		$form_template = RTC_DIR . '/templates/comments.php';

		return $form_template;
	}

}