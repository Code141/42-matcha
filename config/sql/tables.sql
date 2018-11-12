CREATE TABLE `user` (
	`id` int(11) NOT NULL,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`username` varchar(255) NOT NULL,
	`notif_like` int(11) NOT NULL,
	`notif_comment` int(11) NOT NULL,
	`notif_message` int(11) NOT NULL,
	`validated_account` varchar(128) NOT NULL,
	`reset_password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `user`
ADD PRIMARY KEY (`id`);
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `media` (
	`id` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `media`
ADD PRIMARY KEY (`id`);
ALTER TABLE `media`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `comments` (
	`id` int(11) NOT NULL,
	`id_media` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`comment` varchar(255) NOT NULL,
	`date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `comments`
ADD PRIMARY KEY (`id`);
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `likes` (
	`id` int(11) NOT NULL,
	`id_media` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `likes`
ADD PRIMARY KEY (`id`);
ALTER TABLE `likes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
