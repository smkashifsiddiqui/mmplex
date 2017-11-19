<?php $all_showtime = $showtime->get_public_showtimes(); 
//print_f($all_showtime);
?>
<script type="text/javascript" src="assets/js/timeline.js"></script>	
	<script type="text/javascript">
    // Create some JSON data

     var data = [
     <?php foreach($all_showtime as $res) {
        $initial_time = $res->showtime_datetime;
        $initial_time1 = strtotime($initial_time);
        $initial_time2 = date('Y,m,d,H,i,s', $initial_time1);
        list($year, $month, $day, $hour, $minute, $second) = explode(",", $initial_time2);
        if($month == '01'){
            $month = '00';
            $initial_time3 = $year.",".$month.",".$day.",".$hour.",".$minute.",".$second;
        }else{
            $month = +$month - 1;
            $initial_time3 = $year.",".$month.",".$day.",".$hour.",".$minute.",".$second;
        }
        //echo $month;
        //$initial_time1 = strtotime($initial_time . ' -1 month');
        //$initial_time2 = date('Y,m,d,H,i,s', $initial_time1);

        $movie_time = $res->movie_duration;
        $cleanup_time = $res->showtime_cleanup;
        $trailer_time = $res->showtime_trailer_duration - 5;
        $interval_time = $res->showtime_interval;
       
        $total_time = $cleanup_time + $trailer_time + $movie_time + $interval_time;

       
       
        $final_time = date('Y-m-d H:i:s', $initial_time1);
        $final_time2 = strtotime($final_time . ' + '.$total_time.' minutes');
        $final_time3 = date('Y,m,d,H,i,s', $final_time2);
        list($yearf, $monthf, $dayf, $hourf, $minutef, $secondf) = explode(",", $final_time3);
        if($monthf == '01'){
            $monthf = '00';
            $final_time4 = $yearf.",".$monthf.",".$dayf.",".$hourf.",".$minutef.",".$secondf;
        }else{
            $monthf = +$monthf - 1;
            $final_time4 = $yearf.",".$monthf.",".$dayf.",".$hourf.",".$minutef.",".$secondf;
        }


        $start_label = date('H:i:s', $initial_time1);
        $end_label = date('H:i:s', $final_time2);

        ?>
        {
            'start': new Date(<?php echo $initial_time3; ?>), 
            'end': new Date(<?php echo $final_time4; ?>),
            'content': '<a href="edit_showtime.php?id=<?php echo $res->showtime_id?>"><?php echo $res->movie_title; ?> ( <?php echo $res->movie_duration; ?> min)<p class="film_small_desc"> Start Time: <?php echo $start_label; ?> End Time: <?php echo $end_label; ?></p></a>',
            'editable': false,
            'group': '<?php echo $res->screen_name; ?>',
            'className': 'timeline_film_detail <?php echo $res->showtime_color; ?>'
        },
        <?php }?>
    ];

    // specify options
    var options = {
        'width':  '100%',
        'height': '260px',
        'editable': true,   // enable dragging and editing events
        'layout': 'box',
		axisOnTop: true,
        start: new Date(2015,9,23,0,0,0),
		/*min: new Date(2010,7,20,0,0,0),
		max: new Date(2010,8,20,24,0,0),*/
		'zoomable':false,
		"intervalMin": 3600000 * 7, // one hour in milliseconds
		"intervalMax": 3600000 * 7 , 
		
		
    };
	
    // Instantiate our timeline object.
    var timeline = new links.Timeline(document.getElementById('mytimeline'), options);

     // cancel any running animation as soon as the user changes the range
            links.events.addListener(timeline, 'rangechange', function (properties) {
                animateCancel();
            });
    // Draw our timeline with the created data and options
    timeline.draw(data);

   $(".form-container").on('click', '.checktime', function(event) {

        var dateToday = new Date();
        
        $('.checktime').datetimepicker({
			datepicker:false,
            lang:'en',
			format:'H:i',
            });
        $('.checktime').datetimepicker({step:10});

    });
    
    
    $(".form-container").on('focusout', '.checktime', function(event) {

            event.preventDefault();
            
            var getshowtime_cinema = $('#showtime_screen_id').val();
            var getshowmovie = $('#showtime_movie_id').val();
            var showtime_trailer_duration = $('#showtime_trailer_duration').val();
            var showtime_cleanup = $('#showtime_cleanup').val();
            var showtime_interval = $('#showtime_interval').val();
            var getshowtime = $(this).val();
            var s_id = $(this).attr('id');
            <?php if(isset($_GET['id'])) {?>
            var itsid =  <?php echo $_GET['id'];?>;
            <?php }else{?>
            var itsid = '';
            <?php }?>
             
            <?php if(!isset($_GET['id'])) {?>
            $.post('ajax.php', {'s_id': s_id,'action': 'delete_temp_showtime'}, function(data1) {
               //console.log('delected');
                 }); //ajax
            <?php } ?>
           if(getshowtime_cinema == null || getshowmovie == null){
                $('#time_confilict').show().text('Select movie and screen first!');
                $('#showtime_datetime').val('');
               
           }else{

            $('#time_confilict').hide();
            

            
            $.post('ajax.php', {'showid': itsid, 'getshowtime': getshowtime, 'getshowtime_cinema' : getshowtime_cinema, 'getshowmovie' : getshowmovie, 'showtime_trailer_duration' : showtime_trailer_duration, 'showtime_cleanup' : showtime_cleanup, 'showtime_interval' : showtime_interval,  'action': 'getshowtime_detail'}, function(data) {
               
                 console.log(data);

             if(data == 'yes'){
                  $('#time_confilict').show().text('This showtime can confilict with other!');
                    
                    
                 }else{ 
                   $('#time_confilict').hide();
                   if(getshowtime != ""){
                    $.post('ajax.php', {'s_id': s_id, 's_value' : getshowtime, 'action': 'check_temp_showtime'}, function(data1) {
                        if(data1.check_showtime_select_id == s_id){
                            
                            $.post('ajax.php', {'s_id': s_id, 's_value' : getshowtime,'s_movie' : getshowmovie, 's_screen' : getshowtime_cinema,'action': 'update_temp_showtime'}, function(data1) {
                                console.log('old');
                              }); //ajax
                        }
                        else{

                            $.post('ajax.php', {'te_id':s_id,'te_value':getshowtime,'te_movie':getshowmovie,'te_screen':getshowtime_cinema,'action': 'in_showtime'}, function(data1) {
                              
                               console.log('new');
                                
                                 }); //ajax
                             
                            
                        }//else
                        
                     }); //ajax
                    }//if
                   
             }//else
              

           }); //ajax
            
            }//else

            });//end checktime

