<?php 
#	Chris Pool
#	25-11-2014
#	includes/port.php

function index(){
	//get all distinct ports
	include('config/database.php');
	$query = "SELECT count(paalgeld.`port of origin`) as nName,places.`Modern Country` as places_country, paalgeld.`soundcode`, places.`Stednavn` as places_name, paalgeld.`port of origin` as paalgeld_name, paalgeld.`tax-decimal` 
		FROM `paalgeld` LEFT JOIN places ON paalgeld.`soundcode` = places.`Kode` 
		GROUP BY paalgeld.`soundcode` 
		ORDER BY paalgeld.`port of origin`, places.`Stednavn` asc";
	
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
			$row['port_name'] = $row['paalgeld_name'];		
		}
		$data[] = $row;	
	}
	
	//Load views
	include('views/header.php');
	include('views/all_ports.php');
	include('views/footer.php');
}

function port($port_soundcode) {
	//Get specific Port
	include('config/database.php');
	$query = "SELECT paalgeld.* , places.`Stednavn` as places_name, places.`Modern Country` as places_country 
		FROM `paalgeld` 
		LEFT JOIN places ON paalgeld.`soundcode` = places.`Kode` 
		WHERE paalgeld.`soundcode` = '".$port_soundcode."' ";
	
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
	
	//load views
	include('views/header.php');
	include('views/port.php');
	include('views/footer.php');
}

//if user uses port_soundcode=[value] then redirect to port function
if (isset($_GET['port_soundcode'])) {
	port($_GET['port_soundcode']);
} else {
	index();
}



?>