<?php 
require_once 'common/init.php';
if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_ticket', $user_capabilities)){
	$booking = new booking();	
		
	

$booking = new booking();
//print_f($_SESSION['all_print_ticket']);
if(isset($_SESSION['all_print_ticket'])){
	$ticket_session = $_SESSION['all_print_ticket'];


uasort($ticket_session, function($a, $b) {
    return strnatcmp($a['seatnumber'], $b['seatnumber']);
});


$random_num = rand(10,1000);

foreach($ticket_session as $ticket_session_v){?>

<style>
@media print {
 
  .no-print {
    display: none; 
  }
 
</style>

<div class="ticket" style="width:215px; margin: auto; font-family: helvetica; font-size: 13px;overflow: auto;padding-bottom: 5px;border-bottom: 1px dotted gray;margin-bottom: 100px;">
	
	
	
	<?php  $ticket_detail = $booking->get_booking_screens($ticket_session_v['showtime']);
			$logo_result = $booking->get_logo();
			//print_f($logo_result);

	$key =   $ticket_session_v['inserted_id'];
	$keyid  = base64_encode($key);
	?>
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
				<td><strong style="font-size:11px;">Id: </strong></td>
				<td><strong style="font-size:11px;padding-left: 10px;"><?php echo $ticket_detail->booking_showtime_id.$key; ?></strong></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Movie date: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo date('d-m-y', strtotime($ticket_detail->showtime_datetime)); ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Show time: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo date('h:i', strtotime($ticket_detail->showtime_datetime)); ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Cinema: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;font-weight:bold;"><?php echo $ticket_detail->screen_name; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Seat No: </strong></td>
				<td><span style="font-size:13px;padding-left: 10px;font-weight:bold;text-transform:uppercase;"><?php echo $ticket_session_v['seatnumber']; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Movie Name: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo $ticket_detail->movie_title; ?></span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Total cost: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;"><?php echo $ticket_session_v['price']; ?></span></td>
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
	<hr style="border-top: none; border-bottom:1px dashed #000; height:1px;"/>
	
<?php 

	//insert ticked details in printed table
	
	$t_b_id = $ticket_session_v['inserted_id'];
	$t_u_id = $ticket_detail->booking_showtime_id.$key;
	$t_sh_id = $ticket_session_v['showtime'];
	$t_mv_id = $ticket_detail->showtime_movie_id;
	$t_sc_id    = $ticket_detail->showtime_screen_id;
	$t_seat     = $ticket_session_v['seatnumber'];
	$t_price    = $ticket_session_v['price'];
	$t_userid   = $_SESSION['user']->first_name;
	$t_username = $_SESSION['user']->id;
	$t_sh_t =   date('Y-m-d', strtotime($ticket_detail->showtime_datetime)); 
	$t_batch = $random_num;
	$ticket_detail = $booking->insert_printed_tickets($t_b_id,$t_u_id,$t_sh_id,$t_mv_id,$t_sc_id,$t_seat,$t_price,$t_userid,$t_username,$t_sh_t,$t_batch);
} //foreach

 }//endif ?>


<script src="assets/js/jquery.latest.js"></script>
<script>
	$( document ).ready(function() {

		
				
				
	
	

	});


</script>
<?php if(isset($_GET['print']) &&  $_GET['print'] == 'yes'){
	echo '<script>$( document ).ready(function() { $( "#direct_print" ).trigger( "click" ); });</script>';
}?>

<br/>
	<button class="btn submitBtn cancel-button btn-primary no-print" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>
	<button class="btn submitBtn btn-primary no-print" id="direct_print"  onclick="print_now()" style="clear:both;margin-top:10px;">Print</button></div>
	
	
	<script>function goBack() { window.history.back();}
	
	function print_now(){
		 window.print();
		 explode();
		 
		
				
	}
	
	
	function explode(){
		  $.post('ajax.php', {'action': 'unset_thank_sess'}, function(data) {
					console.log(data);
					var l_width = screen.availWidth;
					var l_height = screen.availHeight;
					var myWindow1 = window.open("user_booking_screen.php", "Cinema", "width="+l_width+",height="+l_height);
				});
		}
	setTimeout(explode, 5000);

</script>
 <?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
   
	}
?>
