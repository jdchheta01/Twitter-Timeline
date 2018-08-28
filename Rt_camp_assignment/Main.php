<?php
  session_start();
  
  include_once("config.php");
  include_once("lib/twitteroauth.php");
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Twitter</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/icons/Twitter_logo.png"/>
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jssor.slider.min.js"></script>
    <script>
        jssor_slider1_init = function () {
            var options = {
                $FillMode: 2,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
                $AutoPlay: 1,                                    //[Optional] Auto play or not, to enable slideshow, this option must be set to greater than 0. Default value is 0. 0: no auto play, 1: continuously, 2: stop at last slide, 4: stop on click, 8: stop on user navigation (by arrow/bullet/thumbnail/drag/arrow key navigation)
                $Idle: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: 1,                     //[Optional] Steps to go for each navigation request by pressing arrow key, default value is 1.
                $SlideEasing: $Jease$.$OutQuint,          //[Optional] Specifies easing for right to left animation, default value is $Jease$.$OutQuad
                $SlideDuration: 1200,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide, default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0,                           //[Optional] Space between each slide in pixels, default value is 0
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)
                
                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Rows: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 8,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };

            var jssor_slider1 = new $JssorSlider$('slider1_container', options);

            
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);

            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            
        };
    </script>

    <style> 
      input[type=text] 
      {
        width: 130px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        background-image: url('img/icons/searchicon.png');
        background-position: 10px 10px; 
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
      }

      input[type=text]:focus 
      {
        width: 50%;
      }
    </style>

    <style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>

    <style>
        .jssorb051 .i {position:absolute;cursor:pointer;}
        .jssorb051 .i .b {fill:#fff;fill-opacity:0.5;stroke:#000;stroke-width:400;stroke-miterlimit:10;stroke-opacity:0.5;}
        .jssorb051 .i:hover .b {fill-opacity:.7;}
        .jssorb051 .iav .b {fill-opacity: 1;}
        .jssorb051 .i.idn {opacity:.3;}
    </style>

    <!--#region Arrow Navigator Skin -->
    <!-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html -->
    <style>
        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>

  </head>

  <body id="page-top">

     <?php
      if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified') 
      {
        $screen_name=$_SESSION['request_vars']['screen_name'];
        $twitter_id=$_SESSION['request_vars']['user_id'];
        $oauth_token=$_SESSION['request_vars']['oauth_token'];
        $oauth_token_secret=$_SESSION['request_vars']['oauth_token_secret'];
    
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

        $user_info=$connection->get("account/verify_credentials");
        //$prof_img=str_replace('_normal' , '_400x400' ,$user_info->profile_image_url);

        $statuses = $connection->get("statuses/user_timeline",array('screen_name'=>$user_info->screen_name,"count"=>13)); 
        

        foreach($statuses as $key => $statuse) 
        {

          $arrstatus=[];
          $arrstatus['created_at']=$statuse->created_at;
         $arrstatus['text']=$statuse->text;

        
          $arrstatus['created_by']=$user_info->name;
          $arrstatus['screen_name']=$user_info->screen_name;
          $arrstatuses[]=$arrstatus;
        }
         

          
          function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) 
                {
                    $conection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
                    return $conection;
                }
    
            $conection = getConnectionWithAccessToken(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token,$oauth_token_secret);
            $scren_name=$user_info->screen_name;
            $result = $conection->get('followers/list', array('count' => 10, 'screen_name' => $screen_name));
            $Followers = array();

            foreach ($result->users as $user) 
            {
                $html2 = '<div style="height:auto;width:auto"><img src="'.$user->profile_image_url.'" style="height:32px;width:32px;border:1px solid black"/>'.$user->name.'</div><br/>';
            
            }
            
   
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
          
          <?php
            echo '<strong>'.$user_info->screen_name .'</strong>';
          ?>

        </a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
       
        <div class="collapse navbar-collapse" id="navbarResponsive">
          
           
        
          <ul class="navbar-nav ml-auto">
            <form method="post" action="downloadauto.php">
                <input type="text" name="search" placeholder="Search followers">
                <button class="button" type="submit" name="submit">
                Download Followers</button>
            </form>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php?logout">LOG OUT</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo $prof_img?>" alt="" style="border-radius:50%; height: 250px; width: 250px;">
        <h1 class="text-uppercase mb-0"></h1>
        <hr class="star-light">
        
        <center>
        <div style="height:auto;font-family: time new roman;font-size: larger;">
            <div style="height:auto; margin-right:50%; "><i>Tweets</i></div>
            <center>
            <div style="height:auto;margin-top: -26px; "><i>Following</i></div>
            </center>
            <div style="height:auto;align:right; margin-left: 50%;margin-top: -26px; "><i>Followers</i></div>
        </div>
      </center>
      <center>
        <div style="height:auto;">
            <div style="height:auto;margin-right: 50%"><?php echo $user_info->statuses_count; ?></div>
            <center>
            <div style="height:auto;margin-top: -26px; "><?php echo $user_info->friends_count; ?></div>
            </center>
            <div style="height:auto;align:right; margin-left: 50%;margin-top: -26px; "><?php echo $user_info->followers_count; ?></div>
        </div>
      </center>
      </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Tweets</h2>
        <hr class="star-dark mb-5">


        <!-- Slider Start -->
        <div class="row">
           <div id="slider1_container" style="position: relative; margin: 0 auto;
        top: 0 auto; left: 0px; width: 1500px; height: 700px; overflow: hidden;">
        
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="svg/loading/static-svg/spin.svg" />
        </div>

        <!-- Slides Container -->
        <div data-u="slides" style="position: absolute; left: 0px; top: 0px; width: 1500px;
            height: 600px; overflow: hidden;">
            <?php 
                 foreach($arrstatuses as $key=>$arrstatus)
                {
                ?>
            <div style="background-color: orange">
                <!--<img data-u="image" src="" alt="" style="background-color: gray" />-->

                <div style="position: absolute; width: 480px; height: 120px; top: 45%; left: 370px; padding: 5px;
                    text-align: center; line-height: 40px; text-transform: uppercase; font-size:20px;
                        color: #FFFFFF; "> <?php echo '<p>'.$arrstatus['text'].'</p>';?> 
                </div>
                <div style="position: absolute; width: 480px; height: 120px; top: 35%; left: 370px; padding: 5px;
                    text-align: center; line-height: 36px; font-size: 30px;
                        color: #FFFFFF;">
                        <?php echo '<p>' .date('d/m/Y H:i:s',strtotime($arrstatus['created_at'])).'</p>';
                        ?>
                 </div>

            </div>
            <?php } ?>
            
        </div>
          </div>
        </div>
        <script>
             jssor_slider1_init();
        </script>
        <!-- Slider End -->
      </div>
    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Followers</h2>
        <hr class="star-light mb-5">
        <div class="row">
            <?php
                foreach ($result->users as $value) {
                   
            ?>

          <div class="col-lg-4 ml-auto" style="margin-top: 1%;">
                   <img style="border-radius: 50%;" src="<?php echo $value->profile_image_url;?>">
            
                <?php
                    echo $value->name;?>
            
          </div>
          <?php } ?>
        </div>
        <div class="text-center mt-4">
          
        </div>
      </div>
    </section>

    <!-- Contact Section -->
   


    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Developed By JAYESH CHHETA</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>
<?php 
}
else
 {
    //Display login button
        echo '<a href="process.php"><img src="img/sign-in-with-twitter.png" width="151" height="24" border="0" /></a>';
 }
  ?>
</html>
