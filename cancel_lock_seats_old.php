<?php 
require_once 'header-dashboard.php'; 
if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('cancel_lock_seats', $user_capabilities)){
	$booking = new booking();?>
	<link href="assets/css/keyboard.css" rel="stylesheet">
	<link href="assets/css/jquery-ui.min.css" rel="stylesheet">
	<script src="assets/js/jquery-1.11.1.js"></script>
<div class="container">

<div class="row">
		<ol class="breadcrumb">
		  <li><a href="booking.php">Home</a></li>
		  <li class="active">Cancel Lock seats</li>
		</ol>
	</div><!--row-->

<div class="row form-header">
			<div class="col-md-12">
				<div class="form-header-inner">
					<h3>Cancel Lock seats</h3>
					<div class="search-btn input-group">
						<input type="text" id="filter" class="form-control search-control" placeholder="Search for...">
							<span class="input-group-btn">
							<button class="btn btn-default search-btn" type="button"><img  src="assets/images/search-icon.png"/></button>
						</span>
					</div><!-- /input-group -->
			 	</div>
		 	</div>
		</div><!--row-->

	  <div class="row userLoginPanel">
		<div class="col-md-6 col-md-offset-3">
			 <div class="row userLoginPanel">
		 <div class="row userLoginPanel">
		<div class="col-md-6 col-md-offset-3">
			<form class="form-signin" action="" method="post" style="max-width:350px;">
		    <h2 class="form-signin-heading" style="text-align: center;font-size: 21px; text-transform: uppercase;font-weight: bold; font-family: monospace;">Confirm login</h2>
		    <label for="username" class="sr-only">Email address</label>
			<p id="username-opener" style="cursor:pointer;font-size: 12px;margin-bottom: 5px;"><img  style="margin-right:10px;width: 19px;margin-top: -8px;" class="tooltip-tipsy" title="Click to open the virtual keyboard" src="assets/images/uploads/keyboard.svg">Open keyboard</p>
		    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="" autofocus="" style="margin-bottom: 15px; padding: 5px 12px;height: 40px;background: white;color: black;border: 0;">
		    
			<label for="password" class="sr-only">Password</label>
			<p id="password-opener" style="cursor:pointer;font-size: 12px;margin-bottom: 5px;"><img  style="margin-right:10px;width: 19px;margin-top: -8px;" class="tooltip-tipsy" title="Click to open the virtual keyboard" src="assets/images/uploads/keyboard.svg">Open keyboard</p>
		    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required=""  style="margin-bottom: 15px; padding: 5px 12px;height: 40px;background: white;color: black;border: 0;">
		    <button class="btn btn-lg btn-primary btn-block" type="submit"  name="login" value="Login">	Login</button>
		  </form>
		</div>
	  </div>
	  </div>
		</div>
	  </div>
		
		<?php 
		$cancel_id= '';
		$user = new user();
		if (isset($_POST['login'])) {
			$results = $user->do_login($_POST);	
			if ($results) { 
				$cancel_id = $results->id;
				$cancel_capability = $results->capabilities;
				$cancel_capability = (!empty($cancel_capability))? json_decode($cancel_capability) : array();
			if(in_array('cancel_ticket', $cancel_capability)){
			?>
			
				<style>
					.userLoginPanel { display:none; }
				</style>
				
				<div class="row">
					<div class="col-md-12">	
						<?php 
						$booking = new booking();
						$results = $booking->all_locked_seats();
						
						if ($results) {
							//print_f($results);
							//die();
						?>
						<table border="1" id="example" cellpadding="0" cellspacing="0" class="table table-hover tableView admin-table">
							<thead>
							<tr>
								<th>Seat Name</th>
								<th>Show Time</th>
								<th>Locked time</th>
								<th></th>
							</tr>
							</thead>
							<tbody class="searchable">
								<?php 
								foreach($results as $res){
								
								echo '<tr>';
								echo '<td>'. $res->locked_seat_name .'</td>';
								echo '<td>'. date('d-M-y h:i', strtotime($res->showtime_datetime)).'</td>';
								echo '<td>'. date('d-M-y h:i', strtotime($res->showtime_ts)).'</td>';
								echo '<td class="alignCenter"><input type="hidden" class="id_person" value="'.$cancel_id.'"><input type="hidden" class="id_to_delete" value="'.$res->locked_seat_id.'"><a href="#" class="edit_btn img_delete" data-toggle="modal" data-target=".delete_confirm_modal">Cancel</a></td>';
								echo '</tr>';
									
						}}
								?>
							</tbody>
						</table>
						<?php
						}else{
							echo '<div class="col-sm-12" style="text-align:center;"><div class="alert alert-danger" role="alert" style="margin:auto;width: 260px;clear: both;"> Access denied! </div></div>';
						} 
						?>
					</div>
				</div><!-- Row Close -->
			<?php
			}else{
				echo '<div class="col-sm-12" style="text-align:center;"><div class="alert alert-danger" role="alert" style="margin:auto;width: 260px;clear: both;"> Access denied! </div></div>';
			}
		}
		?>
	</div><!-- Container Close -->

	<div class="delete_confirm_modal modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  Confirm Delete?
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn_yes" >Yes</button>
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
var id_person;

$(".container").on('click', '.img_delete',function() {
	id_to_delete = $(this).parent().parent().find('.id_to_delete').val();
	id_person   = $(this).parent().parent().find('.id_person').val();
	});

	$(".modal-footer").on('click', '.btn_yes',function() {
		//var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete,'pers': id_person, 'action': 'del_loc_ticket'}, function(data) {
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
