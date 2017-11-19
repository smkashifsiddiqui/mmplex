<?php require_once 'header.php'; ?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('package_sale', $user_capabilities)){	
		

?>
	<div class="container no-print">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_concession_reports.php">Reports Concession</a></li>
		  <li class="active">Package Sales</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Package Sales Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" onclick="window.print()" name="">Print</button>
					 		<button type="submit" class="btn submitBtn save-button" name="g_itemsales">Generate Report</button>
					 		
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
							<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control  date_pp" required>
						</div>
					</div>
				</div>
				<!--

				<div class="col-md-4">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span> To: </label>
						<div class="col-sm-8">
							<input type="text" name="iend_date" id="" value="<?php if(isset($_POST['iend_date'] ) && $_POST['iend_date'] != ""){echo $_POST['iend_date'];}?>" class="form-control datetimepicker" required>
						</div>
					</div>
				</div>
				-->
				<div class="clear"></div>

			
			</div><!-- col-md-6 -->

	<div class="col-md-6">
	</div><!-- col-md-6 -->
	 </form>
			<?php 
			$reports = new reports();

			if (isset($_POST['g_itemsales'])) {	
				
			if($_POST['istart_date']){
					$r_start_date1 	= $_POST['istart_date'];
					$r_start_date 	= $reports->_date('Y-m-d H:i:s', $r_start_date1);
				} else {
					$r_start_date = NULL;
				}

				$results = $reports->get_package_sales($r_start_date);
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
					<th>Package Id</th>
					<th>Package Name</th>
					<th>Qty</th>
					<th>Price</th>
					<th>Sales</th>
				</thead>
				<tbody class="searchable">
					<?php 
						$count = 1;
						$counter = 0;
						$sub_total = 0;
	        			foreach ($results as $key => $value){ ?>
					   <tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $value->con_booking_time; ?></td>
						<td><?php echo $value->package_id; ?></td>
						<td>

						<?php echo $value->package_name; 
						$current_i = $value->package_item_name;
					    $current_i = (!empty($current_i))? json_decode($current_i) : array();

					    $current_i_q = $value->package_item_qty;
					    $current_i_q = (!empty($current_i_q))? json_decode($current_i_q) : array();

					    foreach ($current_i as $current_i_values){

								$p_item_detail = $reports->get_item_details($current_i_values);
								echo '<br/><span style=" font-size: 10px;">'.$p_item_detail[0]->item_name.' X '.$current_i_q[$counter].'</span>';
						   	
							}
						?>

						</td>
						<td><?php echo $qty = $value->qty; ?></td>
						<td><?php echo $pri = $value->con_booking_price; ?></td>
						<td><?php echo $total = $value->amount; ?></td>
						
					</tr>   
					<?php
					$count++;
					$sub_total += $total;
					}
					?>

					<tr> 
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style=" font-size: 14px;"><strong>Total</strong></td>
						<td style=" font-size: 14px;"><strong><?php echo $sub_total; ?></strong></td>
					</tr> 
				</tbody>
			</table>
			<?php }
			?>
			</div><!-- /.table-responsive -->
		</div>	
		</div><!-- /col-md-12 -->
			
			
	 
	</div><!-- Container Close -->
<?php require_once 'footer.php'; ?>

<?php if (isset($results)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">	
	
		<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
					 
					<thead>
					
					<tr> 
					<th colspan='4'  style="text-align:center;"><strong>Package Sale</strong></th>
					</tr> 					
					
					<tr> 
					<th colspan='2'  style="text-align:center;" ><strong>Report date : </strong><strong><?php echo $r_start_date1; ?></strong></th>
					<th colspan='2'  style="text-align:center;" ><strong>Current time : </strong><strong><?php echo $current_date_time; ?></strong></th>
					</tr> 
					
					
					
					<tr> 
					<td>Package Name</td>
					<td>Qty</td>
					<td>Price</td>
					<td>Sales</td>
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
						foreach ($results as $key => $value){ ?>
					   <tr>
						
						
						<td><?php echo $value->package_name; ?></td>
						<td><?php echo $qty = $value->qty; ?></td>
						<td><?php echo $pri = $value->con_booking_price; ?></td>
						<td><?php echo $total = $value->amount; ?></td>
						
					</tr>   
					<?php
					
					
					}
					?>
<tr> 
						<td></td>
						<td></td>
						<td style=" font-size: 14px;"><strong>Total</strong></td>
						<td style=" font-size: 14px;"><strong><?php echo $sub_total; ?></strong></td>
					</tr> 
				</tbody>

				

			</table>
				</div>

	<?php } ?>
	
	<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
