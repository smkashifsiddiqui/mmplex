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
		  <li class="active">Corporate Sales</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Corporate Sales</h3>
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
							<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control datetimepicker" required>
						</div>
					</div>
				</div>

				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span> End Date: </label>
						<div class="col-sm-8">
							<input type="text" name="iend_date" id="" value="<?php if(isset($_POST['iend_date'] ) && $_POST['iend_date'] != ""){echo $_POST['iend_date'];}?>" class="form-control datetimepicker" required>
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
									<?php if($value->showtime_key == 'private'){?>
									<option value="<?php echo $value->showtime_id; ?>" <?php if(isset($_POST['t_showtime_id'] ) && $_POST['t_showtime_id'] == $value->showtime_id){echo 'selected=selected';}?>><?php echo date('d/M/Y H:i a', strtotime($value->showtime_datetime)); ?></option>
								<?php }} ?>
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
			
			$results = $reports->get_corporate_ticket_sales($m_id,$d_id,$s_id,$s_date,$e_date,$filter_id);
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
					<th>Included Items</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Amount</th>
				</thead>
				<tbody class="searchable">
					<?php 
						$count = 1;
						$sub_total = 0;
						
						$newOptions = array();
	        			foreach ($results as $key => $value){ 

	        				
	        				//get voucher items
	        				$v_items = $value->voucher_package_item_name;
	        				$v_items = (!empty($v_items))? json_decode($v_items) : array();
	        				
							//get voucher items qty
							$v_items_qty = $value->voucher_package_item_qty;
	        				$v_items_qty = (!empty($v_items_qty))? json_decode($v_items_qty) : array();

	        				//get voucher ticket
	        				$v_ticket_type = $value->voucher_package_ticket_name;
	        				$v_ticket_type = (!empty($v_ticket_type))? json_decode($v_ticket_type) : array();

	        				?>
					    <tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $e_date = $reports->_date('Y-M-d', $value->voucher_datetime);?></td>
						<td>
							<?php 
								$v_movie = $movie->get_movies($value->voucher_movie_id);
								echo $v_movie->movie_title;
							?>
						</td>
						<td>
							<?php 
								$v_dist = $distributer->get_distributers($value->voucher_dist_id);
								echo $v_dist->dist_name;
							 ?>
						</td>
						<td><?php echo $value->screen_name; ?></td>
						<td><?php echo $value->showtime_datetime; ?></td>
						<td>
							<?php 
							$counter = 0; 
							
							$all_v_ticket = $reports->get_ticket_detail($v_ticket_type[0]);
							echo $all_v_ticket[0]->ticket_title.' X 1<br/>';
							
							foreach ($v_items as  $v_items_value){
								$all_v_items = $reports->get_item_details($v_items_value);
								echo $all_v_items[0]->item_name.' X '.$v_items_qty[$counter].'<br/>';
								$counter ++;
							 } ?>

						</td>
						<td><?php echo $value->voucher_price; ?></td>
						<td><?php echo $value->screen_total_seats; ?></td>
						<td><?php echo $total =  $value->screen_total_seats * $value->voucher_price; ?></td>
						
						
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