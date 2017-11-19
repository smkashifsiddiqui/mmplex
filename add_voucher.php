<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_voucher', $user_capabilities)){	
		
	
?>

	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_voucher.php">Vouchers</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Voucher</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Voucher Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_voucher"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Voucher' ?>  </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->

			<?php 
			$item = new item();
			$all_item = $item->get_items();

			$ticket = new ticket();
			$all_ticket = $ticket->get_tickets();

			$voucher = new voucher();
			

			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_voucher'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $voucher->update_voucher($_POST, $ID);
				}else{ // Insert new
					$results = $voucher->insert_voucher($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added voucher Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$voucher_result = $voucher->get_vouchers($ID);
			}
			?>

		<div class="row">
			<div class="form-container" id="voucher_container">
				
			<div class="col-md-6">
			
				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="itemname" class="col-sm-4 control-label"><span>*</span> Voucher Name: </label>
						<div class="col-sm-8">
							<input type="text" name="voucher_title" id="voucher_title" value="<?php echo (isset($ID))? $voucher_result->voucher_title : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				
				
				<div class="col-md-12">	
					<div class="form-group">
						<label for="voucher_price" class="col-sm-4 control-label"><span>*</span> Voucher Price: </label>
						<div class="col-sm-8">
							<input type="text" name="voucher_price" id="voucher_price" value="<?php echo (isset($ID))? $voucher_result->voucher_price : '' ?>" class="form-control " readonly required >
						</div>
					</div>
				</div>
				
				<div class="clear"></div>


				<div class="col-md-12">	
					<div class="form-group">
						<label for="voucher_startdate" class="col-sm-4 control-label"><span>*</span> Start Date: </label>
						<div class="col-sm-8">
							<input type="text" name="voucher_startdate" id="date_timepicker_start" value="<?php echo (isset($ID))? $voucher_result->voucher_startdate : '' ?>" class="form-control datetimepicker" required >
						</div>
						
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="voucher_enddate" class="col-sm-4 control-label"><span>*</span> Expire Date: </label>
						<div class="col-sm-8">
							<input type="text" name="voucher_enddate" id="date_timepicker_end" value="<?php echo (isset($ID))? $voucher_result->voucher_enddate : '' ?>" class="form-control datetimepicker" required >
						</div>
						
					</div>
				</div>

				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="voucher_is_package" class="col-sm-4 control-label">Is Package: </label>
						<div class="col-sm-8">
							<select class="form-control" name="voucher_is_package">
								<option value="" selected disabled>select</option>
								<?php foreach($confirm as $confirm_key => $confirm_value){ ?>
									<option value="<?php echo $confirm_key; ?>" <?php (isset($ID))? $selected = $voucher_result->voucher_is_package : '';if(isset($ID)){if($confirm_key == $selected){echo 'selected=selected';}}?> ><?php echo $confirm_value; ?></option>
									<?php } ?>
							</select>
						
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="voucher_desc" class="col-sm-4 control-label">Description: </label>
						<div class="col-sm-8">
							<input type="text" name="voucher_desc" id="voucher_desc" value="<?php echo (isset($ID))? $voucher_result->voucher_desc : '' ?>" class="form-control" >
						</div>
					</div>
				</div>

				<div class="clear"></div>

				

			</div><!-- col-md-6 -->

			<div class="col-md-offset-3 col-md-3">

				<div class="col-md-12">	
					<div class="form-group">
						<label for="itemname" class=" col-sm-4 control-label"><span>*</span>Status: </label>
						<div class="col-sm-8">
							<select class="status form-control" name="voucher_status" required>
								<?php foreach($status as $voucher_status_key => $voucher_status_value){ ?>
									<option value="<?php echo $voucher_status_key; ?>" <?php (isset($ID))? $selected_status = $voucher_result->voucher_status : '';if(isset($ID)){if($voucher_status_key == $selected_status){echo 'selected=selected';}}?> ><?php echo $voucher_status_value; ?></option>
									<?php } ?>
							</select>
							
						</div>
					</div>
				</div>

			</div><!-- col-md-6 -->

			<div class="col-md-12 bottom-label">
				<div class="col-md-6">
					<h3>Items</h3>
						<span>Add or remove items and their details for this voucher</span>
					</div>

				<div class="col-md-6 form-header-right">
					<button type="button" class="person_btn btn submitBtn save-button" value="" onclick="addvoucher_item()">Add Item</button>
				</div>
			</div>

			<div class="col-md-12 label-container">
				<div class="col-md-3">
					Item Name
				</div>

				<div class="col-md-3">
					Item Price
				</div>

				<div class="col-md-3">
					Item Quantity
				</div>

				<div class="col-md-3">
				</div>
			</div><!-- col-md-12 -->

			<div class="col-md-12 ">
				<div id="voucheritemcontainer">
				<?php if(isset($ID)){
							$counter = 0;
							$current_items = $voucher_result->voucher_package_item_name;
							$current_items = (!empty($current_items))? json_decode($current_items) : array();

							$current_item_price = $voucher_result->voucher_package_item_price;
							$current_item_price = (!empty($current_item_price))? json_decode($current_item_price) : array();
							
							$current_item_qty = $voucher_result->voucher_package_item_qty;
							$current_item_qty = (!empty($current_item_qty))? json_decode($current_item_qty) : array();
							
							//print_f($current_item_price);
						?>
					<?php foreach ($current_items as $current_items_values) {?>
					<div class="row">
						<div class="col-md-12 row-el">
							<div class="col-md-3">
								<div class="item-group">
								   <select name="voucher_package_item_name[]" id="voucher_item<?php echo $counter;?>" class="voucher_package_item_name form-control" required>
										<option value="" selected disabled>select item</option>
										<?php foreach ($all_item as $all_item_key => $all_item_value) {?>
											 <option value="<?php echo $all_item_value->item_id;?>" <?php (isset($ID))? $selected_item_name = $current_items_values : '';if(isset($ID)){if($all_item_value->item_id == $selected_item_name){echo 'selected=selected';}} ?>><?php echo $all_item_value->item_name;?></option>
										<?php }?>
									</select>
									</div>
								</div><!-- col-md-4 -->	

								<div class="col-md-3">
									<div class="item-group">
										<input type="text" name="voucher_package_item_price[]" class="form-control voucher_itemprice voucher_item<?php echo $counter;?>price" value="<?php echo (isset($ID))? $current_item_price[$counter] : '' ?>" class="form-control"  readonly required>
									</div>
								</div><!-- col-md-4 -->	

								<div class="col-md-3">
									<div class="item-group">
										<input type="text" name="voucher_package_item_qty[]" class="form-control voucher_itemqty" value="<?php echo (isset($ID))? $current_item_qty[$counter] : '' ?>" class="form-control" required>
									</div>
												
								</div><!-- col-md-4 -->	

								<div class="col-md-2 col-md-offset-1 txt-center">
									<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>
								</div>
						</div><!-- row-el -->
					</div><!-- row -->
					<?php $counter++; ?>
					<?php }?>
					<?php }?>
				</div><!-- #Content CLose -->
			</div><!-- col-md-12 -->	

			<div class="col-md-12 bottom-label">
				<div class="col-md-6">
					<h3>Tickets</h3>
						<span>Add or remove tickets and their details for this voucher type</span>
					</div>

				<div class="col-md-6 form-header-right">
					<button type="button" class="person_btn btn submitBtn save-button" value="" onclick="addvoucher_ticket()">Add Ticket</button>
				</div>
			</div>

			<div class="col-md-12 label-container">
				<div class="col-md-3">
					Ticket Name
				</div>

				<div class="col-md-3">
					Ticket Price
				</div>

				<div class="col-md-3">
					Ticket Quantity
				</div>

				<div class="col-md-3">
				</div>
			</div><!-- col-md-12 -->

			<div class="col-md-12 ">
				<div id="voucher_ticketcontainer">
				<?php if(isset($ID)){
							$counter = 0;
							$current_tickets = $voucher_result->voucher_package_ticket_name;
							$current_tickets = (!empty($current_tickets))? json_decode($current_tickets) : array();

							$current_ticket_price = $voucher_result->voucher_package_ticket_price;
							$current_ticket_price = (!empty($current_ticket_price))? json_decode($current_ticket_price) : array();
							
							$current_ticket_qty = $voucher_result->voucher_package_ticket_qty;
							$current_ticket_qty = (!empty($current_ticket_qty))? json_decode($current_ticket_qty) : array();
							
							//print_f($current_item_price);
						?>
					<?php foreach ($current_tickets as $current_tickets_values) {?>
					<div class="row">
						<div class="col-md-12 row-el">
							<div class="col-md-3">
								<div class="item-group">
								   <select name="voucher_package_ticket_name[]" id="voucher_ticket<?php echo $counter;?>" class="voucher_package_ticket_name form-control" required>
										<option value="" selected disabled>select item</option>
										<?php foreach ($all_ticket as $all_ticket_key => $all_ticket_value) {?>
											 <option value="<?php echo $all_ticket_value->ticket_id;?>" <?php (isset($ID))? $selected_ticket_name = $current_tickets_values : '';if(isset($ID)){if($all_ticket_value->ticket_id == $selected_ticket_name){echo 'selected=selected';}} ?>><?php echo $all_ticket_value->ticket_title;?></option>
										<?php }?>
									</select>
									</div>
								</div><!-- col-md-4 -->	

								<div class="col-md-3">
									<div class="item-group">
										<input type="text" name="voucher_package_ticket_price[]" class="form-control voucher_itemprice voucher_ticket<?php echo $counter;?>price" value="<?php echo (isset($ID))? $current_ticket_price[$counter] : '' ?>" class="form-control"  readonly required>
									</div>
								</div><!-- col-md-4 -->	

								<div class="col-md-3">
									<div class="item-group">
										<input type="text" name="voucher_package_ticket_qty[]" class="form-control voucher_itemqty" value="<?php echo (isset($ID))? $current_ticket_qty[$counter] : '' ?>" class="form-control" required>
									</div>
												
								</div><!-- col-md-4 -->	

								<div class="col-md-2 col-md-offset-1 txt-center">
									<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>
								</div>
						</div><!-- row-el -->
					</div><!-- row -->
					<?php $counter++; ?>
					<?php }?>
					<?php }?>
				</div><!-- #Content CLose -->
			</div><!-- col-md-12 -->
			</div><!-- form-container -->	
		</div><!--row -->

	  </form>
	<div class="delete_confirm_modal modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      Confirm Delete?
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default btn_yes" data-dismiss="modal">Yes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		    </div>
		  </div>
		</div><!-- Modal -->	
<?php require_once 'include/short_scripts/voucher_script.php'; ?>
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>