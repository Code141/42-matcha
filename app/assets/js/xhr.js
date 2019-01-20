function ajax_request(target)
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', target + "?is_ajax=1", true);
	xhr.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200)
			{
				if (this.responseText.length == 0)
					return;
				var prompter = document.getElementById('prompter');
				if (prompter.childNodes[0])
					prompter.childNodes[0].remove();
				var div = document.createElement('div');
				var status = JSON.parse(this.responseText).status;
				if (status == "success")
				{
					div.className = "prompter_success";
					div.innerHTML = "Success!";
					prompter.appendChild(div);
				}
			}
		}
	};
	xhr.send();
}

function	like(id)
{
	ajax_request(SITE_ROOT + 'ajax/like/' + id);
	return (false);
}

function	dislike(id)
{
	ajax_request(SITE_ROOT + 'ajax/dislike/' + id);
	return (false);
}


function	unblock(id)
{
	ajax_request(SITE_ROOT + 'ajax/unblock/' + id);
	return (false);
}

function	report(id)
{
	ajax_request(SITE_ROOT + 'ajax/report/' + id);
	return (false);
}
