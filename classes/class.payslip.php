<?php 
/**
* INVENTORY MAIN CLASS
*/
class payslip extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'payrolls';
		
	}

	public function insert_payslip($form)
	{
		$data = array();

		$data['payroll_amount'] = $form['payroll_amount'];
		$data['payroll_emp_id'] = $form['payroll_emp_id'];
		$data['payroll_for_date'] = $form['payroll_for_date'];
		$data['payroll_status'] = $form['payroll_status'];
		$data['payroll_date'] = $this->_date('Y-m-d', date('d-m-Y'));	
		
		

		$this->insert($this->table_name, $data);
		return $this->row_count();

	} // end of insert

	public function update_payslip($form, $id)
	{
		
		
		$data = array();

		$data['payroll_amount'] = $form['payroll_amount'];
		$data['payroll_emp_id'] = $form['payroll_emp_id'];
		$data['payroll_for_date'] = $form['payroll_for_date'];
		$data['payroll_status'] =  $form['payroll_status'];
		$data['payroll_date'] = $this->_date('Y-m-d', date('d-m-Y'));	

		$this->where('payroll_id', $id);
		$this->update($this->table_name, $data);
		    if (!$this->row_count()) {
				return false;
			}
			
			return $this->row_count();


	} // end of update

	


	public function get_payslips($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('payroll_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get


	public function delete_payslip($selectid)
	{
		
		$this->where('payroll_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		
	}
		

		
	


} // end of class


 ?>