<?php 
#	Chris Pool
#	25-11-2014
#	includes/country.php

function index(){
	//get all  countries
	include('config/database.php');
	$query = "SELECT paalgeld.*, places.`Modern Country` as places_country , count(places.`Stednavn`) as nName
		FROM `paalgeld` 
		LEFT JOIN places ON paalgeld.`soundcode` = places.`Kode`
		GROUP BY places.`Modern Country` 
		ORDER BY places.`Modern Country` asc";
	
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
		$data[] = $row;	
	}
	
	//load views
	include('views/header.php');
	include('views/all_countries.php');
	include('views/footer.php');
}

function country($country_name) {
	//get specific country
	include('config/database.php');
	$query = "SELECT places.*, paalgeld.*, places.`Modern Country` as places_country 
		FROM `places` 
		RIGHT JOIN paalgeld ON places.`Kode` = paalgeld.`soundcode`
		WHERE places.`Modern Country` = '".$country_name."' ";
	
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
	
	//uiteindelijk view laden
	include('views/header.php');
	include('views/country.php');
	include('views/footer.php');
}




if (isset($_GET['country_name'])) {
	country($_GET['country_name']);
} else {
	index();
}
//werken met functies maakt het mogelijk om later met subpaginas te werken


?>