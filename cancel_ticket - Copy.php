<?php 
require_once 'header-dashboard.php'; 
if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_ticket', $user_capabilities)){
	$booking = new booking();?>

<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="booking.php">Home</a></li>
		  <li class="active">Cancel Tickets</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Cancel Tickets</h3>
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
					<div class="alert alert-danger" role="alert" style="display:none;"> Distributers has movies assigned! </div>
					<a class="pull-right add-button" href="add_distributer.php">Add Distributer </a>
				</div>
			</div><!--col-md-12-->
		</div><!--row-->


		<div class="row">
			
			<div class="col-md-12">	
				<?php 
				$booking = new booking();
				$results = $booking->get_printed_tic();
				if ($results) {
				
				?>
				<table border="1" id="example" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
					<thead>
					<tr>
						<th>Ticket Id</th>
						<th>Movie</th>
						<th>Seat id</th>
						<th>Printed date</th>
						<th></th>
					</tr>
					</thead>

					<tbody class="searchable">
						<?php 
						foreach($results as $res){
							
							 //echo $today_date =  strtotime(date("d-m-y")); 
						$today_date =  strtotime(date("Y-m-d")).'<br/>';
								
							
						$ticket_date = strtotime($res->printed_ticket_showtime);
						if($ticket_date == $today_date || $ticket_date > $today_date){
						//print_f($res);
						//die();
							echo '<tr>';
							echo '<td>'. $res->printed_ticket_unique_id .'</td>';
							echo '<td>'. $res->movie_title .'</td>';
							echo '<td>'. $res->printed_ticket_seat_id .'</td>';
							echo '<td>'. $res->printed_ticket_terminal_ts .'</td>';
							echo '<td class="alignCenter"><a href="#" class="edit_btn" data-toggle="modal" data-target=".delete_confirm_modal">Cancel</a></td>';
							echo '</tr>';
						}
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
			 <div class="col-md-12">	
					<div class="form-group">
						<label for="item_name" class="col-sm-4 control-label"><span>* </span>Item Name: </label>
						<div class="col-sm-8">
							<input type="text" name="item_name" id="item_name" value="<?php echo (isset($ID))? $item_result->item_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
		      Confirm Delete?
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default btn_yes" >Yes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		    </div>
		  </div>
		</div><!-- Modal -->
		
		<div class="myModal modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
			 <div class="col-md-12">	
					<div class="form-group">
						<label for="item_name" class="col-sm-4 control-label"><span>* </span>User: </label>
						<div class="col-sm-8">
							<input type="text" name="item_name" id="item_name" style="margin-bottom:10px;" value="<?php echo (isset($ID))? $item_result->item_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				 <br/>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_name" class="col-sm-4 control-label"><span>* </span>Pass: </label>
						<div class="col-sm-8">
							<input type="text" name="item_name" id="item_name" style="margin-bottom:10px;" value="<?php echo (isset($ID))? $item_result->item_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
		     <br/>
		    </div>
		    <div class="modal-footer" style="clear:both;">
		        <button type="button" id="check_admin" class="btn btn-default btn_yes" >Yes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		    </div>
		  </div>
		</div><!-- Modal -->
</div><!-- container -->
<?php require_once 'footer.php'; ?>
<script type="text/javascript">

$(window).load(function(){
        $('.myModal').modal('show');
    });
	
var id_to_delete;

$(".container").on('click', '.img_delete',function() {
	id_to_delete = $(this).parent().parent().find('.id_to_delete').val();
	});

	$(".modal-footer").on('click', '.btn_yes',function() {
		//var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'delete_record_distributer'}, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".alert").show();
			}
			
		});
	});
	
	
	$(".modal-footer").on('click', '.btn_yes',function() {
		//var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'delete_record_distributer'}, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".alert").show();
			}
			
		});
	});

</script>

<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
   
	}
?>