// create a simple animation
        var animateTimeout = undefined;
        var animateFinal = undefined;
        function animateTo(date) {
            // get the new final date
            var d = new Date(date);
            var n = d.getMonth();
            if(n == 1){var date1 = d.setMonth(0);}
            else{var date1 = d.setMonth(+n-1);}
            
            animateFinal = date1.valueOf();
            timeline.setCustomTime(date1);

            // cancel any running animation
            animateCancel();

            // animate towards the final date
            var animate = function () {
                var range = timeline.getVisibleChartRange();
                var current = (range.start.getTime() + range.end.getTime())/ 2;
                var width = (range.end.getTime() - range.start.getTime());
                var minDiff = Math.max(width / 1000, 1);
                var diff = (animateFinal - current);
                if (Math.abs(diff) > minDiff) {
                    // move towards the final date
                    var start = new Date(range.start.getTime() + diff / 4);
                    var end = new Date(range.end.getTime() + diff / 4);
                    timeline.setVisibleChartRange(start, end);

                    // start next timer
                    animateTimeout = setTimeout(animate, 50);
                }
            };
            animate();
        }
        function animateCancel () {
            if (animateTimeout) {
                clearTimeout(animateTimeout);
                animateTimeout = undefined;
            }
        }

        function go () {
            // interpret the value as a date formatted as "yyyy-MM-dd"
            var v = document.getElementById('animateDate').value.split('-');
          
            var date = new Date(v[0], v[1], v[2]);
           
            if (date.toString() == "Invalid Date") {
                $('#invalid_time').fadeIn('slow').delay(1000).fadeOut('slow');
            }
            else {
                animateTo(date);
            }
        }

