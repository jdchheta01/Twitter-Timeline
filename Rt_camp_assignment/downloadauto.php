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
		if (isset($_POST['submit']))
		{
		
			if($_POST['type']=="csv")
			{

				$fv=$_POST['search'];
				$type = $_POST['type'];
				header("Content-type: application/csv");
				header("Content-Disposition: attachment; filename=followers.csv");

				$file = fopen('php://output', 'w');

				//$data=array();
				$cursor=-1;
				while($cursor!=0)
				{
					$followers=$connection->get('followers/ids',array("screen_name" =>$fv, "cursor" => $cursor));
					$cursor = $followers->next_cursor;
					fputcsv($file, array("Name","Screen_Name"));
					$ids_arrays = array_chunk($followers->ids, 100);
				
					foreach($ids_arrays as $values)
					{
						$user_ids=implode(',', $values);
					
						$results = $connection->get('users/lookup',array('user_id' => $user_ids));
					
					
						foreach($results as $profile) {
   
						
						fputcsv($file,array($profile->name,$profile->screen_name));
						}
					
					} 
				}
			}
		
		
		
		
		
			else
			{
				$fv= $_POST['search'];
			
				$followers = $connection->get('followers/list', array('count'=>200,'screen_name'=>$fv));

				require_once("pdf/tcpdf/tcpdf.php");
				$obj_pdf = new TCPDF('p',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
				$obj_pdf->setCreator(PDF_CREATOR);
				$obj_pdf->SetTitle("Data");
				$obj_pdf->SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
				$obj_pdf->SetHeaderFont(array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
				$obj_pdf->SetFooterFont(array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
				$obj_pdf->SetDefaultMonospacedFont('helvetica');
				$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$obj_pdf->SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
				$obj_pdf->SetPrintHeader(false);
				$obj_pdf->SetPrintFooter(false);
				$obj_pdf->SetAutoPageBreak(TRUE,10);
				$obj_pdf->SetFont('helvetica','',12);
				$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$obj_pdf->AddPage();
				
				foreach($followers->users as $follower)
				{

					
					$html2 = 
				'<div style="background-color:lightgreen;height:auto;width:auto">
		     		<br/> 
					
					Name : '.$follower->name.' <br/>
					Screen Name :'.$follower->screen_name.' <br/>
					 
				</div>
				<br/>';
				

				
				$obj_pdf->writeHTMLCell(0,0,'','',$html2,0,1,0,true,'',true);
						
				}		
			ob_end_clean();
			$obj_pdf->Output("Followers.pdf","I");
			
		
			}
		}
	}
	  
?>