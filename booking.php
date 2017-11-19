<?php require_once 'header-dashboard.php'; ?>
<?php $page = "booking";?>	
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_ticket', $user_capabilities)){
	$booking = new booking();
	$settings = new setting();
	$settings_result = $settings->get_popup_status();
	
	if(in_array('book_ticket', $user_capabilities)){
		echo '<input type="hidden" class="is_popup" value ="yes">';
	}else{
		echo '<input type="hidden" class="is_popup" value ="yes">';
	}
	
	
	
?>
 
   <!--/header-->
  <!--main container-->
   <div class="container main-container" id="f_item_height">
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
												 
												$tdx=date("Y/m/d h:i");
												$today_date = (strtotime($current_compare));
												$this_date = strtotime($showtime->showtime_date); 
												if(($today_date == $this_date) || ($this_date > $today_date)){
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
														$today_date = (strtotime($current_compare));
														$this_date = strtotime($showtime->showtime_date); 
													if($today_date == $this_date || ($this_date > $today_date)){
													 	
													 
													 $start_time_ini = $showtime->showtime_datetime;
													 $start_time =  date('d-M h:i A', strtotime($start_time_ini));
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
													<div class="col-md-2 col-sm-2 venue cinema-name-odd"><p><?php echo $start_time;  ?></p><p><?php echo $week_day; ?></p></div>
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
								
							//print_f($_SESSION['all_previous_list']);

							foreach ($_SESSION['all_previous_list'] as  $value) {
								
							echo  '<div class="session_terminal terminal_item add-movie-item add-deals-item">';
						    echo  '<div class="col-md-5 col-sm-5 add-movie-item-name">';
						    echo  '<input type="hidden" value="'.$value['shw_id'].'" class="terminal_m_show_id">';
						    echo  '<input type="hidden" value="'.$value['ticket_id'].'" class="terminal_m_ticket_id">';
						    echo  '<input type="hidden" value="'.$value['ticket_type'].'" class="terminal_m_ticket_type">';
						    echo  '<input type="hidden" value="'.$value['allow_comp'].'" class="terminal_m_is_comp">';
						    echo  '<input type="hidden" value="'.$value['shw_key'].'" class="terminal_m_show_key">';
						    echo  '<p><strong>'.$value['movie_title'].'</strong></p>';
						    echo  '<input type="hidden" value="'.$value['movie_id'].'" class="terminal_m_id">';
							echo  '<input type="hidden" value="'.$value['movie_title'].'" class="terminal_m_title">';
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
					
						<div class="col-md-3 col-sm-3 function-bg-br" style="visibility:hidden;">
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
							<a href="reprint_last_ticket.php"><button class="btn btn-default save-btn" id="reprint-last-btn" type="button" >
								Print Recent Ticket
							</button></a>
						</div>
								
						<div class="col-md-6 col-sm-6 save-cancel">
						<!--<a class="all_delete" href="">Cancel </a>-->
						<button class="btn btn-default save-btn" id="print_tickets" type="button" >
								Save & Print
							</button>
							<button class="btn btn-default save-btn" id="final_booking" type="button" >
								View & Print
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
		 
		if(diabled_popup == 'no'){
			var l_width = screen.availWidth;
			var l_height = screen.availHeight;
			var myWindow1 = window.open("user_booking_screen.php", "Cinema", "width="+l_width+",height="+l_height);
		}
	
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
		
		 // $(this).parent().parent().find(".movie-venue").toggle("slow");
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
				text += '<label>';
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
				$('#reprint').attr('checked', false);
				$("#seats-container .normal").attr("disabled", false);
				$(".ticket_adult").attr("disabled", false);
				$("#complimentary").attr("disabled", false);
				$("#seats_btn").show();
				$(".seats_btn_cancel").show();
				$("#reprint_submit").hide();

		if(data.showtime_complimentry_seats == "yes"){
			$(".complimentary").show();
			
		}
			else{
			$(".complimentary").hide();
			
		}
		
		$('#empty_badge').text(defaultempty);
		$('#selected_badge').text(defaultselected);
		
		

$.post('ajax.php', {'sc_id': id,'mv_id': movie_id, 'action': 'set_screen_id'}, function(data) {});
	console.log(data);
if(diabled_popup == 'no'){
	var l_width = screen.availWidth;
	var l_height = screen.availHeight;
	var myWindow1 = window.open("user_booking_screen.php?show="+id+"&movie="+movie_id, "Cinema", "width="+l_width+",height="+l_height);
	//win.close();
	//launchApplication('http://localhost/cinema/user_booking_screen.php?show='+id, 'Cinema');
		
		}});//ajax
});
});//ajax
});//ajax
});//ajax
		

    });//button click

	 $("#seats-container").on('click','.seats input[type="checkbox"]',function() {
		if($('#reprint').is(":not(:checked)")){
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
			
			setTimeout(function(){
			  if( $("#hack").is(':visible') ){
				 
				  if($(This).is(':checked')){
					  $("#hack").hide(0);
					  $(This).prop( "checked", false );
					  $(This).trigger( "click" );
					 console.log('qundeel1');
				  }else{
					  $("#hack").hide(0);
					  $(This).trigger( "click" );
					  console.log('qundeel');
				  }
				  
			  }
			}, 7000);
			
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
	    	setTimeout(function(){
			  if( $("#hack").is(':visible') ){
				 
				  if(!$(This).is(':checked')){
					  $("#hack").hide(0);
					  $(This).prop( "checked", true );
					  $(This).trigger( "click" );
					 
				  }else{
					  $("#hack").hide(0);
					  $(This).trigger( "click" );
				  }
				  
			  }
			}, 7000);
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
		}
	  });

