<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_concession', $user_capabilities)){	
		
	
?>


	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_payroll.php">Payroll</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Payslip Details</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Payslip Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_payslip"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add payslip' ?>  </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 

			$payslip = new payslip();
			
			$user = new user();
			$all_user = $user->get_users();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_payslip'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $payslip->update_payslip($_POST, $ID);
				}else{ // Insert new
					$results = $payslip->insert_payslip($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added payslip Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$expense_result = $payslip->get_payslips($ID);
			}
			?>

	
			<div class="form-container">
				

			<div class="col-md-6">
			
			<div class="col-md-12">	
					<div class="form-group">
						<label for="payroll_amount" class="col-sm-4 control-label"><span>* </span>Payroll Amount: </label>
						<div class="col-sm-8">
							<input type="text" name="payroll_amount" id="payroll_amount" value="<?php echo (isset($ID))? $expense_result->payroll_amount : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				
				
				<div class="col-md-12">	
					<div class="form-group">
						<label for="payroll_emp_id" class="col-sm-4 control-label"><span>* </span>Employee: </label>
						<div class="col-sm-8">
							<select class="form-control" name="payroll_emp_id" required>
								<option value="" selected disabled>Select</option>
								<?php foreach ($all_user as $value){ ?>
									<option value="<?php echo $value->user_id; ?>" <?php (isset($ID))? $dist_name = $expense_result->payroll_emp_id : ''; if(isset($ID)){if($value->user_id == $dist_name){echo 'selected=selected';}}?>><?php echo $value->user_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="payroll_for_date" class="col-sm-4 control-label"><span>* </span>For the Month: </label>
						<div class="col-sm-8">
							<input type="text" name="payroll_for_date" id="payroll_for_date" value="<?php echo (isset($ID))? $expense_result->payroll_for_date : '' ?>" class="form-control date_p" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<?php if (isset($ID)) {?>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="payroll_status" class="col-sm-4 control-label">Status: </label>
						<div class="col-sm-8">
						<select class="form-control status" name="payroll_status" style="width:80%!important;">
								<?php foreach($s_option as $s_option_key => $package_status_value){ ?>
									<option value="<?php echo $s_option_key; ?>" <?php (isset($ID))? $selected_status = $expense_result->payroll_status : '';if(isset($ID)){if($s_option_key == $selected_status){echo 'selected=selected';}}?> ><?php echo $package_status_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<?php }?>
				
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