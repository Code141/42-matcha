function ajax_request(target)
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', target + "?is_ajax=1", true);
	xhr.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200)
			{
				console.log (this.responseText);
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
			else
				console.log("XHR Error : %d (%s)", this.status, this.statusText);
		}
	};
	xhr.send();
}

function	like(id)
{
	console.log(id);
	ajax_request(SITE_ROOT + 'ajax/like/' + id);
}

function	dislike(id)
{
	ajax_request(SITE_ROOT + 'ajax/dislike/' + id);
	return (false);
}


function	unblock(id)
{
	ajax_request(SITE_ROOT + 'ajax/unblock/' + id);
}

function	report(id)
{
	ajax_request(SITE_ROOT + 'ajax/report/' + id);
}
