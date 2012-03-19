-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2011 at 05:02 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `msg` varchar(250) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`uid`, `name`, `email`, `msg`) VALUES
(1, 'koushik', 'koushik@gmail.com', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `mcontact`
--

CREATE TABLE IF NOT EXISTS `mcontact` (
  `id` int(10) NOT NULL,
  `address` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `phno` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcontact`
--

INSERT INTO `mcontact` (`id`, `address`, `city`, `district`, `state`, `country`, `zip`, `phno`, `email`) VALUES
(17, '17', 'Shibnagar', 'purulia', 'purulia', 'wb', 'India', '91234567', 'bis@gmail.com'),
(16, 'Shibnagar', 'dgp', 'burdhwan', 'West Bengal', 'India', '723125', '9832125914', 'alam@yahoo.com'),
(15, 'ranchi', 'ranchi', 'ranchi', 'jharkhand', 'india', '5678905', '9563611365', 'prosanta@live.com'),
(18, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `missing_db`
--

CREATE TABLE IF NOT EXISTS `missing_db` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `missingdate` varchar(10) NOT NULL,
  `address` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `height` varchar(25) NOT NULL,
  `weight` varchar(25) NOT NULL,
  `age` varchar(25) NOT NULL,
  `sex` varchar(25) NOT NULL,
  `bodysign` varchar(25) NOT NULL,
  `haircolor` varchar(25) NOT NULL,
  `eyecolor` varchar(25) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `missing_db`
--

INSERT INTO `missing_db` (`mid`, `uid`, `fname`, `mname`, `lname`, `missingdate`, `address`, `city`, `district`, `state`, `country`, `zip`, `height`, `weight`, `age`, `sex`, `bodysign`, `haircolor`, `eyecolor`, `image`) VALUES
(17, 13, 'Biswarup', 'kumar', 'goswami', '12/12/2011', '17', 'Shibnagar', 'purulia', 'purulia', 'wb', 'India', '5ft', '45kg', '24', 'Male', 'unknown', 'black', 'brown', '1-1321970829.jpg'),
(16, 13, 'Laltu', 'kumar', 'mahato', '13/11/2011', 'Shibnagar', 'dgp', 'burdhwan', 'West Bengal', 'India', '723125', '5ft', '45kg', '35', 'male', 'unknown', 'black', 'brown', '5-1321970166.jpg'),
(15, 14, 'prosanta', 'kumarr', 'deoghoria', '12/12/2011', 'ranchi', 'ranchi', 'ranchi', 'jharkhand', 'india', '5678905', '5ft', '35', '28', 'male', 'unknown', 'black', 'brown', '4-1321969710.jpg'),
(18, 15, 'fd', 'fgd', 'fdf', '', '', '', '', '', '', '', 'dhdh', 'dhgdh', 'hd', 'dfddhhd', 'fddf', 'fdg', 'fdffdf', 'Photo551-1322153933.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usertype` tinyint(1) NOT NULL,
  `registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blocked` tinyint(1) NOT NULL,
  `activationkey` varchar(250) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `email`, `usertype`, `registerdate`, `lastlogin`, `blocked`, `activationkey`) VALUES
(13, 'alam', '12345', 'alam@yahoo.com', 1, '2011-11-22 19:11:28', '2011-11-22 19:31:59', 0, '843f0540df8f2cf8dfe4d0c0ccea5751'),
(12, 'mintu', '123456', 'mintu@live.com', 1, '2011-11-22 19:09:50', '0000-00-00 00:00:00', 0, 'db9a8b9e74d186719e0a3c50af974082'),
(11, 'pallab', '1234', 'pallabmail@gmail.com', 1, '2011-11-22 19:08:25', '0000-00-00 00:00:00', 0, '07a6aec619aa1ae3c76d4c34d7f7f064'),
(10, 'samir', '1234', 'samir@gmail.com', 1, '2011-11-22 17:50:30', '2011-11-22 20:03:59', 0, '4d32478f63d66d11877c936ae527acb4'),
(14, 'koushik', '1234', 'koushik@gmail.com', 1, '2011-11-22 19:13:56', '2011-11-22 20:11:31', 0, 'c362b8e8e94e10f99fd73963e931e326'),
(15, 'madhav', '123', 'gcfff', 1, '2011-11-24 22:27:44', '2011-11-24 22:27:56', 0, 'bd698ab13781e895146e7a80382a3e8c');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `uid` int(10) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `sex` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `pin` varchar(250) NOT NULL,
  `phno` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`uid`, `fname`, `mname`, `lname`, `address`, `state`, `age`, `sex`, `country`, `pin`, `phno`, `image`) VALUES
(14, 'koushik ', 'kumar', 'santra', 'bagnan', 'wb', '23', 'male', 'india', '234561', '892661854', '6-1321969436.jpg'),
(13, 'alam', 'kumar', 'sk', 'nabadip', 'wb', '23', 'male', 'india', '755521', '9453211345', '2-1321969288.jpg'),
(12, 'mintu', 'kumar', 'garai', 'asansol', 'wb', '23', 'male', 'india', '742231', '91234567', '3-1321969190.jpg'),
(11, 'pallab', 'kumar', 'tantubai', 'purulia', 'wb', '24', 'male', 'india', '723164', '9933486074', '1-1321969105.jpg'),
(15, 'fd', 'fdgh', 'fgjf', 'dfhd', 'dhfd', 'fdhf', 'dhd', 'dhd', '', 'hjk', 'Photo564-1322153864.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `view_content`
--

CREATE TABLE IF NOT EXISTS `view_content` (
  `v_id` int(10) NOT NULL AUTO_INCREMENT,
  `mid` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phno` int(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `title` varchar(45) NOT NULL,
  `msg` varchar(250) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `view_content`
--

INSERT INTO `view_content` (`v_id`, `mid`, `name`, `phno`, `email`, `title`, `msg`) VALUES
(8, 17, 'deb', 91234567, 'samir.150@gmail.com', 'dvbb', 'xzsasa'),
(7, 15, 'pallab', 91234567, 'pallabmail@gmail.com', 'seen', 'This human has been seen in dgp.perhaps brother of koushik.');
