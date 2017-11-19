<?php 
/**
* INVENTORY MAIN CLASS
*/
class expense extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'expenses';
		
	}

	public function insert_expense($form)
	{
		$data = array();

		$data['expense_name'] = $form['expense_name'];
		$data['expense_amount'] = $form['expense_amount'];
		$data['expense_detail'] = $form['expense_detail'];
		$data['expense_user'] = $_SESSION['user']->id;
		$data['expense_date'] = $this->_date('Y-m-d', date('d-m-Y'));
		

		$this->insert($this->table_name, $data);
		return $this->row_count();

	} // end of insert

	public function update_expense($form, $id)
	{
		
		
		$data = array();

		$data['expense_name'] = $form['expense_name'];
		$data['expense_amount'] = $form['expense_amount'];
		$data['expense_detail'] = $form['expense_detail'];
		$data['expense_user'] = $_SESSION['user']->id;
		$data['expense_date'] = $this->_date('Y-m-d', date('d-m-Y'));
		
		$this->where('expense_id', $id);
		$this->update($this->table_name, $data);
		    if (!$this->row_count()) {
				return false;
			}
			
			return $this->row_count();


	} // end of update

	


	public function get_expenses($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('expense_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get


	public function delete_expense($selectid)
	{
		$if_concession = $this->get_booking_of_item($selectid);
		if(empty($if_concession)){

		$this->where('expense_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


} // end of class


 ?>