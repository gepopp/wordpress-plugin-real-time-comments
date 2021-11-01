<?php

namespace RealTimeComments;

class Boot {


	private static $instance = false;


	private array $boot_classes = [
		Enqueue::class,
		Form::class,
		NewComment::class,
		AdminSettingsPages::class,
		Rest::class
	];


	public static function getInstance(): Boot {

		if ( ! self::$instance ) {
			self::$instance = new Boot();
		}

		return self::$instance;

	}

	public function boot() : void {


		foreach ( $this->boot_classes as $boot_class ) {

			if(class_exists($boot_class)){
				new $boot_class();
			}
		}


	}

	private function __construct() {
	}

	private function __clone() {
	}


}