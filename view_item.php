<?php require_once 'header.php'; ?>

<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Items</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Films</h3>
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
					<div class="alert alert-danger" role="alert" style="display:none;">Item has sales! </div>
					<a class="pull-right add-button" href="add_item.php">Add Item </a>
				</div>
			</div><!--col-md-12-->
		</div><!--row-->



		<div class="row">
			
			<div class="col-md-12">	
				<?php 
				$item = new item();
				$results = $item->get_items();
				if ($results) {
				?>
				<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table">
					<thead>
					<tr>
						<th>Item Name</th>
						<th>Item Category</th>
						<th>Item Price</th>
						<th>Status</th>
						<th></th>
						<th></th>

						
					</tr>
					</thead>
					<tbody class="searchable">
						<?php 
						foreach($results as $res){
						echo '<tr>';
						echo '<td>'. $res->item_name .'</td>';
						echo '<td>'. $res->item_category .'</td>';
						echo '<td>'. $res->item_default_price.'</td>';
						echo '<td>'. $res->item_status .'</td>';
						echo '<td class="alignCenter"><a class="edit_btn" href="add_item.php?id='.$res->item_id.'">Edit Item</a></td>';
						echo '<td class="alignCenter"><input type="hidden" class="id_to_delete" value="'.$res->item_id.'"><a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img class="img_delete" src="assets/images/delete_icon.png"/></a></td>';
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
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'delete_record_item'}, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".alert").show();
			}
			
		});
	});

</script>