<?php 
/**
* INVENTORY MAIN CLASS
*/
class ticket extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'tickets';
		$this->table_showtime = 'showtimes';
		$this->table_vouchers_booking = 'voucher_bookings';
		
	}

	public function insert_ticket($form)
	{
		$data = array();

		$data['ticket_status'] = $form['ticket_status'];
		$data['ticket_title'] = $form['ticket_title'];
		if(isset($form['ticket_desc'])){$data['ticket_desc'] = $form['ticket_desc'];}
		if(isset($form['ticket_class'])){$data['ticket_class'] = $form['ticket_class'];}
		$data['ticket_ischild'] = $form['ticket_ischild'];
		$data['ticket_adult_price'] = $form['ticket_adult_price'];
		$data['ticket_child_price'] = $form['ticket_child_price'];
		$data['ticket_type'] = $form['ticket_type'];
		
		
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_ticket($form, $id)
	{
		
		
		$data = array();

		$data['ticket_status'] = $form['ticket_status'];
		$data['ticket_title'] = $form['ticket_title'];
		if(isset($form['ticket_desc'])){$data['ticket_desc'] = $form['ticket_desc'];}
		if(isset($form['ticket_class'])){$data['ticket_class'] = $form['ticket_class'];}
		$data['ticket_ischild'] = $form['ticket_ischild'];
		$data['ticket_adult_price'] = $form['ticket_adult_price'];
		$data['ticket_child_price'] = $form['ticket_child_price'];
		$data['ticket_type'] = $form['ticket_type'];
		

		$this->where('ticket_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	


	public function get_tickets($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('ticket_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

public function delete_ticket($selectid)
	{
		
		$if_ticket = $this->get_tickets_of_showtime($selectid);
		$if_ticket_v = $this->get_tickets_of_voucher($selectid);
		if(empty($if_ticket) && empty($if_ticket_v)){

		$this->where('ticket_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_tickets_of_showtime($ticket)
	{
		
			$this->where('showtime_ticket_type',$ticket);
			$this->from($this->table_showtime);
			return $this->all_results();
		
	} // end of get

public function get_tickets_of_voucher($ticket)
	{
		
			$this->where('voucher_type_id',$ticket);
			$this->from($this->table_vouchers_booking);
			return $this->all_results();
		
	} // end of get

} // end of class


 ?>