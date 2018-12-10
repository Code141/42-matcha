
function xhr_upload(target)
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', SITE_ROOT + 'media/add?is_ajax=1', true);

	xhr.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200)
			{
				html_img.className = "";
				var response = JSON.parse(this.responseText);
				prompter_display(response.prompter);
			}
			else
			{
				html_img.className = "sending_fail";
				console.log("XHR Error : %d (%s)", this.status, this.statusText);
			}
			html_parent.removeChild(html_progress);
		}
	};
	xhr.send(formData);
}

