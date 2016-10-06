<?php
	$cities = "../data/cities.txt";
	$cities_list = explode("\n", file_get_contents($cities));
	$data;
	if (isset($_GET["city"])) {
		$target_city = strToLower($_GET["city"]);
		foreach($cities_list as $city) {
			$city_info = explode("|", $city);
			if (strToLower($city_info[0]) == $target_city) {
				$data = array(
					"city" => strtoupper(substr($city_info[0], 0, 1)) . substr($city_info[0], 1),
					"state" => $city_info[1],
					"nickname" => $city_info[2],
					"image" => $city_info[3],
					"coast" => $city_info[4],
					"description" => $city_info[5],
				);
			}
		}
		header("Content-type: application/json");
		print json_encode($data);
	} else {
		$city_array = array();
		foreach($cities_list as $city) {
			$city_info = explode("|", $city);
			$data[] = array(
				"city" => strtoupper(substr($city_info[0], 0, 1)) . substr($city_info[0], 1),
				"state" => $city_info[1],
				"nickname" => $city_info[2],
				"image" => $city_info[3],
				"coast" => $city_info[4],
				"description" => $city_info[5],
			);
		}
		header("Content-type: application/json");
		print json_encode($data);
	}
?>