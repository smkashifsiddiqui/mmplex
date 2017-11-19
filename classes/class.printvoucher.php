<?php 
/**
* INVENTORY MAIN CLASS
*/
class printvoucher extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'voucher_bookings';
		$this->table_screen	= 'screens';
		$this->table_showtime = 'showtimes';
		$this->table_voucher = 'vouchers';
		$this->table_movie = 'movies';
	}


	public function get_screen_seats($ID)
	{
			$this->where('screen_id',$ID);
			$this->from($this->table_screen);
			return $this->all_results();
		
		
	} // end of get


	public function get_booked_vouchers_shwid($ID)
	{		
			$this->where('voucher_show_id',$ID);
			$this->inner_join('showtimes', 's', 's.showtime_id = voucher_bookings.voucher_show_id');
			$this->from($this->table_name);
			return $this->all_results();
		
		
	} // end of get

	public function get_voucher_details($ID)
	{
			$this->where('voucher_id',$ID);
			$this->from($this->table_voucher);
			return $this->all_results();
		
		
	} // end of get


	public function get_movie_details($ID)
	{
			$this->where('movie_id',$ID);
			$this->from($this->table_movie);
			return $this->all_results();
		
		
	} // end of get

	public function insert_all_voucher($showid=NULL,$screenid=NULL,$voucher_movieid=NULL,$voucher_distid=NULL,$voucher_type=NULL)
	{


		$selected_screen = $this->get_screen_seats($screenid); 
		//print_f($selected_screen);

		$screen_rows = $selected_screen[0]->screen_rows;
		$screen_rows = (!empty($screen_rows))? json_decode($screen_rows) : array();

		$screen_column = $selected_screen[0]->screen_row_column;
		$screen_column = (!empty($screen_column))? json_decode($screen_column) : array();
		$c = count($screen_column);

		//print_f($screen_rows);
		//print_f($screen_column);

		for ($i =0; $i< $c; $i++) {

			$columnlenght = $screen_column[$i];

			for($j =1; $j<=$columnlenght; $j++){

				$data = array();

				$data['voucher_unique_id'] = $showid.$screen_rows[$i].$j;
				$data['voucher_seat_num'] = $screen_rows[$i].$j;
				$data['voucher_type_id'] = $voucher_type;
				$data['voucher_show_id'] = $showid;
				$data['voucher_movie_id'] = $voucher_movieid;
				$data['voucher_dist_id'] = $voucher_distid;
				$data['voucher_screenid'] = $screenid;

				
				
				$data['voucher_datetime'] = $this->_date('Y-m-d H:i:s', date('d-m-Y H:i:s'));
				
				
				//print_f($data);
			    $this->insert($this->table_name, $data);

				
				
			}


		}

		return $this->row_count();

	} // end of insert

	public function update_voucher($form, $id)
	{
		
		
		$data = array();

		$data['voucher_status'] = $form['voucher_status'];
		$data['voucher_title'] = $form['voucher_title'];
		$data['voucher_desc'] = $form['voucher_desc'];
		$data['voucher_price'] = $form['voucher_price'];
		$data['voucher_is_package'] = $form['voucher_is_package'];
		$data['voucher_startdate'] = $form['voucher_startdate'];
		$data['voucher_enddate'] = $form['voucher_enddate'];
		if($form['voucher_is_package'] == 'yes'){
		if(isset($form['voucher_package_item_name'])){$data['voucher_package_item_name'] = json_encode($form['voucher_package_item_name']);}
		if(isset($form['voucher_package_item_price'])){$data['voucher_package_item_price'] = json_encode($form['voucher_package_item_price']);}
		if(isset($form['voucher_package_item_qty'])){$data['voucher_package_item_qty'] = json_encode($form['voucher_package_item_qty']);}
		if(isset($form['voucher_package_ticket_name'])){$data['voucher_package_ticket_name'] = json_encode($form['voucher_package_ticket_name']);}
		if(isset($form['voucher_package_ticket_price'])){$data['voucher_package_ticket_price'] = json_encode($form['voucher_package_ticket_price']);}
		if(isset($form['voucher_package_ticket_qty'])){$data['voucher_package_ticket_qty'] = json_encode($form['voucher_package_ticket_qty']);}
		}

		$this->where('voucher_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	


	public function get_vouchers($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('voucher_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get


	

} // end of class


 ?>