<?php 
/**
* INVENTORY MAIN CLASS
*/
class booking extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_showtime = 'showtimes';
		$this->table_movie	= 'movies';
		$this->table_screen	= 'screens';
		$this->table_locked	= 'locked_seats';
		$this->table_name = 'bookings';
		$this->table_advanced = 'advance_bookings';
		$this->table_printed_tickets = 'printed_tickets';
		$this->table_setting = 'settings';
	}

	
	

	public function get_booking_movies()
	{
			$this->where('movie_status','active');
			$this->inner_join('distributers', 'd', 'd.dist_id = movies.movie_distributer_id');
			$this->order_by('movie_id', 'DESC');
			$this->from($this->table_movie);
			return $this->all_results();
	

} // end of get_booking_movies

public function get_printed_tic()
	{
			$this->left_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
			$this->inner_join('printed_tickets', 'p', 'p.printed_ticket_booking_id = bookings.booking_id');
			
			$this->where('booking_cancel','no');
			$this->from($this->table_name);
			return $this->all_results();
	

} // end of get_booking_movies


public function get_booked_tickets($max_record)
	{		
			$this->where('booking_cancel','no');
			$this->inner_join('printed_tickets', 'p', 'p.printed_ticket_booking_id = bookings.booking_id');
			$this->left_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
			
			$this->right_join('screens', 's', 's.screen_id = bookings.booking_screen');
			$this->order_by('booking_id', 'DESC');
			$this->from($this->table_name, $max_record );
			return $this->all_results();
	

} // end of get_booking_movies

public function get_booked_tickets_by_id($t_id)
	{		
			$this->where('booking_cancel','no');
			$this->inner_join('printed_tickets', 'p', 'p.printed_ticket_booking_id = bookings.booking_id');
			$this->left_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
			$this->where('p.printed_ticket_unique_id',$t_id);
			$this->right_join('screens', 's', 's.screen_id = bookings.booking_screen');
			$this->order_by('booking_id', 'DESC');
			$this->from($this->table_name);
			return $this->all_results();
	

} // end of get_booking_movies

public function all_locked_seats($max_record)
	{

        	$this->order_by('locked_seat_id', 'DESC');
			$this->left_join('showtimes', 's', 's.showtime_id = locked_seats.locked_seat_showtime_id');
        	$this->left_join('screens', 'sc', 'sc.screen_id = s.showtime_screen_id');
			$this->from($this->table_locked, $max_record );
			return $this->all_results();
	

} // end of all_locked_seats

    public function locked_seats_by_seatno($seat_no)
    {

        $this->order_by('locked_seat_id', 'DESC');
        $this->left_join('showtimes', 's', 's.showtime_id = locked_seats.locked_seat_showtime_id');
        $this->left_join('screens', 'sc', 'sc.screen_id = s.showtime_screen_id');
        $this->where('locked_seat_name',$seat_no);
        $this->from($this->table_locked);
        return $this->all_results();


    } // end of locked_seats_by_seatno

    public function all_locked_seats_by_date($lockdate)
    {

        $this->order_by('locked_seat_id', 'DESC');
        $this->left_join('showtimes', 's', 's.showtime_id = locked_seats.locked_seat_showtime_id');
        $this->left_join('screens', 'sc', 'sc.screen_id = s.showtime_screen_id');
        $this->where('locked_seat_ts',$lockdate);
        //print_r($this); die();
        $this->from($this->table_locked);
        return $this->all_results();


    } // end of all_locked_seats_by_date

	public function get_booked_tic($t_id)
	{
			
			$this->where('booking_id',$t_id);
			$this->where('booking_cancel','no');
			$this->inner_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
			$this->left_join('screens', 's', 's.screen_id = bookings.booking_screen');
			$this->from($this->table_name);
			return $this->result();
	

} // end of get_booking_movies


public function get_movies_count()
	{	
		$this->where('movie_status', 'planed');
		$this->from($this->table_movie);
		return $this->row_count();
	}

public function get_booking_showtimes($ID = NULL)
	{
			$this->where('movie_id',$ID);
			$this->where('showtime_key','public');
			$this->where('showtime_status','open');
			$this->inner_join('movies', 'd', 'd.movie_id = showtimes.showtime_movie_id');
			$this->left_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
			$this->order_by('showtime_datetime', 'ASC');
		
			$this->from($this->table_showtime);
			return $this->all_results();
		
	} // end of get

