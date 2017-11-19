<?php require_once 'header.php'; ?>

<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Payroll</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Payroll</h3>
					<div class="search-btn input-group">
						<input type="text" id="filter" class="form-control search-control" placeholder="Search for...">
							<span class="input-group-btn">
							<button class="btn btn-default search-btn" type="button"><img  src="assets/images/search-icon.png"/></button>
						</span>
					</div><!-- /input-group -->
			 	</div>
		 	</div>
		</div><!--row-->

		<div class="row">
			<div class="col-md-12">
				<div class="form-header-inner">
					
				</div>
			</div><!--col-md-12-->
		</div><!--row-->



		<div class="row">
			
			<div class="col-md-12">	
				<div class="col-md-6"><a href="add_payslip.php" style="display:block"><div class="payslip">Create Pay slip</div></a></div>
				<div class="col-md-6"><a href="view_payslip.php" style="display:block"><div class="payslip">Paid/unpaid Salary</div></a></div>
			</div>
		</div><!-- Row Close -->
	</div><!-- container -->

<?php require_once 'footer.php'; ?>
