<?php require_once 'header.php'; 

$package = new package();
$all_package = $package->get_packages();
?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('single_package_sale', $user_capabilities)){	
		

?>
	<div class="container no-print">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_concession_reports.php">Reports</a></li>
		  <li class="active">Single Package Sales</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Single Package Sales Details</h3>
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
						<label for="" class="col-sm-4 control-label"><span>*</span> Date: </label>
						<div class="col-sm-8">
							<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control date_pp" required>
						</div>
					</div>
				</div>

				<div class="col-md-4">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span> Package id: </label>
						<div class="col-sm-8">
							<select  name="item"  class="form-control" >
								<option value=""  selected disabled >Select Package</option>
								<?php 
								foreach ($all_package as $value){ ?>

									<option value="<?php echo $value->package_id; ?>" <?php if(isset($_POST['item'] ) && $_POST['item'] == $value->package_id){echo 'selected=selected';}?>><?php echo $value->package_name; ?></option>
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

			if (isset($_POST['g_itemsales'])) {	
				
			if($_POST['istart_date']){
					$r_start_date1 	= $_POST['istart_date'];
					$r_start_date 	= $reports->_date('Y-m-d', $r_start_date1);
				} else {
					$r_start_date = NULL;
				}

				if($_POST['item']){
					$item 	= $_POST['item'];
				} else {
					$item = NULL;
				}

				$results = $reports->get_package_sales_by_id($r_start_date, $item);
				}
			?>		
		
		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
				<?php 
			if (isset($results)) { 
			
			//print_f($results);
			//die();
			
			?>

			
		
		

			<table border="1" cellpadding="0" cellspacing="0" id="example" class="no-print table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					
					<tr> 
					<th style=" font-size: 14px;"><strong>Report Day :</strong></th>
					<th style=" font-size: 14px;"><strong><?php echo $r_start_date; ?></strong></th>
					<th style=" font-size: 14px;"><strong>Current time :</strong></th>
					<th style=" font-size: 14px;"><strong><?php echo $current_date_time; ?></strong></th>
					</tr> 
					
					
					
					<tr> 
					<td> Id</td>
					<td> Name</td>
					<td>Qty</td>
					<td>Price</td>
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
						foreach ($results as $key => $value){ ?>
					   <tr>
						
						
						<td><?php echo $value->package_id; ?></td>
						<td><?php echo $value->package_name; ?></td>
						<td><?php echo $value->qty; ?></td>
						<td><?php echo $value->amount; ?></td>
						
						<tr> 
						
						
						<th></th>
						<th></th>
						<th style=" font-size: 14px;"><strong>Total</strong></th>
						<th style=" font-size: 14px;"><strong><?php echo $value->amount; ?></strong></th>
					</tr> 
					</tr>   
					<?php
					
					
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
	




<?php if (isset($results)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">	
	
		<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
					 
					<thead>
					
<tr> 
					<th colspan='4'  style="text-align:center;"><strong>Package Single Sale</strong></th>
					</tr> 					
					
					<tr> 
					<th colspan='2'  style="text-align:center;" ><strong>Report Day : <?php echo $r_start_date1; ?></strong></th>
					<th colspan='2'  style="text-align:center;" ><strong><?php echo date("Y-m-d h:i"); ?></strong></th>
					</tr> 
					
					
					<tr> 
					<td>Package Id</td>
					<td>Package Name</td>
					<td>Qty</td>
					<td>Price</td>
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
						foreach ($results as $key => $value){ ?>
					   <tr>
						
						
						<td><?php echo $value->package_id; ?></td>
						<td><?php echo $value->package_name; ?></td>
						<td><?php echo $value->qty; ?></td>
						<td><?php echo $value->amount; ?></td>
						
					</tr>   
					<?php
					
					
					}
					?>
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
<?php require_once 'footer.php'; ?>