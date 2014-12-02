<?php 
#	Chris Pool
#	25-11-2014
#	includes/captain.php

function index(){
	//get all  distinct captains
	include('config/database.php');
	$query = "SELECT `captain first names`, count(`captain fam name`) as nName, `captain fam name`, `tax-decimal`
		FROM `paalgeld` 
		GROUP BY `captain fam name` 
		ORDER BY `captain fam name` asc";
	
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		/*
		Calculate value of goods, tax is 2%, 
		so tax-decimal * 500 gives total amount
		*/
		$row['goods_value'] = $row['tax-decimal'] * 500;
		$data[] = $row;	
	}
	
	//Load view
	include('views/header.php');
	include('views/all_captains.php');
	
	include('views/footer.php');
}

function captain($captain_name) {
	//load specific captain
	include('config/database.php');
	
	$query = "SELECT paalgeld.* , places.`Stednavn` as places_name, places.`Modern Country` as places_country  
		FROM `paalgeld` 
		LEFT JOIN places ON paalgeld.`soundcode` = places.`Kode` 
		WHERE paalgeld.`captain fam name` = '".$captain_name."' ";
	
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		/*
		Calculate value of goods, tax is 2%, 
		so tax-decimal * 500 gives total amount
		*/
		$row['goods_value'] = $row['tax-decimal'] * 500;

		
		/*
		Check if the modern country name is available
		otherwise use 'Unknown'
		*/
		if (isset($row['places_country'])) {
			$row['country_name'] = $row['places_country'];
		} else {
			$row['country_name'] = 'Unknown';		
		}

		/*
		if the portname is known in the places table use that 
		otherwise use the port of origin field
		in the paalgeld table
		*/
		if (isset($row['places_name'])) {
			$row['port_name'] = $row['places_name'];
			
		} else {
			$row['port_name'] = $row['port of origin'];		
		}
		$data[] = $row;
	}
	
	//load views
	include('views/header.php');
	include('views/captain.php');
	include('views/footer.php');
}

if (isset($_GET['captain_name'])) {
	captain($_GET['captain_name']);
} else {
	index();
}



?>