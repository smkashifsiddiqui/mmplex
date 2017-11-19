<?php require_once 'header.php'; ?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('ticket_sale_by_movie', $user_capabilities)){	
		

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
				<div class="col-md-12 t_select" id="showtime_movie_id"  >	
					<div class="form-group">
						<label for="showtime_movie_id"  class="col-sm-4 control-label"><span>* </span> Show Movie: </label>
						<div class="col-sm-8">
							<select  name="t_movie_id"  class="form-control" required>
								<option value=""  selected disabled >Select Movie</option>
								<?php 
								foreach ($all_movie as $value){ ?>

									<option value="<?php echo $value->movie_id; ?>" <?php if(isset($_POST['t_movie_id'] ) && $_POST['t_movie_id'] == $value->movie_id){echo 'selected=selected';}?>><?php echo $value->movie_title; ?></option>
								<?php } ?>
							</select>
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
				

			if(isset($_POST['t_movie_id'])){
					   $m_id 	= $_POST['t_movie_id'];
				} 
				else {
					  $m_id = NULL;
				}
			
			
			
			$results = $reports->get_weekly_shows($m_id);
			//print_f($results);
			
			$arr = array();

			foreach($results as $key => $item)
			{
			   $arr[$item->showtime_date][$key] = $item;
			}

			ksort($arr);
			//print_f($arr);
			
		
			$data = array();
			$week = 1;
			foreach ($arr as $key => $value){
			 $timestamp = strtotime($key);
			 $day =  date('l', $timestamp);
			 //print_f($day);
			 
				foreach ($value as $key1 => $value1){
					
					if($day == 'Friday'){
						 $data[$week][$value1->showtime_day][] = $value1->showtime_id;
						$week++;
					}else{
						 $data[$week][$value1->showtime_day][] = $value1->showtime_id;
					}
				}
			}
			//print_f($data);
			$movie = $reports->get_movie_by_id($m_id);
			
		   
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
						<th style=" font-size: 14px;"><strong>Movie : </strong><strong><?php echo $movie->movie_title; ?></strong></th>
						<th style=" font-size: 14px;"><strong> Current time : </strong><strong><?php echo $current_date_time; ?></strong></th>
						
						
					</tr> 
					
					<tr> 
						<td style=" font-size: 14px;"><strong>Week</strong></td>
						<td style=" font-size: 14px;"><strong>Week ticket total</strong></td>
					</tr>
					</thead>
					
				
				<tbody class="searchable">
						<?php 
						
					
						$total_sale = 0;
						$count = 0;
						foreach ($data as $key => $week){?>
						<tr>
						<td><?php echo $key; ?></td>
						<td>
							<?php 
							
							$week_total = 0;
							$comp_total = 0;
							$t_shows = sizeof($week);
							$per_day_seat = $movie->movie_dist_seats/$t_shows;
							
							foreach($week as $show_key => $show_value){?>
								<?php
								
								$show_total = 0;
								//per day shows
								$d_shows = sizeof($show_value);
								$per_show_seat = $per_day_seat/$d_shows;
								
								foreach($show_value as $value){
										
										
									$total_tickets = $reports->get_total_sale_by_id($value);
									$complementry_seats = $per_show_seat * $total_tickets->booking_price;
									
									$show_total += $total_tickets->total_tickets;
									 
									 //insert single show sales
									 // (total_show_less - complementry_sales) / 2
									 
									 $profit = ($total_tickets->total_tickets - $complementry_seats)/2;
									 $reports->insert_show_profit($value,$profit);
									
									 $week_total += $show_total;
									 $comp_total += $complementry_seats;
									}
									
									
									
								?>
								
							<?php }
							 echo $week_total;
							 $total_sale += $week_total;
							?>
						</td>
						
						</tr>		
						<?php 
								$count++;
							}?>
						
						<tr> 
							<td style=" font-size: 14px;"><strong>Total bookings</strong></td>
							<td style=" font-size: 14px;"><strong><?php echo $total_sale; ?></strong></td>
						</tr>
						
						<tr> 
							<td style=" font-size: 14px;"><strong>  Weeks * distributer seats/week</strong></td>
							<td style=" font-size: 14px;"><strong><?php if(isset($comp_total)){ echo  '-'.$comp_total; } ?></strong></td>
						</tr>
						
						<tr> 
							<?php ?>
							<th style=" font-size: 14px;"><strong>50% COST</strong></th>
							<th style=" font-size: 14px;"><strong><?php if(isset($comp_total)){ echo ($total_sale-$comp_total)/2;} ?></strong></th>
						</tr>
					   
				</tbody>

				</table>
				
				
				<?php }  // end result?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
			
		</div>	
	 </div><!-- Container Close -->

	<?php if (isset($results)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">
	<div class="border" style="margin-top:5px;"></div>				
	<table  class=" border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin:auto;font-size: 10px; font-weight: bold;font-family: helvetica; ">
				<thead>
					
					<tr> 
						<th style=" font-size: 14px;text-align:center;"><strong>Movie : </strong><strong><?php echo $movie->movie_title; ?></strong></th>
						<th style=" font-size: 14px;text-align:center;"><strong> Current time : </strong><strong><?php echo $current_date_time; ?></strong></th>
						
						
					</tr> 
					
					<tr> 
						<td style=" font-size: 14px;text-align:center;"><strong>Week</strong></td>
						<td style=" font-size: 14px;text-align:center;"><strong>Week ticket total</strong></td>
					</tr>
					</thead>
					
				
				<tbody class="searchable">
						<?php 
						
					
						$total_sale = 0;
						$count = 0;
						foreach ($data as $key => $week){?>
						<tr>
						<td><?php echo $key; ?></td>
						<td>
							<?php 
							
							$week_total = 0;
							$comp_total = 0;
							$t_shows = sizeof($week);
							$per_day_seat = $movie->movie_dist_seats/$t_shows;
							
							foreach($week as $show_key => $show_value){?>
								<?php
								
								$show_total = 0;
								//per day shows
								$d_shows = sizeof($show_value);
								$per_show_seat = $per_day_seat/$d_shows;
								
								foreach($show_value as $value){
										
										
									$total_tickets = $reports->get_total_sale_by_id($value);
									$complementry_seats = $per_show_seat * $total_tickets->booking_price;
									
									$show_total += $total_tickets->total_tickets;
									 
									 //insert single show sales
									 // (total_show_less - complementry_sales) / 2
									 
									 $profit = ($total_tickets->total_tickets - $complementry_seats)/2;
									 $reports->insert_show_profit($value,$profit);
									
									 $week_total += $show_total;
									 $comp_total += $complementry_seats;
									}
									
									
									
								?>
								
							<?php }
							 echo $week_total;
							 $total_sale += $week_total;
							?>
						</td>
						
						</tr>		
						<?php 
								$count++;
							}?>
						
						<tr> 
							<td style=" font-size: 14px;"><strong>Total bookings</strong></td>
							<td style=" font-size: 14px;"><strong><?php echo $total_sale; ?></strong></td>
						</tr>
						
						<tr> 
							<td style=" font-size: 14px;"><strong>  Weeks * distributer seats/week</strong></td>
							<td style=" font-size: 14px;"><strong><?php if(isset($comp_total)){ echo  '-'.$comp_total; } ?></strong></td>
						</tr>
						
						<tr> 
							<?php ?>
							<th style=" font-size: 14px;text-align:center;"><strong>50% COST</strong></th>
							<th style=" font-size: 14px;text-align:center;"><strong><?php if(isset($comp_total)){ echo ($total_sale-$comp_total)/2;} ?></strong></th>
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
	<?php require_once 'footer.php'; ?>
