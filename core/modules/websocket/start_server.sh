#!/bin/bash
ps -ef | grep "php" | grep -v grep > /dev/null;
if [[ $? -eq 0 ]]; then
    echo "PROCESS IS RUNNING" > /dev/null;
else
	`/Users/gelambin/bitnami/php/bin/php -q /Users/gelambin/htdocs/matcha/core/modules/websocket/web_socket_serveur.php  &> websocketlog &`
fi
