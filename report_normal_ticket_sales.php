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
	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_ticket_reports.php">Reports Ticket</a></li>
		  <li class="active">Normal Ticket Sales</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Ticket Sales Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
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
							<input type="radio"  name="t_report_filter" class="t_report_filter" value="t_distributer_id" <?php if(isset($_POST['t_report_filter']) &&  $_POST['t_report_filter'] == 't_distributer_id'){echo 'checked';}?>>
								Distributer Name 
						</label>
						<label>
							<input type="radio"  name="t_report_filter" class="t_report_filter" value="showtime_movie_id" <?php if(isset($_POST['t_report_filter']) && $_POST['t_report_filter'] == 'showtime_movie_id'){echo 'checked';}?>>
								 Movie Name 
						</label>
						<label>
							<input type="radio"  name="t_report_filter" class="t_report_filter" value="t_showtime_id" <?php if(isset($_POST['t_report_filter']) &&  $_POST['t_report_filter'] == 't_showtime_id'){echo 'checked';}?>>
								 Showtimes 
						</label>
						</div>
				</div>			

				<div class="col-md-12 t_select" id="t_distributer_id" <?php if(isset($_POST['t_report_filter']) &&  $_POST['t_report_filter'] == 't_distributer_id'){}else{echo 'style="display:none;"';}?>>		
					<div class="form-group">
						<label for="ticket_class" class="col-sm-4 control-label"><span>*</span> Select Distributer: </label>
						<div class="col-sm-8">
							<select  name="t_distributer_id"  class="form-control" >
								<option value=""  selected disabled>Select Distributer</option>
								<?php foreach ($all_distributer as $value){ ?>
									<option value="<?php echo $value->dist_id; ?>" <?php if(isset($_POST['t_distributer_id'] ) && $_POST['t_distributer_id'] == $value->dist_id){echo 'selected=selected';}?>><?php echo $value->dist_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

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

				<div class="col-md-12 t_select" id="t_showtime_id" <?php if(isset($_POST['t_report_filter']) &&  $_POST['t_report_filter'] == 't_showtime_id'){}else{echo 'style="display:none;"';}?>>	
					<div class="form-group">
						<label for="showtime_id" class="col-sm-4 control-label"><span>* </span> Show Times: </label>
						<div class="col-sm-8">
							<select  name="t_showtime_id"  class="form-control">
								<option value=""  selected disabled >Select Showtime</option>
								<?php 
								foreach ($all_showtime as $value){ ?>
								<?php if($value->showtime_key == 'public'){?>
									<option value="<?php echo $value->showtime_id; ?>" <?php if(isset($_POST['t_showtime_id'] ) && $_POST['t_showtime_id'] == $value->showtime_id){echo 'selected=selected';}?>><?php echo date('d/M/Y H:i a', strtotime($value->showtime_datetime)); ?></option>
								<?php } } ?>
							</select>
						</div>
					</div>
				</div>
			
			</div><!-- col-md-6 -->

	<div class="col-md-6">
	</div><!-- col-md-6 -->
	 </form>
			<?php 
			

			if (isset($_POST['g_ticketsales'])) {	
				
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

			if(isset($_POST['t_distributer_id'])){
					   $d_id 	= $_POST['t_distributer_id'];
				} 
				else {
					 $d_id = NULL;
				}

			if(isset($_POST['t_movie_id'])){
					   $m_id 	= $_POST['t_movie_id'];
				} 
				else {
					  $m_id = NULL;
				}

				if(isset($_POST['t_showtime_id'])){
					   $s_id 	= $_POST['t_showtime_id'];
				} 
				else {
					  $s_id = NULL;
				}
			
				
				if(isset($_POST['t_report_filter'])){
					    $filter_id 	= $_POST['t_report_filter'];
				} 
				else {
					  $filter_id = NULL;
				}
			
			$results = $reports->get_normal_ticket_sales($m_id, $d_id,$s_id,$s_date,$e_date,$filter_id);
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
					<th>No.</th>
					<th>Transaction Time</th>
					<th>Movie</th>
					<th>Distributer</th>
					<th>Screen</th>
					<th>Showtimes</th>
					<th>Qty</th>
					<th>Price</th>
				</thead>
				<tbody class="searchable">
					<?php 
						$count = 1;
						$sub_total = 0;
						$newOptions = array();
	        			foreach ($results as $key => $value){ ?>
					    

					    <tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $e_date = $reports->_date('Y-M-d', $value->booking_date);?></td>
						<td><?php echo $value->movie_title; ?></td>
						<td><?php echo $value->dist_name; ?></td>
						<td><?php echo $value->showtime_screen_id; ?></td>
						<td><?php echo $value->showtime_datetime; ?></td>
						<td><?php echo $value->booking_seat_qty; ?></td>
						<td><?php echo $total = $value->booking_price; ?></td>
						
					</tr>    
					<?php
					$count++;
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
						<td style=" font-size: 14px;"><strong>Total</strong></td>
						<td style=" font-size: 14px;"><strong><?php echo $sub_total; ?></strong></td>
					</tr> 

			</table>
			<?php }
			?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
			
			
	 
	</div><!-- Container Close -->
<?php require_once 'footer.php'; ?>