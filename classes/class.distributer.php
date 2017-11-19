<?php 
/**
* INVENTORY MAIN CLASS
*/
class distributer extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'distributers';
		$this->table_movie = 'movies';
	}

	public function insert_distributer($form)
	{
		$data = array();

		$data['dist_name'] = $form['dist_name'];
		$data['dist_description'] = $form['dist_description'];
		$data['dist_established_year'] = $form['dist_established_year'];
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_distributer($form, $id)
	{
		
		
		$data = array();

		$data['dist_name'] = $form['dist_name'];
		$data['dist_description'] = $form['dist_description'];
		$data['dist_established_year'] = $form['dist_established_year'];

		$this->where('dist_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	


	public function get_distributers($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('dist_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

	public function delete_distributer($selectid)
	{
		$if_distributer = $this->get_distributer_of_movie($selectid);
		if(empty($if_distributer)){

		$this->where('dist_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_distributer_of_movie($dist)
	{
		
			$this->where('movie_distributer_id',$dist);
			$this->from($this->table_movie);
			return $this->all_results();
		
	} // end of get


} // end of class


 ?>