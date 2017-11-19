


<!--footer-->
  <div class="container">
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
   <!--/main container--->
   
   
    <!-- Bootstrap core JavaScript -->
    <script src="assets/js/jquery.latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	
	<!--add movie actor jquery-->
	<script type="text/javascript">
	$(document).ready(function(){
	//custom scrollbar function
			(function($){
				$(window).load(function(){
					$("#maxscroll").mCustomScrollbar({
						setHeight:350,
						theme:"inset-2-dark"
					});
					
					$("#cinema-program-bg").mCustomScrollbar({
						setHeight:700,
						theme:"inset-2-dark"
					});
				
			});
		})(jQuery); //end scrollbar function

		$('.datetimepicker').datetimepicker({
			dayOfWeekStart : 1,
			lang:'en'
			});

		$('.datetimepicker').datetimepicker({step:10});

		function addRow1() {
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-4">\
									<div class="form-group">\
										<label class="col-sm-4 control-label">Actor</label>\
										<div class="col-sm-8">\
											<select name="movie_actors[]" class="form-control">\
												<?php foreach ($all_movie_person as $movie_person_value){ ?>
													<option value="<?php echo $movie_person_value->movie_person_id; ?>"><?php echo $movie_person_value->movie_person_name; ?></option>\
												<?php } ?>
											</select>\
										</div>\
								  	</div>\
								</div>\
								<div class="col-md-4">\
									<div class="form-group">\
										<label class="col-sm-4 control-label">Role</label>\
										<div class="col-sm-7">\
											<select name="movie_actors_role[]" class="form-control">\
												<?php foreach($movie_actors_role as $movie_actors_role_key => $movie_actors_role_value){?>
													<option value="<?php echo $movie_actors_role_key ;?>"><?php echo $movie_actors_role_value ;?></option>\
												<?php } ?>
											</select>\
										</div>\
									</div>\
								</div>\
									<div class="col-md-4 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('content1').appendChild(div);
		}
		
		
		// Minus Button function for Offer Page
			$("#content1").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
			});
		}); 
	</script>
	<!--closed movie actor jquery-->

	<!--add movie actor jquery-->
	<script type="text/javascript">
		function additem(){
		var len = $('.row-el').length;
		//console.log(len);
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-3">\
									<div class="item-group">\
									 <select name="package_item_name[]" id="item'+len+'" class="package_item_name form-control" required>\
										<option value="" selected disabled>select item</option>\
										<?php foreach ($all_item as $all_item_key => $all_item_value) {?>
												 <option value="<?php echo $all_item_value->item_id;?>"><?php echo $all_item_value->item_name;?></option>\
											<?php }?>
										</select>\
									  </div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="package_item_price[]" class="form-control itemprice item'+len+'price"  placeholder="0" class="form-control" readonly required>\
										</div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="package_item_qty[]" class="form-control itemqty"   placeholder="0" class="form-control" required>\
										</div>\
									 </div>\
									<div class="col-md-3 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('itemcontainer').appendChild(div);
		}
		
	$(document).ready(function(){
			update_amounts();
		// Minus Button function for Offer Page
			$("#itemcontainer").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
				update_amounts();
			});
		

		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});
	
	

		// set price on item change
		$("#itemcontainer").on('change', '.package_item_name', function(event) {
		    event.preventDefault();
		    var control_id = $(this).attr('id');
		    var getitem = $('#'+control_id).val();

		   $.post('ajax.php', {'getitem': getitem, 'action': 'get_item_detail'}, function(data) {
		   		//console.log(data);
		        console.log(control_id);
		       $('.'+control_id+'price').val(data.item_default_price);
		       update_amounts();

		   });
   		});//end 

		//update amount on quantity change
   		$("#itemcontainer").on("change", ".itemqty", function(event) {
  			update_amounts();
   		 });

   		//function for updae amount
		function update_amounts()
			{
			    var sum = 0.0;
			    $('#itemcontainer .row-el').each(function() {
			        var qty = $(this).find('.itemprice ').val();
			        var price = $(this).find('.itemqty').val();
			        var amount = (qty*price)
			        sum+=amount;
			        $(this).find('.amount').text(''+amount);
			    });
			    // update the total to sum  
			   // console.log(sum);
			    $('#package_price').val(sum);
			}//end
	}); //document ready

	</script>

	<script type="text/javascript">
		function addticket_item() {
		var rowlen = $('.row-el').length;
		//console.log(len);
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-3">\
									<div class="item-group">\
									 <select name="ticket_package_item_name[]" id="ticket_item'+rowlen+'" class="ticket_package_item_name form-control" required>\
										<option value="" selected disabled>select item</option>\
										<?php foreach ($all_item as $all_item_key => $all_item_value) {?>
												 <option value="<?php echo $all_item_value->item_id;?>"><?php echo $all_item_value->item_name;?></option>\
											<?php }?>
										</select>\
									  </div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="ticket_package_item_price[]" class="form-control ticket_itemprice ticket_item'+rowlen+'price"  placeholder="0" class="form-control" readonly required>\
										</div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="ticket_package_item_qty[]" class="form-control ticket_itemqty"   placeholder="0" class="form-control" required>\
										</div>\
									 </div>\
									<div class="col-md-3 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('ticketitemcontainer').appendChild(div);
		}

		function addticket_ticket() {
		var ticket_rowlen = $('.row-el').length;
		//console.log(len);
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-3">\
									<div class="item-group">\
									 <select name="ticket_package_ticket_name[]" id="ticket_ticket'+ticket_rowlen+'" class="ticket_package_ticket_name form-control" required>\
										<option value="" selected disabled>select item</option>\
										<?php foreach ($all_ticket as $all_ticket_key => $all_ticket_value) {?>
												 <option value="<?php echo $all_ticket_value->ticket_id;?>"><?php echo $all_ticket_value->ticket_title;?></option>\
											<?php }?>
										</select>\
									  </div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="ticket_package_ticket_price[]" class="form-control ticket_itemprice ticket_ticket'+ticket_rowlen+'price"  placeholder="0" class="form-control" readonly required>\
										</div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="ticket_package_ticket_qty[]" class="form-control ticket_itemqty"   placeholder="0" class="form-control" required>\
										</div>\
									 </div>\
									<div class="col-md-3 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('ticket_ticketcontainer').appendChild(div);
		}
		
		$(document).ready(function(){
			
		// Minus Button function for Offer Page
			$("#ticketitemcontainer").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
				update_ticket_amounts();
			});

			// Minus Button function for Offer Page
			$("#ticket_ticketcontainer").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
				update_ticket_amounts();
			});

			// at ticket page set price on item change 
		$("#ticketitemcontainer").on('change', '.ticket_package_item_name', function(event) {
		    event.preventDefault();
		    var control_id = $(this).attr('id');
		    var getitem = $('#'+control_id).val();

		   $.post('ajax.php', {'getitem': getitem, 'action': 'get_item_detail'}, function(data) {
		   		//console.log(data);
		        console.log(control_id);
		       $('.'+control_id+'price').val(data.item_default_price);
		     update_ticket_amounts();

		   });
		});//end 

   		$("#ticket_ticketcontainer").on('change', '.ticket_package_ticket_name', function(event) {
		    event.preventDefault();
		    var control_id = $(this).attr('id');
		    var getticket = $('#'+control_id).val();

		   $.post('ajax.php', {'getticket': getticket, 'action': 'get_ticket_detail'}, function(data) {
		   		//console.log(data);
		        console.log(control_id);
		       $('.'+control_id+'price').val(data.ticket_price);
		       update_ticket_amounts();

		   });
   		});//end 

   		//update amount on quantity change
   		$("#ticket_container").on("change", ".ticket_itemqty", function(event) {
  			update_ticket_amounts();
   		 });
   		
   		function update_ticket_amounts()
			{
			    var sum = 0.0;
			    $('#ticket_container .row-el').each(function() {
			        var qty = $(this).find('.ticket_itemprice ').val();
			        var price = $(this).find('.ticket_itemqty').val();
			        var amount = (qty*price)
			        sum+=amount;
			        $(this).find('.amount').text(''+amount);
			    });
			    // update the total to sum  
			   // console.log(sum);
			    $('#ticket_price').val(sum);
			}//end

			
		}); //document ready
	</script>

	<script type="text/javascript" src="assets/js/timeline.js"></script>	
	<script type="text/javascript">
    // Create some JSON data
    <?php $all_showtime = $showtime->get_showtimes(); ?>
     var data = [
    <?php  if ($all_showtime) {?>
	<?php foreach($all_showtime as $res) {?>
      <?php echo $mydate = $res->showtime_datetime; echo $this->_date('Y-m-d H:i:s', $mydate); ?>
        {
            'start': new Date(2010,7,20,9,30,0), 
			'end': new Date(2010,7,20,11,30,0),
            'content': '<?php echo $res->movie_title; ?> <p class="film_small_desc"> Start Time: 03:30 End Time: 04:30</p>',
            'editable': false,
			'group': '<?php echo $res->screen_name; ?>',
			'className': 'timeline_film_detail pink'
        },
       
       <?php }
		}else{
			echo 'Error';
			} 
		?> 
    ];

    // specify options
    var options = {
        'width':  '100%',
        'height': '260px',
        'editable': true,   // enable dragging and editing events
        'layout': 'box',
		axisOnTop: true,
		min: new Date(2010,7,20,0,0,0),
		max: new Date(2010,8,20,24,0,0),
		'zoomable':false,
		"intervalMin": 3600000 * 6, // one hour in milliseconds
		"intervalMax": 3600000 * 6 , 
		
		
    };
	
    // Instantiate our timeline object.
    var timeline = new links.Timeline(document.getElementById('mytimeline'), options);

    // Draw our timeline with the created data and options
    timeline.draw(data);
</script>
	
  </body>
</html>
