
function ajax_request(target)
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', target + "?is_ajax=1", true);

	xhr.onreadystatechange = function(event) {
		if (this.readyState === XMLHttpRequest.DONE) {
			if (this.status === 200)
			{
				var response = JSON.parse(this.responseText);

				console.log(response);

//				prompter_display(response.prompter);
			}
			else
			{
				console.log("XHR Error : %d (%s)", this.status, this.statusText);
			}
		}
	};

	xhr.send();
}

