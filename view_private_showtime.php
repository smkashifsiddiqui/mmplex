<?php require_once 'header.php'; ?>

<div class="container">
<div class="row">
		<div class="col-md-8">
			<ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			  <li class="active">Show times</li>
			</ol>
		</div>

		<div class="col-md-4 form-horizontal" style="position:relative;">
		<div class="alert alert-danger" id="invalid_time" style="display:none;position:absolute;" role="alert">Invalid Time!</div>
			<label for="itemname" class="col-sm-3 control-label" style=" padding-top: 15px;">Go Date: </label>
				<div class="col-sm-7">
					<div class="input-group date" style="margin-top: 10px; margin-bottom: 10px;">
				        <input type="date" id="animateDate" class="form-control">
				        <span class="input-group-addon" id="go" onclick="go()">
				            <span class="glyphicon glyphicon-calendar"></span>
				        </span>
				    </div>
				</div>
		</div>

	</div><!--row-->


<div class="row">
		<div class="col-md-12 col-sm-12 timeline">
			<div id="mytimeline"></div>
		</div>
</div><!-- row -->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Show times</h3>
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
					<div class="alert alert-danger err" role="alert" style="display:none;">Sorry Showtime has Vouchers Booked! </div>
					<a class="pull-right add-button" href="add_private_showtime.php">Add Show time </a>
				</div>
			</div><!--col-md-12-->
		</div><!--row-->

	<div class="row">
			
			<div class="col-md-12">	
				<?php 
				$showtime = new showtime();
				$results = $showtime->get_private_showtimes();
				if ($results) {
				?>
				<table border="1" cellpadding="0" id="example" cellspacing="0" class="table table-hover tableView admin-table">
					<thead>
					<tr>
						<th>Show Time Movie</th>
						<th>Show Screen</th>
						<th>Show Timings</th>
						<th>Status</th>
						<th></th>
						<th></th>

						
					</tr>
					</thead>
					<tbody class="searchable">
						<?php 
						foreach($results as $res){
						echo '<tr>';
						echo '<td>'. $res->movie_title .'</td>';
						echo '<td>'. $res->screen_name .'</td>';
						echo '<td>'. date('d-m-y h:i A', strtotime($res->showtime_datetime)) .'</td>';
						echo '<td>'. $res->showtime_status .'</td>';

						echo '<td class="alignCenter"><a class="edit_btn" href="add_private_showtime.php?id='.$res->showtime_id.'">Edit</a></td>';
						echo '<td class="alignCenter"><input type="hidden" class="id_to_delete" value="'.$res->showtime_id.'"><a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img class="img_delete" src="assets/images/delete_icon.png"/></a></td>';
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

		
		
	</div><!-- Container Close -->
<div class="delete_confirm_modal modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      Confirm Delete?
		    </div>
		    <div class="modal-footer">
 				<button type="button"  class="btn btn-default btn_yes" data-dismiss="modal" >Yes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		 
		    </div>
		  </div>
		</div><!-- Modal -->	
<?php require_once 'include/short_scripts/private_showtime_script.php'; ?>
<?php require_once 'footer.php'; ?>
<script type="text/javascript">
var id_to_delete;

$(".container").on('click', '.img_delete',function() {
	id_to_delete = $(this).parent().parent().find('.id_to_delete').val();
	});

	$(".modal-footer").on('click', '.btn_yes',function() {
		//var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'delete_record_showtime_private'}, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".err").show();
			}
			
		});
	});

</script>