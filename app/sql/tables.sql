CREATE TABLE `bio` (
  `id_user` int(11) NOT NULL,
  `bio` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `blocked` (
  `id_user(from)` int(11) NOT NULL,
  `id_user(to)` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `browsing_history` (
  `id_user(from)` int(11) NOT NULL,
  `id_user(to)` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `connexion` (
  `id_user` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gender_identity` (
  `id` int(11) NOT NULL,
  `gender_identity_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `like` (
  `id_user_from` int(11) NOT NULL,
  `id_user_to` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `media` (
  `id_user` int(11) NOT NULL,
  `filename` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `msg` (
  `id` int(11) NOT NULL,
  `id_user(from)` int(11) NOT NULL,
  `id_user(to)` int(11) NOT NULL,
  `msg` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reported` (
  `id_user(from)` int(11) NOT NULL,
  `id_user(to)` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tag` (
  `id` int(11),
  `tag_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `user` (
  `id` int(11) not null,
  `username` varchar(30) not null,
  `firstname` varchar(30) not null,
  `lastname` varchar(30) not null,
  `birthdate` date not null,
  `id_media` int(11) default null,
  `password` varchar(256) not null,
  `email` varchar(64) not null,
  `id_gender` int(11) not null,
  `id_gender_identity` int(11) default null,
  `latitude` float default null,
  `longitude` float default null,
  `new_email` varchar(64) default null,
  `token_email` varchar(256) default null,
  `token_password` varchar(256) default null,
  `token_account` varchar(256) default null
) engine=innodb deFAULT CHARSET=utf8;

CREATE TABLE `user_orientation` (
  `id_user` int(11) NOT NULL,
  `id_gender` int(11) NOT NULL,
  `id_gender_identity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_tags` (
  `id_user` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gender_identity`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

INSERT INTO `gender` (`id`, `gender_name`) VALUES
(1, 'male'),
(2, 'female'),
(3, 'intersex'),
(4, 'none');

ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `gender_identity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tag`
  MODIFY `id` int(11) AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

