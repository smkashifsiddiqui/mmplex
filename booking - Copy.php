<?php require_once 'header-dashboard.php'; ?>
<?php $page = "booking";?>	
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_ticket', $user_capabilities)){
	$booking = new booking();	
		
	
?>
 
   <!--/header-->
  <!--main container-->
   <div class="container main-container">
	<div class="row">
		<div class="col-md-12 main-content">
			<div class="row">
				<div class="col-md-6 nopadding paddingfive">
					<div class="row">
						<div class="col-md-12">
						<div class="movies-showing">
						
						<div class="col-md-2 col-sm-2 ">
								<p class="movie">Movies</p>
							</div>
							
							<div class="col-md-3 col-sm-3 nopadding">
								<button class="btn now-showing" type="button">
									  Now showing <span class="badge"></span>
								</button>
							</div>
							
							<div class="col-md-3 col-sm-3 nopadding">
								<button class="btn   upcoming" type="button">
									  Upcoming <span class="badge"><?php echo $all_movies = $booking->get_movies_count();?></span>
								</button>
							</div>
							
							<div class="col-md-4 col-sm-3 nopaddingleft movie_sort">
								<div class="form-group">
					                <div class='input-group date' id='datetimepicker1'>
					                    <input type='text' id="showtime_bydate" class="form-control" />
					                    <span class="input-group-addon" id="open">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
							</div><!-- col-md-4 -->
							
							<div class="clear"></div>
							
							<div class="movies-detail">
							
								<ul class="movies-detail-list">

								<?php 
								$all_movies = $booking->get_booking_movies();
								
								//print_f($results);
								if ($all_movies) { ?>
								<?php foreach($all_movies as $movie){
									$display_movie = false;
									$movie_id = $movie->movie_id;
									$all_showtimes = $booking->get_booking_showtimes($movie_id);

									?>
									<?php foreach($all_showtimes as $showtime){

												$today_date1 = strtotime(date("Y-m-d"));
												$this_date1 = strtotime($showtime->showtime_datetime); 
												if($today_date1 < $this_date1){
													$display_movie = true;
												}
											}
									if($display_movie == true){
									?>
									<li class="movie_list">
									<div class="col-md-7 col-sm-7 movie-img nopadding"><img src="assets/images/movie-img.png"/>
									<div class="movie-title nopadding"><p>Movie Name: <strong><?php echo $movie->movie_title; ?></strong></p></div>
									</div>
									<div class="col-md-5 col-sm-5 nopadding select-movie">
										<button class="btn btn-default movie-select-btn" type="button" >
											  <span><img  src="assets/images/white_plus.png"/></span> Select your movie 
										</button>
										

										<button class="btn btn-default movie-detail-btn" type="button" >
											 Details 
										</button>
										
									</div><!-- col-md-7  -->
									<div class="clear"></div>
									
									<div class="movie-venue col-md-12 nopadding">
										<ul class="movie-venue-list">
											<li>
													<div class="venue-head">
													<div class="col-md-2 col-sm-2 venue">Time</div>
													<div class="col-md-2 col-sm-2 venue">Screen</div>
													<div class="col-md-2 col-sm-2 venue">Sold</div>
													<div class="col-md-2 col-sm-2 venue">Available</div>
													<div class="col-md-2 col-sm-2 vanue-plus venue"><img src="assets/images/white_plus.png"></div>
												</div>
											</li>
											<?php 
												
												//print_f($all_showtimes);?>
												<?php foreach($all_showtimes as $showtime){
													  $today_date = strtotime(date("Y-m-d"));
													  $this_date = strtotime($showtime->showtime_datetime); 
													if($today_date < $this_date){
													 	
													 
													 $start_time_ini = $showtime->showtime_datetime;
													 $start_time =  date('h:i A', strtotime($start_time_ini));
													 $s_id = $showtime->showtime_id;

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

													
													 $screen_total_seats = $showtime->screen_total_seats;
													 $all_remaining_seats = $screen_total_seats - $total_booked_s;
												?>
											
											<li>
												<div class="venue-cinema">
													<div class="col-md-2 col-sm-2 venue cinema-name-odd"><p><?php echo $start_time; ?></p></div>
													<div class="col-md-2 col-sm-2 venue"><p><?php echo $showtime->screen_name; ?></p></div>
													<div class="col-md-2 col-sm-2 venue"><p><?php echo $total_booked_s; ?></p></div>
													<div class="col-md-2 col-sm-2 venue"><p><?php echo $all_remaining_seats; ?></p></div>
													<div class="col-md-2 col-sm-2 venue  vanue-plus">
										
													 <button class="btn btn-default book-ticket-btn screen_id_btn"  data-toggle="modal" data-target="#fsModal" <?php if($all_remaining_seats == 0){echo 'style="background-color:red!important;"';}?>>
														 <?php if($all_remaining_seats == 0){ echo 'All Booked'; }else{ echo 'Book a Ticket';} ?>
													</button>
													<input type="hidden" class="screen_id" value="<?php echo $s_id; ?>">

													
													</div>
												</div>
											</li>
											<?php }else{}?>
											<?php } ?>
											</ul><!-- movie-venue-list  -->
										</div><!-- movie-venue  -->
									</li>
									<?php } }?>
									<?php } else{ ?>
									<?php echo 'Error';} ?>
								</ul>
							</div><!-- movies-detail-list -->
							
							
						</div><!-- /movies-showing -->
					</div><!-- col-md-12 -->
						
					</div><!-- row -->
				</div><!-- col-md-6-->
				
				<div class="col-md-6 padding5">
					<div class="deal-bg" id="terminal">
						<div class="col-md-12 col-sm-12 add-deals-head">
						 <div class="col-md-9 col-sm-9 nopadding">	
							<p>Add your Tickets (on particular basis)</p>
							</div><!-- col-md-6-->
							<div class="col-md-3 col-sm-3 nopadding">	
							<div class="navbar-right dropdown settings ">
							  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img  src="assets/images/settings.png"/></a>
							  <ul class="dropdown-menu">
								<li><a href="#">HTML</a></li>
								<li><a href="#">CSS</a></li>
								<li><a href="#">JavaScript</a></li>
							  </ul>
							</div>
						</div><!-- col-md-6-->
							
						</div><!-- add-deals-head-->
						
						<div class="add-deals-desc">
							<div class="col-md-5 col-sm-5" style="padding:5px;">
								<p>Description</p>
							</div><!-- col-md-9-->
							
							<div class="col-md-3 col-sm-3" style="padding:5px;">
								<p>Seats</p>
							</div><!-- add-deals-value-->
							<div class="col-md-2 col-sm-2" style="padding:5px;">
								<p>Price</p>
							</div><!-- add-deals-value-->
							<div class="col-md-2 col-sm-2" style="padding:5px;">
								<p>Value</p>
							</div><!-- add-deals-value-->
						</div><!-- col-md-3-->
						
						<?php if(isset($_SESSION['all_previous_list'])){


							foreach ($_SESSION['all_previous_list'] as  $value) {
								
							echo  '<div class="terminal_item add-movie-item add-deals-item">';
						    echo  '<div class="col-md-5 col-sm-5 add-movie-item-name">';
						    echo  '<input type="hidden" value="'.$value['shw_id'].'" class="terminal_m_show_id">';
						    echo  '<input type="hidden" value="'.$value['ticket_id'].'" class="terminal_m_ticket_id">';
						    echo  '<input type="hidden" value="'.$value['ticket_type'].'" class="terminal_m_ticket_type">';
						    echo  '<input type="hidden" value="'.$value['allow_comp'].'" class="terminal_m_is_comp">';
						    echo  '<input type="hidden" value="'.$value['shw_key'].'" class="terminal_m_show_key">';
						    echo  '<p><strong>'.$value['movie_title'].'</strong></p>';
						    echo  '<input type="hidden" value="'.$value['movie_id'].'" class="terminal_m_id">';
						    echo  '<input type="hidden" value="'.$value['d_id'].'" class="terminal_d_id">';
						    echo  '</div>';
							echo  '<div class="col-md-3 col-sm-3 add-deal-item-value">';
							echo  '<p>'.$value['posted_seats'].'</p>';
							echo  '<input type="hidden" value="'.$value['posted_seats'].'" class="terminal_m_seats">';
							echo  '</div>';
							echo  '<div class="col-md-2 col-sm-2 add-deal-item-value">';
							echo  '<p>'.$value['ticket_price'].' x '.$value['qty'].'</p>';
							echo  '<input type="hidden" value="'.$value['ticket_price'].'" class="terminal_m_price">';
							echo  '<input type="hidden" value="'.$value['qty'].'" class="terminal_m_qty">';
							echo  '</div>';
							echo  '<div class="col-md-2 col-sm-2 add-deal-item-value">';
							echo  '<p><img class="img-responsive ticket_delete" src="assets/images/delete_icon.png" style="width:12px;">'.$value['sum'].'';
							echo  '<input type="hidden" value="'.$value['sum'].'" class="terminal_m_sum"></p>';
							echo  '</div>';
							echo  '</div>';
							} 
							}//foreach ?>

					
					</div><!-- deal-bg-->
					
					<div class="clear"></div>
						
					<div class="function-bg">
					
						<div class="col-md-3 col-sm-3 function-bg-br">
							<img width="25px" class="all_delete" class="img-responsive" src="assets/images/delete_icon.png"/>
						Reset
						</div>
						
						<div class="col-md-3 col-sm-3 function-bg-br">
							
						</div>
						
						<div class="col-md-3 col-sm-3 function-bg-br">
							
						</div>
						
						<div class="col-md-3 col-sm-3 function-bg-br">

						</div>
					
					</div><!-- function-bg-->
					
					<div class="clear"></div>
						
					<div class="total-amount">
						<div class="col-md-5 col-sm-6 nopadding">
							<p class="total-amount-label">Total Amount:<br/>
							<span>Inc: GST</span></p>
						</div><!-- col-md-5-->
						
						<div class="col-md-7 col-sm-6">
							<p class="total-amount-value">Rs. 00.00<br/>
							
							
							<span>- 20% PKR</span></p><br/>
							<input type="hidden" id="ticket_total" value="">
						</div><!-- col-md-7-->
					</div><!-- total-amount-->
					
					
					<div class="clear"></div>
						
					
					
					<div class="ticket-save">
						<div class="col-md-6 col-sm-6">
							
						</div>
								
						<div class="col-md-6 col-sm-6 save-cancel">
						<a class="all_delete" href="">Cancel </a>
							<button class="btn btn-default save-btn" id="final_booking" type="button" >
								Save
							</button>
						</div>
								
								
					</div><!-- ticket-type-btn-->
						
					<div class="calculator">
						<label>Given Amount:</label>
						<input type="number" min="0" class="expression1" placeholder="0.00">

						<button class="calculate">Calculate</button>
						<br/><label>Return Amount:</label>
						<input type="text" min="0" class="expression2" placeholder="0.00" readonly="">
					</div><!-- calculator-->

				</div><!-- col-md-5-->
				
				
			</div><!-- row -->
			
			<div class="clear"></div>
		
	  </div><!-- col-md-10 -->
   </div><!-- row -->
   </div><!-- /main container -->
   
   <?php require_once 'view_seats.php'; ?>

   
   
    <!-- Bootstrap core JavaScript -->
    <script src="assets/js/jquery.latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script>
	$( document ).ready(function() {
		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});

		 var now_showing = $(".movie_list").size();
		 
		 $(".now-showing .badge").html(now_showing);
	
	
		$( ".movie-detail-btn" ).click(function() {
		
		  $(this).parent().parent().find(".movie-venue").toggle("slow");
		});

		$( ".movie-select-btn" ).click(function() {
		
		 // $(this).parent().parent().find(".movie-venue").toggle("slow");
		});

		


		
		$(".movies-showing").on('click', '.book-ticket-btn',function(event) {

    	event.preventDefault();
    	var id = $(this).next('.screen_id').val();
    	
    	$.post('ajax.php', {'screen_id': id, 'action': 'screen_show'}, function(data) {
    		console.log(data);
    		//$('.seats-container').html(data.screen_id);
    	
    	var initial_rows = JSON.parse(data.screen_rows);
    	var initial_rowcolumn = JSON.parse(data.screen_row_column);
    	var booked_seats = JSON.parse(data.booking_seats_number);
    	var rows = initial_rows.reverse();
    	var screen_id = data.screen_id;
    	var rowcolumn = initial_rowcolumn.reverse();
    	var booked_seats_array = new Array();
    	var advance_booked_seats_array = new Array();
    	var sess_seats_array = new Array();
    	var showtime_id = data.showtime_id;
    	var locked_seats_array = new Array();
    	var movie_id="";
    	//get all advanced booked seats array from booking
    	
    	$.post('ajax.php', {'showtime_id': showtime_id, 'action': 'advance_booked_seats'}, function(data2) {
    	    
    		var a_booked_seats = data2;
    		//console.log(data2);
			for	(var key in a_booked_seats) {
				var a_row_seats = a_booked_seats[key].advance_b_seats_number;
					var a_single_row = $.map(a_row_seats, function(value, index) {
				 	   return [value];
					});
    			
    				for	(i = 0; i < a_single_row.length; i++) {
    					advance_booked_seats_array.push(a_single_row[i]);
						}
    				}
    				
    		
    	//end all advanced booked seats array from booking

    	//get all session seats
    	$.post('ajax.php', {'action': 'g_previous_sess'}, function(datas) {
    		var sess_seats = datas;
    		for	(var key in sess_seats) {
    			var sess_row_seats = sess_seats[key].posted_seats;
    			
    			sess_seats_array.push(sess_row_seats);
    			
    		}
    		//console.log(sess_seats_array);
    	
    	//end get all session seats

    	//get all booked seats array from booking
    	
    	$.post('ajax.php', {'showtime_id': showtime_id, 'action': 'booked_seats'}, function(data1) {
    	    //console.log(data1);
    		var booked_seats = data1;
			for	(var key in booked_seats) {
				var row_seats = booked_seats[key].booking_seats_number;
					var single_row = $.map(row_seats, function(value, index) {
				 	   return [value];
					});
    			
    				for	(i = 0; i < single_row.length; i++) {
    					booked_seats_array.push(single_row[i]);
						}
    				}
    		
    	//end get all booked seats array from booking

		

    	//get all locked seats
    	$.post('ajax.php', {'selected_show': showtime_id, 'action': 'seat_avail'}, function(data4){
    		if(data4.locked_seat_name){locked_seats_array = JSON.parse(data4.locked_seat_name);}
    		// console.log(sess_seats_array);
    		// console.log(locked_seats_array);
    	//end locked seats
    	
    	var indexrow;
    	var indexcolumn;
    	var offsetclass = '';
    	var checked='';
    	var thisclass ='';
    	var seats_img = 'assets/images/empty_seats.png';
    	movie_id = data.movie_id
    	var text = '<div><div class="alert alert-danger" id="locked_warning" style="display:none;" role="alert">This Seat has already selected!</div><input type="hidden" id="selected_show" value="'+data.showtime_id+'"><input type="hidden" id="ticket_type" value="'+data.showtime_ticket_type+'"><input type="hidden" id="selected_movie_title" value="'+data.movie_title+'"><input type="hidden" id="selected_movie_id" value="'+data.movie_id+'"><input type="hidden" id="selected_dist_id" value="'+data.movie_distributer_id+'"> <input type="hidden" id="selected_showtime_key" value="'+data.showtime_key+'">';
		if(screen_id==30){
			for	(indexrow = 0; indexrow < rows.length; indexrow++) {
				var currentrow = rows[indexrow];
				var columnlenght = rowcolumn[indexrow];
				text +='<div class="row flex-seat">';
				for	(indexcolumn = 1; indexcolumn <= columnlenght; indexcolumn++) {
				if(((currentrow == 'G') || (currentrow == 'E') ) && (indexcolumn == 1) ){offset2 = 'col-sm-offset-2';}else{offset2 ='';}
				if(((currentrow == 'F'))&& (indexcolumn == 1) ){offset1 = 'col-sm-offset-1';}else{offset1 ='';}
				if((currentrow == 'C') && (indexcolumn == 1) ){offset2_2 = 'col-sm-offset-2';}else{offset2_2 ='';}
				if((currentrow == 'A') && (indexcolumn == 4) ){offset3_2 = 'col-sm-offset-3';}else{offset3_2 ='';}
				var seatscode = rows[indexrow] + '-' + indexcolumn;
				if($.inArray(seatscode, booked_seats_array) > -1){  checked = 'checked  disabled'; seats_img = 'assets/images/selected_seats.png'; thisclass='booked';}
				else if($.inArray(seatscode, advance_booked_seats_array) > -1){  checked = 'checked ="true"  disabled'; seats_img = 'assets/images/advance_seats.png'; thisclass='advance';}
				else if($.inArray(seatscode, sess_seats_array) > -1){checked = '';seats_img = 'assets/images/selecting_seats.png'; thisclass='normal';}
				else if($.inArray(seatscode, locked_seats_array) > -1){checked = 'checked ="true"  disabled'; seats_img = 'assets/images/hold_seats.png'; thisclass='normal';}
				else{checked = '';seats_img = 'assets/images/empty_seats.png'; thisclass='normal';}
				text +='<div class="col-sm-1 seats nopadding '+ offset2 + offset1 + offset2_2 + offset3_2 +'">';
				text += '<img src="'+seats_img+'">';
				text += '<div class="checkbox">';
				text += '<label>';
				text += '<input type="checkbox"  name="seats[]" value="' + rows[indexrow] + '-' + indexcolumn + '" ' +checked+' class="' +thisclass+'">';
			    text += ''+rows[indexrow] + '-' + indexcolumn+'';
			    text += '</label>';
			    text += '</div>';
			    text += '</div>';
				}
			    text += '</div>';
			   
			}
		}else{
			for	(indexrow = 0; indexrow < rows.length; indexrow++) {
				var currentrow = rows[indexrow];
				var columnlenght = rowcolumn[indexrow];
				text +='<div class="row flex-seat">';
				for	(indexcolumn = 1; indexcolumn <= columnlenght; indexcolumn++) {
				if((screen_id==27)&&(currentrow == 'A') && (indexcolumn == 5) ){offsetclass = 'col-sm-offset-3';}else{offsetclass ='';}
				var seatscode = rows[indexrow] + '-' + indexcolumn;
				if($.inArray(seatscode, booked_seats_array) > -1){  checked = 'checked onclick="return false" disabled'; seats_img = 'assets/images/selected_seats.png'; thisclass='booked';}
				else if($.inArray(seatscode, advance_booked_seats_array) > -1){  checked = 'checked ="true" disabled'; seats_img = 'assets/images/advance_seats.png'; thisclass='advance';}
				else if($.inArray(seatscode, sess_seats_array) > -1){checked = '';seats_img = 'assets/images/selecting_seats.png'; thisclass='normal';}
				else if($.inArray(seatscode, locked_seats_array) > -1){checked = 'checked ="true"  disabled'; seats_img = 'assets/images/hold_seats.png'; thisclass='normal';}
				else{checked = '';seats_img = 'assets/images/empty_seats.png'; thisclass='normal';}
				text +='<div class="col-sm-1 seats nopadding '+ offsetclass +'">';
				text += '<img src="'+seats_img+'">';
				text += '<div class="checkbox">';
				text += '<label>';
				text += '<input type="checkbox"  name="seats[]" value="' + rows[indexrow] + '-' + indexcolumn + '" ' +checked+' class="' +thisclass+'">';
			    text += ''+rows[indexrow] + '-' + indexcolumn+'';
			    text += '</label>';
			    text += '</div>';
			    text += '</div>';
				}
			    text += '</div>';
			   
			}
		}//else
		
		text += '</div>';
		//console.log(text);
		document.getElementById("seats-container").innerHTML = text;
		var defaultempty = $("img[src='assets/images/empty_seats.png']").length;
		var defaultselected = $("img[src='assets/images/selected_seats.png']").length;
		$('#complimentary').attr('checked', false);

		if(data.showtime_complimentry_seats == "yes"){
			$(".complimentary").show();
			
		}
			else{
			$(".complimentary").hide();
			
		}
		
		$('#empty_badge').text(defaultempty);
		$('#selected_badge').text(defaultselected);
		
		$(".seats input[type='checkbox']").click(function(){	
			var imgsselecting = $("img[src='assets/images/selecting_seats.png']").length;
			var imgempty = $("img[src='assets/images/empty_seats.png']").length;
			

			imagePath = $(this).parent().parent().parent().find('img').attr("src");
			//alert(imagePath);
		if(imagePath == "assets/images/selecting_seats.png"){
			
			$('#selecting_badge').text(imgsselecting-1);
			$('#empty_badge').text(imgempty+1);
			$(this).parent().parent().parent().find('img').attr("src", "assets/images/empty_seats.png");

		}else if(imagePath == "assets/images/empty_seats.png"){
			
			$('#selecting_badge').text(imgsselecting+1);
			$('#empty_badge').text(imgempty-1);
			$(this).parent().parent().parent().find('img').attr("src", "assets/images/selecting_seats.png");
	    	}
		
		});//seats input[type='checkbox']

$.post('ajax.php', {'sc_id': id,'mv_id': movie_id, 'action': 'set_screen_id'}, function(data) {});
	console.log(data);
	var l_width = screen.availWidth;
	var l_height = screen.availHeight;
	 window.open("user_booking_screen.php?show="+id+"&movie="+movie_id, "Cinema", "width="+l_width+",height="+l_height);
	//win.close();
	//launchApplication('http://localhost/cinema/user_booking_screen.php?show='+id, 'Cinema');
		
		});//ajax
});
});//ajax
});//ajax
});//ajax
		

    });//button click

	 $("#seats-container").on('click','.seats input[type="checkbox"]',function() {
	 	var imgsselecting = $("img[src='assets/images/selecting_seats.png']").length;
	 	var show_id = $('#selected_show').val();
	 	var current_val = $(this).val();
	 	var currentelement = $(this);
	 	var initial_seats = new Array();
	 	console.log(show_id);
	 	if (this.checked) {
	    		$.post('ajax.php', {'selected_show': show_id, 'action': 'seat_avail'}, function(data){			    
		    	//console.log(data);
		        if(data.locked_seat_name){initial_seats = JSON.parse(data.locked_seat_name);}
		    	if($.inArray(current_val, initial_seats) > -1){
		    		//console.log('foundvalue');
		    		currentelement.addClass('uncheck');
		    		currentelement.parent().parent().parent().find('img').attr("src", "assets/images/hold_seats.png");
		    		currentelement.parent().parent().parent().find('img').css('opacity', '0.5');
		    		$('.uncheck').attr('checked', false);
		    		$('.uncheck').attr('readonly', 'readonly');
		    		if(imgsselecting != 0){
		    		$('#selecting_badge').text(imgsselecting-1);}
		    		$('#locked_warning').fadeIn('slow').delay(1000).fadeOut('slow');

		    		return false;

		  			}else{
		  				//console.log('notfoundvalue');
		  				//console.log(data.locked_seat_name);
		  			
		  			if(initial_seats != null){
					 initial_seats.push(current_val);
		  			}else{
		  			initial_seats= [current_val];
		  			}
		  		    //console.log(initial_seats);
		  			$('#locked_warning').hide();
		    		$('.uncheck').attr('checked', true);
		    		currentelement.removeClass('uncheck');
		    		$.post('ajax.php', {'show': show_id,'initial_seats': initial_seats, 'action': 'lock_seats'}, function(data){

		    		});
		    	}
		    });
	    }else{
	    	//console.log('when uncheck');
	    	$.post('ajax.php', {'selected_show': show_id, 'action': 'seat_avail'}, function(data){
	    		console.log(data);
	    		if(data.locked_seat_name){initial_seats = JSON.parse(data.locked_seat_name);}
	    		var thisindex = $.inArray(current_val, initial_seats);
	    		if($.inArray(current_val, initial_seats) > -1) {
	    			initial_seats.splice(thisindex,1);
	    			//console.log(initial_seats);
	    		}
	    		
	    		$.post('ajax.php', {'show': show_id,'initial_seats': initial_seats, 'action': 'lock_seats'}, function(data){

		    	});
	    	});
	    }
	  });

