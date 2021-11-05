<?php

namespace RealTimeComments;

use Carbon\Carbon;


class Comment {


	public int $comment_ID;

	public string $comment_date;

	public string $date_for_humans;

	public string $comment_content;

	public string $comment_karma;

	public bool $comment_approved;

	public int $comment_parent;

	public int $comment_post_ID;

	public int $author_id;

	public string $comment_author;

	public string $author_avatar_url;

	public int $child_count;

	public array $children = [];

	public int $user_id;


	public function __construct( \WP_Comment|int $wp_comment  ) {

		if(is_int($wp_comment)){
			$wp_comment = get_comment( $wp_comment );
		}


		foreach ( get_object_vars( $wp_comment ) as $key => $value ) {
			if(property_exists($this, $key))
			$this->$key = $value;
		}


		$this->get_avatar_url();
		$this->diff_for_humans();
		$this->get_children($wp_comment);

	}


	public function get_children( $wp_comment ): void {

		$wp_children = $wp_comment->get_children(['format' => 'flat']);

		foreach ( array_reverse($wp_children) as $wp_child ) {
			$this->children[] = new Comment( $wp_child->comment_ID );
		}

	}

	public function diff_for_humans(): void {

		Carbon::setLocale(get_locale());
		$this->date_for_humans = Carbon::createFromFormat('Y-m-d H:i:s', $this->comment_date, get_option('timezone_string') )->diffForHumans();
	}


	public function get_avatar_url(){

		$user = get_user_by('id', $this->user_id);

		$avatar = new Avatar($user);

		$this->author_avatar_url = $avatar->get_url();
	}


	public function to_array() {
		return get_object_vars( $this );
	}

	public function to_json(){
		return json_encode($this->to_array());
	}

}