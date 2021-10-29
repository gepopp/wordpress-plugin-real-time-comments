<?php

namespace RealTimeComments;

use Pusher\Pusher;

class NewComment {

	public function __construct() {
		add_action( 'rest_after_insert_comment', [ $this, 'comment_saved' ], 10, 2 );
	}


	public function comment_saved( $comment, $request ) {

		$options = [
			'cluster' => 'eu',
			'useTLS'  => true,
		];
		$pusher  = new Pusher(
			'33200611800c555398d6',
			'c842d271cbae62e6dd9c',
			'1289113',
			$options
		);

		$commentdata = [
			'author_avatar_urls' => [
				'48' => get_avatar_url( $comment->user_id, [
					'size' => 48
				])
			],
			'author_name'        => $comment->comment_author,
			'child_count'        => 0,
			'children'           => [],
			'content'            => [
				'rendered' => '<p>' . $comment->comment_content . '</p>',
			],
			'date'               => $comment->comment_date,
			'id'                 => $comment->comment_ID,
			'parent'             => $comment->comment_parent,
			'post'               => $comment->comment_post_ID,

		];


		$pusher->trigger( (string) $comment->comment_post_ID, 'new-comment', $commentdata );
	}

}