<?php require_once 'header.php'; ?>

	<div class="container no-print">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_ticket_reports.php">Reports</a></li>
		  <li class="active">Item Sales</li>
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
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
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
							<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control datetimepicker" required>
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

				
				$results = $reports->get_cancel_tickets($r_start_date);
				}
			?>		
		
		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
				<?php 
			if (isset($results)) { 
			
			print_f($results);
			die();
			
			?>

			
		
		

			<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					
					<tr> 
					<th style=" font-size: 14px;"><strong></strong></th>
					<th style=" font-size: 14px;"><strong></strong></th>
					<th style=" font-size: 14px;"><strong>report time</strong></th>
					<th style=" font-size: 14px;"><strong><?php echo date("Y-m-d h:i"); ?></strong></th>
					</tr> 
					
					
					
					<tr> 
					<td>Item Id</td>
					<td>Item Name</td>
					<td>Qty</td>
					<td>Price</td>
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
					
						foreach ($results as $key => $value){ ?>
					   <tr>
						
						
						<td><?php echo $value->item_id; ?></td>
						<td><?php echo $value->item_name; ?></td>
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
	
		<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:330px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
					 
					<thead>
					
					<tr> 
					<th style="text-align:center; "><strong>Transaction time</strong></th>
					<th style="text-align:center;  "><strong><?php echo $r_start_date; ?></strong></th>
					<th style="text-align:center;  "><strong>report time</strong></th>
					<th style="text-align:center;  "><strong><?php echo date("Y-m-d"); ?></strong></th>
					</tr> 
					
					
					
					<tr> 
					<td>Item Id</td>
					<td>Item Name</td>
					<td>Qty</td>
					<td>Price</td>
					</tr> 
					
					</thead>
					
				
				<tbody class="searchable">
					
						
	        			<?php 
						foreach ($results as $key => $value){ ?>
					   <tr>
						
						
						<td><?php echo $value->item_id; ?></td>
						<td><?php echo $value->item_name; ?></td>
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
<?php require_once 'footer.php'; ?>