public function get_booking_screens($showtime_screen_id = NULL)
	{
		if (isset($showtime_screen_id)) {
			
			
			$this->where('showtime_id',$showtime_screen_id);
			$this->where('showtime_status','open');
			$this->inner_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
			$this->left_join('bookings', 'b', 'b.booking_showtime_id = showtimes.showtime_id');
			$this->right_join('movies', 'm', 'm.movie_id = showtimes.showtime_movie_id');
			$this->from($this->table_showtime);
			return $this->result();
		}
		else {
			$this->from($this->table_showtime);
			return $this->all_results();
		}
	} // end of get

	public function get_locked_seats($selected_show = NULL)
	{
			
			if (isset($selected_show)) {
			$this->where('locked_seat_showtime_id', $selected_show);
			$this->from($this->table_locked);

			return $this->result();
		}
		else {
			$this->from($this->table_locked);
			return $this->all_results();
		}
		
	} // end of get
	
	
		public function get_locked_seats_all($selected_show = NULL)
	{
			
			
			$this->where('locked_seat_showtime_id', $selected_show);
			$this->from($this->table_locked);

		    return $this->all_results();
		
		
	} // end of get
	

	public function insert_locked_seats($final_seats, $show)
	{
		$lockseats = array();

		$lockseats['locked_seat_showtime_id'] = $show;
		if(isset($final_seats)){
			$lockseats['locked_seat_name'] = json_encode($final_seats);
		}
		

		$this->where('locked_seat_showtime_id', $show);
		if($this->delete($this->table_locked, $num_rows = NULL)){
			
			$this->insert($this->table_locked, $lockseats);

			return $this->row_count();
		}
		//print_f($data);
		//die();
			
		

	} // end of insert
	
	
	
	public function delete_locked_seats($final_seats, $show)
	{
		
		$this->where('locked_seat_showtime_id', $show);
		$this->where('locked_seat_name', $final_seats);
		
		if($this->delete($this->table_locked, $num_rows = NULL)){
			return true;
		}else{
		return false;
		}
		

	} // end of insert
	
	public function delete_l_seat($selectid)
	{
		
		
		$this->where('locked_seat_id', $selectid);
		
		if($this->delete($this->table_locked, $num_rows = NULL)){
			return true;
		}else{
		return false;
		}
		

	} // end of insert
	
	public function insert_locked_seats_single($final_seats, $show)
	{
		$this->where('locked_seat_showtime_id', $show);
		$this->where('locked_seat_name', $final_seats);
		$this->from($this->table_locked);
		if($this->row_count() > 0){

			return false;

		}else{
		
		$lockseats = array();
		$lockseats['locked_seat_showtime_id'] = $show;
		if(isset($final_seats)){
			$lockseats['locked_seat_name'] = $final_seats;
		}
		
		$this->insert($this->table_locked, $lockseats);
		return $this->row_count();
		}

	} // end of insert

	

public function screen_session($front_booking_show_id,$front_booking_mv_id)
	{
		$_SESSION['front_booking_show_id'] = $front_booking_show_id;
		$_SESSION['front_booking_mv_id'] = $front_booking_mv_id;
		
		 return 'sucess';
	} // end of insert







	public function print_selected_seats($posted_seats, $posted_seats_price,$posted_seats_sum)
	{
		$_SESSION['seleted_seats']['seats'] = $posted_seats;
		$_SESSION['seleted_seats']['prices'] = $posted_seats_price;
		$_SESSION['seleted_seats']['sum'] = $posted_seats_sum;


		$_SESSION['terminal_list'][] = $_SESSION['seleted_seats'];
		return $_SESSION['terminal_list'];
	} // end of insert



public function end_terminal_session()
	{
		
		unset($_SESSION['terminal_list']); 
		return true;
	} // end of insert

	public function get_terminal_session()
	{
		if(isset($_SESSION['terminal_list'])){
			return $_SESSION['terminal_list'];
		}else{
			return false;
		}
		
	} // end of insert


