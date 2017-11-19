<?php 
/**
* INVENTORY MAIN CLASS
*/
class foodstall extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'foodstalls';
	}

	public function insert_foodstall($form)
	{
		$data = array();

		$data['foodstall_name'] = $form['foodstall_name'];
		$data['foodstall_size'] = $form['foodstall_size'];
		$data['foodstall_contract_type'] = $form['foodstall_contract_type'];
		$data['foodstall_contract_amount'] = $form['foodstall_contract_amount'];
		$data['foodstall_desc'] = $form['foodstall_desc'];
		$data['foodstall_date'] = $form['foodstall_date'];
		$data['foodstall_status'] = $form['foodstall_status'];
		

		
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_foodstall($form, $id)
	{
		
		
		$data = array();

		$data['foodstall_name'] = $form['foodstall_name'];
		$data['foodstall_size'] = $form['foodstall_size'];
		$data['foodstall_contract_type'] = $form['foodstall_contract_type'];
		$data['foodstall_contract_amount'] = $form['foodstall_contract_amount'];
		$data['foodstall_desc'] = $form['foodstall_desc'];
		$data['foodstall_date'] = $form['foodstall_date'];
		$data['foodstall_status'] = $form['foodstall_status'];

		$this->where('foodstall_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	


	public function get_foodstalls($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('foodstall_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get


	public function delete_foodstall($selectid)
	{
		

		$this->where('foodstall_id', $selectid);
		if($this->delete($this->table_name, $num_rows = NULL)){
			return true;
		}else{
			return false;
		}
		
	}



} // end of class


 ?>