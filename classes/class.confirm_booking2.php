<?php 
/**
* INVENTORY MAIN CLASS
*/
class confirm_booking extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'bookings';
		$this->table_adv_booking = 'advance_bookings';

	}

	public function insert_booking($form, $id)
	{
		$result = $this->get_adv_bookings($id);
		if($result->advance_b_status != 'yes'){

		unset($_SESSION['all_previous_list']);
		$data = array();
		

		$seat_num = explode(",", $form['seats_num']);
		
		foreach ($seat_num  as $key =>  $value) {
			$value1 = array();
			$value1[0] = $value;
			
			
			$_SESSION['previous_list']['shw_id'] 		= $form['show_id'];
			$_SESSION['previous_list']['ticket_id'] 	= $form['ticket_id'];
			$_SESSION['previous_list']['ticket_type'] 	= $form['ticket_type'];
			$_SESSION['previous_list']['allow_comp'] 	= 'no';
			$_SESSION['previous_list']['shw_key'] 		= 'public';
			$_SESSION['previous_list']['movie_title']   = $form['movie'];
			$_SESSION['previous_list']['movie_id'] 		= $form['movie_id'];
			$_SESSION['previous_list']['d_id'] 			= $form['dist_id'];
			$_SESSION['previous_list']['posted_seats'] 	= $value;
			$_SESSION['previous_list']['ticket_price'] 	= $form['price'];
			$_SESSION['previous_list']['qty'] 			= '1';
			$_SESSION['previous_list']['sum'] 			= $form['price'];

		
			$_SESSION['all_previous_list'][] = $_SESSION['previous_list'];
			
			}

			
		
			if($this->row_count() > 0){
				
				$confirm_data = array();
				$confirm_data['advance_b_status'] = 'yes';
				$this->where('advance_b_id', $id);
				$this->update($this->table_adv_booking, $confirm_data);
				return $_SESSION['all_previous_list'];
			}else{

				return false;
				
			}

		}else{
			return false;
		}
	} // end of insert

	public function delete_record($selectid)
	{
		
		$this->where('advance_b_id', $selectid);
		$this->delete($this->table_adv_booking, $num_rows = NULL);
		
		

		return true;

	} // end of update

	

	public function get_adv_bookings($ID = NULL)
	{
		if (isset($ID)) {
			$this->left_join('movies', 'm', 'm.movie_id = advance_bookings.advance_b_movie');
			$this->inner_join('showtimes', 's', 's.showtime_id = advance_bookings.advance_b_showtime_id');
			
			$this->where('advance_b_id',$ID);
			$this->order_by('advance_ts', 'DESC');
			$this->from($this->table_adv_booking);
			return $this->result();
		}
		else {

			$this->left_join('movies', 'm', 'm.movie_id = advance_bookings.advance_b_movie');
			$this->inner_join('showtimes', 's', 's.showtime_id = advance_bookings.advance_b_showtime_id');
			$this->order_by('advance_ts', 'DESC');
			$this->from($this->table_adv_booking);
			return $this->all_results();
		}
	} // end of get


} // end of class


 ?>