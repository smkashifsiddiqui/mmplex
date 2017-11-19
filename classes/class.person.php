<?php 
/**
* INVENTORY MAIN CLASS
*/
class person extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'movie_persons';
		$this->table_movie = 'movies';
		
	}

	public function insert_person($form)
	{
		$data = array();

		$data['movie_person_name'] = $form['movie_person_name'];
		
		//print_f($data);
		//die();
			
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_person($form, $id)
	{
		
		
		$data = array();

		$data['movie_person_name'] = $form['movie_person_name'];

		$this->where('movie_person_id', $id);
		$this->update($this->table_name, $data);

		if (!$this->row_count()) {
			return false;
		}
		
		

		return $this->row_count();

	} // end of update

	


	public function get_persons($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('movie_person_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get


	public function delete_person($selectid)
	{

		$if_person  = $this->get_person_of_movie($selectid);
		
		if(!$if_person){
			
		$this->where('movie_person_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_person_of_movie($person)
	{
		
		$this->from($this->table_movie);
			$p_result =  $this->all_results();
			
				
			foreach ($p_result as $key => $value) {
				$current_actors = $value->movie_actors;
				$current_actors = (!empty($current_actors))? json_decode($current_actors) : array();
					foreach ($current_actors as $key1 => $value1) {
						if($person == $value1){
							return $value1;
						}
						
					}
				}
		
	} // end of get


} // end of class


 ?>