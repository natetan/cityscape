(function() {

	'use strict';

	var filled = false;
	
	window.onload = function() {
		document.querySelector('.info').classList.add('hide');
		document.querySelector('#button').onclick = fetchData;
		makeAjaxRequest('../cityscape/services/cities.php', showCurrentCities);
	};

	function makeAjaxRequest(url, functionName) {
		var request = new XMLHttpRequest();
		request.onload = functionName;
		request.open("GET", url, true);
		request.send();
	}

	function fetchData() {
		var city = document.querySelector('#input').value;
		console.log(city);
		if (city == '') {
			showError('No city input!')
		} else {
			makeAjaxRequest('../cityscape/services/cities.php?city=' + city, showInfo);
		}
	}

	function showInfo() {
		if (this.status == 200) {
			var data = JSON.parse(this.responseText);
			var source = data.info.image;
			document.querySelector('.info').classList.remove('hide');
			document.querySelector('#city').innerHTML = data.city; 
			document.querySelector('#state').innerHTML = data.info.state;
			document.querySelector('#nickname').innerHTML = "'" + data.info.nickname + "'";
			document.querySelector('#coast').innerHTML = data.info.coast + 'coast';
			document.querySelector('#city-image').src = '../cityscape/images/' + source + '.jpg';
			document.querySelector('#city-desc').innerHTML = data.info.description;
		} else {
			showError('Error code: ' + this.status + '. City not found');
		}
	}

	function showCurrentCities() {
		if (this.status == 200) {
			var data = JSON.parse(this.responseText);
			var cities = data[0].city;
			for (var i = 1; i < data.length; i++) {
				cities += ", " + data[i].city;
			}
			document.querySelector('#current-cities').innerHTML = 'Only cities available: ' + cities;
		} else {
			showError('Error code: ' + this.status);
		}
	}

	function showError(message) {
		alert(message);
	}

}) ();
