DROP TABLE IF EXISTS `prevtraxs`;
CREATE TABLE `prevtraxs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` char(10) NOT NULL,
  `num1` char(2) NOT NULL,
  `num2` char(2) NOT NULL,
  `num3` char(2) NOT NULL,
  `num4` char(2) NOT NULL,
  `num5` char(2) NOT NULL,
  `num6` char(2) NOT NULL,
  `num7` char(2) NOT NULL,
  `num8` char(2) NOT NULL,
  `num9` char(2) NOT NULL,
  `num10` char(2) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
