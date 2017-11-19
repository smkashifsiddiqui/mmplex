<?php 
ob_start();
require_once 'common/init.php';
require 'PHPMailer/PHPMailerAutoload.php';

$item = new item();
$user = new user();
$package = new package();
$ticket = new ticket();
$person = new person();
$movie = new movie();
$screen = new screen();
$booking = new booking();
$voucher = new voucher();
$showtime = new showtime();
$concession = new concession();
$distributer = new distributer();
$foodstall = new foodstall();
$confirm_booking = new confirm_booking();
$food_category = new food_category();
$slideshow = new slideshow();


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

// create reprint session
if(isset($_POST['action']) && $_POST['action'] == 'reprint_sess'){
	$posted_seats		= $_POST['initial_seats'];
	$show_id 			= $_POST['show'];
    header('Content-Type: application/json');
	echo json_encode($booking->reprint_session($posted_seats, $show_id));
	
}


if(isset($_POST['action']) && $_POST['action'] == 'seat_avail'){
	$selected_show		= $_POST['selected_show'];
	header('Content-Type: application/json');
	echo json_encode($booking->get_locked_seats($selected_show));
}

if(isset($_POST['action']) && $_POST['action'] == 'seat_avail_all'){
	$selected_show		= $_POST['selected_show'];
	
	
	header('Content-Type: application/json');
	echo json_encode($booking->get_locked_seats_all($selected_show));
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

if(isset($_POST['action']) && $_POST['action'] == 'delete_lock_s'){
	$final_seats = $_POST['initial_seats'];
	$show		 = $_POST['show'];
	header('Content-Type: application/json');
	echo json_encode($booking->delete_locked_seats($final_seats, $show));
}

if(isset($_POST['action']) && $_POST['action'] == 'lock_seats_single'){
	$final_seats = $_POST['initial_seats'];
	$show		 = $_POST['show'];
	header('Content-Type: application/json');
	echo json_encode($booking->insert_locked_seats_single($final_seats, $show));
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
	$sin_seats			    	= $_POST['single_s'];

	header('Content-Type: application/json');
	echo json_encode($booking->insert_booking($s_id,$s_t_id,$s_t_type,$s_comp,$s_m_id,$s_d_id,$s_seats,$s_seats_qty,$s_seats_amount,$sin_seats));
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

if(isset($_POST['action']) && $_POST['action'] == 'end_reprint_sess'){
	header('Content-Type: application/json');
	echo json_encode($booking->end_reprint_session());
	//return 'sucess';
}

if(isset($_POST['action']) && $_POST['action'] == 'ins_order'){
	$total_am 			 = $_POST['s_total'];
	
	header('Content-Type: application/json');
	echo json_encode($concession->ins_order_concession($total_am));
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
	 $order_id        	    = $_POST['ord_id'];
	 $totall        	        = $_POST['total'];
	

	 
	 header('Content-Type: application/json');
	 echo json_encode($concession->concession_booking($totall,$order_id,$con_booking_type_id, $con_booking_type, $con_booking_price, $con_booking_qty));
}

// insert advance booking 
if(isset($_POST['action']) && $_POST['action'] == 'adv_book'){
	
	 $a_cust_name		    	= $_POST['cust_name'];	
	 $a_cust_phone			= $_POST['cust_phone'];
	 $a_cust_email			= $_POST['cust_email'];		
	 $a_cust_show_id			= $_POST['cust_show_id'];
	 $a_cust_ticket_id		= $_POST['cust_ticket_id'];
	 $a_cust_m_id			= $_POST['cust_m_id'];
	 $a_cust_d_id			= $_POST['cust_d_id'];
	 $a_cust_ticket_type		= $_POST['cust_ticket_type'];
	 $a_cust_seats	  	    = $_POST['cust_seats'];
	 $a_cust_seats_qty	    = $_POST['cust_seats_qty'];
	 $a_cust_price	   	    = $_POST['cust_price'];

	 header('Content-Type: application/json');
	 echo json_encode($booking->advance_booking($a_cust_m_id,$a_cust_d_id,$a_cust_name,$a_cust_phone,$a_cust_email,$a_cust_show_id,$a_cust_ticket_id, $a_cust_ticket_type, $a_cust_seats, $a_cust_seats_qty, $a_cust_price));
}

if(isset($_POST['action']) && $_POST['action'] == 'end_t_sess'){
		
	 $te		   = $_POST['test_t'];	
	 header('Content-Type: application/json');
	 echo json_encode($booking->end_ticket_session($te));
}

if(isset($_POST['action']) && $_POST['action'] == 'get_con_sess'){
		
	 header('Content-Type: application/json');
	 echo json_encode($concession->get_concession_sess());
}



if(isset($_POST['action']) && $_POST['action'] == 'end_print_ticket_sess'){
		
	 $te		   = $_POST['test_t'];	
	 header('Content-Type: application/json');
	 echo json_encode($booking->end_ticket_session($te));
}

if(isset($_POST['action']) && $_POST['action'] == 'end_user_list_sess'){
		
	
	 header('Content-Type: application/json');
	 echo json_encode($booking->end_terminal_session());
}

if(isset($_POST['action']) && $_POST['action'] == 'end_all_concession_sess'){
		
	 
	 header('Content-Type: application/json');
	 echo json_encode($concession->end_concession_sess());
}



if(isset($_POST['action']) && $_POST['action'] == 'end_pre_list_sess'){
		
	 $te		   = $_POST['test_t'];	
	 header('Content-Type: application/json');
	 echo json_encode($booking->end_previous_list_session($te));
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

if(isset($_POST['action']) && $_POST['action'] == 'del_record'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($confirm_booking->delete_record($selectid));
}

if(isset($_POST['action']) && $_POST['action'] == 'del_loc_ticket'){
	$selectid		= $_POST['to_delete'];
	$personid		= $_POST['pers'];
	
	header('Content-Type: application/json');
	echo json_encode($booking->delete_l_seat($selectid));
}

// delete movie
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_movie'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($movie->delete_movie($selectid));
}


// delete showtime
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_showtime'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($showtime->delete_showtime($selectid));
}

// delete showtime private
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_showtime_private'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($showtime->delete_showtime_private($selectid));
}

