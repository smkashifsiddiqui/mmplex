<?php require_once 'header.php'; ?>

	<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li>Reports</li>
		  <li class="active">Movie Reports</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Movie Reports</h3>
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

					<!--<tr>
						<td ><strong>Film Rental</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_film_rental.php">View</a></td>
						
					</tr>-->

					<tr>
						<td><strong>Distributors By film</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_film_by_distributer.php">View</a></td>
						
					</tr>

					<tr>
						<td><strong>Shows by Time</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="report_show_by_time.php">View</a></td>
					</tr>
					
					<tr>
						<td><strong>Weekly Movie Report</strong></td>
						<td class="alignCenter"><a class="edit_btn" href="weekly_movie_report.php">View</a></td>
						
					</tr>

				</table>
				</tbody>
				
			</div>
		</div><!-- Row Close -->
	</div><!-- Container Close -->


</div><!-- container -->

<?php require_once 'footer.php'; ?>