<?php

namespace RealTimeComments;

class Avatar {


	protected \WP_User|bool $user;
	protected string $email;

	public function __construct( \WP_User|bool $user = false, $email = false ) {

		$this->user = $user;
		$this->email = $email;

	}


	public function get_url() : string{

		if ( $this->user ) {
			return get_avatar_url( $this->user->id, 48 );
		}


		if ( $this->email ) {
			$email = trim( $this->email ); // "MyEmailAddress@example.com"
			$email = strtolower( $email ); // "myemailaddress@example.com"
			$hash  = md5( $email );
			return "https://www.gravatar.com/avatar/$hash?s=48";
		}

		return RTC_URL . '/assets/images/emoji2.png';
	}
}