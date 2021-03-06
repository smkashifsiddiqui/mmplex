<?php require_once 'header.php'; ?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('seat_booking_by_day', $user_capabilities)){	
		

?>
<?php 
	$reports = new reports();

	$distributer = new distributer();
	$all_distributer = $distributer->get_distributers();
			
	$movie = new movie();
	$all_movie = $movie->get_movies();

	
	$showtime = new showtime();
	$all_showtime = $showtime->get_all_showtimes();

	?>

<div class="container no-print">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_ticket_reports.php">Reports Ticket</a></li>
		  <li class="active">Seats bookings by day</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Todays Seats Booking</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" onclick="window.print()" name="">Print</button>
					 		<button type="submit" class="btn submitBtn save-button" name="g_ticketsales">Generate Report</button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->

			<div class="form-container">
				
			<div class="col-md-6">
			
				<div class="col-md-12">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span>  Date: </label>
						<div class="col-sm-8">
							<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control date_pp" >
						</div>
					</div>
				</div>

				
				
				<div class="clear"></div>

				
			</div><!-- col-md-6 -->

	<div class="col-md-6">
	</div><!-- col-md-6 -->
	 </form>
			<?php 
			
			if (isset($_POST['g_ticketsales'])) {	
				
			if($_POST['istart_date']){
					 $s_date1 	= $_POST['istart_date'];
				     $s_date = $reports->_date('Y-m-d', $s_date1);	

				} 
				else {
					$s_date = NULL;
				}

			
			//$results = $reports->get_ticket_sales_by_movie($s_date,$m_id);
			
			$results = $reports->get_all_shows();
						
			//print_f($s_date);
			
			//print_f($results);
			//die();
		
				}
			?>		
		
		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
			  <?php
					
					if (isset($results)) { 
					
					?>
					
					<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					
					<tr> 
					<th style=" font-size: 14px;"><strong>Report Date : </strong><strong><?php echo $s_date; ?></strong></th>
					<th style=" font-size: 14px;"></th>
					<th style=" font-size: 14px;"></th>
				
					<th style=" font-size: 14px;"><strong> : </strong><strong><?php echo date("d-M-y h:i"); ?></strong></th>
				
					</tr> 
					
					
					
					<tr> 
					<td>Showtime </td>
					<td>Movie </td>
					<td>Screen </td>
					
					<td>Qty</td>
					
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
						//print_f($results);
						$sub_total = 0;
						foreach ($results as $key => $value){
						$new_date = $reports->_date('Y-m-d', $value->showtime_datetime);
						
						
						if($s_date == $new_date){
						?>
					   <tr>
						
						
						
						<td><?php echo $reports->_date('d-m-y h:i a', $value->showtime_datetime); ?></td>
						
						<td><?php echo $value->movie_title; ?></td>
						<td><?php echo $value->screen_name; ?></td>
						<td><?php $tickets_qty = $reports->get_current_ticket_sale_by_show_id($value->showtime_id,$s_date);
						echo $total = $tickets_qty->booked_seats; if($tickets_qty->booked_seats == ""){echo 0;}?></td>
						
						
					
					</tr>   
					<?php
				
					$sub_total += $total;
					}}
					?>
					
					<tr> 
						
						
						<th></th>
						<th></th>
						<th style=" font-size: 14px;"><strong>Total</strong></th>
						<th style=" font-size: 14px;"><strong><?php echo $sub_total; ?></strong></th>
					</tr> 
				</tbody>

				</table>
				
				
				<?php }  // end result?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
			
		
	 </div><!-- Container Close -->
	 
	
<?php require_once 'footer.php'; ?>
<?php if (isset($results)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">
	<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:330px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
	<tr> 
	
		<tr> 
		<th colspan="4" style="width:82.5px;text-align:center;"><strong>Normal Seats Booking by Day</strong></th>
		</tr>
		
		<th style="width:82.5px;text-align:center;"><strong>Report Date</strong></th>
		<th style="width:82.5px;text-align:center;"><strong><?php echo $s_date; ?></strong></th>
	
		<th style="width:82.5px;text-align:center;"><strong></strong></th>
		<th style="width:82.5px;text-align:center;"><strong><?php echo date("d-M-y h:i"); ?></strong></th>
	</tr>
	
	
	</table>
	<div class="border" style="margin-top:5px;"></div>				
	<table  class=" border" cellpadding="1" cellspacing="1" style="text-align:center;width:330px;margin:auto;font-size: 10px; font-weight: bold;font-family: helvetica; ">
				<thead>
					
					<tr> 
					<td>Movie </td>
					<td>Screen </td>
					<td>Showtime </td>
					<td>Qty</td>
					
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
						//print_f($results);
						$sub_total = 0;
						foreach ($results as $key => $value){
						$new_date = $reports->_date('Y-m-d', $value->showtime_datetime);
						
						
						if($s_date == $new_date){
						?>
					   <tr>
						
						
						
						<td><?php echo $value->movie_title; ?></td>
						<td><?php echo $value->screen_name; ?></td>
						<td><?php echo $reports->_date('d-m-y h:i a', $value->showtime_datetime); ?></td>
						<td><?php $tickets_qty = $reports->get_current_ticket_sale_by_show_id($value->showtime_id,$s_date);
						echo $total = $tickets_qty->booked_seats; if($tickets_qty->booked_seats == ""){echo 0;}?></td>
						
						
					
					</tr>   
					<?php
				
					$sub_total += $total;
					}}
					?>
					
					<tr>	
						
						<th></th>
						<th></th>
						<th style=" font-size: 14px;text-align:center;"><strong>Total</strong></th>
						<th style=" font-size: 14px;text-align:center;"><strong><?php echo $sub_total; ?></strong></th>
					</tr> 
				</tbody>

				</table>
	<div class="voucher printPirnter border" style="margin-top:5px;"></div>	
	
	</div>
	<?php } ?>
	
	<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>