//release advance checkbox
$("#release_booked_s").click(function () {
        if ($(this).is(':checked')) {
            $("#seats-container .advance").each(function () {
                $(this).prop("checked", false);
                $(this).attr("disabled", false);
            });

        } else {
            $("#seats-container .advance").each(function () {
                $(this).prop("checked", true);
                $(this).attr("disabled", true);
            });
        }
    }); //release advance checkbox

$(".seats_btn_cancel").click(function(){
	var shw_id = $('#selected_show').val();
	var cancel_seats = [];
	$.each($(".seats input[type='checkbox']:not(:disabled)"), function(){  
            if (this.checked) {          
                cancel_seats.push($(this).val());
                $(this).prop("checked", false);
            }
            });

			$.post('ajax.php', {'selected_show': shw_id, 'action': 'seat_avail'}, function(data){
				//console.log(data);
				if(data.locked_seat_name){initial_seats = JSON.parse(data.locked_seat_name);}
				console.log(initial_seats);
				var difference_array = [];

				jQuery.grep(initial_seats, function(el) {
				        if (jQuery.inArray(el, cancel_seats) == -1) difference_array.slice(el);
				});
				console.log(difference_array);
				
				
				$.post('ajax.php', {'show': shw_id,'initial_seats': difference_array, 'action': 'lock_seats'}, function(data){

		    	});
	
			});
		});

 	var recent_seats = [];
	
	$('.container').on('click','#seats_btn',function(){
		$("#release_booked_s").prop("checked", false);
		var shw_id = $('#selected_show').val();
		var movie_id = $('#selected_movie_id').val();
		var d_id = $('#selected_dist_id').val();
		
		var movie_title = $('#selected_movie_title').val();
		var ticket_id = $('#ticket_type').val();
		var ticket_price = 0;
		var ticket_adult = $("input[name='ticket_adult']:checked").val()
		var posted_seats = [];
		var allow_comp = "no";
		var ticket_type = "";
		var shw_key = $('#selected_showtime_key').val();

            $.each($(".seats input[type='checkbox']:not(:disabled)"), function(){  
            if (this.checked) {          
                posted_seats.push($(this).val());
            }
            });
            
          if($('#complimentary').is(":checked")){          
                allow_comp = "yes";
           	   }else{
           	   		allow_comp = "no";
           	   }
       

			$.post('ajax.php', {'posted_seats': posted_seats, 'show_id': shw_id,'action': 'recent_selected_seats'}, function(data){
			recent_seats = data;
			console.log(recent_seats);
			});
		   
			var qty = 1;
			$.post('ajax.php', {'getticket': ticket_id, 'action': 'get_ticket_detail'}, function(data) {
			console.log(data);
			if(allow_comp == "yes"){
				ticket_price = 0;
				if(ticket_adult == 'yes'){ 
					ticket_type="adult price";
				}else{ 
					ticket_type="child price";

				}
			}else{
				
				if(ticket_adult == 'yes'){ 
					ticket_price = data.ticket_adult_price; 
					ticket_type="adult price";
				}else{ 
					ticket_price = data.ticket_child_price;
					ticket_type="child price";

				}
			}
			
			
			var sum = ticket_price*qty;
			
			for	(indexrow = 0; indexrow < posted_seats.length; indexrow++) {
		    var terminal_text ='<div class="terminal_item add-movie-item add-deals-item">';
		    terminal_text += '<div class="col-md-5 col-sm-5 add-movie-item-name">';
		    terminal_text += '<input type="hidden" value="'+shw_id+'" class="terminal_m_show_id">';
		    terminal_text += '<input type="hidden" value="'+ticket_id+'" class="terminal_m_ticket_id">';
		    terminal_text += '<input type="hidden" value="'+ticket_type+'" class="terminal_m_ticket_type">';
		    terminal_text += '<input type="hidden" value="'+allow_comp+'" class="terminal_m_is_comp">';
		    terminal_text += '<input type="hidden" value="'+shw_key+'" class="terminal_m_show_key">';
		    terminal_text += '<p><strong>'+movie_title+'</strong></p>';
		    terminal_text += '<input type="hidden" value="'+movie_id+'" class="terminal_m_id">';
		    terminal_text += '<input type="hidden" value="'+d_id+'" class="terminal_d_id">';
		    terminal_text += '</div>';
			terminal_text += '<div class="col-md-3 col-sm-3 add-deal-item-value">';
			terminal_text += '<p>'+posted_seats[indexrow]+'</p>';
			terminal_text += '<input type="hidden" value="'+posted_seats[indexrow]+'" class="terminal_m_seats">';
			terminal_text += '</div>';
			terminal_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			terminal_text += '<p>'+ticket_price+' x '+qty+'</p>';
			terminal_text += '<input type="hidden" value="'+ticket_price+'" class="terminal_m_price">';
			terminal_text += '<input type="hidden" value="'+qty+'" class="terminal_m_qty">';
			terminal_text += '</div>';
			terminal_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			terminal_text += '<p><img class="img-responsive ticket_delete" src="assets/images/delete_icon.png" style="width:12px;">'+sum+'';
			terminal_text += '<input type="hidden" value="'+sum+'" class="terminal_m_sum"></p>';
			terminal_text += '</div>';
			terminal_text += '</div>';

			$.post('ajax.php', {'s_shw_id': shw_id,'s_ticket_id': ticket_id,'s_ticket_type':ticket_type,'s_allow_comp':allow_comp,'s_shw_key':shw_key,'s_movie_title':movie_title,'s_movie_id':movie_id,'s_d_id':d_id,'s_posted_seats':posted_seats[indexrow],'s_ticket_price':ticket_price,'s_qty':qty,'s_sum':sum, 'action': 'terminal_sess'}, function(data) {
			
		    });

			$.post('ajax.php', {'t_seats': posted_seats[indexrow],'t_price': ticket_price,'t_total':sum, 'action': 'print_booking_detail'}, function(data) {
			console.log(data);
		    });

		   $(terminal_text).appendTo('#terminal').find('.terminal_item');

		   

		   }
		   
		  // $('.book-ticket-btn').prop('disabled', true);
		  subtotalcalc();
		  $('.expression1').focus();
			     
			   
		  });
	

		
 		//delete ticket terminal list
 		
 		

 		

	    
	});

