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
		  <li><a href="view_item.php">Item</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Item</li>
		</ol>
	</div><!--row-->

<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Item Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_item"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Item' ?>  </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
		
			<?php 

			$food_category = new food_category();
			$all_food_category = $food_category->get_food_categories();


			$item = new item();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_item'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $item->update_item($_POST, $ID);
				}else{ // Insert new
					$results = $item->insert_item($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added item Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$item_result = $item->get_items($ID);
			}
			?>

	
			<div class="form-container">
				

			<div class="col-md-6">
				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_name" class="col-sm-4 control-label"><span>* </span>Item Name: </label>
						<div class="col-sm-8">
							<input type="text" name="item_name" id="item_name" value="<?php echo (isset($ID))? $item_result->item_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_small_decs" class="col-sm-4 control-label"><span>* </span>Item Description: </label>
						<div class="col-sm-8">
							<input type="text" name="item_small_decs" id="item_small_decs" value="<?php echo (isset($ID))? $item_result->item_small_decs : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				
				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_measuring_unit" class="col-sm-4 control-label"><span>* </span>Measuring Unit	: </label>
						<div class="col-sm-8">
							<select name="item_measuring_unit" class="form-control" required>
							<option value="" selected disabled>select</option>
							<?php foreach($measuring_units as $measuring_units_key => $measuring_units_value){?>
								<option value="<?php echo $measuring_units_key; ?>" <?php (isset($ID))? $selected_unit = $item_result->item_measuring_unit : '';if(isset($ID)){if($measuring_units_key == $selected_unit){echo 'selected=selected';}} ?>><?php echo $measuring_units_value; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="clear"></div>
				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_category" class="col-sm-4 control-label">Item Category: </label>
						<div class="col-sm-8">
							<select name="item_category" class="form-control">
							<option selected disabled>select</option>
							<?php foreach($all_food_category as $value){ ?>
								<option value="<?php echo $value->food_category_id; ?>" <?php (isset($ID))? $selected_category = $item_result->item_category : '';if(isset($ID)){if($value->food_category_id == $selected_category){echo 'selected=selected';}} ?>><?php echo $value->food_category_name; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_default_price" class="col-sm-4 control-label"><span>* </span>Default Price: </label>
						<div class="col-sm-8">
							<input type="text" name="item_default_price" id="item_default_price" value="<?php echo (isset($ID))? $item_result->item_default_price : '' ?>" class="form-control" required >
						</div>
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="item_cost_price" class="col-sm-4 control-label"><span>* </span> Cost Price: </label>
						<div class="col-sm-8">
							<input type="text" name="item_cost_price" id="item_cost_price" value="<?php echo (isset($ID))? $item_result->item_cost_price : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>


	

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="item_img" class="col-sm-4 control-label">Display Order #: </label>
						<div class="col-sm-8">
							<input type="number" name="item_display_order" id="item_display_order" value="<?php echo (isset($ID))? $item_result->item_display_order : '' ?>" class="form-control" >
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="item_img" class="col-sm-4 control-label">Item bg: </label>
						<div class="col-sm-8">
							<select class="form-control" name="item_bg" id="item_bg" style="background-color:<?php echo $item_result->item_bg;?>;" required>
								<option value=""  selected disabled>Select below</option>
								<?php foreach($bg_color as $bg_color_key => $bg_color_value){ ?>
									<option value="<?php echo $bg_color_key; ?>" style="background-color:<?php echo $bg_color_value;?>;" <?php (isset($ID))? $selected_bg_color = $item_result->item_bg : '';if(isset($ID)){if($bg_color_key == $selected_bg_color){echo 'selected=selected';}}?> ></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

		    	
			</div><!-- col-md-6 -->

			<div class="col-md-offset-2 col-md-4">

			<div class="col-md-8">	
					<div class="form-group">
						<label for="item_status" class="col-sm-4 control-label"><span>* </span>Status: </label>
						<div class="col-sm-8">
						<select class="status form-control" name="item_status" required>
								<?php foreach($status as $item_status_key => $item_status_value){ ?>
									<option value="<?php echo $item_status_key; ?>" <?php (isset($ID))? $selected_item_status = $item_result->item_status : '';if(isset($ID)){if($item_status_key == $selected_item_status){echo 'selected=selected';}}?> ><?php echo $item_status_value; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

				<div class="col-md-12 item_img">
					<?php 
					        if(isset($ID)){
					         if($item_result->item_img){ ?>
					          <div class="profilePic">
					           <span>
					            <?php echo '<img src="assets/images/uploads/'.$item_result->item_img.'" style="width:auto;" class="img-responsive" alt="">'; ?>
					            <a id="removeProfilePic"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
					           </span>
					           <input type="hidden" name="item_img1" value="<?php echo $item_result->item_img; ?>">
					          </div>

					          <div class="form-group" id="showNewPicSubmit" style="display:none;">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="file" name="item_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
							<?php
					         }
					         else { ?>
					          <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="item_img" id="photo" readonly>
									 <input type="file" name="item_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					         <?php
					         }
					        } else { ?>
					         <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="item_img" id="photo" readonly>
									 <input type="file" name="item_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					        <?php
					        }
					        ?>
				</div>
			</div><!-- col-md-6 -->
		 </div><!-- form-container -->
	  </form>
	</div><!-- Container Close -->
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>