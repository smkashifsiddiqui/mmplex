<?php require_once 'header-dashboard.php'; ?>
<?php $page = "advance";?>	
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_adv_ticket', $user_capabilities)){	
	$booking = new booking();	
	$settings = new setting();
	$settings_result = $settings->get_popup_status();
	
	if(in_array('book_adv_ticket', $user_capabilities)){
		echo '<input type="hidden" class="is_popup" value ="yes">';
	}else{
		echo '<input type="hidden" class="is_popup" value ="yes">';
	}
	
	
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
								
								//print_f($_SESSION['all_previous_list'][0]['shw_id']);
								if ($all_movies) { ?>
								<?php foreach($all_movies as $movie){
									$display_movie = false;
									$movie_id = $movie->movie_id;
									$all_showtimes = $booking->get_booking_showtimes($movie_id);

									?>
									<?php foreach($all_showtimes as $showtime){
												 
												
												$today_date = (strtotime($current_compare)-(60*60*1.5));
												$this_date = strtotime($showtime->showtime_datetime); 
												
												if($today_date < $this_date){
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
									
									<div class="movie-venue col-md-12 nopadding item_height" >
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
													  $today_date = (strtotime($current_compare)-(60*60*1.5));
													
 // $today_date = strtotime(date("Y-m-d"));
													  $this_date = strtotime($showtime->showtime_datetime); 
													if($today_date < $this_date){
													 	
													 
													 $start_time_ini = $showtime->showtime_datetime;
													 $start_time =  date('d-M  h:i A', strtotime($start_time_ini));
													 $week_day =  date('l', strtotime($start_time_ini));
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
													<div class="col-md-2 col-sm-2 venue cinema-name-odd"><p><?php echo $start_time; ?></p><p><?php echo $week_day; ?></p></div>
													<div class="col-md-2 col-sm-2 venue"><p style="line-height: 34px;"><?php echo $showtime->screen_name; ?></p></div>
													<div class="col-md-2 col-sm-2 venue"><p style="line-height: 34px;"><?php echo $total_booked_s; ?></p></div>
													<div class="col-md-2 col-sm-2 venue"><p style="line-height: 34px;"><?php echo $all_remaining_seats; ?></p></div>
													<div class="col-md-2 col-sm-2 venue  vanue-plus">
													<?php  if(isset($_SESSION['all_previous_list'])){$session_show_id = $_SESSION['all_previous_list'][0]['shw_id'];}else{$session_show_id = $s_id; }?>
													 <button class="btn btn-default book-ticket-btn screen_id_btn" <?php if($session_show_id != $s_id){echo 'disabled= true';}else{echo '';} ?> id="book_btn<?php echo $s_id; ?>" data-toggle="modal" data-target="#fsModal" <?php if($all_remaining_seats == 0){echo 'style="background-color:red!important;"';}?>>
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
							<p>Book Tickets in Advanced  (on particular basis)</p>
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
							<div class="col-md-12 col-sm-12" style="padding:5px;">
								<p>Booking Description</p>
							</div><!-- col-md-9-->
						</div><!-- col-md-3-->
						
						
						
					
					</div><!-- deal-bg-->
					
					<div class="clear"></div>
						
					<div class="function-bg">
					
						<div class="col-md-3 col-sm-3 function-bg-br">
							<img width="25px" id="all_delete" class="img-responsive" src="assets/images/delete_icon.png"/>
							 Reset
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
						<a href="">Cancel </a>
							<button class="btn btn-default save-btn" id="final_booking" type="button" >
								Save Changes
							</button>
						</div>
								
						
					</div><!-- ticket-type-btn-->
						<div id="saved" class="alert alert-success" role="alert" style="display:none;"> Booking added Sucessfully </div>
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
 <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

	<script>
	$( document ).ready(function() {
		var diabled_popup = $('.is_popup').val();

		var refresh = false;
		setInterval(function() {
			if(refresh == false){
				window.location.reload(1);
			}
		  // After 5 secs
		  }, 5000);
		  
		
		
		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});

		var now_showing = $(".movie_list").size();
		 
		 $(".now-showing .badge").html(now_showing);
	
		$( ".movie-detail-btn" ).click(function() {
			refresh = true;
		  $(this).parent().parent().find(".movie-venue").toggle("slow");
		});

		$( ".movie-select-btn" ).click(function() {
		
		  $(this).parent().parent().find(".movie-venue").toggle("slow");
		});

		$(".item_height").mCustomScrollbar({
			setHeight:200,
			theme:"inset-2-dark"
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
    	   
			
			if(data2.length != 0){
			console.log('advanc array not empty');
			console.log(data2);
			 
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
    		}		
    		else{
			console.log('advanc array is empty');
			console.log(advance_booked_seats_array);
			}
    	//end all advanced booked seats array from booking

    	//get all session seats
    	$.post('ajax.php', {'action': 'g_previous_sess'}, function(datas) {
			
			if(datas != null){
				console.log('seat session is not empty');
				console.log(datas);
				var sess_seats = datas;
				for	(var key in sess_seats) {
					var sess_row_seats = sess_seats[key].posted_seats;
					
					sess_seats_array.push(sess_row_seats);
					
				}
			}else{
			
    		console.log('seat session is  empty');
		    console.log(sess_seats_array);
    	 }
    	//end get all session seats

    	//get all booked seats array from booking
    	
    	$.post('ajax.php', {'showtime_id': showtime_id, 'action': 'booked_seats'}, function(data1) {
    	    
			if(data1.length != 0){
			console.log('booked seats array not empty');
			console.log(data1);
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
    		}else{
			
			console.log('booked seats is  empty');
		    console.log(booked_seats_array);
			}
    	//end get all booked seats array from booking

		

    	//get all locked seats
    	$.post('ajax.php', {'selected_show': showtime_id, 'action': 'seat_avail_all'}, function(data4){
    		//if(data4.locked_seat_name){locked_seats_array = JSON.parse(data4.locked_seat_name);}
			console.log(data4);
			
			if(data4.length != 0 ){
			for	(i = 0; i < data4.length; i++) {
    			console.log(data4[i].locked_seat_name);
				locked_seats_array.push(data4[i].locked_seat_name);
			}
				console.log('locked seat array');
				console.log(locked_seats_array);
			
			}else{
				console.log('locked seat array is empty');
				console.log(locked_seats_array);
			}
    		
    	//end locked seats
    	
    	var indexrow;
    	var indexcolumn;
    	var offsetclass = '';
    	var checked='';
    	var thisclass ='';
    	var seats_img = 'assets/images/empty_seats.png';
    	movie_id = data.movie_id
    	var text = '<div><div class="alert alert-danger" id="locked_warning" style="display:none;" role="alert">This Seat has already selected!</div><input type="hidden" id="selected_show" value="'+data.showtime_id+'"><input type="hidden" id="ticket_type" value="'+data.showtime_ticket_type+'"><input type="hidden" id="selected_movie_title" value="'+data.movie_title+'"><input type="hidden" id="selected_movie_id" value="'+data.movie_id+'"><input type="hidden" id="selected_dist_id" value="'+data.movie_distributer_id+'"> <input type="hidden" id="selected_showtime_key" value="'+data.showtime_key+'">';
		text += '<div class="col-sm-12"><div class="col-sm-4"><strong>Movie: <span style="color: #B90100;">'+data.movie_title+'</span></strong></div><div class="col-sm-4"><strong>Show Time: <span style="color: #B90100;">'+data.showtime_datetime+'</span></strong></div><div class="col-sm-4"><strong>Screen: <span style="color: #B90100;">'+data.screen_name+'</span></strong></div></div><br/><br/>';
		for	(indexrow = 0; indexrow < rows.length; indexrow++) {
				var currentrow = rows[indexrow];
				var columnlenght = rowcolumn[indexrow];
				text +='<div class="row flex-seat">';
				for	(indexcolumn = 1; indexcolumn <= columnlenght; indexcolumn++) {
				if((screen_id==27)&&(currentrow == 'A') && (indexcolumn == 5) ){offsetclass = 'col-sm-offset-3';}else{offsetclass ='';}
				var seatscode = rows[indexrow] + '-' + indexcolumn;
				if($.inArray(seatscode, booked_seats_array) > -1){  checked = 'checked onclick="return false" disabled'; seats_img = 'assets/images/selected_seats.png'; thisclass='booked';}
				else if($.inArray(seatscode, advance_booked_seats_array) > -1){  checked = 'checked ="true" disabled'; seats_img = 'assets/images/advance_seats.png'; thisclass='advance';}
				else if($.inArray(seatscode, sess_seats_array) > -1){checked = 'checked ="true"';seats_img = 'assets/images/selecting_seats.png'; thisclass='normal';}
				else if($.inArray(seatscode, locked_seats_array) > -1){checked = ''; seats_img = 'assets/images/hold_seats.png'; thisclass='normal locked';}
				else{checked = '';seats_img = 'assets/images/empty_seats.png'; thisclass='normal';}
				text +='<div class="col-sm-1 seats nopadding '+ offsetclass +'">';
				text += '<div class="checkbox">';
				text += '<label style="text-transform:uppercase;">';
				text += '<img src="'+seats_img+'">';
				text += '<input type="checkbox"  name="seats[]" value="' + rows[indexrow] + '-' + indexcolumn + '" ' +checked+' class="' +thisclass+'">';
			    text += ''+rows[indexrow] + '-' + indexcolumn+'';
			    text += '</label>';
			    text += '</div>';
			    text += '</div>';
				}
			    text += '</div>';
			   
			}
		
		
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
		
	var l_width = screen.availWidth;
	var l_height = screen.availHeight;
	if(diabled_popup == 'no'){
		var myWindow1 = window.open("user_booking_screen.php?show="+id+"&movie="+movie_id, "Cinema", "width="+l_width+",height="+l_height);
	}
		});//ajax
});
});//ajax
});//ajax
});//ajax
		

    });//button click

	  $("#seats-container").on('click','.seats input[type="checkbox"]',function() {
		$("#hack").show(0);
		//$(".seats input[type='checkbox']").attr("disabled","disabled");
	 	var imgsselecting = $("img[src='assets/images/selecting_seats.png']").length;
		var imgempty = $("img[src='assets/images/empty_seats.png']").length;
	 	var show_id = $('#selected_show').val();
		var This = $(this);
	 	var current_val = $(this).val();
	 	var currentelement = $(this);
	 	var initial_seats = new Array();
		var c_seats = new Array();
	 	console.log(show_id);
	 	if (this.checked) {
	    		$.post('ajax.php', {'selected_show': show_id, 'action': 'seat_avail_all'}, function(data4){
				
		    	if(data4.length != 0 ){
			for	(i = 0; i < data4.length; i++) {
    			console.log(data4[i].locked_seat_name);
				initial_seats.push(data4[i].locked_seat_name);
			}
				console.log('locked seat array');
				console.log(initial_seats);
			
			}else{
				console.log('locked seat array is empty');
				console.log(initial_seats);
			}
				
		        //if(data.locked_seat_name){initial_seats = JSON.parse(data.locked_seat_name);}
		    	
			if($.inArray(current_val, initial_seats) > -1){
		    		//console.log('foundvalue');
		    		currentelement.addClass('uncheck');
		    		currentelement.parent().parent().parent().find('img').attr("src", "assets/images/hold_seats.png");
		    		
		    		$('.uncheck').attr('checked', false);
					This.addClass('locked');
		    		
		    		if(imgsselecting != 0){
		    		$('#selecting_badge').text(imgsselecting-1);}
		    		$('#locked_warning').fadeIn('slow').delay(1000).fadeOut('slow');
					$("#hack").hide(0);
					//$(".seats input[type='checkbox']").removeAttr("disabled");
		    		return false;
				
				}else{
		  				//console.log('notfoundvalue');
		  				//console.log(data.locked_seat_name);
		  			 //console.log(initial_seats);
		  			$('#locked_warning').hide();
		    		$('.uncheck').attr('checked', true);
		    		currentelement.removeClass('uncheck');
		    		$.post('ajax.php', {'show': show_id,'initial_seats': current_val, 'action': 'lock_seats_single'}, function(data){
						console.log(data);
						This.parent().find('img').attr("src", "assets/images/selecting_seats.png");
						This.parent().find('img').css('opacity', '1');
						This.addClass('current');
						This.removeClass('locked');
						$('#selecting_badge').text(imgsselecting+1);
						$('#empty_badge').text(imgempty-1);

						$("#hack").hide(0);
						//$(".seats input[type='checkbox']").removeAttr("disabled");
		    		});
		    	$("#hack").hide(0);
				}
				
		    });
	    }else{
	    	//console.log('when uncheck');
	    	
				//c_seats = current_val;
				console.log(current_val);
	    		$.post('ajax.php', {'show': show_id,'initial_seats': current_val, 'action': 'delete_lock_s'}, function(data){
					console.log(data);
					This.parent().find('img').attr("src", "assets/images/empty_seats.png");
					This.removeClass('current');
					$('#selecting_badge').text(imgsselecting-1);
					$('#empty_badge').text(imgempty+1);
					$("#hack").hide(0);
		    	});
				
				//$(".seats input[type='checkbox']").removeAttr("disabled");
				
			
	    	
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
	var selector = $('.seats .current');
	i = 0;
	if(selector.length != 0){
	$('.seats .current').each(function () {
              if (this.checked) { 
				 i += 1;
			  $("#hack").show(0);
				var current_val = $(this).val();
				var Thiss = $(this);
                $.post('ajax.php', {'show': shw_id,'initial_seats': current_val, 'action': 'delete_lock_s'}, function(data){
					console.log(data);
					Thiss.removeClass('current');
					Thiss.prop("checked", false);
					
		    	});
				
				if(i == selector.length) {
					$("#hack").hide(0);
					 $('#fsModal').modal('hide');
				  }
               
            }
    });
	 
	}else{
		$("#hack").hide(0);
		 $('#fsModal').modal('hide');
	}
	
	var l_width = screen.availWidth;
		var l_height = screen.availHeight;
		if(diabled_popup == 'no'){
			var myWindow1 = window.open("user_booking_screen.php", "Cinema", "width="+l_width+",height="+l_height);
		}
});

 	var recent_seats = [];
	$(".seats_btn").click(function(){
		var shw_id = $('#selected_show').val();
		var movie_id = $('#selected_movie_id').val();
		var movie_title = $('#selected_movie_title').val();
		var movie_dist = $('#selected_dist_id').val();
		var ticket_id = $('#ticket_type').val();
		var ticket_price = 0;
		var ticket_adult = $("input[name='ticket_adult']:checked").val()
		var posted_seats = [];
		var allow_comp = "no";
		var ticket_type = "";
		var shw_key = $('#selected_showtime_key').val();

           $.each($(".seats input[type='checkbox']:not(:disabled)"), function(){  
            if (this.checked) {       
					if (! $( this ).hasClass( "locked" ) ) {
					posted_seats.push($(this).val());
					}
				}
            });
            
          if($('#complimentary').is(":checked")){          
                allow_comp = "yes";
           	   }else{
           	   		allow_comp = "no";
           	   }
       

		   
			var qty = posted_seats.length;
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
			if(posted_seats.toString() != ""){

			var terminal_text ='<div class="booking_form">';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_name" class="col-sm-4 control-label"><span>*</span> Customer Name: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_name" id="customer_name" value="" class="form-control" required>';
			terminal_text +='</div></div></div>';
			terminal_text +='<div class="clear"></div>';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_phone" class="col-sm-4 control-label"><span>*</span>  Phone Number: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_phone" id="customer_phone" value="" class="form-control" required>';
			terminal_text +='</div></div></div>';
			terminal_text +='<div class="clear"></div>';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_email" class="col-sm-4 control-label"> Email: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_email" id="customer_email" value="" class="form-control" >';
			terminal_text +='</div></div></div>';
			terminal_text +='<div class="clear"></div>';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_movie" class="col-sm-4 control-label"><span>*</span> Movie: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_movie" id="customer_movie" value="'+movie_title+'" class="form-control" readonly required>';
			terminal_text +='</div></div></div>';
			terminal_text +='<div class="clear"></div>';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_seats" class="col-sm-4 control-label"><span>*</span> Seats Numbers: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_seats" id="customer_seats" value="'+posted_seats.toString()+'" class="form-control" readonly required>';
			terminal_text +='</div></div></div>';
			terminal_text +='<div class="clear"></div>';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_seats_price" class="col-sm-4 control-label"><span>*</span>  Quantity: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_seats_price" id="customer_seats_price" value="'+ticket_price+'" class="form-control" readonly required>';
			terminal_text +='</div></div></div>';
			terminal_text +='<div class="clear"></div>';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_seats_qty" class="col-sm-4 control-label"><span>*</span>  Quantity: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_seats_qty" id="customer_seats_qty" value="'+qty+'" class="form-control" readonly required>';
			terminal_text +='</div></div></div>';
			terminal_text +='<div class="clear"></div>';
			terminal_text +='<div class="col-md-offset-1 col-md-11">';
			terminal_text +='<div class="form-group">';
			terminal_text +='<label for="customer_amount" class="col-sm-4 control-label"><span>*</span> Booking Amount: </label>';
			terminal_text +='<div class="col-sm-7">';
			terminal_text +='<input type="text" name="customer_amount" id="customer_amount" value="'+sum+'" class="form-control" readonly required>';
			terminal_text +='</div></div></div>';
			terminal_text += '<input type="hidden" value="'+movie_id+'" class="terminal_m_id">';
			terminal_text += '<input type="hidden" value="'+movie_dist+'" class="terminal_d_id">';
			terminal_text +='<input type="hidden" name="customer_show_id" id="customer_show_id" value="'+shw_id+'" class="form-control" readonly required>';
			terminal_text +='<input type="hidden" name="customer_ticket_id" id="customer_ticket_id" value="'+ticket_id+'" class="form-control" readonly required>';
			terminal_text +='<input type="hidden" name="customer_ticket_type" id="customer_ticket_type" value="'+ticket_type+'" class="form-control" readonly required>';
			terminal_text +='<div id="booking_confilict" class="alert alert-danger" role="alert" style="display:none;clear: both;width: 80%;margin: auto;padding: 10px;margin-top: 10px;"> Kindly complete this booking detail first! </div>';
			terminal_text +='</div>';
			$(terminal_text).appendTo('#terminal').find('.terminal_item');
			$('.total-amount-value').text(sum);

		    }

		 	

		 	$('.screen_id_btn').prop('disabled', true);
		 	$('#customer_name').focus();
		 		
		  });
		  
		  var l_width = screen.availWidth;
		var l_height = screen.availHeight;
		if(diabled_popup == 'no'){
			var myWindow1 = window.open("user_booking_screen.php", "Cinema", "width="+l_width+",height="+l_height);
		}
	});

    	
 	//all delete function
 		$("#all_delete").click(function(){
 		
 			$('#booking_confilict').hide();
			var deleted_show_id = $('.booking_form').find('#customer_show_id').val();
			var deleted_seat = $('.booking_form').find('#customer_seats').val();
			
			console.log(deleted_show_id);
			console.log(deleted_seat);
				
				
			    $('.booking_form').remove();
			    $('.screen_id_btn').prop('disabled', false);
				var deleted_seats_array = deleted_seat.split(",");
				console.log(deleted_seats_array);
				
				for	(indexrow = 0; indexrow < deleted_seats_array.length; indexrow++) {
					 var thisdeleted_seat = deleted_seats_array[indexrow];
					 console.log(thisdeleted_seat);
					 
					 $.post('ajax.php', {'show': deleted_show_id,'initial_seats': thisdeleted_seat, 'action': 'delete_lock_s'}, function(data){
					 });
				}
				
			});
 		//all delete function end

 		$("#final_booking").click(function(){

 				var This =  $('.booking_form');
 				var cust_name1 = This.find('#customer_name').val();
 				var cust_phone1 = This.find('#customer_phone').val();
 				var cust_email1 = This.find('#customer_email').val();
 				var cust_show_id1 = This.find('#customer_show_id').val();
				var cust_ticket_id1 = This.find('#customer_ticket_id').val();
				var cust_ticket_type1 = This.find('#customer_ticket_type').val();
				var cust_m_id1 = This.find('.terminal_m_id').val();
				var cust_d_id1 = This.find('.terminal_d_id').val();
				var cust_seats_ini = This.find('#customer_seats').val();
				var cust_seats1 = cust_seats_ini.split(",");
				var cust_price1 = This.find('#customer_seats_price').val();
				var cust_seats_qty1 = This.find('#customer_seats_qty').val();
				if(cust_name1 != "" && cust_phone1 != ""){
				$('#booking_confilict').hide();
				
					$.post('ajax.php', {'cust_name': cust_name1,'cust_phone': cust_phone1,'cust_email': cust_email1,'cust_show_id': cust_show_id1,'cust_ticket_id': cust_ticket_id1, 'cust_ticket_type': cust_ticket_type1,'cust_m_id': cust_m_id1,'cust_d_id': cust_d_id1,'cust_seats': cust_seats1,'cust_seats_qty':cust_seats_qty1,'cust_price':cust_price1,'action': 'adv_book'}, function(data){
							console.log(data);
							 $('.screen_id_btn').prop('disabled', false);
							 $('#saved').fadeIn('slow').delay(1000).fadeOut('slow');
				    	 
				    	 });
				

			This.remove();
			$('.total-amount-value').text('0.00');
			}else{
				$('#booking_confilict').show();
			}
 				
 		}); //final_booking
			

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