//release advance checkbox
$("#release_booked_s").click(function () {
	
        if ($(this).is(':checked')) {
            $("#seats-container .advance").each(function () {
                $(this).prop("checked", false);
                $(this).attr("disabled", false);
				
				 
            });
			
			 $("#seats-container .normal").each(function () {
				
                $(this).attr("disabled", true);
			
			});
			
        } else {
            $("#seats-container .advance").each(function () {
                $(this).prop("checked", true);
                $(this).attr("disabled", true);
				
            });
			
			$("#seats-container .normal").each(function () {
				
                $(this).attr("disabled", false);
			
			});
        }
    }); //release advance checkbox
	
	
	$("#reprint").click(function () {

		
			
			$.post('ajax.php', {'action': 'end_reprint_sess'}, function(data){
				  console.log(data);
			 });
				
			if ($(this).is(':checked')) {
			$("#seats-container .booked").each(function () {
                $(this).prop("checked", false);
                $(this).attr("disabled", false);
				$(this).attr('onclick','')
            });
			
			$("#seats-container .normal").attr("disabled", true);
			$(".ticket_adult").attr("disabled", true);
			$("#complimentary").attr("disabled", true);
			$("#seats_btn").hide();
			$(".seats_btn_cancel").hide();
			$("#reprint_submit").show();
			
			 } else {
				 $("#seats-container .booked").each(function () {
					$(this).prop("checked", true);
					$(this).attr("disabled", true);
					$(this).attr('onclick','return false')
				});
				
				$("#seats-container .normal").attr("disabled", false);
				$(".ticket_adult").attr("disabled", false);
				$("#complimentary").attr("disabled", false);
				$("#seats_btn").show();
				$(".seats_btn_cancel").show();
				$("#reprint_submit").hide();
			 }
			 
		
			

	 }); //reprint
	 
	  $("#seats-container").on('click','.booked',function() {
		 if ($('#reprint').is(':checked')) {
			 var seat_value = $(this).val();
			 var show_id = $('#selected_show').val();
			 console.log(seat_value);
			 console.log(show_id);
			  
			  $.post('ajax.php', {'show': show_id,'initial_seats': seat_value, 'action': 'reprint_sess'}, function(data){
				  console.log(data);
			  }); 
		 }
	 }); //reprint
	 

