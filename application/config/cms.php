<?php
$sql[] = '
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `content` mediumtext CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = '
CREATE TABLE IF NOT EXISTS `displays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pages_sections` int(11) DEFAULT NULL,
  `positions` int(11) DEFAULT NULL,
  `id_types` int(11) DEFAULT NULL,
  `id_foreigns` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pages_sections` (`id_pages_sections`),
  KEY `id_types` (`id_types`),
  KEY `id_foreigns` (`id_foreigns`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = '
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = '
CREATE TABLE IF NOT EXISTS `pages_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pages` int(11) DEFAULT NULL,
  `id_sections` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pages` (`id_pages`),
  KEY `id_sections` (`id_sections`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = '
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = "
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET latin1 NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";

$sql[] = '
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var` varchar(50) CHARACTER SET latin1 NOT NULL,
  `param` varchar(50) CHARACTER SET latin1 NOT NULL,
  `value` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = '
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `model` varchar(20) COLLATE utf8_bin NOT NULL,
  `ext` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `field` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = "INSERT INTO `types` (`id`, `type`, `model`, `ext`, `field`) VALUES
(1, 'contents', 'content', 'ctn', 'title'),
(2, 'menus', 'menu', 'mnu', 'menu');";

$sql[] = 'CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_bin NOT NULL,
  `positions` int(11) NOT NULL,
  `id_menus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menus` (`id_menus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';

?>
