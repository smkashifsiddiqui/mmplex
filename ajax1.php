<?php 
ob_start();
require_once 'common/init.php';

$item = new item();
$ticket = new ticket();
$booking = new booking();
$showtime = new showtime();
$concession = new concession();

// Get Single item Detail for Add package and add ticket Page
if(isset($_POST['action']) && $_POST['action'] == 'get_item_detail'){
	$getitem		= $_POST['getitem'];
	header('Content-Type: application/json');
	echo json_encode($item->get_items($getitem));
}

// Get Single ticket Detail for Add package  Page
if(isset($_POST['action']) && $_POST['action'] == 'get_ticket_detail'){
	$getticket		= $_POST['getticket'];
	header('Content-Type: application/json');
	echo json_encode($ticket->get_tickets($getticket));
}

// Get Single item Detail for Add package and add ticket Page
if(isset($_POST['action']) && $_POST['action'] == 'screen_show'){
	$showtime_screen_id		= $_POST['screen_id'];
	ob_end_clean();
    header('Content-Type: application/json');
	echo json_encode($booking->get_booking_screens($showtime_screen_id));
	//print_f($booking->get_booking_screens($showtime_screen_id));
	//die();
}

// Get recent selected seats
if(isset($_POST['action']) && $_POST['action'] == 'recent_selected_seats'){
	$posted_seats		= $_POST['posted_seats'];
	$show_id 			= $_POST['show_id'];
    header('Content-Type: application/json');
	echo json_encode($booking->get_recent_seats($posted_seats, $show_id));
	
}


if(isset($_POST['action']) && $_POST['action'] == 'seat_avail'){
	$selected_show		= $_POST['selected_show'];
	header('Content-Type: application/json');
	echo json_encode($booking->get_locked_seats($selected_show));
}

if(isset($_POST['action']) && $_POST['action'] == 'booked_seats'){
	$showtime_id		= $_POST['showtime_id'];
	$seats = $booking->get_booked_seats($showtime_id);
	$seats_arr = array();
	foreach ($seats as $key => $value) {
		$value->booking_seats_number = json_decode($value->booking_seats_number);
		$seats_arr[$key] = $value;
	}

	$booking->get_booked_seats($showtime_id);
	header('Content-Type: application/json');
	echo json_encode($seats_arr);
}

if(isset($_POST['action']) && $_POST['action'] == 'advance_booked_seats'){
	$a_showtime_id		= $_POST['showtime_id'];
	$a_seats = $booking->get_advance_booked_seats($a_showtime_id);
	$a_seats_arr = array();
	foreach ($a_seats as $key => $value) {
		$value->advance_b_seats_number = json_decode($value->advance_b_seats_number);
		$a_seats_arr[$key] = $value;
	}

	$booking->get_advance_booked_seats($a_showtime_id);
	header('Content-Type: application/json');
	echo json_encode($a_seats_arr);
}


if(isset($_POST['action']) && $_POST['action'] == 'lock_seats'){
	$final_seats = $_POST['initial_seats'];
	$show		 = $_POST['show'];
	header('Content-Type: application/json');
	echo json_encode($booking->insert_locked_seats($final_seats, $show));
}

if(isset($_POST['action']) && $_POST['action'] == 'get_t_s'){
	
	header('Content-Type: application/json');
	echo json_encode($booking->get_terminal_session());
}

if(isset($_POST['action']) && $_POST['action'] == 'booking_r'){
	
	
	$s_id						= $_POST['s_show_id'];
	$s_t_id						= $_POST['s_ticket_id'];
	$s_t_type					= $_POST['s_ticket_type'];
	$s_comp						= $_POST['s_comp'];
	$s_seats			        = $_POST['s_seats'];
	$s_seats_qty				= $_POST['s_seats_qty'];
	$s_seats_amount				= $_POST['s_seats_amount'];
	$s_m_id						= $_POST['s_m_id'];
	$s_d_id						= $_POST['s_d_id'];

	header('Content-Type: application/json');
	echo json_encode($booking->insert_booking($s_id,$s_t_id,$s_t_type,$s_comp,$s_m_id,$s_d_id,$s_seats,$s_seats_qty,$s_seats_amount));
}

if(isset($_POST['action']) && $_POST['action'] == 'set_screen_id'){
	$front_booking_show_id = $_POST['sc_id'];
	$front_booking_mv_id = $_POST['mv_id'];
	header('Content-Type: application/json');
	$booking->screen_session($front_booking_show_id,$front_booking_mv_id);
	
}

