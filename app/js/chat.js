window.onload = function ()
{
	chat_list_cont = document.getElementById("chat_list");

	client = new websock();
	client.init();
};

function websock()
{
	this.init = function()
	{
		url = "ws://localhost:8090/";

		if ("WebSocket" in window)
			this.websocket = new WebSocket(url);
		else if ("MozWebSocket" in window)
			this.websocket = new MozWebSocket(url);

		this.websocket.onopen = function(event)
		{
			this.notif = new notif();
			if (typeof id_conv == "undefined")
				this.chat_list = new chat_list(chat_list_cont);
			else
				this.chat_list = new messagerie();
			this.chat_list.init();

			this.chat_list.connected(true);
			var messageJSON = {
				ssid: ssid,
				action: "friends"
			};

			this.websocket.send(JSON.stringify(messageJSON));
		}.bind(this)

		this.websocket.onmessage = function(event)
		{
			var data = JSON.parse(event.data);
			if (typeof data.like != 'undefined')
				this.notif.like(data.like);
			else
				this.chat_list.do(data);
		}.bind(this);

		this.websocket.onerror = function(event)
		{
			this.chat_list.connected(false);
		}.bind(this);

		this.websocket.onclose = function(event)
		{
			if (typeof this.chat_list != 'undefined')
				this.chat_list.connected(false);
			setTimeout(function ()
			{
				this.init();
			}.bind(this), 5000);
		}.bind(this);
	}
}

function notif()
{
	this.like = function(data)
	{
		console.log("You have been like by " + data.username + " id = [" + data.from+"]");
	}
}

function messagerie()
{
	this.chat_list = chat_list;
	this.conv = Array();
	this.list = Array();
	this.main_conv;

	this.friends_logout = function(id)
	{
		/*
		this.list[id].className = "non_connected";
		if (typeof this.conv[id] != "undefined")
			this.conv[id].is_connected(false);
		*/
	}

	this.friends_login = function(id)
	{
		/*
		this.list[id].className = "connected";
		if (typeof this.conv[id] != "undefined")
			this.conv[id].is_connected(true);
		*/
	}

	this.send_msg = function(e)
	{
		e.preventDefault();
		if (this.msg.value.length == 0)
			return;

		var messageJSON = {
			action : "message",
			to : this.id_user,
			message : this.msg.value
		};

		client.websocket.send(JSON.stringify(messageJSON));
		this.show_msg(this.msg.value, true);
		this.msg.value = "";
	}

	this.show_msg = function(msg, from_me)
	{
		msg_div = document.createElement('div');
		if (from_me)
			msg_div.className = 'from_me';
		msg_msg = document.createElement('p');
		msg_msg.innerHTML = msg;
		msg_div.appendChild(msg_msg);

		this.msg_box.appendChild(msg_div);
		this.msg_box.scrollTop = this.msg_box.scrollHeight;
	}

	this.incoming_message = function(message)
	{
		id = message['from'];
		mesg = message['msg'];
		username = message['username'];

		if (id == this.id_user)
			this.show_msg(mesg, false);
		else
			console.log("new msg");
	}

	this.put_friends = function(friends)
	{
		/*
		if (typeof friends !== 'undefined')
		{
			this.list.forEach(function(element) {
    			element.parentNode.removeChild(element);
			});
			this.list = Array();
			friends.forEach(function(element)
				{
					user = document.createElement('p');
					user.innerHTML = element.username;
					is_connected = document.createElement('span');
					if (element.connected)
						user.className = 'connected';
					else
						user.className = 'non_connected';
					user.appendChild(is_connected);
					this.list[element.id] = user;
					this.friends_list.appendChild(user);
					user.addEventListener('click', function(e){
						this.open_conv(element.id, element.username);
					}.bind(this))
				}.bind(this));
		}
		*/
	}

	this.connected = function (status)
	{
		/*
		if (status)
			// connected
		else
			// non connected
		*/
	}

	this.do = function (data)
	{
		if (typeof data.friends != 'undefined')
			this.put_friends(data.friends);
		if (typeof data.message != 'undefined')
			this.incoming_message(data.message);
		if (typeof data.logout != 'undefined')
			this.friends_logout(data.logout);
		if (typeof data.login != 'undefined')
			this.friends_login(data.login);
	}

	this.init = function ()
	{
		this.id_user = id_user;
		this.id_conv = id_conv;

		this.msg_box = document.getElementById('convers');
		form = document.getElementById('convers_form');
		this.msg = document.getElementById('convers_input');
		this.conv_list = document.getElementById('conv_list');

		form.addEventListener('submit', function(e){
			this.send_msg(e);
		}.bind(this))
	}
}

