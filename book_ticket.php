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
}

body{
    font-family: "Bebas Neue", Arial;
    font-size: 11px;
    font-weight: bold;
    letter-spacing: 1px;
}
.wrapper{
    width: 410px;
    height: 164px;
    background: url('ticket.jpg') no-repeat;
}
#screen-left{
    font-size: 15px;
    padding-left: 65px;
    padding-top: 11px;
}
/*#screen-right{
    font-size: 15px;
}*/
#seat-left{
    padding-left: 37px;
    padding-top: 6px;
}
/*#seat-right{
    padding-top: 13px;
}*/
#time-left{
    padding-left: 38px;
    padding-top: 4px;
}
/*#time-right{
    padding-top: 13px;
}*/
#date-left{
    padding-left: 38px;
    padding-top: 1px;
}
/*#date-right{
    padding-top: 13px;
}*/
#movie-left{
    padding-left: 38px;
    padding-top: 3px;
}


 
</style>
<div class="wrapper">


    <div class="ticket">

        <?php  $ticket_detail = $booking->get_booking_screens($ticket_session_v['showtime']);

        $key =   $ticket_session_v['inserted_id'];
        $keyid  = base64_encode($key);
        ?>
        <div class="ticket_left">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="35%" height="70">&nbsp;</td>
                    <td width="65%">&nbsp;</td>
                </tr>
                <tr>
                    <td id="screen-left">3D</td>
                    <td id="screen-right">1</td>
                </tr>
                <tr>
                    <td id="seat-left">9/11</td>
                </tr>
                <tr>
                    <td id="time-left">2:50pm</td>
                </tr>
                <tr>
                    <td id="date-left">11-12-2017</td>
                </tr>
                <tr>
                    <td id="movie-left">PUNJAB NAHI JAUNGI</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
<!--        <div class="ticket_right">-->
<!--            <table>-->
<!--                <tr><td style="padding-left: 20px;">Screen</td></tr>-->
<!--                <tr>-->
<!--                    <td style="padding-right:60px;">Time</td>-->
<!--                    <td style="padding-right: 70px;">Date</td>-->
<!--                    <td style="padding-right: 30px;">Seat</td>-->
<!--                </tr>-->
<!---->
<!--                <tr>-->
<!--                    <td>Movie</td>-->
<!--                </tr>-->
<!--            </table>-->
<!--        </div>-->
    </div>
        <!--div class="ticket_left" style="width: 389px;float: left;border-right: 1px dotted;padding-left: 25px;">
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
        </div-->
        <!--div class="ticket_right" style="width: 187px;float: left;padding-left: 10px;">
            <?php   echo '<p style="margin: 5px;"> Screen #:  '.$ticket_detail->screen_name."</p>";
            echo '<p style="margin: 5px;"> Movie:     '.$ticket_detail->movie_title."</p>";
            echo '<p style="margin: 5px;"> Seat: 		'.$ticket_session_v['seatnumber']."</p>";
            echo '<p style="margin: 5px;"> Price:		'.$ticket_session_v['price']."</p>";
            echo '<p style="margin: 5px;"> Time: 		'.date('h:i A', strtotime($ticket_detail->showtime_datetime))."</p>";
            echo '<p style="margin: 5px;"> Date: 		'.date('d-m-y', strtotime($ticket_detail->showtime_datetime))."</p>";?>
        </div-->


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

        <script type="text/javascript"  src='http://cdn.renderedfont.com/js/renderedfont-0.8.min.js#free'>
<script src="assets/js/jquery.latest.js"></script>
<script>
	$( document ).ready(function() {

		
				
				
	
	

	});


</script>
<?php if(isset($_GET['print']) &&  $_GET['print'] == 'yes'){
	echo '<script>$( document ).ready(function() { $( "#direct_print" ).trigger( "click" ); });</script>';
}?>

<br/>
	<button class="btn submitBtn cancel-button btn-primary no-print" onclick="window.close()"  style="clear:both;margin-top:10px;">Go Back!</button></div>
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
