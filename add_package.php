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
		  <li><a href="view_package.php">Package</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?> Package</li>
		</ol>
	</div><!--row-->
<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Package Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_package"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Package' ?>  </button>
					 		<a href="#" data-toggle="modal" data-target=".delete_confirm_modal"><img width="20px" class="img_delete" src="assets/images/delete_icon.png"/></a>
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->

	
			<?php 
			$food_category = new food_category();
			$all_food_category = $food_category->get_food_categories();

			$item = new item();
			$all_item = $item->get_items();

			$package = new package();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_package'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $package->update_package($_POST, $ID);
				}else{ // Insert new
					$results = $package->insert_package($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added package Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$package_result = $package->get_packages($ID);
			}
			?>

	<div class="row">
			<div class="form-container">
			<div class="col-md-6">

				<div class="col-md-12">	
					<div class="form-group">
						<label for="package_name" class="col-sm-4 control-label"><span>* </span>Package Name: </label>
						<div class="col-sm-8">
							<input type="text" name="package_name" id="package_name" value="<?php echo (isset($ID))? $package_result->package_name : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="package_name" class="col-sm-4 control-label"><span>* </span>Package desc: </label>
						<div class="col-sm-8">
							<input type="text" name="package_desc" id="package_desc" value="<?php echo (isset($ID))? $package_result->package_desc : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="package_measuring_unit" class="col-sm-4 control-label"><span>* </span> Measuring Unit	: </label>
						<div class="col-sm-8">
						<select name="package_measuring_unit" class="form-control" required>
							<option value="" ="" selected disabled>select</option>
							<?php foreach($measuring_units as $measuring_units_key => $measuring_units_value){?>
								<option value="<?php echo $measuring_units_key; ?>" <?php (isset($ID))? $selected_unit = $package_result->package_measuring_unit : '';if(isset($ID)){if($measuring_units_key == $selected_unit){echo 'selected=selected';}} ?>><?php echo $measuring_units_value; ?></option>
							<?php } ?>
						</select>
			
						</div>
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="package_category" class="col-sm-4 control-label">Category: </label>
						<div class="col-sm-8">
							<select name="package_category" class="form-control">
							<option value="" selected disabled>select</option>
							<?php foreach($all_food_category as $value){ ?>
								<option value="<?php echo $value->food_category_id; ?>" <?php (isset($ID))? $selected_category = $package_result->package_category : '';if(isset($ID)){if($value->food_category_id == $selected_category){echo 'selected=selected';}} ?>><?php echo $value->food_category_name; ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="package_price" class="col-sm-4 control-label"><span> * </span> Default Price: </label>
						<div class="col-sm-8">
							<input type="text" name="package_price" id="package_price" value="<?php echo (isset($ID))? $package_result->package_price : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>
				
				<div class="clear"></div>

				<div class="col-md-12">	
					<div class="form-group">
						<label for="package_cost_price" class="col-sm-4 control-label"><span>* </span> Cost Price: </label>
						<div class="col-sm-8">
							<input type="text" name="package_cost_price" id="package_cost_price" value="<?php echo (isset($ID))? $package_result->package_cost_price : '' ?>" class="form-control" required>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>


				

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="item_img" class="col-sm-4 control-label">Display Order #: </label>
						<div class="col-sm-8">
							<input type="number" name="package_order_no" id="package_order_no" value="<?php echo (isset($ID))? $package_result->package_order_no : '' ?>" class="form-control" >
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

		    	<div class="col-md-12">	
					<div class="form-group">
						<label for="item_img" class="col-sm-4 control-label">Package bg: </label>
						<div class="col-sm-8">
							<select class="form-control" name="package_bg" id="package_bg" style="background-color:<?php echo $package_result->package_bg;?>;" required>
								<option value=""  selected disabled>Select below</option>
								<?php foreach($bg_color as $bg_color_key => $bg_color_value){ ?>
									<option value="<?php echo $bg_color_key; ?>" style="background-color:<?php echo $bg_color_value;?>;" <?php (isset($ID))? $selected_bg_color = $package_result->package_bg : '';if(isset($ID)){if($bg_color_key == $selected_bg_color){echo 'selected=selected';}}?> ></option>
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
						<label for="package_status" class="col-sm-4 control-label">Status: </label>
						<div class="col-sm-8">
						<select class="form-control status" name="package_status">
								<?php foreach($status as $package_status_key => $package_status_value){ ?>
									<option value="<?php echo $package_status_key; ?>" <?php (isset($ID))? $selected_status = $package_result->package_status : '';if(isset($ID)){if($package_status_key == $selected_status){echo 'selected=selected';}}?> ><?php echo $package_status_value; ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>

		    	<div class="clear"></div>

				<div class="col-md-12 item_img">
					<?php 
					        if(isset($ID)){
					         if($package_result->package_img){ ?>
					          <div class="profilePic">
					           <span>
					            <?php echo '<img src="assets/images/uploads/'.$package_result->package_img.'" style="width:auto;" class="img-responsive" alt="">'; ?>
					            <a id="removeProfilePic"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
					           </span>
					           <input type="hidden" name="package_img1" value="<?php echo $package_result->package_img; ?>">
					          </div>

					          <div class="form-group" id="showNewPicSubmit" style="display:none;">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="file" name="package_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
							<?php
					         }
					         else { ?>
					          <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="package_img" id="photo" readonly>
									 <input type="file" name="package_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					         <?php
					         }
					        } else { ?>
					         <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="package_img" id="photo" readonly>
									 <input type="file" name="package_img" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					        <?php
					        }
					        ?>
				</div>
			</div><!-- col-md-6 -->


			<div class="col-md-12 bottom-label">
				<div class="col-md-6">
					<h3>Package Items.</h3>
						<span>Add or remove items and their details for this package</span>
					</div>

				<div class="col-md-6 form-header-right">
					<button type="button" class="btn submitBtn save-button person_btn" value="" onclick="additem()">Add Item</button>
				</div>
			</div>

			<div class="col-md-12 label-container">
				<div class="col-md-3">
					Item Name
				</div>

				<div class="col-md-3">
					Item Price
				</div>

				<div class="col-md-3">
					Item Quantity
				</div>

				<div class="col-md-3">
				</div>
			</div><!-- col-md-12 -->

				<div class="col-md-12 ">
					<div id="itemcontainer">
						<?php if(isset($ID)){
							$counter = 0;
							$current_items = $package_result->package_item_name;
							$current_items = (!empty($current_items))? json_decode($current_items) : array();

							$current_item_price = $package_result->package_item_price;
							$current_item_price = (!empty($current_item_price))? json_decode($current_item_price) : array();
							
							$current_item_qty = $package_result->package_item_qty;
							$current_item_qty = (!empty($current_item_qty))? json_decode($current_item_qty) : array();
							
							//print_f($current_item_price);
						?>
						<?php foreach ($current_items as $current_items_values) {?>
						
						<div class="row">
							<div class="col-md-12 row-el">
								<div class="col-md-3">
									<div class="item-group">
									   <select name="package_item_name[]" id="item<?php echo $counter;?>" class="package_item_name form-control" required>
											<option value="" selected disabled>select item</option>
											<?php foreach ($all_item as $all_item_key => $all_item_value) {?>
												 <option value="<?php echo $all_item_value->item_id;?>" <?php (isset($ID))? $selected_item_name = $current_items_values : '';if(isset($ID)){if($all_item_value->item_id == $selected_item_name){echo 'selected=selected';}} ?>><?php echo $all_item_value->item_name;?></option>
											<?php }?>
										</select>
										</div>
									</div><!-- col-md-4 -->	

									<div class="col-md-3">
										<div class="item-group">
											<input type="text" name="package_item_price[]" class="form-control itemprice item<?php echo $counter;?>price" value="<?php echo (isset($ID))? $current_item_price[$counter] : '' ?>" class="form-control"  readonly required>
										</div>
									</div><!-- col-md-4 -->	

									<div class="col-md-3">
										<div class="item-group">
											<input type="text" name="package_item_qty[]" class="form-control itemqty" value="<?php echo (isset($ID))? $current_item_qty[$counter] : '' ?>" class="form-control" required>
										</div>
											
									</div><!-- col-md-4 -->	

									<div class="col-md-3 txt-center">
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>
									</div>
							</div><!-- row-el -->
						</div><!-- row -->
						<?php $counter++; ?>
						<?php }?>
						<?php }?>
					</div><!-- #Content CLose -->
				</div><!-- col-md-12 -->	
			</div><!--form-container -->
		</div><!--row -->
	  </form>
	
	
	
<?php require_once 'include/short_scripts/package_script.php'; ?>

<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>