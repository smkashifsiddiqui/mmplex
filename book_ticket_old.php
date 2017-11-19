<?php 
require_once 'common/init.php';
if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_ticket', $user_capabilities)){
	$booking = new booking();	
		
	

$booking = new booking();

if(isset($_SESSION['all_print_ticket'])){
	$ticket_session = $_SESSION['all_print_ticket'];



foreach($ticket_session as $ticket_session_v){?>

<div class="ticket" style="width:612px; height:198px;margin: auto; font-family: helvetica; font-size: 13px;">
	
	<img width="100%" src="assets/images/t_header.png"/>
	
	<?php  $ticket_detail = $booking->get_booking_screens($ticket_session_v['showtime']);

	$key =   $ticket_session_v['inserted_id'];
	$keyid  = base64_encode($key);
	?>
	<div class="ticket_left" style="width: 389px;float: left;border-right: 1px dotted;padding-left: 25px;">
	<?php   echo '<p style="margin: 8px;"> Screen #:  '.$ticket_detail->screen_name."</p>";
			echo '<p style="margin: 8px;"> Movie:     '.$ticket_detail->movie_title."</p>";?>

		<div class="" style="width: 50%;float: left;">
		 <?php  echo '<p style="margin: 8px;"> Seat: ROW 		'.$ticket_session_v['seatnumber']."</p>";
				echo '<p style="margin: 8px;"> Price:		'.$ticket_session_v['price']."</p>";  ?>
		</div>

		<div class="" style="width: 50%;float: left;">
		<?php 	echo '<p style="margin: 8px;"> Time: 		'.date('h:i A', strtotime($ticket_detail->showtime_datetime))."</p>";
				echo '<p style="margin: 8px;"> Date: 		'.date('d-m-y', strtotime($ticket_detail->showtime_datetime))."</p>";?>
		</div>
		<p style=" margin: 0;clear: both;font-size: 12px;">Please check the ticket detail to avoid in convenience.</p>
		<p style=" margin: 0;clear: both;font-size: 12px;  margin-bottom: 10px;"><strong>	T/F:</strong> <?php echo $key.$ticket_detail->booking_showtime_id.'-'.$ticket_session_v['seatnumber']; ?> <strong>	User:</strong> <?php echo $_SESSION['user']->first_name;?> <strong>ID:</strong><?php echo $_SESSION['user']->id;?>  <strong>System t.s:</strong> <?php echo $booking->_date('d-M-y h:i:s', date('d-m-Y'));?></p>
	</div>
	<div class="ticket_right" style="width: 187px;float: left;padding-left: 10px;">
		<?php   echo '<p style="margin: 5px;"> Screen #:  '.$ticket_detail->screen_name."</p>";
				echo '<p style="margin: 5px;"> Movie:     '.$ticket_detail->movie_title."</p>";
			    echo '<p style="margin: 5px;"> Seat: 		'.$ticket_session_v['seatnumber']."</p>";
				echo '<p style="margin: 5px;"> Price:		'.$ticket_session_v['price']."</p>";   
				echo '<p style="margin: 5px;"> Time: 		'.date('h:i A', strtotime($ticket_detail->showtime_datetime))."</p>";
				echo '<p style="margin: 5px;"> Date: 		'.date('d-m-y', strtotime($ticket_detail->showtime_datetime))."</p>";?>
	</div>

	<div style="width:100%;background-color:#282827;overflow: hidden;font-size: 11px;color: white;padding: 7px 0px;">
		<div class="" style="width:33%;float:left;text-align:center;">111-MEGAMULTIPLEX (246-372)</div>
		<div class="" style="width:33%;float:left;text-align:center;">info@megamultiplex.com</div>
		<div class="" style="width:33%;float:left;text-align:center;">111-MEGAMULTIPLEX (246-372)</div>
	</div><!--footer ticket-->

	</div><!--end ticket-->
	<br/>

<?php 

	//insert ticked details in printed table
	$t_b_id = $ticket_session_v['inserted_id'];
	$t_u_id = $key.$ticket_detail->booking_showtime_id.'-'.$ticket_session_v['seatnumber'];
	$t_sh_id = $ticket_session_v['showtime'];
	$t_mv_id = $ticket_detail->showtime_movie_id;
	$t_sc_id    = $ticket_detail->showtime_screen_id;
	$t_seat     = $ticket_session_v['seatnumber'];
	$t_price    = $ticket_session_v['price'];
	$t_userid   = $_SESSION['user']->first_name;
	$t_username = $_SESSION['user']->id;
	
	$ticket_detail = $booking->insert_printed_tickets($t_b_id,$t_u_id,$t_sh_id,$t_mv_id,$t_sc_id,$t_seat,$t_price,$t_userid,$t_username);
} //foreach

 }//endif ?>

<button class="btn" id="end_ticket_session">Print </button>

<script src="assets/js/jquery.latest.js"></script>
<script>
	$( document ).ready(function() {

		$("#end_ticket_session").click(function () {	
				var test = "hi";
				$.post('ajax.php', {'test_t': test, 'action': 'end_t_sess'}, function(data){

		    	});
	
		});

	});


</script>

 <?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
   
	}
?>
