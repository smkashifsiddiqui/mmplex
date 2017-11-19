<?php require_once 'header.php'; ?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_timing', $user_capabilities)){	
		

?>


<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li>Settings</li>
		  <li class="active">Timings</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Timing Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_timing">Save Changes </button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 
			$timing = new setting();
			$timing_result = $timing->get_timings();
			$timings_val = $timing_result[0]->setting_value;
			$timings_val = (!empty($timings_val))? json_decode($timings_val) : array();

			if (isset($_POST['add_timing'])) {		
				// Update old record
				if ($timing_result) {
					$ID = $timing_result[0]->setting_id;
					$results = $timing->update_timing($_POST, $ID);
					
				}else{ // Insert new
					$results = $timing->insert_timing($_POST);
					
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added timings Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
		
			if (isset($_POST['add_timing'])) {
					$timing_result = $timing->get_timings();
					$timings_val = $timing_result[0]->setting_value;
					$timings_val = (!empty($timings_val))? json_decode($timings_val) : array();
				}
				
				
			?>
		<div class="row">
	
			<div class="form-container" style="padding-top:0px;">
			<div class="col-md-12 bottom-label" style="margin-bottom:20px;">
				<p style="font-size: 16px; padding: 5px;">These settings change your default settings for the non movie time of each show</p>
			</div>

			<div class="col-md-6">
				<div class="col-md-12">	
					<div class="form-group">
						<label for="timing_cleanup" class="col-sm-4 control-label"><span>* </span>Trailor Duration: </label>
						<div class="col-sm-8">
							<input type="number" min="0" name="timing[]" id="timing_cleanup" value="<?php echo $timings_val[0]; ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="timing_interval" class="col-sm-4 control-label"><span>* </span> Interval Duration: </label>
						<div class="col-sm-8">
							<input type="number" min="0" name="timing[]" id="timing_interval" value="<?php echo $timings_val[1]; ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="timing_trailor" class="col-sm-4 control-label"><span>* </span> Cleanup Duration: </label>
						<div class="col-sm-8">
							<input type="number" min="0" name="timing[]" id="timing_trailor" value="<?php echo $timings_val[2]; ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				

		 </div><!-- form-container -->
	  </form>
 </div><!-- form-container -->
</div>
</div>
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>