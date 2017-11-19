<?php 
// Capabilities
$capabilities = array();

$capabilities['add_user'] = 'Add User';
$capabilities['add_film'] = 'Add Film';
$capabilities['add_distributer'] = 'Add Distributer';
$capabilities['add_screen'] = 'Add Screen';
$capabilities['add_sowtime'] = 'Add Showtime';
$capabilities['add_timing'] = 'Add interval/trailor/cleanup';
$capabilities['add_ticket'] = 'Add Ticket';
$capabilities['add_voucher'] = 'Add Voucher';
$capabilities['add_concession'] = 'Add Concession';
$capabilities['add_foodstall'] = 'Add Food Stall';
$capabilities['book_ticket'] = 'Book Ticket';
$capabilities['cancel_ticket'] = 'Cancel Ticket';
$capabilities['cancel_old_ticket'] = 'Cancel Old Ticket';
$capabilities['cancel_lock_seats'] = 'Cancel Locked seats';
$capabilities['book_adv_ticket'] = 'Book Advance Ticket';
$capabilities['book_concession'] = 'Book Concession';
$capabilities['cancel_concession'] = 'Cancel Concession';
$capabilities['view_terminal'] = 'View Terminal';
$capabilities['add_settings'] = 'Add Settings';
$capabilities['view_reports'] = 'View Reports';

$capabilities['seat_booking_by_day'] = 'View Total Seat Booking by day report';
$capabilities['current_booking_by_day'] = 'View Current Seat Booking by day report';
$capabilities['adv_booking_by_day'] = 'View Advance Booking by day report';
$capabilities['ticket_sale_by_movie'] = 'View Ticket sales by movie report';
$capabilities['num_ticket_sale_by_movie'] = 'View Number of Ticket sales by movie report';
$capabilities['adv_ticket_sale_by_movie'] = 'View Advance Ticket sales by movie report';
$capabilities['num_adv_ticket_sale_by_movie'] = 'View Number of Advance Ticket sales by movie report';
$capabilities['cash_by_all_user'] = 'View Ticket Cash in hand by day report';
$capabilities['cash_by_user'] = 'View Ticket Cash in hand by User report';
$capabilities['cancel_tickets_report'] = 'View Ticket Cancellation by Day report';


$capabilities['item_sale_r'] = 'View Item Sales report';
$capabilities['single_item_sale_r'] = 'View Single Item Sales report';
$capabilities['item_sale_u'] = 'View Single Item Sales by User report';
$capabilities['package_sale'] =       'View Package Sales report';
$capabilities['single_package_sale'] = 'View Single Package Sales report';
$capabilities['package_sale_u'] = 'View Package Sales by User report';
$capabilities['con_can_r'] = 'View Concession Cancellation by Day report';
$capabilities['con_sale_u'] = 'View Concession Sale by all User report';


// Designation
$designation = array();

$designation['sales_person'] = 'Sale Person';
$designation['depart_incharge'] = 'Depart Incharge';
$designation['manager'] = 'Manager';

// User Login Detail
//$user_shift_number = 9;
//$user_terminal_point_number = 13;



// Movie Contract Type
$movie_contract_type = array();

$movie_contract_type['monthly']	= 'Monthly';
$movie_contract_type['fixed'] 	= 'Fixed';

// Movie status Type
$status = array();

$status['active']	= 'Active';
$status['planed'] 	= 'Planned';
$status['inactive'] 	= 'Inactive';

//actors role 
$movie_actors_role = array();

$movie_actors_role['director']	= 'Director';
$movie_actors_role['producer'] 	= 'Producer';
$movie_actors_role['actor'] 	= 'Actor';
$movie_actors_role['writer'] 	= 'Writer';

//showtime status 
$showtime_status = array();

$showtime_status['open'] 	= 'Open';
$showtime_status['planned']	= 'Planned';
$showtime_status['closed'] 	= 'Closed';

