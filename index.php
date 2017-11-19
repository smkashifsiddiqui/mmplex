<?php require_once 'header.php'; ?>
<?php $showtime = new showtime();
//print_f($_SESSION['user']);
 ?>
<!--main container-->
   <div class="container main-container">
			<div class="row">
				<div class="col-md-7 content-left">
					<div class="row">
						<div class="col-md-12 col-sm-12 program-movie">
							<div class="col-md-7 col-sm-7">
								Programs & Movies <span>(Cinemas & Timings)</span>
							</div><!-- col-md-6 -->
							
							<div class="col-md-6 col-sm-6 add-a-movie navbar-right dropdown settings">
								
				  
							</div><!-- col-md-6 -->
						</div><!-- program-movie -->
					</div><!-- row -->
					
					<div class="row">
						<div class="col-md-8 col-md-offset-4 form-horizontal" style="position:relative;">
							<div class="alert alert-danger" id="invalid_time" style="display:none;position:absolute;" role="alert">Invalid Time!</div>
								<label for="itemname" class="col-sm-4 control-label" style=" padding-top: 15px;">Go Date: </label>
									<div class="col-sm-6">
										<div class="input-group date" style="margin-top: 10px; margin-bottom: 10px;">
									        <input type="date" id="animateDate" class="form-control">
									        <span class="input-group-addon" id="go" onclick="go()">
									            <span class="glyphicon glyphicon-calendar"></span>
									        </span>
									    </div>
									</div>
							</div>
					</div><!-- row -->
					
					<div class="row">
						<div class="col-md-12 col-sm-12 timeline nopadding">
							<!--<img width="100%" src="assets/images/timeline.png"/>-->
							<div id="mytimeline"></div>
						</div>
					</div><!-- row -->
					
	
					
					<div class="clear"></div>
					
					<div class="row">
					<div class="col-md-12 col-sm-12 nopadding" id="maxscroll">
					<!-- top-sell -->
						<div class="col-md-6  col-sm-12 nopadding ">
							<div class="top-sellers">
								<div class="col-md-12 col-sm-12 top-sellers-head">
									<p>Top 10 Sellers <span>(Our Mesmorizing Services)</span></p>
									<img src="assets/images/setting.png"/>
								
								</div><!-- top-sellers-head -->
								
						
								<!-- top-sellers-label -->
								<div class="col-md-12 col-sm-12 top-sell-row nopadding">
									<div class="col-md-4 col-sm-4 top-sell-label">Number Sold</div>
									<div class="col-md-4 col-sm-4 top-sell-label">Value</div>
									<div class="col-md-4 col-sm-4 top-sell-label">Margin</div>
								</div>
								<!-- top-sellers-label -->
								
								<!-- top-sellers-data -->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">3D Glasses</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Popcorn Medium</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
							    </div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Plain Choc Top</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12  top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Expresso Coffee</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Expresso Coffee</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Expresso Coffee</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Expresso Coffee</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Expresso Coffee</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								<!-- top-sellers-data-->
								<div class="col-md-12 col-sm-12 top-sell-row  nopadding">
									<div class="col-md-4 col-sm-4 top-sell-data">Expresso Coffee</div>
									<div class="col-md-4 col-sm-4 top-sell-data">-</div>
									<div class="col-md-4 col-sm-4 top-sell-data">51</div>
								</div>
								<!-- top-sellers-data-->
								
								
								
							</div><!-- top-sellers-->
					    </div><!-- col-md-6-->
						<!-- /top-sell-->
						
						<!-- daily-stat-->
						<div class="col-md-6 col-sm-12 nopaddingright daily-states">
							<div class="top-sellers">
								<div class="col-md-12 col-sm-12 top-sellers-head">
									<p>Daily Statistics <span>(Our Mesmorizing Services)</span></p>
									<img src="assets/images/setting.png"/>
								</div><!-- top-sellers-head-->
								
								<div class="clear"></div>
								
								<!-- daily-states-dat-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-4 col-sm-4 daily-states-data">199</div>
									<div class="col-md-8 col-sm-8 daily-states-data"><span>Total Admits</span></div>
								</div>
								<!-- daily-states-data-->
								
								<!-- daily-states-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-4 col-sm-4 daily-states-data">199</div>
									<div class="col-md-8 col-sm-8 daily-states-data"><span>Total Admits</span></div>
								</div>
								<!-- daily-states-data-->
								
								<!-- daily-states-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-4 col-sm-4 daily-states-data">199</div>
									<div class="col-md-8 col-sm-8 daily-states-data"><span>Total Admits</span></div>
								</div>
								<!-- daily-states-data-->
								
								<!-- daily-states-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-4 col-sm-4 daily-states-data">199</div>
									<div class="col-md-8 col-sm-8 daily-states-data"><span>Total Admits</span></div>
								</div>
								<!-- daily-states-data-->
								
								<!-- daily-states-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-4 col-sm-4 daily-states-data">199</div>
									<div class="col-md-8 col-sm-8 daily-states-data"><span>Total Admits</span></div>
								</div>
								<!-- daily-states-data-->
								
								<!-- daily-states-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-4 col-sm-4 daily-states-data">199</div>
									<div class="col-md-8 col-sm-8 daily-states-data"><span>Total Admits</span></div>
								</div>
								<!-- daily-states-data-->
								<!-- /daily-stat-->
								
								
								<!-- POS Operators-->
								<!-- POS Operators-head-->
								<div class="col-md-12 col-sm-12 top-sellers-head">
									<p>Daily Statistics <span>(Our Mesmorizing Services)</span></p>
									<img src="assets/images/setting.png"/>
								</div><!-- POS Operators-head-->
								
								<div class="clear"></div>
								
								<!-- POS Operators-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-6 col-sm-6 pos-operators-data"><strong> + </strong>Richard McLaren</div>
									<div class="col-md-6 col-sm-6 pos-operators-data"><span>33.750</span></div>
								</div>
								<!-- POS Operators-data-->
								
								<!-- POS Operators-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-6 col-sm-6 pos-operators-data"><strong> + </strong>Richard McLaren</div>
									<div class="col-md-6 col-sm-6 pos-operators-data"><span>33.750</span></div>
								</div>
								<!-- POS Operators-data-->
								
								<!-- POS Operators-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-6 col-sm-6 pos-operators-data"><strong> + </strong>Richard McLaren</div>
									<div class="col-md-6 col-sm-6 pos-operators-data"><span>33.750</span></div>
								</div>
								<!-- POS Operators-data-->
								
								<!-- POS Operators-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-6 col-sm-6 pos-operators-data"><strong> + </strong>Richard McLaren</div>
									<div class="col-md-6 col-sm-6 pos-operators-data"><span>33.750</span></div>
								</div>
								<!-- POS Operators-data-->
								
								<!-- POS Operators-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-6 col-sm-6 pos-operators-data"><strong> + </strong>Richard McLaren</div>
									<div class="col-md-6 col-sm-6 pos-operators-data"><span>33.750</span></div>
								</div>
								<!-- POS Operators-data-->
								
								<!-- POS Operators-data-->
								<div class="col-md-12 col-sm-12 daily-states-row  nopadding">
									<div class="col-md-6 col-sm-6 col-md-12 pos-operators-data"><strong> + </strong>Richard McLaren</div>
									<div class="col-md-6 col-sm-6 pos-operators-data"><span>33.750</span></div>
								</div>
								<!-- POS Operators-data-->
								
								
							</div><!-- top-sellers-->
						</div><!-- col-md-6 -->
						
					
						</div>
					</div><!-- row -->
						
				</div><!-- col-md-7-->
				
				<div class="col-md-5 padding5">
					<div class="cinema-program-bg" id="cinema-program-bg">
						<div class="col-md-12 col-sm-12 add-deals-head">
						 <div class="col-md-6 col-sm-6  nopadding">	
							<p>Programs & Movies (Cinemas & Timings)</p>
							</div><!-- col-md-6-->
							<div class="col-md-6 col-sm-6  nopadding">	
							<div class="navbar-right dropdown settings ">
							  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img  src="assets/images/setting.png"/></a>
							  <ul class="dropdown-menu">
								<li><a href="#">HTML</a></li>
								<li><a href="#">CSS</a></li>
								<li><a href="#">JavaScript</a></li>
							  </ul>
							</div>
						</div><!-- col-md-6-->
							
						</div><!-- add-deals-head-->
						
						<div class="movie-detail-labels">
							<div class="col-md-4 col-sm-4 detail-label">
								<p>Time</p>
							</div><!-- col-md-9-->
							
							<div class="col-md-3 col-sm-3 detail-label">
								<p>Screen</p>
							</div>
							
							<div class="col-md-2 col-sm-2 detail-label">
								<p>Sold</p>
							</div>
							
							<div class="col-md-3 col-sm-3 detail-label">
								<p>Available</p>
							</div>
						</div><!-- movie-detail-labels-->
						
						<?php $booking = new booking();
								$all_movies = $booking->get_booking_movies();
								//print_f($results);
								if ($all_movies) { ?>
							<?php foreach($all_movies as $movie){?>

						<div class="add-movie-item-rating">
							<div class="col-md-12 col-sm-12">
								<div class="movie-name-rating">
									<img class="round-shape" src="assets/images/round_shape.png">Movie Name : <strong><?php echo $movie->movie_title; ?></strong><img class="rating-star" src="assets/images/rating_star.png">
								</div><!-- movie-name-rating-->
							</div><!-- col-md-12-->
							
							
						</div><!-- add-movie-item-rating-->
						<div class="add-movie-item-data">
						<?php 
							$movie_id = $movie->movie_id;
							$all_shows = $booking->get_booking_showtimes($movie_id);
							foreach($all_shows as $all_shows_value){
								$today_date = date("Y-m-d");
								$show_time_ini = $all_shows_value->showtime_datetime;
								$show_time = date('Y-m-d', strtotime($show_time_ini));
								if($today_date == $show_time){
								 $start_time_ini = $all_shows_value->showtime_datetime;
								 $start_time =  date('d-m-y h:i A', strtotime($start_time_ini));
								 $s_id = $all_shows_value->showtime_id;

								 //get available seats of current showtime from booking
								 $ini_total_booked_s = 0;
								 $total_booked_s = 0;
								 $all_booked_seats = 0;
								 $all_remaining_seats = 0;

								 $booked_seats = $booking->booked_seats_qty($s_id);
								 //print_f($available_seats);
								 foreach ($booked_seats as $key => $value) {
								 	 $ini_total_booked_s = $value->booking_seat_qty;
								 	 $total_booked_s += $ini_total_booked_s;
								 }
								  $total_booked_s;
								  $screen_total_seats = $all_shows_value->screen_total_seats;
								  $all_remaining_seats = $screen_total_seats - $total_booked_s;
								?>

							<div class="col-md-12 col-sm-12">
								<div class="col-md-4 col-sm-4 movie-detail-data">
									<p><?php echo $start_time; ?></p>
								</div><!-- col-md-9-->
								
								<div class="col-md-3 col-sm-3 movie-detail-data">
									<p><?php echo $all_shows_value->screen_name; ?></p>
								</div>
								
								<div class="col-md-2 col-sm-2 movie-detail-data">
									<p><?php echo $total_booked_s; ?></p>
								</div>
								
								<div class="col-md-3 col-sm-3 movie-detail-data">
									<p><?php echo $all_remaining_seats; ?></p>
								</div>
							</div><!-- col-md-12-->
							<?php }else{}?>
							<?php } ?>
						</div><!-- add-movie-item-data-->

						
						<?php } ?>
						<?php } ?>
					</div><!-- deal-bg-->
					
				</div><!-- col-md-5-->
				
				
			</div><!-- row -->
			

   </div><!-- container -->
   <!-- /main container -->



<?php require_once 'include/short_scripts/index_script.php'; ?>
<?php require_once 'footer.php'; ?>