<?php 
/**
* INVENTORY MAIN CLASS
*/
class reports extends database
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
		$this->table_concession = 'concession_bookings';
		$this->table_item = 'items';
		$this->table_voucher_booking = 'voucher_bookings';
		$this->table_tickets = 'tickets';
		$this->con_order = 'concession_order';
		
		
	}

	
	

	public function get_film_by_distributers($dist_id = NULL)
	{
			$this->where('movie_distributer_id',$dist_id);
			$this->from($this->table_movie);
			return $this->all_results();
	

} // end of get

public function get_show_by_time($r_start_date = NULL, $r_end_date= NULL)
	{
	
	if (!empty($r_start_date) && !empty($r_end_date)) {
	 		 $this->where('showtime_datetime', array($r_start_date,$r_end_date), 'BETWEEN');
		 }else

		if (!empty($r_start_date)) {
	  		$this->where('showtime_datetime',$r_start_date);
		 }

	  	$this->inner_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
	  	$this->right_join('movies', 'm', 'm.movie_id = showtimes.showtime_movie_id');

		$this->from($this->table_showtime);
		return $this->all_results();
		
	} // end of get

/*
public function get_item_sales($r_start_date = NULL, $r_end_date= NULL)
	{
	
	if (!empty($r_start_date) && !empty($r_end_date)) {
	 		 $this->where('con_booking_ts', array($r_start_date,$r_end_date), 'BETWEEN');
		 }else

		if (!empty($r_start_date)) {
	  		$this->where('con_booking_ts',$r_start_date);
			 $this->where('con_booking_cancel','no');
		 }

	  	$this->inner_join('items', 'i', 'i.item_id = concession_bookings.con_booking_type_id');
	  	
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get
*/

