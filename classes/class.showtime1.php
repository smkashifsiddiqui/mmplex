<?php 
/**
* INVENTORY MAIN CLASS
*/
class showtime extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'showtimes';
		$this->table_movie = 'movies';
		$this->table_check = 'check_showtime';
	}

	public function insert_showtime($form)
	{
		foreach ($form['showtime_datetime'] as $value) {
			$data = array();
			$data['showtime_movie_id'] = $form['showtime_movie_id'];
			$data['showtime_screen_id'] = $form['showtime_screen_id'];
			$data['showtime_datetime'] = $value;
			$data['showtime_trailer_duration'] = $form['showtime_trailer_duration'];
			$data['showtime_cleanup'] = $form['showtime_cleanup'];
			$data['showtime_interval'] = $form['showtime_interval'];
			$data['showtime_status'] = $form['showtime_status'];
			$data['showtime_color'] = $form['showtime_color'];
			$data['showtime_key'] = $form['showtime_key'];
			
			$data['showtime_ticket_type'] = $form['showtime_ticket_type'];
			$data['showtime_voucher_type'] = $form['showtime_voucher_type'];
			$data['showtime_complimentry_seats'] = $form['showtime_complimentry_seats']; 
			
			

			//print_f($data);
			//die();
			$this->delete($this->table_check, $num_rows = NULL);	
			$this->insert($this->table_name, $data);
			
		}
		return $this->row_count();
		

	} // end of insert

	public function update_showtime($form, $id)
	{
		
		
		$data = array();

		$data['showtime_movie_id'] = $form['showtime_movie_id'];
		$data['showtime_screen_id'] = $form['showtime_screen_id'];
		$data['showtime_datetime'] = $form['showtime_datetime'];
		$data['showtime_trailer_duration'] = $form['showtime_trailer_duration'];
		$data['showtime_cleanup'] = $form['showtime_cleanup'];
		$data['showtime_interval'] = $form['showtime_interval'];
		$data['showtime_status'] = $form['showtime_status'];
		$data['showtime_color'] = $form['showtime_color'];
		$data['showtime_key'] = $form['showtime_key'];
		$data['showtime_ticket_type'] = $form['showtime_ticket_type'];
		$data['showtime_voucher_type'] = $form['showtime_voucher_type'];
		$data['showtime_complimentry_seats'] = $form['showtime_complimentry_seats'];

		$this->where('showtime_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	


	public function get_public_showtimes($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('showtime_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->inner_join('movies', 'd', 'd.movie_id = showtimes.showtime_movie_id');
			$this->left_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
			$this->where('showtime_key','public');
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

	public function get_private_showtimes($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('showtime_id',$ID);
			$this->inner_join('movies', 'd', 'd.movie_id = showtimes.showtime_movie_id');
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->inner_join('movies', 'd', 'd.movie_id = showtimes.showtime_movie_id');
			$this->left_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
			$this->where('showtime_key','private');
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

public function get_showtimes($getshowtime_cinema)
	{
		$this->inner_join('movies', 'd', 'd.movie_id = showtimes.showtime_movie_id');
		$this->left_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
		$this->where('showtime_screen_id',$getshowtime_cinema);
		$this->from($this->table_name);
		return $this->all_results();
		
	} // end of get


public function get_all_showtimes()
	{
		$this->inner_join('movies', 'd', 'd.movie_id = showtimes.showtime_movie_id');
		$this->left_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
		$this->from($this->table_name);
		return $this->all_results();
		
	} // end of get

public function get_temporary_showtimes($getshowtime_cinema)
	{
		$this->inner_join('movies', 'd', 'd.movie_id = check_showtime.check_showtime_select_movie');
		$this->left_join('screens', 's', 's.screen_id = check_showtime.check_showtime_select_screen');
		$this->where('check_showtime_select_screen',$getshowtime_cinema);
		$this->from($this->table_check);
		return $this->all_results();
		
	} // end of get

public function get_this_movie($ID)
	{
			$this->where('movie_id',$ID);
			$this->from($this->table_movie);
			return $this->all_results();
		
		
	} // end of get

public function get_this_dist($ID)
	{
			$this->where('movie_id',$ID);
			$this->from($this->table_movie);
			return $this->all_results();
		
		
	} // end of get

public function check_date($thisid, $getshowtime, $getshowtime_cinema, $getshowmovie, $showtime_trailer_duration, $showtime_cleanup, $showtime_interval)
{
     $all_show = $this->get_showtimes($getshowtime_cinema); 
    

 	 $selected_movie = $this->get_this_movie($getshowmovie); 
 	 $selected_movie_time = $selected_movie[0]->movie_duration;
 	 $selected_movie_trailer_time = $showtime_trailer_duration;
 	 $selected_movie_cleanup_time = $showtime_cleanup;

	$curr_initial_st  = strtotime($getshowtime);
	$mv_time    = $selected_movie[0]->movie_duration;
    $mv_cleanup = $showtime_cleanup;
    $mv_trailer = $showtime_trailer_duration;
    $mv_interval = $showtime_interval;
    
    $mv_final_time = $mv_cleanup + $mv_trailer + $mv_time + $mv_interval;


    $curr_final_st = strtotime($getshowtime . ' + '.$mv_final_time.' minutes');
    

    foreach($all_show as $res) {
			
		 if($res->showtime_id == $thisid){
		 continue;
		 }
		 $cinema = $res->showtime_screen_id;
		 $initial_start_time = $res->showtime_datetime;
       
		 $all_movie_time = $res->movie_duration;
      	 $all_cleanup_time = $res->showtime_cleanup;
      	 $all_trailer_time = $res->showtime_trailer_duration;
      	 $all_interval_time = $res->showtime_interval;
      	 
      	 $all_total_time = $all_cleanup_time + $all_trailer_time + $all_interval_time + $all_movie_time;

         $initial_end_time = $res->showtime_datetime;
         $final_time3 = strtotime($initial_end_time . ' + '.$all_total_time.' minutes');
         $final_end_time = date('Y/m/d H:i', $final_time3);

          $start_ts = strtotime($initial_start_time);
		  $end_ts   = strtotime($final_end_time);
		  
		  
		  

		}

		if((($curr_initial_st >= $start_ts) && ($curr_initial_st <= $end_ts)) || (($curr_final_st >= $start_ts) && ($curr_final_st <= $end_ts))) {
			return $found="yes";
			

			}else{
				 $all_temp_show = $this->get_temporary_showtimes($getshowtime_cinema);
				if(!empty($all_temp_show)){
				foreach($all_temp_show as $res1) {
				 	$cinema_1 = $res1->check_showtime_select_screen;
				 	$initial_start_time_1 = $res1->check_showtime_select_value;
				 	$all_movie_time_1 = $res1->movie_duration;
				 	$all_cleanup_time_1 = $showtime_cleanup;
			      	$all_trailer_time_1 = $showtime_trailer_duration;
			      	$all_interval_time_1 = $showtime_interval;
			      	$all_total_time_1 = $all_cleanup_time_1 + $all_trailer_time_1 + $all_interval_time_1 + $all_movie_time_1;

			      	$initial_end_time_1 = $res1->check_showtime_select_value;
			      	$final_time3_1 = strtotime($initial_end_time_1 . ' + '.$all_total_time_1.' minutes');
				 	$final_end_time_1 = date('Y/m/d H:i', $final_time3_1);

				 	$start_ts_1 = strtotime($initial_start_time_1);
		  			$end_ts_1  = strtotime($final_end_time_1);

		  			if((($curr_initial_st >= $start_ts_1) && ($curr_initial_st <= $end_ts_1)) || (($curr_final_st >= $start_ts_1) && ($curr_final_st <= $end_ts_1))) {
						return $found="yes";
					}else{ }
		  
				 }
				}

			 }


		
  	//return $found_date;
}

public function delete_temporary_showtime($selectid){
	$this->where('check_showtime_select_id',$selectid);
	$this->delete($this->table_check, $num_rows = NULL);
}


public function get_temporary_showtime($selectid, $selectvalue)
{
		$this->where('check_showtime_select_id',$selectid);
		$this->from($this->table_check);
		return $this->result();
}


public function i_temporary_showtime($tempid,$tempvalue,$tempmovie,$tempscreen)
{
		$data = array();

		$data['check_showtime_select_id'] = $tempid;
		$data['check_showtime_select_value'] = $tempvalue;
		$data['check_showtime_select_movie'] = $tempmovie;
		$data['check_showtime_select_screen'] = $tempscreen;
		
		$this->insert($this->table_check, $data);

		return $this->row_count();


}


public function update_temporary_showtime($selectid, $selectvalue, $selectmovie, $selectscreen)
{
		$data = array();

		
		$data['check_showtime_select_value'] = $selectvalue;
		$data['check_showtime_select_movie'] = $selectmovie;
		$data['check_showtime_select_screen'] = $selectscreen;
		
		$this->where('check_showtime_select_id', $selectid);
		$this->update($this->table_check, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();


}

public function delete_showtime($selectid)
	{

		$if_bookings = $this->get_bookings_of_showtime($selectid);

		if(empty($if_bookings)){

		$this->where('showtime_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_bookings_of_showtime($showtime)
	{
		
			$this->where('booking_showtime_id',$showtime);
			$this->from($this->table_booking);
			return $this->all_results();
		
	} // end of get

public function delete_showtime_private($selectid)
	{
		
		$if_bookings = $this->get_bookings_of_showtime_private($selectid);

		if(empty($if_bookings)){

		$this->where('showtime_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


} // end of class


 ?>