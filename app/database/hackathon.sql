
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


DROP DATABASE IF EXISTS `hackathon`;
CREATE DATABASE IF NOT EXISTS `hackathon` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hackathon`;


CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `team` varchar(100) NOT NULL,
  `id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `notes` (
  `content` varchar(10000000) NOT NULL,
  `company` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `team` varchar(100) NOT NULL,
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `cases` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `folders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foldername` varchar(100) NOT NULL,
  `users` varchar(100) NOT NULL,
  `case_ids` varchar(100) NOT NULL,
  
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



