-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 10:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mangastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Email`, `Password`) VALUES
(1, 'raha@gmail.com', 'Raha@123');

-- --------------------------------------------------------

--
-- Table structure for table `browse`
--

CREATE TABLE `browse` (
  `Email` varchar(50) NOT NULL,
  `Manga_ID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL,
  `Admin_ID_Cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`, `Admin_ID_Cat`) VALUES
(1, 'Action', 1),
(2, 'Crime', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `C_Name` varchar(50) NOT NULL,
  `Admin_ID_C` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Email`, `Password`, `C_Name`, `Admin_ID_C`) VALUES
('hell@gmail.com', '$2y$10$b22QGJqhcD4q6U7T7n8tdu4YDpigb.dzMUan7.KaJQskLnveLHMeq', 'Raha', 1),
('R@gmail.com', '$2y$10$D6KW0M7hAsdyS1c9m40rUe2xIC4pqbRrbd75hY9h5TnO0W.ogINuq', 'Raha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manga`
--

CREATE TABLE `manga` (
  `Manga_ID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Mangaka` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Price` float NOT NULL,
  `Admin_ID_M` int(11) NOT NULL,
  `Cat_ID_M` int(11) NOT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manga`
--

INSERT INTO `manga` (`Manga_ID`, `Title`, `Mangaka`, `Description`, `Price`, `Admin_ID_M`, `Cat_ID_M`, `Image`) VALUES
(6, 'Jujutsu Kaisen', 'Gege Akutami', 'Yuji Itadori, a kind-hearted teenager, joins his school\'s Occult Club for fun, but discovers that its members are actual sorcerers who can manipulate the energy between beings for their own use. He hears about a cursed talisman - the finger of Sukuna, a demon - and its being targeted by other cursed beings.', 10, 1, 0, 'uploads/jjkManga.jpg'),
(7, 'Fire Punch', 'Tatsuki Fujimoto', 'The manga is set in a world where super powered people, called the Blessed, started a new Ice Age that is slowly leading to the extinction of humanity. The Ice Witch also blankets the world in snow, starvation, and madness. \r\nThe manga is violent and gory, but at its core it is a story about wanting to live. One reviewer says that the story is \"messed up\" but \"hooking\". Another reviewer says that the author tries to throw the reader off balance by including things like a man on fire playing in water with a girl carrying a severed head. ', 12, 1, 0, 'uploads/firepunchManga.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `manga_volume`
--

CREATE TABLE `manga_volume` (
  `Manga_ID` int(11) NOT NULL,
  `Volume` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL,
  `C_Email` varchar(255) DEFAULT NULL,
  `Manga_ID` int(11) DEFAULT NULL,
  `Order_Details_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL,
  `Amount` float NOT NULL,
  `Payment_Status` varchar(10) NOT NULL,
  `Customer_Email` varchar(50) NOT NULL,
  `Order_ID_Pay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Amount`, `Payment_Status`, `Customer_Email`, `Order_ID_Pay`) VALUES
(2, 12, 'paid', 'hell@gmail.com', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `browse`
--
ALTER TABLE `browse`
  ADD PRIMARY KEY (`Email`,`Manga_ID`),
  ADD KEY `Browse_Manga_FK` (`Manga_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`),
  ADD KEY `Category_Admin_FK` (`Admin_ID_Cat`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `Customer_Admin_FK` (`Admin_ID_C`);

--
-- Indexes for table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`Manga_ID`),
  ADD KEY `Manga_Admin_FK` (`Admin_ID_M`),
  ADD KEY `Manga_Category_FK` (`Cat_ID_M`);

--
-- Indexes for table `manga_volume`
--
ALTER TABLE `manga_volume`
  ADD PRIMARY KEY (`Manga_ID`,`Volume`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`Order_Details_ID`),
  ADD KEY `fk_customer_email` (`C_Email`),
  ADD KEY `fk_manga_id` (`Manga_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Payment_Customer_FK` (`Customer_Email`),
  ADD KEY `Payment_Order_FK` (`Order_ID_Pay`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manga`
--
ALTER TABLE `manga`
  MODIFY `Manga_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `Order_Details_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `browse`
--
ALTER TABLE `browse`
  ADD CONSTRAINT `Browse_Customer_FK` FOREIGN KEY (`Email`) REFERENCES `customer` (`Email`),
  ADD CONSTRAINT `Browse_Manga_FK` FOREIGN KEY (`Manga_ID`) REFERENCES `manga` (`Manga_ID`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `Category_Admin_FK` FOREIGN KEY (`Admin_ID_Cat`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `Customer_Admin_FK` FOREIGN KEY (`Admin_ID_C`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `manga`
--
ALTER TABLE `manga`
  ADD CONSTRAINT `Manga_Admin_FK` FOREIGN KEY (`Admin_ID_M`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `Manga_Category_FK` FOREIGN KEY (`Cat_ID_M`) REFERENCES `category` (`Category_ID`);

--
-- Constraints for table `manga_volume`
--
ALTER TABLE `manga_volume`
  ADD CONSTRAINT `MangaVolume_Manga` FOREIGN KEY (`Manga_ID`) REFERENCES `manga` (`Manga_ID`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_customer_email` FOREIGN KEY (`C_Email`) REFERENCES `customer` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_manga_id` FOREIGN KEY (`Manga_ID`) REFERENCES `manga` (`Manga_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `Payment_Customer_FK` FOREIGN KEY (`Customer_Email`) REFERENCES `customer` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
