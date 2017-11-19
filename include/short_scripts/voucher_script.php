<script type="text/javascript">
		function addvoucher_item() {
		var rowlen = $('.row-el').length;
		//console.log(len);
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-3">\
									<div class="item-group">\
									 <select name="voucher_package_item_name[]" id="voucher_item'+rowlen+'" class="voucher_package_item_name form-control" required>\
										<option value="" selected disabled>select item</option>\
										<?php foreach ($all_item as $all_item_key => $all_item_value) {?>
												 <option value="<?php echo $all_item_value->item_id;?>"><?php echo $all_item_value->item_name;?></option>\
											<?php }?>
										</select>\
									  </div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="voucher_package_item_price[]" class="form-control voucher_itemprice voucher_item'+rowlen+'price"  placeholder="0" class="form-control" readonly required>\
										</div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="voucher_package_item_qty[]" class="form-control voucher_itemqty"   placeholder="0" class="form-control" required>\
										</div>\
									 </div>\
									<div class="col-md-2 col-md-offset-1 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('voucheritemcontainer').appendChild(div);
		}

		function addvoucher_ticket() {
		var ticket_rowlen = $('.row-el').length;
		//console.log(len);
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-3">\
									<div class="item-group">\
									 <select name="voucher_package_ticket_name[]" id="voucher_ticket'+ticket_rowlen+'" class="voucher_package_ticket_name form-control" required>\
										<option value="" selected disabled>select item</option>\
										<?php foreach ($all_ticket as $all_ticket_key => $all_ticket_value) {?>
												 <option value="<?php echo $all_ticket_value->ticket_id;?>"><?php echo $all_ticket_value->ticket_title;?></option>\
											<?php }?>
										</select>\
									  </div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="voucher_package_ticket_price[]" class="form-control voucher_itemprice voucher_ticket'+ticket_rowlen+'price"  placeholder="0" class="form-control" readonly required>\
										</div>\
									</div>\
									<div class="col-md-3">\
										<div class="item-group">\
											<input type="text" name="voucher_package_ticket_qty[]" class="form-control voucher_itemqty"   placeholder="0" class="form-control" required>\
										</div>\
									 </div>\
									<div class="col-md-2 col-md-offset-1 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('voucher_ticketcontainer').appendChild(div);
		}
		
		// Minus Button function for Offer Page
			$("#voucheritemcontainer").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
				update_voucher_amounts();
			});

			// Minus Button function for Offer Page
			$("#voucher_ticketcontainer").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
				update_voucher_amounts();
			});

$(document).ready(function(){
	
	// at ticket page set price on item change 
		$("#voucheritemcontainer").on('change', '.voucher_package_item_name', function(event) {
		    event.preventDefault();
		    var control_id = $(this).attr('id');
		    var getitem = $('#'+control_id).val();

		   $.post('ajax.php', {'getitem': getitem, 'action': 'get_item_detail'}, function(data) {
		   		//console.log(data);
		        console.log(control_id);
		       $('.'+control_id+'price').val(data.item_default_price);
		     update_voucher_amounts();

		   });
		});//end 

   		$("#voucher_ticketcontainer").on('change', '.voucher_package_ticket_name', function(event) {
		    event.preventDefault();
		    var control_id = $(this).attr('id');
		    var getticket = $('#'+control_id).val();

		   $.post('ajax.php', {'getticket': getticket, 'action': 'get_ticket_detail'}, function(data) {
		   		//console.log(data);
		        console.log(control_id);
		       $('.'+control_id+'price').val(data.ticket_adult_price);
		       update_voucher_amounts();

		   });
   		});//end 

   		//update amount on quantity change
   		$("#voucher_container").on("change", ".voucher_itemqty", function(event) {
  			update_voucher_amounts();
   		 });
   		
   		function update_voucher_amounts()
			{
			    var sum = 0.0;
			    $('#voucher_container .row-el').each(function() {
			        var qty = $(this).find('.voucher_itemprice ').val();
			        var price = $(this).find('.voucher_itemqty').val();
			        var amount = (qty*price)
			        sum+=amount;
			        $(this).find('.amount').text(''+amount);
			    });
			    // update the total to sum  
			   // console.log(sum);
			    $('#voucher_price').val(sum);
			}//end

			
		}); //document ready

		
</script>