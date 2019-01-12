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

function map_event(){
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
}

function hide_buttons(){
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
}
function set_events(){
	var forms = document.forms;
	map_event();
	var pw_conf = document.getElementById("pw_conf");
	var pw_input = document.getElementById("pw_input");
	pw_conf.style.display = 'none';
	hide_buttons();
	
	var editables = document.getElementsByClassName("edit");
	var submit_buttons = document.getElementsByClassName("submit");
	for (let element of editables)
	{
		element.addEventListener("change", function(e){
			if (element.name == "password"){
				pw_conf.style.display = 'block';
				pw_input.required = true;
				pw_conf.getElementsByTagName("input")[0].required = true;
			}
			var button_div = element.form.getElementsByClassName("buttons")[0];
			button_div.style.display = 'block';
		});
	};
	var snap_button = document.getElementById("snap_button");
	var upload_input = document.getElementById("fileToUpload");
		snap_button.addEventListener("click", display_booth); 
		upload_input.addEventListener("change", function(){
			document.getElementById("upload_file").submit();
			set_events();});
	var div_media = document.getElementsByClassName("media");
	if (div_media.length == 5)
		document.getElementsByClassName('top')[0].style.display = "none";
	else
		document.getElementsByClassName('top')[0].style.display = "block";
	for (let div of div_media)
	{
		div.addEventListener("click", function(e){
			if (e.target.tagName == "A")
			{
				if (e.target.className == "delete")
					delete_img(div);
				else
					set_as_profil_pic(div.id);
			}
			else
				full_img(div.id);
		});
	}
}

function set_as_profil_pic(id_media)
{
	var formData = new FormData();
	formData.append("id_media", id_media);

	var xhr = new XMLHttpRequest();
	xhr.open('POST', url_account + "set_as_profil_pic?is_ajax=1", true);
	xhr.onload = function () {
		var prompter = document.getElementById('prompter');
		var status = xhr.status;
		if (status == 200) {
			response = xhr.responseText;
			if (response)
			{
				prompter.innerHTML = response;
				prompter.style.backgroundColor = 'red';
				prompter.style.display = 'block';
			}
			else
			{
				var profil_pic = document.getElementById('profil_pic');
					profil_pic.src = media_path + id_media + '.png';
				var promp = document.getElementsByClassName('prompt')[0];
				if (promp)
					promp.remove();
			}
		} else {
			console.log("ERROR XMLHttpRequest got this response: " + xhr.status);
		}
	};
	xhr.send(formData);

}

function delete_img(div_media)
{
	var formData = new FormData();
	formData.append("id_media", div_media.id);

	var xhr = new XMLHttpRequest();
	xhr.open('POST', url_account + "delete_img?is_ajax=1", true);
	xhr.onload = function () {
		var prompter = document.getElementById('prompter');
		var status = xhr.status;
		if (status == 200) {
			response = xhr.responseText;
			console.log(response);
			if (response)
			{
				prompter.innerHTML = response;
				prompter.style.backgroundColor = 'red';
				prompter.style.display = 'block';
			}
			else
			{
				div_media.parentNode.remove();
				var profil_pic = document.getElementById('profil_pic');
				var array = profil_pic.src.split('\/');
				if (array[array.length - 1] === div_media.id + ".png")
				{
					var promp = document.createElement('p');
				   		promp.className = "prompt";	
				   		promp.innerHTML = "Please add a profil picture";
						document.getElementById('div_profil_pic').insertBefore(promp, document.getElementById('div_profil_pic').childNodes[0])
					profil_pic.src = default_user_img;
				}
			}
		} else {
			console.log("ERROR XMLHttpRequest got this response: " + xhr.status);
		}
	};
	xhr.send(formData);
}

function display_booth()
{
	var snap_button = document.getElementById("snap_button");
		snap_button.style.display = "none";
	document.getElementById("div_snapshot").style.display = "block";
	document.getElementById("booth").style.display = "block";
	document.getElementById("take_snapshot").addEventListener("click", take_snapshot);
	document.getElementById("cancel_snapshot").addEventListener("click", cancel_snapshot);
	navigator.mediaDevices.getUserMedia({video:true , audio:false})
		.then(function(stream){
			video.srcObject = stream;
			video.play();
		})
	.catch(function(error){
		console.log(error);
		alert("failed to connect to the webcam");
	});

}

