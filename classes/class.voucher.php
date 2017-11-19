<?php 
/**
* INVENTORY MAIN CLASS
*/
class voucher extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'vouchers';
		$this->table_showtime = 'showtimes';

		
	}

	public function insert_voucher($form)
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
		
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

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


	public function delete_voucher($selectid)
	{
		$if_showtime = $this->get_showtime_of_voucher($selectid);
		if(empty($if_showtime)){

		$this->where('voucher_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_showtime_of_voucher($voucher)
	{
		
			$this->where('showtime_voucher_type',$voucher);
			$this->from($this->table_showtime);
			return $this->all_results();
		
	} // end of get


} // end of class


 ?>