//week days 
$week_days = array();

$week_days['friday'] 	 	= 'Friday';
$week_days['saturday']	= 'Saturday';
$week_days['sunday'] 	= 'Sunday';
$week_days['monday'] 	= 'Monday';
$week_days['tuesday'] 	= 'Tuesday';
$week_days['wednesday'] = 'Wednesday';
$week_days['thursday'] 	= 'Thursday';

//week days 
$measuring_units = array();

$measuring_units['bag'] 		= 'Bag';
$measuring_units['bottle']	= 'Bottle';
$measuring_units['box'] 		= 'Box';
$measuring_units['cup'] 		= 'Cup';
$measuring_units['each'] 		= 'Each';
$measuring_units['kilogram']  = 'Kilogram';
$measuring_units['litre'] 	= 'Litre';
$measuring_units['ounce'] 	= 'Ounce';
$measuring_units['pack'] 		= 'Pack';
$measuring_units['pound']	    = 'Pound';
$measuring_units['serving'] 	= 'Serving';
$measuring_units['slice'] 	= 'Slice';


$normal_option = array();
$normal_option['yes']    = 'Yes';
$normal_option['no']     = 'No';


$s_option = array();
$s_option[0]    = 'UNPAID';
$s_option[1]     = 'PAID';

//ticket class 
$ticket_class = array();

$ticket_class['platinum'] 	= 'Platinum';
$ticket_class['gold']		= 'Gold';
$ticket_class['silver'] 	= 'Silver';

//ticket class 
$confirm = array();

$confirm['yes'] 	= 'Yes';
$confirm['no']		= 'No';

//ticket type 
$ticket_type = array();

$ticket_type['standard'] 	 = 'Standard';
$ticket_type['complimentary'] = 'Complimentary';
$ticket_type['redemption'] = 'Redemption';


//showtime color 
$showtime_color = array();

$showtime_color['pink'] 	 = 'Pink';
$showtime_color['blue'] = 'Blue';
$showtime_color['yellow'] = 'Yellow';
$showtime_color['green'] = 'Green';

//showtime color 


$bg_color = array();

$bg_color['pink'] 	 = 'Pink';
$bg_color['blue'] = 'Blue';
$bg_color['yellow'] = 'Yellow';
$bg_color['green'] = 'Green';
$bg_color['#000000'] = '#000000';
$bg_color['#FF0000'] = '#FF0000';
$bg_color['#00FF00'] = '#00FF00';
$bg_color['#0000FF'] = '#0000FF';
$bg_color['#FFFF00'] = '#FFFF00';
$bg_color['#00FFFF'] = '#00FFFF';
$bg_color['#FF00FF'] = '#FF00FF';
$bg_color['#C0C0C0'] = '#C0C0C0';
$bg_color['#E00000 '] = '#E00000 ';
$bg_color['#0000FF'] = '#0000FF';
$bg_color['#330033'] = '#330033';
$bg_color['#333399'] = '#333399';
$bg_color['#660033'] = '#660033';
$bg_color['#9933FF'] = '#9933FF';
$bg_color['#99FFCC'] = '#99FFCC';
$bg_color['#CCCC33'] = '#CCCC33';
$bg_color['#FF0033'] = '#FF0033';
$bg_color['#FF6600'] = '#FF6600';
$bg_color['#FFCC00'] = '#FFCC00';
$bg_color['#6600CC'] = '#6600CC';
$bg_color['#003300'] = '#003300';
$bg_color['#015487'] = '#015487';
$bg_color['#ed1c24'] = '#ed1c24';
$bg_color['#149fb0'] = '#149fb0';
$bg_color['#e3752c'] = '#e3752c';
$bg_color['#e55e7e'] = '#e55e7e';
$bg_color['#03c9ab'] = '#03c9ab';


// Movie Contract Type
$stall_contract_type = array();

$stall_contract_type['yearly']	= 'Yearly';




?>