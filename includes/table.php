<?php 

function index() {

	$data_types['port'] = 'Ports';
	$data_types['country'] = 'Countries';

	$org_date_from = '1742';
	$org_date_to = '1817';
	
	include('config/database.php');
	if (!isset($_POST['type'])) {
		//set default data
		$type = 'country';
		$date_from = $org_date_from;
		$date_to = $org_date_to;
		$hide_empty_years = true;
	} else {
		$type = $_POST['type'];
		$date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		$hide_empty_years = $_POST['empty_years'];
		
	}
	
	$query['port'] = "SELECT paalgeld.year as period, paalgeld.`port of origin` as y, sum(paalgeld.tax) as tax, count(paalgeld.year) as times FROM `paalgeld` LEFT JOIN places ON paalgeld.soundcode = places.Kode WHERE paalgeld.`year` <= '".$date_to."' AND paalgeld.`year` >= '".$date_from."' GROUP BY paalgeld.`port of origin`, paalgeld.year ORDER BY paalgeld.year, paalgeld.`port of origin` asc ";
	$query['country'] = "SELECT paalgeld.year as period, places.`Modern Country` as y, sum(paalgeld.tax) as tax, count(paalgeld.year) as times FROM `paalgeld` LEFT JOIN places ON paalgeld.soundcode = places.Kode WHERE paalgeld.`year` <= '".$date_to."' AND paalgeld.`year` >= '".$date_from."' GROUP BY places.`Modern Country`, paalgeld.year ORDER BY paalgeld.year, places.`Modern Country` asc ";
	
	
	if (!isset($query[$type])) {
		die('No data selected');
	}

	$result = $mysqli->query($query[$type]) or die($mysqli->error.__LINE__);
	if ($hide_empty_years == 'true') {
		$date_from = 2000;
		$date_to = 0;
	}
	while($row = $result->fetch_assoc()) {
		
		if ($row['y'] == '')  {
			$row['y'] = 'blank';
		}
 		//data geschikt maken voor draaitabel
 
		if ($hide_empty_years == 'true') {
			if ($date_from > $row['period']) {
				$date_from = $row['period'];
			}

			if ($date_to < $row['period']) {
				$date_to = $row['period'];
			}
		} else {

		}
		$data[$row['y']][$row['period']] = array('goods_value' => $row['tax'] * 500, 'times' => $row['times']); 	
	}

	//uiteindelijk view laden
	include('views/header.php');
	include('views/table.php');
	include('views/footer.php');
}



//werken met functies maakt het mogelijk om later met subpaginas te werken
index();

?>