// delete distributer
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_distributer'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($distributer->delete_distributer($selectid));
}


// delete ticket
if(isset($_POST['action']) && $_POST['action'] == 'delete_printed_ticket'){
	$selectid		= $_POST['to_delete'];
	$select_per		= $_POST['pers'];
	$remarks		= $_POST['remarks'];
    $person_name	= $_POST['person_name'];
    $movie_title	= $_POST['movie_title'];
    $screen_name	= $_POST['screen_name'];
    $seat_id		= $_POST['seat_id'];
    $showtime_date		= $_POST['showtime_date'];

    $data = array();
    $data['ticket_id'] = $selectid;
    $data['person_name'] = $person_name;
    $data['movie_title'] = $movie_title;
    $data['screen_name'] = $screen_name;
    $data['seat_id'] = $seat_id;
    $data['showtime_date'] = $showtime_date;

    sendticketmail($data);
	header('Content-Type: application/json');
	echo json_encode($booking->cancel_booking($selectid,$select_per,$remarks));

}


// delete ticket
if(isset($_POST['action']) && $_POST['action'] == 'delete_con'){
	$selectid		= $_POST['to_delete'];
	$select_per		= $_POST['pers'];
	$remarks		= $_POST['remarks'];
	
	header('Content-Type: application/json');
	echo json_encode($concession->delete_concession($selectid,$select_per,$remarks));
}


// delete ticket
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_ticket'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($ticket->delete_ticket($selectid));
}

// delete item
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_item'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($item->delete_item($selectid));
}


// delete package
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_package'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($package->delete_package($selectid));
}

// delete foodstall
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_foodstal'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($foodstall->delete_foodstall($selectid));
}

//delete_record_voucher
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_voucher'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($voucher->delete_voucher($selectid));
}


//delete_record_voucher
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_screen'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($screen->delete_screen($selectid));
}

//delete_record_user
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_user'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($user->delete_user($selectid));
}

//delete_record_user
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_fcategory'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($food_category->delete_food_category($selectid));
}



//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'delete_record_person'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($person->delete_person($selectid));
}



//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'delete_slide'){
	$selectid		= $_POST['to_delete'];
	
	header('Content-Type: application/json');
	echo json_encode($slideshow->delete_slideshow($selectid));
}


