<?php require_once 'header.php'; ?>
<?php
if($_SESSION['user']->capabilities != 'null'){
	$user_capabilities = $_SESSION['user']->capabilities;
	$user_capabilities = (!empty($user_capabilities))? json_decode($user_capabilities) : array();


}else{$user_capabilities = array('empty'); }

if(in_array('ticket_sale_by_movie', $user_capabilities)){


	?>
	<?php
	$reports = new reports();

	$distributer = new distributer();
	$all_distributer = $distributer->get_distributers();

	$movie = new movie();
	$all_movie = $movie->get_movies();


	$showtime = new showtime();
	$all_showtime = $showtime->get_all_showtimes();

	?>
	<div class="container no-print">

		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li><a href="view_ticket_reports.php">Reports Ticket</a></li>
				<li class="active">Seats bookings by day</li>
			</ol>
		</div><!--row-->

		<form class="form-horizontal dashboardForm"  action="" method="post">
			<div class="row gray-header">
				<div class="col-md-12">
					<div class="form-header-inner">
						<div class="col-sm-6">
							<h3>Todays Seats Booking</h3>
						</div>
						<div class="col-sm-6 action_btn">
							<button type="button" class="btn submitBtn cancel-button" onclick="window.print()" name="">Print</button>
							<button type="submit" class="btn submitBtn save-button" name="g_ticketsales">Generate Report</button>

						</div>
					</div>
				</div>
			</div><!--row-->

			<div class="form-container">

				<div class="col-md-6">

					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="col-sm-4 control-label"><span>*</span>  Date: </label>
							<div class="col-sm-8">
								<input type="text" name="istart_date" id="" value="<?php if(isset($_POST['istart_date'] ) && $_POST['istart_date'] != ""){echo $_POST['istart_date'];}?>" class="form-control date_pp" >
							</div>
						</div>
					</div>

					<div class="col-md-12 t_select" id="showtime_movie_id"  >
						<div class="form-group">
							<label for="showtime_movie_id"  class="col-sm-4 control-label"><span>* </span> Show Movie: </label>
							<div class="col-sm-8">
								<select  name="t_movie_id"  class="form-control" required>
									<option value=""  selected disabled >Select Movie</option>
									<?php
									foreach ($all_movie as $value){ ?>

										<option value="<?php echo $value->movie_id; ?>" <?php if(isset($_POST['t_movie_id'] ) && $_POST['t_movie_id'] == $value->movie_id){echo 'selected=selected';}?>><?php echo $value->movie_title; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>

					<div class="clear"></div>


				</div><!-- col-md-6 -->

				<div class="col-md-6">
				</div><!-- col-md-6 -->
		</form>
		<?php

		if (isset($_POST['g_ticketsales'])) {

			if($_POST['istart_date']){
				$s_date1 	= $_POST['istart_date'];
				$s_date = $reports->_date('Y-m-d', $s_date1);

			}
			else {
				$s_date = NULL;
			}

			if(isset($_POST['t_movie_id'])){
				$m_id 	= $_POST['t_movie_id'];
			}
			else {
				$m_id = NULL;
			}

			//$results = $reports->get_ticket_sales_by_movie($s_date,$m_id);

			$results = $reports->get_movies_shows($m_id,$s_date);
			//print_f($s_date);

			//print_f($results);
			//die();

		}
		?>

		<div class="col-md-12">
			<div class="the-box full no-border">
				<div class="table-responsive">
					<?php

					if (isset($results)) {

						?>

						<table border="1" cellpadding="0" cellspacing="0" id="example" class="table table-hover tableView admin-table" style="    font-size: 12px; font-weight: bold;font-family: helvetica;">
							<thead>

							<tr>
								<th style=" font-size: 14px;"><strong>Report Date : </strong><strong><?php echo $s_date; ?></strong></th>
								<th style=" font-size: 14px;"></th>

								<th style=" font-size: 14px;"></th>
								<th style=" font-size: 14px;"><strong> Current time : </strong><strong><?php echo $current_date_time; ?></strong></th>

							</tr>



							<tr>

								<td>Screen </td>
								<td>Showtime </td>
								<td>Qty</td>
								<td>Price</td>
							</tr>

							</thead>


							<tbody class="searchable">


							<?php
							//print_f($results);
							$sub_total = 0;
							$price_sub_total = 0;
							foreach ($results as $key => $value){

								?>
								<tr>




									<td><?php echo $value->screen_name; ?> </td>
									<td><?php echo $reports->_date('d-m-y h:i a', $value->showtime_datetime); ?></td>
									<td><?php $tickets_qty = $reports->get_ticket_sale_by_show_id($value->showtime_id); 
										echo $total = $tickets_qty->booked_seats; if($tickets_qty->booked_seats == ""){echo 0;}?></td>
									<td><?php echo $price_total = $tickets_qty->amount ;?>


								</tr>
								<?php

								$sub_total += $total;
								$price_sub_total += $price_total;
							}
							?>

							<tr>



								<th></th>
								<th style=" font-size: 14px;"><strong>Total</strong></th>
								<th style=" font-size: 14px;"><strong><?php echo $sub_total; ?></strong></th>
								<th style=" font-size: 14px;"><strong><?php echo $price_sub_total; ?></strong></th>
							</tr>
							</tbody>

						</table>


					<?php }  // end result?>
				</div><!-- /.table-responsive -->
			</div>
		</div><!-- /col-md-12 -->

	</div>
	</div><!-- Container Close -->

	<?php if (isset($results)) { ?>
		<div class="voucher printPirnter" style="visibility:hidden;">
			<table  class="border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin-left:auto;margin-right:auto;font-size: 10px; font-weight: bold;font-family: helvetica;  ">
				<tr>

				<tr>
					<th colspan="4" style="text-align:center;"><strong><?php $all_movie = $movie->get_movies($m_id);
							echo $all_movie->movie_title;
							?></strong></th>
				</tr>

				<th style="width:175px;text-align:center;"><strong>Report Date</strong></th>
				<th style="width:175px;text-align:center;"><strong><?php echo $s_date; ?></strong></th>

				<th style="width:175px;text-align:center;"><strong></strong></th>
				<th style="width:175px;text-align:center;"><strong><?php echo date("d-M-y h:i"); ?></strong></th>
				</tr>


			</table>
			<div class="border" style="margin-top:5px;"></div>
			<table  class=" border" cellpadding="1" cellspacing="1" style="text-align:center;width:700px;margin:auto;font-size: 10px; font-weight: bold;font-family: helvetica; ">
				<thead>

				<tr>

					<td>Screen </td>
					<td>Showtime </td>
					<td>Qty</td>
					<td>Price</td>
				</tr>

				</thead>


				<tbody class="searchable">


				<?php
				//print_f($results);
				$sub_total = 0;
				$price_sub_total = 0;
				foreach ($results as $key => $value){
					$new_date = $reports->_date('Y-m-d', $value->showtime_datetime);


					//if($s_date == $new_date){
						?>
						<tr>




							<td><?php echo $value->screen_name; ?><?php echo "showId:".$value->showtime_id; ?></td>
							<td><?php echo $reports->_date('d-m-y h:i a', $value->showtime_datetime); ?></td>
							<td><?php $tickets_qty = $reports->get_ticket_sale_by_show_id($value->showtime_id);
								echo $total = $tickets_qty->booked_seats; if($tickets_qty->booked_seats == ""){echo 0;}?></td>
							<td><?php echo $price_total = $tickets_qty->amount;?>


						</tr>
						<?php

						$sub_total += $total;
						$price_sub_total += $price_total;
					//}
	}
				?>

				<tr>


					<th></th>
					<th style=" font-size: 14px;text-align:center;"><strong>Total</strong></th>
					<th style=" font-size: 14px;text-align:center;"><strong><?php echo $sub_total; ?></strong></th>
					<th style=" font-size: 14px;text-align:center;"><strong><?php echo $price_sub_total; ?></strong></th>
				</tr>
				</tbody>

			</table>
			<div class="voucher printPirnter border" style="margin-top:5px;"></div>

		</div>
	<?php } ?>

<?php }else{
	echo '<div class="col-md-10 col-md-offset-1 paddingTop marginTop" style="text-align: center;padding-top: 20px;"><img src="assets/images/access.jpg" style="margin:auto;display:block;"/>';
	echo '<button class="btn submitBtn cancel-button btn-primary" onclick="goBack()" style="clear:both;margin-top:10px;">Go Back!</button></div>';
	echo '<script>function goBack() { window.history.back();}</script>';

}
?>
<?php require_once 'footer.php'; ?>
