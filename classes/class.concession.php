<?php 
/**
* INVENTORY MAIN CLASS
*/
class concession extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'concession_bookings';
		$this->table_item = 'items';
		$this->table_package = 'packages';
		$this->table_con_order = 'concession_order';
	}

	
	
public function get_concession_items()
	{
			$this->where('item_status','active');
			$this->order_by('item_display_order', 'ASC');
			$this->from($this->table_item);
			return $this->all_results();

	} // end of get

	public function get_concession_packages()
	{
			$this->where('package_status','active');
			$this->order_by('package_order_no', 'ASC');
			$this->from($this->table_package);
			return $this->all_results();

	} // end of get

	public function get_item_detail($ID)
	{
			$this->where('item_id', $ID);
			$this->from($this->table_item);
			return $this->all_results();

	} // end of get

	public function concession_booking($totall,$order_id,$con_booking_type_id, $con_booking_type, $con_booking_price, $con_booking_qty)
	{
		$c_amont = $con_booking_price * $con_booking_qty;
		
		$data = array();
	
		$c_amont = $con_booking_price * $con_booking_qty;
		
		$data['con_booking_order_id']   = $order_id;
		$data['con_booking_type_id']    = $con_booking_type_id;
		$data['con_booking_type'] 	    = $con_booking_type;
		$data['con_booking_price']	    = $con_booking_price;
		$data['con_booking_qty']		= $con_booking_qty;
		$data['con_booking_amount']     = $c_amont;
		$data['con_booking_time'] 	   = $this->_date('Y-m-d H:i:s', date('d-m-Y'));
		$data['con_booking_cancel'] = 'no';
		$data['con_booking_user'] = $_SESSION['user']->id;

			
		$this->insert($this->table_name, $data);

		if($this->row_count() > 0){
			$_SESSION['concession_sess']['con_inserted_id'] = $this->last_id();
			$_SESSION['concession_sess']['order_id'] = $order_id;
			$_SESSION['concession_sess']['total'] = $totall;
			
			$_SESSION['all_concession_sess'][] = $_SESSION['concession_sess'];
			return $this->last_id();
		}
		else {
			return false;
		} 

		
		

	} // end of insert
	
	
	public function ins_order_concession($total_am)
	{
	
		
		$data = array();
	    
		$data['concession_order_detail']    	= '';
		$data['concession_order_user'] 	    	= $_SESSION['user']->id;
		$data['concession_order_amount']	    = $total_am;
		$data['concession_order_cancel']		= 'no';
		$data['concession_order_date']    	    = $this->_date('Y-m-d H:i:s', date('d-m-Y'));
	
		$this->insert($this->table_con_order, $data);

		if($this->row_count() > 0){
			return $this->last_id();
		}
		else {
			return false;
		} 

		
		

	} // end of insert


	public function get_concession_details($id)
	{
			$this->where('con_booking_id',$id);
			$this->from($this->table_name);
			return $this->all_results();

	} // end of get
	
	public function get_concession_orders()
	{		
			$this->left_join('users', 'u', 'u.user_id = concession_order.concession_order_user');
			$this->where('concession_order_cancel','no');
			$this->order_by('concession_order_id', 'DESC');
			$this->from($this->table_con_order);
			return $this->all_results();

	} // end of get
	
	
	public function delete_concession($id,$select_per,$remarks)
	{
		$data = array();

		$data['concession_order_cancel'] = 'yes';
		$data['concession_order_cancel_date'] = $this->_date('Y-m-d H:i:s', date('Y-m-d h:i:s'));
		$data['concession_order_cancel_by'] = $select_per;
		$data['concession_order_cancel_remarks'] = $remarks;
		
		

		$this->where('concession_order_id',$id);
		$this->update($this->table_con_order, $data);

		if (!$this->row_count()) {
			return false;
		}else{
			
			$data1['con_booking_cancel'] = 'yes';
			$data['con_booking_cancel_date'] = $this->_date('Y-m-d H:i:s', date('Y-m-d h:i:s'));
			$this->where('con_booking_order_id',$id);
			$this->update($this->table_name, $data1);
			return true;
			
		}
		
		
		
	} // end of get

	public function get_item_details($id)
	{
			$this->where('item_id',$id);
			$this->from($this->table_item);
			return $this->all_results();

	} // end of get

	public function get_package_details($id)
	{
			$this->where('package_id',$id);
			$this->from($this->table_package);
			return $this->all_results();

	} // end of get

	public function end_concession_sess()
	{
		if(isset($_SESSION['all_concession_sess'])){
		 unset($_SESSION['all_concession_sess']); 
		 return true;
		}
		return true;
	} // end of insert
	
	public function get_concession_sess()
	{
		if(isset($_SESSION['all_concession_sess'])){
		  return $_SESSION['all_concession_sess'];
		}
		  return false;
	} // end of insert
	
	public function end_concess_session()
	{
		if(isset($_SESSION['all_concession_sess'])){
		  unset($_SESSION['all_concession_sess']);
		}
		  return true;
	} // end of insert
	
	
	public function get_printed_concession($ID)
	{
			$this->where('con_booking_order_id', $ID);
			$this->where('con_booking_cancel', 'no');
			$this->left_join('users', 'u', 'u.user_id = concession_bookings.con_booking_user');
			$this->from($this->table_name);
			return $this->all_results();

	} // end of get

}// end of class
?>