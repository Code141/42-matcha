window.addEventListener('load', initEvents);

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
}
