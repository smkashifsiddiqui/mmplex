<?php require_once 'header.php'; ?>

	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_movie_reports.php">Reports Movie</a></li>
		  <li class="active">Films by Distributer</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Films by distributers</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="g_filebydist">Generate Report</button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->

			<?php 
				$distributer = new distributer();
				$all_distributer = $distributer->get_distributers();
			?>

	
			<div class="form-container">
				
			<div class="col-md-6">
			
				<div class="col-md-12">	
					<div class="form-group">
						<label for="ticket_class" class="col-sm-4 control-label"><span>*</span> Select Distributer: </label>
						<div class="col-sm-8">
							<select class="form-control" name="distributer_id" required>
								<option value="" selected disabled>Select</option>
								<?php foreach ($all_distributer as $value){ ?>
									<option value="<?php echo $value->dist_id; ?>" <?php if(isset($_POST['distributer_id'] ) && $_POST['distributer_id'] == $value->dist_id){echo 'selected=selected';}?>><?php echo $value->dist_name; ?></option>
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
			$reports = new reports();

			if (isset($_POST['g_filebydist'])) {	
				
				if($_POST['distributer_id']){
					$dist_id 	= $_POST['distributer_id'];
				} else {
					$dist_id = NULL;
				}
				$results = $reports->get_film_by_distributers($dist_id);
				}
			?>		
	
		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
				<?php 
			if (isset($results)) { 
			// print_f($results);
			?>
			<table border="1" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
				<thead>
					<th>No.</th>
					<th>Movie Name</th>
					<th>Contract type</th>
					<th>Contract Start Date</th>
				</thead>
				<tbody>
					<?php 
						$count = 1;
	        			foreach ($results as $key => $value){ ?>
					 <tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $value->movie_title; ?></td>
						<td><?php echo $value->movie_contract_type; ?></td>
						<td><?php echo $value->movie_contract_start_date; ?></td>
						
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