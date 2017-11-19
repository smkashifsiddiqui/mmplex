<?php 
/**
* INVENTORY MAIN CLASS
*/
class setting extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'settings';
	}

	public function insert_timing($form)
	{
		$data = array();

		$data['setting_name']  = 'global_timings';
		$data['setting_value'] = json_encode($form['timing']);
		
		
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_timing($form, $id)
	{
		
		
		$data = array();

		$data['setting_value'] = json_encode($form['timing']);

		$this->where('setting_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	public function get_timings($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('setting_name','global_timings');
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get
	
	
	public function insert_logo($form)
	{
		$data = array();

		$data['setting_name']  = 'logo';
		$data['setting_value'] = $form['logo'];
		
		
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_logo($form)
	{
		
		
		$data = array();

		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['logo']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
			$data['setting_value'] = $uploadfilename;
		}}
		
		$this->where('setting_name','logo');
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	
	
	
	public function get_logo($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('setting_name','logo');
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->where('setting_name','logo');
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get
	
	
	
	public function update_popup_status($form)
	{
		
		
		$data = array();

		
		$data['setting_value'] = $_POST['popup_value'];
	    $this->where('setting_name','popups');
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update_logo
	
	
		public function get_popup_status()
	{
		
			$this->where('setting_name','popups');
			$this->from($this->table_name);
			return $this->result();
		
	} // end of get


} // end of class


 ?>