function cancel_snapshot(){
		var canvas = document.getElementById('canvas');
			canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
		snap_button.style.display = "block";
		document.getElementById("div_snapshot").style.display = "none";
		document.getElementById("booth").style.display = "none";
		var snapshot_button = document.getElementById("take_snapshot");
		var textnode = snapshot_button.childNodes[0];
		if (textnode !== "snap")
		{
			var new_textnode = document.createTextNode("snap");
			snapshot_button.replaceChild(new_textnode, textnode);
			snapshot_button.removeEventListener("click", save_snapshot);
			snapshot_button.addEventListener("click", take_snapshot);
		}
}

function take_snapshot(){
	video.pause();
	var width = video.videoWidth;
	var height = video.videoHeight;
	canvas.width = width;
	canvas.height = height;
	var context = canvas.getContext('2d');
	context.drawImage(video, 0, 0, width, height);

	var snapshot_button = document.getElementById("take_snapshot");
	var textnode = snapshot_button.childNodes[0];
	var new_textnode = document.createTextNode("save");
	snapshot_button.replaceChild(new_textnode, textnode);
	snapshot_button.removeEventListener("click", take_snapshot);
	snapshot_button.addEventListener("click", save_snapshot);
}

function save_snapshot(){
	var img_b64 = canvas.toDataURL("img/png");
	var blob = dataURItoBlob(img_b64);

	var formData = new FormData();
	formData.append("fileToUpload", blob);

	var xhr = new XMLHttpRequest();
	xhr.open('POST', url_account + "upload_file?is_ajax=1", true);
	xhr.onload = function () {
		var prompter = document.getElementById('prompter');
		var status = xhr.status;
		if (status == 200) {
			response = xhr.responseText.split("\/")[0];
			if (response !== "Image upload success!")
			{
				prompter.innerHTML = response;
				prompter.style.backgroundColor = 'red';
			}
			else
			{
				prompter.innerHTML = response;
				prompter.style.backgroundColor = 'green';
				update_pic_fieldset(xhr.responseText.split("\/")[1]);
			}
			prompter.style.display = 'block';
		} else {
			console.log("ERROR XMLHttpRequest got this response: " + xhr.status);
		}
	};
	xhr.send(formData);
	cancel_snapshot();
}

function update_pic_fieldset(id_media){
	var pic_div = document.getElementsByClassName("bottom")[0];
	var wrap = document.createElement('div');
		wrap.className = "wrap";
	var div_media = document.createElement('div');
		div_media.className = "media";
		div_media.id = id_media;
		div_media.addEventListener("click", function(e){
			if (e.target.tagName == "A")
			{
				if (e.target.className == "delete")
					delete_img(div_media);
				else
					set_as_profil_pic(id_media);
			}
			else
				full_img(id_media);	
		});
	var a_set_profil = document.createElement('a');
		a_set_profil.className = "set_profil";
		a_set_profil.innerHTML = "set as profil";
	var a_delete = document.createElement('a');
		a_delete.className = "delete";
		a_delete.innerHTML = "delete";
	div_media.appendChild(a_set_profil);
	div_media.appendChild(a_delete);
	wrap.appendChild(div_media);
	var div_img = document.createElement('div');
		div_img.className = "img";
	var img = document.createElement('img');
		img.src = media_path + id_media + '.png';
	div_img.appendChild(img);
	wrap.appendChild(div_img);
	pic_div.appendChild(wrap);
}

function dataURItoBlob(dataURI) {
	 var byteString;
	 if (dataURI.split(',')[0].indexOf('base64') >= 0)
		 byteString = atob(dataURI.split(',')[1]);
	 else
		 byteString = unescape(dataURI.split(',')[1]);
	 var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
	 var ia = new Uint8Array(byteString.length);
	 for (var i = 0; i < byteString.length; i++)
		 ia[i] = byteString.charCodeAt(i);
	 return new Blob([ia], {type:mimeString});
}

function edit_location(latitude, longitude)
{
	var formData = new FormData();
	formData.append('lat',latitude);
	formData.append('lng',longitude);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url_account + "edit_location?is_ajax=1", true);
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
	hide_buttons();
}
