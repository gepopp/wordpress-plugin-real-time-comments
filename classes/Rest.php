<?php

namespace RealTimeComments;

class Rest {


	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'get_comments_by_post' ] );
	}


	public function get_comments_by_post() {

		register_rest_route( 'rtc/v1', '/comments/(?P<id>\d+)', [
			'methods'  => 'GET',
			'callback' => function (  $request ) {
				$post_id = $request['id'];
				$page = $request->get_param( 'page' ) ?? 1;

				$wp_comments = get_comments(['post_id' => $post_id, 'parent' => 0, 'number' => 10, 'paged' => $page ]);

				$comments = [];

				foreach ( $wp_comments as $wp_comment ) {
					$comments[] = new Comment($wp_comment->comment_ID);
				}

				return $comments;
			},
		] );

	}
}