public function end_ticket_session($te)
	{
		unset($_SESSION['all_print_ticket']); 
		return true;
	} // end of insert

public function end_previous_list_session($te)
	{
		if(isset($_SESSION['all_previous_list'])){
			unset($_SESSION['all_previous_list']); 
			return true;
		}else{
			return true;
		}
		
	} // end of insert

public function get_previous_list_session()
	{
		if(isset($_SESSION['all_previous_list'])){
			return $_SESSION['all_previous_list'];
		}
		
		return true;
	} // end of insert

	

	public function thank_you_session($customer_total)
	{
		if(isset($_SESSION['get_thank_you'])){
			
			unset($_SESSION['get_thank_you']);
			
		}
		else {
			$_SESSION['get_thank_you'] = $customer_total;
			return $_SESSION['get_thank_you'];
		}
		
	} // end of insert

	public function get_thank_you_session()
	{
		if(isset($_SESSION['get_thank_you'])){
			return $_SESSION['get_thank_you'];
		}
		
		return false;
	} // end of insert
	
	public function unset_thank_you_session()
	{
		if(isset($_SESSION['get_thank_you'])){
			unset($_SESSION['get_thank_you']);
			return true;
		}
		
		return true;
	} // end of insert
	
	public function insert_booking($s_id,$s_t_id,$s_t_type,$s_comp,$s_m_id,$s_d_id,$s_seats,$s_seats_qty,$s_seats_amount,$sin_seats)
	{
		$data = array();

		
		
		$data['booking_showtime_id']	    =  	$s_id;	 
		$data['booking_ticket_id']			=  	$s_t_id;
		$data['booking_ticket_type']		=  	$s_t_type;	
		$data['booking_iscomplimentary']	=  	$s_comp;
		$data['booking_movie']				=  	$s_m_id;
		$data['booking_distributer']		=  	$s_d_id;	
			
		$data['booking_seats_number']		=  	json_encode($s_seats);
		$data['booking_seats']				=  	$sin_seats;			
		$data['booking_seat_qty']			=  	$s_seats_qty;		 
		$data['booking_price']				=  	$s_seats_amount; 
		$data['booking_date']				=  	$this->_date('Y-m-d H:i:s', date('d-m-Y'));	
		$data['booking_showtime_key']		=  	'public';
		$data['booking_cancel']				=  	'no';
        
		$this_showtime = $this->get_showtime_by_id($s_id);
		$data['booking_showtime']	       =  $this_showtime->showtime_datetime;
		$data['booking_showdate']	       =  $this->_date('Y-m-d', $this_showtime->showtime_datetime);
		$data['booking_screen']	           =  $this_showtime->showtime_screen_id;
		$data['booking_user']	           =  $_SESSION['user']->id;

		
			
		$this->insert($this->table_name, $data);

		if($this->row_count() > 0){
		$inserted_id = $this->last_id();
		
			$_SESSION['print_ticket']['showtime']    = $s_id;
			$_SESSION['print_ticket']['seatnumber']  = json_encode($s_seats);
			$_SESSION['print_ticket']['price']		 = $s_seats_amount;
			$_SESSION['print_ticket']['inserted_id'] = $inserted_id; 
			$_SESSION['all_print_ticket'][] = $_SESSION['print_ticket'];
			$_SESSION['thank_you_ticket'] = 'yes'; 
			return $_SESSION['all_print_ticket'];
			
		 
		}
		

	} // end of insert

	
	//create reprint session
public function reprint_session($posted_seats, $show_id)
	{
		$_SESSION['reprint']['shw_id'] 		= $show_id;
		$_SESSION['reprint']['seat_num'] 	= $posted_seats;
		$_SESSION['reprint_ses'][] = $_SESSION['reprint'];
			
		return $_SESSION['reprint_ses'];
	}
	
