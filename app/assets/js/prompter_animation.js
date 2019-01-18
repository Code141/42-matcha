function prompter_animation(message, classname)
{
	var prompter = document.getElementById('prompter');
	if (prompter.childNodes[0])
		prompter.childNodes[0].remove();
	var div = document.createElement('div');
	div.className = classname;
	div.innerHTML = message;
	prompter.appendChild(div);

	prompter.className = "fade";  
	var time = setTimeout(fade, 4000);
}

function fade() {
	var prompter = document.getElementById('prompter');
	prompter.className = "";  
}

