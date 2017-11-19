<?php require_once 'header-dashboard.php'; ?>
<?php 
	if($_SESSION['user']->capabilities != 'null'){
		$user_capabilities = $_SESSION['user']->capabilities;
		$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();
	
	
	}else{$user_capabilities = array('empty'); }
	if(in_array('book_concession', $user_capabilities)){	
	$settings = new setting();
	$settings_result = $settings->get_popup_status();
	if(in_array('book_concession', $user_capabilities)){
		echo '<input type="hidden" class="is_popup" value ="yes">';
	}else{
		echo '<input type="hidden" class="is_popup" value ="yes">';
	}
		//date_default_timezone_set('Etc/GMT+5');
	
?>
<div class="container main-container">
	
		
		<div class="clear"></div>
		<div class="row">
			<div class="col-md-6 nopadding">
				<div id="f_item_height">
					<?php 

						
						$concession = new concession();
						$all_con_item = $concession->get_concession_items();
						if ($all_con_item) {
						foreach($all_con_item as $res){

							echo '<div class="col-md-6 col-sm-6 drink f_item" style="background-color:'. $res->item_bg .';">';
							echo '<div class="col-md-4 icon">';
							echo '<img class="img-responsive" src="assets/images/uploads/'. $res->item_img .'"/>';
							echo '</div>';
							echo '<div class="col-md-8 nopadding">';
							echo '<p class="drink-size">'. $res->item_name .'</p>';
							echo '<p class="drink-volume">'. $res->item_small_decs .'</p>';
							echo '<p class="drink-price">Rs. '. $res->item_default_price .'</p>';
							echo '</div>';
							echo '<input type="hidden" value="'. $res->item_id .'" class="single_item_id">';
							echo '<input type="hidden" value="'. $res->item_name .'" class="single_item_name">';
							echo '<input type="hidden" value="'. $res->item_small_decs .'" class="single_item_desc">';
							echo '<input type="hidden" value="'. $res->item_default_price .'" class="single_item_price">';
							echo '</div>';

						}}?>
						
					
					</div><!-- f_item_height -->
					<div class="clear"></div>
					
					<div class="row">
					  <div class=" col-md-12 col-sm-12 latest-deals">
						<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
							<p>Our Latest Combos & Deals</p>
							<span>Select your combo deals</span>
						</div><!-- col-md-6-->
						
						<div class="col-md-6 col-sm-6 col-xs-6 nopadding">	
							<div class="navbar-right dropdown settings ">
							  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="setting-icon" src="assets/images/settings2.png"/></a>
							  <ul class="dropdown-menu">
								<li><a href="#">HTML</a></li>
								<li><a href="#">CSS</a></li>
								<li><a href="#">JavaScript</a></li>
							  </ul>
							</div>
						</div><!-- col-md-6-->
					</div><!-- latest-deals-->
					</div><!-- row-->
					
					<div class="row">
						<div class="combo_scroll">
					<?php 
			
						$all_con_package = $concession->get_concession_packages();
						if ($all_con_package) {
						foreach($all_con_package as $res){
							$current_items_id = $res->package_item_name;
							$current_items_id = (!empty($current_items_id))? json_decode($current_items_id) : array();

							$current_items_qty = $res->package_item_qty;
							$current_items_qty = (!empty($current_items_qty))? json_decode($current_items_qty) : array();
							$counter = 0;
							echo '<div class="d_item col-md-4 col-sm-4" >';
							echo '<div class="deal-desc" style="background-color:'.$res->package_bg.';">';
							echo '<div class="deal-img">';
							echo '<img class="img-responsive" src="assets/images/uploads/'.$res->package_img.'"/>';
							echo ' </div>';
							echo '<div class="deal-name">';
							echo '<p>'.$res->package_name.' <span>('.$res->package_desc.')</span></p>';
							echo '</div>';
							echo '<div class="deal-price">';
							echo '<p>Rs. '.$res->package_price.'</p>';
							echo '</div>';
							echo '</div>';
							foreach ($current_items_id as $items_id) {
							echo '<input type="hidden" class="item_id" value="'.$items_id.'">';
							$item_name = $concession->get_item_detail($items_id);
							//print_f($item_name);
							echo '<input type="hidden" name="p_item_name[]" class="p_item_name" value="'.$item_name[0]->item_name.'">';
							echo '<input type="hidden" name="p_item_price[]" class="p_item_price" value="'.$item_name[0]->item_default_price.'">';
							echo '<input type="hidden" name="p_item_qty[]" class="p_item_qty" value="'.$current_items_qty[$counter].'">';
							$counter++;
							}
							echo '<input type="hidden" class="single_item_desc" value="'.$res->package_desc.'">';
							echo '<input type="hidden" class="single_item_id" value="'.$res->package_id.'">';
							echo '<input type="hidden" class="single_item_name" value="'.$res->package_name.'">';
							echo '<input type="hidden" class="single_item_price" value="'.$res->package_price.'">';
							echo '</div>';

						}}?>

						
							
						</div><!-- scroll -->
					</div><!-- row -->
				</div><!-- col-md-7-->
				
				<div class="col-md-6 padding5">
					<div class="deal-bg" >
						<div class="col-md-12 col-sm-12 add-deals-head">
						 <div class="col-md-6 col-sm-6 col-xs-6 nopadding">	
							<p>Add your deals and combos (on particular basis)</p>
							</div><!-- col-md-6-->
							<div class="col-md-6 col-sm-6 col-xs-6 nopadding">	
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
							<div class="col-md-6 col-sm-6">
								<p>Description</p>
							</div><!-- col-md-9-->
							
							<div class="col-md-2 col-sm-2">
								<p>Price</p>
							</div><!-- add-deals-value-->

							<div class="col-md-2 col-sm-2">
								<p>Qty</p>
							</div><!-- add-deals-value-->

							<div class="col-md-2 col-sm-2">
								<p>Amount</p>
							</div><!-- add-deals-value-->
						</div><!-- col-md-3-->

						<div class="con_scroll">
						<div id="con_terminal">
						</div>

						</div><!-- con_scroll-->

					</div><!-- deal-bg-->
					
					<div class="clear"></div>
						
					<div class="function-bg">
					
						<div class="col-md-3 col-sm-3 function-bg-br">
							<img width="33px" id="all_con_delete" class="img-responsive" style="cursor:pointer;" src="assets/images/delete_icon.png"/>
							Reset
						</div>
						
						
						<div class="col-md-3 col-sm-3 function-bg-br">
							
						</div>
						
						<div class="col-md-3 col-sm-3 function-bg-br">
							
						</div>
					
					</div><!-- function-bg-->
					
					<div class="clear"></div>
						
					<div class="total-amount">
						<div class="col-md-5 col-sm-6">
							<p class="total-amount-label">Total Amount:<br/>
							<span>Inc: GST</span></p>
						</div><!-- col-md-5-->
						
						<div class="col-md-7 col-sm-6">
							<p class="total-amount-value">Rs. 0.00<br/>
							
							</p><br/>
							<input type="hidden" id="total-amount-value" value="">
							
						</div><!-- col-md-7-->
					</div><!-- total-amount-->
					
					
					<div class="clear"></div>
						
					<div class="ticket-save">
						<div class="col-md-6 col-sm-6">
							
						</div>
								
						<div class="col-md-6 col-sm-6 save-cancel">
						<button class="btn btn-default save-btn" id="print_concession" type="button" >
								Save & Print
						</button>
						
						<button class="btn btn-default save-btn" id="save_concession" type="button" >
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
		
	
   </div><!-- container -->
  </div> <!-- /main container -->
   
   <!--footer-->
  <div class="container">
    <div class="row">
		<div class="copyright">
			<div class="col-md-6 col-sm-6">
				<p>Copyright: 2015 Designed and Developed by: WEBNET</p>
			</div>
			
			
			<div class="col-md-6 col-sm-6 powerdby">
				<a href=""><img  width="110px" src="assets/images/powered_logo.png"/></a>
			</div><!-- col-md-4-->
			
		</div><!-- copyright -->
   </div><!-- row -->
   <!--/footer-->
   
   
   <!--/main container--->
   
   
    <!-- Bootstrap core JavaScript -->
    <script src="assets/js/jquery.latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script>
	$( document ).ready(function() {
		var diabled_popup = $('.is_popup').val();
		/*if(diabled_popup == 'no'){
		var l_width = screen.availWidth;
		var l_height = screen.availHeight;
		var myWindow1 = window.open("user_concession_screen.php", "Cinema", "width="+l_width+",height="+l_height);
		}*/
		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});

		(function($){
			$(window).load(function(){

				$("#f_item_height").mCustomScrollbar({
					setHeight:300,
					theme:"inset-2-dark"
				});

				$(".combo_scroll").mCustomScrollbar({
					setHeight:350,
					theme:"inset-2-dark"
				});

				$(".con_scroll").mCustomScrollbar({
					setHeight:430,
					theme:"inset-2-dark"
				})

				
			});

			
		})(jQuery);




		$(".f_item").click(function(){
			var i_id = $(this).find('.single_item_id').val();
 			var i_name = $(this).find('.single_item_name').val();
			var i_price = $(this).find('.single_item_price').val();
			var i_desc = $(this).find('.single_item_desc').val();
			
			
			con_ter_text = '<div class="concession_item add-deals-item">';
			con_ter_text += '<div class="col-md-6 col-sm-6 add-deal-item-value">';
			con_ter_text += '<p>'+i_name+'<span> ('+i_desc+')</span></p>';
			con_ter_text += '</div>';
							
			con_ter_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			con_ter_text += '<p>'+i_price+' </p>';
			con_ter_text += '</div>';

			con_ter_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			con_ter_text += '<p>X <input type="number" min="1" class="con_item_qty" value="1"></p>';
			con_ter_text += '</div>';

			con_ter_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			con_ter_text += '<p><img class="img-responsive item_delete" src="assets/images/delete_icon.png" style="width:12px;float: right;cursor:pointer;"><span class="price_show">'+i_price+'</span></p>';
			con_ter_text += '</div>';
			con_ter_text += '<input type="hidden" class="con_item_id" value="'+i_id+'">';
			con_ter_text += '<input type="hidden" class="con_item_price" value="'+i_price+'">';
			con_ter_text += '<input type="hidden" class="con_item_total" value="'+i_price+'">';
			con_ter_text += '<input type="hidden" class="con_type" value="item">';
			con_ter_text += '</div>';
		  	$(con_ter_text).appendTo('#con_terminal').find('.concession_item');
		  	subtotalcalc ();
		  	if($('.expression1').val() != 0 || $('.expression1').val() !=""){
		  	calculate();
		  	}
 		}); //final_booking

		$(".d_item").click(function(){
			//get package details
			var i_id = $(this).find('.single_item_id').val();
			var i_name = $(this).find('.single_item_name').val();
			var i_price = $(this).find('.single_item_price').val();
			var i_desc = $(this).find('.single_item_desc').val();

			//get package item details
			var p_i_name = new Array();
				$.each($(this).find('.p_item_name'), function(){  
			       p_i_name.push($(this).val());
			     });
					
				var p_i_price = new Array();
				$.each($(this).find('.p_item_price'), function(){  
			          p_i_price.push($(this).val());
			      });

				var p_i_qty = new Array();
				$.each($(this).find('.p_item_qty'), function(){  
			          p_i_qty.push($(this).val());
			      });

			con_ter_text = '<div class="concession_item add-deals-item">';
			con_ter_text += '<div class="col-md-6 col-sm-6 add-deal-item-value">';
			con_ter_text += '<p>'+i_name+'<span> ('+i_desc+')</span></p>';
			con_ter_text += '<div class="package_item">';
			for (var i =0; i < p_i_name.length ; i++){
				con_ter_text += '<p style="font-weight:normal;font-size: 12px;">'+p_i_name[i]+': ' +p_i_price[i]+' X '+p_i_qty[i]+' = '+p_i_price[i]*p_i_qty[i] +'</p>';
			}
			con_ter_text += '</div>';
			con_ter_text += '</div>';
							
			con_ter_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			con_ter_text += '<p>'+i_price+' </p>';
			con_ter_text += '</div>';

			con_ter_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			con_ter_text += '<p>X <input type="number" min="1" class="con_item_qty" value="1"></p>';
			con_ter_text += '</div>';

			con_ter_text += '<div class="col-md-2 col-sm-2 add-deal-item-value">';
			con_ter_text += '<p><img class="img-responsive item_delete" src="assets/images/delete_icon.png" style="width:12px;float: right;cursor:pointer;"><span class="price_show">'+i_price+'</span></p>';
			con_ter_text += '</div>';
			
			con_ter_text += '<input type="hidden" class="con_item_price" value="'+i_price+'">';
			con_ter_text += '<input type="hidden" class="con_item_total" value="'+i_price+'">';
			con_ter_text += '<input type="hidden" class="con_item_id" value="'+i_id+'">';
			con_ter_text += '<input type="hidden" class="con_type" value="package">';
			con_ter_text += '</div>';
			
			
			$(con_ter_text).appendTo('#con_terminal').find('.concession_item');
			subtotalcalc ();
		 	}); //final_booking
		
		
		$("#con_terminal").on('click', '.item_delete', function() {
			$(this).parents('.add-deal-item-value').parent('.concession_item').remove();
			subtotalcalc ();
		});

		$("#all_con_delete").click(function(){
 			$(".concession_item").each(function() {
 				$(this).remove();
 				subtotalcalc ();
 				$('.expression1').val(0);
 				$('.expression2').val(0);

 			});
 		});

 		$("#con_terminal").on('change', '.con_item_qty', function(event) {
 			var This = $(this).parents('.add-deal-item-value').parent('.concession_item');
 			var this_price = This.find('.con_item_price').val();
 			var this_qty = $(this).val();
 			
 			var final_p = (parseFloat(this_price)) * (parseFloat(this_qty));
 			This.find('.price_show').text(final_p);
 			This.find('.con_item_total').val(final_p);
 			subtotalcalc ();
 			if($('.expression1').val() != 0 || $('.expression1').val() !=""){
		  	calculate();
		  	}

 		});	

 		var all_con_id_arr = new Array();
 		var total_val="";
		var ord_id ="";
 		$("#save_concession").click(function(){

 			
			$.post('ajax.php', {'action': 'end_all_concession_sess'}, function(data){
				console.log(data);
			});
			
			
			var total_v = $('#total-amount-value').val();
			
			$.post('ajax.php', {'s_total': total_v,'action': 'ins_order'}, function(data1){
				console.log(data1);
				ord_id = data1;
			

 			 total_val = $('#total-amount-value').val();

 			$(".concession_item").each(function() {

 				var con_id = $(this).find('.con_item_id').val();
				var con_type = $(this).find('.con_type').val();
				var con_price = $(this).find('.con_item_price').val();
				var con_qty = $(this).find('.con_item_qty').val();

				
				$(this).remove();
				
				$.post('ajax.php', {'total': total_val,'ord_id': ord_id,'s_con_id': con_id,'s_con_type': con_type,'s_con_price': con_price,'s_con_qty': con_qty,'action': 'concession_r'}, function(data){
					all_con_id = data;
					
				
				 all_con_id_arr.push(all_con_id);
				 window.open("book_concession.php?total="+total_val, "width=800, height=600");
 			
 			});
				subtotalcalc ();
				$('.expression1').val(0);
 				$('.expression2').val(0);

			});
 			 });
			 
		var l_width = screen.availWidth;
		var l_height = screen.availHeight;
		/*if(diabled_popup == 'no'){
		var myWindow1 = window.open("user_concession_screen.php", "Cinema", "width="+l_width+",height="+l_height);
		}*/
 		});
	
	
	
	$("#print_concession").click(function(){

 			
			$.post('ajax.php', {'action': 'end_all_concession_sess'}, function(data){
				console.log(data);
			});
			
			
			var total_v = $('#total-amount-value').val();
			
			$.post('ajax.php', {'s_total': total_v,'action': 'ins_order'}, function(data1){
				console.log(data1);
				ord_id = data1;
			

 			 total_val = $('#total-amount-value').val();

 			$(".concession_item").each(function() {

 				var con_id = $(this).find('.con_item_id').val();
				var con_type = $(this).find('.con_type').val();
				var con_price = $(this).find('.con_item_price').val();
				var con_qty = $(this).find('.con_item_qty').val();

				
				$(this).remove();
				
				$.post('ajax.php', {'total': total_val,'ord_id': ord_id,'s_con_id': con_id,'s_con_type': con_type,'s_con_price': con_price,'s_con_qty': con_qty,'action': 'concession_r'}, function(data){
					all_con_id = data;
					
				
				 all_con_id_arr.push(all_con_id);
				 window.open("book_concession.php?print=yes&total="+total_val, "width=800, height=600");
 			
 			});
				subtotalcalc ();
				$('.expression1').val(0);
 				$('.expression2').val(0);

			});
 			 });
			 
		var l_width = screen.availWidth;
		var l_height = screen.availHeight;
		/*if(diabled_popup == 'no'){
		var myWindow1 = window.open("user_concession_screen.php", "Cinema", "width="+l_width+",height="+l_height);
		}*/
 		});
		
 		function subtotalcalc (event) {
                	//alert('Press Hit Button');
                	// Sub Total All Amount Table and save in subtotal variable
                	var subtotal = 0;
				    $('.con_item_total').each(function() {
				        subtotal += parseFloat($(this).val());
				    });
				    // Display Value to Sub Total Amount
				    $(".total-amount-value").text('Rs.'+parseFloat(subtotal).toFixed(2));
				    $("#total-amount-value").val(parseFloat(subtotal).toFixed(2));

			}

			$(".calculate").click(function(){

				 calculate();
			});

			function calculate (event) {
				if($('.expression1').val() != 0 || $('.expression1').val() !=""){
				 var returnamount =  $(".expression1").val() - $("#total-amount-value").val();
				 $(".expression2").val(returnamount);
				}
			}

	});
	
	</script>
	
  </body>
</html>
 <?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';
     require_once 'footer.php'; 
	}
?>
