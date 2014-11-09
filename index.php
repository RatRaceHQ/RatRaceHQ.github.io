<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RatRace MBA</title>
    <link rel="stylesheet" href="stylesheets/app.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/pushy.css">
    <link rel="stylesheet" href="stylesheets/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/easydropdown.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600' rel='stylesheet' type='text/css'>

    <script src="js/modernizr.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"/>
    <script src="js/app.js"></script>
    <script src="js/pushy.js"></script>
    <script src="js/jquery.easydropdown.min.js"></script>
    <script src="js/mousetrap.min.js"></script>
    <script src="js/jquery.touchSwipe.min.js"></script>
	<script src="DesScript.js"></script>	
	
</head>
<body>	
	<!-- Pushy Menu -->
	<nav class="pushy pushy-left">
			<?php 
				include("Funcphp.php");
				selectmodule($_GET['Module']);
			?>		
	  	<ul>
			<div id='DivLoad'>
				<?php				
				LoadDiv($_GET['Module']);					
				?>
			</div>
	  	
	  		  			  		
	  	</ul>
	</nav><!-- Pushy Menu Ends -->

	<!-- Site Overlay for off-canvas menu- pushy -->
	<div class="site-overlay"></div>

	<div id="container"><!--wrapper-->
	  	<header>
	  	<div class="header-wrapper row">
	  		<div class="small-3 large-3 columns menu-btn"><!--subject menu--><i class="fa fa-bars"></i></div>
	  		<div class="logo small-6 large-6 columns"><!--logo-->
			<img src="img/logo.png"/>		
	  		</div>
	  		<div class="small-3 large-3 columns"><!--nav--></div>
	  	</div>
	  	</header>


	  <section>
	  <div id='MainSession'>
	  	<div class="breadcrumb_container row"><!--breadcrumb-->
	  		<div class="breadcrumb small-6 large-12 medium-12 columns">
			<?php 		
				 //include("Funcphp.php");
				 Infobar($_GET['Module'],$_GET['Content']);			
			?> 
	  		<!--numbering for small screens-->
	  		<div class="counter-mobile small-6 show-for-small-only columns"></div>
	  	</div>

	  	<div class="page-wrapper row"><!--content-->
	  		<div class="content-wrapper">
	  			<div class="visible-for-medium-up">
				<?php 		
					 //include("Funcphp.php");
					 MainCont($_GET['Module'],$_GET['Content'],$_GET['Content_Num']);			
				?> 
	  				
	  	</div>	
	  </section>


	  <footer></footer>
	</div><!--wrapper ends-->


<script >
//keyboard shortcuts for next and prev
Mousetrap.bind('right', function() { window.location.href = "http://stackoverflow.com";});
Mousetrap.bind('left', function() { window.location.href = "http://google.com"; });

//swipe function for touch devices
$(function() {
        //Enable swiping...
        $(".content-wrapper").swipe({
            //Generic swipe handler for all directions
            swipeLeft: function(event, direction, distance, duration, fingerCount) {
                window.location.href = "http://stackoverflow.com";
            },
            swipeRight: function(event, direction, distance, duration, fingerCount) {
                window.location.href = "http://google.com";
            },
            threshold: 0
        });
    });

</script>

</body>

</html>
