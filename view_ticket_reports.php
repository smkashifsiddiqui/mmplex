<?php require_once 'header.php'; ?>

	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li>Reports</li>
		  <li class="active">Ticket Reports</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Ticket Reports</h3>
					<div class="search-btn input-group">
						<input type="text" id="filter" class="form-control search-control" placeholder="Search for...">
							<span class="input-group-btn">
							<button class="btn btn-default search-btn" type="button"><img  src="assets/images/search-icon.png"/></button>
						</span>
					</div><!-- /input-group -->
			 	</div>
		 	</div>
		</div><!--row-->

		


			<div class="col-md-12">	
				
				<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="width: 70%;">
					<thead>
					<tr>
						<th><h4 style=" margin: 0;">Reports Name</h4></th>
						<th></th>
					
					</tr>
					</thead>
					<tbody class="searchable">
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('seat_booking_by_day', $user_capabilities)){	?>
					<tr>
						<td><strong>Total Seat Booking by day</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_normal_seat_booking_by_day.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('current_booking_by_day', $user_capabilities)){	?>
					<tr>
						<td><strong>Current Seat Booking by day</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_current_seat_booking_by_day.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('adv_booking_by_day', $user_capabilities)){	?>
					<tr>
						<td><strong>Advance Booking by day</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_adv_seat_booking_by_day.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('ticket_sale_by_movie', $user_capabilities)){	?>
					<tr>
						<td><strong>Ticket sales by movie</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_seat_booking_by_movie.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('num_ticket_sale_by_movie', $user_capabilities)){	?>
					<tr>
						<td><strong>Number of Ticket sales by movie</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_seat_booking_by_movie_num.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('adv_ticket_sale_by_movie', $user_capabilities)){	?>
					<tr>
						<td><strong>Advance Ticket sales by movie</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_adv_seat_booking_by_movie.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('num_adv_ticket_sale_by_movie', $user_capabilities)){	?>
					<tr>
						<td><strong>Number of Advance Ticket sales by movie</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_adv_seat_booking_by_movie_num.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('cash_by_all_user', $user_capabilities)){	?>
					<tr>
						<td><strong>Cash in hand by day</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_cash_in_hand.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('cash_by_user', $user_capabilities)){	?>
					<tr>
						<td><strong>Cash in hand by User</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_cash_in_by_user.php">View</a></td>
						
					</tr>
					<?php } ?>
					<!--
					<tr>
						<td ><strong>Single Item Sales</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_single_item_sale.php">View</a></td>
						
					</tr>
					
					<tr>
						<td><strong>Single Package Sales</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_single_package_sale.php">View</a></td>
						
					</tr>
					-->
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('cancel_tickets_report', $user_capabilities)){	?>
					<tr>
						<td><strong>Ticket Cancellation by Day</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_cancellation.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					
					
					

				</table>
				</tbody>
				
			</div>
		</div><!-- Row Close -->
	</div><!-- Container Close -->


</div><!-- container -->

<?php require_once 'footer.php'; ?>
