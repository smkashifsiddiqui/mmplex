<?php 
/**
* USER MAIN CLASS
*/
class user extends database
{	
	
	private $table_name;

	function __construct(){
		parent::__construct();

		$this->table_name = 'users';
	}


	/**
	 * Login user
	 * @param  array $info submited form data
	 * @return boolean
	 */
	public function do_login($info)
	{	

		// Filter password
		$password = md5($info['password']);

		// Prepare where statement
		$this->where('user_name', $info['username']);
		$this->where('user_pass', $password);

		// Select user primary key
		$this->select(array('user_id' => 'id', 'user_fname'=>'first_name', 'user_lname'=>'last_name', 'user_email'=>'user_email','user_img'=>'user_img', 'user_capabilities'=>'capabilities',));

		// From table
		$this->from($this->table_name);

		// If provided info is correct, login user
		if ($this->row_count() > 0) {
			
			$results = $this->result();
			$_SESSION['is_logged_in'] = true;

			$_SESSION['user'] = $results;

			return $results;
		}else{
			return false;
		}
	} // end of do_login()


	// Get login status
	public static function is_logged_in()
	{	
		if (isset($_SESSION['is_logged_in'])) {
			return true;
		}else{
			return false;
		}
	} // end of is_logged_in()
	
	
	

	public function add_user($add_user)
	{	

		
		// Filter password
		$username 	= $add_user['username'];
		$email 		= $add_user['email'];
		// Prepare where statement
		$this->where('user_name', $add_user['username']);
	
		// From table
		$this->from($this->table_name);

		// If provided info is correct, login user
		if ($this->row_count() > 0) {
			$results = '<div class="alert alert-danger" role="alert">The ' . $username . ' Username is already exists</div>'; ;
			return $results;
		}else{
			$data = array();
			$password 	= md5($add_user['password']);
			$data['user_fname'] = $add_user['fname'];
			$data['user_lname'] = $add_user['lname'];
			$data['user_email'] = $add_user['email'];
			$data['user_name'] = $add_user['username'];
			$data['user_pass'] = $password;
			$data['user_mobile'] = $add_user['mobile'];
			$data['user_city'] = $add_user['city'];
			$data['user_salary'] = $add_user['salary'];
			
			$data['user_capabilities'] = json_encode($add_user['capabilities']);

			if ($_FILES){
			$uploaddir = ABSPATH.'/assets/images/uploads/';
			$uploadfilename =rand(1,99999) .basename($_FILES['user_img']['name']);
			$uploadfile = $uploaddir . $uploadfilename ;
			if (move_uploaded_file($_FILES['user_img']['tmp_name'], $uploadfile)) {
				$data['user_img'] = $uploadfilename;
			}
			
			  }  


		   $this->insert($this->table_name, $data);
		   return $this->row_count();

		}	
		
	} // end of do_register()


	public function update_user($add_user, $id)
	{
		
		$data = array();
		if($add_user['password'] == ""){
			$password 	= $add_user['old_password'];
		}else{
			$password 	= md5($add_user['password']);
		}
			
			$data['user_fname'] = $add_user['fname'];
			$data['user_lname'] = $add_user['lname'];
			$data['user_email'] = $add_user['email'];
			$data['user_name'] = $add_user['username'];
			$data['user_pass'] = $password;
			$data['user_mobile'] = $add_user['mobile'];
			$data['user_city'] = $add_user['city'];
			$data['user_salary'] = $add_user['salary'];
		//	$data['photo'] = $add_user['photo'];
			$data['user_capabilities'] = json_encode($add_user['capabilities']);
		
		if ($_FILES){
		$uploaddir = ABSPATH.'/assets/images/uploads/';
		$uploadfilename =rand(1,99999) .basename($_FILES['user_img']['name']);
		$uploadfile = $uploaddir . $uploadfilename ;
		if (move_uploaded_file($_FILES['user_img']['tmp_name'], $uploadfile)) {
			$data['user_img'] = $uploadfilename;
		} }
		else {
         echo $data['user_img'] = $data['user_img1'];
        }

        $this->where('user_id', $id);
		$this->update($this->table_name, $data);
		    if (!$this->row_count()) {
				return false;
			}
			
			return $this->row_count();


		

	} // end of update

/*
	public function get_user($ID)
	{
		$this->where('id',$ID);
		$this->from($this->table_name);

		return $this->result();
	} // end of get
*/
	public function get_users($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('user_id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

	public function session_destroy(){
		unset($_SESSION['user']);
		session_destroy();
	}

	

	public function delete_user($selectid)
	{
		

		$this->where('user_id', $selectid);
		if($this->delete($this->table_name, $num_rows = NULL)){
			return true;
		}else{
			return false;
		}
		
	}

}
 ?>
