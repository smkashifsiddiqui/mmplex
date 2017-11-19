<?php require_once 'header.php'; ?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('cash_by_user', $user_capabilities)){	
		

?>
<?php 
	$reports = new reports();

	$distributer = new distributer();
	$all_distributer = $distributer->get_distributers();
			
	$movie = new movie();
	$all_movie = $movie->get_movies();
	
	$user = new user();
	$all_user = $user->get_users();

	
	$showtime = new showtime();
	$all_showtime = $showtime->get_all_showtimes();

	?>
	<div class="container no-print">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_ticket_reports.php">Reports Ticket</a></li>
		  <li class="active">Cash in hand</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Cash in hand</h3>
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
				
				<div class="col-md-12 t_select" id="showtime_movie_id">	
					<div class="form-group">
						<label for="showtime_movie_id"  class="col-sm-4 control-label"><span>* </span> Select User: </label>
						<div class="col-sm-8">
							<select  name="u_id"  class="form-control" >
								<option value=""  selected disabled >Select User</option>
								<?php 
								foreach ($all_user as $value){ ?>

									<option value="<?php echo $value->user_id; ?>" <?php if(isset($_POST['u_id'] ) && $_POST['u_id'] == $value->user_id){echo 'selected=selected';}?>><?php echo $value->user_name; ?></option>
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
				
			if($_POST['istart_date']){
					 $s_date1 	= $_POST['istart_date'];
				     $s_date = $reports->_date('Y-m-d', $s_date1);	

				} 
				else {
					$s_date = NULL;
				}
				
				if($_POST['u_id']){
					 $user 	= $_POST['u_id'];
				  } 
				else {
					$user = NULL;
				}
				
			
			
			$results = $reports->get_cash_in_hand_by_user($s_date, $user);
			/*echo "<pre>";
				print_f($results);
				echo "</pre>";
			die();*/
				}
			?>		
		
		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
			  <?php
					
					if (isset($results)) { ?>
					
					<table border="1" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
					 
					<tr>
						
						<th>Users</th>
						<th>Screen</th>
						<th>Total tickets</th>
						<th>Cash</th>
					</tr>
					

					<?php 
						
						$sub_total = 0;
	        			foreach ($results as $key => $value){ ?>
					   <tr>
						
						<td><?php echo $value->user_fname; ?></td>
						   <td><?php echo $value->screen_name; ?></td>
						<td><?php echo $value->tickets_qty; ?></td>
						<td><?php echo $total = $value->cash; ?></td>
						
						
					</tr>   
					<?php
					
					$sub_total += $total;
					}
					?>
				
				</table>
				
				<h3 style="text-align: right;margin-right: 55px;">Total Cash:  <?php echo $sub_total; ?></h3>
				<?php }// end result?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
			
			
	 
	</div><!-- Container Close -->
	</div><!-- Container Close -->
	
<?php if (isset($results)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">
	<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
	<tr> 
		<th style="width:140px;text-align:center;"><strong>Report day</strong></th>
		<th style="width:140px;text-align:center;"><strong><?php echo $s_date1; ?></strong></th>
		
		<th style="width:140px;text-align:center;"><strong>Current time :</strong></th>
		<th style="width:140px;text-align:center;"><strong><?php echo $current_date_time; ?></strong></th>
	</tr>
	
	
	</table>
	<div class="border" style="margin-top:5px;"></div>				
	<div class="table-responsive">
			
					<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
					 
					<tr>
						
						<th style="text-align:Center;">Users</th>
						<th style="text-align:Center;">Screen</th>
						<th style="text-align:Center;">Total tickets</th>
						<th style="text-align:Center;">Cash</th>
					</tr>
					

					<?php 
						
						$sub_total = 0;
	        			foreach ($results as $key => $value){ ?>
					   <tr>
						
						<td><?php echo $value->user_fname; ?></td>
					   	<td><?php echo $value->screen_name; ?></td>
						<td><?php echo $value->tickets_qty; ?></td>
						<td><?php echo $total = $value->cash; ?></td>
						
						
					</tr>   
					<?php
					
					$sub_total += $total;
					}
					?>
				
				</table>
				</div>
	<div class="voucher printPirnter border" style="margin-top:5px;"></div>	
	
	<table class="voucher printPirnter border" cellpadding="1" cellspacing="1" style="width:700px;text-align:center;margin:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
		<tr>
			<th style="width:350px;text-align:center;">Total Cash: </th>
			<th style="width:350px;text-align:center;"><?php echo $sub_total;?></th>
		</tr>
	</table>
	</div>
	<?php } ?>
	<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>