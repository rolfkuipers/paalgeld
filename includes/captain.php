<?php 

function index(){
	//get all  captains
	include('config/database.php');
	$query = "SELECT count(`captain fam name`) as nName, `captain fam name`  FROM `paalgeld` GROUP BY `captain fam name` ORDER BY `captain fam name` asc";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$row['goods-value'] = $row['tax-decimal'] * 500;
		$data[] = $row;	
	}
	
	//uiteindelijk view laden
	include('views/header.php');
	include('views/all_captains.php');
	include('views/footer.php');
}

function captain($captain_name) {
	//eventueel database logica en data verwerken
	include('config/database.php');
	$query = "SELECT paalgeld.*, places.`Modern Country` FROM `paalgeld` LEFT JOIN places ON paalgeld.soundcode = places.Kode WHERE paalgeld.`captain fam name` = '".$captain_name."' ";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$row['goods-value'] = $row['tax-decimal'] * 500;
		$data[] = $row;	
	}
	
	//uiteindelijk view laden
	include('views/header.php');
	include('views/captain.php');
	include('views/footer.php');
}




if (isset($_GET['captain_name'])) {
	captain($_GET['captain_name']);
} else {
	index();
}
//werken met functies maakt het mogelijk om later met subpaginas te werken


?>