<?php $all_showtime = $showtime->get_private_showtimes(); 
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
        $trailer_time = $res->showtime_trailer_duration;
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
            'content': '<a href="add_private_showtime.php?id=<?php echo $res->showtime_id?>"><?php echo $res->movie_title; ?><p class="film_small_desc"> Start Time: <?php echo $start_label; ?> End Time: <?php echo $end_label; ?></p></a>',
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
        end: new Date(2015,9,0,0,0,0),  //new Date(<?php echo date("Y,m,d,h,i,s"); ?>),
		/*min: new Date(2010,7,20,0,0,0),
		 max: new Date(2010,8,20,24,0,0),*/
		'zoomable':false,
		"intervalMin": 3600000 * 7, // one hour in milliseconds
		"intervalMax": 3600000 * 7 , 
		
		
    };
	
    // Instantiate our timeline object.
    var timeline = new links.Timeline(document.getElementById('mytimeline'), options);

    // Draw our timeline with the created data and options
    timeline.draw(data);

    $(".form-container").on('click', '.checktime', function(event) {

        var dateToday = new Date();
        
        $('.checktime').datetimepicker({
            dayOfWeekStart : 1,
            lang:'en',
            minDate : dateToday
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

        }//end


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
});
</script>