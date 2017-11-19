<?php require_once 'header.php'; ?>

	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Profit Or Loss</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post">
	<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Profit Or Loss</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="profit_loss">Generate Report</button>
					 		
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
							<input type="text" name="r_start_date" id="r_start_date" value="<?php if(isset($_POST['r_start_date'] ) && $_POST['r_start_date'] != ""){echo $_POST['r_start_date'];}?>" class="form-control date_p1" required>
						</div>
					</div>
				</div>

				<div class="col-md-4">	
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><span>*</span> To: </label>
						<div class="col-sm-8">
							<input type="text" name="r_end_date" id="r_end_date" value="<?php if(isset($_POST['r_end_date'] ) && $_POST['r_end_date'] != ""){echo $_POST['r_end_date'];}?>" class="form-control date_p1" required>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

			
			</div><!-- col-md-6 -->

	<div class="col-md-6">
	</div><!-- col-md-6 -->
	 </form>
			<?php 
			$profit_n_loss = new profit_n_loss();

			if (isset($_POST['profit_loss'])) {	
				
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

				$con_total = $profit_n_loss->concession_total($r_start_date,$r_end_date);
				//print_f($con_total->total_amount);
				
				$exp_total = $profit_n_loss->expense_total($r_start_date,$r_end_date);
				//print_f($exp_total->total_amount);
				
				$pay_total = $profit_n_loss->payroll_total($r_start_date,$r_end_date);
				//print_f($pay_total->total_amount);
				
				$ticket_total = $profit_n_loss->get_shows_sales($r_start_date,$r_end_date);
				$total_amount = ($con_total->total_amount + $ticket_total->perday_sale) - ($exp_total->total_amount + $pay_total->total_amount);
			
				}
				
				
			?>		
		
		<div class="col-md-12">
		<div class="the-box full no-border">
			<div class="table-responsive">
				<?php 
			if (isset($_POST['profit_loss'])) { 
			// print_f($results);
			?>
				<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
				<thead>
					
					<th>Particular</th>
					<th>Amount</th>
				</thead>
				<tbody class="searchable">
					<?php 
						
	        		?>
						 <tr><td>Concession Sales</td>	
						 <td style=" padding-left: 15px!important;"><?php echo $con_total->total_amount; ?></td></tr>
						 <tr><td>Ticket sales</td>	
						 <td><?php echo '+ '.$ticket_total->perday_sale; ?></td></tr>
						 <tr><td>Expenses</td>	
						 <td><?php echo '- '.$exp_total->total_amount; ?></td></tr>
						 <tr><td>Salary Expense</td>	
						 <td><?php echo '- '.$pay_total->total_amount; ?></td></tr>
						 <tr><th>Total</th>
						 <th style="padding-left: 20px!important;"><?php echo $total_amount; ?></th></tr>  
					<?php
					
				
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