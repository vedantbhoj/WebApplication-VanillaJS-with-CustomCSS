<?php
	session_start();

	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '910992435771575',
		'app_secret' => '5cb9489c1edb18b4f4f75718c5f3cddd',
		'default_graph_version' => 'v3.2'
	]);

	$helper = $FB->getRedirectLoginHelper();
?>