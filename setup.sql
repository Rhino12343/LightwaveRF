CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET latin1;

USE `users`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `usn` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `salt` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,'Administrator','532662b74ce6f5b51324b9c2910506b3','2016-04-08 16:29:00');
UNLOCK TABLES;

DROP TABLE IF EXISTS `user_details`;

CREATE TABLE `user_details` (
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `street` varchar(75) NOT NULL,
  `suite` varchar(40) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `latitude` float(7,4) NOT NULL,
  `longitude` float(7,4) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `website` varchar(30) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `catch_phrase` varchar(255) NOT NULL,
  `strap_line` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`user_id`)
    REFERENCES users(`user_id`)
    ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;