//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'g_previous_sess'){

	
	header('Content-Type: application/json');
	echo json_encode($booking->get_previous_list_session());
}


if(isset($_POST['action']) && $_POST['action'] == 'terminal_sess'){
	$this_s_shw_id			= $_POST['s_shw_id'];
	$this_s_ticket_id		= $_POST['s_ticket_id'];
	$this_s_ticket_type		= $_POST['s_ticket_type'];
	$this_s_allow_comp		= $_POST['s_allow_comp'];
	$this_s_shw_key			= $_POST['s_shw_key'];
	$this_s_movie_title		= $_POST['s_movie_title'];
	$this_s_movie_id		= $_POST['s_movie_id'];
	$this_s_d_id			= $_POST['s_d_id'];
	$this_s_posted_seats	= $_POST['s_posted_seats'];
	$this_s_ticket_price	= $_POST['s_ticket_price'];
	$this_s_qty				= $_POST['s_qty'];
	$this_s_sum				= $_POST['s_sum'];

	
	header('Content-Type: application/json');
	echo json_encode($booking->terminal_list_session($this_s_shw_id,$this_s_ticket_id,$this_s_ticket_type,$this_s_allow_comp,$this_s_shw_key,$this_s_movie_title,$this_s_movie_id,$this_s_d_id,$this_s_posted_seats,$this_s_ticket_price,$this_s_qty,$this_s_sum));
}




//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'thank_sess'){
	$customer_total			= $_POST['cus_total'];
	
	header('Content-Type: application/json');
	echo json_encode($booking->thank_you_session($customer_total));
}

//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'get_thank_sess'){
	
	
	header('Content-Type: application/json');
	echo json_encode($booking->get_thank_you_session());
}

//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'unset_thank_sess'){
	sleep(5);
	header('Content-Type: application/json');
	echo json_encode($booking->unset_thank_you_session());
}

//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'get_con_by_id'){
	$item_id			= $_POST['itemid'];
	
	header('Content-Type: application/json');
	echo json_encode($concession->get_concession_details($item_id));
}

//delete_record_person
if(isset($_POST['action']) && $_POST['action'] == 'get_i_detail'){
	$itsid			= $_POST['item'];
	
	header('Content-Type: application/json');
	echo json_encode($concession->get_item_details($itsid));
}


if(isset($_POST['action']) && $_POST['action'] == 'end_con_session'){
	
	
	header('Content-Type: application/json');
	echo json_encode($concession->end_concess_session());
}

function sendticketmail($data) {

    $mail = new PHPMailer;
    $mail->isSMTP();                                   // Set mailer to use SMTP
    $mail->Host = 'mail.megamultiplex.com.pk';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'cinema@megamultiplex.com.pk';          // SMTP username
    $mail->Password = 'Cinema12345'; // SMTP password
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 26;                                 // TCP port to connect to

    $mail->setFrom('cinema@megamultiplex.com.pk', 'Mega Multiplex');
    $mail->addReplyTo('cinema@megamultiplex.com.pk', 'Mega Multiplex');
    $mail->addAddress('cinema@megamultiplex.com.pk');
	$mail->addCC('kashif@webnet.com.pk');
//$mail->addBCC('bcc@example.com');

    $mail->isHTML(true);  // Set email format to HTML
    $bodyContent = '<h3>Ticket Cancelled</h3>';
    $bodyContent .= '<br><br>';
    $bodyContent .= '<h4>Ticket ID : <span>'.$data['ticket_id'].'</span></h4>';
    $bodyContent .= '<h4>Seat ID : <span>'.$data['seat_id'] .'</span></h4>';
    $bodyContent .= '<h4>Showtime Date : <span>'.$data['showtime_date'].'</span></h4>';
    $bodyContent .= '<h4>Cancelled By : <span>'.$data['person_name'].'</span></h4>';
    $bodyContent .= '<h4>Movie Title : <span>'.$data['movie_title'].'</span></h4>';
    $bodyContent .= '<h4>Screen Name : <span>'.$data['screen_name'].'</span></h4>';

    $mail->Subject = 'Ticket Cancellation';
    $mail->Body    = $bodyContent;
    $mail->send();
}



?>
