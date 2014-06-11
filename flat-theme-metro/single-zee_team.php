<?php
global $moresidebar;
$moresidebar = "test";


	$args = array(
		'posts_per_page' => -1,
		'post_type'      =>  'zee_team'
	);


	$teamposts = get_posts( $args );
	if(count($teamposts)>0){ 
		$moresidebar = "<ul>";
		foreach ($teamposts as $key => $value) { 
			$moresidebar .= "<li><a href=\"". get_permalink( $value->ID ) ."\">" . $value->post_title . "</a></li>";
		}
		$moresidebar .= "</ul>";
	}

require_once(get_stylesheet_directory() . "/page.php");