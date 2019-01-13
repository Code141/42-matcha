window.onload = function ()
{
	chat_list_cont = document.getElementById("chat_list");
	ctrl_like = new like_ctrl();
	user_like_data.forEach(function(user){
		ctrl_like.new_user(user.id, user.u1, user.u1_revoked, user.u2, user.u2_revoked);
	});
	notif = new notif();
	client = new websock();
	if (typeof id_conv == "undefined")
		chat_list = new chat_list(chat_list_cont);
	else
		chat_list = new messagerie();

	client.init();
	chat_list.init();
	chat_list.connected(true);
};

window.onbeforeunload = function (e) 
{
/*	if (typeof client != "undefined" && typeof client.worker != "undefined")
		client.worker.port.postMessage(JSON.stringify({ action: "close" }));
		*/
}.bind(this);

function websock()
{
	this.init = function()
	{
		this.worker = new SharedWorker("/matcha/app/assets/js/socket_worker.js");
		this.worker.port.start();

		this.worker.port.addEventListener("message", function(event)
		{
			var data = JSON.parse(event.data);
			if (typeof data.like != 'undefined')
				notif.like(data.like);
			else if (typeof data.matche != 'undefined')
				notif.matche(data.matche);
			else if (typeof data.dislike != 'undefined')
				notif.dislike(data.dislike);
			else if (typeof data.history != 'undefined')
				notif.history(data.history);
			else if (data == "connected")
			{
				chat_list.connected(true);
				this.worker.port.postMessage(JSON.stringify({ action: "friends" }));
			}
			else if (data == "closed")
			{
				if (typeof chat_list !== "undefined")
					chat_list.connected(false);
			}
			else
				chat_list.do(data);
		}.bind(this), false);

}

	this.send = function(msg)
	{
		this.worker.port.postMessage(msg);
	}
}

function like_ctrl()
{
	this.user = Array();

	this.new_user = function(id_user, u1, u1_revoked, u2, u2_revoked)
	{
		u1 = (u1 && !u1_revoked) ? 1 : 0;
		u2 = (u2 && !u2_revoked) ? 1 : 0;
		this.user[id_user] = new user_like(id_user, u1, u2);
		this.user[id_user].refresh();
	}

	this.like = function(id)
	{
		if (typeof this.user[id] != "undefined")
		{
			this.user[id].u2 = 1;
			this.user[id].u2_revoked = 0;
			this.user[id].refresh();
		}
	}


	this.dislike = function(id)
	{
		if (typeof this.user[id] != "undefined")
		{
			this.user[id].u2 = 0;
			this.user[id].refresh();
		}
	}
}

function user_like(id_user, u1, u2)
{
	this.main_div = document.getElementById("user_like_" + id_user);
	this.id = id_user;
	this.u1 = u1;
	this.u2 = u2;

	this.refresh = function()
	{
		this.main_div.innerHTML = "";
		span = document.createElement('span');
		button = document.createElement('button');
		if (this.u1)
		{
			if (this.u2)
				span.innerHTML = "MATCHED";
			else
				span.innerHTML = "YOU LIKE THIS USER";
			button.innerHTML = "Dislike";
			button.onclick = function(){
				dislike(this.id);
				this.u1 = 0;
				this.refresh();
			}.bind(this);
		}
		else
		{
			if (this.u2)
				span.innerHTML = "THIS USER LIKES YOU";
			else
				span.innerHTML = "NOTHING TO SAY";
			button.innerHTML = "Like";
			button.onclick = function(){
				like(this.id);
				this.u1 = 1;
				this.refresh();
			}.bind(this);
		}
		this.main_div.appendChild(span);
		this.main_div.appendChild(button);
	}
}

function notif()
{
	this.notif_div = document.getElementById("notif");
	this.notif_detail_div = document.getElementById("detail");
	this.notif_nb_div = document.getElementById("nb_notif");
	this.open = Boolean(false);


	this.notif_div.addEventListener("click", function(){
		if(this.open)
			this.notif_detail_div.style.display = "none";
		else
		{
			ajax_request(SITE_ROOT + 'ajax/see_notifs/');
			this.notif_nb_div.innerHTML = "";
			this.notif_detail_div.style.display = "block";
			this.notif_detail_div.scrollTop = 0;
			this.notif_detail_div.childNodes.forEach(function(item){
				item.className = "seen";
			});
		}
		this.open = !this.open;
	}.bind(this));

	this.dislike = function(data)
	{
		new_node = document.createElement('p');
		user_name = document.createElement('a');
		user_name.innerHTML = data.username;
		new_node.innerHTML = '<a href="' + SITE_ROOT + '/profil/main/' + data.from + '"> ' + data.username + ' </a> has revoked you<span class="date">' + data.date + '</span> ';
		this.notif_detail_div.prepend(new_node);
		this.add_a_notif();
		ctrl_like.dislike(data.from);
	}

	this.like = function(data)
	{
		new_node = document.createElement('p');
		user_name = document.createElement('a');
		user_name.innerHTML = data.username;
		new_node.innerHTML = '<a href="' + SITE_ROOT + '/profil/main/' + data.from + '"> ' + data.username + ' </a> has liked you<span class="date">' + data.date + '</span> ';
		this.notif_detail_div.prepend(new_node);
		this.add_a_notif();
		ctrl_like.like(data.from);
	}

	this.matche = function(data)
	{
		new_node = document.createElement('p');
		user_name = document.createElement('a');
		user_name.innerHTML = data.username;
		new_node.innerHTML = '<a href="' + SITE_ROOT + '/profil/main/' + data.from + '"> ' + data.username + ' </a> has matched you<span class="date">' + data.date + '</span> ';
		this.notif_detail_div.prepend(new_node);
		this.add_a_notif();
		ctrl_like.like(data.from);
	}


	this.history = function(data)
	{
		new_node = document.createElement('p');
		user_name = document.createElement('a');
		user_name.innerHTML = data.username;
		new_node.innerHTML = '<a href="' + SITE_ROOT + '/profil/main/' + data.from + '"> ' + data.username + ' </a> has visited your profile<span class="date">' + data.date + '</span> ';
		this.notif_detail_div.prepend(new_node);
		this.add_a_notif();
	}

	this.add_a_notif = function()
	{
		nb = parseInt(this.notif_nb_div.innerHTML);
		nb = (isNaN(nb)) ? 0 : nb;
		this.notif_nb_div.innerHTML = nb + 1;
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
		client.send(JSON.stringify(messageJSON));
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
		if (typeof message['from'] == 'undefined')
		{
			from_me = true;
			id = parseInt(message['to']);
			mesg = message['message'];
		}
		else
		{
			from_me = false;
			id = parseInt(message['from']);
			mesg = message['msg'];
			username = message['username'];
		}
		if (id == this.id_user)
			this.show_msg(mesg, from_me);
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
		if (typeof message['from'] == 'undefined')
		{
			from_me = true;
			id = parseInt(message['to']);
			mesg = message['message'];
		}
		else
		{
			from_me = false;
			id = parseInt(message['from']);
			mesg = message['msg'];
			username = message['username'];
		}

		if (typeof username != "undefined")
		{
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
		}
		if (typeof this.conv[id] != "undefined")
		this.conv[id].show_msg(mesg, from_me);
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
		id = prev.id;
		from_me = (prev.msgs.id_user_to == id) ? 1 : 0;
		if (typeof this.conv[id] != "undefined")
			this.conv[id].show_msg(prev.msgs.msg, from_me);
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
		client.send(JSON.stringify(messageJSON));
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
		client.send(JSON.stringify(messageJSON));
	}
}

