<?php

namespace RealTimeComments;

class Boot {


	private static $instance = false;


	public static function getInstance(): Boot {

		if ( ! self::$instance ) {
			self::$instance = new Boot();
		}

		return self::$instance;

	}

	public function enqueue(){

		new Enqueue();

	}

	private function __construct() {
	}

	private function __clone() {
	}


}