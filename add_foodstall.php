<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('add_foodstall', $user_capabilities)){	
		
	
?>


	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_foodstall.php">Food Stalls</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Food Stall</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Food Stall Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_foodstall"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Food Stall' ?>  </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 

			$foodstall = new foodstall();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_foodstall'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $foodstall->update_foodstall($_POST, $ID);
				}else{ // Insert new
					$results = $foodstall->insert_foodstall($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added food stall Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$foodstall_result = $foodstall->get_foodstalls($ID);
			}
			?>

	
			<div class="form-container">
				

			<div class="col-md-6">
				<div class="col-md-12">	
					<div class="form-group">
						<label for="foodstall_name" class="col-sm-4 control-label"><span>* </span>Stall Name: </label>
						<div class="col-sm-8">
							<input type="text" name="foodstall_name" id="foodstall_name" value="<?php echo (isset($ID))? $foodstall_result->foodstall_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="foodstall_size" class="col-sm-4 control-label"><span>* </span>Size: </label>
						<div class="col-sm-8">
							<input type="text" name="foodstall_size" id="foodstall_size" value="<?php echo (isset($ID))? $foodstall_result->foodstall_size : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_name" class="col-sm-4 control-label"><span>* </span>Contract Type: </label>
						<div class="col-sm-8">
							<select class="form-control" name="foodstall_contract_type" required>
								<?php foreach($stall_contract_type as $stall_contract_type_key => $stall_contract_type_value){ ?>
									<option value="<?php echo $stall_contract_type_key; ?>" <?php (isset($ID))? $selected_stall_contract_type_ = $foodstall_result->foodstall_contract_type : '';if(isset($ID)){if($stall_contract_type_key == $selected_stall_contract_type_){echo 'selected=selected';}}?> ><?php echo $stall_contract_type_value; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="foodstall_contract_amount" class="col-sm-4 control-label"><span>* </span>Amount: </label>
						<div class="col-sm-8">
							<input type="text" name="foodstall_contract_amount" id="foodstall_contract_amount" value="<?php echo (isset($ID))? $foodstall_result->foodstall_contract_amount : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="foodstall_date" class="col-sm-4 control-label"><span>* </span>Contract Date: </label>
						<div class="col-sm-8">
							<input type="text" name="foodstall_date" id="foodstall_date" value="<?php echo (isset($ID))? $foodstall_result->foodstall_date : '' ?>" class="form-control datetimepicker" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="foodstall_desc" class="col-sm-4 control-label">Description: </label>
						<div class="col-sm-8">
							<textarea name="foodstall_desc" id="foodstall_desc" row="5" class="form-control" style="height: 80px;"><?php echo (isset($ID))? $foodstall_result->foodstall_desc : '' ?></textarea>
						</div>
					</div>
				</div>
				<div class="clear"></div>

		    	
			</div><!-- col-md-6 -->

			<div class="col-md-offset-2 col-md-4">

			<div class="col-md-8">	
					<div class="form-group">
						<label for="foodstall_status" class="col-sm-4 control-label"><span>* </span>Status: </label>
						<div class="col-sm-8">
						<select class="status form-control" name="foodstall_status" required>
								<?php foreach($status as $item_status_key => $item_status_value){ ?>
									<option value="<?php echo $item_status_key; ?>" <?php (isset($ID))? $selected_item_status = $foodstall_result->foodstall_status : '';if(isset($ID)){if($item_status_key == $selected_item_status){echo 'selected=selected';}}?> ><?php echo $item_status_value; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

				
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