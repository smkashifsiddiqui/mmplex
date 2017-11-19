<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('add_user', $user_capabilities)){	
		
	
?>



<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_user.php">Users</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?>User</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> User Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_user"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add User' ?>  </button>

				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->


<?php 
			$user = new user();

			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;

			if (isset($_POST['add_user'])) {
				// Update old record
				if (isset($ID)) {
					$results = $user->update_user($_POST, $ID);
				}else{ // Insert new
					$results = $user->add_user($_POST);
				}

				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added User Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			} 

			if (isset($ID)) {
				$user_result = $user->get_users($ID);
				//print_f($user_result);

			}
			?>



	<div class="row">
		<div class="form-container">
				
			<div class="col-md-6">
					<div class="col-md-12">
						<div class="form-group">
							<label for="fname" class="col-sm-4 control-label">First Name: </label>
							
							<div class="col-sm-8">
								<input type="text" class="form-control" name="fname" id="fname" value="<?php echo (isset($ID))? $user_result->user_fname : '' ?>" required>
							</div>
						</div>
					</div>
					

					<div class="col-md-12">
						<div class="form-group">
							<label for="lname" class="col-sm-4 control-label">Last Name: </label>
							
							<div class="col-sm-8">
								<input type="text" class="form-control" name="lname" id="lname" value="<?php echo (isset($ID))? $user_result->user_lname : '' ?>" required>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="email" class="col-sm-4 control-label">Email: </label>
							
							<div class="col-sm-8">
								<input type="email" class="form-control" name="email" id="email" value="<?php echo (isset($ID))? $user_result->user_email : '' ?>" required>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="username" class="col-sm-4 control-label">Username: </label>
							
							<div class="col-sm-8">
								<input type="text" class="form-control" name="username" id="username" value="<?php echo (isset($ID))? $user_result->user_name : '' ?>" required>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="username" class="col-sm-4 control-label">Password: </label>
							
							<div class="col-sm-8">
								<input type="password" class="form-control" name="password" id="password" value="" placeholder="new password" >
								<input type="hidden" class="form-control" name="old_password" id="password" value="<?php echo (isset($ID))? $user_result->user_pass : '' ?>" >
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="password" class="col-sm-4 control-label">Mobile: </label>
							
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo (isset($ID))? $user_result->user_mobile : '' ?>" required>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="city" class="col-sm-4 control-label">City: </label>
							
							<div class="col-sm-8">
								<input type="text" class="form-control" name="city" id="city" value="<?php echo (isset($ID))? $user_result->user_city : '' ?>" required>
							</div>
						</div>
					</div>

				<div class="col-md-12">
						<div class="form-group">
							<label for="city" class="col-sm-4 control-label">Salary: </label>
							
							<div class="col-sm-8">
								<input type="text" class="form-control" name="salary" id="salary" value="<?php echo (isset($ID))? $user_result->user_salary : '' ?>" required>
							</div>
						</div>
					</div>


					<div class="col-md-12">
						<div class="form-group">
							<label for="permission" class="col-sm-4 control-label">Permission Allow: </label>
							
							<div class="col-sm-8">
								<?php 
								foreach($capabilities as $capability=>$value){
									?>
										<?php
										if(isset($ID)){
											$user_capabilities = $user_result->user_capabilities;
											$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
										} 

											?>
											<div class="checkbox">
											    <label>
											      <input type="checkbox" name="capabilities[]" <?php echo ((isset($ID)) && (!empty($user_capabilities)) && (in_array($capability, $user_capabilities)))? 'checked' : ''; ?>  value="<?php echo $capability; ?>"><?php echo $value; ?>
											    </label>
											  </div>
									<?php
									}
								?>
							</div>
						</div>
					</div>

			</div><!-- col-md-6 -->

			<div class="col-md-4 col-md-offset-2">

		

			<div class="col-md-12 item_img">
				
				<div class="col-md-12 movie-poster">
							<?php 
					        if(isset($ID)){
					         if($user_result->user_img){ ?>
					          <div class="profilePic">
					           <span>
					            <?php echo '<img src="assets/images/uploads/'.$user_result->user_img.'" class="img-responsive" alt="">'; ?>
					            <a id="removeProfilePic"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
					           </span>
					           <input type="hidden" name="user_img1" value="<?php echo $user_result->user_img; ?>">
					          </div>

					          <div class="form-group" id="showNewPicSubmit" style="display:none;">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="file" name="user_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
							<?php
					         }
					         else { ?>
					          <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="user_img" id="photo" readonly>
									 <input type="file" name="user_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					         <?php
					         }
					        } else { ?>
					         <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="user_img" id="photo" readonly>
									 <input type="file" name="user_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					        <?php
					        }
					        ?>
							</div>

			</div>
			</div><!-- col-md-6 -->
				
					</div><!-- form-container -->
				</div><!-- row -->
		</form>
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>
