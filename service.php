<?php

require_once 'config.php';
require_once 'common/default_vars.php';
require_once 'common/class.database.php';




function print_f($array = array()){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}


// Custom auto loader
function admin_autoloader($class) {
    include_once ABSPATH.'classes/class.' . $class . '.php';
}
spl_autoload_register('admin_autoloader');

?>
<?php 
$id = (isset($_GET['id']))? $_GET['id'] : NULL;
$start = (isset($_GET['start']))? $_GET['start'] : NULL;
$end = (isset($_GET['end']))? $_GET['end'] : NULL;
	$movie = new movie();
	//$data = $movie->get_service_movies($id,$_GET['status'],$_GET['start'],$_GET['end']);
				//print_f($results);
				// if ($results) {
				// 	foreach($results as $res){
				// 		print_f($res);
				// 	}
				// }
   header('Content-Type: application/json');
   echo  json_encode($movie->get_service_movies($id,$_GET['status'],$start,$end));
?>

	