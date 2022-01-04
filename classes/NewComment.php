<?php

namespace RealTimeComments;

use RealTimeComments\Pusher;

class NewComment {

	public function __construct() {
		add_action( 'rest_after_insert_comment', [ $this, 'comment_saved' ], 10, 2 );
	}


	public function comment_saved( $comment, $request ) {

		$pusher = new Pusher();

		$comment = new Comment( $comment );

		$pusher->push( (string) $comment->comment_post_ID, 'new-comment', $comment->to_array() );
	}

}