<?php
session_start();
include_once("config.php");
include_once("lib/twitteroauth.php");
include_once("includes/functions.php");

if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {

	
	session_destroy();
	header('Location: Main.php');
	
}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

	//Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($connection->http_code == '200')
	{
		
		$_SESSION['status'] = 'verified';
		$_SESSION['request_vars'] = $access_token;
		
	
		$user_info = $connection->get('account/verify_credentials'); 
		$name = explode(" ",$user_info->name);
		$firstname = isset($name[0])?$name[0]:'';
		$lastname = isset($name[1])?$name[1]:'';
		$db_user = new Users();
		$db_user->checkUser('twitter',$user_info->id,$user_info->screen_name,$firstname,$lastname,$user_info->lang,$access_token['oauth_token'],$access_token['oauth_token_secret'],$user_info->profile_image_url);
		
		
		unset($_SESSION['token']);
		unset($_SESSION['token_secret']);
		header('Location: Main.php');
	}else{
		die("error, try again later!");
	}
		
}else{

	if(isset($_GET["denied"]))
	{
		header('Location: Main.php');
		die();
	}

	
	$connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
	

	$_SESSION['token'] 			= $request_token['oauth_token'];
	$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
	
	
	if($connection->http_code == '200')
	{
	
		$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
		header('Location: ' . $twitter_url); 
	}else{
		die("error connecting to twitter! try again later!");
	}
}
?>

