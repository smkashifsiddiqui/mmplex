<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_distributer', $user_capabilities)){	
		
	
?>


	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_distributer.php">Distributer</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Distributer</li>
		</ol>
	</div><!--row-->
<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Distributer Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="add_movie">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_distributer"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Distributer' ?>  </button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
	
			<?php 
			$distributer = new distributer();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_distributer'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $distributer->update_distributer($_POST, $ID);
				}else{ // Insert new
					$results = $distributer->insert_distributer($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added distributer Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$distributer_result = $distributer->get_distributers($ID);
			}
			?>

	
			<div class="form-container">
				
			<div class="col-md-6">
				<div class="col-md-12">	
					<div class="form-group">
						<label for="itemname" class="col-sm-4 control-label"><span>* </span>Distributer Name: </label>
						<div class="col-sm-8">
							<input type="text" name="dist_name" id="dist_name" value="<?php echo (isset($ID))? $distributer_result->dist_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="dist_description" class="col-sm-4 control-label">Established year: </label>
						<div class="col-sm-8">
							<input type="text" name="dist_established_year" id="dist_established_year" value="<?php echo (isset($ID))? $distributer_result->dist_established_year : '' ?>" class="form-control" >
						</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="dist_description" class="col-sm-4 control-label">Description: </label>
						<div class="col-sm-8">
							<textarea name="dist_description" id="dist_description" row="5" class="form-control" style="height: 80px;"><?php echo (isset($ID))? $distributer_result->dist_description : '' ?></textarea>
						</div>
					</div>
				</div>

				<div class="clear"></div>
				
			
			</div><!-- col-md-6 -->

			<div class="col-md-6">
			</div><!-- col-md-6 -->
		 </div><!-- form-container -->
	  </form>
	</div><!-- Container Close -->
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>