-- --------------------------------------------------------
-- Host:                         118.174.29.26
-- Server version:               5.7.25-0ubuntu0.18.04.2 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for visit
CREATE DATABASE IF NOT EXISTS `visit` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `visit`;

-- Dumping structure for table visit.detail_visit
CREATE TABLE IF NOT EXISTS `detail_visit` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_user` varchar(10) NOT NULL,
  `idnum_detail` varchar(20) NOT NULL,
  `hn` int(7) unsigned zerofill NOT NULL,
  `edit_date` date NOT NULL,
  `visit` int(1) NOT NULL DEFAULT '1',
  `fname` varchar(200) NOT NULL,
  `mark` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '3=ข้อมูลไม่ถูกต้อง,4=ยกเลิก',
  `edit_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7568 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table visit.num_detail_visit
CREATE TABLE IF NOT EXISTS `num_detail_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `No` varchar(20) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3290 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table visit.tbl_status
CREATE TABLE IF NOT EXISTS `tbl_status` (
  `id` int(2) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table visit.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `CID` varchar(14) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `lname` varchar(100) NOT NULL,
  `dapart` varchar(200) DEFAULT NULL,
  `dp` varchar(60) DEFAULT NULL,
  `level` int(1) DEFAULT '1' COMMENT '0=Admin,1=Users',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
