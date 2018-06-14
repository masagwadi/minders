-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 07, 2018 at 10:39 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afmfaith_minderz`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `bookid` int(11) NOT NULL AUTO_INCREMENT,
  `booktime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service` varchar(250) NOT NULL,
  `nopets` int(11) NOT NULL,
  `startdate` varchar(250) NOT NULL,
  `enddate` varchar(250) NOT NULL,
  `starttime` varchar(250) NOT NULL,
  `petname` varchar(250) NOT NULL,
  `pettype` varchar(250) NOT NULL,
  `petbreed` varchar(250) NOT NULL,
  `petage` varchar(250) NOT NULL,
  `petsize` varchar(250) NOT NULL,
  `petchild` varchar(250) NOT NULL,
  `petfleas` varchar(250) NOT NULL,
  `ownername` varchar(250) NOT NULL,
  `ownersurname` varchar(250) NOT NULL,
  `owneremail` varchar(250) NOT NULL,
  `ownercell` varchar(250) NOT NULL,
  `ownercity` varchar(250) NOT NULL,
  `ownersurburb` varchar(250) NOT NULL,
  `ownerstreet` varchar(250) NOT NULL,
  `ownerproperty` varchar(250) NOT NULL,
  `owneremergency` varchar(250) NOT NULL,
  `ownervet` varchar(250) NOT NULL,
  `bookpayment` varchar(250) NOT NULL DEFAULT 'pending',
  `reference` varchar(250) NOT NULL,
  `bookerid` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookid`, `booktime`, `service`, `nopets`, `startdate`, `enddate`, `starttime`, `petname`, `pettype`, `petbreed`, `petage`, `petsize`, `petchild`, `petfleas`, `ownername`, `ownersurname`, `owneremail`, `ownercell`, `ownercity`, `ownersurburb`, `ownerstreet`, `ownerproperty`, `owneremergency`, `ownervet`, `bookpayment`, `reference`, `bookerid`, `amount`) VALUES
(11, '2018-06-07 22:00:13', 'dropinvisits', 3, '06/20/2018', '06/22/2018', '1', 'pnk', '1', 'pb', 'pa', '1', '1', 'pa', 'Sagwadi', 'Maluleke', 'masagwadi1@gmail.com', '0848689587', 'CT', 'sur', '24', 'prop', '0848689587', '2020', 'pending', '6OVWMEM9HD', '', '891'),
(12, '2018-06-07 22:11:00', 'petsitting', 1, '06/19/2018', '06/25/2018', '1', 'pn', '1', 'pb', 'pa', '1', '1', 'pa', 'Sagwadi', 'Maluleke', 'masagwadi1@gmail.com', '0848689587', 'CT', 'sur', '24', 'prop', '0848689587', '2020', 'pending', '04HHC7200U', '', '1323');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `testid` int(11) NOT NULL AUTO_INCREMENT,
  `num1` varchar(250) NOT NULL,
  `num2` varchar(205) NOT NULL,
  PRIMARY KEY (`testid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`testid`, `num1`, `num2`) VALUES
(1, '2020', '3030'),
(2, '8080', '90');

-- --------------------------------------------------------

--
-- Table structure for table `usersmain`
--

DROP TABLE IF EXISTS `usersmain`;
CREATE TABLE IF NOT EXISTS `usersmain` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `cell` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `refference` varchar(250) NOT NULL,
  `user_status` varchar(250) NOT NULL DEFAULT 'active',
  `user_type` varchar(250) NOT NULL DEFAULT 'general',
  `activation_code` varchar(250) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersmain`
--

INSERT INTO `usersmain` (`userid`, `created_date`, `updated_date`, `name`, `lastname`, `email`, `cell`, `gender`, `user_password`, `refference`, `user_status`, `user_type`, `activation_code`) VALUES
(2, '2018-05-20 15:27:54', '2018-05-20 17:27:54', 'Sagwadi ', 'Maluleke', 'masagwadi5@gmail.com', '0848689587', 'female', '*5AF7FDB1F85EEC12D84889FECE6AA903E75264CF', 'none', 'active', 'general', 'none'),
(3, '2018-05-20 15:55:16', '2018-05-20 17:55:16', 'Sagwadi ', 'Malueleke', 'masagwadi@gmail.com', '0848358732', 'male', '*7ED2C4EC9032D553EDF20A420D86E4DF8B34C796', 'none', 'active', 'general', '5494250');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
