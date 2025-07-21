SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `chemicals` (
  `s_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `state` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `used` int(11) DEFAULT 0,
  `available` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `glassware` (
  `s_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `t_quantity` int(11) NOT NULL,
  `broken` int(11) NOT NULL DEFAULT 0,
  `working` int(11) NOT NULL,
  `date` date NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `instrument` (
  `number` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_quantity` int(20) NOT NULL,
  `broken` int(20) NOT NULL DEFAULT 0,
  `working` int(20) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `signin` (
  `fname` varchar(255) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `eid` varchar(255) NOT NULL,
  `contact` bigint(10) NOT NULL,
  `pswd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `action` varchar(10) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `entry_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `chemicals`
  ADD PRIMARY KEY (`s_no`);

ALTER TABLE `glassware`
  ADD PRIMARY KEY (`s_no`);

ALTER TABLE `instrument`
  ADD PRIMARY KEY (`number`),
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `signin`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `eid` (`eid`),
  ADD UNIQUE KEY `contact` (`contact`);

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
