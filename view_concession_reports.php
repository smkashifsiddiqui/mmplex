<?php require_once 'header.php'; ?>

	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>
		  <li>Reports</li>
		  <li class="active">Concession Reports</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Concession Reports</h3>
					<div class="search-btn input-group">
						<input type="text" id="filter" class="form-control search-control" placeholder="Search for...">
							<span class="input-group-btn">
							<button class="btn btn-default search-btn" type="button"><img  src="assets/images/search-icon.png"/></button>
						</span>
					</div><!-- /input-group -->
			 	</div>
		 	</div>
		</div><!--row-->

		


			<div class="col-md-12">	
				
				<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="width: 70%;">
					<thead>
					<tr>
						<th><h4 style=" margin: 0;">Reports Name</h4></th>
						<th></th>
					
						

						
					</tr>
					</thead>
					<tbody class="searchable">
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('item_sale_r', $user_capabilities)){	?>
					<tr>
						<td ><strong>Item Sales</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_item_sale.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('single_item_sale_r', $user_capabilities)){	?>
					<tr>
						<td ><strong>Single Item Sales</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_single_item_sale.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('item_sale_u', $user_capabilities)){	?>
					<tr>
						<td ><strong>Single Item Sales by User</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_item_sale_user.php">View</a></td>
						
					</tr>
					<?php } ?>

					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('package_sale', $user_capabilities)){	?>
					<tr>
						<td><strong>Package Sales</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_package_sale.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('single_package_sale', $user_capabilities)){	?>
					<tr>
						<td><strong>Single Package Sales</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_single_package_sale.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('package_sale_u', $user_capabilities)){	?>
					<tr>
						<td><strong>Package Sales by User</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_package_sale_user.php">View</a></td>
						
					</tr>
					<?php } ?>
					
					
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('con_can_r', $user_capabilities)){	?>
					<tr>
						<td><strong>Concession Cancellation by Day</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_concession_cancellation.php">View</a></td>
						
					</tr>
					<?php } ?>
					<!--
					<tr>
						<td><strong>Concession Sale by single User</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_cash_by_user_concession_sale.php">View</a></td>
						
					</tr>
					-->
					
					<?php if($_SESSION['user']->capabilities != 'null'){
							$user_capabilities = $_SESSION['user']->capabilities;
							$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
						
						
						}else{$user_capabilities = array('empty'); }

						if(in_array('con_sale_u', $user_capabilities)){	?>
					<tr>
						<td><strong>Concession Sale by all User</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_cash_by_all_user_concession_sale.php">View</a></td>
						
					</tr>
					<?php } ?>

				

				</table>
				</tbody>
				
			</div>
		</div><!-- Row Close -->
	</div><!-- Container Close -->


</div><!-- container -->

<?php require_once 'footer.php'; ?>
