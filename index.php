<?php 
// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

if (isset($_GET['page'])) {
	
	include('includes/'.$_GET['page'].'.php');

} else {
	//load default page
	include('includes/start.php');
}

?>
