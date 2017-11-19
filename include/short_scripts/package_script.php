<script>
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
									<div class="col-md-2 col-md-offset-1 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('itemcontainer').appendChild(div);
		}

		$("#itemcontainer").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
				update_amounts();
			});

		
$(document).ready(function(){
		update_amounts();

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
 });
</script>	