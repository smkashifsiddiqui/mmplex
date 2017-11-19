<?php require_once 'header-dashboard.php';  ?>

<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="booking.php">Home</a></li>
		  <li class="active">Re Print Tickets</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Re Print Tickets</h3>
					<div class="search-btn input-group">
						<input type="text" id="filter" class="form-control search-control" placeholder="Search for...">
							<span class="input-group-btn">
							<button class="btn btn-default search-btn" type="button"><img  src="assets/images/search-icon.png"/></button>
						</span>
					</div><!-- /input-group -->
			 	</div>
		 	</div>
		</div><!--row-->

	
	 


		<div class="row">
			
			<div class="col-md-12">	
				<?php 
				$booking = new booking();
				$results = $booking->get_printed_tic();
				if ($results) {
				
				?>
				<table border="1" id="example" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
					<thead>
					<tr>
						<th>Ticket Id</th>
						<th>Movie</th>
						<th>Show Date & time</th>
						<th>Seat id</th>
						<th>Printed date</th>
						<th></th>
					</tr>
					</thead>

					<tbody class="searchable">
						<?php 
						foreach($results as $res){
							
							 //echo $today_date =  strtotime(date("d-m-y")); 
						 $today_date =  strtotime($current_time_compare).'<br/>';
						 $ticket_date = strtotime($res->booking_showtime);
								
									if($ticket_date == $today_date || $ticket_date > $today_date){
						//print_f($res);
						//die();
							echo '<tr>';
							echo '<td>'. $res->printed_ticket_unique_id .'</td>';
							echo '<td>'. $res->movie_title .'</td>';
							echo '<td>'. date('d-M-y h:i', strtotime($res->booking_showtime)).'</td>';
							echo '<td style="text-transform:uppercase;">'. $res->printed_ticket_seat_id .'</td>';
							echo '<td>'. date('d-M-y h:i', strtotime($res->printed_ticket_terminal_ts)).'</td>';
							echo '<td class="alignCenter"><a class="edit_btn" href="reprint_ticket.php?id='.$res->printed_ticket_booking_id.'&unique_id='.$res->printed_ticket_unique_id.'">Print</a></td>';
							echo '</tr>';
						}
						}
						?>
						</tbody>
				</table>
				<?php
				}else{
					echo 'Error';
				} 
				?>
			</div>
		</div><!-- Row Close -->
	</div><!-- Container Close -->

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
</div><!-- container -->
<?php require_once 'footer.php'; ?>