function chat_list(chat_list)
{
	this.chat_list = chat_list;
	this.conv = Array();
	this.list = Array();
	this.main_conv;

	this.friends_logout = function(id)
	{
		if (typeof this.list[id] != "undefined")
			this.list[id].className = "non_connected";
		if (typeof this.conv[id] != "undefined")
			this.conv[id].is_connected(false);
	}

	this.friends_login = function(id)
	{
		if (typeof this.list[id] != "undefined")
			this.list[id].className = "connected";
		if (typeof this.conv[id] != "undefined")
			this.conv[id].is_connected(true);
	}

	this.open_conv = function(id, username)
	{
		if (!(id in this.conv))
		{
			this.conv[id] = new conversation(id, username);
			this.conv[id].init();
		}
		if (!this.conv[id].open)
			this.conv[id].switch_open();
		if (this.conv[id].minized)
			this.conv[id].switch_mini();
	}

	this.incoming_message = function(message)
	{
		id = message['from'];
		mesg = message['msg'];
		username = message['username'];

		if (!(id in this.conv))
		{
			this.conv[id] = new conversation(id, username);
			this.conv[id].init();
		}
		if (!this.conv[id].open)
		{
			this.conv[id].switch_open();
			if (this.conv[id].minized)
				this.conv[id].switch_mini();
		}
		this.conv[id].show_msg(mesg, false);
	}

	this.put_friends = function(friends)
	{
		if (typeof friends !== 'undefined')
		{
			this.list.forEach(function(element) {
				element.parentNode.removeChild(element);
			});
			this.list = Array();
			friends.forEach(
				function(element)
				{
					user = document.createElement('p');
					user.innerHTML = element.username;
					is_connected = document.createElement('span');
					if (element.connected)
						user.className = 'connected';
					else
						user.className = 'non_connected';
					user.appendChild(is_connected);
					this.list[element.id] = user;
					this.friends_list.appendChild(user);
					user.addEventListener('click',
						function(e)
						{
							this.open_conv(element.id, element.username);
						}.bind(this)
					)
				}.bind(this)
			);
		}
	}

	this.connected = function (status)
	{
		if (status)
		{
			this.friends_list.style.opacity = "1";
			this.status_chat.style.display = "none";
		}
		else
		{
			this.friends_list.style.opacity = "0.2";
			this.status_chat.style.display = "block";
		}
	}

	this.put_previous_msg = function(prev)
	{
			console.log(this.conv);
		id = prev.id;
		prev.msgs.forEach(function(e) {
			from_me = (e.id_user_to == id) ? 1 : 0;


			this.conv[id].show_msg(e.msg, from_me);
		}.bind(this));
	}

	this.do = function(data)
	{
		if (typeof data.friends != 'undefined')
			this.put_friends(data.friends);
		if (typeof data.message != 'undefined')
			this.incoming_message(data.message);
		if (typeof data.logout != 'undefined')
			this.friends_logout(data.logout);
		if (typeof data.login != 'undefined')
			this.friends_login(data.login);
		if (typeof data.previous_message != 'undefined')
			this.put_previous_msg(data.previous_message);
	}

	this.init = function ()
	{
		friends_list = document.createElement('div');
		friends_list.className = 'friends_list';
		this.chat_list.appendChild(friends_list);
		status_chat = document.createElement('div');
		status_chat.className = 'status_chat';
		status_chat.innerHTML = "Connecting to chat...";
		this.chat_list.appendChild(status_chat);
		this.status_chat = status_chat;
		this.friends_list = friends_list;
		chat_list_cont.style.display = "block";
		console.log("init");
	}
}

function conversation(id_user, username)
{
	this.chat_conv = document.getElementById("chat_conv");
	this.open = Boolean(true);
	this.minized = Boolean(false);
	this.connected = Boolean(false);
	this.id_user = id_user;
	this.username = username;
	this.conv = "";
	this.msg_box = "";
	this.msg = "";

	this.switch_open = function()
	{
		if (this.open)
			this.conv.style.display = "none";
		else
			this.conv.style.display = "block";
		this.open = !this.open;
	}

	this.is_connected = function(status)
	{
	}

	this.switch_mini = function()
	{
		if (this.minized)
			this.conv_elem.style.display = "flex";
		else
			this.conv_elem.style.display = "none";
		this.minized = !this.minized;
	}

	this.send_msg = function(e)
	{
		e.preventDefault();
		if (this.msg.value.length == 0)
			return;
		var messageJSON = {
			action : "message",
			to : this.id_user,
			message : this.msg.value
		};
		client.websocket.send(JSON.stringify(messageJSON));
		this.show_msg(this.msg.value, true);
		this.msg.value = "";
	}

	this.show_msg = function(msg, from_me)
	{
		msg_div = document.createElement('div');
		if (from_me)
			msg_div.className = 'from_me';
		msg_msg = document.createElement('p');
		msg_msg.innerHTML = msg;
		msg_div.appendChild(msg_msg);
		this.msg_box.appendChild(msg_div);
		this.msg_box.scrollTop = this.msg_box.scrollHeight;
	}

	this.init = function ()
	{
		this.conv = document.createElement('div');
		this.conv.className = 'conv';
		conv_name = document.createElement('div');
		conv_name.className = 'conv_name';
		this.conv.appendChild(conv_name);
		conv_username = document.createElement('p');
		conv_username.className = 'name';
		conv_username.innerHTML = this.username;
		conv_name.appendChild(conv_username);
		close_conv = document.createElement('span');
		close_conv.className = 'close_conv';
		close_conv.innerHTML = "✘";
		conv_username.appendChild(close_conv);
		conv_connected = document.createElement('span');
		conv_connected.className = 'connected';
		conv_username.appendChild(conv_connected);
		this.conv_connected = conv_connected;
		conv_elem = document.createElement('div');
		conv_elem.className = 'conv_elem';
		this.conv_elem = conv_elem;
		this.conv.appendChild(conv_elem);
		msg_box = document.createElement('div');
		this.msg_box = msg_box;
		msg_box.className = 'msg_box';
		conv_elem.appendChild(msg_box);
		form = document.createElement('form');
		conv_elem.appendChild(form);
		msg = document.createElement('input');
		this.msg = msg;
		msg.className = 'chat_input';
		msg.placeholder = "Message";
		msg.value = "";
		form.appendChild(msg);
		conv_name.addEventListener('click', function(e){
			this.switch_mini(e);
		}.bind(this))
		close_conv.addEventListener('click', function(e){
			this.switch_open(e);
		}.bind(this))
		form.addEventListener('submit', function(e){
			this.send_msg(e);
		}.bind(this))
		this.chat_conv.insertBefore(this.conv, chat_conv.firstChild);

		var messageJSON = {
				action : "previous_message",
				id : id_user,
			};
		client.websocket.send(JSON.stringify(messageJSON));

	}
}

