<?php

namespace RealTimeComments;

class Boot {


	private static $instance = false;


	private $boot_classes = [
		Enqueue::class,
		Form::class,
		NewComment::class,
		AdminSettingsPages::class,
		CommentsRest::class
	];


	public static function getInstance(): Boot {

		if ( ! self::$instance ) {
			self::$instance = new Boot();
		}

		return self::$instance;

	}

	public function boot() {

		$this->bootHooks();

		foreach ( $this->boot_classes as $boot_class ) {

			if(class_exists($boot_class)){
				new $boot_class();
			}
		}

	}

	public function bootHooks(){

		add_action( 'init', function (){
			load_plugin_textdomain( 'real-time-comments', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		});

		add_action('rest_api_init', function (){
			$cl = new CommentsRest();
			$cl->register_routes();
		});
	}

	private function __construct() {
	}

	private function __clone() {
	}


}