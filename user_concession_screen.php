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
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css">


  </head>

<body style="background-color:#191919; color:white;">

<div class="wrapper">
  <div class="container" id="item_container" style="padding-top: 15px;" >
		
		<div class="col-md-12">
			<h3 style="text-align:center;text-transform: uppercase;"> Universe Cineplex</h3>
			<h4 style="text-align:center;text-transform: uppercase;margin-bottom: 40px;"> Select your items</h4>
		</div>
		
		<div class="col-md-12">
			<div id="f_item_height" class="user_con">
					<?php 

						
						$concession = new concession();
						$all_con_item = $concession->get_concession_items();
						if ($all_con_item) {
						foreach($all_con_item as $res){

							echo '<div class="col-md-3 col-sm-3 drink f_item" style="background-color:'. $res->item_bg .';min-height: 200px;padding-top: 35px;">';
							echo '<div class="col-md-4 icon">';
							echo '<img class="img-responsive" src="assets/images/uploads/'. $res->item_img .'" style=" width: 50px;align-self: center;max-height: 70px;"/>';
							echo '</div>';
							echo '<div class="col-md-8 nopadding">';
							echo '<p class="drink-size" style="font-size: 15px;font-weight:bold; text-transform: uppercase;">'. $res->item_name .'</p>';
							echo '<p class="drink-volume">'. $res->item_small_decs .'</p>';
							echo '<p class="drink-price">Rs. '. $res->item_default_price .'</p>';
							echo '</div>';
							echo '</div>';

						}}?>
						
					
			</div><!-- f_item_height -->
		</div>
		
		<div class="col-md-12" style="clear:both;">
			
			
		</div>
		
		<div class="col-md-12">
			<div class="combo_scroll">
					<?php 
			
						$all_con_package = $concession->get_concession_packages();
						if ($all_con_package) {
						echo '<h4 style="text-align:center;text-transform: uppercase;padding: 5px;border: 1px solid white;"> Select your combo</h4>';
						foreach($all_con_package as $res){
							echo '<div class="col-md-3 col-sm-3 drink f_item" style="background-color:'. $res->package_bg .';max-height: 170px;">';
							echo '<div class="col-md-4 icon">';
							echo '<img class="img-responsive" src="assets/images/uploads/'. $res->package_img .'" style=" width: 50px;align-self: center;max-height: 70px;"/>';
							echo '</div>';
							echo '<div class="col-md-8 nopadding">';
							echo '<p class="drink-size" style="font-size: 13px;font-weight:bold; text-transform: uppercase;">'. $res->package_name .'</p>';
							echo '<p class="drink-volume">'. $res->package_desc .'</p>';
							echo '<p class="drink-price">Rs. '. $res->package_price .'</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';

						}}?>

						
							
		</div><!-- scroll -->
		</div>
	
	</div>
	
	
  <div class="col-md-12" style="text-align:center;display:none;" id="seat_diagram" >
		<img style="margin:auto;width:80%;position: relative;margin-top:30px;" src="assets/images/thankyou1.png"/>
		<div style="position: absolute;bottom: 40px;color: #777777;left: 0;right: 0;margin: auto;">
			<h4>Order #: <span id="orderno"></span></h4>
			<h4>Total Amount: <span id="amount" style="font-size:27px;color:red;"></span></h4>
		</div>
  </div>	<!-- seat_diagram -->
	




</div>	<!-- container -->
<script src="assets/js/jquery.latest.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script>
    $( document ).ready(function() {
		var con_array = new Array();
		var myVar = setInterval(function(){ myTimer() }, 1000);
		
		function myTimer() {
		
		$.post('ajax.php', {'action': 'get_con_sess'}, function(data) {
			
			if(data != false){
				 $('#item_container').hide();
				  $('#seat_diagram').show();
				 myStopFunction();
				 console.log(data);
				
					 var totall = data[0].total;
					 var orderno = data[0].con_inserted_id;
					 console.log(totall);
					 $('#orderno').html(orderno);
					  $('#amount').html(totall);
					  
					setTimeout(function(){
					  
					 $.post('ajax.php', {'action': 'end_con_session'}, function(data){
						   $('#item_container').show();
						   $('#seat_diagram').hide();
						   
					  });//ajax 
					  
					}, 8000);
				
			}else{
				
				$('#item_container').show();
				$('#seat_diagram').hide();
			}
		});//ajax
		
		}
		function myStopFunction() {
			clearInterval(myVar);
		}
	/*	function myTimer() {
		$('.slip').remove();
		 // window.location.reload(1);
		  // After 5 secs
		  
		$.post('ajax.php', {'action': 'get_con_sess'}, function(data) {
			
			if(data != false){
				 myStopFunction();
				 $('#item_container').hide();
				
				var con_data = data;
				for	(var key in con_data) {
					var inserted_id = con_data[key].con_inserted_id;
					
					$.post('ajax.php', {'itemid': inserted_id, 'action': 'get_con_by_id'}, function(data2) {
						var text1 ='<table class="slip"  style="width:250px;border:1px solid black;margin:auto;text-align:left;font-size:13px;font-family:helvetica;">';
						
						var single_data = data2;
						for	(var key in single_data) {
						
						var itemtype = single_data[key].con_booking_type;
						var itemid   = single_data[key].con_booking_type_id;
						var itemqty  = single_data[key].con_booking_qty;
						var itempri		 = single_data[key].con_booking_price;
						
							 if(itemtype == 'item'){
								
								 $.post('ajax.php', {'item': itemid, 'action': 'get_i_detail'}, function(data3) {
									 
									 //console.log(data3);
									 var con_item = data3;
									 
									 
									 for(var key in con_item) {
										 var itemname = con_item[key].item_name;
										 console.log(con_item);
										 
										 text1 +='<tr><td><table><tr><td style="width:50%;text-align:center;">'+itemname+' X '+itemqty+'</td><td style="width:50%;text-align:center;"> = '+itemqty * itempri+'</td></tr></table></td></tr>';
										 text1 += '</td></tr></table>';
										
										  
										  
									 }
										$(text1).appendTo('#inner_table');
										
									 
								 });//ajax
							 }else{
								
							 }
							 
							 
							 
							}
							
							
						});//ajax
					
							
				}
				 
				
				
				
		 }else{
			
			
		 }
	
		
		});//
		 

}*/


});
</script>
