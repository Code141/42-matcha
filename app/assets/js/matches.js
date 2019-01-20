window.addEventListener('load', init);

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
	document.getElementById('search_button').addEventListener('click', function(event){
		event.preventDefault();
		current_page = 1;
		search_matches(SITE_ROOT + "matches");
	});
	var map_div = document.getElementById('map');
	map_div.className = "map";
	map_div.style.width = "100%";
	map_div.style.height = "350px";
	initMap();
	document.getElementById("select_filter_km").addEventListener("change", change_km);	
	fill_profil_container(profils);
	add_markers(profils);
	tag_handling();
	var array_a = document.getElementsByTagName('a');
	for (let a of array_a) {
		if (a.id && !a.id.match(/a_page_/) && a.id.match(/a_/))
			a.addEventListener('click', function(e){
				e.preventDefault();
				var link = e.target;
				current_page = parseInt(link.href.match(/\d+$/));
				search_matches(e.target.href);
			});
	}
	pagination();
}

function	search_matches(url)
{
	var form = document.getElementById("matches_form");
	formData = new FormData(form);

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url + "?is_ajax=1", true);
	xhr.onload = function () {
		var status = xhr.status;
		if (status == 200) {
			data = JSON.parse(xhr.responseText);
			profils = data.matches; 
			total_matches = data.total_matches;
			ms = data.ms;

			var span = document.getElementById('nb_matches');
				span.innerHTML = span.innerHTML.replace(/[^\:]+$/, ' ' + total_matches + ' (in ' + ms + ' seconds)');

			pagination();
			fill_profil_container(profils);
			add_markers(profils);
		}
		else {
			console.log("ERROR XMLHttpRequest got this response: " + xhr.status);
		}
	};
	xhr.send(formData);
}

function	add_page_events()
{
	var array_a = document.getElementsByTagName('a');
		console.log(array_a);
	for (let a of array_a) {
		if (a.id && a.id.match(/a_page_/))
			a.addEventListener('click', function(e){
				e.preventDefault();
				current_page = parseInt(e.target.href.match(/\d+$/));
				search_matches(e.target.href);
			});
	}
}

function	clean_pagination(nb_pages, previous_page, next_page, last_page)
{
	console.log("clean pagination");
	var a_previous_page = document.getElementById('a_previous_page');
	var new_val = parseInt(current_page) - 1;
	if (new_val <= 0)
		new_val = 1;	
		a_previous_page.href = a_previous_page.href.replace(/\d+$/, new_val);
	var a_next_page = document.getElementById('a_next_page');
		new_val = parseInt(current_page) + 1;
	if (new_val > nb_pages)
		new_val = nb_pages;	
		a_next_page.href = a_next_page.href.replace(/\d+$/, new_val);
	var a_last_page = document.getElementById('a_last_page');
	a_last_page.innerHTML = '... ' + nb_pages;
	a_last_page.href = SITE_ROOT + "matches/main/" + nb_pages;
	var first_page = document.getElementById('first_page');
	if (current_page == 1)
		previous_page.style.display = 'none';
	else	
		previous_page.style.display = 'inline-block';
	if (current_page == nb_pages)
		next_page.style.display = 'none';
	else	
		next_page.style.display = 'inline-block';
	if (current_page > 3)
		first_page.style.display = 'inline-block';
	else
		first_page.style.display = 'none';
	if (current_page < nb_pages - 2)
		last_page.style.display = 'inline-block';
	else
		last_page.style.display = 'none';
	var array_th = document.getElementsByTagName('th');
	var i;
	for (i = 0; i < array_th.length; i++)
	{
		if (array_th[i].id && array_th[i].id.match(/page\_\d+/))
		{
			array_th[i].remove();
			i--;
		}
	}
}

function	pagination()
{
	var last_page = document.getElementById('last_page');
	nb_pages = 1;
	if (total_matches !== '0')
		nb_pages = total_matches / 20;
	if (nb_pages % 1 > 0)
		nb_pages = nb_pages - (nb_pages % 1) + 1;
	if (current_page > nb_pages)
	{
		current_page = 1;
		search_matches(SITE_ROOT + "matches");
	}
	var previous_page = document.getElementById('previous_page');
	var next_page = document.getElementById('next_page');
	clean_pagination(nb_pages, previous_page, next_page, last_page);
	var th = document.createElement('th');
	var a = document.createElement('a');
		a.href = SITE_ROOT + "matches/main/";
	if (current_page <= 3)
		var i = 1;
	else
		var i = current_page - 2;
	while (i <= current_page + 2 && i <= nb_pages)
	{
		var new_a = a.cloneNode(true);
			new_a.href += i;
			new_a.innerHTML = i;
			new_a.id = 'a_page_' + i;
		var new_th = th.cloneNode(true);
			new_th.id = 'page_' + i;
			new_th.appendChild(new_a);
			last_page.parentNode.insertBefore(new_th, last_page);
			i++;
	}
	var current_page_th = document.getElementById('page_' + current_page);
		current_page_th.style.textDecoration = 'underline';
		current_page_th.style.fontSize = '10pt';
	add_page_events();
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


	map.setView([user_location.latitude, user_location.longitude], 6);
}

function change_km()
{
	var value = document.getElementById("select_filter_km").value;
	if (typeof(circle) != "undefined")
		map.removeLayer(circle);
	circle = L.circle([user_location.latitude, user_location.longitude], parseInt(value) * 1000).addTo(map);
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

			var matching_tags = document.createElement('p');
			var score = document.createElement('p');
			article.appendChild(a);

			a.href = SITE_ROOT + 'profil/main/' + profils[i].id;
			img.id = 'profil_pic';
			if (profils[i].id_media)
				img.src = MEDIA_PATH + profils[i].id_media + '.png';
			else
				img.src = default_pic;
			username.className = 'username';
			username.innerHTML = profils[i].username;
			if (profils[i].distance)
				dist.innerHTML = 'Distance : ' + (Number(profils[i].distance)/1000).toFixed(0) + ' Km';
			else
				dist.innerHTML = 'No location';
			age.innerHTML = 'Age : ' + profils[i].age;
			if (!profils[i].nb_matching_tags)
				profils[i].nb_matching_tags = 0;
			matching_tags.innerHTML = 'Matching tags : ' + profils[i].nb_matching_tags;
			score.innerHTML = 'Popularity : ' + profils[i].score + ' / 10';
			container.appendChild(article);
			a.appendChild(username);
			a.appendChild(img);
			a.appendChild(age);
			a.appendChild(dist);
			a.appendChild(matching_tags);
			a.appendChild(score);
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
