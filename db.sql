CREATE TABLE shorturls (
  `id` int(100) NOT NULL PRIMARY KEY auto_increment,
  `url` tinytext NOT NULL,
  `shortUrl` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;