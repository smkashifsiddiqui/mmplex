<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_concession', $user_capabilities)){	
		
	
?>


<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Add Logo</li>
		</ol>
	</div><!--row-->
	
<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Logo image</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_logo">Submit </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
			<?php 
			
				$slideshow = new slideshow();
				$slideshow_result = $slideshow->get_slideshow();
				
				
				if (isset($_POST['add_logo'])) {		
					// Update old record
						
					   $slideshow_result = $slideshow->update_slideshow($_FILES);
						
						
					
					if ($slideshow_result) {
						echo '<div class="alert alert-success" role="alert"> Added timings Sucessfully </div>';
						$slideshow_result = $slideshow->get_slideshow();
						
					}else{
						echo '<div class="alert alert-danger" role="alert"> Error </div>';
					}
					
					
				}
				
				if (isset($_POST['delete_logo'])) {		
					// Update old record
						
					   $slideshow_result = $slideshow->delete_slideshow($_FILES);
						
						
					
					if ($slideshow_result) {
						echo '<div class="alert alert-success" role="alert"> Added timings Sucessfully </div>';
						$slideshow_result = $slideshow->get_slideshow();
						
					}else{
						echo '<div class="alert alert-danger" role="alert"> Error </div>';
					}
					
					
				}
				?>
				
				
				<div class="form-container">
				<div class="col-md-6">
					<div class="col-md-12 item_img">
					  <div class="form-group">
						<label for="movie_synopsis" class="col-sm-4 control-label">Add Image: </label>
						<div class="col-sm-8">
							<input type="file" name="logo" class="form-control" value="" style="width:100%;height: 33px;">
							
						</div>
					 </div>					       
					</div>
				</div><!-- col-md-6 -->
				
				<div class="col-md-6">
					<div class="col-md-12 item_img">
					
					</div>
				</div><!-- col-md-6 -->
				
			</div><!-- form-container -->
			
			<?php	foreach($slideshow_result as $key => $res){ ?>
					
			<div class="form-container">
				<div class="col-md-3">
					<div class="col-md-12 item_img">
					    <input type="hidden" class="id_to_delete" value="<?php echo $res->slide_id; ?>"><a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><span class="img_delete btn submitBtn cancel-button" name="delete_logo" style="width:100px;">Delete</span></a>
						
						</div>
				</div><!-- col-md-6 -->
				
				<div class="col-md-6">
					<div class="col-md-12 item_img">
					  <img src="assets/images/uploads/<?php echo $res->slide_img; ?>"/>			       
					</div>
				</div><!-- col-md-6 -->
				
			</div><!-- form-container -->
					
			<?php	} ?>
			
		 </form>
	  
	</div><!-- Container Close -->
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
		
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>

<?php require_once 'footer.php'; ?>
<script type="text/javascript">
var id_to_delete;

$(".container").on('click', '.img_delete',function() {
	id_to_delete = $(this).parent().parent().find('.id_to_delete').val();
	});

	$(".modal-footer").on('click', '.btn_yes',function() {
		//var id_to_delete = $('.id_to_delete').val();
		console.log(id_to_delete);
		$.post('ajax.php', {'to_delete': id_to_delete, 'action': 'delete_slide'}, function(data) {
			console.log(data);
			if(data == true){
				location.reload();
			}else{
				
				$(".alert").show();
			}
			
		});
	});

</script>