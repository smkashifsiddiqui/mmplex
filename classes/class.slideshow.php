<?php 
/**
* INVENTORY MAIN CLASS
*/
class slideshow extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'slides';
	}

	

	public function update_slideshow($form)
	{
		
		
		$data = array();
		
		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['logo']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
			$data['slide_img'] = $uploadfilename;
		}}
		
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of update
	
	
	public function delete_slideshow($selectid)
	{
	
		$this->where('slide_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		
	}

	
	public function get_slideshow($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('slide_id',$ID);
			$this->order_by('slide_id', 'DESC');
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->order_by('slide_id', 'DESC');
			$this->from($this->table_name);
			
			return $this->all_results();
		}
	} // end of get


} // end of class


 ?>