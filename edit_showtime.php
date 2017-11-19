<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_sowtime', $user_capabilities)){	
		
	
?>

	<div class="container">

	<div class="row">
		<div class="col-md-8">
			<ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			  <li><a href="view_showtime.php">Show times</a></li>
			  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Show times</li>
			</ol>
		</div>

		<div class="col-md-4 form-horizontal" style="position:relative;">
		<div class="alert alert-danger" id="invalid_time" style="display:none;position:absolute;" role="alert">Invalid Time!</div>
			<label for="itemname" class="col-sm-3 control-label" style=" padding-top: 15px;">Go Date: </label>
				<div class="col-sm-7">
					<div class="input-group date" style="margin-top: 10px; margin-bottom: 10px;">
				        <input type="date" id="animateDate" class="form-control">
				        <span class="input-group-addon" id="go" onclick="go()">
				            <span class="glyphicon glyphicon-calendar"></span>
				        </span>
				    </div>
				</div>
		</div>

	</div><!--row-->

<div class="row">
		<div class="col-md-12 col-sm-12 timeline">
			<div id="mytimeline"></div>
		</div>
	</div><!-- row -->
<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Showtime Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_showtime"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Show time' ?>  </button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 

			$movie = new movie();
			$all_movie = $movie->get_movies();

			$ticket = new ticket();
			$all_ticket = $ticket->get_tickets();

			$screen = new screen();
			$all_screen = $screen->get_screens();

			$setting = new setting();
			$timing_result = $setting->get_timings();
			$timings_val = $timing_result[0]->setting_value;
			$timings_val = (!empty($timings_val))? json_decode($timings_val) : array();

			$showtime = new showtime();
			

			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_showtime'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $showtime->update_showtime($_POST, $ID);
				}else{ // Insert new
					
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added showtime Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$showtime_result = $showtime->get_public_showtimes($ID);
			}

			?>
	<div class="form-container">
				
	<div class="col-md-6">
				<div class="col-md-12">	
					<div class="form-group">
						<label for="showtime_movie_id" class="col-sm-4 control-label"><span>* </span> Show Movie: </label>
						<div class="col-sm-8">
							<select class="form-control" id="showtime_movie_id" name="showtime_movie_id" required>
								<option value="" selected disabled >Select below</option>
								<?php 
								foreach ($all_movie as $value){ ?>

									<option value="<?php echo $value->movie_id; ?>" <?php (isset($ID))? $movie_name = $showtime_result->showtime_movie_id : ''; if(isset($ID)){if($value->movie_id == $movie_name){echo 'selected=selected';}}?>><?php echo $value->movie_title; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="showtime_screen_id" class="col-sm-4 control-label"><span>* </span> Show Screen: </label>
						<div class="col-sm-8">
							<select class="form-control " name="showtime_screen_id" id="showtime_screen_id" required>
								<option value="" selected disabled >Select below</option>
								<?php 
								foreach ($all_screen as $screen_value){ ?>
									<option value="<?php echo $screen_value->screen_id; ?>" <?php (isset($ID))? $screen_name = $showtime_result->showtime_screen_id : ''; if(isset($ID)){if($screen_value->screen_id == $screen_name){echo 'selected=selected';}}?>><?php echo $screen_value->screen_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>


				<div class="col-md-12">	
					<div class="form-group">
						<label for="showtime_ticket_type" class="col-sm-4 control-label"><span>* </span> Ticket type: </label>
						<div class="col-sm-8">
							<select class="form-control" name="showtime_ticket_type" required>
								<option value="" selected disabled >Select below</option>
								<?php 
								foreach ($all_ticket as $value){ ?>
									<option value="<?php echo $value->ticket_id; ?>" <?php (isset($ID))? $ticket_name = $showtime_result->showtime_ticket_type : ''; if(isset($ID)){if($value->ticket_id == $ticket_name){echo 'selected=selected';}}?>><?php echo $value->ticket_title; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="clear"></div>

			</div><!-- col-md-6 -->

			<div class="col-md-6">

			<div class="col-md-11 col-md-offset-1">	
					<div class="form-group">
						<label for="showtime_status" class="col-sm-4 control-label"><span>* </span>Status: </label>
						<div class="col-sm-4">
							<select class="form-control status" name="showtime_status" required>
								<?php foreach($showtime_status as $showtime_status_key => $showtime_status_value){ ?>
									<option value="<?php echo $showtime_status_key; ?>" <?php (isset($ID))? $selected_showtime_status = $showtime_result->showtime_status : '';if(isset($ID)){if($showtime_status_key == $selected_showtime_status){echo 'selected=selected';}}?> ><?php echo $showtime_status_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				

				<div class="col-md-11 col-md-offset-1">	
					<div class="form-group">
						<label for="showtime_complimentry_seats" class="col-sm-4 control-label"><span>* </span>Allow complimentry: </label>
						<div class="col-sm-8">
							<select class="form-control" name="showtime_complimentry_seats" required>
								<option value="" selected disabled>Select below</option>
								<?php foreach($normal_option as $normal_option_key => $normal_option_value){ ?>
									<option value="<?php echo $normal_option_key; ?>" <?php (isset($ID))? $selected_comlimentry_status = $showtime_result->showtime_complimentry_seats : '';if(isset($ID)){if($selected_comlimentry_status == $normal_option_key){echo 'selected=selected';}}?> ><?php echo $normal_option_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-md-11 col-md-offset-1">	
					<div class="form-group">
						<label for="showtime_color" class="col-sm-4 control-label">Timeline color: </label>
						<div class="col-sm-8">
							<select class="form-control" name="showtime_color">
								<option value="" selected disabled>Select below</option>
								<?php foreach($showtime_color as $showtime_color_key => $showtime_color_value){ ?>
									<option value="<?php echo $showtime_color_key; ?>" <?php (isset($ID))? $selected_showtime_color = $showtime_result->showtime_color : '';if(isset($ID)){if($showtime_color_key == $selected_showtime_color){echo 'selected=selected';}}?> ><?php echo $showtime_color_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				
				<input type="hidden" name="showtime_trailer_duration" id="showtime_trailer_duration" value="<?php echo (isset($ID))? $showtime_result->showtime_trailer_duration : $timings_val[0] ?>" class="form-control "  >
			
				<input type="hidden" name="showtime_interval" id="showtime_interval" value="<?php echo (isset($ID))? $showtime_result->showtime_interval : $timings_val[1] ?>" class="form-control "  >
			
				<input type="hidden" name="showtime_cleanup" id="showtime_cleanup" value="<?php echo (isset($ID))? $showtime_result->showtime_cleanup : $timings_val[2] ?>" class="form-control "  >
			
				<div class="col-md-11 col-md-offset-1">	
					<div class="form-group">
						<div class="col-sm-8">
							<input type="hidden" name="showtime_key" id="showtime_key" value="<?php echo (isset($ID))? $showtime_result->showtime_key : 'public' ?>" class="form-control"  >
							<input type="hidden" name="showtime_voucher_type" id="showtime_voucher_type" value="" class="form-control"  >
						
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

			</div><!-- col-md-6 -->

			<div class="col-md-12">
			

				<div class="col-md-6 nopadding" id="content1">
						
						<div class="col-md-12 row-el">	
							<div class="form-group">
								<label for="showtime_datetime" class="col-sm-4 control-label"><span>* </span>Show Date & Timings: </label>
								<div class="col-sm-8">
									<input type="text" name="<?php if((isset($ID))){ echo 'showtime_datetime';}else {echo 'showtime_datetime[]';} ?>" id="showtime_datetime" value="<?php echo (isset($ID))? $showtime_result->showtime_datetime : '' ?>" class="datetimepicker form-control " placeholder="Insert date time" required>
								</div>
							</div>
							<div class="clear"></div>
						</div>

			
					
			</div>
			<?php if(!isset($_GET['id'])){?>
			<div class="col-md-2">
				<button type="button" style="margin-left: -85px;padding: 4px 10px;" class="btn submitBtn save-button " value="" onclick="addRow1()">Add another time</button>
			</div>
			<?php }?>

			<div class="col-md-12" >
				<div class="col-sm-6">
						<div id="time_confilict" class="time_confilict alert alert-danger" role="alert" style="display:none;">  </div>
				</div>
			</div>

			</div>	<!-- col-md-12 -->
		 </div><!-- form-container -->
	  </form>

<?php require_once 'include/short_scripts/showtime_script.php'; ?>

<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>