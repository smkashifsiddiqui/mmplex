<?php require_once 'header-dashboard.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('book_adv_ticket', $user_capabilities)){	
		
	
?>
<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="advance_booking.php">Home</a></li>
		  <li class="active">View Bookings</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>View Bookings</h3>
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
					<a class="pull-right add-button" href="advance_booking.php">Add Advance Bookings </a>
				</div>
			</div><!--col-md-12-->
		</div><!--row-->



		<div class="row">
			
			<div class="col-md-12">	
				<?php 
				$confirm_booking = new confirm_booking();
				$results = $confirm_booking->get_adv_bookings();
				if ($results) {
				?>
				<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="font-size:14px;">
					<thead>
					<tr>
						<th>Customer Name</th>
						<th>Phone Number</th>
						<th>Movie</th>
						<th>Showtime</th>
						<th>Booking Date</th>
						<th>Confirmed</th>
						<th></th>
						<th></th>

						
					</tr>
					</thead>
					<tbody class="searchable">
						<?php 
						foreach($results as $res){
							//print_f($res);
						echo '<tr>';
						echo '<td>'. $res->advance_b_customer_name .'</td>';
						echo '<td>'. $res->advance_b_phone .'</td>';
						echo '<td>'. $res->movie_title.'</td>';
						echo '<td>'.$confirm_booking->_date('d/M/y H:i:s', $res->showtime_datetime).'</td>';
						echo '<td>'.$confirm_booking->_date('d/M/y H:i:s', $res->advance_ts).'</td>';
						echo '<td>'. $res->advance_b_status .'</td>';
						echo '<td class="alignCenter"><a class="edit_btn" href="confirm_adv_booking.php?id='.$res->advance_b_id.'">Details</a></td>';
						echo '<td class="alignCenter"><input type="hidden" class="id_to_delete" value="'.$res->advance_b_id.'"><a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img class="img_delete" src="assets/images/delete_icon.png"/></a></td>';
						echo '</tr>';
						}
						?>
					</tbody>
				</table>
				<?php
				}else{
					echo '';
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
		   
		    	<input type="hidden" class="id_to_delete" value="<?php echo $_GET['id']; ?>" />
		        <button type="button"  class="btn btn-default btn_yes" data-dismiss="modal" >Yes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		 
		    </div>
		  </div>
		</div><!-- Modal -->

	</div><!-- Container Close -->

	<?php require_once 'footer.php'; ?>
<script type="text/javascript">

	$(".modal-footer").on('click', '.btn_yes',function() {
		var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'del_record'}, function(data) {
			
			location.reload();
		});
	});

</script>
 <?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
     require_once 'footer.php'; 
	}
?> 