public function get_item_sales($r_start_date = NULL)
	{
		
		$this->force_select_all();
		
		// print_f($r_start_date);
		$currentDate = strtotime($r_start_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($r_start_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	    $this->where('con_booking_ts', array($start_date,$end_date), 'BETWEEN');
	  
	 	$this->where('con_booking_cancel','no');
		$this->where('con_booking_type','item');

	  	$this->inner_join('items', 'i', 'i.item_id = concession_bookings.con_booking_type_id');
		$this->select(array('SUM(concession_bookings.con_booking_qty)' => 'qty'));
		$this->select(array('SUM(concession_bookings.con_booking_amount)' => 'amount'));	  	

	 	$this->group_by('concession_bookings.con_booking_type_id');
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get	

public function get_item_sales_by_user($r_start_date = NULL, $user_id = NULL)
	{
		
		$this->force_select_all();

		// print_f($r_start_date);
		$currentDate = strtotime($r_start_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($r_start_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	    $this->where('con_booking_ts', array($start_date,$end_date), 'BETWEEN');
	 	$this->where('con_booking_cancel','no');
		$this->where('con_booking_type','item');
		$this->where('con_booking_user',$user_id);


	  	$this->inner_join('items', 'i', 'i.item_id = concession_bookings.con_booking_type_id');
		$this->left_join('users', 'u', 'u.user_id = concession_bookings.con_booking_user');
		$this->select(array('SUM(concession_bookings.con_booking_qty)' => 'qty'));
		$this->select(array('SUM(concession_bookings.con_booking_amount)' => 'amount'));	  	

	 	$this->group_by('concession_bookings.con_booking_type_id');
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get	
	
public function get_item_sales_by_id($r_start_date, $item)
	{
	
	$this->force_select_all();
	
	 // print_f($r_start_date);
		$currentDate = strtotime($r_start_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($r_start_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	    $this->where('con_booking_ts', array($start_date,$end_date), 'BETWEEN');
		$this->where('con_booking_cancel','no');

		 
	if (!empty($item)) {
			
	 		 $this->where('con_booking_type_id',$item);
		 }
		
		$this->select(array('SUM(concession_bookings.con_booking_qty)' => 'qty'));
		$this->select(array('SUM(concession_bookings.con_booking_amount)' => 'amount'));
		
	  	$this->inner_join('items', 'i', 'i.item_id = concession_bookings.con_booking_type_id');
	 
		
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get

/*
public function get_package_sales($r_start_date = NULL, $r_end_date= NULL)
	{
	
	if (!empty($r_start_date) && !empty($r_end_date)) {
	 		 $this->where('con_booking_ts', array($r_start_date,$r_end_date), 'BETWEEN');
		 }else

		if (!empty($r_start_date)) {
	  		$this->where('con_booking_ts',$r_start_date);
			 $this->where('con_booking_cancel','no');
		 }

	  	$this->inner_join('packages', 'p', 'p.package_id = concession_bookings.con_booking_type_id');
	  	
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get
*/

public function get_package_sales($r_start_date = NULL)
	{
	
		$this->force_select_all();
		
		// print_f($r_start_date);
		$currentDate = strtotime($r_start_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($r_start_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	    $this->where('con_booking_ts', array($start_date,$end_date), 'BETWEEN');
		
		
	 	$this->where('con_booking_cancel','no');
		$this->where('con_booking_type','package');

	  	$this->inner_join('packages', 'p', 'p.package_id = concession_bookings.con_booking_type_id');
		$this->select(array('SUM(concession_bookings.con_booking_qty)' => 'qty'));
		$this->select(array('SUM(concession_bookings.con_booking_amount)' => 'amount'));	  	

	 	$this->group_by('concession_bookings.con_booking_type_id');
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get



public function get_package_sales_by_user($r_start_date = NULL, $user_id = NULL)
	{
	
		$this->force_select_all();
		
		// print_f($r_start_date);
		$currentDate = strtotime($r_start_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($r_start_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	    $this->where('con_booking_ts', array($start_date,$end_date), 'BETWEEN');
		
	 	$this->where('con_booking_cancel','no');
		$this->where('con_booking_type','package');
		$this->where('con_booking_user',$user_id);

	  	$this->inner_join('packages', 'p', 'p.package_id = concession_bookings.con_booking_type_id');
		$this->left_join('users', 'u', 'u.user_id = concession_bookings.con_booking_user');
		$this->select(array('SUM(concession_bookings.con_booking_qty)' => 'qty'));
		$this->select(array('SUM(concession_bookings.con_booking_amount)' => 'amount'));	  	

	 	$this->group_by('concession_bookings.con_booking_type_id');
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get


public function get_package_sales_by_id($r_start_date, $item)
	{
	
	$this->force_select_all();
	// print_f($r_start_date);
		$currentDate = strtotime($r_start_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($r_start_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	    $this->where('con_booking_ts', array($start_date,$end_date), 'BETWEEN');
	 
		 
	if (!empty($item)) {
			
	 		 $this->where('con_booking_type_id',$item);
			  $this->where('con_booking_cancel','no');
		 }
		
		$this->select(array('SUM(concession_bookings.con_booking_qty)' => 'qty'));
		$this->select(array('SUM(concession_bookings.con_booking_amount)' => 'amount'));
		
	  	$this->inner_join('packages', 'p', 'p.package_id = concession_bookings.con_booking_type_id');
	  	
	  	$this->from($this->table_concession);
		return $this->all_results();
		
	} // end of get
	
public function get_item_details($ID)
	{
			$this->where('item_id', $ID);
			$this->from($this->table_item);
			return $this->all_results();

	} // end of get

public function get_ticket_detail($ID)
	{
			$this->where('ticket_id', $ID);
			$this->from($this->table_tickets);
			return $this->all_results();

	} // end of get

public function get_normal_ticket_sales($m_id = NULL, $d_id = NULL,$s_id = NULL, $s_date = NULL, $e_date = NULL,$filter_id)
 {
 		

	  if (isset($m_id) && $filter_id == 'showtime_movie_id') {
	   $this->where('booking_movie',$m_id);
	  }

	  if (isset($d_id) && $filter_id == 't_distributer_id') {
	   $this->where('booking_distributer',$d_id);
	  }

	  if (isset($s_id) && $filter_id == 't_showtime_id') {
	   $this->where('booking_showtime_id',$s_id);
	  }

	  if (!empty($s_date) && !empty($e_date)) {
	 		 $this->where('booking_ts', array($s_date,$e_date), 'BETWEEN');
		 }

	
	$this->inner_join('showtimes', 's', 's.showtime_id = bookings.booking_showtime_id');
	$this->left_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
	$this->right_join('distributers', 'd', 'd.dist_id = bookings.booking_distributer');

	  $this->where('booking_cancel','no');
	  $this->from($this->table_name);
	  return $this->all_results();
 } // End of Sales Report


 public function get_corporate_ticket_sales($m_id = NULL, $d_id = NULL,$s_id = NULL, $s_date = NULL, $e_date = NULL,$filter_id)
 {
 		

	  if (isset($m_id) && $filter_id == 'showtime_movie_id') {
	   $this->where('voucher_movie_id',$m_id);
	  }

	  if (isset($d_id) && $filter_id == 't_distributer_id') {
	   $this->where('voucher_dist_id',$d_id);
	  }

	  if (isset($s_id) && $filter_id == 't_showtime_id') {
	   $this->where('voucher_show_id',$s_id);
	  }

	  if (!empty($s_date) && !empty($e_date)) {
	 		 $this->where('voucher_ts', array($s_date,$e_date), 'BETWEEN');
		 }else

		if (!empty($s_date)) {
	  		$this->where('voucher_ts',$s_date);
		 }
	  
	$this->inner_join('showtimes', 's', 's.showtime_id = voucher_bookings.voucher_show_id');
	$this->left_join('vouchers', 'v', 'v.voucher_id = voucher_bookings.voucher_type_id');
	$this->right_join('screens', 'c', 'c.screen_id = voucher_bookings.voucher_screenid');

	  $this->group_by('voucher_bookings.voucher_show_id');
	  $this->from($this->table_voucher_booking);
	  return $this->all_results();
 } // End of Sales Report

public function get_film_rental_public($m_id = NULL,$s_date = NULL, $e_date = NULL,$filter_id)
 {
 		

	  if (isset($m_id) && $filter_id == 'showtime_movie_id') {
	   $this->where('booking_movie',$m_id);
	  }

	 
	  if (!empty($s_date) && !empty($e_date)) {
	 		 $this->where('booking_ts', array($s_date,$e_date), 'BETWEEN');
		 }else

		if (!empty($s_date)) {
	  		$this->where('booking_ts',$s_date);
		 }
	  
	$this->inner_join('showtimes', 's', 's.showtime_id = bookings.booking_showtime_id');
	$this->left_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
	
	  $this->where('booking_cancel','no');
	  $this->group_by('bookings.booking_showtime_id');

	  $this->from($this->table_name);
	  return $this->all_results();
 } // End of Sales Report


 public function get_qty_total($show_time_is = NULL){

 	
	  $this->select(array('SUM(bookings.booking_seat_qty)' => 'qty'));
	  $this->where('booking_cancel','no');
	  $this->where('booking_showtime_id',$show_time_is);
	  $this->from($this->table_name);
	  return $this->all_results();
 
 	
 }

 public function get_qty_total_comp($show_time_is = NULL){

 

	  $this->where('booking_iscomplimentary','yes');
	  $this->where('booking_showtime_id',$show_time_is);
	  $this->select(array('SUM(bookings.booking_seat_qty)' => 'qty'));
	  $this->where('booking_cancel','no');
	  $this->from($this->table_name);
	  return $this->all_results();
 
 	
 }


 public function get_price_total($show_time_is = NULL){

 	
	$this->where('booking_showtime_id',$show_time_is);
	$this->where('booking_cancel','no');
	$this->select(array('SUM(bookings.booking_price)' => 'qty'));
   
	$this->from($this->table_name);
	return $this->all_results();

	
 }

public function get_film_rental_private($m_id = NULL,$s_date = NULL, $e_date = NULL,$filter_id)
 {
 		

	  if (isset($m_id) && $filter_id == 'showtime_movie_id') {
	   $this->where('voucher_movie_id',$m_id);
	  }

	 
	  if (!empty($s_date) && !empty($e_date)) {
	 		 $this->where('voucher_ts', array($s_date,$e_date), 'BETWEEN');
		 }else

		if (!empty($s_date)) {
	  		$this->where('voucher_ts',$s_date);
		 }
	  
	$this->inner_join('vouchers', 'v', 'v.voucher_id = voucher_bookings.voucher_type_id');
	$this->left_join('screens', 'c', 'c.screen_id = voucher_bookings.voucher_screenid');
	$this->right_join('showtimes', 's', 's.showtime_id = voucher_bookings.voucher_show_id');
	  
	  $this->group_by('voucher_bookings.voucher_show_id');

	  $this->from($this->table_voucher_booking);
	  return $this->all_results();
 } // End of Sales Report

 
 public function get_ticket_sales_by_day($s_date){
	 
	  
	  
	 if (!empty($s_date) && !empty($s_date)) {
		  $new_date = $this->_date('Y-m-d H:i:s', $s_date);	
	 	  $this->where('booking_date', $new_date);
		   $this->where('booking_showdate', $new_date);
		$this->where('booking_cancel','no');
		}
		
	 $this->force_select_all();
	 $this->select(array('SUM(bookings.booking_seat_qty)' => 'booked_seats'));
	 $this->left_join('showtimes', 's', 's.showtime_id = bookings.booking_showtime_id');
	 $this->group_by('bookings.booking_showtime_id');
	
	 
	
	
	 $this->from($this->table_name);
	 return $this->all_results();
	  
 }
 

 
 public function get_ticket_sale_by_show_id($show_id){
	 
	 $this->where('booking_cancel', 'no');
	 $this->where('booking_showtime_id', $show_id);
	 $this->force_select_all();
	 $this->select(array('SUM(bookings.booking_seat_qty)' => 'booked_seats'));
	 $this->select(array('SUM(bookings.booking_price)' => 'amount'));
	
	 $this->from($this->table_name);
	 return $this->result();
	  
 }
 
  public function get_current_ticket_sale_by_show_id($show_id,$s_date){
	 //print_f($date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	 $this->where('booking_showtime', array($start_date,$end_date), 'BETWEEN');
	 $this->where('booking_ts', array($start_date,$end_date), 'BETWEEN');
	 
	 $new_date = $this->_date('Y-m-d H:i:s', $s_date);
	 $this->where('booking_cancel', 'no');
	 
	 $this->where('booking_showtime_id', $show_id);

	 $this->force_select_all();
	 $this->select(array('SUM(bookings.booking_seat_qty)' => 'booked_seats'));
	 $this->select(array('SUM(bookings.booking_price)' => 'amount'));
	
	 $this->from($this->table_name);
	 return $this->result();
	  
 }
 
  public function get_adv_ticket_sale_by_show_id($show_id,$s_date){
	 
	 $new_date = $this->_date('Y-m-d H:i:s', $s_date);
	 $this->where('booking_cancel', 'no');
	 $this->where('booking_showdate', $s_date);
	 $this->where('booking_showtime_id', $show_id);
	 $this->where('booking_date', $new_date , "!=");
	 $this->force_select_all();
	 $this->select(array('SUM(bookings.booking_seat_qty)' => 'booked_seats'));
	 $this->select(array('SUM(bookings.booking_price)' => 'amount'));
	
	 $this->from($this->table_name);
	 return $this->result();
	  
 }
 
 public function get_movies_shows($m_id,$s_date){
	 
	 print_f($s_date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  $this->where('showtime_movie_id', $m_id);
	  $this->where('showtime_datetime', array($start_date,$end_date), 'BETWEEN');
	  $this->left_join('movies', 'm', 'm.movie_id = showtimes.showtime_movie_id');
	  $this->inner_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
	  $this->from($this->table_showtime);
	  return $this->all_results();
	 
 }
 
public function get_all_shows(){
	 
	 
	  $this->left_join('movies', 'm', 'm.movie_id = showtimes.showtime_movie_id');
	  $this->inner_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
	  $this->from($this->table_showtime);
	  return $this->all_results();
	 
 }
 
   public function get_all_shows_by_cinema($cinema,$date){
	 
		//print_f($date);
		$currentDate = strtotime($date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
		//print_f($end_date);
	    $this->left_join('movies', 'm', 'm.movie_id = showtimes.showtime_movie_id');
	    $this->inner_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
	    $this->where('showtime_screen_id', $cinema);
		//$this->where('showtime_datetime', $date.' %', 'LIKE');
		$this->where('showtime_datetime', array($start_date,$end_date), 'BETWEEN');
		
	    $this->order_by('showtime_datetime', 'ASC');
	    $this->from($this->table_showtime);
	    return $this->all_results();
	  
 
 }
 
    public function get_all_cinema(){
	 
	 
	  $this->from($this->table_screen);
	  return $this->all_results();
	 
 }
 
  public function get_adv_ticket_sales_by_movie($s_date,$m_id){
	 
	  
	//print_f($s_date);
	$currentDate = strtotime($s_date);
	$futureDate = $currentDate+((60*(60*5))+60);
	$start_date = date("Y/m/d H:i:s ", $futureDate);
	//print_f($start_date);
		
	$currentDate1 = strtotime($s_date);
	$futureDate1 = $currentDate1+(60*(60*29));
	$end_date = date("Y/m/d H:i:s ", $futureDate1);
	//print_f($end_date);  
	
	$this->where('booking_ts', array($start_date,$end_date), 'BETWEEN');
	$this->where('booking_showtime', array($start_date,$end_date), 'NOT BETWEEN');
		
		
	if (!empty($m_id) && !empty($m_id)) {
		  
	 	  $this->where('booking_movie', $m_id);
		  
		
		}
	
	  $this->where('booking_cancel', 'no');
	 $this->force_select_all();
	 $this->select(array('SUM(bookings.booking_seat_qty)' => 'booked_seats'));
	 $this->select(array('SUM(bookings.booking_price)' => 'amount'));
	 $this->group_by('bookings.booking_showtime_id');
	 $this->left_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
	 $this->inner_join('screens', 's', 's.screen_id = bookings.booking_screen');
	 
	
	
	 $this->from($this->table_name);
	 return $this->all_results();
	  
 }
 
 
   public function get_cancellation($s_date){
	 
	  //print_f($date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
	  
	 $this->where('booking_cancel_time', array($start_date,$end_date), 'BETWEEN');
		
	
	
	 $this->where('booking_cancel', 'yes');
	 //$this->force_select_all();
	 $this->left_join('movies', 'm', 'm.movie_id = bookings.booking_movie');
	 $this->inner_join('screens', 's', 's.screen_id = bookings.booking_screen');
	 $this->inner_join('printed_tickets', 'p', 'p.printed_ticket_booking_id = bookings.booking_id');
	 $this->right_join('users', 'u', 'u.user_id = bookings.booking_cancel_user');
	 
	
	
	 $this->from($this->table_name);
	 return $this->all_results();
	  
 }

    public function get_concession_cancellation($s_date){
	 
	 // print_f($r_start_date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	 $this->where('concession_order_cancel_date', array($start_date,$end_date), 'BETWEEN'); 
	
	 $this->where('concession_order_cancel', 'yes');
	 
	 //$this->force_select_all();
	// $this->left_join('concession_bookings', 'c', 'c.con_booking_order_id = concession_order.concession_order_id');
	$this->right_join('users', 'u', 'u.user_id = concession_order.concession_order_cancel_by');
 
	 
	
	
	 $this->from($this->con_order);
	 return $this->all_results();
	  
 }
 
 
  public function get_ticket_sales_by_screen($screen,$s_date){
	  
	  if (!empty($s_date) && !empty($s_date)) {
		  $new_date = $this->_date('Y-m-d H:i:s', $s_date);	
	 	  $this->where('booking_date', $new_date);
		  $this->where('booking_showdate', $new_date);
		  $this->where('booking_screen', $screen);
		
		}
		
	$this->select(array('SUM(bookings.booking_seat_qty)' => 'screen_seats'));
	$this->where('booking_cancel','no');
	$this->from($this->table_name);
	return $this->result();
	  
  }
  
  
    public function get_adv_ticket_sales_by_day($s_date){
	 
	    //print_f($s_date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
		//print_f($end_date);
	  
	
		$new_date = $this->_date('Y-m-d H:i:s', $s_date);	
		  
	 	// $this->where('booking_date', $new_date);
		$this->where('booking_ts', array($start_date,$end_date), 'BETWEEN');
		$this->where('booking_showtime', array($start_date,$end_date), 'NOT BETWEEN');
		  
		// $this->where('booking_showdate', $new_date ,'!=');
		  
		
		
	 $this->where('booking_cancel','no');
	 $this->force_select_all();
	 $this->select(array('SUM(bookings.booking_seat_qty)' => 'booked_seats'));
	 $this->left_join('showtimes', 's', 's.showtime_id = bookings.booking_showtime_id');
	 $this->group_by('bookings.booking_showtime_id');
	
	 
	
	
	 $this->from($this->table_name);
	 return $this->all_results();
	  
 }
  
    public function get_adv_ticket_sales_by_screen($screen,$s_date){
		
		 //print_f($s_date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  $this->select(array('SUM(bookings.booking_seat_qty)' => 'screen_seats'));
	
		$this->where('booking_ts', array($start_date,$end_date), 'BETWEEN');
		$this->where('booking_showtime', array($start_date,$end_date), 'NOT BETWEEN');
		  $this->where('booking_screen', $screen);
		

		
	 $this->where('booking_cancel','no');
	 $this->from($this->table_name);
	return $this->result();
	  
  }
  
  
    public function get_cash_in_hand($s_date){
	 
	  
	   //print_f($s_date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
		//print_f($end_date);
		$this->where('booking_ts', array($start_date,$end_date), 'BETWEEN');
	
	
		 $this->where('booking_cancel', 'no');
		 $this->force_select_all();
		 $this->select(array('SUM(bookings.booking_price)' => 'cash'));
		 $this->select(array('SUM(bookings.booking_seat_qty)' => 'tickets_qty'));
		 $this->left_join('showtimes', 's', 's.showtime_id = bookings.booking_showtime_id');
		 $this->inner_join('users', 'u', 'u.user_id = bookings.booking_user');
		 $this->group_by('bookings.booking_user');
	
	 
	
	
	 $this->from($this->table_name);
	 return $this->all_results();
	  
 }
 
 
     public function get_cash_in_hand_by_user($s_date, $user){
	 
	  
	  
	 //print_f($s_date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y/m/d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y/m/d H:i:s ", $futureDate1);
		//print_f($end_date);
		$this->where('booking_ts', array($start_date,$end_date), 'BETWEEN');
	
	 $this->where('booking_cancel', 'no');
	 $this->where('booking_user', $user);
	 
	 $this->force_select_all();
	 $this->select(array('SUM(bookings.booking_price)' => 'cash'));
	 $this->select(array('SUM(bookings.booking_seat_qty)' => 'tickets_qty'));
	 $this->left_join('showtimes', 's', 's.showtime_id = bookings.booking_showtime_id');
	 $this->inner_join('users', 'u', 'u.user_id = bookings.booking_user');
	 $this->group_by('bookings.booking_user');
	
	 
	
	
	 $this->from($this->table_name);
	 return $this->all_results();
	  
 }
 
 
  public function get_cash_in_hand_by_user_concession($s_date, $user){
	 
	  
	  
	 if (!empty($s_date) && !empty($s_date)) {
		  $new_date = $this->_date('Y-m-d H:i:s', $s_date);	
	 	  $this->where('con_booking_time', $new_date);

		}
	
	 $this->where('con_booking_cancel', 'no');
	 $this->where('con_booking_user', $user);
	 
	 $this->force_select_all();
	 $this->select(array('SUM(concession_bookings.con_booking_amount)' => 'cash'));
	 $this->inner_join('users', 'u', 'u.user_id = concession_bookings.con_booking_user');
	 $this->group_by('concession_bookings.con_booking_user');
	
	 
	
	
	 $this->from($this->table_concession);
	 return $this->all_results();
	  
 }
 
  public function get_cash_in_hand_all_by_user_concession($s_date, $user){
	 
	 // print_f($r_start_date);
		$currentDate = strtotime($s_date);
		$futureDate = $currentDate+((60*(60*5))+60);
		$start_date = date("Y-m-d H:i:s ", $futureDate);
		//print_f($start_date);
		
		$currentDate1 = strtotime($s_date);
		$futureDate1 = $currentDate1+(60*(60*29));
		$end_date = date("Y-m-d H:i:s ", $futureDate1);
		//print_f($end_date);
		
	  
	 $this->where('con_booking_ts', array($start_date,$end_date), 'BETWEEN');  
	 $this->where('con_booking_cancel', 'no');
	
	 
	 $this->force_select_all();
	 $this->select(array('SUM(concession_bookings.con_booking_amount)' => 'cash'));
	 $this->inner_join('users', 'u', 'u.user_id = concession_bookings.con_booking_user');
	 $this->group_by('concession_bookings.con_booking_user');
	
	 
	
	
	 $this->from($this->table_concession);
	 return $this->all_results();
	  
 }
 
 
 public function get_screen()
	{
		
		$this->from($this->table_screen);
		return $this->all_results();
		
	} // end of get
 
 
 

}// end of class

?>
