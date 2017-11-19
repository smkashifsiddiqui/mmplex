<?php require_once 'header-dashboard.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('book_adv_ticket', $user_capabilities)){	
		
	
?>


	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		   <li><a href="advance_booking.php">Home</a></li>
		  <li ><a href="view_advance_bookings.php">View Bookings</a></li>
		  <li class="active">Confirm Booking</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  id="mainform" action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Booking Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="reset" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_booking"><?php echo (isset($_GET['id']))? 'Confirm Booking ' : '' ?>  </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 

			$booking = new booking();
			$confirm_booking = new confirm_booking();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_booking'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $confirm_booking->insert_booking($_POST, $ID);
				}else{ // Insert new
					
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added item Sucessfully </div>';
					$link = '<script>window.open("booking.php", "width=800, height=600");</script>';
					echo $link;

				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$cust_results = $confirm_booking->get_adv_bookings($ID);
				//print_f($cust_results);
			}
			?>

	
			<div class="form-container">
				

			<div class="col-md-6">
				<div class="col-md-12">	
					<div class="form-group">
						<label for="name" class="col-sm-4 control-label">Customer Name: </label>
						<div class="col-sm-8">
							<input type="text" name="name" id="name" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_customer_name : '' ?>" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="phone" class="col-sm-4 control-label">Customer Phone: </label>
						<div class="col-sm-8">
							<input type="text" name="phone" id="phone" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_phone : '' ?>" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="email" class="col-sm-4 control-label">Customer Email: </label>
						<div class="col-sm-8">
							<input type="text" name="email" id="email" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_user_email : '' ?>" class="form-control" readonly >
						</div>
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="movie" class="col-sm-4 control-label"> Movie: </label>
						<div class="col-sm-8">
							<input type="text" name="movie" id="movie" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->movie_title : '' ?>" class="form-control" readonly>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>


	

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="showtime" class="col-sm-4 control-label">Show Time: </label>
						<div class="col-sm-8">
							<input type="text" name="showtime" id="showtime" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->showtime_datetime : '' ?>" class="form-control" readonly>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="seats_qty" class="col-sm-4 control-label">Seats qty: </label>
						<div class="col-sm-8">
							<input type="text" name="seats_qty" id="seats_qty" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_seat_qty : '' ?>" class="form-control" readonly>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="seats_num" class="col-sm-4 control-label">Seats number: </label>
						<div class="col-sm-8">

						<?php
						if($cust_results != ''){
							$current_seats = $cust_results->advance_b_seats_number;
							$current_seats = (!empty($current_seats))? json_decode($current_seats) : array();
						}
						 ?>
							<textarea name="seats_id" id="seats_id" class="form-control" style="height: 80px;"readonly>
								<?php if(isset($ID) && $cust_results != ''){echo $seats = implode(",", $current_seats);} ?>
							</textarea>
							<input type="hidden" name="seats_num" id="seats_num" value="<?php if(isset($ID) && $cust_results != ''){echo $seats = implode(",", $current_seats);} ?>">
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="total_price" class="col-sm-4 control-label">Total Price: </label>
						<div class="col-sm-8">
							<input type="text" name="total_price" id="total_price" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_price*$cust_results->advance_b_seat_qty : '' ?>" class="form-control" readonly>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>
		    	<input type="hidden" name="movie_id" id="movie_id" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->movie_id : '' ?>" class="form-control" readonly>
		    	<input type="hidden" name="dist_id" id="dist_id" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_distributer : '' ?>" class="form-control" readonly>
		    	<input type="hidden" name="show_id" id="show_id" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_showtime_id : '' ?>" class="form-control" readonly>
		    	<input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_ticket_id : '' ?>" class="form-control" readonly>
		    	<input type="hidden" name="ticket_type" id="ticket_type" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_ticket_type : '' ?>" class="form-control" readonly>
		    	<input type="hidden" name="price" id="price" value="<?php echo (isset($ID) && $cust_results != '')? $cust_results->advance_b_price : '' ?>" class="form-control" readonly>
			

			</div><!-- col-md-6 -->

			<div class="col-md-offset-2 col-md-4">

			<div class="col-md-10">	
					<div class="form-group">
						<label for="item_status" class="col-sm-5 control-label"><span>* </span>Confirmed: </label>
						<div class="col-sm-7">
						<select class="status form-control" name="item_status">

								<?php foreach($confirm as $status_key => $status_value){ ?>
									<option value="<?php echo $item_status_key; ?>" <?php (isset($ID) && $cust_results != '')? $selected_status = $cust_results->advance_b_status : '';if(isset($ID) && $cust_results != ''){if($status_key == $selected_status){echo 'selected=selected';}}?> ><?php echo $status_value; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>
		    	</div>

		 </div><!-- form-container -->
	  </form>

	  <div class="delete_confirm_modal modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		 <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      Confirm Delete?
		    </div>
		    <div class="modal-footer">
		   
		    	<input type="hidden" class="id_to_delete" value="<?php echo $_GET['id']; ?>" />
		        <button type="button"  class="btn btn-default btn_yes" data-dismiss="modal" >Yes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		 
		    </div>
		  </div>
		</div><!-- Modal -->
	</div><!-- Container Close -->
<?php require_once 'footer.php'; ?>
<script type="text/javascript">

	$(".modal-footer").on('click', '.btn_yes',function() {
		var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'del_record'}, function(data) {
				
				console.log(data);
				$("#mainform").find("input[type=text], textarea").val("");
		});
	});

</script>	

 <?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
     require_once 'footer.php'; 
	}

?> 

