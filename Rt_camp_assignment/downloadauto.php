<?php
  session_start();
  
  include_once("config.php");
  include_once("lib/twitteroauth.php");

   if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified') 
      {
        $screen_name=$_SESSION['request_vars']['screen_name'];
        $twitter_id=$_SESSION['request_vars']['user_id'];
        $oauth_token=$_SESSION['request_vars']['oauth_token'];
        $oauth_token_secret=$_SESSION['request_vars']['oauth_token_secret'];
    
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

        if(isset($_POST['submit']))
        {

          $fv=$_POST['search'];

          header("Content-type: application/csv");
		      header("Content-Disposition: attachment; filename=followers.csv");

		      $file = fopen('php://output', 'w');

		      $data=array();
 
          $followers=$connection->get('followers/list',array("count"=>100,'screen_name' =>$fv));
          fputcsv($file, array("Name","Screen_Name"));
		
       	  foreach($followers->users as $values)
          {
        	   fputcsv($file,array($values->name,$values->screen_name));
          } 
          fclose($file);
        }
	   }
?>