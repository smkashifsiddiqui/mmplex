<?php require_once 'header.php'; ?>
<?php 
	$reports = new reports();

	$distributer = new distributer();
	$all_distributer = $distributer->get_distributers();
			
	$movie = new movie();
	$all_movie = $movie->get_movies();

	
	$showtime = new showtime();
	$all_showtime = $showtime->get_all_showtimes();

	$screen = new screen();

	

	?>
	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_movie_reports.php">Reports Movie</a></li>
		  <li class="active">Film Rental</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Film Rental Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="g_filmrental">Generate Report</button>
					 		
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
							<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control datetimepicker" >
						</div>
					</div>
				</div>

				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span> End Date: </label>
						<div class="col-sm-8">
							<input type="text" name="iend_date" id="" value="<?php if(isset($_POST['iend_date'] ) && $_POST['iend_date'] != ""){echo $_POST['iend_date'];}?>" class="form-control datetimepicker" >
						</div>
					</div>
				</div>

				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						
						<label>
							<input type="radio"  name="t_report_filter" class="t_report_filter" value="showtime_movie_id" <?php if(isset($_POST['t_report_filter']) && $_POST['t_report_filter'] == 'showtime_movie_id'){echo 'checked';}?>>
								 Movie Name 
						</label>
						
						</div>
				</div>			

				

				<div class="col-md-12 t_select" id="showtime_movie_id"  <?php if(isset($_POST['t_report_filter']) &&  $_POST['t_report_filter'] == 'showtime_movie_id'){}else{echo 'style="display:none;"';}?>>	
					<div class="form-group">
						<label for="showtime_movie_id"  class="col-sm-4 control-label"><span>* </span> Show Movie: </label>
						<div class="col-sm-8">
							<select  name="t_movie_id"  class="form-control" >
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
			

			if (isset($_POST['g_filmrental'])) {	
				
			if($_POST['istart_date']){
					 $s_date1 	= $_POST['istart_date'];
				     $s_date = $reports->_date('Y-m-d H:i:s', $s_date1);	

				} 
				else {
					$s_date = NULL;
				}

			if($_POST['iend_date']){
					   $e_date1 	= $_POST['iend_date'];
					   $e_date = $reports->_date('Y-m-d H:i:s', $e_date1);	
				} 
				else {
					 $e_date = NULL;
				}

		

			if(isset($_POST['t_movie_id'])){
					   $m_id 	= $_POST['t_movie_id'];
				} 
				else {
					  $m_id = NULL;
				}

				
			
				
				if(isset($_POST['t_report_filter'])){
					    $filter_id 	= $_POST['t_report_filter'];
				} 
				else {
					  $filter_id = NULL;
				}
			
			$results = $reports->get_film_rental_public($m_id,$s_date,$e_date,$filter_id);
			$results_private = $reports->get_film_rental_private($m_id,$s_date,$e_date,$filter_id);
				}
			?>	

		

		<div class="col-md-12">
			
		<div class="the-box full no-border">
			<div class="table-responsive">
				<?php 
			if (isset($results)) { 
			
			?>
			<div class="col-md-12">
				<h2  style="margin-left: 50px;margin-top: 50px;">Public shows</h2>
			</div>
			<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					<th>No.</th>
					<th>Contract start Date</th>
					<th>Movie</th>
					<th>Distributer</th>
					<th>Screen</th>
					<th>Showtimes</th>
					<th>Admits</th>
					<th>complementary</th>
					<th>Price</th>
				</thead>
				<tbody class="searchable">
					<?php 
						$count = 1;
						$sub_total = 0;
						$counter = 0;
						$newOptions = array();
	        			foreach ($results as $key => $value){
					    //print_f($value); ?>

					     <tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $e_date = $reports->_date('d-M-Y', $value->movie_contract_start_date);?></td>
						<td><?php echo $value->movie_title; ?></td>
						<td>
							<?php 
								$dist = $distributer->get_distributers($value->movie_distributer_id);
								echo $dist->dist_name; 
							 ?>
						</td>
						<td>
							<?php 
								$all_screen = $screen->get_screens($value->showtime_screen_id);
								echo $all_screen->screen_name; 
							?>
						</td>
						<td><?php 
								echo $s_date = $reports->_date('d-M-Y h:i:s a', $value->showtime_datetime);
							?>
						</td>
						<td><?php 
								$show_time_is = $value->booking_showtime_id;
								$booked = $reports->get_qty_total($show_time_is);
								echo $booked[0]->qty;
							
							 ?>
						</td>
						<td><?php 
								$show_time_is = $value->booking_showtime_id;
								$booked_comp = $reports->get_qty_total_comp($show_time_is);
								if (!empty($booked_comp)) {
									echo $booked_comp[0]->qty;
								}else{echo '0';}
								
								?>
						</td>
						<td>
						<?php 
								$show_time_is = $value->booking_showtime_id;
								$booked_p = $reports->get_price_total($show_time_is);

								if (!empty($booked_p)) {
									echo $total = $booked_p[0]->qty;
								}else{echo '0';}
								
							 ?>

							
						</td>
						
					</tr>  
					<?php
					$count++;
					$counter++;
					$sub_total += $total;
					}
					?>
				</tbody>

				<tr> 
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style=" font-size: 14px;"><strong>Total</strong></td>
						<td style=" font-size: 14px;"><strong><?php echo $sub_total; ?></strong></td>
					</tr> 

			</table>
			<?php }
			?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->


		

		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
				<?php 
			if (isset($results_private)) { 
			
			?>
			<div class="col-md-12">
				<h2  style="margin-left: 50px;">Corporate shows</h2>
			</div>
			<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					<th>No.</th>
					<th>Contract start Date</th>
					<th>Movie</th>
					<th>Distributer</th>
					<th>Screen</th>
					<th>Showtimes</th>
					<th>Admits</th>
					<th>complementary</th>
					<th>Price</th>
				</thead>
				<tbody class="searchable">
					<?php 
						$count = 1;
						$sub_tota2 = 0;
						$counter = 0;
						$newOptions = array();
	        			foreach ($results_private as $key => $value){
					    //print_f($value); ?>

					     <tr>
						<td><?php echo $count; ?></td>
						<td>
							<?php 
								$contact_date = $movie->get_movies($value->voucher_movie_id);
						 		echo $e_date = $reports->_date('d-M-Y', $contact_date->movie_contract_start_date);
							?>
						</td>
						<td>
						<?php
							$mov = $movie->get_movies($value->voucher_movie_id);
						 	echo $mov->movie_title;
					    ?>
						</td>
						<td>
							<?php 
								$dist = $distributer->get_distributers($value->voucher_dist_id);
								echo $dist->dist_name; 
							 ?>
						</td>
						<td>
							<?php 
								$all_screen = $screen->get_screens($value->voucher_screenid);
								echo $all_screen->screen_name; 
							?>
						</td>
						<td><?php echo $value->showtime_datetime; ?></td>
						<td><?php echo $value->screen_total_seats; ?>
						</td>
						<td>
							<?php 
								echo '0';
							?>
						</td>
						<td>
							<?php 
								$current_ticket = $value->voucher_package_ticket_price;
								$current_ticket = (!empty($current_ticket))? json_decode($current_ticket) : array();
								echo $total2 = $current_ticket[0] * $value->screen_total_seats;
								
							 ?>

							
						</td>
						
					</tr>  
					<?php
					$count++;
					$counter++;
					$sub_tota2 += $total2;
					}
					?>
				</tbody>

				<tr> 
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style=" font-size: 14px;"><strong>Total</strong></td>
						<td style=" font-size: 14px;"><strong><?php echo $sub_tota2; ?></strong></td>
					</tr> 

			</table>
			<?php }
			?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
			
			
	 
	</div><!-- Container Close -->
<?php require_once 'footer.php'; ?>