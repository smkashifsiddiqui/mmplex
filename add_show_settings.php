<?php require_once 'header.php'; ?>


<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> General Settings</li>
		</ol>
	</div><!--row-->

		<div class="row form-header">
				<div class="col-md-12">
			 		<h3><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> General Settings</h3>
			 	</div>
		  </div><!--row-->
			
			
			<?php 
			$setting = new setting();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_show_settings'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $movie->update_show_settings($_POST, $ID);
				}else{ // Insert new
					$results = $movie->insert_show_settings($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$show_settings_result = $movie->get_show_settings($ID);
			}
			?>
			
<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row">
		<div class="form-container">
				<div class="col-md-12 top-label">
					<div class="col-md-6">
						<h3>Show Settings: <span>These settings change your default settings for the non movie time of each show</span></h3>
						
				 	</div>
					<div class="col-md-6 form-header-right">
						<button type="submit" class="btn submitBtn save-button" name="add_show_settings"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Show Settings </button>
					</div>
				</div>

				<div class="col-md-7">
						<div class="col-md-12">
							<div class="form-group">
								<label for="clean_uptime" class="col-sm-5 control-label">Default Cleanup time: </label>
								
								<div class="col-sm-7">
									<input type="text" name="clean_uptime" id="clean_uptime" value="<?php echo (isset($ID))? $movie_result->movie_title : '' ?>" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="trailer_duration" class="col-sm-5 control-label">Default Trailer Duration: </label>
								<div class="col-sm-7">
									<input type="text" name="trailer_duration" id="trailer_duration" value="<?php echo (isset($ID))? $movie_result->movie_title : '' ?>" class="form-control" required>
									<!-- -->
								</div>
							</div>
						</div>

						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="intermission_duration" class="col-sm-5 control-label">Intermission Duration: </label>
								<div class="col-sm-7">
									<input type="text" name="intermission_duration" id="intermission_duration" value="<?php echo (isset($ID))? $movie_result->movie_rating : '' ?>" class="form-control" >
								</div>
							</div>
						</div>

					<div class="clear"></div>

					</div><!-- col-md-6 -->

						<div class="col-md-5">

						</div><!-- col-md-6 -->
				
						<div class="col-md-12 bottom-label">
							<div class="col-md-6">
								<h3>Concessions.</h3>
								<span>These settings change the default settings for all concessions</span>
						 	</div>

							<div class="col-md-6 form-header-right">
								
							</div>
						</div>

				<div class="col-md-12 ">
					<div class="col-md-7">
						<div class="form-group">
						<label for="concession_unit" class="col-sm-5 control-label">Default Unit of Measure: </label>
							<div class="col-sm-7">
								<select name="concession_unit" class="form-control">
								<option>each</option>
								<option>each</option>
								</select>
							</div>
						</div>

						<div class="form-group">
						<label for="concession_value" class="col-sm-5 control-label">Weight-based Sweets Min. Value: </label>
							<div class="col-sm-7">
								<input type="text" name="concession_value" id="concession_value" value="<?php echo (isset($ID))? $movie_result->movie_rating : '' ?>" class="form-control" >
							</div>
						</div>
					</div><!-- col-md-6 -->

					<div class="col-md-5">

					</div><!-- col-md-6 -->
				</div><!-- col-md-12 -->	
					
					</div><!-- form-container -->
				</div><!-- col-md-12 -->
			
		</form>
	</div><!-- Container Close -->
<?php require_once 'footer.php'; ?>