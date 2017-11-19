<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_settings', $user_capabilities)){	
		
	
?>


	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Add Logo</li>
		</ol>
	</div><!--row-->
	
<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Logo image</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_logo">Submit </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
			<?php 
				$timing = new setting();
				$timing_result = $timing->get_logo();
				
				
				if (isset($_POST['add_logo'])) {		
					// Update old record
					
						$results = $timing->update_logo($_FILES);

					if ($results) {
						echo '<div class="alert alert-success" role="alert"> Added timings Sucessfully </div>';
						$timing_result = $timing->get_logo();
						
					}else{
						echo '<div class="alert alert-danger" role="alert"> Error </div>';
					}
					
					
				}	
			?>
			<div class="form-container">
				<div class="col-md-6">
					<div class="col-md-12 item_img">
					  <div class="form-group">
						<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
						<div class="col-sm-10">
							
							<input type="file" name="logo" class="form-control" value="<?php echo $timing_result[0]->setting_value; ?>" style="width:100%;height: 33px;">
						</div>
					 </div>					       
					</div>
				</div><!-- col-md-6 -->
				
				<div class="col-md-6">
					<div class="col-md-12 item_img">
					  <img src="assets/images/uploads/<?php echo $timing_result[0]->setting_value; ?>"/>			       
					</div>
				</div><!-- col-md-6 -->
				
			</div><!-- form-container -->
			
			
				
			
	  </form>
	  </div>
	</div><!-- Container Close -->
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>