//insert printed tickets
public function insert_printed_tickets($t_b_id,$t_u_id,$t_sh_id,$t_mv_id,$t_sc_id,$t_seat,$t_price,$t_userid,$t_username,$t_sh_t,$t_batch)
	{
		$result = $this->check_ticket_booking_id($t_b_id);
		if(!$result){
		
		$data = array();

		$data['printed_ticket_booking_id']	  	    =  	$t_b_id;	 
		$data['printed_ticket_unique_id']			=  	$t_u_id;
		$data['printed_ticket_showtime_id']			=  	$t_sh_id;
		$data['printed_ticket_showtime']			=  	$t_sh_t;		
		$data['printed_ticket_movie_id']			=  	$t_mv_id;
		$data['printed_ticket_screen_id']			=  	$t_sc_id;
		$data['printed_ticket_seat_id']				=  	$t_seat;	
		$data['printed_ticket_price']				=  	$t_price;	 
		$data['printed_ticket_terminal_user_id']	=  	$t_userid;		 
		$data['printed_ticket_terminal_user_name']	=  	$t_username; 
		$data['printed_ticket_batch_id']	=  	$t_batch; 
		$data['printed_ticket_cancel']	=  	'no'; 
		
		$this->insert($this->table_printed_tickets, $data);

		return $this->row_count();
		}else{
			return false;
		}
	}

//get ticket information by booking id
public function check_ticket_booking_id($inserted_id)
	{
		
			$this->where('printed_ticket_booking_id',$inserted_id);
			$this->from($this->table_printed_tickets);
			return $this->result();
		}

	public function terminal_list_session($this_s_shw_id,$this_s_ticket_id,$this_s_ticket_type,$this_s_allow_comp,$this_s_shw_key,$this_s_movie_title,$this_s_movie_id,$this_s_d_id,$this_s_posted_seats,$this_s_ticket_price,$this_s_qty,$this_s_sum)
	{
		$data = array();

		//$_SESSION['previous_list']['showtime']    = $this_s_shw_id;
		$_SESSION['previous_list']['shw_id'] 		= $this_s_shw_id;
		$_SESSION['previous_list']['ticket_id'] 	= $this_s_ticket_id;
		$_SESSION['previous_list']['ticket_type'] 	= $this_s_ticket_type;
		$_SESSION['previous_list']['allow_comp'] 	= $this_s_allow_comp;
		$_SESSION['previous_list']['shw_key'] 		= $this_s_shw_key;
		$_SESSION['previous_list']['movie_title']   = $this_s_movie_title;
		$_SESSION['previous_list']['movie_id'] 		= $this_s_movie_id;
		$_SESSION['previous_list']['d_id'] 			= $this_s_d_id;
		$_SESSION['previous_list']['posted_seats'] 	= $this_s_posted_seats;
		$_SESSION['previous_list']['ticket_price'] 	= $this_s_ticket_price;
		$_SESSION['previous_list']['qty'] 			= $this_s_qty;
		$_SESSION['previous_list']['sum'] 			= $this_s_sum;

		
		$_SESSION['all_previous_list'][] = $_SESSION['previous_list'];
		
	   return $_SESSION['all_previous_list'];
			
	} // end of insert

	public function get_booked_seats($showtime_id)
	{
		
			$this->where('booking_showtime_id',$showtime_id);
			$this->where('booking_cancel','no');
			$this->from($this->table_name);
			return $this->all_results();
		
		
	} // end of get

	public function advance_booking($a_cust_m_id,$a_cust_d_id,$a_cust_name,$a_cust_phone,$a_cust_email,$a_cust_show_id,$a_cust_ticket_id, $a_cust_ticket_type, $a_cust_seats, $a_cust_seats_qty, $a_cust_price)
	{
		$data = array();

		$data['advance_b_customer_name'] =  $a_cust_name;
		$data['advance_b_phone']	   	=  	$a_cust_phone;
		$data['advance_b_user_email']   =  	$a_cust_email;
		$data['advance_b_showtime_id']  =  	$a_cust_show_id;		 
		$data['advance_b_ticket_id']	=  	$a_cust_ticket_id; 
		$data['advance_b_ticket_type']	=  	$a_cust_ticket_type;
		$data['advance_b_movie']		=  	$a_cust_m_id;
		$data['advance_b_distributer']	=  	$a_cust_d_id;

		$data['advance_b_showtime_key']	=  	'advance';
		$data['advance_b_seats_number']	=  	json_encode($a_cust_seats);	
		$data['advance_b_seat_qty']		=  	$a_cust_seats_qty;		 
		$data['advance_b_price']		=  	$a_cust_price; 
		$data['advance_b_date']			=  	$this->_date('Y-m-d H:i:s', date('d-m-Y'));	
		$data['advance_b_status']		=  	'no';
		
		$count = 0;
		$array_len = count($a_cust_seats);
		foreach($a_cust_seats as $value){
			$this->where('locked_seat_showtime_id', $a_cust_show_id);
			$this->where('locked_seat_name', $value);
			$this->delete($this->table_locked, $num_rows = NULL);
			
			if($count == $array_len ){
				
			}
			$count++;
		}
		
		$this->insert($this->table_advanced, $data);
		return $this->row_count();
	
	} // end of insert

	public function get_advance_booked_seats($a_showtime_id)
	{
		
			$this->where('advance_b_showtime_id',$a_showtime_id);
			$this->where('advance_b_status','no');
			$this->from($this->table_advanced);
			return $this->all_results();
		
		
	} // end of get


	public function booked_seats_qty($s_id)
	{
		
			$this->where('booking_showtime_id',$s_id);
			$this->where('booking_cancel','no');
			$this->from($this->table_name);
			return $this->all_results();
		
		
	} // end of get

	public function adv_booked_seats_qty($s_id)
	{
		
			$this->where('advance_b_showtime_id',$s_id);
			$this->from($this->table_advanced);
			return $this->all_results();
		
		
	} // end of get


