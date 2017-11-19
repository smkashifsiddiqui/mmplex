<?php 
require_once 'header-dashboard.php'; 
if($_SESSION['user']->capabilities != 'null'){

		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_ticket', $user_capabilities)){
	$booking = new booking();?>
	
	
<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="booking.php">Home</a></li>
		  <li class="active">Cancel Tickets</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Cancel Tickets</h3>
					<div class="search-btn input-group">
						<input type="text" id="filter" class="form-control search-control" placeholder="Search for...">
							<span class="input-group-btn">
							<button class="btn btn-default search-btn" type="button"><img  src="assets/images/search-icon.png"/></button>
						</span>
					</div><!-- /input-group -->
			 	</div>
		 	</div>
		</div><!--row-->

	  	<form method="post" action="">
		  	<div class="col-md-2" style="margin-left: 50px;">
			  	<div class="search-btn input-group">
					<select name="selection" class="form-control search-control">
						<option value="counts">Search by Counts</option>
						<option value="ticket">Search by Ticket No</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
			  	<div class="search-btn input-group">
					<input type="text" name="searchFilter" class="form-control search-control" placeholder="Search by count OR Ticket No...">
						<span class="input-group-btn">
						<button class="btn btn-default search-btn" type="submit"><img  src="assets/images/search-icon.png"/></button>
					</span>
				</div>
			</div>
		</form>
		<?php

			if(isset($_POST['selection']) && $_POST['selection'] == 'counts') {

				if($_POST['searchFilter'] != '' || $_POST['searchFilter'] != 0) {
                        $_POST['max_record'] = $_POST['searchFilter'];
                        $results = $_SESSION['user'];

                    if ($results) {
                            $cancel_id = $results->id;
                            $cancel_capability = $results->capabilities;
                            $cancel_capability = (!empty($cancel_capability))? json_decode($cancel_capability) : array();
			            if((in_array('cancel_ticket', $cancel_capability)) && (!in_array('cancel_old_ticket', $cancel_capability))) { ?>
			
                            <style>
                                .userLoginPanel { display:none; }
                            </style>
				
                            <div class="row">
                                <div class="col-md-12">
                                        <?php
                                        $booking = new booking();
                                        $results = $booking->get_booked_tickets($_POST['max_record']);

                                        if ($results) {
                                            //print_f($results);
                                        ?>
                                    <table border="1" id="example" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
                                        <thead>
                                        <tr>
                                            <th>Ticket Id</th>
                                            <th>Movie</th>
                                            <th>Screen name</th>
                                            <th>Show Date & time</th>
                                            <th>Seat id</th>
                                            <th>Printed date</th>
                                            <th>Remarks & Cancel</th>
                                        </tr>
                                        </thead>
                                        <tbody class="searchable">
                                            <?php
                                            foreach($results as $res){


                                             $today_date =  strtotime($current_time_compare).'<br/>';
                                             $ticket_date = strtotime($res->booking_showtime);

                                                //if($ticket_date == $today_date || $ticket_date > $today_date){
                                                //print_f($res);
                                                //die();
                                            if(1 == 1){
                                                    echo '<tr>';
                                                    echo '<td>'. $res->printed_ticket_unique_id .'</td>';
                                                    echo '<td>'. $res->movie_title .'</td>';
                                                    echo '<td>'. $res->screen_name .'</td>';
                                                    echo '<td>'. date('d-M-y h:i', strtotime($res->booking_showtime)).'</td>';
                                                    echo '<td style="text-transform:uppercase;">'. $res->printed_ticket_seat_id .'</td>';
                                                    echo '<td>'. date('d-M-y h:i', strtotime($res->printed_ticket_terminal_ts)).'</td>';
                                                    echo '<td class="alignCenter"><textarea class="remarks"></textarea><br/><br/>';
                                                    echo '<input type="hidden" class="id_person" value="'.$cancel_id.'"><input type="hidden" class="id_to_delete" value="'.$res->printed_ticket_booking_id.'"><a href="#" class="edit_btn img_delete" data-toggle="modal" data-target=".delete_confirm_modal">Cancel</a>';
                                                    echo '<input type="hidden" class="person_name" value="'.$_SESSION['user']->first_name.'"><input type="hidden" class="movie_title" value="'.$res->movie_title.'"><input type="hidden" class="screen_name" value="'.$res->screen_name.'"><input type="hidden" class="seat_id" value='.$res->printed_ticket_seat_id.'><input type="hidden" class="showtime_date" value="'.date('d-M-y h:i', strtotime($res->booking_showtime)).'"></td>';
                                                    echo '</tr>';
                                                        }
                                            }}
                                            ?>
                                        </tbody>
                                    </table>
						<?php
						}
						else if((in_array('cancel_ticket', $cancel_capability)) && (in_array('cancel_old_ticket', $cancel_capability))){
				//echo 'allow';
						?>
			
				<style>
					.userLoginPanel { display:none; }
				</style>
				
				<div class="row">
					<div class="col-md-12">	
						<?php 
						$booking = new booking();
						$results = $booking->get_booked_tickets($_POST['max_record']);
						
						if ($results) {
							//print_f($results);
						?>
						<table border="1" id="example" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
							<thead>
							<tr>
								<th>Ticket Id</th>
								<th>Movie</th>
								<th>Screen name</th>
								<th>Show Date & time</th>
								<th>Seat id</th>
								<th>Printed date</th>
								<th>Remarks & Cancel</th>
							</tr>
							</thead>
							<tbody class="searchable">
								<?php 
								foreach($results as $res){
								
									//print_f($res);
									//die();
										echo '<tr>';
										echo '<td>'. $res->printed_ticket_unique_id .'</td>';
										echo '<td>'. $res->movie_title .'</td>';
										echo '<td>'. $res->screen_name .'</td>';
										echo '<td>'. date('d-M-y h:i', strtotime($res->booking_showtime)).'</td>';
										echo '<td style="text-transform:uppercase;">'. $res->printed_ticket_seat_id .'</td>';
										echo '<td>'. date('d-M-y h:i', strtotime($res->printed_ticket_terminal_ts)).'</td>';
                                        echo '<td class="alignCenter"><textarea class="remarks"></textarea><br/><br/>';
                                        echo '<input type="hidden" class="id_person" value="'.$cancel_id.'"><input type="hidden" class="id_to_delete" value="'.$res->printed_ticket_booking_id.'"><a href="#" class="edit_btn img_delete" data-toggle="modal" data-target=".delete_confirm_modal">Cancel</a>';
                                        echo '<input type="hidden" class="person_name" value="'.$_SESSION['user']->first_name.'"><input type="hidden" class="movie_title" value="'.$res->movie_title.'"><input type="hidden" class="screen_name" value="'.$res->screen_name.'"><input type="hidden" class="seat_id" value='.$res->printed_ticket_seat_id.'><input type="hidden" class="showtime_date" value="'.date('d-M-y h:i', strtotime($res->booking_showtime)).'"></td>';
										echo '</tr>';
									
						}}
								?>
							</tbody>
						</table>
						<?php
						}else{
							echo '<div class="col-sm-12" style="text-align:center;"><div class="alert alert-danger" role="alert" style="margin:auto;width: 260px;clear: both;"> Access denied! </div></div>';
						} 
						?>
					</div>
				</div><!-- Row Close -->
			<?php
			/*}else{
				echo '<div class="col-sm-12" style="text-align:center;"><div class="alert alert-danger" role="alert" style="margin:auto;width: 260px;clear: both;"> Access denied! </div></div>';
			}*/
		}}
		
			}

			if(isset($_POST['selection']) && $_POST['selection'] == 'ticket') {

			if($_POST['searchFilter'] != '' || $_POST['searchFilter'] != 0) {
				$_POST['ticket_no'] = $_POST['searchFilter'];
				$results = $_SESSION['user'];
			if ($results) {

				$cancel_id = $results->id;
				$cancel_capability = $results->capabilities;
				$cancel_capability = (!empty($cancel_capability))? json_decode($cancel_capability) : array();
			if((in_array('cancel_ticket', $cancel_capability)) && (!in_array('cancel_old_ticket', $cancel_capability))){
				//echo 'not allow';
				?>
			
				<style>
					.userLoginPanel { display:none; }
				</style>
				
				<div class="row">
					<div class="col-md-12">	
						<?php 
						$booking = new booking();
						$results = $booking->get_booked_tickets_by_id($_POST['ticket_no']);

						if ($results) {
							//print_f($results);
						?>
						<table border="1" id="example" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
							<thead>
							<tr>
								<th>Ticket Id</th>
								<th>Movie</th>
								<th>Screen name</th>
								<th>Show Date & time</th>
								<th>Seat id</th>
								<th>Printed date</th>
								<th>Remarks & Cancel</th>
							</tr>
							</thead>
							<tbody class="searchable">
								<?php 
								foreach($results as $res){
								
								 $today_date =  strtotime($current_time_compare).'<br/>';
								 $ticket_date = strtotime($res->booking_showtime);
								
									//if($ticket_date == $today_date || $ticket_date > $today_date){
									//print_f($res);
									//die();
								if(1 == 1){
										echo '<tr>';
										echo '<td>'. $res->printed_ticket_unique_id .'</td>';
										echo '<td>'. $res->movie_title .'</td>';
										echo '<td>'. $res->screen_name .'</td>';
										echo '<td>'. date('d-M-y h:i', strtotime($res->booking_showtime)).'</td>';
										echo '<td style="text-transform:uppercase;">'. $res->printed_ticket_seat_id .'</td>';
										echo '<td>'. date('d-M-y h:i', strtotime($res->printed_ticket_terminal_ts)).'</td>';
                                        echo '<td class="alignCenter"><textarea class="remarks"></textarea><br/><br/>';
                                        echo '<input type="hidden" class="id_person" value="'.$cancel_id.'"><input type="hidden" class="id_to_delete" value="'.$res->printed_ticket_booking_id.'"><a href="#" class="edit_btn img_delete" data-toggle="modal" data-target=".delete_confirm_modal">Cancel</a>';
                                        echo '<input type="hidden" class="person_name" value="'.$_SESSION['user']->first_name.'"><input type="hidden" class="movie_title" value="'.$res->movie_title.'"><input type="hidden" class="screen_name" value="'.$res->screen_name.'"><input type="hidden" class="seat_id" value='.$res->printed_ticket_seat_id.'><input type="hidden" class="showtime_date" value="'.date('d-M-y h:i', strtotime($res->booking_showtime)).'"></td>';
										echo '</tr>';
											}
								}}
								?>
							</tbody>
						</table>
						<?php
						}
						else if((in_array('cancel_ticket', $cancel_capability)) && (in_array('cancel_old_ticket', $cancel_capability))){
				//echo 'allow';
						?>
			
				<style>
					.userLoginPanel { display:none; }
				</style>
				
				<div class="row">
					<div class="col-md-12">	
						<?php 
						$booking = new booking();
						$results = $booking->get_booked_tickets_by_id($_POST['ticket_no']);
						
						if ($results) {
							//print_f($results);
						?>
						<table border="1" id="example" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
							<thead>
							<tr>
								<th>Ticket Id</th>
								<th>Movie</th>
								<th>Screen name</th>
								<th>Show Date & time</th>
								<th>Seat id</th>
								<th>Printed date</th>
								<th>Remarks & Cancel</th>
							</tr>
							</thead>
							<tbody class="searchable">
								<?php 
								foreach($results as $res){
								
									//print_f($res);
									//die();
										echo '<tr>';
										echo '<td>'. $res->printed_ticket_unique_id .'</td>';
										echo '<td>'. $res->movie_title .'</td>';
										echo '<td>'. $res->screen_name .'</td>';
										echo '<td>'. date('d-M-y h:i', strtotime($res->booking_showtime)).'</td>';
										echo '<td style="text-transform:uppercase;">'. $res->printed_ticket_seat_id .'</td>';
										echo '<td>'. date('d-M-y h:i', strtotime($res->printed_ticket_terminal_ts)).'</td>';
                                        echo '<td class="alignCenter"><textarea class="remarks"></textarea><br/><br/>';
                                        echo '<input type="hidden" class="id_person" value="'.$cancel_id.'"><input type="hidden" class="id_to_delete" value="'.$res->printed_ticket_booking_id.'"><a href="#" class="edit_btn img_delete" data-toggle="modal" data-target=".delete_confirm_modal">Cancel</a>';
                                        echo '<input type="hidden" class="person_name" value="'.$_SESSION['user']->first_name.'"><input type="hidden" class="movie_title" value="'.$res->movie_title.'"><input type="hidden" class="screen_name" value="'.$res->screen_name.'"><input type="hidden" class="seat_id" value='.$res->printed_ticket_seat_id.'><input type="hidden" class="showtime_date" value="'.date('d-M-y h:i', strtotime($res->booking_showtime)).'"></td>';
										echo '</tr>';
									
						}}
								?>
							</tbody>
						</table>
						<?php
						}else{
							echo '<div class="col-sm-12" style="text-align:center;"><div class="alert alert-danger" role="alert" style="margin:auto;width: 260px;clear: both;"> Access denied! </div></div>';
						} 
						?>
					</div>
				</div><!-- Row Close -->
			<?php
			/*}else{
				echo '<div class="col-sm-12" style="text-align:center;"><div class="alert alert-danger" role="alert" style="margin:auto;width: 260px;clear: both;"> Access denied! </div></div>';
			}*/
		}}
			}
			

		?>

	</div><!-- Container Close -->

	<div class="delete_confirm_modal modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  Confirm Delete?
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn_yes" >Yes</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
	  </div>
	</div><!-- Modal -->
		
		
</div><!-- container -->

<script src="assets/js/jquery-1.11.1.js"></script>
<link href="assets/css/keyboard.css" rel="stylesheet">
<link href="assets/css/jquery-ui.min.css" rel="stylesheet">
<?php require_once 'footer.php'; ?>
<script type="text/javascript">

$(window).load(function(){
        $('.myModal').modal('show');
    });
	
var id_to_delete;
var id_person;
var comment;
var person_name;
var movie_title;
var screen_name;
var seat_id;
var showtime_date;

$(".container").on('click', '.img_delete',function() {
    console.log($(this).parent().parent().find('.seat_id').val());
	id_to_delete = $(this).parent().parent().find('.id_to_delete').val();
	id_person   = $(this).parent().parent().find('.id_person').val();
	comment  = $(this).parent().parent().find('.remarks').val();
    person_name  = $(this).parent().parent().find('.person_name').val();
    movie_title  = $(this).parent().parent().find('.movie_title').val();
    screen_name  = $(this).parent().parent().find('.screen_name').val();
    seat_id  = $(this).parent().parent().find('.seat_id').val();
    showtime_date  = $(this).parent().parent().find('.showtime_date').val();
	console.log(comment);
	});

	$(".modal-footer").on('click', '.btn_yes',function() {
		//var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {
		    'to_delete': id_to_delete,
            'remarks':comment,
            'pers': id_person,
            'action': 'delete_printed_ticket',
            'person_name': person_name,
            'movie_title': movie_title,
            'screen_name': screen_name,
            'seat_id': seat_id,
            'showtime_date': showtime_date
        }, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".alert").show();
			}
			
		});
	});
	
	
	

</script>

<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
   
	}
?>
