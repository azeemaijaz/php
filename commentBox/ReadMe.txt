DEMO-> https://srv-file8.gofile.io/download/wJt3oB/demo.mp4

Create database named = comments
And import comments.sql 
OR
Execute this query from phpmyadmin

CREATE TABLE `comments` (
  `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
