<?php 
/**
* INVENTORY MAIN CLASS
*/
class screen extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'screens';
		$this->table_showtime = 'showtimes';
		
	}

	public function insert_screen($form)
	{
		$data = array();

		$data['screen_name'] = $form['screen_name'];
		$data['screen_total_seats'] = $form['screen_total_seats'];
		$data['screen_house_seats'] = $form['screen_house_seats'];
		$data['screen_wheel_chair_seats'] = $form['screen_wheel_chair_seats'];
		if(isset($form['screen_rows'])){
		$data['screen_rows']	= json_encode($form['screen_rows']) ;
		$data['screen_row_column'] = json_encode($form['screen_row_column']);}
		
		
		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['screen_seat_layout_diagram']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['screen_seat_layout_diagram']['tmp_name'], $uploadfile)) {
			$data['screen_seat_layout_diagram'] = $uploadfilename;
		}
		
		  }  
		

		$this->insert($this->table_name, $data);
		return $this->row_count();
		

	} // end of insert

	public function update_screen($form, $id)
	{
		
		
		$data = array();

		$data['screen_name'] = $form['screen_name'];
		$data['screen_total_seats'] = $form['screen_total_seats'];
		$data['screen_house_seats'] = $form['screen_house_seats'];
		$data['screen_wheel_chair_seats'] = $form['screen_wheel_chair_seats'];
	
		if(isset($form['screen_rows'])){
		$data['screen_rows']	= json_encode($form['screen_rows']) ;
		$data['screen_row_column'] = json_encode($form['screen_row_column']);}



		

		
		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['screen_seat_layout_diagram']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['screen_seat_layout_diagram']['tmp_name'], $uploadfile)) {
			$data['screen_seat_layout_diagram'] = $uploadfilename;
		} }
		else {
         echo $data['screen_seat_layout_diagram'] = $data['screen_seat_layout_diagram1'];
        }
		   
		

		$this->where('screen_id', $id);
		$this->update($this->table_name, $data);
		    if (!$this->row_count()) {
				return false;
			}
			
			return $this->row_count();
		

		
		
		

		

	} // end of update

	


	public function get_screens($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('screen_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

public function get_screen_seats($ID = NULL)
	{
		
			$this->where('screen_id',$ID);
			$this->from($this->table_name);
			return $this->all_results();
		
	} // end of get


public function delete_screen($selectid)
	{
		$if_showtime = $this->get_showtime_of_screen($selectid);
		if(empty($if_showtime)){

		$this->where('screen_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_showtime_of_screen($screen)
	{
		
			$this->where('showtime_screen_id',$screen);
			$this->from($this->table_showtime);
			return $this->all_results();
		
	} // end of get

} // end of class


 ?>