$(".seats_btn_cancel").click(function(){
	 
	var shw_id = $('#selected_show').val();
	var selector = $('.seats .current');
	var i = 0;  
	if(selector.length != 0){
		if($('#fsModal').is(':visible')){
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
		}
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
					if (! $( this ).hasClass( "locked" ) ) {
					posted_seats.push($(this).val());
					}
				}
            });
            
			console.log('posted seats');
			console.log(posted_seats);
			
          if($('#complimentary').is(":checked")){          
                allow_comp = "yes";
           	   }else{
           	   		allow_comp = "no";
           	   }
       

			
		   
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
			
			$('#terminal').find('.terminal_item').remove();
			for	(indexrow = 0; indexrow < posted_seats.length; indexrow++) {
		    var terminal_text ='<div class="terminal_item add-movie-item add-deals-item">';
		    terminal_text += '<div class="col-md-5 col-sm-5 add-movie-item-name">';
		    terminal_text += '<input type="hidden" value="'+shw_id+'" class="terminal_m_show_id">';
		    terminal_text += '<input type="hidden" value="'+ticket_id+'" class="terminal_m_ticket_id">';
		    terminal_text += '<input type="hidden" value="'+ticket_type+'" class="terminal_m_ticket_type">';
		    terminal_text += '<input type="hidden" value="'+allow_comp+'" class="terminal_m_is_comp">';
		    terminal_text += '<input type="hidden" value="'+shw_key+'" class="terminal_m_show_key">';
		    terminal_text += '<p><strong>'+movie_title+'</strong></p>';
		    terminal_text += '<input type="hidden" value="'+movie_title+'" class="terminal_m_title">';
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


		   $(terminal_text).appendTo('#terminal').find('.terminal_item');

		   

		   }
		   
		  
		   $('.book-ticket-btn').prop('disabled', true);
		   $('#book_btn'+shw_id).prop('disabled', false);
		    subtotalcalc();
		    $('.expression1').focus();
			
			
			   
		  });
	

		
 		//delete ticket terminal list
 		
 		

 		

	    
	});

			$("#terminal").on('click', '.ticket_delete', function() {
				$("#hack").show(0);
				var $myDiv = $('.terminal_item');
				var i = 0;
				var test = "hi";
				
					var Thiss = $(this);
					var deleted_seat = $(this).parents('.add-deal-item-value').parent('.add-movie-item').find('.terminal_m_seats').val();
					var deleted_show_id = $(this).parents('.add-deal-item-value').parent('.add-movie-item').find('.terminal_m_show_id').val();
					
					 $.post('ajax.php', {'show': deleted_show_id,'initial_seats': deleted_seat, 'action': 'delete_lock_s'}, function(data){
						console.log(data);
						Thiss.parents('.add-deal-item-value').parent('.terminal_item').remove();
						$("#hack").hide(0);
						subtotalcalc();
					 $.post('ajax.php', {'test_t': test,'action': 'end_pre_list_sess'}, function(data1){
							console.log(data1);
						}); //ajax
						
						if ( $myDiv.length == 1){
							$.post('ajax.php', {'action': 'unset_thank_sess'}, function(data) {
								console.log(data);
								var l_width = screen.availWidth;
								var l_height = screen.availHeight;
								if(diabled_popup == 'no'){
									var myWindow1 = window.open("user_booking_screen.php", "Cinema", "width="+l_width+",height="+l_height);
								}
							});
						 $('.book-ticket-btn').prop('disabled', false);
						}
						
						if ( $myDiv.length != 0){
						$(".terminal_item").each(function() {
						
						var shw_id = $(this).find('.terminal_m_show_id').val();
						var movie_id = $(this).find('.terminal_m_id').val();
						var d_id = $(this).find('.terminal_d_id').val();
						var movie_title = $(this).find('.terminal_m_title').val();
						var ticket_id = $(this).find('.terminal_m_ticket_id').val();
						var ticket_price = $(this).find('.terminal_m_price').val();
						var ticket_type = $(this).find('.terminal_m_ticket_type').val();
						var allow_comp = $(this).find('.terminal_m_is_comp').val();
						var shw_key = $(this).find('.terminal_m_show_key').val();
						var posted_seats = $(this).find('.terminal_m_seats').val();
						var qty = $(this).find('.terminal_m_qty').val();
						var sum = $(this).find('.terminal_m_sum').val();
						
						
						$.post('ajax.php', {'s_shw_id': shw_id,'s_ticket_id': ticket_id,'s_ticket_type':ticket_type,'s_allow_comp':allow_comp,'s_shw_key':shw_key,'s_movie_title':movie_title,'s_movie_id':movie_id,'s_d_id':d_id,'s_posted_seats':posted_seats,'s_ticket_price':ticket_price,'s_qty':qty,'s_sum':sum, 'action': 'terminal_sess'}, function(data) {
							console.log(data);
							console.log($myDiv.length);
							console.log(i);
							i++;
							if(i == $myDiv.length){
							
							$("#hack").hide(0);
							subtotalcalc();
							}
						 }); //ajax
					}); //each function
					}else{
							$('.book-ticket-btn').prop('disabled', false);
							console.log('qundeel');
							$("#hack").hide(0);
							subtotalcalc();
					}
			
		}); //ajax
		
}); //click function
			
			
 	//all delete function
 		$(".all_delete").click(function(){
			$("#hack").show(0);
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

			    		$.post('ajax.php', {'action': 'end_user_list_sess'}, function(data){
						console.log(data);
						});
					});

				
				var test = "hi";
					$.post('ajax.php', {'test_t': test, 'action': 'end_pre_list_sess'}, function(data){
					});

		    	
			$("#hack").hide(0);
 				subtotalcalc();
 				$('.expression1').val(0);
 				$('.expression2').val(0);
 				
 				
			});
	
	
	$("#print_tickets").click(function(){
		
		console.log('final');
		var selector = $('.terminal_item');
		var i = 0;
	
	if(selector.length != 0){ 
		var testt = "hi";
			$.post('ajax.php', {'test_t': testt, 'action': 'end_print_ticket_sess'}, function(data){
				});
		 var test = "hi";
					$.post('ajax.php', {'test_t': test, 'action': 'end_pre_list_sess'}, function(data){
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
				var single_seats = $(this).find('.terminal_m_seats').val();
				var this_b_seats = initial_seats.split(",");
				var this_b_seats_qty = $(this).find('.terminal_m_qty').val();
				var this_b_amount = $(this).find('.terminal_m_price').val();
				var total_amount = $('#ticket_total').val();

				
				$(this).remove();

				

				$.post('ajax.php', {'s_show_id': this_b_show_id,'single_s' : single_seats,'s_ticket_id': this_b_ticket_id,'s_ticket_type': this_b_ticket_type,'s_comp': this_b_is_com,'s_d_id': this_b_d_id,'s_m_id': this_b_m_id,'s_seats': this_b_seats, 's_seats_qty': this_b_seats_qty,'s_seats_amount': this_b_amount,'action': 'booking_r'}, function(data){
					console.log(data);
					i++;
					console.log(selector.length);
					console.log(i);
					
					if(i == selector.length) {
						$('.book-ticket-btn').prop('disabled', false);
						var customer_total = $('#ticket_total').val();
						$.post('ajax.php', {'cus_total': customer_total, 'action': 'thank_sess'}, function(data) {
							console.log(data);
							window.open("book_ticket.php?print=yes", "width=800, height=600");
							refresh = false;
						});
						
						//var l_width = screen.availWidth;
						//var l_height = screen.availHeight;
						//var myWindow = window.open("book_ticket.php", "Cinema", "_blank", "width="+l_width+",height="+l_height);
						
					  }
					});
				 
					});
				
					
		 		
			
			}//end if
		
	});
	
	

	$("#final_booking").click(function(){
		
		console.log('final');
		var selector = $('.terminal_item');
		var i = 0;
	
	if(selector.length != 0){ 
		var testt = "hi";
			$.post('ajax.php', {'test_t': testt, 'action': 'end_print_ticket_sess'}, function(data){
				});
		 var test = "hi";
					$.post('ajax.php', {'test_t': test, 'action': 'end_pre_list_sess'}, function(data){
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
				var single_seats = $(this).find('.terminal_m_seats').val();
				var this_b_seats = initial_seats.split(",");
				var this_b_seats_qty = $(this).find('.terminal_m_qty').val();
				var this_b_amount = $(this).find('.terminal_m_price').val();
				var total_amount = $('#ticket_total').val();

				
				$(this).remove();

				

				$.post('ajax.php', {'s_show_id': this_b_show_id,'single_s' : single_seats,'s_ticket_id': this_b_ticket_id,'s_ticket_type': this_b_ticket_type,'s_comp': this_b_is_com,'s_d_id': this_b_d_id,'s_m_id': this_b_m_id,'s_seats': this_b_seats, 's_seats_qty': this_b_seats_qty,'s_seats_amount': this_b_amount,'action': 'booking_r'}, function(data){
					console.log(data);
					i++;
					console.log(selector.length);
					console.log(i);
					
					if(i == selector.length) {
						$('.book-ticket-btn').prop('disabled', false);
						var customer_total = $('#ticket_total').val();
						$.post('ajax.php', {'cus_total': customer_total, 'action': 'thank_sess'}, function(data) {
							console.log(data);
							window.open("book_ticket.php", "width=800, height=600");
							refresh = false;
						});
						
						
						//var l_width = screen.availWidth;
						//var l_height = screen.availHeight;
						//var myWindow = window.open("book_ticket.php", "Cinema", "_blank", "width="+l_width+",height="+l_height);
						
					  }
					});
				 
					});
				
					
		 		
			
			}//end if
 			
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

$( window ).unload(function() {
 $(".seats_btn_cancel" ).trigger( "click" );
});

 window.onbeforeunload = function(event)
    {
    $(".seats_btn_cancel" ).trigger( "click" );
 };
 
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
