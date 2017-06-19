<?php
add_action('wp_ajax_gotit', 'test_ajax');
add_action('wp_ajax_nopriv_gotit', 'test_ajax');
function test_ajax() {

	$ajax_text = $_GET['text'];

	$args = array(
		"post_type" => array('page','services'),
		"posts_per_page" => -1,
		"post_status" => "publish",
		"s" => $ajax_text);
	$query = get_posts( $args );

	if(!empty($query)) {
		$count_array = count($query);
		$callback = '{"count":'.$count_array.', "items":[';
		$count = 0;
		foreach ($query as $row) {
			if ($count === $count_array) {
				break;
			}
			$callback .= '{"link":"'.get_permalink($row).'", "title":"'.ucfirst(get_the_title($row)).'"}, ';
			$count++;
		}
		$callback = substr($callback, 0, -2);
		echo $callback .= ']}';
	} else {
		echo '{"count":0}';
	}
	exit;
}