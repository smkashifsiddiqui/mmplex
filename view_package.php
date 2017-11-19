<?php require_once 'header.php'; ?>

<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Packages</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Packages</h3>
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
					<div class="alert alert-danger" role="alert" style="display:none;">Package has sales! </div>
					<a class="pull-right add-button" href="add_package.php">Add Package </a>
				</div>
			</div><!--col-md-12-->
		</div><!--row-->

		<div class="row">
			
			<div class="col-md-12">	
				<?php 
				$package = new package();
				$results = $package->get_packages();
				if ($results) {
				?>
				<table border="1" cellpadding="0" id="example" cellspacing="0" class="table table-hover tableView admin-table">
					<thead>
					<tr>
						<th>Package Name</th>
						<th>Price</th>
						<th>Status</th>
						<th></th>
						<th></th>

						
					</tr>
					</thead>
					<tbody class="searchable">
						<?php 
						foreach($results as $res){
						echo '<tr>';
						echo '<td>'. $res->package_name .'</td>';
						echo '<td>'. $res->package_price.'</td>';
						echo '<td>'. $res->package_status .'</td>';
						echo '<td class="alignCenter"><a class="edit_btn" href="add_package.php?id='.$res->package_id.'">Edit Package</a></td>';
						echo '<td class="alignCenter"><input type="hidden" class="id_to_delete" value="'.$res->package_id.'"><a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img class="img_delete" src="assets/images/delete_icon.png"/></a></td>';
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
</div><!-- container -->

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
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'delete_record_package'}, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".alert").show();
			}
			
		});
	});

</script>