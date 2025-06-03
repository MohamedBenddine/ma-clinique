-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 29 mai 2025 à 19:50
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `damsmsdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `ID` int(10) NOT NULL,
  `AppointmentNumber` int(10) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint(20) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `Doctor` int(10) DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(250) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `VilleID` int(10) DEFAULT NULL,
  `ClinicID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tblappointment`
--

INSERT INTO `tblappointment` (`ID`, `AppointmentNumber`, `Name`, `MobileNumber`, `Email`, `AppointmentDate`, `Specialization`, `Doctor`, `ApplyDate`, `Remark`, `Status`, `UpdationDate`, `VilleID`, `ClinicID`) VALUES
(1, 499219152, 'Mukesh Yadav', 7977797979, 'mukesh@gmail.com', '2025-01-13', '2', 2, '2022-11-10 07:08:58', 'Your appointment has been approved, kindly came at mention time', 'Approved', '2025-05-22 07:42:57', NULL, NULL),
(9, 651730390, 'ALI', 655313065, 'glailhala@gmail.com', '2025-09-22', '11', 8, '2025-05-22 07:51:38', NULL, NULL, NULL, NULL, NULL),
(10, 729652860, 'AVVVV', 655313045, 'glailhala@gmail.com', '2025-09-22', '11', 8, '2025-05-22 09:41:14', NULL, NULL, NULL, NULL, NULL),
(11, 359430033, 'WAGA', 677323454, 'waga@gmail.com', '2025-05-29', '11', 8, '2025-05-22 10:00:39', NULL, NULL, NULL, NULL, NULL),
(12, 645200422, 'ta', 12356, 'waga@gmail.com', '2025-05-27', '13', 9, '2025-05-22 10:09:25', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblclinic`
--

CREATE TABLE `tblclinic` (
  `ID` int(10) NOT NULL,
  `ClinicName` varchar(255) NOT NULL,
  `VilleID` int(10) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tbldoctor`
--

CREATE TABLE `tbldoctor` (
  `ID` int(5) NOT NULL,
  `FullName` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `Password` varchar(259) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tbldoctor`
--

INSERT INTO `tbldoctor` (`ID`, `FullName`, `MobileNumber`, `Email`, `Specialization`, `Password`, `CreationDate`) VALUES
(1, 'Dr. Ahmed Ouarnoughi', 5551234567, 'ahmed.ouarnoughi@example.com', 'Cardiology', 'password123', '2025-05-21 07:14:42'),
(2, 'Dr. Sara Benddine', 5559876543, 'sara.benddine@example.com', 'Dermatology', 'password123', '2025-05-21 07:14:42'),
(3, 'Dr. Karim Benali', 5556789012, 'karim.benali@example.com', 'Pediatrics', 'password123', '2025-05-21 07:14:42'),
(4, 'Dr. Arhab', 5553456789, 'arhab@example.com', 'Cardiology', 'password123', '2025-05-21 07:14:42'),
(5, 'Dr. Farshan', 5554567890, 'farshan@example.com', 'Gynecology and Obstetrics', 'password123', '2025-05-21 07:14:42'),
(6, 'Dr. Anusakha Singh', 9787979798, 'anu@gmail.com', '1', 'e10adc3949ba59abbe56e057f20f883e', '2022-11-09 15:01:11'),
(7, 'Mohamed', 676583546, 'mo@gail.com', '12', '06c56a89949d617def52f371c357b6db', '2025-05-21 05:17:20'),
(8, 'WAGA', 677323454, 'waga@gmail.com', '11', 'a521c3e6c788c1f4499f40290b2ff371', '2025-05-21 13:20:24'),
(9, 'AVVVV', 655313045, 'glailhala@gmail.com', '13', '827ccb0eea8a706c4c34a16891f84e7b', '2025-05-22 10:05:46');

-- --------------------------------------------------------

--
-- Structure de la table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', '<div><font color=\"#202124\" face=\"arial, sans-serif\"><b>Our mission declares our purpose of existence as a healthcare technology solution and our objectives.</b></font></div>\r\n<div><font color=\"#202124\" face=\"arial, sans-serif\"><b><br></b></font></div>\r\n<div><font color=\"#202124\" face=\"arial, sans-serif\"><b>To provide every user — whether patient or doctor — much more than expected in terms of usability, accessibility, data security, and personalized service, by understanding local healthcare needs and continuously innovating to ultimately deliver an unmatched experience in medical appointment scheduling through ob-doc-web.</b></font></div>', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', 'Adresse de la clinique :\r\nob-doc-web\r\nRue 890, Quartier Benddine, ru de de Ouarnoughi,\r\nCommune  aflou,\r\nWilaya de Laghouat, Algérie\r\nCode postal : 44036', 'info@gmail.com', 9100000000, NULL, '10:30 am to 7:30 pm');

-- --------------------------------------------------------

--
-- Structure de la table `tblspecialization`
--

CREATE TABLE `tblspecialization` (
  `ID` int(5) NOT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tblspecialization`
--

INSERT INTO `tblspecialization` (`ID`, `Specialization`, `CreationDate`) VALUES
(1, 'Orthopedics', '2022-11-09 14:22:33'),
(2, 'Internal Medicine', '2022-11-09 14:23:42'),
(3, 'Obstetrics and Gynecology', '2022-11-09 14:24:14'),
(4, 'Dermatology', '2022-11-09 14:24:42'),
(5, 'Pediatrics', '2022-11-09 14:25:06'),
(6, 'Radiology', '2022-11-09 14:25:31'),
(7, 'General Surgery', '2022-11-09 14:25:52'),
(8, 'Ophthalmology', '2022-11-09 14:27:18'),
(9, 'Family Medicine', '2022-11-09 14:27:52'),
(10, 'Chest Medicine', '2022-11-09 14:28:32'),
(11, 'Anesthesia', '2022-11-09 14:29:12'),
(12, 'Pathology', '2022-11-09 14:29:51'),
(13, 'ENT', '2022-11-09 14:30:13');

-- --------------------------------------------------------

--
-- Structure de la table `tblville`
--

CREATE TABLE `tblville` (
  `ID` int(10) NOT NULL,
  `VilleName` varchar(255) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_ville` (`VilleID`),
  ADD KEY `fk_clinic` (`ClinicID`);

--
-- Index pour la table `tblclinic`
--
ALTER TABLE `tblclinic`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `VilleID` (`VilleID`);

--
-- Index pour la table `tbldoctor`
--
ALTER TABLE `tbldoctor`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tblville`
--
ALTER TABLE `tblville`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `tblclinic`
--
ALTER TABLE `tblclinic`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tbldoctor`
--
ALTER TABLE `tbldoctor`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tblville`
--
ALTER TABLE `tblville`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD CONSTRAINT `fk_clinic` FOREIGN KEY (`ClinicID`) REFERENCES `tblclinic` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ville` FOREIGN KEY (`VilleID`) REFERENCES `tblville` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `tblclinic`
--
ALTER TABLE `tblclinic`
  ADD CONSTRAINT `tblclinic_ibfk_1` FOREIGN KEY (`VilleID`) REFERENCES `tblville` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
