<?php require_once 'header.php'; ?>

	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_movie_reports.php">Reports Movie</a></li>
		  <li class="active">Shows By Time</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Shows By Time</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="g_showbytime">Generate Report</button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->

			<div class="form-container">
				
			<div class="col-md-12">
			
				<div class="col-md-4">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span> From Date: </label>
						<div class="col-sm-8">
							<input type="text" name="r_start_date" id="r_start_date" value="<?php if(isset($_POST['r_start_date'] ) && $_POST['r_start_date'] != ""){echo $_POST['r_start_date'];}?>" class="form-control datetimepicker" required>
						</div>
					</div>
				</div>

				<div class="col-md-4">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span> To: </label>
						<div class="col-sm-8">
							<input type="text" name="r_end_date" id="r_end_date" value="<?php if(isset($_POST['r_end_date'] ) && $_POST['r_end_date'] != ""){echo $_POST['r_end_date'];}?>" class="form-control datetimepicker" required>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

			
			</div><!-- col-md-6 -->

	<div class="col-md-6">
	</div><!-- col-md-6 -->
	 </form>
			<?php 
			$reports = new reports();

			if (isset($_POST['g_showbytime'])) {	
				
				if($_POST['r_start_date']){
					$r_start_date 	= $_POST['r_start_date'];
				} else {
					$r_start_date = NULL;
				}

				if($_POST['r_end_date']){
					$r_end_date 	= $_POST['r_end_date'];
				} else {
					$r_end_date = NULL;
				}

				$results = $reports->get_show_by_time($r_start_date, $r_end_date);
				}
			?>		
		
		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
				<?php 
			if (isset($results)) { 
			// print_f($results);
			?>

			
		
		

			<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					<th>No.</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Screen</th>
					<th>Movie</th>
				</thead>
				<tbody class="searchable">
					<?php 
						$count = 1;
	        			foreach ($results as $key => $value){ ?>
					  <tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $value->showtime_datetime; ?></td>
						<td><?php echo $value->showtime_datetime; ?></td>
						<td><?php echo $value->screen_name; ?></td>
						<td><?php echo $value->movie_title; ?></td>
						
					</tr>  
					<?php
					$count++;
					}
					?>
				</tbody>
			</table>
			<?php }
			?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
			
			</div>
	 
	</div><!-- Container Close -->
<?php require_once 'footer.php'; ?>