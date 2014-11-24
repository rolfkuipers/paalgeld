<?php 

function index(){
	//get all distinct captains
	include('config/database.php');
	$query = "SELECT count(`port of origin`) as nName, `port of origin`  FROM `paalgeld` GROUP BY `port of origin` ORDER BY `port of origin` asc";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$row['goods-value'] = $row['tax-decimal'] * 500;
		$data[] = $row;	
	}
	
	//uiteindelijk view laden
	include('views/header.php');
	include('views/all_ports.php');
	include('views/footer.php');
}

function port($port_name) {
	//eventueel database logica en data verwerken
	include('config/database.php');
	$query = "SELECT * FROM `paalgeld` WHERE `port of origin` = '".$port_name."' ";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$row['goods-value'] = $row['tax-decimal'] * 500;
		$data[] = $row;	
	}
	
	//uiteindelijk view laden
	include('views/header.php');
	include('views/port.php');
	include('views/footer.php');
}




if (isset($_GET['port_name'])) {
	port($_GET['port_name']);
} else {
	index();
}
//werken met functies maakt het mogelijk om later met subpaginas te werken


?>