if(isset($_POST['action']) && $_POST['action'] == 'print_booking_detail'){
	$posted_seats 			 = $_POST['t_seats'];
	$posted_seats_price		 = $_POST['t_price'];
	$posted_seats_sum		 = $_POST['t_total'];
	$booking->print_selected_seats($posted_seats, $posted_seats_price,$posted_seats_sum);
	//return 'sucess';
}

// Get get showtime Detail for Add showtime
if(isset($_POST['action']) && $_POST['action'] == 'getshowtime_detail'){
	 $thisid 					= $_POST['showid'];
	 $getshowtime				= $_POST['getshowtime'];
	 $getshowtime_cinema		= $_POST['getshowtime_cinema'];
	 $getshowmovie				= $_POST['getshowmovie'];
	 $showtime_trailer_duration = $_POST['showtime_trailer_duration'];
	 $showtime_cleanup		    = $_POST['showtime_cleanup'];
	 $showtime_interval		    = $_POST['showtime_interval'];

	 
	 header('Content-Type: application/json');
	 echo json_encode($showtime->check_date($thisid, $getshowtime, $getshowtime_cinema, $getshowmovie, $showtime_trailer_duration, $showtime_cleanup, $showtime_interval));
}


// insert concession booking 
if(isset($_POST['action']) && $_POST['action'] == 'concession_r'){
	 $con_booking_type_id	= $_POST['s_con_id'];
	 $con_booking_type		= $_POST['s_con_type'];
	 $con_booking_price		= $_POST['s_con_price'];
	 $con_booking_qty	    = $_POST['s_con_qty'];
	

	 
	 header('Content-Type: application/json');
	 echo json_encode($concession->concession_booking($con_booking_type_id, $con_booking_type, $con_booking_price, $con_booking_qty));
}

// insert advance booking 
if(isset($_POST['action']) && $_POST['action'] == 'adv_book'){
	
	 $a_cust_name		    	= $_POST['cust_name'];	
	 $a_cust_phone			= $_POST['cust_phone'];
	 $a_cust_email			= $_POST['cust_email'];		
	 $a_cust_show_id			= $_POST['cust_show_id'];
	 $a_cust_ticket_id		= $_POST['cust_ticket_id'];
	 $a_cust_ticket_type		= $_POST['cust_ticket_type'];
	 $a_cust_seats	  	    = $_POST['cust_seats'];
	 $a_cust_seats_qty	    = $_POST['cust_seats_qty'];
	 $a_cust_price	   	    = $_POST['cust_price'];

	 header('Content-Type: application/json');
	 echo json_encode($booking->advance_booking($a_cust_name,$a_cust_phone,$a_cust_email,$a_cust_show_id,$a_cust_ticket_id, $a_cust_ticket_type, $a_cust_seats, $a_cust_seats_qty, $a_cust_price));
}

if(isset($_POST['action']) && $_POST['action'] == 'end_t_sess'){
		
	 $te		   = $_POST['test_t'];	
	 header('Content-Type: application/json');
	 echo json_encode($booking->end_ticket_session($te));
}

if(isset($_POST['action']) && $_POST['action'] == 'check_temp_showtime'){
	$selectid		= $_POST['s_id'];
	$selectvalue		= $_POST['s_value'];

	header('Content-Type: application/json');
	echo json_encode($showtime->get_temporary_showtime($selectid, $selectvalue));
}

if(isset($_POST['action']) && $_POST['action'] == 'in_showtime'){
	$tempid			= $_POST['te_id'];
	$tempvalue		= $_POST['te_value'];
	$tempmovie			= $_POST['te_movie'];
	$tempscreen		= $_POST['te_screen'];

	header('Content-Type: application/json');
	echo json_encode($showtime->i_temporary_showtime($tempid,$tempvalue,$tempmovie,$tempscreen));
}

if(isset($_POST['action']) && $_POST['action'] == 'update_temp_showtime'){
	$selectid		= $_POST['s_id'];
	$selectvalue		= $_POST['s_value'];
	$selectmovie			= $_POST['s_movie'];
	$selectscreen		= $_POST['s_screen'];


	header('Content-Type: application/json');
	echo json_encode($showtime->update_temporary_showtime($selectid, $selectvalue, $selectmovie, $selectscreen));
}


if(isset($_POST['action']) && $_POST['action'] == 'delete_temp_showtime'){
	$selectid		= $_POST['s_id'];
	


	header('Content-Type: application/json');
	echo json_encode($showtime->delete_temporary_showtime($selectid));
}


?>