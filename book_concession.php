<?php 
require_once 'common/init.php';

echo '<style>';
echo '@media print { .no-print { display: none; }</style>';
//print_f($_SESSION['all_concession_sess']);
$concession = new concession();
if(isset($_SESSION['all_concession_sess'])){
$concession_session = $_SESSION['all_concession_sess'];
//print_f($concession_session );
echo'<table class="slip" style="width:250px;border:1px solid black;margin:auto;text-align:left;font-size:13px;font-family:helvetica;">';
echo'<tr><th colspan="2" style="text-align: center;">Mega Multiplex</th></tr>';
echo'<tr><th colspan="2" style="text-align: center;">Millenium Mall Karachi</th></tr>';
echo'<tr><th colspan="2" style="text-align: center;"></th></tr>';
echo'<tr><th  colspan="2"><hr style="border-top: none; border-bottom:1px dashed #000; height:1px;"/></th></tr>';
echo'<tr><th colspan="2" style="text-align: center;">Sales Receipt</th></tr>';
echo'<tr><th  colspan="2"><hr style="border-top: none; border-bottom:1px dashed #000; height:1px;"/></th></tr>';
echo'<tr><th style="font-size: 11px;font-weight: normal;">Transaction no: </th><th style="font-size: 11px;font-weight: normal;">'.$concession_session[0]['order_id'].'</th></tr>';
echo'<tr><th style="font-size: 11px;font-weight: normal;">Date: '.date("d-m-y").'</th><th style="font-size: 11px;font-weight: normal;">Time: '.date("h:i a").'</th></tr>';
echo'<tr><th style="font-size: 11px;font-weight: normal;">Cashier: </th><th style="font-size: 11px;font-weight: normal;">'.$_SESSION['user']->first_name.'</th></tr>';
echo'<tr><th  colspan="2"><hr style="border-top: none; border-bottom:1px dashed #000; height:1px;"/></th></tr>';
echo'<tr><th>Item</th><th>Price</th></tr>';
echo'<tr><th  colspan="2"><hr style="border-top: none; border-bottom:1px dashed #000; height:1px;"/></th></tr>';
foreach($concession_session as $concession_session_v){
   
   $concession_detail = $concession->get_concession_details($concession_session_v['con_inserted_id']);
   $c_type = $concession_detail[0]->con_booking_type;
   //print_f($concession_detail);

   if($c_type == 'item'){
    $item_detail = $concession->get_item_details($concession_detail[0]->con_booking_type_id);
    //print_f($item_detail);
    
    echo'<tr><td>'.$item_detail[0]->item_name.' X '.$concession_detail[0]->con_booking_qty.'</td><td>'.$concession_detail[0]->con_booking_price * $concession_detail[0]->con_booking_qty.'</td></tr>';
    

   }else{

    $package_detail = $concession->get_package_details($concession_detail[0]->con_booking_type_id);
    echo'<tr><th>'.$package_detail[0]->package_name.'</th><th>'.$concession_detail[0]->con_booking_price * $concession_detail[0]->con_booking_qty.'</th></tr>';

    $current_i = $package_detail[0]->package_item_name;
   $current_i = (!empty($current_i))? json_decode($current_i) : array();
  
  foreach ($current_i as $current_i_values){

    $p_item_detail = $concession->get_item_details($current_i_values);
    echo'<tr><td style="font-size:10px;">'.$p_item_detail[0]->item_name.' X '.$concession_detail[0]->con_booking_qty.'</td><td></td></tr>';
    
  }
   

   }
   //get_package_details
   //get_item_details

 } 
echo'<tr><th  colspan="2"><hr style="border-top: none; border-bottom:1px dashed #000; height:1px;"/></th></tr>';
echo'<tr><th>Net Amount: </th><th>'.$_GET['total'].'</th></tr>';
echo'<tr><th  colspan="2"><hr style="border-top: none; border-bottom:1px dashed #000; height:1px;"/></th></tr>';
echo'<tr><th style="text-align: center;" colspan="2">Thank you </th></tr>';
echo'<tr><th style="text-align: center;" colspan="2">Millenium Mall Karachi </th></tr>';
echo'<tr><th style="text-align: center;" colspan="2">http://megamultiplex.com.pk</th></tr>';

echo'</table>';
}

 ?>
 

<button class="btn submitBtn btn-primary no-print" id="direct_print"  onclick="print_now()" style="visibility:hidden;clear:both;margin-top:10px;">Print</button></div>

<a href="concession.php"><button class="btn submitBtn cancel-button btn-primary no-print" onclick="window.close()"  style="clear:both;margin-top:10px;">Go Back!</button></a></div>
<button class="btn submitBtn btn-primary no-print" onclick="print_now()"  id="print_it" style="clear:both;margin-top:10px;">Print</button></div>
<script src="assets/js/jquery.latest.js"></script>
<script>

    function print_now(){
		 window.print();
		 explode();
		 
		
				
	}
	
	function explode(){
		 $.post('ajax.php', {'action': 'end_all_concession_sess'}, function(data){
				console.log(data);
			});
		}
	setTimeout(explode, 2000);
</script>
 <?php if(isset($_GET['print']) &&  $_GET['print'] == 'yes'){
  echo '<script>$( document ).ready(function() { $( "#direct_print" ).trigger( "click" ); });</script>';
}?>
