<?php 

function index(){
	//get all distinct captains
	include('config/database.php');
	$query = "SELECT count(`shipname`) as nName, `shipname`  FROM `paalgeld` GROUP BY `shipname` ORDER BY `shipname` asc";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$data[] = $row;	
	}
	
	//uiteindelijk view laden
	include('views/header.php');
	include('views/all_ships.php');
	include('views/footer.php');
}


function ship($shipname) {
	//eventueel database logica en data verwerken
	include('config/database.php');
	$query = "SELECT * FROM `paalgeld` WHERE `shipname` = '".addslashes($shipname)."' ";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$data[] = $row;	
	}

	//uiteindelijk view laden
	include('views/header.php');
	include('views/ship.php');
	include('views/footer.php');
}


if (isset($_GET['ship_name'])) {
	ship($_GET['ship_name']);
} else {
	index();
}
//werken met functies maakt het mogelijk om later met subpaginas te werken


?>