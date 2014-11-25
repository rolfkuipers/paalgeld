<?php 
#	Chris Pool
#	25-11-2014
#	includes/ship.php

function index(){
	//get all distinct ships
	include('config/database.php');
	$query = "SELECT count(`shipname`) as nName, `shipname`, `tax-decimal`  
		FROM `paalgeld` 
		GROUP BY `shipname` 
		ORDER BY `shipname` asc";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$data[] = $row;	
	}
	
	//load view
	include('views/header.php');
	include('views/all_ships.php');
	include('views/footer.php');
}


function ship($shipname) {
	include('config/database.php');
	$query = "SELECT paalgeld.* , places.`Stednavn` as places_name, places.`Modern Country` as places_country 
		FROM `paalgeld` 
		LEFT JOIN places ON paalgeld.`soundcode` = places.`Kode` 
		WHERE paalgeld.`shipname` = '".addslashes($shipname)."' ";

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
			$country_name =  $row['places_country'];
		} else {
			$row['country_name'] = 'Unknown';
			$country_name = 'Unknown';
		}

		/*
		if the portname is known in the places table use that 
		otherwise use the port of origin field
		in the paalgeld table
		*/
		if (isset($row['places_name'])) {
			$row['port_name'] = $row['places_name'];
			$port_name = $row['places_name'];
		} else {
			$row['port_name'] = $row['port of origin'];
			$port_name = $row['port of origin'];
		}
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