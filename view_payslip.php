<?php require_once 'header.php'; ?>

<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Tickets</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Tickets</h3>
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
					<div class="alert alert-danger" role="alert" style="display:none;"> Ticket type present in showtimes! </div>
					<a class="pull-right add-button"  href="add_payslip.php">Add Pay slip </a>
				</div>
			</div><!--col-md-12-->
		</div><!--row-->


		<div class="row">
			
			<div class="col-md-12">	
				<?php 
				$payslip = new payslip();
				$results = $payslip->get_payslips();
				if ($results) {
				?>
				<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table">
					<thead>
					<tr>
						<th>Pyroll Slip id</th>
						<th>Amount</th>
						<th>Employee</th>
						<th>For the Month </th>
						<th>Status</th>
						<th></th>
						<th></th>

						
					</tr>
					</thead>
					<tbody class="searchable">

						<?php 
						foreach($results as $res){
						echo '<tr>';
						echo '<td>'. $res->payroll_id .'</td>';
						echo '<td>'. $res->payroll_amount .'</td>';
						echo '<td>'. $res->payroll_emp_id .'</td>';
						echo '<td>'. $res->payroll_for_date.'</td>';
						if($res->payroll_status == 0){
							echo '<td> UNPAID </td>';
						}else{
							echo '<td> PAID </td>';
						}
						
						
						echo '<td class="alignCenter"><a class="edit_btn" href="add_payslip.php?id='.$res->payroll_id.'">Edit</a></td>';
						echo '<td class="alignCenter"><input type="hidden" class="id_to_delete" value="'.$res->payroll_id.'"><a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img class="img_delete" src="assets/images/delete_icon.png"/></a></td>';
						echo '</tr>';
						}
						?>
						</tbody>
				</table>
				<?php
				}else{
					echo 'Error';
				} 
				?>
			</div>
		</div><!-- Row Close -->

		<div class="delete_confirm_modal modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      Confirm Delete?
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default btn_yes" data-dismiss="modal">Yes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		    </div>
		  </div>
		</div><!-- Modal -->

	</div><!-- Container Close -->
<?php require_once 'footer.php'; ?>
<script type="text/javascript">
var id_to_delete;

$(".container").on('click', '.img_delete',function() {
	id_to_delete = $(this).parent().parent().find('.id_to_delete').val();
	});

	$(".modal-footer").on('click', '.btn_yes',function() {
		//var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'delete_record_ticket'}, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".alert").show();
			}
			
		});
	});

</script>