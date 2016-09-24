
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(90) COLLATE utf8_persian_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `amount` int(7) NOT NULL,
  `status` enum('n','y') COLLATE utf8_persian_ci NOT NULL DEFAULT 'n',
  `ref` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1000 ;


CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `amount` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1000 ;
