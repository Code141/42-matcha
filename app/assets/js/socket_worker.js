const connections = [];

self.addEventListener("connect", function (e) {
	port = e.ports[0];
	port.start();

	connections.push(port);

	port.postMessage(JSON.stringify("connected"));

	port.addEventListener("message", function (e) {
		data = JSON.parse(e.data);
		if (data.action == "message")
			connections.forEach(function(connection) {
				connection.postMessage(JSON.stringify({message : data }));
			});
		if (typeof this.websocket === "undefined")
			this.init();
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

