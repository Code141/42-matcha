const connections = [];
function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

self.addEventListener("connect", function (e) {
	port = e.ports[0];
	port.start();
	connections.push(port);
	port.postMessage(JSON.stringify("connected"));
	port.addEventListener("message", function (e) {
		data = JSON.parse(e.data);
		if (data.action == "message")
		{
			data.message = escapeHtml(data.message);
			connections.forEach(function(connection) {
				connection.postMessage(JSON.stringify({message : data }));
			});
		}

		if (typeof this.websocket === "undefined" || this.websocket.readyState != 1)
			this.init();
		if (this.websocket.readyState == 1)
			this.websocket.send(e.data);
	}.bind(this), false);

}, false);

this.init = function()
{
	url = "ws://localhost:8090/";
	this.websocket = new WebSocket(url);

	this.websocket.onopen = function (event)
	{
		port.postMessage(JSON.stringify("connected"));
		this.websocket.send(JSON.stringify({ action: "friends" }));
	}.bind(this);

	this.websocket.onclose = function(event)
	{
		port.postMessage(JSON.stringify("closed"));
		setTimeout(function () {
			if (typeof this.chat_list != 'undefined')
				this.chat_list.connected(false);
			this.init();
		}.bind(this), 1000);
	}.bind(this);

	this.websocket.onmessage = function(event)
	{
		connections.forEach(function(connection) {
			connection.postMessage(event.data);
		});
	}.bind(this);

	this.websocket.onerror = function(event)
	{
		port.postMessage(JSON.stringify("closed"));
	}.bind(this);
}

