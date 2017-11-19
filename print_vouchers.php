<?php require_once 'common/init.php'; ?>

<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('add_voucher', $user_capabilities)){	
		
	


//$sales = new sales();

//$form['bill_number'] = $bill_number;
//$form['user_shift_number'] = $user_shift_number;
//$form['user_terminal_point_number'] = $user_terminal_point_number;
//$form['user_id'] = $_SESSION['user']->id;
//$form['payment_mode'] = $_GET['payment_mode'];


$printvoucher = new printvoucher();

$voucher_showid = $_GET['v_show_id'];
$voucher_screenid = $_GET['v_sc_id'];
$voucher_type = $_GET['v_type'];
$voucher_movieid = $_GET['v_m'];
$voucher_distid = $_GET['v_d'];


//get voucher detail by voucher type
$v_detail = $printvoucher->get_voucher_details($voucher_type);

//print_f($v_detail);

//check if voucher already inserted or not
$check_exist = $printvoucher->get_booked_vouchers_shwid($voucher_showid);

if(empty($check_exist)){

	$insert_voucher = $printvoucher->insert_all_voucher($voucher_showid,$voucher_screenid,$voucher_movieid,$voucher_distid,$voucher_type);
	
	if ($insert_voucher) {

		$already_exist_vouchers = $printvoucher->get_booked_vouchers_shwid($voucher_showid);
		//print_f($already_exist_vouchers[0]);
		//get movie name 
		$moviename = $printvoucher->get_movie_details($already_exist_vouchers[0]->showtime_movie_id);
		
		//get screen name 
		$screenname = $printvoucher->get_screen_seats($voucher_screenid);

		foreach ($already_exist_vouchers as $value) {?>

		<div class="voucher" style="position:relative;margin-bottom:20px;width:504px;height:218px;margin:auto;font-family:helvetica;background-color:#2d2d2d;color: white;text-transform: uppercase;">
			<img width=="100%" src="assets/images/v_header.png"/>
			
			<?php 

				$key =   $value->voucher_id;
				$keyid  = base64_encode($key);
				// $id = base64_decode($id);
				 ?>

			<div class="left" style="width:100%;display:block;padding-left: 25px;margin-top: 20px;">
				<p style="margin-left: 25px;margin: 5px;font-size: 13px;"> <strong>Voucher code :</strong> <?php echo $value->voucher_unique_id.$keyid; ?> </p>
			</div>

			<div class="left" style="width:50%;float:left;margin-left: 25px;margin-bottom: 25px;">
				<p style="margin: 5px;font-size: 13px;"><strong>Movie :</strong> <?php echo $moviename[0]->movie_title;?> </p>
				<p style="margin: 5px;font-size: 13px;"><strong>Type :</strong> <?php echo $v_detail[0]->voucher_title;?> </p>
				<p style="margin: 5px;font-size: 13px;"><strong>Date & Time :</strong> <?php echo $already_exist_vouchers[0]->showtime_datetime;?> </p>
				
				
			</div><!--left-->

			<div class="right" style="width:50%;float:left;margin-left: 25px;">
				<p style="margin: 5px;font-size: 13px;"><strong>Screen :</strong> <?php echo $screenname[0]->screen_name;?> </p>
				<p style="margin: 5px;font-size: 13px;"><strong>Valid til:</strong> <?php echo $v_detail[0]->voucher_enddate;?> </p>
				
				
			</div><!--right-->

			<div class="v_footer" style="clear: both;background-color: #f58221;overflow: hidden;position:absolute;bottom: 0;width: 100%;">
				<div class="left" style="50%;float:left;margin-left: 25px;">
					<p style="margin: 5px;font-size: 13px;">www.megamultiplex.com</p>
				</div><!--left-->

				<div class="right" style="50%;float:left;margin-left: 30px;">
					<p style="margin: 5px;font-size: 13px;">info@megamultiplex.com</p>
				</div><!--right-->
			</div><!--v_footer-->

		</div><br/><!--voucher printer-->

<?php }


	}

}else{

	$already_exist_vouchers = $printvoucher->get_booked_vouchers_shwid($voucher_showid);
	//print_f($already_exist_vouchers[0]);
	//get movie name 
	$moviename = $printvoucher->get_movie_details($already_exist_vouchers[0]->showtime_movie_id);
	
	//get screen name 
	$screenname = $printvoucher->get_screen_seats($voucher_screenid);

	foreach ($already_exist_vouchers as $value) {?>

		<div class="voucher" style="position:relative;margin-bottom:20px;width:504px;height:215px;margin:auto;font-family:helvetica;background-color:#2d2d2d;color: white;text-transform: uppercase;">
			<img width=="100%" src="assets/images/v_header.png"/>
			
			<?php 

				$key =   $value->voucher_id;
				$keyid  = base64_encode($key);
				// $id = base64_decode($id);
				 ?>

			<div class="left" style="100%;display:block;padding-left: 25px;margin-top: 20px;">
				<p style="margin-left: 25px;margin: 5px;font-size: 13px;"> <strong>Voucher code :</strong> <?php echo $value->voucher_unique_id.$keyid; ?> </p>
			</div>

			<div class="left" style="50%;float:left;margin-left: 25px;margin-bottom: 25px;">
				<p style="margin: 5px;font-size: 13px;"><strong>Movie :</strong> <?php echo $moviename[0]->movie_title;?> </p>
				<p style="margin: 5px;font-size: 13px;"><strong>Type :</strong> <?php echo $v_detail[0]->voucher_title;?> </p>
				<p style="margin: 5px;font-size: 13px;"><strong>Date & Time :</strong> <?php echo $already_exist_vouchers[0]->showtime_datetime;?> </p>
				
				
			</div><!--left-->

			<div class="right" style="50%;float:left;margin-left: 25px;">
				<p style="margin: 5px;font-size: 13px;"><strong>Screen :</strong> <?php echo $screenname[0]->screen_name;?> </p>
				<p style="margin: 5px;font-size: 13px;"><strong>Valid til:</strong> <?php echo $v_detail[0]->voucher_enddate;?> </p>
				
				
			</div><!--right-->

			<div class="v_footer" style="clear: both;background-color: #f58221;overflow: hidden;position:absolute;bottom: 0;width: 100%; ">
				<div class="left" style="50%;float:left;margin-left: 25px;">
					<p style="margin: 5px;font-size: 13px;">www.megamultiplex.com</p>
				</div><!--left-->

				<div class="right" style="50%;float:left;margin-left: 30px;">
					<p style="margin: 5px;font-size: 13px;">info@megamultiplex.com</p>
				</div><!--right-->
			</div><!--v_footer-->

		</div><br/><!--voucher printer-->

<?php }

}


?>

<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
    
	}
?>