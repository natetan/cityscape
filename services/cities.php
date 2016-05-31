<?php 
	$target_city = $_GET["city"];
	$cities = "../data/cities.txt";
	$cities_list = explode("\n", file_get_contents($cities));
	foreach($cities_list as $city) {
		if (strToLower($city) == $target_city) {
			$array = explode("|", $city);
			list ($target_city, $state, $nickname, $landmark, $coast, $desc) = $array;
			$data = array(
				"city" => $target_city,
				"state" => $state,
				"nickname" => $nickname,
				"landmark" => $landmark,
				"coast" => $coast,
				"description" => $desc,
			);
			header("Content-type: application/json");
			print json_decode($data);
			die();
		}
	}
?>