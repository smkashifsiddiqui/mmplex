<?php 
/**
* INVENTORY MAIN CLASS
*/
class package extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'packages';
		$this->table_concession_bookings = 'concession_bookings';
		
	}

	public function insert_package($form)
	{
		$data = array();

		$data['package_name'] = $form['package_name'];
		$data['package_measuring_unit'] = $form['package_measuring_unit'];
		$data['package_category'] = $form['package_category'];
		$data['package_price'] = $form['package_price'];
		$data['package_cost_price'] = $form['package_cost_price'];
		
		$data['package_status'] = $form['package_status'];
		$data['package_order_no'] = $form['package_order_no'];
		$data['package_bg'] = $form['package_bg'];
		$data['package_desc'] = $form['package_desc'];
		$data['package_item_name'] =  json_encode($form['package_item_name']);
		$data['package_item_price'] = json_encode($form['package_item_price']);
		$data['package_item_qty'] =   json_encode($form['package_item_qty']);
		

		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['package_img']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['package_img']['tmp_name'], $uploadfile)) {
			$data['package_img'] = $uploadfilename;
		}
		
		  }  
		

		$this->insert($this->table_name, $data);
		return $this->row_count();
	} // end of insert

	public function update_package($form, $id)
	{
		
		
		$data = array();

		$data['package_name'] = $form['package_name'];
		$data['package_measuring_unit'] = $form['package_measuring_unit'];
		$data['package_category'] = $form['package_category'];
		$data['package_price'] = $form['package_price'];
		$data['package_cost_price'] = $form['package_cost_price'];
		
		$data['package_status'] = $form['package_status'];
		$data['package_order_no'] = $form['package_order_no'];
		$data['package_bg'] = $form['package_bg'];
		$data['package_desc'] = $form['package_desc'];
		$data['package_item_name'] =  json_encode($form['package_item_name']);
		$data['package_item_price'] = json_encode($form['package_item_price']);
		$data['package_item_qty'] =   json_encode($form['package_item_qty']);

		
		
		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['package_img']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['package_img']['tmp_name'], $uploadfile)) {
			$data['package_img'] = $uploadfilename;
		} }
		else {
         echo $data['package_img'] = $data['package_img1'];
        }
		   
		

		$this->where('package_id', $id);
		$this->update($this->table_name, $data);
		    if (!$this->row_count()) {
				return false;
			}
			
			return $this->row_count();

	} // end of update

	


	public function get_packages($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('package_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get


	public function array_combine_($keys, $values)
    {
	   $final_result = array();
	   foreach ($keys as $i => $k) {
	    $final_result[$k][] = $values[$i];
  	 }
	   array_walk($final_result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
	   return    $final_result;
 	 }

public function delete_package($selectid)
	{
		$if_concession = $this->get_booking_of_package($selectid);
		if(empty($if_concession)){

		$this->where('package_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_booking_of_package($package)
	{
		
			$this->where('con_booking_type_id',$package);
			$this->from($this->table_concession_bookings);
			return $this->all_results();
		
	} // end of get


} // end of class


 ?>