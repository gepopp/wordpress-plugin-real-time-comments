<?php

namespace RealTimeComments;

use WP_REST_Comments_Controller;

class CommentsRest extends WP_REST_Comments_Controller {


	public function __construct() {

		parent::__construct();
		$this->namespace= 'rtc/v1';
	}


	public function prepare_item_for_response( $comment, $request ) {

		return new Comment((int) $comment->comment_ID);

	}
}