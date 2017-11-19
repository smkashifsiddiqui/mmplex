<?php require_once 'header.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }

	if(in_array('add_user', $user_capabilities)){	
		
	
?>


<div class="container">

	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="view_movie.php">Movies</a></li>
		  <li class="active"><?php echo (isset($_GET['id']))? 'Update' : 'Add' ?>Movie</li>
		</ol>
	</div><!--row-->
<form class="form-horizontal dashboardForm"  action="" method="post" enctype="multipart/form-data">
		<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3> Film Details</h3>
						</div>
				 		<div class="col-sm-6 action_btn">
				 			<button type="button" class="btn submitBtn cancel-button" name="">Cancel</button>
					 		<button type="submit" class="btn submitBtn save-button" name="add_movie"><?php echo (isset($_GET['id']))? 'Save Changes ' : 'Add Film' ?>  </button>
					 		
				 		</div>
				 	</div>
			 	</div>
		  </div><!--row-->
			
			
			<?php 
			$distributer = new distributer();
			$all_distributer = $distributer->get_distributers();

			$person = new person();
			$all_movie_person = $person->get_persons();



			//print_f($all_distributer);

			$movie = new movie();
			
			$ID = (isset($_GET['id']))? $_GET['id'] : NULL;
			if (isset($_POST['add_movie'])) {		
				// Update old record
				if (isset($ID)) {
					$results = $movie->update_movie($_POST, $ID);
				}else{ // Insert new
					$results = $movie->insert_movie($_POST);
				}
				if ($results) {
					echo '<div class="alert alert-success" role="alert"> Added Sucessfully </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error </div>';
				}
			}
			if (isset($ID)) {
				$movie_result = $movie->get_movies($ID);
			}
			?>
			

	<div class="row">
		<div class="form-container">
				<div class="col-md-6">
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_title" class="col-sm-4 control-label"><span>*</span> Movie Name: </label>
								
								<div class="col-sm-8">
									<input type="text" name="movie_title" id="movie_title" value="<?php echo (isset($ID))? $movie_result->movie_title : '' ?>" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_distributer" class="col-sm-4 control-label"><span>*</span> Distributer Name: </label>
								<div class="col-sm-8">
									<select class="form-control" name="movie_distributer_id" required>
										<option value="" selected disabled>Select</option>
										<?php foreach ($all_distributer as $value){ ?>
											<option value="<?php echo $value->dist_id; ?>" <?php (isset($ID))? $dist_name = $movie_result->movie_distributer_id : ''; if(isset($ID)){if($value->dist_id == $dist_name){echo 'selected=selected';}}?>><?php echo $value->dist_name; ?></option>
										<?php } ?>
									</select>
									<!-- -->
								</div>
							</div>
						</div>

						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_rating" class="col-sm-4 control-label">Rating: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_rating" id="movie_rating" value="<?php echo (isset($ID))? $movie_result->movie_rating : '' ?>" class="form-control" >
								</div>
							</div>
						</div>

						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_year" class="col-sm-4 control-label">Release date: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_release_date" id="movie_release_date" value="<?php echo (isset($ID))? $movie_result->movie_release_date : '' ?>" class="form-control datetimepicker" >
								</div>
							</div>
						</div>

						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_genre" class="col-sm-4 control-label"><span>*</span> Genre: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_genre" id="movie_genre" value="<?php echo (isset($ID))? $movie_result->movie_genre : '' ?>" class="form-control"  required>
								</div>
							</div>
						</div>

						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_duration" class="col-sm-4 control-label"><span>*</span> Duration minutes: </label>
								<div class="col-sm-8" >
									<input type="number" name="movie_duration" id="movie_duration" value="<?php echo (isset($ID))? $movie_result->movie_duration : '' ?>" class="form-control "  required>
								</div>
			
							</div>
						</div>

						<div class="clear"></div>
				
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_national_code" class="col-sm-4 control-label">National Code: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_national_code" id="movie_national_code" value="<?php echo (isset($ID))? $movie_result->movie_national_code : '' ?>" class="form-control" >
								</div>
							</div>
						</div>

						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_format" class="col-sm-4 control-label">Movie Format: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_format" id="movie_format" value="<?php echo (isset($ID))? $movie_result->movie_format : '' ?>" class="form-control" >
								</div>
							</div>
						</div>

						<div class="clear"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_synopsis" class="col-sm-4 control-label">Synopsis: </label>
								<div class="col-sm-8">
									<textarea name="movie_synopsis" id="movie_synopsis" row="5" class="form-control" style="height: 80px;"><?php echo (isset($ID))? $movie_result->movie_synopsis : '' ?></textarea>
								</div>
							</div>
						</div>
						
						<div class="clear"></div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_trailor" class="col-sm-4 control-label">Trailor Embed Code: </label>
								<div class="col-sm-8">
									<textarea name="movie_trailor" id="movie_trailor" row="5" class="form-control" style="height: 80px;"><?php echo (isset($ID))? $movie_result->movie_trailor : '' ?></textarea>
								</div>
							</div>
						</div>
						
						<div class="clear"></div>
						
					
						

					</div><!-- col-md-6 -->

						<div class="col-md-4 col-md-offset-2">

							<div class="col-md-12">
								<div class="form-group">
									<label for="movie_actors" class="col-sm-6 control-label"><span>*</span> Movie Status: </label>
									<div class="col-sm-6">
										<select class="form-control status" name="movie_status" required>
											<?php foreach($status as $movie_status_key => $movie_status_value){ ?>
											<option value="<?php echo $movie_status_key; ?>" <?php (isset($ID))? $selected_movie_status = $movie_result->movie_status : '';if(isset($ID)){if($movie_status_key == $selected_movie_status){echo 'selected=selected';}}?> ><?php echo $movie_status_value; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>

							<div class="clear"></div>

							<div class="col-md-12 movie-poster">
							<?php 
					        if(isset($ID)){
					         if($movie_result->movie_poster){ ?>
					          <div class="profilePic">
					           <span>
					            <?php echo '<img src="assets/images/uploads/'.$movie_result->movie_poster.'" class="img-responsive" alt="">'; ?>
					            <a id="removeProfilePic"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
					           </span>
					           <input type="hidden" name="movie_poster1" value="<?php echo $movie_result->movie_poster; ?>">
					          </div>

					          <div class="form-group" id="showNewPicSubmit" style="display:none;">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="file" name="movie_poster" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
							<?php
					         }
					         else { ?>
					          <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="movie_poster" id="photo" readonly>
									 <input type="file" name="movie_poster" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					         <?php
					         }
					        } else { ?>
					         <div class="form-group">
								<label for="movie_synopsis" class="col-sm-2 control-label">Image: </label>
								<div class="col-sm-10">
									 <input type="hidden" class="form-control" name="movie_poster" id="photo" readonly>
									 <input type="file" name="movie_poster" class="form-control" style="width:100%;height: 33px;">
								</div>
							 </div>
					        <?php
					        }
					        ?>
							</div>
							
						</div><!-- col-md-6 -->
				
						
					
					</div><!-- form-container -->
				</div><!-- row -->

					<div class="row">
						<div class="form-container bottom-container" style="padding-top:0px;">
							<div class="col-md-12 gray-header">
								<h3> Film Rental</h3>
							</div>

						<div class="col-md-6">
							<!--<div class="col-md-12">	
							<div class="form-group">
								<label for="movie_contract_type" class="col-sm-4 control-label">Contract Type: </label>
								<div class="col-sm-8">
								
									<select class="form-control" name="movie_contract_type">
										<option value="" selected disabled>Select</option>
										<?php foreach($movie_contract_type as $movie_contract_type_key => $movie_contract_type_value){ ?>
										<option value="<?php echo $movie_contract_type_key; ?>" <?php (isset($ID))? $selected_movie_contract_type = $movie_result->movie_contract_type : '';if(isset($ID)){if($movie_contract_type_key == $selected_movie_contract_type){echo 'selected=selected';}}?> ><?php echo $movie_contract_type_value; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<div class="clear"></div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_rental_charges" class="col-sm-4 control-label">Rental Charges: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_rental_charges" id="movie_rental_charges" value="<?php echo (isset($ID))? $movie_result->movie_rental_charges : '' ?>" class="form-control" >
								</div>
							</div>
						</div>-->

						<div class="clear"></div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_contract_start_date" class="col-sm-4 control-label">Contract Start Date: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_contract_start_date" id="movie_contract_start_date" value="<?php echo (isset($ID))? $movie_result->movie_contract_start_date : '' ?>" class="form-control datetimepicker" >
								</div>
							</div>
						</div>
						
						<div class="clear"></div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="movie_dist_seats" class="col-sm-4 control-label">Distributer Seats: </label>
								<div class="col-sm-8">
									<input type="text" name="movie_dist_seats" id="movie_dist_seats" value="<?php echo (isset($ID))? $movie_result->movie_dist_seats : '' ?>" class="form-control" >
								</div>
							</div>
						</div>
						
						<div class="clear"></div>

						</div>	<!--col-m-6-->
						<div class="col-md-6">
							
						</div>	

						<div class="col-md-12 bottom-label">
							<div class="col-md-6">
								<h3>Actors, Directors & Producers.</h3>
								<span>Add or remove actors, directors and producers for this film below</span>
						</div>

						<div class="col-md-6 form-header-right">
								<button type="button" class="btn submitBtn person_btn save-button " value="" onclick="addRow1()">Add Person</button>
							</div>
						</div>

				<div class="col-md-12 ">
					<div id="content1">
					<?php if(isset($ID)){
							$counter = 0;
							$current_actors = $movie_result->movie_actors;
							$current_actors = (!empty($current_actors))? json_decode($current_actors) : array();

							$current_actors_role = $movie_result->movie_actors_role;
							$current_actors_role = (!empty($current_actors_role))? json_decode($current_actors_role) : array();
							
							//print_f($current_item_price);
						?>
						<?php foreach ($current_actors as $current_actors_values) {?>
						<div class="row">
							<div class="col-md-12 row-el">
								<div class="col-md-5">
									<div class="form-group">
										<label class="col-sm-3 control-label">Actor</label>
										<div class="col-sm-9">
											<select name="movie_actors[]" class="form-control">
											<?php 
											foreach ($all_movie_person as $all_movie_person_value){ ?>
												<option value="<?php echo $all_movie_person_value->movie_person_id; ?>" <?php (isset($ID))? $selected_person_name = $current_actors_values : '';if(isset($ID)){if($all_movie_person_value->movie_person_id == $selected_person_name){echo 'selected=selected';}} ?>><?php echo $all_movie_person_value->movie_person_name; ?></option>
											<?php } ?>
											</select>
										</div>
								  	</div>
								</div><!-- col-md-4 -->	

								<div class="col-md-5">
									<div class="form-group">
										<label class="col-sm-3 control-label">Role</label>
											<div class="col-sm-9">
												<select name="movie_actors_role[]" class="form-control">
												<?php 
													foreach($movie_actors_role as $movie_actors_role_key => $movie_actors_role_value){?>
															<option value="<?php echo $movie_actors_role_key ;?>" <?php (isset($ID))? $selected_person_role = $current_actors_role[$counter] : '';if(isset($ID)){if($movie_actors_role_key == $selected_person_role){echo 'selected=selected';}} ?>><?php echo $movie_actors_role_value ;?></option>
													<?php }?>
												</select>
											</div>
										</div>
								</div><!-- col-md-4 -->	

								<div class="col-md-2 txt-center">
									<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>
								</div>
							</div><!-- row-el -->
						</div><!-- row -->

					<?php $counter++; ?>
					<?php }?>
					<?php }?>
					</div><!-- #Content CLose -->
				</div><!-- col-md-12 -->	
			</div><!-- form-container -->
		</div><!--row -->

				
			
		</form>

<?php require_once 'include/short_scripts/movie_script.php'; ?>
<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

	}
?>
<?php require_once 'footer.php'; ?>
