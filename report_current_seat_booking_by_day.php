<?php require_once 'header.php'; ?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('current_booking_by_day', $user_capabilities)){	
		

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
	
	<style>
	@media print {
  body {
    visibility: visible;
  }

  .no-print, .footer-container{
    display: none; 
  }

  .printPirnter {
    display: block !important; 
  }

  .voucher * {
    visibility: visible;
  }

  .voucher {
    visibility: visible;
  }
  
  


}


	</style>

<div class="container">

	<div class="row  no-print">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_ticket_reports.php">Reports Ticket</a></li>
		  <li class="active">Current Seats bookings by day</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm  no-print"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Seats bookings by day</h3>
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
				     $s_date = $reports->_date('Y/m/d', $s_date1);
					 $s_date1 = $reports->_date('Y-m-d', $s_date1);

				} 
				else {
					$s_date = NULL;
				}

			 $results_cinema = $reports->get_all_cinema();
			}
			?>		
		
		<div class="col-md-12  no-print">
		<div class="the-box full no-border">
			<div class="table-responsive">
		 <?php if (isset($results_cinema)) { ?>
					
					<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					
					<tr> 
					<th style=" font-size: 14px;"><strong>Report Date : </strong><strong><?php echo $s_date; ?></strong></th>
					<th style=" font-size: 14px;"></th>
					<th style=" font-size: 14px;"></th>
					<th style=" font-size: 14px;"></th>
					<th style=" font-size: 14px;"></th>
					<th style=" font-size: 14px;"></th>
				
				
					<th style=" font-size: 14px;"><strong> Current time : </strong><strong><?php echo $current_date_time; ?></strong></th>
				
					</tr> 
					
					
					
					<tr> 
					<td>Screens </td>
					<td>1st </td>
					<td>2nd </td>
					<td>3rd </td>
					<td>4th </td>
					<td>5th </td>
					<td>Qty</td>
					
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						<?php 
						$final_total =0;
						foreach ($results_cinema as $key => $value){ 
						$sub_total = 0;
						$total = 0;
					
						$cinema_id = $value->screen_id; ?>
						<tr>
						
						<td><?php echo  $value->screen_name; ?></td>
						
						<?php  $show_times = $reports->get_all_shows_by_cinema($cinema_id,$s_date);
								//print_f($show_times);
								$td = 5;
								foreach ($show_times as $key => $shows){ 
								  $td--;
								
						?>
						<td><?php echo $reports->_date(' h:i a', $shows->showtime_datetime); ?><br/>Seats: 
						<?php $tickets_qty = $reports->get_current_ticket_sale_by_show_id($shows->showtime_id,$s_date1);
						      echo $sub_total = $tickets_qty->booked_seats; if($tickets_qty->booked_seats == ""){echo 0;}
						?>
						</td>
						
						
						<?php $total +=  $sub_total; }
						for($i=0; $i < $td; $i++){
							echo '<td> - </td>';
						}
						
						?>
						
						<td><?php echo $total;  $final_total += $total; ?>	</td>
						
						</tr>
						
						
						<?php
						//print_f($show_times);
						}
						?>
						
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Total</td>
							<td><?php echo $final_total; ?></td>
						</tr>
						</tbody>
						</table>
						
		 <?php } ?>
	        			
			</div><!-- /.table-responsive -->
		</div>	
	
		</div><!-- /col-md-12 -->
			
		</div>
		
		
		
		
		
		 <?php if (isset($results_cinema)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">
	<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
	<tr> 
	
		<tr> 
		<th colspan="7" style="width:140px;text-align:center;"><strong>Seats Booking by Day</strong></th>
		</tr>
		
		<th colspan="2" style="width:140px;text-align:center;"><strong>Report Date</strong></th>
		<th colspan="2" style="width:140px;text-align:center;"><strong><?php echo $s_date; ?></strong></th>
		
		<th colspan="2" style="width:140px;text-align:center;"><strong>Current time:</strong></th>
		<th style="width:140px;text-align:center;"><strong><?php echo $current_date_time; ?></strong></th>
	</tr>
	
	
	</table>
	<div class="border" style="margin-top:5px;"></div>				
	<table  class=" border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin:auto;font-size: 10px; font-weight: bold;font-family: helvetica; ">
				<thead>
					
					<tr> 
					<td>Screens </td>
					<td>1st </td>
					<td>2nd </td>
					<td>3rd </td>
					<td>4th </td>
					<td>5th </td>
					<td>Qty</td>
					
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						<?php 
						$final_total =0;
						foreach ($results_cinema as $key => $value){ 
						$sub_total = 0;
						$total = 0;
					
						$cinema_id = $value->screen_id; ?>
						<tr>
						
						<td><?php echo  $value->screen_name; ?></td>
						
						<?php  $show_times = $reports->get_all_shows_by_cinema($cinema_id,$s_date);
								//print_f($show_times);
								$td = 5;
								foreach ($show_times as $key => $shows){ 
								  $td--;
								
						?>
						<td><?php echo $reports->_date(' h:i a', $shows->showtime_datetime); ?><br/>Seats: 
						<?php $tickets_qty = $reports->get_ticket_sale_by_show_id($shows->showtime_id);
						      echo $sub_total = $tickets_qty->booked_seats; if($tickets_qty->booked_seats == ""){echo 0;}
						?>
						</td>
						
						
						<?php $total +=  $sub_total; }
						for($i=0; $i < $td; $i++){
							echo '<td> - </td>';
						}
						
						?>
						
						<td><?php echo $total;  $final_total += $total; ?>	</td>
						
						</tr>
						
						
						<?php
						//print_f($show_times);
						}
						?>
						
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Total</td>
							<td><?php echo $final_total; ?></td>
						</tr>
						</tbody>

				</table>
	<div class="voucher printPirnter border" style="margin-top:5px;"></div>	
	
	</div>
	<?php } ?>

	 </div><!-- Container Close -->
	 
	
<?php require_once 'footer.php'; ?>


	
	<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>