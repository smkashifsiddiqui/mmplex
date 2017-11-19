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
body, html{width:343px;}
@media print {
 
  .no-print {
    display: none; 
  }
  
  .ticket {
    display: block !important; 
  }
}
</style>

<html>
<head></head>
<body class="" style="width: 343px;">

<div class="ticket" style="width: 343px; margin: auto; font-family: helvetica; font-size: 13px;overflow: auto;border: 1px solid gray;height: 179px;">
	
	
	
		
	<div style="height: 30px;width:200px">
		<p style="margin:0px;margin-left: 20px;">OPERATOR: QUNDEEL</p>
		<p style="margin:0px;margin-left: 20px;">OPERATOR: QUNDEEL</p>
	</div>
	
	<div style="height: 20px;width:100%">
	 <div style="width: 112.66;float: left;">
		<p style="margin:0px;margin-left: 20px;">SCREEN</p>
		<p style="margin:0px;margin-left: 20px;">PRICEE</p>
	</div>
		
	<div style="width: 112.66;float: left;">
	  <p style="margin:0px;margin-left: 20px;">ROW</p>
	  <p style="margin:0px;margin-left: 20px;">DATE</p>
	</div>
	
	<div style="width: 112.66;float: left;">
	  <p style="margin:0px;margin-top: 30px;margin-left: 20px;">SEATS</p>
	  <p style="margin:0px;margin-top: 30px;margin-left: 20px;">TIME</p>
	</div>
	</div>
	
	<div style="height: 30px;width:200px">
		<p style="margin:0px;margin-left: 20px;">OPERATOR: QUNDEEL</p>
		<p style="margin:0px;margin-left: 20px;">OPERATOR: QUNDEEL</p>
	</div>

	<!--	<div class="" style="width: 78%;float: left;margin-left: 2%;">
		<table>
			<tr>
				<td><strong style="font-size:11px;">Families Only </strong></td>
				<td><strong style="font-size:11px;padding-left: 2px;">09-03-16 04:36 </strong></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Id: </strong></td>
				<td><strong style="font-size:11px;padding-left: 10px;">26297</strong></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Movie date: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;">29-06-16</span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Show time: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;">12:10</span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Cinema: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;font-weight:bold;">Cinema 1</span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Seat No: </strong></td>
				<td><span style="font-size:13px;padding-left: 10px;font-weight:bold;text-transform:uppercase;">["D-7"]</span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Movie Name: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;">TAMASHA</span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>
			
			<tr>
				<td><strong style="font-size:11px;">Total cost: </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;">400</span></td>
			</tr>
			
			<tr><td colspan="2"><hr style="margin-bottom: 0px; margin-top: 0px;"></td></tr>

			<tr>
				<td><strong style="font-size:11px;"> </strong></td>
				<td><span style="font-size:12px;padding-left: 10px;text-transform:uppercase;">admin</span><hr style="margin-bottom: 0px; margin-top: 0px;"></td>
			</tr>
		</table>
	</div>
		
		
		<p style="width:100%;text-align:center; margin: 0;clear: both;font-size: 12px;">(No Outside Food or Drink Allowed),</p>
		<p style="width:100%;text-align:center; margin: 0;clear: both;font-size: 12px;">No Transferable and not Refundable,</p>
		<p style="width:100%;text-align:center; margin: 0;clear: both;font-size: 12px;">Please Check the Ticket Date and Time Before Leaving Counter.</p>
		
	-->

	</div>
	<?php exit();?>
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
</body></html>