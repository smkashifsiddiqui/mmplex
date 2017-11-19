<?php 
require_once 'common/init.php';
if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_ticket', $user_capabilities)){
	$booking = new booking();	
		
	
if(isset($_SESSION['user']->id)){
$last_batch_id_result = $booking->get_last_batch($_SESSION['user']->id);
$last_batch_id =  $last_batch_id_result[0]->printed_ticket_batch_id;

$last_batch_record = $booking->get_last_batch_tickets($last_batch_id);

//print_f($last_batch_record);
/*uasort($last_batch_record, function($a, $b) {
    return strnatcmp($a->printed_ticket_seat_id, $b->printed_ticket_seat_id);
});*/
$logo_result = $booking->get_logo();

foreach($last_batch_record as $print_sess_v){
	
	 
		 
	$booking_id = $print_sess_v->printed_ticket_booking_id;
	$booking_detail = $booking->get_last_inserted_batch($booking_id);
	
	$today_date = strtotime(date("Y-m-d"));
	$this_date = strtotime($booking_detail[0]->booking_showtime); 
	if($today_date < $this_date){
	//print_f($booking_detail);
	
	?>
	
<div class="ticket" style="width:215px; margin: auto; font-family: helvetica; font-size: 13px;overflow: auto;padding-bottom: 5px;border-bottom: 1px dotted gray;">
	
	
	
	<div class="ticket_left" style="width: 215px;float: left;">
	
	 <div class="" style="width: 20%;float: left;">
			 <img width="43" src="assets/images/uploads/<?php echo $logo_result->setting_value; ?>"/>
		</div>

		<div class="" style="width: 78%;float: left;margin-left: 2%;">
		<table>
			<tr>
				<td><strong style="font-size:11px;">Families Only </strong></td>
				<td><strong style="font-size:11px;padding-left: 2px;"><?php echo $today = date("d-m-y h:i "); ?></strong></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">(Re-print) Id: </strong></td>
				<td><strong style="font-size:11px;padding-left: 10px;"><?php echo $booking_detail[0]->printed_ticket_unique_id; ?></strong></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Movie date: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo $booking_detail[0]->booking_showdate; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Show time: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo date('h:i', strtotime($booking_detail[0]->booking_showtime)); ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Cinema: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;font-weight:bold;"><?php echo $booking_detail[0]->screen_name; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Seat No: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;font-weight:bold;text-transform:uppercase;"><?php echo $booking_detail[0]->booking_seats_number; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Movie Name: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo $booking_detail[0]->movie_title; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Total cost: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo $booking_detail[0]->booking_price; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>

			<tr>
				<td><strong style="font-size:11px;"> </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;text-transform:uppercase;"><?php echo $_SESSION['user']->first_name;?></span><hr style="margin-bottom: 0px; margin-top: 0px;"></td>
			</tr>
		</table>
	</div>
		
		
		<p style="width:100%;text-align:center; margin: 0;clear: both;font-size: 12px;">(No Outside Food or Drink Allowed),</p>
		<p style="width:100%;text-align:center; margin: 0;clear: both;font-size: 12px;">No Transferable and not Refundable,</p>
		<p style="width:100%;text-align:center; margin: 0;clear: both;font-size: 12px;">Please Check the Ticket Date and Time Before Leaving Counter.</p>
		
	</div>

	</div><!--end ticket-->
	<br/><br/>
<?php } 
	else{ echo 'no result';}
} }
//print_f($booking_result);
?>


<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>
<button class="btn submitBtn btn-primary no-print"   onclick="window.print()" style="clear:both;margin-top:10px;">Print</button></div>
	<script>function goBack() { window.history.back();}</script>
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
   
	}
?>