$( document ).ready(function() {
    <?php 
     $getnowdate="";
        if(isset($_GET['id'])){
            $getnowdate1 = $showtime_result->showtime_datetime;
            $getnowdate2 = strtotime($getnowdate1);
             $getnowdate = date('Y-m-d', $getnowdate2);
         }else{
            $getnowdate = date('Y-m-d');
        } ?>
    
    $('#animateDate').val('<?php echo $getnowdate;?>');
    go();
	
	$(".form-container").on('click', '.make_clone', function() {
		$('.delete_clone').prop('disabled', false);
		var newNum = $('.clone_div_parent').find(".clone_div").length;
		console.log('aa');
        var $htmlStr = $(this).parent(".clone_div");
        //$htmlStr.clone().find('.clone_div_parent').appendTo($htmlStr);
		 $($htmlStr).clone().attr('id', 'clone_div' + newNum).appendTo('.clone_div_parent').find('.clone_div');
		 
		 $('#clone_div'+ newNum+ ' .time').each(function () {
				$(this).attr('name','show_day['+newNum+'][time][]');
			 });
		
		 $('#clone_div'+ newNum+ ' .show_day').each(function () {
				$(this).attr('name','show_day['+newNum+'][day]');
				$(this).val("");
			 });
		
    });

	
	 
	$(".form-container").on('click', '.clone_time', function() {
		 console.log('bb');
			var len = $(this).parent().parent().find(".row-el").length;
			var arrayindex = $('.clone_div_parent').find(".show_day").length -1;
			
			var text = '<div class="col-md-12 row-el" style="border-bottom:0px;margin-bottom:0px;">';
			text += '<div class="col-md-6 form-group date_label">';
			text += '<label for="showtime_datetime" class="col-sm-3 control-label"><span>* </span> Timings: </label>';
			text += '<div class="col-sm-8 show" style="position:relative;">';
			text += '<input type="text" name="show_day['+arrayindex+'][time][]" id="showtime_datetime'+len+'" value="" class="time date_p form-control" placeholder="Time" style="width:100px;margin-left: 4px;" required>';
			text += '<button type="button" class="btn submitBtn minus-btn" value="" >-</button>';
			text += '</div>';
			text += '</div>';
			text += '</div>';
		
		 //document.getElementById("content1").append(text);
		 var paren_div = $(this).parent().parent(".inner_clone_div_parent");
		  $(text).appendTo(paren_div).find('.row-el');
		 
       });
	   
	   
});
</script>

<script>
        
        
        
        // Minus Button function for Offer Page
            $(".form-container").on('click', '.minus-btn', function() {
                var s_id = $(this).parent('.show').find('.checktime').attr('id');
                $.post('ajax.php', {'s_id': s_id,'action': 'delete_temp_showtime'}, function(data1) {
                    console.log('delected');
                }); //ajax
                $(this).parent().parent().parent('.row-el').remove();


            });
			
			$(".form-container").on('click', '.delete_clone', function() {
                var s_id = $(this).parent('.show').find('.checktime').attr('id');
                $.post('ajax.php', {'s_id': s_id,'action': 'delete_temp_showtime'}, function(data1) {
                    console.log('delected');
                }); //ajax
                $(this).parent('.clone_div').remove();


            });
			
			 $(".form-container").on('click', '.date_p', function(event) {

				$('.date_p').datetimepicker({
					datepicker:false,
					format:'H:i',
					});
				$('.date_p').datetimepicker({step:10});

			});
			
			$(".form-container").on('click', '.show_day', function(event) {

				var dateToday = new Date();
				
				$('.show_day').datetimepicker({
					format:'Y/m/d',
					timepicker:false,
					dayOfWeekStart : 1,
					lang:'en',
					minDate : dateToday
					});
				$('.show_day').datetimepicker({step:10});

			});
			
			
			 $(".form-container").on('focusout', '.show_day', function(event) {
				 
					var textValues = new Array();
						$("input.show_day").each(function() {
							
							doesExisit = ($.inArray($(this).val(), textValues) == -1) ? false : true;
							console.log(textValues)
							if (!doesExisit) {
								textValues.push($(this).val());
								$('#add_showtime').prop('disabled', false);
								$('.make_clone').prop('disabled', false);
								$(this).parent().parent().parent().parent().find('#time_confilict').hide();
								
								
							} else {
								console.log('duplicate');
								$(this).parent().parent().parent().parent().find('#time_confilict').show();
								$('#add_showtime').prop('disabled', true);
								$('.make_clone').prop('disabled', true);
							
								
							}
						});
			
			});
			
			
			$(".form-container").on('focusout', '.time ', function(event) {
				 
					var textValues = new Array();
					var its_parent = $(this).parent().parent().parent().parent().parent().attr('id');
					console.log(its_parent);
					$( "#"+its_parent+ " input.time").each(function() {
							
							doesExisit = ($.inArray($(this).val(), textValues) == -1) ? false : true;
							console.log(textValues)
							if (!doesExisit) {
								textValues.push($(this).val());
								$('#add_showtime').prop('disabled', false);
								$('.make_clone').prop('disabled', false);
								$(this).parent().parent().parent().parent().parent().find('#time_confilict').hide();
								
								
							} else {
								console.log('duplicate');
								$(this).parent().parent().parent().parent().parent().find('#time_confilict').show();
								$('#add_showtime').prop('disabled', true);
								$('.make_clone').prop('disabled', true);
							
								
							}
						});
			
			});
			
			
</script>   