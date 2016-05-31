<?php 
	$target_city = strToLower($_GET["city"]);
	$cities = "../data/cities.txt";
	$cities_list = explode("\n", file_get_contents($cities));
	foreach($cities_list as $city) {
		$parts = explode("|", $city);
		#print var_dump($parts);
		if (strToLower($parts[0]) == $target_city) {
			#list ($target_city, $state, $nickname, $landmark, $coast, $desc) = $city;
			$data = array(
				"city" => strtoupper(substr($parts[0], 0, 1)) . substr($parts[0], 1),
				"state" => $parts[1],
				"nickname" => $parts[2],
				"image" => $parts[3],
				"coast" => $parts[4],
				"description" => $parts[5],
			);
			#header("Content-type: application/json");
			print json_encode($data);
			die();
		}
	}
?>