<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_film', $user_capabilities)){	
		
	
?>


		<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_person.php">Persons</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?>Person</li>
		</ol>
	</div><!--row-->
<form class="form-horizontal dashboardForm"  action="" method="post">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Person Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_person"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Person' ?>  </button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			
			<?php 
			$person = new person();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_person'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $person->update_person($_POST, $ID);
				}else{ // Insert new
					$results = $person->insert_person($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added person Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$person_result = $person->get_persons($ID);
			}
			?>

		
				<div class="row">
					<div class="form-container">
						<div class="col-md-6">
						<div class="col-md-12">
							<div class="form-group">
								<label for="itemname" class="col-sm-4 control-label"><span>* </span>Person Name: </label>
								
								<div class="col-sm-8">
									<input type="text" name="movie_person_name" id="movie_person_name" value="<?php echo (isset($ID))? $person_result->movie_person_name : '' ?>" class="form-control" required>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						
					</div>
				</div><!-- form-container -->
			</div><!-- row -->
			
		</form>
	</div><!-- Container Close -->

<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>