<?php require_once 'header.php'; ?>
<?php 
	
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_screen', $user_capabilities)){	
		
	
?>

<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_screen.php">Screens</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Screen</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Screen Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_screen"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Film' ?>  </button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 
			$screen = new screen();
			
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_screen'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $screen->update_screen($_POST, $ID);
					
				}else{ // Insert new
					$results = $screen->insert_screen($_POST);
					
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added screen Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$screen_result = $screen->get_screens($ID);
				
				//print_f($screen_seats_result);

			}
			?>
		<div class="row">
	
			<div class="form-container">
			<div class="col-md-6">
				<div class="col-md-12">	
					<div class="form-group">
						<label for="screen_name" class="col-sm-4 control-label"><span>* </span>Screen Name: </label>
						<div class="col-sm-8">
							<input type="text" name="screen_name" id="screen_name" value="<?php echo (isset($ID))? $screen_result->screen_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="screen_total_seats" class="col-sm-4 control-label"><span>* </span> Total Seats: </label>
						<div class="col-sm-8">
							<input type="text" name="screen_total_seats" id="screen_total_seats" value="<?php echo (isset($ID))? $screen_result->screen_total_seats : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="screen_house_seats" class="col-sm-4 control-label"><span>* </span> House Seats: </label>
						<div class="col-sm-8">
							<input type="text" name="screen_house_seats" id="screen_house_seats" value="<?php echo (isset($ID))? $screen_result->screen_house_seats : '0' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="screen_wheel_chair_seats" class="col-sm-4 control-label">Wheel Chair Seats: </label>
						<div class="col-sm-8">
							<input type="text" name="screen_wheel_chair_seats" id="screen_wheel_chair_seats" value="<?php echo (isset($ID))? $screen_result->screen_wheel_chair_seats : '' ?>" class="form-control" >
						</div>
					</div>
				</div>

				
			
			</div><!-- col-md-6 -->

			<div class="col-md-4 col-md-offset-2">
				<?php 
					        if(isset($ID)){
					         if($screen_result->screen_seat_layout_diagram){ ?>
					          <div class="profilePic">
					           <span>
					            <?php echo '<img src="assets/images/uploads/'.$screen_result->screen_seat_layout_diagram.'" class="img-responsive" alt="">'; ?>
					            <a id="removeProfilePic"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
					           </span>
					           <input type="hidden" name="screen_seat_layout_diagram1" value="<?php echo $screen_result->screen_seat_layout_diagram; ?>">
					          </div>

					          <div class="form-group" id="showNewPicSubmit" style="display:none;">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="file" name="screen_seat_layout_diagram" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
							<?php
					         }
					         else { ?>
					          <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="screen_seat_layout_diagram" id="photo" readonly>
									 <input type="file" name="screen_seat_layout_diagram" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					         <?php
					         }
					        } else { ?>
					         <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="screen_seat_layout_diagram" id="photo" readonly>
									 <input type="file" name="screen_seat_layout_diagram" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					        <?php
					        }
					        ?>
			</div><!-- col-md-6 -->

	<div class="col-md-12 bottom-label">
		<div class="col-md-6">
			<h3>Rows and Seats count.</h3>
			<span>Add or remove Rows and their seats for this screen below</span>
		</div>

		<div class="col-md-6 form-header-right">
			<button type="button" class="btn submitBtn person_btn save-button" value="" onclick="addRow()">Add Row</button>
		</div>
	</div><!-- col-md-12 -->


			<div class="col-md-12 ">
					<div id="content">
					<?php if(isset($ID)){
							$counter = 0;
							$current_rows = $screen_result->screen_rows;
							$current_rows = (!empty($current_rows))? json_decode($current_rows) : array();

							$current_column = $screen_result->screen_row_column;
							$current_column = (!empty($current_column))? json_decode($current_column) : array();?>

						<?php foreach ($current_rows as $current_rows_values) {?>
		
							<div class="row">
							<div class="col-md-12 row-el">
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-sm-4 control-label">Row</label>
										<div class="col-sm-8">
											<input type="text" name="screen_rows[]" id="screen_rows" value="<?php echo $current_rows_values; ?>" class="form-control" required>
										</div>
								  	</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label class="col-sm-5 control-label">Seats per Row</label>
										<div class="col-sm-6">
											<input type="number" name="screen_row_column[]" id="screen_row_column" value="<?php echo $current_column[$counter]; ?>" class="form-control" required>
										</div>
									</div>
								</div>
									<div class="col-md-3 txt-center">
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>
									</div>
								</div>
								</div>
						<?php $counter++; ?>
						<?php }?>
						<?php }?>
					</div><!-- #Content CLose -->
				</div><!-- col-md-12 -->	

		 </div><!-- form-container -->
	  </form>
 </div><!-- form-container -->

<?php require_once 'include/short_scripts/screen_script.php'; ?>
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>