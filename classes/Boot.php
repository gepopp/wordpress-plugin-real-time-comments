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

	public function enqueue() : void {

		new Enqueue();

	}

	public function swap_form() : void {

		new Form();

	}

	public function new_comment() : void {

		new NewComment();

	}

	private function __construct() {
	}

	private function __clone() {
	}


}