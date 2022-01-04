<?php

namespace RealTimeComments;

class Avatar {





	protected $user;





	protected $email;





	public function __construct( $user = false, $email = false ) {

		$this->user  = $user;
		$this->email = $email;

	}





	public function get_url() {

		if ( $this->user ) {
			return get_avatar_url( $this->user->id, 48 );
		}


		if ( $this->email ) {
			$email = trim( $this->email ); // "MyEmailAddress@example.com"
			$email = strtolower( $email ); // "myemailaddress@example.com"
			$hash  = md5( $email );

			return "https://www.gravatar.com/avatar/$hash?s=48";
		}

		return RTC_URL . 'dist/images/emoji2.png';
	}
}