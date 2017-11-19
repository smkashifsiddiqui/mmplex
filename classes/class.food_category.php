<?php 
/**
* INVENTORY MAIN CLASS
*/
class food_category extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'food_categories';
		$this->table_package = 'packages';
		$this->table_item = 'items';
		
	}

	public function insert_food_category($form)
	{
		$data = array();

		$data['food_category_name'] = $form['food_category_name'];
		
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_food_category($form, $id)
	{
		
		
		$data = array();

		$data['food_category_name'] = $form['food_category_name'];

		$this->where('food_category_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	


	public function get_food_categories($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('food_category_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

	
	public function delete_food_category($selectid)
	{
		$if_item = $this->get_item_of_category($selectid);
		$if_package = $this->get_package_of_category($selectid);
		if(empty($if_item) && empty($if_package)){

		$this->where('food_category_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_item_of_category($category)
	{
		
			$this->where('item_category',$category);
			$this->from($this->table_item);
			return $this->all_results();
		
	} // end of get

public function get_package_of_category($category)
	{
		
			$this->where('package_category',$category);
			$this->from($this->table_package);
			return $this->all_results();
		
	} // end of get


} // end of class


 ?>