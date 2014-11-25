<?php 


if (isset($_GET['page'])) {
	
	include('includes/'.$_GET['page'].'.php');

} else {
	//load default page
	include('includes/start.php');
}

?>
