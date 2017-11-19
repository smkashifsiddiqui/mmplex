<?php require_once 'common/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Cinema</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/dashboard.css" rel="stylesheet">
	<!-- custom scrollbar stylesheet -->
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" type="text/css" href="assets/css/timeline.css">
	<link rel="stylesheet" type="text/css" href="assets/css/timeline.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.datetimepicker.css"/>

<script src="assets/js/jquery-1.11.1.js"></script>
  </head>

  <body>
  <?php //date_default_timezone_set('Etc/GMT+5');
		
		
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	

  ?>
  <!--header-->
  <div class="wrapper">
   <div class="container top-bar  no-print">
	 <div class="row">
		<div class="col-md-6 col-sm-6">
			
		</div><!-- col-md-6 -->
		
		<div class="col-md-6 col-sm-6 right-top-bar">
			<ul class="navbar-right settings">
				<li><a href="#"><p class="user-name"><?php echo $_SESSION['user']->first_name ?><br><span><?php echo $_SESSION['user']->user_email; ?></span></p></a></li>
				<li><a href="#"><?php if( $_SESSION['user']->user_img == ""){?><img class="user-img" width="25px" src="assets/images/avatar.png"/><?php } else{ echo '<img class="user-img" width="25px" src="assets/images/uploads/'.$_SESSION['user']->user_img.'"/>'; }?></a></li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="setting-icon" src="assets/images/settings.png"/></a>
				  <ul class="dropdown-menu">
					<?php if(in_array('add_screen', $user_capabilities)){?>
					<li><a href="view_screen.php">Screens</a></li>
					<?php }?>
					
					<?php if(in_array('add_film', $user_capabilities)){?>
					<li><a href="view_person.php">Actors</a></li>
					<?php }?>
					
					<?php if(in_array('add_user', $user_capabilities)){?>
					<li><a href="view_user.php">Users</a></li>
					<?php }?>
					
					<?php if(in_array('add_concession', $user_capabilities)){?>
					<li><a href="view_food_category.php">Food Categories</a></li>
					<?php }?>
					
					<?php if(in_array('add_timing', $user_capabilities)){?>
					<li><a href="add_timings.php">Timings</a></li>
					<?php }?>
					
					<?php if(in_array('add_settings', $user_capabilities)){?>
					<li><a href="add_logo.php">Logo</a></li>
					<li><a href="add_slideshow.php">Slide show</a></li>
					<li><a href="add_setting.php">Settings</a></li>
					<?php }?>
					
					<?php if(in_array('view_terminal', $user_capabilities)){?>
					<li><a href="booking.php">Terminal</a></li>
					<?php }?>
					
					<li><a href="view_expense.php">Expense</a></li>
					<li><a href="view_payroll.php">Payroll</a></li>
					<li><a href="profit_loss.php">Profit & loss</a></li>
					
					<li><a href="login.php?logout=true">Logout</a></li>
				  </ul><!-- dropdown -->
				</li>
			</ul><!-- navbar-right -->
		</div><!-- col-md-6 -->
	 </div><!-- row -->
    </div><!-- container top-bar-->
	
  <div class="container  no-print">
	<div class="row">
	  <div class="col-md-2 menu-logo">
	  	<a href="#"><img alt="logo" src="assets/images/logo.png"></a>
	  </div> <!-- col-md-2 -->

	 <div class="col-md-10 nopadding">
	 <nav class="dashboard-menu navbar navbar-default">
	    <div class="container-fluid nopadding">
	      <!-- Brand and toggle get grouped for better mobile display -->
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </button>
	      </div>

	     
	      <!-- Collect the nav links, forms, and other content for toggling -->
	      <div class="navbar-collapse collapse in" id="bs-example-navbar-collapse-1" aria-expanded="true">
	        <ul class="nav navbar-nav">
			
			
			 <li class="dashboard-li dropdown">
			 
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	            	Movie
	            	<span class="desc">Your guide to setting</span>
					<span class="desc">up Imagiacian</span>
					<img class="down_caret" src="assets/images/down_caret.png"></a>
				<?php if(in_array('add_film', $user_capabilities)){?>
	            <ul class="dropdown-menu">
		             
				     <li><a href="view_movie.php">Films</a></li>
				     <li><a href="view_distributer.php">Distributers</a></li> 
				     <li><a href="view_showtime.php">Scheduling</a></li> 
		     	 </ul>
				 <?php }?>
	          </li>
			  

	           <li class="dashboard-li">
	           	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	            	Ticket
	          	<span class="desc">Your guide to setting</span>
				<span class="desc">up Imagiacian</span>
				<img class="down_caret" src="assets/images/down_caret.png"></a>
				<?php if(in_array('add_ticket', $user_capabilities)){?>
				<ul class="dropdown-menu">
		             
				     <li><a href="view_ticket.php">Ticket Types</a></li>
	
		     	 </ul>
				 <?php }?>
	            </li>

	            <li class="dashboard-li  dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		            Concessions 
		            <span class="desc">Your guide to setting</span>
					<span class="desc">up Imagiacian</span>
		            <img class="down_caret" src="assets/images/down_caret.png"></a>
					<?php if(in_array('add_concession', $user_capabilities)){?>
		            <ul class="dropdown-menu">
		              <li><a href="view_item.php">Items</a></li>
		   			  <li><a href="view_package.php">Packages</a></li>
		   			  <li><a href="view_foodstall.php">Food stalls</a></li>
		            </ul>
					<?php }?>
	          </li>
	          
	          <li class=" dashboard-li  dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	           	 Corporate sales
	            <span class="desc">Your guide to setting</span>
				<span class="desc">up Imagiacian</span>
	            <img class="down_caret" src="assets/images/down_caret.png"></a>
				
				<?php if(in_array('add_voucher', $user_capabilities)){?>
	            <ul class="dropdown-menu">
	              <li><a href="view_voucher.php">Vouchers</a></li>
	              <li><a href="view_private_showtime.php">Show Timings</a></li>
	    		  <li><a href="add_private_showtime.php">Theaters schedule</a></li>
	            </ul>
				<?php }?>
				
	          </li>

	          <li class="dashboard-li dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	            	Report 
					<span class="desc">Your guide to setting</span>
					<span class="desc">up Imagiacian</span>
	            <img class="down_caret" src="assets/images/down_caret.png"></a>
	           <?php if(in_array('view_reports', $user_capabilities)){?>
			   <ul class="dropdown-menu">
	             <li><a href="view_movie_reports.php">Movie</a></li>
			     <li><a href="view_concession_reports.php">Concession</a></li>
			     <li><a href="view_ticket_reports.php">Custom reports</a></li>
			    </ul>
				<?php }?>
	          </li>

	           
	        </ul>
	      </div><!-- /.navbar-collapse -->
	    </div><!-- /.container-fluid -->
	  </nav>
	  </div><!-- col-md-10 -->
	</div><!-- row -->
  </div><!-- container -->
	 
   <!--/header-->
