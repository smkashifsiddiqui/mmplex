<script>
        function addRow1() {
		var div = document.createElement('div');
		div.className = 'row';
		div.innerHTML = '<div class="col-md-12 row-el">\
								<div class="col-md-5">\
									<div class="form-group">\
										<label class="col-sm-3 control-label">Actor</label>\
										<div class="col-sm-9">\
											<select name="movie_actors[]" class="form-control"><?php foreach ($all_movie_person as $movie_person_value){ ?><option value="<?php echo $movie_person_value->movie_person_id; ?>"><?php echo $movie_person_value->movie_person_name; ?></option><?php } ?></select>\
										</div>\
								  	</div>\
								</div>\
								<div class="col-md-5">\
									<div class="form-group">\
										<label class="col-sm-3 control-label">Role</label>\
										<div class="col-sm-9">\
											<select name="movie_actors_role[]" class="form-control"><?php foreach($movie_actors_role as $movie_actors_role_key => $movie_actors_role_value){?><option value="<?php echo $movie_actors_role_key ;?>"><?php echo $movie_actors_role_value ;?></option><?php } ?></select>\
										</div>\
									</div>\
								</div>\
									<div class="col-md-2 txt-center">\
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
</script>	