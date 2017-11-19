<?php require_once 'common/init.php'; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Cinema</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/custom.css" rel="stylesheet">
	<link href="assets/css/dashboard.css" rel="stylesheet">
	<link href="assets/css/owl.carousel.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css">


  </head>

<body style="background:url('assets/images/uploads/movie_bg_front.jpg') no-repeat center center fixed;background-size: cover;background-color: #000; color:white;">

<div class="wrapper">
  <div class="container" style="padding-top: 15px;">
  <div class="col-md-12">
  <?php 	 $movie = new movie(); 
  			 $person = new person();
			 $all_movie_person = $person->get_persons();
			 
			  $slideshow = new slideshow();
			 $all_slideshow = $slideshow->get_slideshow();

		if(isset($_GET['movie'])){
			
		$ID = $_GET['movie']; 
		if (isset($ID)) {
				$movie_result = $movie->get_movies($ID);
			}
		$current_actors = $movie_result->movie_actors;
		$current_actors = (!empty($current_actors))? json_decode($current_actors) : array();
		}
		
  ?>
	  
	</div>
	
	
	
	
  <div class="col-md-12 thankyou" style="text-align:center;display:none;position:relative!important;"  >
		
		
  </div>	<!-- seat_diagram -->
  
  
	<div class="welcome" style="text-align:center;">
			<img  style="margin-bottom:20px;" src="assets/images/welcome_logo.png" />
				<div id="owl_show">
					<?php if ($all_slideshow) {?>
					<?php	foreach($all_slideshow as $key => $res){ ?>
						 <img src="assets/images/uploads/<?php echo $res->slide_img; ?>"/>	
					<?php } ?>
					<?php } ?>
				</div>
	</div>
  	<div class="" id="seat_diagram" style="display: block;clear: both;margin: auto;">
		
	</div>	<!-- seat_diagram -->
	
</div>	<!-- container -->
</div><!-- wrapper -->

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
 
<script src="assets/js/jquery.latest.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/owl.carousel.js"></script> 

<script>
    $(document).ready(function() {
       var owl_product = $("#owl_show");
    owl_product.owlCarousel({
     autoPlay: 3000,
         itemsCustom : [
           [0, 1],
           [450, 1],
           [600, 1],
           [700, 1],
           [1000, 1],
           [1200, 1],
           [1400, 1],
           [1600, 1]
         ],
         navigation : false
    });
    });
</script>
<script>
    $( document ).ready(function() {
		
		
	
		var its_seats = [];
         $('#seat_diagram').show();
		 
		setInterval(function() {
		var id1  = getParameterByName('show');
		 // window.location.reload(1);
		  // After 5 secs
		  
		 $.post('ajax.php', {'action': 'get_thank_sess'}, function(data) {
			console.log(data);
			
			if(data != false){
				$('#seat_diagram').hide();
				$('.welcome').hide();
				$('.thankyou').show();
				
				var terminal_text = '<img style="margin:auto;width:80%;position: relative;margin-top:30px;" src="assets/images/thankyou1.png"/>';
				 terminal_text +='<div style="position: absolute;bottom: 40px;color: #777777;left: 0;right: 0;margin: auto;"><h4>Total Amount: <span id="amount" style="font-size:27px;color:red;">'+data+'</span></h4></div>';
				
				$('.thankyou').html(terminal_text);
				
				
				
		 }else{
			
			
			 $('.thankyou').hide();
			 
			 $.post('ajax.php', {'screen_id': id1, 'action': 'screen_show'}, function(data) {
    		console.log(data);
			if(data != false){
			$('.welcome').hide();
    		//$('.seats-container').html(data.screen_id);
			$('body').css('background', 'black');
			
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
		 text += '<table style="width:750px;margin: auto;">';
		 text += '<tr><td><table style="width:100%;margin: auto;"><tr><td style="text-align:center;"><div class="colors_indicator">Booked<span class="selected_box"></span> Reserved<span class="booked_box"></span> Hold<span class="hold_box"></span></div></td></tr></table></td></tr>';
		 text += '<tr><td><table style="width:100%;margin: auto;"><tr><td><h2 style="text-align:center;">Booking for Movie: '+data.movie_title+'<hr style="margin-bottom: 10px; margin-top: 10px;"></h2></td></tr></table></td></tr>';
		 text += '<tr><td><table style="width:100%;margin: auto;"><tr><td style="text-align:center;"><strong>Movie: <span style="color: #B90100;">'+data.movie_title+'</span></strong></td><td style="text-align:center;"><strong>Show Time: <span style="color: #B90100;">'+data.showtime_datetime+'</span></strong></td><td style="text-align:center;"><strong>Screen: <span style="color: #B90100;">'+data.screen_name+'</span></strong></td></tr><tr><td colspan="3" ><hr style="margin-bottom: 10px; margin-top: 10px;"></td></tr></table></td></tr>';
		for	(indexrow = 0; indexrow < rows.length; indexrow++) {
				var currentrow = rows[indexrow];
				var columnlenght = rowcolumn[indexrow];
				text +='<tr><td><table style="width:100%;margin: auto;">';
				for	(indexcolumn = 1; indexcolumn <= columnlenght; indexcolumn++) {
				var seatscode = rows[indexrow] + '-' + indexcolumn;
				if($.inArray(seatscode, booked_seats_array) > -1){  checked = 'checked onclick="return false" disabled'; seats_img = 'assets/images/selected_seats.png'; thisclass='booked';}
				else if($.inArray(seatscode, advance_booked_seats_array) > -1){  checked = 'checked ="true" disabled'; seats_img = 'assets/images/advance_seats.png'; thisclass='advance';}
				else if($.inArray(seatscode, locked_seats_array) > -1){checked = ''; seats_img = 'assets/images/hold_seats.png'; thisclass='normal locked';}
				else{checked = '';seats_img = 'assets/images/empty_seats.png'; thisclass='normal';}
				text +='<td style="text-align:center;">';
				text += '<div class="checkbox" style="width:35px;margin-bottom:0px;">';
				text += '<label style="padding-left: 0px;">';
				text += '<img width="35px;" src="'+seats_img+'">';
				text += '<input type="checkbox"  style="display:none;" name="seats[]" value="' + rows[indexrow] + '-' + indexcolumn + '" ' +checked+' class="' +thisclass+'">';
			    text += '<p style="text-transform:uppercase;font-size: 14px;font-weight: bold;">'+rows[indexrow] + '-' + indexcolumn+'</p>';
			    text += '</label>';
			    text += '</div>';
			    text += '</td>';
				}
			    text += '</table></td></tr>';
			   
			}
			 text += '</table>';
		
		text += '</div>';
		//console.log(text);
		document.getElementById("seat_diagram").innerHTML = text;
	
		});//ajax
});
});//ajax
}
});//ajax
		 }
		 });//ajax	 
      
        
    	
}, 1000);
           

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

});
</script>
