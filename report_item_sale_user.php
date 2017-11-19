<?php require_once 'header.php'; 

$user = new user();
$all_user = $user->get_users();
?>
<?php 
		if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('item_sale_u', $user_capabilities)){	
		

?>
	<div class="container  no-print">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_concession_reports.php">Reports Concession</a></li>
		  <li class="active">Item Sales by User</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Item Sales Details</h3>
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
							<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control date_pp" required>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 t_select" id="showtime_movie_id">	
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
			$reports = new reports();

			if (isset($_POST['g_itemsales'])) {	
				if($_POST['istart_date']){
					$r_start_date1 	= $_POST['istart_date'];
					$r_start_date 	= $reports->_date('Y-m-d H:i:s', $r_start_date1);
				} else {
					$r_start_date = NULL;
				}

				if($_POST['u_id']){
					 $user_id 	= $_POST['u_id'];
				} 
				else {
					$user_id = NULL;
				}
			$results = $reports->get_item_sales_by_user($r_start_date, $user_id);
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
					<th>Item Id</th>
					<th>Item Name</th>
					<th>Qty</th>
					<th>Price</th>
					<th>Sales</th>
				</thead>
				<tbody class="searchable">
					<?php 
						$count = 1;
						$sub_total = 0;
	        			foreach ($results as $key => $value){ ?>
					   <tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $value->con_booking_time; ?></td>
						<td><?php echo $value->item_id; ?></td>
						<td><?php echo $value->item_name; ?></td>
						<td><?php echo $qty = $value->qty; ?></td>
						<td><?php echo $pri = $value->con_booking_price; ?></td>
						<td><?php echo $total = $value->amount; ?></td>
						
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

<?php if (isset($results)) { ?>
	<div class="voucher printPirnter" style="visibility:hidden;">	
	
		<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
					 
					<thead>
					
					<tr> 
					<th colspan='5'  style="text-align:center;"><strong>Item Sale by User</strong></th>
					</tr> 					
					
					<tr> 
					<th colspan='3'  style="text-align:center;" ><strong>Report Time</strong></th>
					<th colspan='2'  style="text-align:center;" ><strong><?php echo date("Y-m-d h:i"); ?></strong></th>
					</tr> 
					
					
					
					<tr> 
					<td>User</td>
					<td>Item Name</td>
					<td>Qty</td>
					<td>Price</td>
					<td>Sales</td>
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
						foreach ($results as $key => $value){ ?>
					   <tr>
						<td><?php echo $value->user_fname; ?></td>
						<td><?php echo $value->item_name; ?></td>
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