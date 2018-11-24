#!/bin/bash
 `/Users/gelambin/bitnami/php/bin/php -q /Users/gelambin/htdocs/matcha/core/modules/websocket/web_socket_serveur.php`&
 &&
ps aux | grep web_socket
