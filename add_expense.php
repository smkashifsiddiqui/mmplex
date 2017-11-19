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
		  <li><a href="view_expense.php">Expense</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Expense Details</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Expense Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_expense"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add expense' ?>  </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 

			$expense = new expense();
			
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_expense'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $expense->update_expense($_POST, $ID);
				}else{ // Insert new
					$results = $expense->insert_expense($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added Expense Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$expense_result = $expense->get_expenses($ID);
			}
			?>

	
			<div class="form-container">
				

			<div class="col-md-6">
			
			<div class="col-md-12">	
					<div class="form-group">
						<label for="expense_amont" class="col-sm-4 control-label"><span>* </span>Expense Name: </label>
						<div class="col-sm-8">
							<input type="text" name="expense_name" id="expense_name" value="<?php echo (isset($ID))? $expense_result->expense_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				
				
				<div class="col-md-12">	
					<div class="form-group">
						<label for="expense_amont" class="col-sm-4 control-label"><span>* </span>Expense Amount: </label>
						<div class="col-sm-8">
							<input type="text" name="expense_amount" id="expense_amount" value="<?php echo (isset($ID))? $expense_result->expense_amount : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="expense_detail" class="col-sm-4 control-label"><span>* </span>Expense Description: </label>
						<div class="col-sm-8">
							<input type="text" name="expense_detail" id="expense_detail" value="<?php echo (isset($ID))? $expense_result->expense_detail : '' ?>" class="form-control" required>
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