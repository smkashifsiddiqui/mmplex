<script>
        function addRow() {
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-4">\
									<div class="form-group">\
										<label class="col-sm-4 control-label">Row Name</label>\
										<div class="col-sm-8">\
											<input type="text" name="screen_rows[]" id="screen_rows" value="" class="form-control" required>\
										</div>\
								  	</div>\
								</div>\
								<div class="col-md-5">\
									<div class="form-group">\
										<label class="col-sm-5 control-label">Seats per Row</label>\
										<div class="col-sm-6">\
											<input type="number" name="screen_row_column[]" id="row_columns" value="" class="form-control" required>\
										</div>\
									</div>\
								</div>\
									<div class="col-md-3 txt-center">\
										<button type="button" class="btn submitBtn minus-btn" value="" >Remove x</button>\
									</div>\
								</div>\
							</div>';
		 document.getElementById('content').appendChild(div);
		}
		
		
		// Minus Button function for Offer Page
			$("#content").on('click', '.minus-btn', function() {
				$(this).parents('.row-el').parent('.row').remove();
			});
</script>	