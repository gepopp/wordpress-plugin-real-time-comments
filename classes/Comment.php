<?php

namespace RealTimeComments;

use Carbon\Carbon;


class Comment {


	public  $comment_ID;

	public  $comment_date;

	public  $date_for_humans;

	public  $comment_content;

	public  $comment_karma;

	public  $comment_approved;

	public  $comment_parent;

	public  $comment_post_ID;

	public  $author_id;

	public  $comment_author;

	public  $author_avatar_url;

	public  $child_count;

	public  $children = [];

	public  $user_id;


	public function __construct(  $wp_comment  ) {

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


	public function get_children( $wp_comment ) {

		$wp_children = $wp_comment->get_children(['format' => 'flat']);

		foreach ( array_reverse($wp_children) as $wp_child ) {
			$this->children[] = new Comment( $wp_child->comment_ID );
		}

	}

	public function diff_for_humans() {

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