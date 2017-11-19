<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_ticket', $user_capabilities)){	
		
	
?>


	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_ticket.php">Tickets</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Ticket</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Ticket Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_ticket"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Ticket' ?>  </button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->

			<?php 
			$item = new item();
			$all_item = $item->get_items();

			$ticket = new ticket();
			$all_ticket = $ticket->get_tickets();

			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_ticket'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $ticket->update_ticket($_POST, $ID);
				}else{ // Insert new
					$results = $ticket->insert_ticket($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added ticket Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$ticket_result = $ticket->get_tickets($ID);
			}
			?>

	
			<div class="form-container" id="ticket_container">
				
			<div class="col-md-6">
			
				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="itemname" class="col-sm-4 control-label"><span>*</span> Ticket Name: </label>
						<div class="col-sm-8">
							<input type="text" name="ticket_title" id="ticket_title" value="<?php echo (isset($ID))? $ticket_result->ticket_title : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="ticket_desc" class="col-sm-4 control-label">Description: </label>
						<div class="col-sm-8">
							<input type="text" name="ticket_desc" id="ticket_desc" value="<?php echo (isset($ID))? $ticket_result->ticket_desc : '' ?>" class="form-control" >
						</div>
					</div>
				</div>

				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="ticket_class" class="col-sm-4 control-label">Ticket Class: </label>
						<div class="col-sm-8">
							<select class="form-control" name="ticket_class">
								<option value="" selected disabled>select</option>
								<?php foreach($ticket_class as $ticket_class_key => $ticket_class_value){ ?>
									<option value="<?php echo $ticket_class_key; ?>" <?php (isset($ID))? $selected_class = $ticket_result->ticket_class : '';if(isset($ID)){if($ticket_class_key == $selected_class){echo 'selected=selected';}}?> ><?php echo $ticket_class_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="ticket_ischild" class="col-sm-4 control-label"><span>*</span> Is Child: </label>
						<div class="col-sm-8">
							<select class="form-control" name="ticket_ischild" required>
								<option value="" selected disabled>select</option>
								<?php foreach($confirm as $confirm_key => $confirm_value){ ?>
									<option value="<?php echo $confirm_key; ?>" <?php (isset($ID))? $selected = $ticket_result->ticket_ischild : '';if(isset($ID)){if($confirm_key == $selected){echo 'selected=selected';}}?> ><?php echo $confirm_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="ticket_adult_price" class="col-sm-4 control-label"><span>*</span> Adult Ticket Price: </label>
						<div class="col-sm-8">
							<input type="text" name="ticket_adult_price" id="ticket_adult_price" value="<?php echo (isset($ID))? $ticket_result->ticket_adult_price : '' ?>" class="form-control" required >
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="ticket_child_price" class="col-sm-4 control-label">Child Ticket Price: </label>
						<div class="col-sm-8">
							<input type="text" name="ticket_child_price" id="ticket_child_price" value="<?php echo (isset($ID))? $ticket_result->ticket_child_price : '' ?>" class="form-control" >
						</div>
					</div>
				</div>
				
				<div class="clear"></div>
				

				<div class="col-md-12">	
					<div class="form-group">
						<label for="ticket_class" class="col-sm-4 control-label"><span>*</span> Ticket Type: </label>
						<div class="col-sm-8">
							<select class="form-control" name="ticket_type" required>
								<option value="" selected disabled>select</option>
								<?php foreach($ticket_type as $ticket_type_key => $ticket_type_value){ ?>
									<option value="<?php echo $ticket_type_key; ?>" <?php (isset($ID))? $selected_type = $ticket_result->ticket_type : '';if(isset($ID)){if($ticket_type_key == $selected_type){echo 'selected=selected';}}?> ><?php echo $ticket_type_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

			
			</div><!-- col-md-6 -->

			<div class="col-md-6">

				<div class="col-md-offset-5 col-md-7">	
					<div class="form-group">
						<label for="itemname" class=" col-sm-5 control-label"><span>*</span> Ticket Status: </label>
						<div class="col-sm-7">
							<select class="status form-control" name="ticket_status" required>
								<?php foreach($status as $ticket_status_key => $ticket_status_value){ ?>
									<option value="<?php echo $ticket_status_key; ?>" <?php (isset($ID))? $selected_status = $ticket_result->ticket_status : '';if(isset($ID)){if($ticket_status_key == $selected_status){echo 'selected=selected';}}?> ><?php echo $ticket_status_value; ?></option>
									<?php } ?>
							</select>
							
						</div>
					</div>
				</div>

			</div><!-- col-md-6 -->
			</div>
	  </form>
	</div><!-- Container Close -->
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>