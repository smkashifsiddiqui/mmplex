 
<div id="fsModal"
     class="modal animated bounceIn"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true"> 

  <!-- dialog -->
  <div class="modal-dialog">

    <!-- content -->
    <div class="modal-content" style="padding-top: 0px;">
	<form method="post" action="#">
  <div class="container">
	<div class="row">
		<div class="col-sm-12 header-seat">
			<div class="row">
				<div class="col-sm-6 plan-buttons">
					<button class="btn btn-default empty" type="button">
						<span class="badge" id="empty_badge">0 </span> Seat Empty 
					</button>

					<button class="btn btn-default booked" type="button">
						<span class="badge" id="selected_badge">0 </span> Seat Selected 
					</button>

					<button class="btn btn-default selecting" type="button">
						<span class="badge" id="selecting_badge">0 </span> Seat Selecting 
					</button>
					<div class="clearfix"></div>
					
					<div>
						<div class="col-sm-4 plan-buttons">
							<div class="form-group" style="margin: 0px;">
								<label>
									<input type="radio"  name="ticket_adult" class="ticket_adult" value="yes" checked>
									Adult 
								</label>
								<label>
									<input type="radio"  name="ticket_adult" class="ticket_adult" value="no">
										 Child 
								</label>
							</div>
						</div>
					
						<div class="col-sm-4 complimentary plan-buttons" >
							<div class=" complimentary">
								<label>
									<input type="checkbox"  id="complimentary" name="complimentary" value="yes" >
									Complimentary
								 </label>
							</div>						
						</div>
						
						<div class="col-sm-3  plan-buttons">
							<div class=" ">
								<label>
									<input type="checkbox"  id="reprint" name="reprint" value="yes">
									Reprint
								 </label>
							</div>						
						</div>
					</div >
				</div>
					
					

					<div class="col-sm-3 plan-buttons nopadding" >
						<div class="colors_indicator">Selected<span class="selected_box"></span> Booked<span class="booked_box"></span> Hold<span class="hold_box"></span></div>
					</div>
					

				
				<div class="col-sm-3" style="text-align:right">
				
					<button class="btn btn-secondary seats_btn" id="seats_btn" data-dismiss="modal" >Save </button>
					<button type="button" class="btn btn-secondary seats_btn_cancel">Cancel </button>
					<a href="reprint.php" type="button" class="btn btn-secondary " id="reprint_submit" style="display:none;">Re-Print </a>
				</div>
			</div>
		</div><!-- col-sm-12 -->
   </div><!-- row -->
  </div><!-- container -->
	 
   <!--/header-->

<div class="container seats-container" id="seats-container"> 
	

</div><!-- container -->
</form>
	<?php if($page == "booking"){?>
		
  <?php  } ?>
 </div>

    <!-- content -->

  </div>
  <!-- dialog -->

</div>
<!-- modal -->
<script>
var childWindow = "";
		    var newTabUrl="http://localhost/cinema/user_booking_screen.php";

		    function openNewTab(){
		        childWindow = window.open(newTabUrl);
		    }

		    function refreshExistingTab(){
		        childWindow.location.href=newTabUrl;
		    }
</script>
