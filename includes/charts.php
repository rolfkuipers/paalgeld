<?php 
#	Chris Pool
#	25-11-2014
#	includes/ship.php



function country(){
	include('config/database.php');
	$country_name = 'United States';
	$query = "SELECT places.*, paalgeld.*, places.`Modern Country` as places_country, places.*, places.`Stednavn` as places_port_name
		FROM `places` 
		RIGHT JOIN paalgeld ON places.`Kode` = paalgeld.`soundcode`
		WHERE places.`Modern Country` = '".$country_name."' ";
	
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$ports= array();
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
		if (isset($row['places_port_name'])) {
			$row['port_name'] = $row['places_port_name'];
			
		} else {
			$row['port_name'] = $row['port of origin'];		
		}
		
		//get list of all unique ports
		if (!in_array($row['port_name'], $ports)) {
			$countries[] = $row['port_name'];
		}
		$data[$row['port_name']] = $row['goods_value'];	
	}

	
	
	
	//create json
	$json = array();
	$json['cols'][] = array('type' => 'string'); //years col
	$json['cols'][] = array('type' => 'number'); //years col
	
	//create rows
	$i = 0;
    foreach ($data as $port => $value) {
    	unset($row);
    	$row[] =  array('v' => $port); 	
    	$row[] = array('v' => $value);
    
    	$json['rows'][]['c'] = $row;
    }
    

    //print_r($json);
     echo json_encode($json);


	
  
}

function all_countries_map(){
	include('config/database.php');
	$query = "SELECT paalgeld.*, places.*, places.`Modern Country` as places_country , count(places.`Stednavn`) as nName, sum(paalgeld.`tax-decimal`) as `tax-decimal`
		FROM `paalgeld` 
		LEFT JOIN places ON paalgeld.`soundcode` = places.`Kode`
		GROUP BY places.`Modern Country`
		ORDER BY places.`Modern Country` asc";
	
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$countries= array();
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
		
		//get list of all unique countries
		if (!in_array($row['country_name'], $countries)) {
			$countries[] = $row['country_name'];
		}
		$data[$row['country_name']] = $row['goods_value'];	
	}

	
	
	
	//create json
	$json = array();
	$json['cols'][] = array('type' => 'string'); //years col
	$json['cols'][] = array('type' => 'number'); //years col
	
	//create rows
	$i = 0;
    foreach ($data as $country => $value) {
    	unset($row);
    	$row[] =  array('v' => $country); 	
    	$row[] = array('v' => $value);
    
    	$json['rows'][]['c'] = $row;
    }
    

    //print_r($json);
     echo json_encode($json);


	
  
}



function all_countries_line(){
	include('config/database.php');
	$query = "SELECT paalgeld.*, places.`Modern Country` as places_country , count(places.`Stednavn`) as nName, sum(paalgeld.`tax-decimal`) as `tax-decimal`
		FROM `paalgeld` 
		LEFT JOIN places ON paalgeld.`soundcode` = places.`Kode`
		GROUP BY places.`Modern Country`, paalgeld.`year` 
		ORDER BY places.`Modern Country` asc";
	
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$countries= array();
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
		
		//get list of all unique countries
		if (!in_array($row['country_name'], $countries)) {
			$countries[] = $row['country_name'];
		}

		$data[$row['year']][$row['country_name']] = $row['goods_value'];	
	}

	//interpolate data
	$org_date_from = '1742';
	$org_date_to = '1817';

	foreach (range($org_date_from, $org_date_to) as $year) {
		if (!isset($data[$year])) { //als jaar nog niet voorkomt toevoegen aan data array
			$data[$year] = array();
		}
		foreach ($countries as $country) { //checken of elk land voorkomt in array, zo niet toevoegen met waarde 0
			if (!isset($data[$year][$country])) {
				$data[$year][$country] = 0;
			}
		}

	}
	
	//sort array on keys
	ksort($data);
	//create json
	$json = array();
	$json['cols'][] = array('type' => 'string'); //years col
	//create columns
	foreach ($countries as $country) {
		$json['cols'][] = array('type' => 'number', 'label' => $country);
	}
	//create rows
	$i = 0;
    foreach ($data as $year => $country) {
    	unset($row);
    	$row[] =  array('v' => $year);
    	foreach ($country as $country_value) {
    		$row[] = array('v' => $country_value);
    	} 
    	$json['rows'][]['c'] = $row;
    }
    

    //print_r($json);
     echo json_encode($json);


	
  
}




if (isset($_GET['type'])) {
	$_GET['type']();
} else {
	index();
}
//werken met functies maakt het mogelijk om later met subpaginas te werken


?>