$("#terminal").on('click', '.ticket_delete', function() {
 				var deleted_seat = $(this).parents('.add-deal-item-value').parent('.add-movie-item').find('.terminal_m_seats').val();
 				var deleted_show_id = $(this).parents('.add-deal-item-value').parent('.add-movie-item').find('.terminal_m_show_id').val();
 				
 				
 			    

 				$(this).parents('.add-deal-item-value').parent('.terminal_item').remove();
 				var deleted_seats_array = deleted_seat.split(",");
 				//console.log(deleted_seats_array);
				

				$.post('ajax.php', {'selected_show': deleted_show_id, 'action': 'seat_avail'}, function(data){
	    		//console.log(data);
	    		if(data.locked_seat_name){initial_seats = JSON.parse(data.locked_seat_name);}
	    		console.log(initial_seats);
	    		var difference_array = [];

				jQuery.grep(initial_seats, function(el) {
				        if (jQuery.inArray(el, deleted_seats_array) == -1) difference_array.push(el);
				});
				console.log(difference_array);
	    		
	    		
	    		$.post('ajax.php', {'show': deleted_show_id,'initial_seats': difference_array, 'action': 'lock_seats'}, function(data){

		    	});

	    	});
				subtotalcalc();
			});
 	//all delete function
 		$(".all_delete").click(function(){
 			$('.book-ticket-btn').prop('disabled', false);
 			$(".terminal_item").each(function() {

 						var deleted_show_id = $(this).find('.terminal_m_show_id').val();
						var deleted_seat = $(this).find('.terminal_m_seats').val();
						subtotalcalc();
						console.log(deleted_show_id);
						console.log(deleted_seat);
		 				
		 				
		 			    $(this).remove();
		 				var deleted_seats_array = deleted_seat.split(",");
		 				//console.log(deleted_seats_array);
						

						$.post('ajax.php', {'selected_show': deleted_show_id, 'action': 'seat_avail'}, function(data){
			    		//console.log(data);
			    		if(data.locked_seat_name){initial_seats = JSON.parse(data.locked_seat_name);}
			    		console.log(initial_seats);
			    		var difference_array = [];

						jQuery.grep(initial_seats, function(el) {
						        if (jQuery.inArray(el, deleted_seats_array) == -1) difference_array.slice(el);
						});
						console.log(difference_array);
			    		
			    		
			    		$.post('ajax.php', {'show': deleted_show_id,'initial_seats': difference_array, 'action': 'lock_seats'}, function(data){

				    	});

			    		});
			    		<?php //unset($_SESSION['terminal_list']); ?>
			    		<?php //unset($_SESSION['all_previous_list']); ?>
					});

				
				var test = "hi";
					$.post('ajax.php', {'test_t': test, 'action': 'end_pre_list_sess'}, function(data){
					});
		    	
 				subtotalcalc();
 				$('.expression1').val(0);
 				$('.expression2').val(0);
 				
 				
			});


 		

	$("#final_booking").click(function(){

		var testt = "hi";
			$.post('ajax.php', {'test_t': testt, 'action': 'end_print_ticket_sess'}, function(data){
			});

 		$(".terminal_item").each(function() {
 				var initial_seats = new Array();
 				var this_b_show_id = $(this).find('.terminal_m_show_id').val();
				var this_b_ticket_id = $(this).find('.terminal_m_ticket_id').val();
				var this_b_ticket_type = $(this).find('.terminal_m_ticket_type').val();
				var this_b_is_com = $(this).find('.terminal_m_is_comp').val();
				var this_b_d_id = $(this).find('.terminal_d_id').val();
				var this_b_m_id = $(this).find('.terminal_m_id').val();
				initial_seats = $(this).find('.terminal_m_seats').val();
				var this_b_seats = initial_seats.split(",");
				var this_b_seats_qty = $(this).find('.terminal_m_qty').val();
				var this_b_amount = $(this).find('.terminal_m_price').val();
				var total_amount = $('#ticket_total').val();

				
				$(this).remove();

				

				$.post('ajax.php', {'s_show_id': this_b_show_id,'s_ticket_id': this_b_ticket_id,'s_ticket_type': this_b_ticket_type,'s_comp': this_b_is_com,'s_d_id': this_b_d_id,'s_m_id': this_b_m_id,'s_seats': this_b_seats, 's_seats_qty': this_b_seats_qty,'s_seats_amount': this_b_amount,'action': 'booking_r'}, function(data){
					console.log(data);
					
					window.open("book_ticket.php", "width=800, height=600");
				    	 
				    	 });
				
				var test = "hi";
					$.post('ajax.php', {'test_t': test, 'action': 'end_pre_list_sess'}, function(data){
					});
				
		 		});

 			
 			$('.book-ticket-btn').prop('disabled', false);
 		});  //final_booking

 	function subtotalcalc (event) {
                	//alert('Press Hit Button');
                	// Sub Total All Amount Table and save in subtotal variable
                	var subtotal = 0;
				    $('.terminal_m_sum').each(function() {
				        subtotal += parseFloat($(this).val());
				    });
				    // Display Value to Sub Total Amount
				    $(".total-amount-value").text('Rs.'+parseFloat(subtotal).toFixed(2));
				    $("#ticket_total").val(parseFloat(subtotal).toFixed(2));
			}

	$(".calculate").click(function(){
		 var returnamount =  $(".expression1").val() - $("#ticket_total").val();
		 $(".expression2").val(returnamount);
	});
subtotalcalc();

});//end document ready
	</script>
</div>
<div class="container footer-container">
    <div class="row">
		<div class="copyright">
			<div class="col-md-6 col-sm-6">
				<p>Copyright: 2015 Designed and Developed by: WEBNET</p>
				<?php //echo $mydate = '26-08-2015'; 
				//echo $showtime->_date('Y,m,d,H,i,s', $mydate); ?>
			</div>
			
			
			<div class="col-md-6 col-sm-6 powerdby">
				<a href=""><img  width="110px" src="assets/images/powered_logo.png"/></a>
			</div><!-- col-md-4-->
			
		</div><!-- copyright -->
   </div><!-- row -->
   <!--/footer-->
   
   </div><!-- container -->
   
 <?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
     require_once 'footer.php'; 
	}
?>
