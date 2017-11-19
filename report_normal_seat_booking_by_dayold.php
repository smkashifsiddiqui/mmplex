<?php require_once 'header.php'; ?>
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
						<label for="" class="col-sm-4 control-label"><span>*</span> Start Date: </label>
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

			
			
			$results = $reports->get_ticket_sales_by_day($s_date);
		//$results = array();
				}
			?>		

		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
			  <?php
					
					if (isset($results)) { ?>
					
					<table border="1" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
					 <th>Showtimes</th>
						
					<?php $screens = $reports->get_screen(); 
						  $booked_seats =0;
						  $sub_total = 0;
						  
						if (isset($screens)) { 
							
							foreach ($screens as $key => $value){ 
								echo '<th>'.$value->screen_name.'</th>';
							}
							
							
						}// end screens
						
						foreach ($results as $key => $value){ 
							echo '<tr>';
							$cust_format = $reports->_date('d-M-y H:i a', $value->showtime_datetime);	
							echo '<td>'.$cust_format.'</td>';
							
							foreach ($screens as $key1 => $value1){ 
								
								if($value1->screen_id == $value->showtime_screen_id){
								echo '<td>'.$value->booked_seats.'</td>';
								
							}else{
								echo '<td>0</td>';
								
								}
						    }
							
							echo '</tr>';
							
							
						}
						
						
						echo '<tr>';
						echo '<th>Screen total</th>';
						foreach ($screens as $key2 => $value2){ 
							$screen = $value2->screen_id;
							$screen_seats = $reports->get_ticket_sales_by_screen($screen,$s_date);
							echo '<th>'.$screen_seats->screen_seats.'</th>';
							$total = $screen_seats->screen_seats;
							$sub_total += $total;
						}
						echo '</tr>';
						
						
						//print_f($results);
						
						
					
					
					
					//die();
				?>
				</table>
				
				<h3 style="text-align: right;margin-right: 55px;">Total Seats:  <?php echo $sub_total; ?></h3>
				<?php }// end result?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
	 
	</div><!-- Container Close -->

	</div><!-- Print Table for Printer -->

    <?php if (isset($results)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">
	<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:330px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">

	<tr> 
		<th colspan="4" style="width:82.5px;text-align:center;"><strong>Normal Seats Booking</strong></th>
		
		
		
	</tr>

	<tr> 
		<th style="width:82.5px;text-align:center;"><strong>Report Day</strong></th>
		<th style="width:82.5px;text-align:center;"><strong><?php echo $s_date; ?></strong></th>
		
		<th style="width:82.5px;text-align:center;"><strong></strong></th>
		<th style="width:82.5px;text-align:center;"><strong><?php echo date("m-M-y h:i"); ?></strong></th>
	</tr>
	
	
	</table>
	<div class="border" style="margin-top:5px;"></div>				
	<table  class=" border" cellpadding="1" cellspacing="1" style="text-align:center;width:330px;margin:auto;font-size: 10px; font-weight: bold;font-family: helvetica; ">
		<th>Showtimes</th>
		<?php $screens = $reports->get_screen(); 
			  $booked_seats =0;
			  $sub_total = 0;
			if (isset($screens)) { 
				foreach ($screens as $key => $value){ 
					echo '<th>&nbsp;'.$value->screen_name.'&nbsp;</th>';
				}
			}// end screens						
			foreach ($results as $key => $value){ 
				echo '<tr>';
				$cust_format = $reports->_date('d-M-y H:i a', $value->showtime_datetime);	
				echo '<td>'.$cust_format.'</td>';
				foreach ($screens as $key1 => $value1){ 
					if($value1->screen_id == $value->showtime_screen_id){
					echo '<td>'.$value->booked_seats.'</td>';
				}else{
					echo '<td>0</td>';
					}
			    }
				echo '</tr>';
			}												
			echo '<tr>';
			echo '<th style="text-align:center;">Screen total: </th>';
			foreach ($screens as $key2 => $value2){ 
				$screen = $value2->screen_id;
				$screen_seats = $reports->get_ticket_sales_by_screen($screen,$s_date);
				echo '<th style="text-align:center;">'.$screen_seats->screen_seats.'</th>';
				$total = $screen_seats->screen_seats;
				$sub_total += $total;
			}
			echo '</tr>';
	?>
	</table>
	<div class="voucher printPirnter border" style="margin-top:5px;"></div>	
	<table class="voucher printPirnter border" cellpadding="1" cellspacing="1" style="width:330px;text-align:center;margin:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
		<tr>
			<th style="width:165px;text-align:center;">Total Seats: </th>
			<th style="width:165px;text-align:center;"><?php echo $sub_total;?></th>
		</tr>
	</table>
	</div>
	<?php } ?>
	
	
	
	
	
	
<?php require_once 'footer.php'; ?>