public function get_showtime_by_id($showtime_id)
	{
		
			$this->where('showtime_id',$showtime_id);
			$this->from($this->table_showtime);
			return $this->result();
		
	} // end of get
	
	
	public function get_logo()
	{
		
		$this->where('setting_name','logo');
		$this->from($this->table_setting);
		return $this->result();
		
	} // end of get
	
public function cancel_booking($id,$select_per,$remarks)
	{
		$data = array();

		$data['booking_cancel'] = 'yes';
		$data['booking_cancel_remarks'] = $remarks;
		$data['booking_cancel_time'] = $this->_date('Y-m-d H:i:s', date('Y-m-d h:i:s'));	
		$data['booking_cancel_user'] = $select_per;
		
		

		$this->where('booking_id',$id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}else{
			
			$data1 = array();

			$data1['printed_ticket_cancel'] = 'yes';
			$this->where('printed_ticket_booking_id',$id);
			$this->update($this->table_printed_tickets, $data1);
			if (!$this->row_count()) {
			return false;}
			else{
				return true;
			}
		}
		
		
		
	} // end of get


	public function get_reprinted_details($sh_id, $s_id)
	
	{		$this->inner_join('screens', 's', 's.screen_id = bookings.booking_screen');
			$this->right_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
			$this->left_join('printed_tickets', 'p', 'p.printed_ticket_booking_id = bookings.booking_id');
			$this->where('booking_showtime_id',$sh_id);
			$this->where('booking_seats',$s_id);
			$this->from($this->table_name);
			return $this->all_results();
		
		
	} // end of get
	
	
	public function get_last_inserted_batch($b_id)
	
	{		$this->inner_join('screens', 's', 's.screen_id = bookings.booking_screen');
			$this->right_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
			$this->left_join('printed_tickets', 'p', 'p.printed_ticket_booking_id = bookings.booking_id');
			$this->where('booking_id',$b_id);
			$this->where('booking_cancel','no');
			$this->from($this->table_name);
			return $this->all_results();
		
		
	} // end of get
	
	public function get_last_batch($user_id)
	{	
			
		$this->where('printed_ticket_terminal_user_name', $user_id);
		$this->order_by('printed_tickets.printed_ticket_id', 'DESC');
		$this->from($this->table_printed_tickets, 1);
		return $this->all_results();
		
		
	} // end of get
	
	public function get_last_batch_tickets($batch_id)
	{	
			
		$this->where('printed_ticket_batch_id', $batch_id);
		$this->from($this->table_printed_tickets);
		return $this->all_results();
		
		
	} // end of get
	
	
	public function end_reprint_session()
	{
		if(isset($_SESSION['reprint_ses'])){
			unset($_SESSION['reprint_ses']);
			return true;
		}
		
		return true;
	} // end of insert
	
}// end of class
?>
