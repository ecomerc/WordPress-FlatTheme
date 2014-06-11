<?php

$type = get_post_type( );


if (($type == "zee_portfolio" || $type == "zee_team" || $type == "page" || ($type == "post" && is_single())) && (!is_front_page()) ) {
	require_once(get_stylesheet_directory(). '/lib/breadcrumbs.php');

	global $post;

    $ID = $post->ID;

	
	
	switch ($type) {
		case "zee_portfolio":
			$title = "References";
			$sub_title = $post->post_title;
			break;
		case "zee_team":
			$title = "About " . $post->post_title;
			
			if(get_post_meta($post->ID, 'team_designation', true)!=''){ 
				$sub_title = get_post_meta($post->ID, 'team_designation', true);   
			}
			
			$post->post_parent = 94;
			//$sub_title = $post->post_title;
			break;
		case "page":
			$title = $post->post_title;
			$sub_title = get_post_meta($ID, 'page_subtitle', true);
			break;
		case "post":
			$title = zee_option('zee_blog_title');
			$sub_title = zee_option('zee_blog_subtitle');
			break;
	} 
	
	
	
	
	
	
	
	
	echo (isset($title) ? '

		<section id="title" class="emerald">
		<div class="container">
		<div class="row">
		<div class="col-sm-6">
		<h1>'.$title.'</h1>
		<p>'.$sub_title.'</p>
		</div>
		<div class="col-sm-6">'.zee_breadcrumb().'</div>
		</div>
		</div>
		</section>

		' : '');
		
} else {

	require_once(get_template_directory() . "/sub-title.php");

}
