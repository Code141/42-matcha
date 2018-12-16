window.addEventListener('load', init);

document.getElementById('search_button').addEventListener('click', function(event){
	event.preventDefault();
	var form = document.getElementById("matches_form");
	formData = new FormData(form);

	var url = "http://localhost:8080/matcha/matches/main/";
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url + "?is_ajax=1", true);
	xhr.onload = function () {
		var status = xhr.status;
		if (status == 200) {
			profils = JSON.parse(xhr.responseText);
			if (profils)
				fill_profil_container(profils);
			add_markers(profils);
		}
		else {
			console.log("ERROR XMLHttpRequest got this response: " + xhr.status);
		}
	};
	xhr.send(formData);
});

function initMap() {
	map = new L.map('map');
	var osm = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>',
			minZoom: 2,
			maxZoom: 18
			}).addTo(map);
}

function	init()
{
	initMap();
	fill_profil_container(profils);
	add_markers(profils);
	tag_handling();
}

function	add_markers(matches)
{
	if (this.markerGroup)
		for(id in this.markerGroup._layers)
			map.removeLayer(this.markerGroup._layers[id]);
	this.markerGroup = L.layerGroup().addTo(map);
		for (profil in matches ){
		if (matches[profil].latitude != null && matches[profil].longitude != null)
		{
			var marker = L.marker([matches[profil].latitude, matches[profil].longitude]).addTo(markerGroup);
			marker.bindPopup("<b>"+matches[profil].username+"</b><br>").openPopup();
		}
	}

	var marker = L.marker([user_location.latitude, user_location.longitude]).addTo(markerGroup);
	marker.bindPopup("<b>You</b><br>").openPopup();
	L.circle([user_location.latitude, user_location.longitude], 10000).addTo(map);
	map.setView([user_location.latitude, user_location.longitude], 6);
}

function	fill_profil_container(profils)
{
	var container = document.getElementById("profils");
	while (container.firstChild) {
		container.removeChild(container.firstChild);
	}
	if (profils.length)
	{
		for(i = 0; i < profils.length; i++)
		{
			var article = document.createElement('article');
			var a = document.createElement('a');
			var img = document.createElement('img');
			var username = document.createElement('p');
			var dist = document.createElement('p');
			var age = document.createElement('p');
			var like_button = document.createElement('button');
			like_button.innerHTML = 'LIKE';
			like_button.value = profils[i].id;
			like_button.className = 'like_button';
			var matching_tags = document.createElement('p');
			article.appendChild(a);
			article.appendChild(like_button);

			a.href = 'http://localhost:8080/matcha/profil/main/' + profils[i].id;
			img.id = 'profil_pic';
			username.innerHTML = profils[i].username;
			if (profils[i].distance)
				dist.innerHTML = 'dist : ' + Number(profils[i].distance).toFixed(2) + ' km away';
			else
				dist.innerHTML = 'No location';
			age.innerHTML = profils[i].age + 'years old';
			matching_tags.innerHTML = 'Nb of matching tags : ' + profils[i].nb_matching_tags;
			like_button.addEventListener('click', function(event){
			ajax_request('http://localhost:8080/matcha/ajax/like/' + event.target.value);
			});
			container.appendChild(article);
			a.appendChild(img);
			a.appendChild(username);
			a.appendChild(dist);
			a.appendChild(age);
			a.appendChild(matching_tags);
		}
	}
	else
	{
		var prompt = document.createElement('p');
		prompt.innerHTML = "Result set is empty, try something else :)";
		prompt.style.color = "orange";
		prompt.style.margin = "50px";
		container.appendChild(prompt);
	}

}

function	tag_handling(){
	document.getElementById("search_tags").addEventListener("keyup", function(event){
		var input_bar, filter, ul, li, a, i;
		input_bar = document.getElementById('search_tags');
		filter = input_bar.value.toUpperCase();
		ul = document.getElementById("myUL");
		li = ul.getElementsByTagName('li');

		for (i = 0; i < li.length; i++) {
			input = li[i].getElementsByTagName("input")[0];
			if (input.name.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	});

	document.getElementById("uncheck_tags").addEventListener("click", function(event){
		event.preventDefault();
		ul = document.getElementById("myUL");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			input = li[i].getElementsByTagName("input")[0].checked = false;
		}
	});
}

