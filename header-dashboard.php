<?php require_once 'common/init.php'; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Cinema</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/custom.css" rel="stylesheet">
	<link href="assets/css/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css">
	<script src="assets/js/jquery-1.11.1.js"></script>


  </head>

  <body>
<div style="display:none; background:url('loading.gif') no-repeat center center rgba(255,255,255,0.5);  top:0; z-index:100000000; left:0; width:100%; height:100%; position:absolute" id="hack"></div>
  <!--header-->
  <?php 
  ?>
   <div class="wrapper">
   <div class="container top-bar">
	 <div class="row">
		<div class="col-md-6 col-sm-6">
			<a href="#"><img alt="logo" src="assets/images/logo.png"></a>
		</div><!-- col-md-6 -->
		
		<div class="col-md-6 col-sm-6 right-top-bar">
			<ul class="navbar-right settings">
				<li><a href="#"><p class="user-name"><?php echo $_SESSION['user']->first_name ?><br><span><?php echo $_SESSION['user']->user_email; ?></span></p></a></li>
				<li><a href="#"><?php if( $_SESSION['user']->user_img == ""){?><img class="user-img" width="25px" src="assets/images/avatar.png"/><?php } else{ echo '<img class="user-img" width="25px" src="assets/images/uploads/'.$_SESSION['user']->user_img.'"/>'; }?></a></li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="setting-icon" src="assets/images/settings.png"/></a>
				  <ul class="dropdown-menu">
				    <li><a href="index.php">Admin panel</a></li>
					<li><a href="login.php?logout=true">Logout</a></li>
				  </ul><!-- dropdown -->
				</li>
			</ul><!-- navbar-right -->
		</div><!-- col-md-6 -->
	 </div><!-- row -->
    </div><!-- container top-bar-->
	
  <div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-4 info_header">
			<a href="#"><p class="">CONCESSIONS<br>
				<span>How your Cinema is doing</span>
			</p></a>
			
			<img class="down_caret" src="assets/images/down_caret.png"></a>
	            <ul class="dropdown-menu advance_li">
		             <li><a href="concession.php">Book Concession</a></li>
				     <li><a href="cancel_concession.php">Cancel Concession</a></li>
				</ul>
		</div><!-- col-md-4 -->
		
		<div class="col-md-4 col-sm-4 info_header">
			<a href="#"><p class="">TICKETS<br>
				<span>(<?php echo date("d-M-y"); ?>)</span>
			</p>
			
			<img class="down_caret" src="assets/images/down_caret.png"></a>
	            <ul class="dropdown-menu advance_li">
		             <li><a href="booking.php">Book ticket</a></li>
				     <li><a href="view_reprint_ticket.php">Reprint Ticket</a></li>
					 <li><a href="cancel_ticket.php">Cancel Ticket</a></li>
					 <li><a href="cancel_lock_seats.php">Cancel Locked Seats</a></li>
			    </ul>
		</div><!-- col-md-4 -->
		
		<div class="col-md-4 col-sm-4 info_header">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	            	<p class="">RESERVE TICKETS<br>
				<span>Best Movie Town</span>
			</p>
					
	            <img class="down_caret" src="assets/images/down_caret.png"></a>
	            <ul class="dropdown-menu advance_li">
		             <li><a href="advance_booking.php">Book Reserve Ticket</a></li>
				     <li><a href="view_advance_bookings.php">View Reserve Ticket</a></li>
			    </ul>
		</div><!-- col-md-4 -->
	 </div><!-- row -->
  </div><!-- container -->
	 
   <!--/header-->
   
   
   <!--main container-->
   
