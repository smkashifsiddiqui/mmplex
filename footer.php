

</div><!-- wrapper -->
<!--footer-->
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
				<a href="phpExport.php" target="_blank" id="backup_click" style="visibility:hidden;">backup</a>
			</div><!-- col-md-4-->
			
		</div><!-- copyright -->
   </div><!-- row -->
   <!--/footer-->
   
   </div><!-- container -->
   
   <!--/main container--->
   
   
    <!-- Bootstrap core JavaScript -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="assets/js/jquery.datetimepicker.js"></script>
	<script src="assets/js/jquery.keyboard.js"></script>	
	<!-- keyboard extensions (optional) -->
	<script src="assets/js/jquery.keyboard.extension-typing.js"></script>

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

		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
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


			$('.datetimepicker').datetimepicker({
			dayOfWeekStart : 1,
			lang:'en'
			});

		$('.datetimepicker').datetimepicker({step:5});

		$('#showtime_bydate').datetimepicker({
			timepicker:false,
			format:'d/m/Y',
			formatDate:'Y/m/d'
		});

		
		$('.date_p').datetimepicker({
			timepicker:false,
			format:'d/m/Y',
			formatDate:'Y/m/d'
		});
		
		$('.date_p1').datetimepicker({
			timepicker:false,
			format:'d-m-Y',
			formatDate:'Y-m-d'
		});
		
		$('.date_pp').datetimepicker({
			timepicker:false,
			format:'d-m-Y',
			formatDate:'Y-m-d'
		});
		

		var dateToday = new Date();
		$('#showtime_datetime').datetimepicker({
			 minDate : dateToday
		});

		$('.show_date').datetimepicker({
			timepicker:false,
			format:'d-m-Y',
			formatDate:'Y-m-d'
		});

		

		$('#item_bg').on('change', function() {
		  var v = $(this).val();
		  $(this).css("background-color", v);
		});


		$('#package_bg').on('change', function() {
		  var v = $(this).val();
		  $(this).css("background-color", v);
		});

	
    	(function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

 $('#removeProfilePic').click(function(event) {
       $('.profilePic').fadeOut('slow', function() {
        $('#showNewPicSubmit').fadeIn('slow', function() {
         
        });
       });
      });

}); //document ready
jQuery(function(){
		 jQuery('#date_timepicker_start').datetimepicker({
		  format:'Y/m/d',
		  onShow:function( ct ){
		   this.setOptions({
		    maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
		   })
		  },
		  timepicker:false
		 });
		 jQuery('#date_timepicker_end').datetimepicker({
		  format:'Y/m/d',
		  onShow:function( ct ){
		   this.setOptions({
		    minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
		   })
		  },
		  timepicker:false
		 });
		});		

	$('.t_report_filter').on('change', function() {
	   var value = $('input[name="t_report_filter"]:checked').val(); 
	   
	   $('.t_select').hide();
	   $('#'+value).show();
	});
			 
 window.onload = maxWindow;

    function maxWindow() {
        window.moveTo(0, 0);


        if (document.all) {
            top.window.resizeTo(screen.availWidth, screen.availHeight);
        }

        else if (document.layers || document.getElementById) {
            if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) {
                top.window.outerHeight = screen.availHeight;
                top.window.outerWidth = screen.availWidth;
            }
        }
    }
	

	</script>
	
	<script>
	$('#username').keyboard({
		openOn : null,
		stayOpen : true,
		layout : 'qwerty'
	}).addTyping();

	$('#username-opener').click(function(){
		var kb = $('#username').getkeyboard();
		// close the keyboard if the keyboard is visible and the button is clicked a second time
		if ( kb.isOpen ) {
			kb.close();
		} else {
			kb.reveal();
		}
	});
	
	$('#password').keyboard({
		openOn : null,
		stayOpen : true,
		layout : 'qwerty'
	}).addTyping();

	$('#password-opener').click(function(){
		var kb = $('#password').getkeyboard();
		// close the keyboard if the keyboard is visible and the button is clicked a second time
		if ( kb.isOpen ) {
			kb.close();
		} else {
			kb.reveal();
		}
	});
	</script>
 </body>
</html>
