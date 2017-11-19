<?php 
/**
* INVENTORY MAIN CLASS
*/
class movie extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'movies';
		$this->table_showtime = 'showtimes';
	}

	public function insert_movie($form)
	{
		$data = array();

		$data['movie_title'] = $form['movie_title'];
		$data['movie_distributer_id'] = $form['movie_distributer_id'];
		if(isset($form['movie_rating'])){$data['movie_rating'] = $form['movie_rating'];}
		if(isset($form['movie_release_date'])){$data['movie_release_date'] = $form['movie_release_date'];}
		$data['movie_genre'] = $form['movie_genre'];
		$data['movie_duration'] = $form['movie_duration'];
		$data['movie_synopsis'] = $form['movie_synopsis'];
		$data['movie_trailor'] = $form['movie_trailor'];
		
		if(isset($form['movie_national_code'])){$data['movie_national_code'] = $form['movie_national_code'];}
		if(isset($form['movie_format'])){$data['movie_format'] = $form['movie_format'];}
		if(isset($form['movie_contract_start_date'])){$data['movie_contract_start_date'] = $form['movie_contract_start_date'];}
		/*if(isset($form['movie_rental_charges'])){$data['movie_rental_charges'] = $form['movie_rental_charges'];}
		if(isset($form['movie_contract_type'])){$data['movie_contract_type'] = $form['movie_contract_type'];}*/
		if(isset($form['movie_dist_seats'])){$data['movie_dist_seats'] = $form['movie_dist_seats'];}
		$data['movie_status'] = $form['movie_status'];
		if(isset($form['movie_actors'])){$data['movie_actors'] = json_encode($form['movie_actors']);}
		if(isset($form['movie_actors_role'])){$data['movie_actors_role'] = json_encode($form['movie_actors_role']);}

		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['movie_poster']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
			if (move_uploaded_file($_FILES['movie_poster']['tmp_name'], $uploadfile)) {
				$data['movie_poster'] = $uploadfilename;
			}
		}  
		

		$this->insert($this->table_name, $data);
		return $this->row_count();


	} // end of insert

	public function update_movie($form, $id)
	{
		
		
		$data = array();

		$data['movie_title'] = $form['movie_title'];
		$data['movie_distributer_id'] = $form['movie_distributer_id'];
		if(isset($form['movie_rating'])){$data['movie_rating'] = $form['movie_rating'];}
		if(isset($form['movie_release_date'])){$data['movie_release_date'] = $form['movie_release_date'];}
		$data['movie_genre'] = $form['movie_genre'];
		$data['movie_duration'] = $form['movie_duration'];
		$data['movie_synopsis'] = $form['movie_synopsis'];
		$data['movie_trailor'] = $form['movie_trailor'];
		if(isset($form['movie_national_code'])){$data['movie_national_code'] = $form['movie_national_code'];}
		if(isset($form['movie_format'])){$data['movie_format'] = $form['movie_format'];}
		
		if(isset($form['movie_contract_start_date'])){$data['movie_contract_start_date'] = $form['movie_contract_start_date'];}
		/*if(isset($form['movie_contract_type'])){$data['movie_contract_type'] = $form['movie_contract_type'];}
		if(isset($form['movie_rental_charges'])){$data['movie_rental_charges'] = $form['movie_rental_charges'];}*/
		if(isset($form['movie_dist_seats'])){$data['movie_dist_seats'] = $form['movie_dist_seats'];}
		$data['movie_status'] = $form['movie_status'];
		if(isset($form['movie_actors'])){$data['movie_actors'] = json_encode($form['movie_actors']);}
		if(isset($form['movie_actors_role'])){$data['movie_actors_role'] = json_encode($form['movie_actors_role']);}

		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['movie_poster']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['movie_poster']['tmp_name'], $uploadfile)) {
			$data['movie_poster'] = $uploadfilename;
		} }
		else {
         echo $data['movie_poster'] = $data['movie_poster1'];
        }
		   
		

		$this->where('movie_id', $id);
		$this->update($this->table_name, $data);
		    if (!$this->row_count()) {
				return false;
			}
			
			return $this->row_count();


	} // end of update

	

	public function get_movies($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('movie_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->inner_join('distributers', 'd', 'd.dist_id = movies.movie_distributer_id');
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

public function delete_movie($selectid)
	{
		$if_showtime = $this->get_showtimes_of_movie($selectid);
		if(empty($if_showtime)){

		$this->where('movie_id', $selectid);
		$this->delete($this->table_name, $num_rows = NULL);
		return true;
		}else{
			return false;
		}
		

		
	}


public function get_showtimes_of_movie($movie)
	{
		
			$this->where('showtime_movie_id',$movie);
			$this->from($this->table_showtime);
			return $this->all_results();
		
	} // end of get


public function get_service_movies($ID = NULL,$status = NULL)
	{	

		if (isset($ID)) {
			$movie_arr = array();
			
			$this->where('movie_id',$ID);
			$this->where('movie_status',$status);
			$this->from($this->table_name);
			$movies = $this->all_results();
			foreach ($movies as $movie) {
				
				$this->force_select_all();
				 $this->inner_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
				 $this->left_join('bookings', 'b', 'b.booking_showtime_id = showtimes.showtime_id');
				 $this->group_by('showtimes.showtime_id');
				 $this->select(array('SUM(b.booking_seat_qty)' => 'seats_sold'));
				 $this->select(array('s.screen_total_seats-SUM(b.booking_seat_qty)' => 'available_seats'));
				$this->where('showtime_movie_id', $movie->movie_id);
				$this->where('showtime_status', 'open');
				
				$this->from('showtimes');
				$shows = $this->all_results();
				$movie->show = $shows;

				$actors_k = "(".implode(',', (array)json_decode($movie->movie_actors)).")";

				$this->where('movie_person_id', $actors_k, 'IN');
				$this->from('movie_persons');
				$actors = $this->all_results();

				$roles = (array)json_decode($movie->movie_actors_role);

				foreach ($actors as $key => $actor) {
					$actors[$key]->role = $roles[$key];
				}

				$movie->actors = $actors;

				$movie_arr[] = $movie;


			}
			return $movie_arr;

		}
		else {
			$movie_arr = array();

			$this->where('movie_status',$status);
			$this->from($this->table_name);
			
			$movies = $this->all_results();

			foreach ($movies as $movie) {
				 $this->force_select_all();
				 $this->inner_join('screens', 's', 's.screen_id = showtimes.showtime_screen_id');
				 $this->left_join('bookings', 'b', 'b.booking_showtime_id = showtimes.showtime_id');
				 $this->group_by('showtimes.showtime_id');
				 $this->select(array('SUM(b.booking_seat_qty)' => 'seats_sold'));
				 $this->select(array('s.screen_total_seats-SUM(b.booking_seat_qty)' => 'available_seats'));
				 
				$this->where('showtime_movie_id', $movie->movie_id);
				$this->where('showtime_status', 'open');

				$this->from('showtimes');
				$shows = $this->all_results();

				$movie->show = $shows;

				$actors_k = "(".implode(',', (array)json_decode($movie->movie_actors)).")";

				$this->where('movie_person_id', $actors_k, 'IN');
				$this->from('movie_persons');
				$actors = $this->all_results();

				$roles = (array)json_decode($movie->movie_actors_role);

				foreach ($actors as $key => $actor) {
					$actors[$key]->role = $roles[$key];
				}

				$movie->actors = $actors;

				$movie_arr[] = $movie;


			}
			return $movie_arr;
		}
	} // end of get


	
	public function search_movies_service($search = NULL) {	
		if (isset($search)) {
			$search_title = '%'.$search.'%';
			$this->where('movie_title',$search_title,'LIKE');
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

} // end of class


 ?>