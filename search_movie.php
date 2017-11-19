<?php

require_once 'config.php';
require_once 'common/default_vars.php';
require_once 'common/class.database.php';

// Custom auto loader
function admin_autoloader($class) {
    include_once ABSPATH.'classes/class.' . $class . '.php';
}
spl_autoload_register('admin_autoloader');

?>
<?php 
$id = (isset($_GET['q']))? $_GET['q'] : NULL;
$movie = new movie();
header('Content-Type: application/json');
echo  json_encode($movie->search_movies_service($_GET['q']));
?>

	