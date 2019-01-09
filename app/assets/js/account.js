window.addEventListener('load',set_events);
window.addEventListener('load',initMap);

function initMap() {
	map = new L.map('map');
	ip_location = ip_location.loc.split(',');
	if (user.latitude !== null && user.longitude !== null)
	{
		var user_location = { "lat" : user.latitude, "lng" : user.longitude };
		map.setView(user_location, 13);
		var marker = L.marker([user_location.lat, user_location.lng]).addTo(map);
		marker.bindPopup("<b>Your location</b><br>").openPopup();
	}
	else
	{
		var button_div = document.getElementById('map_form').getElementsByClassName('buttons')[0];
		button_div.style.display = 'block';
		document.getElementById('map_prompt').style.display = 'block';
		navigator.geolocation.getCurrentPosition(function(location) {
			var user_location = { "lat" : location.coords.latitude, "lng" : location.coords.longitude};
			map.setView(user_location, 13);
			var marker = L.marker([user_location.lat, user_location.lng]).addTo(map);
			marker.bindPopup("<b>Your location</b><br>").openPopup();
		}, function(error){
			console.log(error.message);
			var user_location = { "lat" : ip_location[0], "lng" : ip_location[1]};
			map.setView(user_location, 13);
			var marker = L.marker([user_location.lat, user_location.lng]).addTo(map);
			marker.bindPopup("<b>Your location</b><br>").openPopup();
		});
	}
	var osm = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>',
			minZoom: 2,
			maxZoom: 18
			}).addTo(map);

	var control = L.control.geonames({
		geonamesURL: '//api.geonames.org/searchJSON',
		username: 'fdelsing',  // Geonames account username.  Must be provided
		lang: 'en', // language for results

		maxresults: 5,  // Maximum number of results to display per search
		className: 'leaflet-geonames-icon', //class for icon
		workingClass: 'leaflet-geonames-icon-working', //class for search underway
		showmarker: true, //show a marker at the location the selected location
		showPopup: true, //Show a tooltip at the selected location
		zoomLevel: null,  // Max zoom level to zoom to for location.  If null, will use the map's max zoom level.
		position: 'topleft',
		alwaysOpen: false  //if true, search field is always visible
	});
	map.addControl(control);
}

function set_events(){
	var forms = document.forms;
	for (let form of forms){
		form.addEventListener("submit",function(e){
			if (form.id == "map_form")
			{
				e.preventDefault();
				edit_location(map._lastCenter.lat, map._lastCenter.lng);
			}
		});
	};
	var pw_conf = document.getElementById("pw_conf");
	var pw_input = document.getElementById("pw_input");
	pw_conf.style.display = 'none';
	var buttons = document.getElementsByClassName("buttons");		
	for (let div of buttons)
	{
		div.style.display = 'none';
		div.getElementsByClassName("cancel_button")[0].addEventListener("click",function(e){
			div.style.display = 'none';
			pw_conf.getElementsByTagName("input")[0].required = false;
			pw_input.required = false;
			pw_conf.style.display = 'none';
		});
	}
	var editables = document.getElementsByClassName("edit");
	var submit_buttons = document.getElementsByClassName("submit");
	for (let element of editables)
	{
		element.addEventListener("change", function(e){
			console.log(element);
			if (element.name == "password"){
				pw_conf.style.display = 'block';
				pw_input.required = true;
				pw_conf.getElementsByTagName("input")[0].required = true;
			}
			var button_div = element.form.getElementsByClassName("buttons")[0];
			button_div.style.display = 'block';
		});
	};
}

function edit_location(latitude, longitude)
{
	var formData = new FormData();
	formData.append('lat',latitude);
	formData.append('lng',longitude);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url_location + "?is_ajax=1", true);
	xhr.onload = function () {
		var prompter = document.getElementById('prompter');
		var status = xhr.status;
		if (status == 200) {
			response = JSON.parse(xhr.responseText);
			if (response.fail)
			{
				prompter.innerHTML = response.fail;
				prompter.style.backgroundColor = 'red';
			}
			else if (response.success)
			{
				prompter.innerHTML = response.success;
				prompter.style.backgroundColor = 'green';
			}
			prompter.style.display = 'block';
		} else {
			console.log("ERROR XMLHttpRequest got this response: " + xhr.status);
		}
	};
	xhr.send(formData);
	set_events();
}
