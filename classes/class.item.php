<?php 
/**
* INVENTORY MAIN CLASS
*/
class item extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'items';
		$this->table_concession_bookings = 'concession_bookings';
	}

	public function insert_item($form)
	{
		$data = array();

		$data['item_name'] = $form['item_name'];
		$data['item_small_decs'] = $form['item_small_decs'];
		$data['item_measuring_unit'] = $form['item_measuring_unit'];
		$data['item_category'] = $form['item_category'];
		$data['item_default_price'] = $form['item_default_price'];
		$data['item_cost_price'] = $form['item_cost_price'];
		
		$data['item_bg'] = $form['item_bg'];
		$data['item_display_order'] = $form['item_display_order'];
		$data['item_status'] = $form['item_status'];

		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['item_img']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['item_img']['tmp_name'], $uploadfile)) {
			$data['item_img'] = $uploadfilename;
		}
		
		  }  
		

		$this->insert($this->table_name, $data);
		return $this->row_count();

	} // end of insert

	public function update_item($form, $id)
	{
		
		
		$data = array();

		$data['item_name'] = $form['item_name'];
		$data['item_small_decs'] = $form['item_small_decs'];
		$data['item_measuring_unit'] = $form['item_measuring_unit'];
		$data['item_category'] = $form['item_category'];
		$data['item_default_price'] = $form['item_default_price'];
		$data['item_cost_price'] = $form['item_cost_price'];
		
		$data['item_bg'] = $form['item_bg'];
		$data['item_display_order'] = $form['item_display_order'];
		$data['item_status'] = $form['item_status'];

		

		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['item_img']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['item_img']['tmp_name'], $uploadfile)) {
			$data['item_img'] = $uploadfilename;
		} }
		else {
         echo $data['item_img'] = $data['item_img1'];
        }

        $this->where('item_id', $id);
		$this->update($this->table_name, $data);
		    if (!$this->row_count()) {
				return false;
			}
			
			return $this->row_count();


	} // end of update

	


	public function get_items($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('item_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get


	public function delete_item($selectid)
	{
		$if_concession = $this->get_booking_of_item($selectid);
		if(empty($if_concession)){

		$this->where('item_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_booking_of_item($item)
	{
		
			$this->where('con_booking_type_id',$item);
			$this->from($this->table_concession_bookings);
			return $this->all_results();
		
	} // end of get

} // end of class


 ?>