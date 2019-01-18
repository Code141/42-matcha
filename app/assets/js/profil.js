window.addEventListener('load', initMap);
window.addEventListener('load', initEvents);

function initMap()
{
	if (user_location){
	map = new L.map('map');

	var marker = L.marker([user_location.lat, user_location.lon]).addTo(map);
	marker.bindPopup("<b>Your location</b><br>").openPopup();

	map.setView([user_location.lat, user_location.lon], 13);

	var osm = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>',
		minZoom: 2,
		maxZoom: 18
	}).addTo(map);
	}
	else
		document.getElementById('map').innerHTML = "This user's location is unknown";
}

function full_img(id_media)
{
	var section = document.getElementsByClassName("center")[0];
	var wrap = document.createElement('div');
		wrap.className = 'show_img';
	var img = document.createElement('img');
		img.className = 'show_img_img';
		img.src = media_path + id_media + '.png';
	wrap.appendChild(img);
	section.appendChild(wrap);
	wrap.addEventListener('click', function(){
	wrap.remove();});
}

function	initEvents()
{
	var div_infos = document.getElementById("div_infos");
	var form = document.getElementById("radio_form");
	form.addEventListener("change", function(e){
		for (var i = 0; i < div_infos.childNodes.length; i++)
		{
			if (div_infos.childNodes[i].id)
				div_infos.childNodes[i].style.display = "none";
		}
		var div = document.getElementById(e.target.value);
			div.style.display = "block";
	});
	
	var full_img = document.getElementsByClassName("a_pic");
		for (var i = 0; i < full_img.length; i++)
		{
			full_img[i].addEventListener('click', function(e){
				e.preventDefault();
				var id_media = e.target.id;
				var section = document.getElementsByClassName("center")[0];
	var wrap = document.createElement('div');
		wrap.className = 'show_img';
	var img = document.createElement('img');
		img.className = 'show_img_img center';
		img.src = media_path + id_media + '.png';
	wrap.appendChild(img);
	section.appendChild(wrap);
	wrap.addEventListener('click', function(){
		wrap.remove();});
			});
		}

}
