<?php

namespace RealTimeComments;

class Pusher {


	protected  $auth_key;
	protected  $secret;
	protected  $app_id;

	protected  $cluster = 'eu';
	protected  $use_tls = true;


	public function __construct() {

		$options = get_option( 'rtc_general_settings' );

		$this->auth_key = $options['pusher_auth_key'];
		$this->secret   = $options['pusher_secret'];
		$this->app_id   = $options['pusher_app_id'];
	}


	public function push( $channel, $event, $data ) {

		$pusher = new \Pusher\Pusher(
			$this->auth_key,
			$this->secret,
			$this->app_id,
		[
			'cluster' => $this->cluster,
			'useTLS'  => $this->use_tls
		]);

		$pusher->trigger(sanitize_title($channel), sanitize_title($event), $data);

	}
}