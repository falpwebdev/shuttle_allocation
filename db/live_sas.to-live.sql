-- phpMyAdmin SQL Dump
-- version 5.1.0-rc1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2021 at 09:17 AM
-- Server version: 8.0.22
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `live_sas`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_accounts`
--

CREATE TABLE `m_accounts` (
  `idNumber` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empDeptCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empPosition` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empShift` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empHandleLine` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `userType` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_accounts`
--

INSERT INTO `m_accounts` (`idNumber`, `empName`, `empDeptCode`, `empPosition`, `empShift`, `empHandleLine`, `password`, `userType`) VALUES
('13-00888', 'Barunia, Rachelle L.', 'PD3', 'Associate', 'DS', 'PD3', 'Rbarunia', 'Clerk'),
('13-00908', 'Blanca, Brenda P.', 'QA', 'Junior Staff', 'DS', 'QA Suzuki Y2R Initial', '13-00908', 'Line Leader'),
('13-0293', 'Arellano, Nicole Jane E.', 'ACC', 'Staff', 'DS', 'Accounting and Taxation', 'FALP@accounting2020', 'Clerk'),
('13-0301', 'Carandang, Aubrey Grace O.', 'QA', 'Junior Staff', 'NS', 'QA Suzuki Initial', '13-0301', 'Line Leader'),
('13-0317', 'Carreon, Joanna Marie L.', 'NF', 'Staff', 'DS', 'NF Kaizen', 'Joancarreon24', 'Clerk'),
('13-0454', 'Maquinto, Rhea M.', 'QA', 'Junior Staff', 'DS', 'QA Suzuki YD1/YKC  Final', '13-0454', 'Line Leader'),
('13-0467', 'Libario, Janine R.', 'QA', 'Junior Staff', 'NS', 'QA Suzuki YV7/ Y2R Final', '13-0467', 'Line Leader'),
('13-0559', 'Aldover, Sheela Mae Bernadette G.', 'HR', 'Jr.Staff', 'DS', 'General Affairs', 'aleesh020311 ', 'Clerk'),
('13-0566\r\n', 'Baes, Jackielyn', 'QA', 'Junior Staff', 'DS', 'QA D01L Initial', '14-02341', 'Line Leader'),
('13-0566', 'Lanto, Madel L.', 'QA', 'Junior Staff', 'NS', 'QA D01L Initial', '13-0566', 'Line Leader'),
('13-0641', 'Almaria, Ana Marie A.', 'QA', 'Junior Staff', 'NS', 'QA D01L Final', '13-0641', 'Line Leader'),
('13-0718\r\n', 'De La Cueva, Alice W.', 'QA', 'Junior Staff', 'NS', 'QA Suzuki Y2R Initial', '14-02220', 'Line Leader'),
('13-0718', 'Galve, Flordeliza R.', 'QA', 'Junior Staff', 'NS', 'QA Suzuki Y2R Initial', '13-0718', 'Line Leader'),
('13-0781', 'Paña, Kimberly O.', 'QA', 'Junior Staff', 'NS', 'QA Merge Initial', '13-0781', 'Line Leader'),
('13-0818', 'Viola, Karen L.', 'PD2', 'Jr. Staff', 'NS', 'PD2', 'KViola', 'Clerk'),
('14-00991', 'Albay, Lonah Jean G.', 'QA', 'Junior Staff', 'DS', 'QA Daihatsu Initial', '14-00991', 'Line Leader'),
('14-01013\r\n', 'Lescano, Flory Lyn', 'QA', 'Junior Staff', 'DS', 'QA Suzuki YKC Final', '14-01708', 'Line Leader'),
('14-01013', 'Barrameda, Mary Grace', 'QA', 'Junior Staff', 'DS', 'QA Suzuki YKC Final\r\n', '14-01013', 'Line Leader'),
('14-01079', 'Mendoza, Marife B.', 'QA', 'Junior Staff', 'DS', 'QA Suzuki YV7/ Y2R Final', '14-01079', 'Line Leader'),
('14-01083', 'Biscocho, Jenna Ross G.', 'QA', 'Junior Staff', 'NS', 'QA Daihatsu Initial', '14-01083', 'Line Leader'),
('14-01130', 'Carmona, Rose Ann G.', 'QA', 'Junior Staff', 'DS', 'QA Subaru Initial', '14-01130', 'Line Leader'),
('14-01155', 'Cortiguerra, Crizales H.', 'QA', 'Junior Staff', 'NS', 'QA Suzuki YD1/YKC  Final', '14-01155', 'Line Leader'),
('14-01163', 'Cuevas, Amie B.', 'QA', 'Junior Staff', 'NS', 'QA Subaru Initial', '14-01163', 'Line Leader'),
('14-01311', 'Gomez, Mary Grace B.', 'QA', 'Junior Staff', 'DS', 'QA SWAT Final', '14-01311', 'Line Leader'),
('14-01411', 'Macatangay, Abigail E.', 'QA', 'Junior Staff', 'DS', 'QA Subaru Final', '14-01411', 'Line Leader'),
('14-01429', 'Flor, Maria Cheene M.', 'PD5', 'Associate', 'Junior Staff', 'PD5', 'MCFlor', 'Clerk'),
('14-01706', 'Adulio, Lady Lyn B.', 'QA', 'Junior Staff', 'DS', 'QA Battery/Honda T20 Initial', '14-01706', 'Line Leader'),
('14-01724', 'Barredo, Regin L.', 'QA', 'Junior Staff', 'NS', 'QA J12 Initial', '14-01724', 'Line Leader'),
('14-01740', 'Celestial, Jennyfer G.', 'QA', 'Junior Staff', 'NS', 'QA Suzuki YKC Final', '14-01740', 'Line Leader'),
('14-01812', 'Obispo, Venus P.', 'QA', 'Junior Staff', 'DS', 'QA Honda Initial', '14-01812', 'Line Leader'),
('14-01816', 'Pasigan, Sheena Anne R.', 'QA', 'Junior Staff', 'NS', 'QA Honda Final', '14-01816', 'Line Leader'),
('14-01822', 'Puyo, Jeniffer B.', 'PE', 'Jr. Staff', 'DS', 'AME', 'althea20', 'Clerk'),
('14-01825', 'Rabano, Angela B.', 'QA', 'Junior Staff', 'DS', 'QA Honda Final', '14-01825', 'Line Leader'),
('14-02022', 'Ciruelos, Sally C.', 'QA', 'Junior Staff', 'DS', 'QA Mazda Final', '14-02022', 'Line Leader'),
('14-02028', 'Dichoso, Ma. Jennifer J.', 'QA', 'Junior Staff', 'DS', 'QA Suzuki Initial', '14-02028', 'Line Leader'),
('14-02172', 'Festijo, Bleecy S.', 'PD4', 'Jr. Staff', 'NS', 'PD4', 'BFestijo', 'Clerk'),
('14-02228', 'Diaz, Jennifer A.', 'QA', 'Staff', 'NS', 'Quality Management', '14-02228', 'Clerk'),
('14-02243\r\n', 'Esteria, Lysa S.', 'QA', 'Junior Staff', 'NS', 'QA Subaru Final', '14-02243', 'Line Leader'),
('14-02361', 'Cordero, Judy Anne B.', 'QA', 'Junior Staff', 'DS', 'QA Merge Initial', '14-02361', 'Line Leader'),
('14-02410', 'San Juan, Rubielyn P.', 'PMD', 'Associate', 'DS', 'Production Control', '14-02410', 'Clerk'),
('14-02429', 'Tenorio, Joy J.', 'QA', 'Junior Staff', 'NS', 'QA SWAT Initial', '14-02429', 'Line Leader'),
('15-02532', 'Escalona, Sharon A.', 'PD2', 'Jr. Staff', 'DS', 'PD2', 'SEscalona', 'Clerk'),
('15-02679', 'Sobreviñas, Jennifer M.', 'QA', 'Junior Staff', 'NS', 'QA Honda Initial', '15-02679', 'Line Leader'),
('15-02683', 'Tapay, Jessica R.', 'QA', 'Junior Staff', 'DS', 'QA J12 Initial', '15-02683', 'Line Leader'),
('15-02804', 'Medallada, Carla Mariz B.', 'IT', 'Associate', 'NS', 'Information Technology', '11141994', 'Clerk'),
('15-02854', 'Tenorio, Jhonalyn A.', 'QA', 'Junior Staff', 'NS', 'QA SWAT Final', '15-02854', 'Line Leader'),
('15-02874', 'Timinia, Renalen C.', 'QA', 'Junior Staff', 'DS', 'QA Toyota Initial', '15-02874', 'Line Leader'),
('15-03002', 'Tutol, Rodelyn S.', 'QA', 'Junior Staff', 'NS', 'QA Mazda Final', '15-03002', 'Line Leader'),
('15-03025', 'Olap, Sheryl L.', 'PMD', 'Staff', 'DS', 'IMPEX', '15-03025', 'Clerk'),
('16-03119', 'Delos Reyes, Rowena T.', 'PDC', 'Associate', 'DS', 'Production Design Center', 'Pdcrowena2020', 'Clerk'),
('17-03139', 'Magpantay, Regine C.', 'IT', 'Associate', 'DS', 'Information Technology', '03181991', 'Clerk'),
('17-03145', 'De Mesa, Jessica', 'QA', 'Junior Staff', 'DS', 'QA SWAT Initial', '17-03145', 'Line Leader'),
('17-03168', 'Mendoza, Majella N.', 'QA', 'Junior Staff', 'NS', 'QA Honda T20 Final', '17-03168', 'Line Leader'),
('17-03175', 'Perez, Roxanne H.', 'QA', 'Jr. Staff', 'DS', 'Quality Control', '17-03175', 'Clerk'),
('17-03232', 'Calisin, Camille M.', 'EQD', 'Associate', 'DS', 'EQD', 'CMCALISIN0321', 'Clerk'),
('17-03276', 'Valencia, Princess C.', 'PD1', 'Associate', 'NS', 'PD1', 'PValencia', 'Clerk'),
('17-03293', 'Cachuela, Armivel B.', 'QA', 'Junior Staff', 'DS', 'QA D01L Final', '17-03293', 'Line Leader'),
('17-03433', 'Lasin, Veronica T.', 'PD4', 'Associate', 'NS', 'PD4', 'VLasin', 'Clerk'),
('17-03471', 'Rogelio, Jenelyn M.', 'PE', 'Associate', 'DS', 'PEC and C', 'jen0615', 'Clerk'),
('18-03536', 'Danio, Marife W.', 'HR', 'Junior Staff', 'DS', 'General Affairs', '18-03536', 'Clerk'),
('18-03707', 'Salud, Raquel B.', 'HR', 'Jr. Staff', 'DS', 'Human Resource', '18-03707', 'Clerk'),
('18-04342', 'Magpantay, Jennifer P.', 'PE', 'Associate', 'DS', 'MPPD', 'Alliah2019', 'Clerk'),
('19_PK32787', 'Sison, Lovely Joy B.', 'MPD', 'Associate', 'DS', 'Material Management', 'lovelyjoysison', 'Clerk'),
('19_PK33563', 'Ramos, Aranne Beck S.', 'QA', 'Associate', 'NS', 'QA FGI', '33563', 'Line Leader'),
('19_PK36623', 'Aguarin, Cristel Mae J.', 'QA', 'Associate', 'NS', 'QA PPG', '36623', 'Line Leader'),
('19-04950', 'Parto, Alyssa Megaera G.', 'QA', 'Associate', 'DS', 'Quality Management', '19-04950', 'Clerk'),
('19-05013', 'Patena, Pearl Irish R.', 'IT', 'Junior Staff', 'DS', 'Information technology', '19-050131', 'Clerk'),
('19-05016', 'Gonzales, Rechelle P.	', 'PE', 'Associate', 'DS', 'PEC and C', '021617', 'Clerk'),
('19-05168', 'De Chavez, Arrissa V.', 'HR', 'Associate', 'DS', 'Recruitment and Training', '19-05168', 'Clerk'),
('19-05308', 'Latoza, Roselle L.', 'PD1', 'Associate', 'DS', 'PD1', 'RLatoza', 'Clerk'),
('19-05333', 'Villa, Ma. Fe Elizabeth A.', 'PD3', 'Associate', 'DS', 'PD3', 'MFEVilla', 'Clerk'),
('20_PK43746', 'Briones, Rea O.', 'QA', 'Associate', 'DS', 'QA FGI', '43746', 'Line Leader'),
('20_PK45324', 'Manalo, Anafe M.', 'QA', 'Associate', 'NS', 'Quality Assurance', '45324', 'Clerk'),
('20-05491', 'Sangalang, Glades Joy B.', 'QA', 'Associate', 'DS', 'QA PPG', '20-05491', 'Line Leader'),
('20-05627', 'Villanueva, Jinky E.', 'PD5', 'Associate', 'NS', 'PD5', 'JVillanueva', 'Clerk'),
('20-05762', 'Embile, Nicole A.', 'PE', 'Associate', 'DS', 'PEC and C', 'nicole0205', 'Clerk'),
('20-05843', 'De Torres, King Ryan', 'PE', 'Associate', 'NS', 'PEC and C', 'king1003', 'Clerk'),
('BF-12437', 'Mendoza, Mary Krishtell M.', 'PD3', 'Associate', 'NS', 'PD3', 'MKMendoza', 'Clerk'),
('BF-15429', 'Manongsong, Ma. Joan M.', 'MPD', 'Associate', 'DS', 'Procurement', 'BF-15429', 'Clerk'),
('EN69-1072', 'Billones, Grace H.', 'QA', 'Associate', 'DS', 'Quality Assurance', '1072', 'Clerk'),
('EQD-DS-Fabrication', 'Fabrication DS', 'EQD', 'Associate', 'DS', 'Fabrication', 'EQD2021', 'Line Leader'),
('EQD-DS-Facilities', 'Facilities DS', 'EQD', 'Associate', 'DS', 'Facilities', 'EQD2021', 'Line Leader'),
('EQD-DS-FINALBM', 'EM CM Final DS', 'EQD', 'Associate', 'DS', 'EM Final (Corrective Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-DS-FINALPM', 'EM PM Final DS', 'EQD', 'Associate', 'DS', 'EM Final (Preventive Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-DS-INITIALBM', 'EM CM Initial DS', 'EQD', 'Associate', 'DS', 'EM Initial (Corrective Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-DS-INITIALPM', 'EM PM Initial DS', 'EQD', 'Associate', 'DS', 'EM Initial (Preventive Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-DS-MC', 'Machinery Center DS', 'EQD', 'Associate', 'DS', 'Machinery Center', 'EQD2021', 'Line Leader'),
('EQD-DS-MD', 'Machine Data DS', 'EQD', 'Associate', 'DS', 'Machine Data', 'EQD2021', 'Line Leader'),
('EQD-N', 'Calisin, Camille M.', 'EQD', 'Associate', 'NS', 'EQD', 'CMCALISIN0321', 'Clerk'),
('EQD-NS-Fabrication', 'Fabrication NS', 'EQD', 'Associate', 'NS', 'Fabrication', 'EQD2021', 'Line Leader'),
('EQD-NS-Facilities', 'Facilities NS', 'EQD', 'Associate', 'NS', 'Facilities', 'EQD2021', 'Line Leader'),
('EQD-NS-FINALBM', 'EM CM Final NS', 'EQD', 'Associate', 'NS', 'EM Final (Corrective Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-NS-FINALPM', 'EM PM Final NS', 'EQD', 'Associate', 'NS', 'EM Final (Preventive Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-NS-INITIALBM', 'EM CM Initial NS', 'EQD', 'Associate', 'NS', 'EM Initial (Corrective Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-NS-INITIALPM', 'EM PM Initial NS', 'EQD', 'Associate', 'NS', 'EM Initial (Preventive Maintenance)', 'EQD2021', 'Line Leader'),
('EQD-NS-MC', 'Machinery Center NS', 'EQD', 'Associate', 'NS', 'Machinery Center', 'EQD2021', 'Line Leader'),
('EQD-NS-MD', 'Machine Data NS', 'EQD', 'Associate', 'NS', 'Machine Data', 'EQD2021', 'Line Leader'),
('IMPEX-N', 'IMPEX NS', 'PMD', 'Associate', 'NS', 'IMPEX', 'IMPEX-NS', 'Clerk'),
('MM-N', 'Sison, Lovely Joy B.', 'MPD', 'Associate', 'NS', 'Material Management', 'Warehouse2020', 'Clerk'),
('MPPD-N', 'Magpantay, Jennifer P.', 'PE', 'Associate', 'NS', 'MPPD', 'Alliah2019', 'Clerk'),
('MWM00007936', 'Galve, Sharmine C.', 'PD3', 'Associate', 'DS', 'PD3', 'SGalve', 'Clerk'),
('NF-N', 'Campang, Andrew L.', 'NF', 'Staff', 'NS', 'NF Kaizen', 'safety2020', 'Clerk'),
('PC-N', 'San Juan, Rubielyn P.', 'PMD', 'Associate', 'DS', 'Production Control', '14-02410', 'Clerk'),
('PDC-N', 'Delos Reyes, Rowena T.', 'PDC', 'Associate', 'NS', 'Production Design Center', 'Pdcrowena2020', 'Clerk'),
('PE-N', 'Puyo, Jeniffer B.', 'PE', 'Jr. Staff', 'NS', 'AME', 'althea20', 'Clerk'),
('QC-N', 'Perez, Roxanne H.', 'QA', 'Jr. Staff', 'NS', 'Quality Control', '17-03175', 'Clerk'),
('RTS-N', 'De Chavez, Arrissa V.', 'HR', 'Associate', 'NS', 'Recruitment and Training', 'Arrissa05168', 'Clerk');

-- --------------------------------------------------------

--
-- Table structure for table `m_admin`
--

CREATE TABLE `m_admin` (
  `adminName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_admin`
--

INSERT INTO `m_admin` (`adminName`, `password`) VALUES
('KC Tolentino', 'c447a466d54059bb23cf32367f11f2b9'),
('Pearl Irish Patena', 'b281a834ee776cc5cf2c071649274e37');

-- --------------------------------------------------------

--
-- Table structure for table `m_adminacc`
--

CREATE TABLE `m_adminacc` (
  `idNumber` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shift` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adEmployer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_adminacc`
--

INSERT INTO `m_adminacc` (`idNumber`, `adName`, `shift`, `adEmployer`, `password`) VALUES
('12-0087', 'Tolentino, Kaeceleen A.', 'DS', 'FAS', 'Sheenasummersitti_3'),
('12-0087-N', 'Tolentino, Kaeceleen A.', 'NS', 'FAS', 'Compliance2020'),
('19-05013', 'PIP', 'DS', 'FAS', '19-050131'),
('AEM-DS', 'Add Even Coordinator DS', 'DS', 'Add Even', 'aemcoorDS'),
('AEM-NS', 'Add Even Coordinator NS', 'NS', 'Add Even', 'aemcoordNS'),
('MDHII-DS', 'MDHII Coordinator DS', 'DS', 'MDHII', 'MDHIIBATANGAS'),
('MDHII-NS', 'MDHII Coordinator NS', 'NS', 'MDHII', 'MDHIIBATANGAS'),
('Megatrend-DS', 'Megatrend Coordinator DS', 'DS', 'Megatrend', 'MWMCOOR19'),
('Megatrend-NS', 'Megatrend Coordinator NS', 'NS', 'Megatrend', 'MWMCOOR19'),
('OS-DS', 'One Source Coordinator DS', 'DS', 'One Source', 'osds0820'),
('OS-NS', 'One Source Coordinator NS', 'NS', 'One Source', 'osns0820'),
('PKIMT-DS', 'PKIMT Coordinator DS', 'DS', 'PKIMT', 'FASCoorDS2020'),
('PKIMT-NS', 'PKIMT Coordinator NS', 'NS', 'PKIMT', 'FASCoorNS2020');

-- --------------------------------------------------------

--
-- Table structure for table `m_agency`
--

CREATE TABLE `m_agency` (
  `listId` int NOT NULL,
  `agencyCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agencyName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_agency`
--

INSERT INTO `m_agency` (`listId`, `agencyCode`, `agencyName`) VALUES
(1, 'PKIMT', 'PKI Manufacturing and Technology. Inc.'),
(2, 'One Source', 'One Source General Solution Inc.'),
(3, 'Add Even', 'Add Even Manpower Resources & Solutions'),
(4, 'MDHII', 'Maxim'),
(5, 'FAS', 'Furukawa Automotive System'),
(6, 'Megatrend', 'Megatrend Workforce Management');

-- --------------------------------------------------------

--
-- Table structure for table `m_costing`
--

CREATE TABLE `m_costing` (
  `costCenter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptCode` varchar(2024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_costing`
--

INSERT INTO `m_costing` (`costCenter`, `deptCode`) VALUES
('102.1_General Affairs', 'HR'),
('102.2_General Affairs', 'HR'),
('102.3_General Affairs', 'HR'),
('102.6_General Affairs', 'HR'),
('103.3_Accounting and Taxation', 'ACC'),
('103.4_Accounting and Taxation', 'ACC'),
('103.5_Accounting and Taxation', 'ACC'),
('103.6_Accounting and Taxation', 'ACC'),
('104.2_Human Resource', 'HR'),
('104.3_Human Resource', 'HR'),
('104.4_Human Resource', 'HR'),
('104.5_Human Resource', 'HR'),
('104.6_Human Resource', 'HR'),
('106.1_G-Assist Team', 'G-Assist'),
('106.2_G-Assist Team', 'G-Assist'),
('106.3_G-Assist Team', 'G-Assist'),
('106.4_G-Assist Team', 'G-Assist'),
('201.1_QA_QM-CAG', 'QA'),
('201.1_QM_QM-QMS', 'QA'),
('201.1_QM_QM-QMS Clerk', 'QA'),
('201.2_QA_QA Clerk', 'QA'),
('201.2_QA_QM-CAG', 'QA'),
('201.2_QM_QM-QMS', 'QA'),
('201.3_QA_QC-CSG', 'QA'),
('201.3_QA_QM-CAG', 'QA'),
('201.3_QM_QM-QMS', 'QA'),
('201.4_QA_QC-CSG', 'QA'),
('201.4_QA_QM-CAG', 'QA'),
('201.4_QM_QM-QMS', 'QA'),
('201.5_QM_QM-QMS', 'QA'),
('201.6_QM_QM-QMS', 'QA'),
('202.1_D_QA-Final (Mass Pro)', 'QA'),
('202.1_H_QA-Initial (Mass Pro)', 'QA'),
('202.1_M_J12_QA-Final (Mass Pro)', 'QA'),
('202.1_M_QA-Final (Mass Pro)', 'QA'),
('202.1_N_QA-Initial (Mass Pro)', 'QA'),
('202.1_QA-Final (Mass Pro)', 'QA'),
('202.1_QA-Initial (Mass Pro)', 'QA'),
('202.1_QC - Dock Audit', 'QA'),
('202.1_QC I-ALERT', 'QA'),
('202.1_S_QA-Final (Mass Pro)', 'QA'),
('202.1_T_QA-Final (Mass Pro)', 'QA'),
('202.2_D_QA-Final (Mass Pro)', 'QA'),
('202.2_D_QC-Improvement', 'QA'),
('202.2_H_QA-Final (Mass Pro)', 'QA'),
('202.2_H_QC-Improvement', 'QA'),
('202.2_M_J12_QA-Final (Mass Pro)', 'QA'),
('202.2_M_QA-Final (Mass Pro)', 'QA'),
('202.2_N_QA-Final (Mass Pro)', 'QA'),
('202.2_QA-Final (Mass Pro)', 'QA'),
('202.2_QC - Dock Audit', 'QA'),
('202.2_QC I-ALERT', 'QA'),
('202.2_QC-Improvement', 'QA'),
('202.2_S_QA-Final (Mass Pro)', 'QA'),
('202.2_T_QA-Initial (Mass Pro)', 'QA'),
('202.3_D_QC-Improvement', 'QA'),
('202.3_H_QA-Final (Mass Pro)', 'QA'),
('202.3_M_J12_QA-Initial (Mass Pro)', 'QA'),
('202.3_M_QA-Final (Mass Pro)', 'QA'),
('202.3_M_QA-Initial (Mass Pro)', 'QA'),
('202.3_QA-Final (Mass Pro)', 'QA'),
('202.3_QA-Initial (Mass Pro)', 'QA'),
('202.3_QC - Dock Audit', 'QA'),
('202.3_QC I-ALERT', 'QA'),
('202.3_QC-Improvement', 'QA'),
('202.3_S_QA-Final (Mass Pro)', 'QA'),
('202.3_S_QC-Improvement', 'QA'),
('202.4_H_QA-Final (Mass Pro)', 'QA'),
('202.4_M_QA-Initial (Mass Pro)', 'QA'),
('202.4_N_QA-Final (Mass Pro)', 'QA'),
('202.4_QA-Final (Mass Pro)', 'QA'),
('202.4_QC - Dock Audit', 'QA'),
('203.1_QA-FGI', 'QA'),
('203.1_QA-PPG', 'QA'),
('203.1_QA-PPG Clerk', 'QA'),
('203.2_QA-FGI', 'QA'),
('203.2_QA-FGI Clerk', 'QA'),
('203.2_QA-PPG', 'QA'),
('203.3_QA-FGI', 'QA'),
('203.3_QA-PPG', 'QA'),
('203.4_QA-FGI', 'QA'),
('203.4_QA-PPG', 'QA'),
('203.5_QA-PPG', 'QA'),
('203.6_QA-PPG', 'QA'),
('301.1_Production Control', 'PMD'),
('301.2_PC Clerk', 'PMD'),
('301.3_Production Control', 'PMD'),
('301.4_Production Control', 'PMD'),
('301.6_Production Control', 'PMD'),
('302.1_FG Preparation', 'MPD'),
('302.1_Material Management', 'MPD'),
('302.1_MH (WHSE)', 'MPD'),
('302.1_MM Clerk', 'MPD'),
('302.2_FG Preparation', 'MPD'),
('302.2_Material Management', 'MPD'),
('302.2_MH (WHSE)', 'MPD'),
('302.3_Material Management', 'MPD'),
('302.4_Material Management', 'MPD'),
('302.5_Material Management', 'MPD'),
('302.6_Material Management', 'MPD'),
('303.1_Material Procurement', 'MPD'),
('303.3_Material Procurement', 'MPD'),
('303.5_Material Procurement', 'MPD'),
('304.1_IMPEX', 'PMD'),
('304.3_IMPEX', 'PMD'),
('304.5_IMPEX', 'PMD'),
('402.1_D_D01L Initial', 'PD2'),
('402.1_D_D54L Initial', 'PD2'),
('402.1_D_Daihatsu Initial', 'PD2'),
('402.1_Distributor', 'PD1'),
('402.1_H_Honda Initial ', 'PD5'),
('402.1_H_TKRA Initial', 'PD5'),
('402.1_M_J12_Mazda J12 Initial', 'PD3'),
('402.1_M_Mazda Merge Initial', 'PD3'),
('402.1_S_Suzuki Initial', 'PD4'),
('402.1_SU_Subaru Initial ', 'PD5'),
('402.1_T_Toyota Initial', 'PD4'),
('402.2_D_D01L Initial', 'PD2'),
('402.2_D_D54L Initial', 'PD2'),
('402.2_D_Daihatsu Initial', 'PD2'),
('402.2_H_Honda Initial ', 'PD5'),
('402.2_H_TKRA Initial', 'PD5'),
('402.2_M_J12_Mazda J12 Initial', 'PD3'),
('402.2_M_Mazda Merge Initial', 'PD3'),
('402.2_S_Suzuki Initial', 'PD4'),
('402.2_SU_Subaru Initial ', 'PD5'),
('402.2_T_Toyota Initial', 'PD4'),
('402.3_D_D54L Initial', 'PD2'),
('402.3_H_Honda Initial ', 'PD5'),
('402.3_M_J12_Mazda J12 Initial', 'PD3'),
('402.3_M_Mazda Merge Initial', 'PD3'),
('402.3_S_Suzuki Initial', 'PD4'),
('402.3_SU_Subaru Initial ', 'PD5'),
('402.3_T_Toyota Initial', 'PD4'),
('402.4_D_D54L Initial', 'PD2'),
('402.4_H_Honda Initial', 'PD5'),
('402.4_S_Suzuki Initial', 'PD4'),
('403.1_D_D01L Final', 'PD2'),
('403.1_D_D54L Final', 'PD2'),
('403.1_D_Daihatsu Final', 'PD2'),
('403.1_D_PD2 Clerk', 'PD2'),
('403.1_H_Honda Final', 'PD5'),
('403.1_H_PD5 Clerk', 'PD5'),
('403.1_H_TKRA Final', 'PD5'),
('403.1_M_J12_Mazda J12 Final', 'PD3'),
('403.1_M_Mazda Merge Final', 'PD3'),
('403.1_M_PD3 Clerk', 'PD3'),
('403.1_N_Nissan Final', 'PD2'),
('403.1_S_PD4 Clerk', 'PD4'),
('403.1_S_Suzuki Final', 'PD4'),
('403.1_SU_Subaru Final', 'PD5'),
('403.1_T_Toyota Final', 'PD4'),
('403.2_D_D01L Final', 'PD2'),
('403.2_D_D54L Final', 'PD2'),
('403.2_D_Daihatsu Final', 'PD2'),
('403.2_D_PD2 Clerk', 'PD2'),
('403.2_H_Honda Final', 'PD5'),
('403.2_H_PD5 Clerk', 'PD5'),
('403.2_H_TKRA Final', 'PD5'),
('403.2_M_J12_Mazda J12 Final', 'PD3'),
('403.2_M_Mazda Merge Final', 'PD3'),
('403.2_S_PD4 Clerk', 'PD4'),
('403.2_S_Suzuki Final', 'PD4'),
('403.2_SU_Subaru Final', 'PD5'),
('403.2_T_Toyota Final', 'PD4'),
('403.3_D_D01L Final', 'PD2'),
('403.3_D_D54L Final', 'PD2'),
('403.3_D_Daihatsu Final', 'PD2'),
('403.3_D_PD2 Clerk', 'PD2'),
('403.3_H_Honda Final', 'PD5'),
('403.3_H_TKRA Final', 'PD5'),
('403.3_M_J12_Mazda J12 Final', 'PD3'),
('403.3_M_Mazda Merge Final', 'PD3'),
('403.3_S_Suzuki Final', 'PD4'),
('403.3_SU_Subaru Final', 'PD5'),
('403.4_D_D54L Final', 'PD2'),
('403.4_H_Honda Final', 'PD5'),
('403.4_M_J12_Mazda J12 Final', 'PD3'),
('403.4_S_Suzuki Final', 'PD4'),
('403.5_D_Daihatsu Final', 'PD2'),
('403.5_H_Honda Final', 'PD5'),
('403.5_M_Mazda Merge Final', 'PD3'),
('403.5_S_Suzuki Final', 'PD4'),
('403.5_SU_Subaru Final', 'PD5'),
('403.6_D_Daihatsu Final', 'PD2'),
('403.6_H_Honda Final', 'PD5'),
('403.6_M_Mazda Merge Final', 'PD3'),
('403.6_S_Suzuki Final', 'PD4'),
('403.7_H_Honda Final', 'PD5'),
('404.1_PE-Final ( MPPD )', 'PE'),
('404.2_PE Clerk', 'PE'),
('404.2_PE-Final ( MPPD )', 'PE'),
('404.3_PE-Final ( MPPD )', 'PE'),
('404.4_PE-Final ( MPPD )', 'PE'),
('404.5_PE-Final ( MPPD )', 'PE'),
('404.6_PE-Final ( MPPD )', 'PE'),
('404.7_PE-Final ( MPPD )', 'PE'),
('405.1_PE Initial', 'PE'),
('405.2_PE Initial', 'PE'),
('405.3_PE Initial', 'PE'),
('405.4_PE Initial', 'PE'),
('405.5_PE Initial', 'PE'),
('406.1_D_PPET', 'PD1'),
('406.1_D_Repair Person', 'PD1'),
('406.1_H_PPET', 'PD1'),
('406.1_H_Repair Person', 'PD1'),
('406.1_M_J12_PPET', 'PD1'),
('406.1_M_Repair Person', 'PD1'),
('406.1_PD1 Clerk', 'PD1'),
('406.1_PPET', 'PD1'),
('406.1_S_PPET', 'PD1'),
('406.1_S_Repair Person', 'PD1'),
('406.1_SU_PPET', 'PD1'),
('406.1_SWAT Final', 'PD1'),
('406.1_SWAT Initial', 'PD1'),
('406.1_T_PPET', 'PD1'),
('406.1_T_Repair Person', 'PD1'),
('406.2_D_PPET', 'PD1'),
('406.2_D_Repair Person', 'PD1'),
('406.2_H_PPET', 'PD1'),
('406.2_H_Repair Person', 'PD1'),
('406.2_M_J12_PPET', 'PD1'),
('406.2_PPET', 'PD1'),
('406.2_S_PPET', 'PD1'),
('406.2_S_Repair Person', 'PD1'),
('406.2_SU_PPET', 'PD1'),
('406.2_SU_Repair Person', 'PD1'),
('406.2_SWAT Final', 'PD1'),
('406.2_T_PPET', 'PD1'),
('406.3_D_PPET', 'PD1'),
('406.3_H_PPET', 'PD1'),
('406.3_PPET', 'PD1'),
('406.3_S_PPET', 'PD1'),
('406.3_SU_PPET', 'PD1'),
('406.3_T_PPET', 'PD1'),
('406.4_PPET', 'PD1'),
('406.4_S_PPET', 'PD1'),
('406.4_SU_PPET', 'PD1'),
('406.5_PPET', 'PD1'),
('406.6_PPET', 'PD1'),
('407.1_Battery Final', 'PD1'),
('407.1_Battery Initial', 'PD1'),
('407.1_Tube Cutting', 'PD1'),
('407.2_Battery Final', 'PD1'),
('407.2_Battery Initial', 'PD1'),
('407.2_Tube Cutting', 'PD1'),
('407.3_Battery Final', 'PD1'),
('407.3_Battery Initial', 'PD1'),
('407.3_Tube Cutting', 'PD1'),
('407.4_Tube Cutting', 'PD1'),
('408.1_Tube Making', 'PD1'),
('408.2_Tube Making', 'PD1'),
('408.3_Tube Making', 'PD1'),
('409.1_Machinery Center', 'EQD'),
('409.2_Machinery Center', 'EQD'),
('409.3_Machinery Center', 'EQD'),
('410.1_VS Laminating', 'PD1'),
('501.1_Non- PD Technical Training', 'HR'),
('501.1_PD Technical Training', 'HR'),
('501.2_PD Technical Training', 'HR'),
('501.3_Non- PD Technical Training', 'HR'),
('501.3_PD Technical Training', 'HR'),
('501.4_Non- PD Technical Training', 'HR'),
('501.4_PD Technical Training', 'HR'),
('501.5_Non- PD Technical Training', 'HR'),
('501.5_PD Technical Training', 'HR'),
('601.1_PE-Final ( AME )', 'PE'),
('601.2_PE-Final ( AME )', 'PE'),
('601.3_PE-Final ( AME )', 'PE'),
('601.4_PE-Final ( AME )', 'PE'),
('602.1_Information Technology', 'IT'),
('602.2_Information Technology', 'IT'),
('602.3_Information Technology', 'IT'),
('602.4_Information Technology', 'IT'),
('603.1_Calibration', 'EQD'),
('603.1_EM Final (Corrective Maintenance)', 'EQD'),
('603.1_EM Final (Preventive Maintenance)', 'EQD'),
('603.1_EM Initial (Corrective Maintenance)', 'EQD'),
('603.1_EM Initial (Preventive Maintenance)', 'EQD'),
('603.1_Fabrication', 'EQD'),
('603.1_Machine Data', 'EQD'),
('603.1_Spareparts', 'EQD'),
('603.2_Calibration', 'EQD'),
('603.2_EM Final (Corrective Maintenance)', 'EQD'),
('603.2_EM Final (Preventive Maintenance)', 'EQD'),
('603.2_EM Initial (Corrective Maintenance)', 'EQD'),
('603.2_EM Initial (Preventive Maintenance)', 'EQD'),
('603.2_Fabrication', 'EQD'),
('603.2_Machine Data', 'EQD'),
('603.2_Spareparts', 'EQD'),
('603.3_EM Final (Corrective Maintenance)', 'EQD'),
('603.3_EM Final (Preventive Maintenance)', 'EQD'),
('603.3_EM Initial (Preventive Maintenance)', 'EQD'),
('603.3_Fabrication', 'EQD'),
('603.3_Machine Data', 'EQD'),
('603.4_EM Final (Preventive Maintenance)', 'EQD'),
('603.4_EM Initial (Corrective Maintenance)', 'EQD'),
('603.4_EM Initial (Preventive Maintenance)', 'EQD'),
('603.4_Machine Data', 'EQD'),
('603.4_Spareparts', 'EQD'),
('603.5_EM Final (Corrective Maintenance)', 'EQD'),
('603.5_Fabrication', 'EQD'),
('603.6_Spareparts', 'EQD'),
('604.1_Facilities', 'EQD'),
('604.2_Facilities', 'EQD'),
('604.3_Facilities', 'EQD'),
('604.7_Facilities', 'EQD'),
('701.1_NF Kaizen', 'NF'),
('701.2_NF Kaizen', 'NF'),
('701.3_NF Kaizen', 'NF'),
('701.4_NF Kaizen', 'NF'),
('701.5_NF Kaizen', 'NF'),
('801.1_Production Design Center', 'PDC'),
('801.2_Production Design Center', 'PDC'),
('801.3_Production Design Center', 'PDC'),
('801.4_Production Design Center', 'PDC'),
('801.5_Production Design Center', 'PDC'),
('N/A - Aragon', 'Aragon'),
('N/A - HS', 'Housekeeping'),
('N/A - NF', 'NON-FALP');

-- --------------------------------------------------------

--
-- Table structure for table `m_department`
--

CREATE TABLE `m_department` (
  `deptCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptGroups` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptSubSection` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_department`
--

INSERT INTO `m_department` (`deptCode`, `deptName`, `deptGroups`, `deptSubSection`, `special`) VALUES
('ACC', 'Accounting Department', 'Accounting and Taxation', 'Accounting and Taxation', 'No'),
('Aragon', 'Aragon', 'N/A', 'N/A', 'Yes'),
('EQD', 'Equipment Department', 'Management, Equipment Management, Equipment Engineering', 'Facilities,Machine Data,EM Initial (Corrective Maintenance),Fabrication, EM Final (Corrective Maintenance),Spareparts,Machinery Center,EM Initial (Preventive Maintenance),EM Final (Preventive Maintenance),Calibration,ISO / Document Control,PCO,N/A', 'No'),
('Housekeeping', 'Housekeeping', 'Housekeeping', 'N/A', 'Yes'),
('HR', 'Human Resource Department', 'Recruitment and Training,Human Resource,General Affairs', 'General Affairs,Human Resource,Non-PD Technical Training,PD Technical Training', 'No'),
('IT', 'Information Technology Department', 'Information Technology,N/A', 'Information Technology', 'No'),
('MPD', 'Material Procurement Department', 'Material Management,Procurement', 'FG Preparation,Material Management,Material Procurement,MH (WHSE),MM Clerk,N/A', 'No'),
('NF', 'NF Kaizen Department', 'NF Kaizen', 'NF Kaizen', 'No'),
('NON-FALP', 'Non-Falp', 'Non-Falp', 'N/A', 'Yes'),
('PD1', 'Production 1', 'Battery Final,Battery Initial,Distributor,PD1 Clerk,PPET,Repair Person,SWAT Final,SWAT Initial,Tube Cutting,Tube Making,VS Laminating,PPET', 'N/A', 'No'),
('PD2', 'Production 2', 'D01L Final,D01L Initial,D54L Final,D54L Initial,Daihatsu Final,Daihatsu Initial,Nissan Final,Nissan Initial,PD2 Clerk,PPET', 'N/A', 'No'),
('PD3', 'Production 3', 'Mazda J12 Final,Mazda J12 Initial,Mazda Merge Final,Mazda Merge Initial,PD3 Clerk,PPET', 'N/A', 'No'),
('PD4', 'Production 4', 'PD4 Clerk,Suzuki Final,Suzuki Initial,Toyota Final,Toyota Initial,Y2R Final,Y2R Initial,PPET', 'N/A', 'No'),
('PD5', 'Production 5', 'Honda Final,Honda Initial,PD5 Clerk,Subaru Final,Subaru Initial,TKRA Final,TKRA Initial,PPET', 'N/A', 'No'),
('PDC', 'Production Design Center', 'Production Design Center', 'Production Design Center', 'No'),
('PE', 'Production Engineering Department', 'AME,MPPD,N/A,PEC and C', 'PE Clerk,PE Initial,PE Final ( AME ),PE Final ( MPPD )', 'No'),
('PMD', 'Production Management Department', 'Production Control,IMPEX', 'Production Control,IMPEX,PC Clerk', 'No'),
('QA', 'Quality Assurance Department', 'Quality Control,Quality Assurance,Quality Management', 'N/A,QA-FGI,QA-FGI Clerk,QA-Final(Mass Pro),QA-Initial(Mass Pro),QA-PPG,QA-PPG Clerk,QC-Dock Audit,QC Clerk,QC I-ALERT,QC-CSG,QC-Improvement,QM-CAG,QM-QMS,QM-QMS Clerk,QA Clerk', 'No'),
('Unknown', 'Unknown', 'Unknown', 'Unknown', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `m_employee`
--

CREATE TABLE `m_employee` (
  `idNumber` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateHired` date NOT NULL,
  `batchNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empNickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empContact` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empPosition` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empCostCenter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empAgency` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empDeptCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empDeptSection` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empSubSect` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lineNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empArea` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empRoute` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empShift` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empShiftTime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empHandler` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `jobType` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_employee`
--

INSERT INTO `m_employee` (`idNumber`, `empName`, `dateHired`, `batchNo`, `empNickname`, `empContact`, `empPosition`, `empCostCenter`, `empAgency`, `empDeptCode`, `empDeptSection`, `empSubSect`, `lineNo`, `empArea`, `empRoute`, `empShift`, `empShiftTime`, `empHandler`, `status`, `jobType`) VALUES
('Line-1', 'Line-1', '2021-01-14', '265', 'Line-1', '0912-456-2083', 'Associate', '602.1_Information Technology', 'FAS', 'QA', 'Quality Assurance', 'QA Clerk', '0', 'A', 'Rosario', 'DS', '8:00 - 5:00', 'Quality Assurance', 'Active', 'Permanent');

-- --------------------------------------------------------

--
-- Table structure for table `m_lineno`
--

CREATE TABLE `m_lineno` (
  `lineNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `carMaker` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `process` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_lineno`
--

INSERT INTO `m_lineno` (`lineNo`, `carMaker`, `process`, `category`) VALUES
('0', 'N/A', 'N/A', 'EQD'),
('1004', 'Mazda J12', 'Final', 'PD3'),
('1005', 'Mazda J12', 'Final', 'PD3'),
('1006', 'Mazda J12', 'Final', 'PD3'),
('1007', 'Mazda Merge', 'Final', 'PD3'),
('1008', 'Mazda Merge', 'Final', 'PD3'),
('1032', 'Mazda Merge', 'Final', 'PD3'),
('1033', 'Mazda J12', 'Final', 'PD3'),
('1034', 'Mazda J12', 'Final', 'PD3'),
('1101', 'Mazda J12', 'Final', 'PD3'),
('1102', 'Mazda J12', 'Final', 'PD3'),
('1103', 'Mazda J12', 'Final', 'PD3'),
('1109', 'Mazda Merge', 'Final', 'PD3'),
('1110', 'Mazda Merge', 'Final', 'PD3'),
('1111', 'Mazda Merge', 'Final', 'PD3'),
('1112', 'Mazda Merge', 'Final', 'PD3'),
('1113', 'Mazda Merge', 'Final', 'PD3'),
('1114', 'Mazda Merge', 'Final', 'PD3'),
('1115', 'Mazda Merge', 'Final', 'PD3'),
('1117', 'Mazda Merge', 'Final', 'PD3'),
('1118', 'Mazda Merge', 'Final', 'PD3'),
('1119', 'Mazda Merge', 'Final', 'PD3'),
('1120', 'Mazda Merge', 'Final', 'PD3'),
('1121', 'Mazda Merge', 'Final', 'PD3'),
('1122', 'Mazda Merge', 'Final', 'PD3'),
('1123', 'Mazda Merge', 'Final', 'PD3'),
('1124', 'Mazda Merge', 'Final', 'PD3'),
('1125', 'Mazda Merge', 'Final', 'PD3'),
('1126', 'Mazda Merge', 'Final', 'PD3'),
('1127', 'Mazda Merge', 'Final', 'PD3'),
('1128', 'Mazda J12', 'Final', 'PD3'),
('1129', 'Mazda Merge', 'Final', 'PD3'),
('1130', 'Mazda Merge', 'Final', 'PD3'),
('1131', 'Mazda Merge', 'Final', 'PD3'),
('2001', 'Daihatsu', 'Final', 'PD2'),
('2026', 'Daihatsu D01L', 'Final', 'PD2'),
('2102', 'Daihatsu', 'Final', 'PD2'),
('2103', 'Daihatsu', 'Final', 'PD2'),
('2104', 'Daihatsu', 'Final', 'PD2'),
('2105', 'Daihatsu', 'Final', 'PD2'),
('2106', 'Daihatsu', 'Final', 'PD2'),
('2107', 'Daihatsu', 'Final', 'PD2'),
('2108', 'Daihatsu D01L', 'Final', 'PD2'),
('2109', 'Daihatsu D01L', 'Final', 'PD2'),
('2111', 'Daihatsu D01L', 'Final', 'PD2'),
('2112', 'Daihatsu D01L', 'Final', 'PD2'),
('2113', 'Daihatsu D01L', 'Final', 'PD2'),
('2114', 'Daihatsu', 'Final', 'PD2'),
('2115', 'Daihatsu D01L', 'Final', 'PD2'),
('2116', 'Daihatsu D01L', 'Final', 'PD2'),
('2117', 'Daihatsu D01L', 'Final', 'PD2'),
('2118', 'Daihatsu D01L', 'Final', 'PD2'),
('2119', 'Daihatsu D01L', 'Final', 'PD2'),
('2120', 'Daihatsu D01L', 'Final', 'PD2'),
('2121', 'Daihatsu D01L', 'Final', 'PD2'),
('2122', 'Daihatsu D01L', 'Final', 'PD2'),
('2123', 'Daihatsu D01L', 'Final', 'PD2'),
('2124', 'Daihatsu D01L', 'Final', 'PD2'),
('2125', 'Daihatsu D01L', 'Final', 'PD2'),
('2127', 'Daihatsu D01L', 'Final', 'PD2'),
('3006', 'Honda', 'Final', 'PD5'),
('3017', 'Honda', 'Final', 'PD5'),
('3018', 'Honda TKRA', 'Final', 'PD5'),
('3020', 'Honda', 'Final', 'PD5'),
('3021', 'Honda', 'Final', 'PD5'),
('3031', 'Honda TKRA', 'Final', 'PD5'),
('3107', 'Honda', 'Final', 'PD5'),
('3108', 'Honda', 'Final', 'PD5'),
('3109', 'Honda', 'Final', 'PD5'),
('3114', 'Honda', 'Final', 'PD5'),
('3115', 'Honda', 'Final', 'PD5'),
('3116', 'Honda', 'Final', 'PD5'),
('3119', 'Honda', 'Final', 'PD5'),
('3122', 'Honda TKRA', 'Final', 'PD5'),
('3123', 'Honda TKRA', 'Final', 'PD5'),
('3124', 'Honda TKRA', 'Final', 'PD5'),
('3125', 'Honda TKRA', 'Final', 'PD5'),
('3126', 'Honda TKRA', 'Final', 'PD5'),
('3127', 'Honda TKRA', 'Final', 'PD5'),
('3128', 'Honda TKRA', 'Final', 'PD5'),
('3129', 'Honda TKRA', 'Final', 'PD5'),
('3130', 'Honda TKRA', 'Final', 'PD5'),
('3132', 'Honda TKRA', 'Final', 'PD5'),
('3M0A', 'Honda', 'Initial', 'PD5'),
('4004', 'Toyota', 'Final', 'PD5'),
('4101', 'Toyota', 'Final', 'PD5'),
('4102', 'Toyota', 'Final', 'PD5'),
('4103', 'Toyota', 'Final', 'PD5'),
('4105', 'Toyota', 'Final', 'PD5'),
('4106', 'Toyota', 'Final', 'PD5'),
('4107', 'Toyota', 'Final', 'PD5'),
('4108', 'Toyota', 'Final', 'PD5'),
('5006', 'Suzuki', 'Final', 'PD4'),
('5009', 'Suzuki', 'Final', 'PD4'),
('5015', 'Suzuki', 'Final', 'PD4'),
('5018', 'Suzuki', 'Final', 'PD4'),
('5022', 'Suzuki', 'Final', 'PD4'),
('5029', 'Suzuki', 'Final', 'PD4'),
('5031', 'Suzuki', 'Final', 'PD4'),
('5101', 'Suzuki', 'Final', 'PD4'),
('5102', 'Suzuki', 'Final', 'PD4'),
('5103', 'Suzuki', 'Final', 'PD4'),
('5104', 'Suzuki', 'Final', 'PD4'),
('5105', 'Suzuki', 'Final', 'PD4'),
('5107', 'Suzuki', 'Final', 'PD4'),
('5108', 'Suzuki', 'Final', 'PD4'),
('5110', 'Suzuki', 'Final', 'PD4'),
('5111', 'Suzuki', 'Final', 'PD4'),
('5112', 'Suzuki', 'Final', 'PD4'),
('5113', 'Suzuki', 'Final', 'PD4'),
('5114', 'Suzuki', 'Final', 'PD4'),
('5116', 'Suzuki', 'Final', 'PD4'),
('5117', 'Suzuki', 'Final', 'PD4'),
('5119', 'Suzuki', 'Final', 'PD4'),
('5120', 'Suzuki', 'Final', 'PD4'),
('5121', 'Suzuki', 'Final', 'PD4'),
('5123', 'Suzuki', 'Final', 'PD4'),
('5124', 'Suzuki', 'Final', 'PD4'),
('5125', 'Suzuki', 'Final', 'PD4'),
('5126', 'Suzuki', 'Final', 'PD4'),
('5127', 'Suzuki', 'Final', 'PD4'),
('5128', 'Suzuki', 'Final', 'PD4'),
('5130', 'Suzuki', 'Final', 'PD4'),
('5132', 'Suzuki', 'Final', 'PD4'),
('5133', 'Suzuki', 'Final', 'PD4'),
('5134', 'Suzuki', 'Final', 'PD4'),
('5135', 'Suzuki', 'Final', 'PD4'),
('5136', 'Suzuki', 'Final', 'PD4'),
('5137', 'Suzuki', 'Final', 'PD4'),
('6101', 'Nissan', 'Final', 'PD2'),
('6102', 'Nissan', 'Final', 'PD2'),
('7015', 'Subaru', 'Final', 'PD5'),
('7017', 'Subaru', 'Final', 'PD5'),
('7101', 'Subaru', 'Final', 'PD5'),
('7102', 'Subaru', 'Final', 'PD5'),
('7103', 'Subaru', 'Final', 'PD5'),
('7104', 'Subaru', 'Final', 'PD5'),
('7105', 'Subaru', 'Final', 'PD5'),
('7106', 'Subaru', 'Final', 'PD5'),
('7107', 'Subaru', 'Final', 'PD5'),
('7108', 'Subaru', 'Final', 'PD5'),
('7109', 'Subaru', 'Final', 'PD5'),
('7110', 'Subaru', 'Final', 'PD5'),
('7111', 'Subaru', 'Final', 'PD5'),
('7112', 'Subaru', 'Final', 'PD5'),
('7113', 'Subaru', 'Final', 'PD5'),
('7114', 'Subaru', 'Final', 'PD5'),
('7115', 'Subaru', 'Final', 'PD5'),
('7116', 'Subaru', 'Final', 'PD5'),
('Battery Final', 'Battery Final', 'Final', 'PD1'),
('Battery Initial', 'Battery Initial', 'Initial', 'PD1'),
('Daihatsu First Process', 'Daihatsu', 'Initial', 'PD2'),
('Daihatsu Second Process', 'Daihatsu', 'Initial', 'PD2'),
('EM Final (Corrective Maintenance)', 'N/A', 'Final', 'EQD'),
('EM Final (Preventive Maintenance)', 'N/A', 'Final', 'EQD'),
('EM Initial (Corrective Maintenance)', 'N/A', 'Initial', 'EQD'),
('EM Initial (Preventive Maintenance)', 'N/A', 'Initial', 'EQD'),
('Fabrication', 'N/A', 'N/A', 'EQD'),
('Facilities', 'N/A', 'N/A', 'EQD'),
('Machine Data', 'N/A', 'N/A', 'EQD'),
('Machinery Center', 'N/A', 'N/A', 'EQD'),
('MH', '', '', 'PD1'),
('PPET Final', '', 'Final', 'PD1'),
('PPET Initial', '', 'Initial', 'PD1'),
('Practice Training', 'Practice Training Center', 'Final', 'PD5'),
('QA Battery/Honda T20 Initial', 'Honda', 'Initial', 'QA'),
('QA D01L Final', 'Daihatsu D01L', 'Final', 'QA'),
('QA D01L Initial', 'Daihatsu D01L', 'Initial', 'QA'),
('QA Daihatsu Final', 'Daihatsu', 'Final', 'QA'),
('QA Daihatsu Initial', 'Daihatsu', 'Initial', 'QA'),
('QA FGI', 'QA FGI', 'Initial', 'QA'),
('QA Honda Final', 'Honda', 'Final', 'QA'),
('QA Honda Initial', 'Honda', 'Initial', 'QA'),
('QA Honda T20 Final', 'Honda', 'Final', 'QA'),
('QA Honda T20 Initial', 'Honda', 'Initial', 'QA'),
('QA J12 Initial', 'Mazda J12', 'Initial', 'QA'),
('QA Mass Pro', 'QA Mass Pro', 'Initial', 'QA'),
('QA Mazda Final', 'Mazda', 'Final', 'QA'),
('QA Merge Initial', 'Mazda Merge', 'Initial', 'QA'),
('QA Partial', 'Honda', 'Final', 'QA'),
('QA PPG', 'QA PPG', 'Initial', 'QA'),
('QA Subaru Final', 'Subaru', 'Final', 'QA'),
('QA Subaru Initial', 'Subaru', 'Initial', 'QA'),
('QA Suzuki Y2R Initial', 'Suzuki Y2R', 'Initial', 'QA'),
('QA Suzuki YD1/ Toyota Final', 'Suzuki', 'Final', 'QA'),
('QA Suzuki YD1/YKC  Final', 'Suzuki', 'Final', 'QA'),
('QA Suzuki YKC Final', 'Suzuki', 'Final', 'QA'),
('QA Suzuki YV7/ Y2R Final', 'Suzuki', 'Final', 'QA'),
('QA SWAT Final', 'SWAT', 'Final', 'QA'),
('QA SWAT Initial', 'SWAT', 'Initial', 'QA'),
('QA Toyota Initial', 'Toyota', 'Initial', 'QA'),
('SWAT Final', '', 'Final', 'PD1'),
('SWAT Initial', '', 'Initial', 'PD1'),
('T20A', 'Honda', 'Initial', 'PD5'),
('Tube Cutting', 'Tube Cutting', 'Initial', 'PD1'),
('Tube Making', 'Tube Making', 'Initial', 'PD1'),
('Y2R First Process', 'Suzuki', 'Initial', 'PD4'),
('Y2R Second Process', 'Suzuki', 'Initial', 'PD4'),
('Y3J Airbag', 'Suzuki', 'Final', 'PD4'),
('Y3J First Process', 'Suzuki', 'Initial', 'PD4'),
('Y3J Second Process', 'Suzuki', 'Initial', 'PD4'),
('YD1 Airbag', 'Suzuki YD1 Airbag', 'Initial', 'PD4'),
('YD1 First Process', 'Suzuki', 'Initial', 'PD4'),
('YD1 Second Process', 'Suzuki', 'Initial', 'PD4'),
('YV7 First Process', 'Suzuki', 'Initial', 'PD4'),
('YV7 Second Process', 'Suzuki', 'Initial', 'PD4');

-- --------------------------------------------------------

--
-- Table structure for table `m_outgoing`
--

CREATE TABLE `m_outgoing` (
  `outGoing` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_outgoing`
--

INSERT INTO `m_outgoing` (`outGoing`) VALUES
('05:00'),
('06:00'),
('07:00'),
('08:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_overtime`
--

CREATE TABLE `m_overtime` (
  `listId` int NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_overtime`
--

INSERT INTO `m_overtime` (`listId`, `time`) VALUES
(1, '16:00:00'),
(2, '16:15:00'),
(3, '16:30:00'),
(4, '17:00:00'),
(5, '19:00:00'),
(6, '19:15:00'),
(7, '19:30:00'),
(8, '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_position`
--

CREATE TABLE `m_position` (
  `position` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_position`
--

INSERT INTO `m_position` (`position`, `special`) VALUES
('Assistant Manager', 'N'),
('Associate', 'O'),
('Coordinator', 'Y'),
('Department Manager', 'N'),
('Division Manager', 'N'),
('HK Reliever', 'Y'),
('Housekeeping', 'Y'),
('Junior Staff', 'N'),
('Section Manager', 'N'),
('SPE', 'Y'),
('Staff', 'N'),
('Supervisor', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `m_route`
--

CREATE TABLE `m_route` (
  `route` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shuttle` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pickup` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `listOrder` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_route`
--

INSERT INTO `m_route` (`route`, `shuttle`, `pickup`, `listOrder`) VALUES
('Batangas', 'FS. Felicia', 'Galaxy/Diversion', 1),
('Ibaan', 'TMO', 'Near Jollibee Ibaan', 3),
('Lipa Malapit', 'FS. Felicia', '', 7),
('Lipa Malayo', 'FS. Felicia', 'San Jose', 6),
('N/A', '', '', 14),
('Padre Garcia', 'TMO', '', 5),
('Rosario', 'TMO', '', 4),
('San Jose', 'FS. Felicia', 'San Jose', 2),
('San Lucas', 'FS. Felicia', '', 8),
('San Pablo via Lipa', 'FS. Felicia', '', 11),
('San Pablo via Tomas', 'FS. Felicia', '', 12),
('Sta. Teresita', 'FS. Felicia', '', 13),
('Sto. Tomas Malapit', 'JRG', '', 9),
('Sto. Tomas Malayo', 'JRG', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `m_sched`
--

CREATE TABLE `m_sched` (
  `schedTime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_sched`
--

INSERT INTO `m_sched` (`schedTime`) VALUES
('8:00 - 5:00'),
('8:00 - 5:50');

-- --------------------------------------------------------

--
-- Table structure for table `t_absent`
--

CREATE TABLE `t_absent` (
  `listId` int NOT NULL,
  `dateAbsent` date NOT NULL,
  `idNumber` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptGrp` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lineNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dtFiled` datetime NOT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_absent`
--

INSERT INTO `t_absent` (`listId`, `dateAbsent`, `idNumber`, `empName`, `deptCode`, `deptGrp`, `lineNo`, `dtFiled`, `category`, `filedBy`) VALUES
(32, '2020-11-28', '13-0446', 'Ibana, Gemlet D.', 'IT', 'Information Technology', '', '2020-11-28 14:31:37', 'A', 'Magpantay, Regine C.'),
(33, '2020-11-28', '19-05078', 'Tenorio, Mark John H.', 'IT', 'Information Technology', '', '2020-11-28 14:31:38', 'NW', 'Magpantay, Regine C.'),
(34, '2020-12-01', '13-0378', 'Falsado, Julie R.', 'PE', 'PEC and C', '', '2020-12-01 08:40:31', 'A', 'Gonzales, Rechelle P.'),
(35, '2020-12-01', '20-05657', 'Adame, Pearl Christine L.', 'PE', 'PEC and C', '', '2020-12-01 08:40:31', 'A', 'Gonzales, Rechelle P.'),
(36, '2020-12-01', '12-0110', 'Aquino, Chanel G.', 'HR', 'Human Resource and GA', '', '2020-12-01 11:33:36', 'A', 'Salud, Raquel B.'),
(37, '2020-12-01', '15-03023', 'San Diego, Mary Jane F.', 'HR', 'Human Resource and GA', '', '2020-12-01 11:33:36', 'A', 'Salud, Raquel B.'),
(49, '2020-12-01', '13-00931', 'Matanguihan, Bryan Kenneth R.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:04', 'A', 'Calisin, Camille M.'),
(50, '2020-12-01', '13-0673', 'Caguitla, Emmanuel V.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:04', 'A', 'Calisin, Camille M.'),
(51, '2020-12-01', '14-01958', 'Magtibay, John Carlo F.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:04', 'A', 'Calisin, Camille M.'),
(52, '2020-12-01', '17-03231', 'Dipasupil, Marites C.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:05', 'A', 'Calisin, Camille M.'),
(53, '2020-12-01', '17-03233', 'Fernandez, Rhuvy Ann R.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:05', 'A', 'Calisin, Camille M.'),
(54, '2020-12-01', '19-04659', 'Balhag, Mel Laurence J.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:05', 'RD', 'Calisin, Camille M.'),
(55, '2020-12-01', '19_PK30520', 'Agno, Randolf A.', 'EQD', 'Equipment Engineering', '', '2020-12-01 13:07:05', 'A', 'Calisin, Camille M.'),
(56, '2020-12-01', '19_PK36024', 'Boo, Jherico M.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:05', 'RD', 'Calisin, Camille M.'),
(57, '2020-12-01', '20-05594', 'Geron, Robert Julius B.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:05', 'RD', 'Calisin, Camille M.'),
(58, '2020-12-01', '20_PK39920', 'Lasala, Dranreb  D.', 'EQD', 'Equipment Management', '', '2020-12-01 13:07:06', 'RD', 'Calisin, Camille M.'),
(68, '2020-12-01', '13-0284', 'Delgado, Hadji J.', 'NF', 'NF Kaizen', '', '2020-12-01 13:43:54', 'A', 'Carreon, Joanna Marie L.'),
(69, '2020-12-01', '13-0389', 'Mantuano, Maricar R.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:39', 'A', 'Delos Reyes, Rowena T.'),
(70, '2020-12-01', '13-0563', 'Julongbayan, Cherryza B.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:40', 'A', 'Delos Reyes, Rowena T.'),
(71, '2020-12-01', '14-01128', 'Caringal, Carissa D.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:40', 'A', 'Delos Reyes, Rowena T.'),
(72, '2020-12-01', '14-01540', 'Aquino, Charis V.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:40', 'A', 'Delos Reyes, Rowena T.'),
(73, '2020-12-01', '14-01679', 'Semira, Ma. Veronica V.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:40', 'A', 'Delos Reyes, Rowena T.'),
(74, '2020-12-01', '16-03113', 'Amaba, May M.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:40', 'A', 'Delos Reyes, Rowena T.'),
(75, '2020-12-01', '17-03285', 'Geron, Anna Claudette C.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:40', 'A', 'Delos Reyes, Rowena T.'),
(76, '2020-12-01', '19-05126', 'Alday, Lady April R.', 'PDC', 'Production Design Center', '', '2020-12-01 14:29:40', 'A', 'Delos Reyes, Rowena T.'),
(363, '2020-12-10', '12_2004573', 'De Castro, Kevin Paul A.', 'PMD', 'IMPEX', '0', '2020-12-10 13:07:07', 'A', '15-03025'),
(364, '2020-12-10', '19-05130', 'Magnaye, Princess Lyka D.', 'PMD', 'IMPEX', '0', '2020-12-10 13:07:07', 'A', '15-03025'),
(464, '2020-12-11', '19-04449', 'Banog, Myca P.', 'QA', 'Quality Assurance', 'QA FGI', '2020-12-11 23:11:25', 'A', '19_PK33563'),
(755, '2020-12-17', '12-0061', 'Valencia, Rhena T.', 'HR', 'Human Resource', '0', '2020-12-17 12:52:34', 'A', '18-03707'),
(756, '2020-12-17', '12-0110', 'Aquino, Chanel G.', 'HR', 'Human Resource', '0', '2020-12-17 12:52:34', 'A', '18-03707'),
(757, '2020-12-17', '15-03023', 'San Diego, Mary Jane F.', 'HR', 'Human Resource', '0', '2020-12-17 12:52:34', 'A', '18-03707'),
(758, '2020-12-17', '18-03707', 'Salud, Raquel B.', 'HR', 'Human Resource', '0', '2020-12-17 12:52:34', 'A', '18-03707'),
(991, '2020-12-19', '13-0446', 'Ibana, Gemlet D.', 'IT', 'Information Technology', '0', '2020-12-19 13:11:56', 'A', '15-02804'),
(992, '2020-12-19', '19_PK30518', 'Geron, Lorhen Joshua L.', 'IT', 'Information Technology', '0', '2020-12-19 13:11:56', 'A', '15-02804'),
(993, '2020-12-19', '19_PK36990', 'Maranan, Jundhel M.', 'IT', 'Information Technology', '0', '2020-12-19 13:11:56', 'A', '15-02804'),
(1033, '2020-12-19', '19_PK35781', 'Estacaan, Steven Isiah A.', 'PE', 'AME', '0', '2020-12-19 14:28:28', 'A', '14-01822'),
(1034, '2020-12-19', '20-05634', 'Teodoro, Gerald Joem M.', 'PE', 'AME', '0', '2020-12-19 14:28:29', 'A', '14-01822'),
(1035, '2020-12-19', '20-05646', 'Lopez, Elizabeth N.', 'PE', 'AME', '0', '2020-12-19 14:28:29', 'A', '14-01822'),
(1202, '2020-12-21', '13-0216', 'Galang, Evelyn', 'PD3', 'Mazda Merge Final', '0', '2020-12-21 14:12:14', 'A', '13-00888'),
(1203, '2020-12-21', '18-04203', 'Kalaw, Xena Cassandra', 'PD3', 'Mazda Merge Final', '0', '2020-12-21 14:12:14', 'A', '13-00888'),
(1204, '2020-12-21', 'EN693610', 'Rocamora, Lealyn', 'PD3', 'N/A', '0', '2020-12-21 14:12:14', 'A', '13-00888'),
(1242, '2020-12-22', '19_PK36841', 'Dimaculangan, Imee', 'PD3', 'N/A', '0', '2020-12-22 02:22:43', 'A', 'BF-12437'),
(1243, '2020-12-22', '19-05333', 'Villa, Ma. Fe Elizabeth A.', 'PD3', 'PD3 Clerk', '0', '2020-12-22 02:22:43', 'A', 'BF-12437'),
(1360, '2020-12-23', '18_PK26899', 'Revilla, Jeffrey A.', 'EQD', ' Equipment Management', 'EM Initial (Corrective Maintenance)', '2020-12-23 00:40:03', 'A', 'EQD-NS-INITIALBM'),
(1361, '2020-12-23', '19_PK29523', 'Delen, Waren C.', 'EQD', ' Equipment Management', 'EM Initial (Corrective Maintenance)', '2020-12-23 00:40:03', 'A', 'EQD-NS-INITIALBM'),
(1362, '2020-12-23', '19-04659', 'Balhag, Mel Laurence J.', 'EQD', ' Equipment Management', 'EM Initial (Corrective Maintenance)', '2020-12-23 00:40:03', 'RD', 'EQD-NS-INITIALBM'),
(1363, '2020-12-23', '19-05060', 'Ramirez, Benson A.', 'EQD', ' Equipment Management', 'EM Initial (Corrective Maintenance)', '2020-12-23 00:40:03', 'RD', 'EQD-NS-INITIALBM'),
(1364, '2020-12-23', '20_PK39723', 'Latina, Edcel G.', 'EQD', ' Equipment Management', 'EM Initial (Corrective Maintenance)', '2020-12-23 00:40:03', 'RD', 'EQD-NS-INITIALBM'),
(1365, '2020-12-23', '20-05686', 'De lo Santos, Bernardo Jr.', 'EQD', ' Equipment Management', 'EM Final (Corrective Maintenance)', '2020-12-23 00:41:39', 'A', 'EQD-NS-FINALBM'),
(1366, '2020-12-23', 'BF-19331', 'Levita, Karl Jade Maranan', 'EQD', ' Equipment Management', 'EM Final (Corrective Maintenance)', '2020-12-23 00:41:39', 'A', 'EQD-NS-FINALBM'),
(1367, '2020-12-23', '19-04924', 'Ilocso, Gary A.', 'EQD', ' Equipment Management', 'Facilities', '2020-12-23 00:42:44', 'RD', 'EQD-NS-Facilities'),
(1817, '2021-01-07', '19-05380', 'Manguito, Jenelyn M.', 'PMD', 'Production Control', '0', '2021-01-07 12:28:36', 'A', 'PC-N'),
(1960, '2021-01-08', '17-03197', 'Falcunaya, Patty May F.', 'MPD', 'Material Management', '0', '2021-01-08 11:01:03', 'A', '19_PK32787'),
(1961, '2021-01-08', '18-04211', 'Vergara, Jean Mary R.', 'MPD', 'Material Management', '0', '2021-01-08 11:01:03', 'A', '19_PK32787'),
(1962, '2021-01-08', '20_PK42228', 'Pasajol, Princess Anthoinette ', 'MPD', 'Material Management', '0', '2021-01-08 11:01:03', 'A', '19_PK32787'),
(1963, '2021-01-08', 'BF-16842', 'Lacerna,Rhea Pasahol', 'MPD', 'Material Management', '0', '2021-01-08 11:01:03', 'A', '19_PK32787'),
(1980, '2021-01-08', '13-0454', 'Maquinto, Rhea M.', 'QA', 'Quality Assurance', 'QA Suzuki YD1/ Toyota Final', '2021-01-08 12:23:54', 'A', '14-01013'),
(1981, '2021-01-08', '20_PK41401', 'Mangubat, Via R.', 'QA', 'Quality Assurance', 'QA Suzuki YD1/ Toyota Final', '2021-01-08 12:23:55', 'A', '14-01013'),
(1982, '2021-01-08', 'BF-11146', 'Palima, Manilyn D', 'QA', 'Quality Assurance', 'QA Suzuki YD1/ Toyota Final', '2021-01-08 12:23:55', 'A', '14-01013'),
(1983, '2021-01-08', 'BF-37905', 'Aguilar, Marissa', 'QA', 'Quality Assurance', 'QA Suzuki YD1/ Toyota Final', '2021-01-08 12:23:55', 'A', '14-01013'),
(2003, '2021-01-08', '15-02876', 'Angulo, Jesmar T.', 'QA', 'Quality Assurance', 'QA PPG', '2021-01-08 13:31:33', 'A', '20-05491'),
(2004, '2021-01-08', '18-03973', 'Macaranas, Danica A.', 'QA', 'Quality Assurance', 'QA PPG', '2021-01-08 13:31:34', 'A', '20-05491'),
(2005, '2021-01-08', '19-05123', 'Mistas, Julius D.', 'QA', 'Quality Assurance', 'QA PPG', '2021-01-08 13:31:34', 'A', '20-05491'),
(2006, '2021-01-08', 'EN69-2660', 'Layson, Rubilyn P.', 'QA', 'Quality Assurance', 'QA PPG', '2021-01-08 13:31:34', 'A', '20-05491'),
(2060, '2021-01-08', '20_PK38010', 'Gayto, Rubiegin F.', 'QA', 'Quality Assurance', 'QA Daihatsu Initial', '2021-01-08 20:59:36', 'A', '14-01083'),
(2087, '2021-01-09', '14-01230', 'Obille, Jenifer D.', 'QA', 'Quality Assurance', 'QA Subaru Final', '2021-01-09 00:30:16', 'A', '14-02243'),
(2088, '2021-01-09', 'AEFL20011', 'Cornejo, Analyn L.', 'QA', 'Quality Assurance', 'QA Subaru Final', '2021-01-09 00:30:16', 'A', '14-02243'),
(2089, '2021-01-09', 'MWM00011145', 'Baradas, Jinelyn', 'QA', 'Quality Assurance', 'QA Subaru Final', '2021-01-09 00:30:16', 'A', '14-02243'),
(2098, '2021-01-09', '13-0706', 'Eadan, Jenny Rose V.', 'QA', 'Quality Assurance', '0', '2021-01-09 02:15:21', 'A', '20_PK45324'),
(2099, '2021-01-09', '17-03417', 'Gasco, Grezelda M.', 'QA', 'Quality Assurance', '0', '2021-01-09 02:15:21', 'A', '20_PK45324'),
(2100, '2021-01-09', '19_PK33605', 'Ragas, Jaquelyn P.', 'QA', 'Quality Assurance', '0', '2021-01-09 02:15:21', 'A', '20_PK45324'),
(2101, '2021-01-09', '20_PK41487', 'Potane, Maridette D.', 'QA', 'Quality Assurance', '0', '2021-01-09 02:15:22', 'A', '20_PK45324'),
(2102, '2021-01-09', 'EN69-2772', 'Dela Cueva, Haidee A.', 'QA', 'Quality Assurance', '0', '2021-01-09 02:15:22', 'A', '20_PK45324'),
(2121, '2021-01-09', '17-03231', 'Dipasupil, Marites C.', 'EQD', ' Equipment Management', 'EM Initial (Corrective Maintenance)', '2021-01-09 10:56:47', 'A', 'EQD-DS-INITIALBM'),
(2124, '2021-01-09', '20_PK40659', 'Mendoza, Angelica P.', 'QA', 'Quality Assurance', 'QA D01L Final', '2021-01-09 11:24:50', 'NW', '17-03293'),
(2125, '2021-01-09', '20_PK39633', 'Bigueras, Jeff L.', 'EQD', ' Equipment Management', 'EM Initial (Preventive Maintenance)', '2021-01-09 11:27:59', 'A', 'EQD-DS-INITIALPM'),
(2126, '2021-01-09', '13-00917', 'Razon, Jessa S.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:53', 'A', '14-01825'),
(2127, '2021-01-09', '14-02286', 'Francisco, Manilyn P.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:53', 'A', '14-01825'),
(2128, '2021-01-09', '18_PK28097', 'Punzalan, Jharimae Regine R.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:53', 'NW', '14-01825'),
(2129, '2021-01-09', '19-04462', 'Alig, Raquel', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:53', 'NW', '14-01825'),
(2130, '2021-01-09', '20_PK42861', 'Uri, Joan Marie R.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:53', 'NW', '14-01825'),
(2131, '2021-01-09', '20_PK42899', 'Tapay, Karen U.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:53', 'NW', '14-01825'),
(2132, '2021-01-09', '20_PK43660', 'Malabuyoc, Aubrey Airra F.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:54', 'A', '14-01825'),
(2133, '2021-01-09', 'AEFL20354', 'Unico, Reaelyn A.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:54', 'A', '14-01825'),
(2134, '2021-01-09', 'BF-37763', 'Seva, Pamela Jane Q.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:54', 'NW', '14-01825'),
(2135, '2021-01-09', 'BF-37898', 'Dayrit, Judith D.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:54', 'NW', '14-01825'),
(2136, '2021-01-09', 'BF-39119', 'Bisco, Irish Linatoc', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:54', 'A', '14-01825'),
(2137, '2021-01-09', 'EN69-3306', 'Dapdap, Jamaica Elaine A.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-09 11:34:54', 'NW', '14-01825'),
(2158, '2021-01-09', '15_PK02543', 'Reyes, Glydel D.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-09 12:03:47', 'A', '15-02683'),
(2159, '2021-01-09', '20_PK42047', 'Braga, Kimberly S.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-09 12:03:47', 'A', '15-02683'),
(2160, '2021-01-09', '20_PK44257', 'Reyes, Kaycee R.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-09 12:03:47', 'A', '15-02683'),
(2161, '2021-01-09', 'BF-37633', 'Olan, Vanessa Manalon', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-09 12:03:48', 'A', '15-02683'),
(2162, '2021-01-09', 'EN69-1267', 'Sabile, Danalyn R.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-09 12:03:48', 'A', '15-02683'),
(2163, '2021-01-09', 'MWM00008989', 'Mendoza, Airene B.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-09 12:03:48', 'A', '15-02683'),
(2164, '2021-01-09', '13-0559', 'Aldover, Sheela Mae Bernadette G.', 'HR', 'General Affairs', '0', '2021-01-09 13:06:00', 'NW', '18-03536'),
(2165, '2021-01-09', '20-05730', 'Lalusin, Rheamae M.', 'HR', 'General Affairs', '0', '2021-01-09 13:06:00', 'NW', '18-03536'),
(2166, '2021-01-09', '14-01735', 'Binasbas, Richelle S.', 'QA', 'Quality Assurance', 'QA J12 Initial', '2021-01-09 13:08:12', 'A', '17-03145'),
(2167, '2021-01-09', 'BF-37590', 'Linatoc, Judy Ann De Villa', 'QA', 'Quality Assurance', 'QA J12 Initial', '2021-01-09 13:08:12', 'A', '17-03145'),
(2177, '2021-01-09', '18-03826', 'Lambus, Divina M.', 'QA', 'Quality Assurance', 'QA SWAT Initial', '2021-01-09 13:10:26', 'A', '15-02679'),
(2187, '2021-01-09', '14-02427', 'Cuenca, Chrislobelyn T.', 'QA', 'Quality Assurance', 'QA SWAT Final', '2021-01-09 13:23:15', 'A', '14-01311'),
(2188, '2021-01-09', '17-03289', 'Matricular, Zyra M.', 'QA', 'Quality Assurance', 'QA SWAT Final', '2021-01-09 13:23:15', 'A', '14-01311'),
(2189, '2021-01-09', '19-04744', 'Hernandez, Shiela O.', 'QA', 'Quality Assurance', 'QA SWAT Final', '2021-01-09 13:23:15', 'A', '14-01311'),
(2190, '2021-01-09', '20_PK41478', 'Mojares, Joy M.', 'QA', 'Quality Assurance', 'QA Daihatsu Initial', '2021-01-09 13:47:18', 'A', '15-02661'),
(2191, '2021-01-09', '20-05552', 'Solis, Maybhel N.', 'QA', 'Quality Assurance', 'QA Battery / Cross Section Initial', '2021-01-09 13:49:50', 'A', '14-02028'),
(2192, '2021-01-09', '13-0737', 'Lopez, Jona L.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:07', 'A', '14-01130'),
(2193, '2021-01-09', '15-02649', 'Polonan, Ana Rose F.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:07', 'A', '14-01130'),
(2194, '2021-01-09', '19_PK29192', 'Soria, Jenette C.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:07', 'A', '14-01130'),
(2195, '2021-01-09', '19_PK29569', 'Bermil, Mary Grace S.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:07', 'A', '14-01130'),
(2196, '2021-01-09', '20_PK42239', 'Corporal, Jean Dell C.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:07', 'A', '14-01130'),
(2197, '2021-01-09', '20_PK42869', 'Cay, Neriza M.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:07', 'A', '14-01130'),
(2198, '2021-01-09', '20_PK44258', 'Soriba, Judy Ann S.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:08', 'A', '14-01130'),
(2199, '2021-01-09', '20_PK45465', 'Ebora, Frances Diane R.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:08', 'A', '14-01130'),
(2200, '2021-01-09', '20_PK45546', 'Rosal, Merian R.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:08', 'A', '14-01130'),
(2201, '2021-01-09', '20_PK45549', 'Alib, Laarnie', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:08', 'A', '14-01130'),
(2202, '2021-01-09', 'AEFL20401', 'Pelaez, Leana C.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:08', 'A', '14-01130'),
(2203, '2021-01-09', 'EN69-1200', 'Ramos, Jerelyn S.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:08', 'A', '14-01130'),
(2204, '2021-01-09', 'EN69-3426', 'Manalo, Jenette C.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:09', 'A', '14-01130'),
(2205, '2021-01-09', 'EN69-3598', 'Ritual, Diane A.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:09', 'A', '14-01130'),
(2206, '2021-01-09', 'EN69-3703', 'Mendoza, Juris Dianne P.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 13:56:09', 'A', '14-01130'),
(2233, '2021-01-09', '15-02885', 'Forbes, Jessica Karen M.', 'MPD', 'Procurement', '0', '2021-01-09 14:32:40', 'RD', 'BF-15429'),
(2234, '2021-01-09', 'BF-15422', 'Dimaculangan, Angelica ', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-09 20:20:19', 'A', '13-0781'),
(2235, '2021-01-09', 'BF-17488', 'Lopez, Angelica Rafa', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-09 20:20:19', 'A', '13-0781'),
(2236, '2021-01-09', 'BF-37513', 'Fortunado, Jenielyn Villostas', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-09 20:20:19', 'A', '13-0781'),
(2237, '2021-01-09', 'EN69-3563', 'Culla, Justine S.', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-09 20:20:19', 'A', '13-0781'),
(2238, '2021-01-09', '13-0639', 'Alcaraz, Jobelle P.', 'QA', 'Quality Assurance', 'QA J12 Initial', '2021-01-09 20:21:58', 'A', '13-0639'),
(2239, '2021-01-09', 'MWM00010659', 'Villanoza, Patricia Ladylaine F.', 'QA', 'Quality Assurance', 'QA J12 Initial', '2021-01-09 20:21:59', 'A', '13-0639'),
(2240, '2021-01-09', '20_PK44050', 'Sulit, Annie Lieza V.', 'QA', 'Quality Assurance', 'QA Suzuki Y2R Initial', '2021-01-09 20:23:32', 'A', '14-02220'),
(2241, '2021-01-09', '15-02770', 'Suela, Jennylyn B.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:33', 'A', '13-0566'),
(2242, '2021-01-09', '17_PK11244', 'Oarga, Kimberly Gil M.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:33', 'A', '13-0566'),
(2243, '2021-01-09', '20_PK40712', 'Rosales, Lovely A.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:33', 'A', '13-0566'),
(2244, '2021-01-09', '20_PK43471', 'Balmes, Analyn M.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:33', 'A', '13-0566'),
(2245, '2021-01-09', 'AEFL20295', 'Care, Cristine Rose S.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:33', 'A', '13-0566'),
(2246, '2021-01-09', 'AEFL20409', 'Magnaye, Jacquiline B.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:33', 'A', '13-0566'),
(2247, '2021-01-09', 'BF-17155', 'Aguilo, Bernadette Famadico', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:34', 'A', '13-0566'),
(2248, '2021-01-09', 'BF-17201', 'Abiad, Maria Daicy Dacillo', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:34', 'A', '13-0566'),
(2249, '2021-01-09', 'EN69-2725', 'Cabrera, Cristine Joy T.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:34', 'A', '13-0566'),
(2250, '2021-01-09', 'EN69-3311', 'Driz, Celine L.', 'QA', 'Quality Assurance', 'QA Suzuki / Toyota Initial', '2021-01-09 20:45:34', 'A', '13-0566'),
(2251, '2021-01-09', '13-0793', 'Resano, Mary Jane M.', 'QA', 'Quality Assurance', 'QA D01L Final', '2021-01-09 21:52:38', 'A', '13-0641'),
(2252, '2021-01-09', 'BF-37697', 'Espiritu, Judy Ann Lumbera', 'QA', 'Quality Assurance', 'QA D01L Final', '2021-01-09 21:52:38', 'A', '13-0641'),
(2253, '2021-01-09', '14-02295', 'Regala, Charo Mare M.', 'QA', 'Quality Assurance', 'QA SWAT Initial', '2021-01-09 23:52:10', 'A', '14-02429'),
(2254, '2021-01-09', '14-02340', 'Alday, Jenie B.', 'QA', 'Quality Assurance', 'QA SWAT Initial', '2021-01-09 23:52:10', 'A', '14-02429'),
(2255, '2021-01-10', '13-0459', 'Vasquez, Cicel M.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2256, '2021-01-10', '13-0769', 'Coronel, Kristine Joy M.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2257, '2021-01-10', '14-01947', 'Landicho, Gillian W.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2258, '2021-01-10', '15-02571', 'Rivera, Kimberly J.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2259, '2021-01-10', '19_PK30370', 'Cuerdo, Demi Margarette D.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2260, '2021-01-10', '20_PK42489', 'Macatangay, Mary Joy L.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2261, '2021-01-10', 'AEFL20410', 'Malveda, Melba C.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2262, '2021-01-10', 'BF-12958', 'Belen, Kimberlyn Endaya', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:41', 'A', '15-02864'),
(2263, '2021-01-10', 'BF-12975', 'Recto, Jovelyn Gado', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:42', 'A', '15-02864'),
(2264, '2021-01-10', 'BF-18584', 'Galicia, Mary Christ Pol', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:42', 'A', '15-02864'),
(2265, '2021-01-10', 'BF-37531', 'Tomandao, Catherine Pagadora', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:42', 'A', '15-02864'),
(2266, '2021-01-10', 'EN69-2715', 'Azuela, Leny O.', 'QA', 'Quality Assurance', 'QA Subaru Initial', '2021-01-10 00:21:42', 'A', '15-02864'),
(2267, '2021-01-10', '15-02613', 'Masarap, Juliet H.', 'QA', 'Quality Assurance', 'QA SWAT Final', '2021-01-10 00:33:49', 'A', '15-02796'),
(2268, '2021-01-10', '17-03467', 'Rayos, Aileen D.', 'QA', 'Quality Assurance', 'QA SWAT Final', '2021-01-10 00:33:49', 'A', '15-02796'),
(2269, '2021-01-10', '19-04742', 'Hernandez, Donalyn A.', 'QA', 'Quality Assurance', 'QA SWAT Final', '2021-01-10 00:33:49', 'A', '15-02796'),
(2270, '2021-01-10', '13-0492', 'Ocampo, Mary Grace G.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-10 00:51:58', 'A', '14-01816'),
(2271, '2021-01-10', '18_PK27358', 'Pine, Jennifer L.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-10 00:51:58', 'NW', '14-01816'),
(2272, '2021-01-10', '20-05681', 'Cabaysa, Airish', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-10 00:51:58', 'NW', '14-01816'),
(2273, '2021-01-10', 'BF-37227', 'Legson, Camille  -', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-10 00:51:58', 'A', '14-01816'),
(2274, '2021-01-10', 'BF-37627', 'Latoza, Kristine Joy Kalaw', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-10 00:51:58', 'A', '14-01816'),
(2275, '2021-01-10', 'EN69-3480', 'Sulpico, Cynmar E.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-10 00:51:59', 'A', '14-01816'),
(2276, '2021-01-10', 'MWM00010138', 'Ilagan, Boyecel P.', 'QA', 'Quality Assurance', 'QA Honda Final', '2021-01-10 00:51:59', 'A', '14-01816'),
(2277, '2021-01-10', '18_PK29029', 'Endaya, Jayson D.', 'PKIMT', 'Housekeeping', '0', '2021-01-10 00:57:42', 'A', 'PKIMT-NS'),
(2278, '2021-01-10', '16_PK04135', 'Zoleta, Eisel F.', 'PKIMT', 'Non-Falp', '0', '2021-01-10 00:57:42', 'A', 'PKIMT-NS'),
(2279, '2021-01-10', 'AEFL19565', 'Gonzales, Glenda S.', 'QA', 'Quality Management', '0', '2021-01-10 02:03:49', 'A', '14-02228'),
(2280, '2021-01-10', '15_2514483', 'Rosales Jr., Pedrito A.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:56', 'A', '14-01724'),
(2281, '2021-01-10', '15-02917', 'Pasia, Harlene B.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:56', 'A', '14-01724'),
(2282, '2021-01-10', '20_PK43753', 'Opulencia, Jocelyn R.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:56', 'A', '14-01724'),
(2283, '2021-01-10', '20_PK44391', 'Reyes, Jeniffer J.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:56', 'A', '14-01724'),
(2284, '2021-01-10', '20_PK45236', 'Salubre, Leremie S.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:57', 'A', '14-01724'),
(2285, '2021-01-10', '20_PK45396', 'Marcuap, Jean Diane A.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:57', 'A', '14-01724'),
(2286, '2021-01-10', 'BF-37658', 'Almonte, Michelle Piamonte', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:57', 'A', '14-01724'),
(2287, '2021-01-10', 'EN69-0356', 'Marasigan, Alice M.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:57', 'A', '14-01724'),
(2288, '2021-01-10', 'EN69-3401', 'Ma?Eago, Mabel C.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-10 02:10:57', 'A', '14-01724'),
(2293, '2021-01-11', '14_1611481', 'Leonor, Mary Grace M.', 'PKIMT', 'Non-Falp', '0', '2021-01-11 09:24:56', 'RD', 'PKIMT-DS'),
(2294, '2021-01-11', '16_PK04135', 'Zoleta, Eisel F.', 'PKIMT', 'Non-Falp', '0', '2021-01-11 09:24:56', 'A', 'PKIMT-DS'),
(2295, '2021-01-11', '19_PK36277', 'Macalintal, Jennifer B.', 'PKIMT', 'Non-Falp', '0', '2021-01-11 09:24:56', 'RD', 'PKIMT-DS'),
(2296, '2021-01-11', '20_PK45737', 'Llanto, John Samuel M.', 'PE', 'PEC and C', '0', '2021-01-11 09:52:05', 'A', '19-05016'),
(2297, '2021-01-11', '14-01812', 'Obispo, Venus P.', 'QA', 'Quality Assurance', 'QA Honda Initial', '2021-01-11 10:51:43', 'A', '14-01812'),
(2298, '2021-01-11', '19-04455', 'Acebo, Ronalyn L.', 'QA', 'Quality Assurance', 'QA Honda Initial', '2021-01-11 10:51:43', 'A', '14-01812'),
(2299, '2021-01-11', '20_PK44805', 'Jackson, Sheilah F.', 'QA', 'Quality Assurance', 'QA Honda Initial', '2021-01-11 10:51:43', 'A', '14-01812'),
(2300, '2021-01-11', 'BF-37824', 'Tipan, Maria Gracia Tabigne', 'QA', 'Quality Assurance', 'QA Honda Initial', '2021-01-11 10:51:43', 'A', '14-01812'),
(2302, '2021-01-11', '13-0227', 'Amada, Jeren U.', 'PE', 'MPPD', '0', '2021-01-11 11:52:03', 'A', '18-04342'),
(2303, '2021-01-11', '14-01363', 'Lajara, Vincent M.', 'PE', 'MPPD', '0', '2021-01-11 11:52:03', 'A', '18-04342'),
(2304, '2021-01-11', '17-03190', 'Villanueva, Jelen G.', 'PE', 'MPPD', '0', '2021-01-11 11:52:03', 'A', '18-04342'),
(2305, '2021-01-11', '20-05842', 'Arquillo, Princess Camille B.', 'PE', 'MPPD', '0', '2021-01-11 11:52:03', 'A', '18-04342'),
(2306, '2021-01-11', '16_PK05842', 'Diaz, Angela', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:49', 'A', '14-02341'),
(2307, '2021-01-11', '19_PK34196', 'Legarte, Ressa Mae C.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2308, '2021-01-11', '20_PK38091', 'Viduya, Charlene O', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2309, '2021-01-11', '20_PK38420', 'Neria, Carlo P.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2310, '2021-01-11', '20_PK39007', 'Orilla, Edmay A.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2311, '2021-01-11', '20_PK42046', 'Barbosa, Maria Monica F.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2312, '2021-01-11', '20_PK44093', 'Mendoza, Rica R.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2313, '2021-01-11', 'AEFL20361', 'Mangubat, Andrea M.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2314, '2021-01-11', 'MWM00009282', 'Clerigo, Apple C.', 'QA', 'Quality Assurance', 'QA D01L Initial', '2021-01-11 11:52:50', 'A', '14-02341'),
(2315, '2021-01-11', '20_PK41395', 'Reboria, Mycel G.', 'QA', 'Quality Assurance', 'QA Subaru Final', '2021-01-11 12:29:15', 'A', '14-01411'),
(2316, '2021-01-11', '20_PK41564', 'Perez, Zarina Joy G.', 'QA', 'Quality Assurance', 'QA Subaru Final', '2021-01-11 12:29:15', 'A', '14-01411'),
(2317, '2021-01-11', 'BF-18051', 'Masajo, Richard M.', 'QA', 'Quality Assurance', 'QA Suzuki YV7/ Y2R Final', '2021-01-11 12:40:47', 'A', '14-01079'),
(2318, '2021-01-11', 'BF-37760', 'Enano, Lorymae', 'QA', 'Quality Assurance', 'QA Suzuki YV7/ Y2R Final', '2021-01-11 12:40:47', 'A', '14-01079'),
(2319, '2021-01-11', '13-0231', 'Arellano, Mark Riel D.', 'EQD', 'Management', '0', '2021-01-11 12:58:12', 'A', '17-03232'),
(2320, '2021-01-11', '13-0673', 'Caguitla, Emmanuel V.', 'EQD', 'Equipment Management', '0', '2021-01-11 12:58:12', 'A', '17-03232'),
(2321, '2021-01-11', '15_PK01602', 'Brimbuela, Brix Boy M.', 'EQD', 'Equipment Management', '0', '2021-01-11 12:58:12', 'A', '17-03232'),
(2322, '2021-01-11', '17-03232', 'Calisin, Camille M.', 'EQD', 'Management', '0', '2021-01-11 12:58:12', 'RD', '17-03232'),
(2323, '2021-01-11', '18-03988', 'Beloso, Darrel Dominic B.', 'EQD', 'Management', '0', '2021-01-11 12:58:12', 'RD', '17-03232'),
(2324, '2021-01-11', '12-0068', 'De Torres, Divina Amor T.', 'HR', 'Recruitment and Training', '0', '2021-01-11 13:10:44', 'A', '19-05168'),
(2325, '2021-01-11', 'EN69-3679', 'Delica, Yna M.', 'HR', 'Recruitment and Training', '0', '2021-01-11 13:10:44', 'A', '19-05168'),
(2326, '2021-01-11', '14-01685', 'Lubigan, Beberly V.', 'HR', 'Recruitment and Training', '0', '2021-01-11 13:10:44', 'A', '19-05168'),
(2327, '2021-01-11', '14-02122', 'Najira, Florie May D.', 'HR', 'Recruitment and Training', '0', '2021-01-11 13:10:44', 'A', '19-05168'),
(2328, '2021-01-11', '12-0023', 'Panghulan, Katherine B.', 'HR', 'Recruitment and Training', '0', '2021-01-11 13:10:44', 'A', '19-05168'),
(2329, '2021-01-11', '14-01314', 'Torrejano, Renna G.', 'HR', 'Recruitment and Training', '0', '2021-01-11 13:10:44', 'A', '19-05168'),
(2330, '2021-01-11', 'AE191216', 'Magsino, Jecel', 'Add Even', 'N/A', '0', '2021-01-11 13:11:54', 'RD', 'AEM-DS'),
(2337, '2021-01-11', '13-0420', 'Delen, Cynthia P.', 'QA', 'Quality Management', '0', '2021-01-11 13:24:31', 'A', '19-04950'),
(2338, '2021-01-11', '17-03348', 'Lontok, Jenicca D.', 'QA', 'Quality Management', '0', '2021-01-11 13:24:31', 'A', '19-04950'),
(2339, '2021-01-11', '19-05250', 'Maralit, Jenny Rose M.', 'QA', 'Quality Management', '0', '2021-01-11 13:24:31', 'A', '19-04950'),
(2343, '2021-01-11', '20_PK41478', 'Mojares, Joy M.', 'QA', 'Quality Assurance', 'QA Daihatsu Initial', '2021-01-11 13:33:05', 'A', '14-00991'),
(2344, '2021-01-11', '13-0446', 'Ibana, Gemlet D.', 'IT', 'Information Technology', '0', '2021-01-11 13:35:23', 'A', '17-03139'),
(2345, '2021-01-11', '13-0389', 'Mantuano, Maricar R.', 'PDC', 'Production Design Center', '0', '2021-01-11 13:54:09', 'A', '16-03119'),
(2346, '2021-01-11', '13-0563', 'Julongbayan, Cherryza B.', 'PDC', 'Production Design Center', '0', '2021-01-11 13:54:09', 'A', '16-03119'),
(2347, '2021-01-11', '14-01959', 'Malicdem, Janette M.', 'PDC', 'Production Design Center', '0', '2021-01-11 13:54:09', 'A', '16-03119'),
(2348, '2021-01-11', '20-05720', 'Ricalde, Ana Mari L.', 'EQD', ' Equipment Engineering', 'Machine Data', '2021-01-11 13:56:28', 'RD', 'EQD-DS-MD'),
(2349, '2021-01-11', '18-03603', 'De Castro, Emil U.', 'EQD', ' Equipment Management', 'Facilities', '2021-01-11 14:00:15', 'RD', 'EQD-DS-Facilities'),
(2350, '2021-01-11', '19_PK36826', 'Casiño, John Mark S.', 'EQD', ' Equipment Management', 'Facilities', '2021-01-11 14:00:15', 'A', 'EQD-DS-Facilities'),
(2351, '2021-01-11', '19_PK29645', 'Masayes, Charie Ann S.', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-11 14:03:59', 'A', '14-02361'),
(2352, '2021-01-11', '20_PK41910', 'Lerios, Jasmin T.', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-11 14:03:59', 'A', '14-02361'),
(2353, '2021-01-11', '20_PK42754', 'Golfo, Abigael', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-11 14:03:59', 'A', '14-02361'),
(2354, '2021-01-11', '20-05494', 'Umali, Jovelyn N.', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-11 14:03:59', 'A', '14-02361'),
(2355, '2021-01-11', 'BF-18478', 'Kalalo, Nelly Baring', 'QA', 'Quality Assurance', 'QA Merge Initial', '2021-01-11 14:04:00', 'A', '14-02361'),
(2356, '2021-01-11', '14-01904', 'Brucal, April E.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:11', 'A', '17-03175'),
(2357, '2021-01-11', '15-02658', 'Redondo, Cherry Anne R.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:11', 'A', '17-03175'),
(2358, '2021-01-11', '18-03827', 'Landicho, Emmylyn P.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:12', 'A', '17-03175'),
(2359, '2021-01-11', '18-03995', 'Borsola, Lenie B.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:12', 'A', '17-03175'),
(2360, '2021-01-11', '19_PK33843', 'Rosales, Jescille Joy N.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:12', 'A', '17-03175'),
(2361, '2021-01-11', '19_PK36993', 'Coloma, Kathleen R.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:12', 'A', '17-03175'),
(2362, '2021-01-11', '19-04474', 'Atienza, Ma. Frances Elaine M.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:12', 'A', '17-03175'),
(2363, '2021-01-11', '20_PK43754', 'Dimaano, Keithleen E.', 'QA', 'Quality Control', '0', '2021-01-11 14:27:12', 'A', '17-03175'),
(2364, '2021-01-11', 'BF-14219', 'Quimson, Sherelyn Ocsal', 'QA', 'Quality Control', '0', '2021-01-11 14:27:12', 'A', '17-03175'),
(2365, '2021-01-11', 'BF-14767', 'Ibasco, Jessa Mae Lagdaan', 'QA', 'Quality Control', '0', '2021-01-11 14:27:13', 'A', '17-03175'),
(2366, '2021-01-11', 'MWM00010601', 'Salarda, April', 'QA', 'Quality Control', '0', '2021-01-11 14:27:13', 'A', '17-03175'),
(2367, '2021-01-11', '19-04982', 'Gonzales, Enrico S.', 'EQD', ' Equipment Engineering', 'Fabrication', '2021-01-11 14:31:50', 'A', 'EQD-DS-Fabrication'),
(2368, '2021-01-11', 'AEFL20083', 'Sangcap, Redentor S. ', 'EQD', ' Equipment Engineering', 'Fabrication', '2021-01-11 14:31:50', 'A', 'EQD-DS-Fabrication'),
(2369, '2021-01-11', 'BF-17401', 'Banta, Sherwin Rio', 'EQD', ' Equipment Engineering', 'Fabrication', '2021-01-11 14:31:50', 'A', 'EQD-DS-Fabrication'),
(2370, '2021-01-14', '19-05251', 'Melo, Ronalyn V.', 'QA', 'Quality Assurance', 'QA Suzuki Y2R Initial', '2021-01-14 09:12:16', 'A', '13-00908'),
(2371, '2021-01-14', '20_PK40066', 'Villaluna, Donalen D.', 'QA', 'Quality Assurance', 'QA Suzuki Y2R Initial', '2021-01-14 09:12:16', 'NW', '13-00908'),
(2372, '2021-01-14', '14-01899', 'Bathan, Laurice A.', 'IT', 'Information Technology', '0', '2021-01-14 11:06:00', 'NW', '17-03139');

-- --------------------------------------------------------

--
-- Table structure for table `t_attendance`
--

CREATE TABLE `t_attendance` (
  `listId` int NOT NULL,
  `empId` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empShift` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attendDate` date NOT NULL,
  `timeIn` datetime NOT NULL,
  `timeOut` datetime NOT NULL,
  `totalOT` int NOT NULL,
  `otReason` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `absentReason` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_change_shuttle`
--

CREATE TABLE `t_change_shuttle` (
  `listId` int NOT NULL,
  `idNumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `changeDate` date NOT NULL,
  `routeFrom` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `routeTo` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `userChanged` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_change_shuttle`
--

INSERT INTO `t_change_shuttle` (`listId`, `idNumber`, `changeDate`, `routeFrom`, `routeTo`, `userChanged`) VALUES
(1, '13-0504', '2021-01-14', 'Batangas', 'Ibaan', '17-03139');

-- --------------------------------------------------------

--
-- Table structure for table `t_code_resubmit_outgoing`
--

CREATE TABLE `t_code_resubmit_outgoing` (
  `resubmitCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateGenerated` datetime DEFAULT NULL,
  `modifyDate` date DEFAULT NULL,
  `modifyItem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requestor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requestorName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usedDt` datetime DEFAULT NULL,
  `shift` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_code_resubmit_outgoing`
--

INSERT INTO `t_code_resubmit_outgoing` (`resubmitCode`, `dateGenerated`, `modifyDate`, `modifyItem`, `status`, `requestor`, `requestorName`, `usedDt`, `shift`) VALUES
('ACC-269508-13', '2021-01-13 17:10:53', '2021-01-13', 'Accounting and Taxation', 'Open', '13-0293', 'Arellano, Nicole Jane E.', NULL, 'DS'),
('ACC-712204-2021-01-12', '2021-01-13 17:32:35', '2021-01-12', 'Accounting and Taxation', 'Open', '13-0293', 'Arellano, Nicole Jane E.', NULL, 'DS'),
('PE-485706-13', '2021-01-13 17:06:35', '2021-01-13', 'AME', 'Open', '14-01822', 'Puyo, Jeniffer B.', '2021-01-14 08:50:14', 'DS');

-- --------------------------------------------------------

--
-- Table structure for table `t_data_holiday`
--

CREATE TABLE `t_data_holiday` (
  `listId` int NOT NULL,
  `weekNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dataFiled` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `totalDS` int NOT NULL,
  `totalNS` int NOT NULL,
  `dateFiled` datetime NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_data_outgoing`
--

CREATE TABLE `t_data_outgoing` (
  `listId` int NOT NULL,
  `dtFiled` date NOT NULL,
  `timeFiled` time NOT NULL,
  `empName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idNumber` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptGrp` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lineNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `outGoing` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empArea` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filedBy` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shift` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_data_sunday`
--

CREATE TABLE `t_data_sunday` (
  `listId` int NOT NULL,
  `weekNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dataFiled` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `totalDS` int NOT NULL,
  `totalNS` int NOT NULL,
  `dateFiled` datetime NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_data_weekly`
--

CREATE TABLE `t_data_weekly` (
  `listId` int NOT NULL,
  `weekNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dataFiled` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `totalDS` int NOT NULL,
  `totalNS` int NOT NULL,
  `dateFiled` datetime NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_employee_history`
--

CREATE TABLE `t_employee_history` (
  `listId` int NOT NULL,
  `idNumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `activityDate` datetime NOT NULL,
  `actDescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_employee_history`
--

INSERT INTO `t_employee_history` (`listId`, `idNumber`, `activityDate`, `actDescription`, `user`) VALUES
(1, 'Line-1', '2021-01-14 17:13:36', 'Transfer to QA', '19-05168'),
(2, 'Line-1', '2021-01-14 17:15:22', 'Transfer to Quality Assurance', 'EN69-1072');

-- --------------------------------------------------------

--
-- Table structure for table `t_employee_transfer`
--

CREATE TABLE `t_employee_transfer` (
  `listId` int NOT NULL,
  `idNumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateTrans` date NOT NULL,
  `dateBack` date NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptSect` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deptSubSec` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lineNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_employee_transfer`
--

INSERT INTO `t_employee_transfer` (`listId`, `idNumber`, `empName`, `dateTrans`, `dateBack`, `filedBy`, `deptCode`, `deptSect`, `deptSubSec`, `lineNo`, `status`) VALUES
(2, 'Line-1', 'Line-1', '2021-01-14', '2021-01-15', '19-05168', 'IT', 'N/A', 'N/A', '0', 'On Going');

-- --------------------------------------------------------

--
-- Table structure for table `t_filing_holiday`
--

CREATE TABLE `t_filing_holiday` (
  `listId` int NOT NULL,
  `dateFiled` date NOT NULL,
  `timeFiled` time NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_filing_outgoing`
--

CREATE TABLE `t_filing_outgoing` (
  `listId` int NOT NULL,
  `filedFor` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateFiled` date NOT NULL,
  `timeFiled` time NOT NULL,
  `shift` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idUser` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_filing_sunday`
--

CREATE TABLE `t_filing_sunday` (
  `listId` int NOT NULL,
  `dateFiled` date NOT NULL,
  `timeFiled` time NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_filing_weekly`
--

CREATE TABLE `t_filing_weekly` (
  `listId` int NOT NULL,
  `dateFiled` date NOT NULL,
  `timeFiled` time NOT NULL,
  `filedBy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_notifs`
--

CREATE TABLE `t_notifs` (
  `listId` int NOT NULL,
  `handler` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateFiled` datetime NOT NULL,
  `userFiled` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_notifs`
--

INSERT INTO `t_notifs` (`listId`, `handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES
(1, 'Quality Assurance', 'Transfer Employees', 'Line-1 - Line-1<br>', '2021-01-14 17:13:36', '19-05168', 'read'),
(2, 'Quality Assurance', 'Transfer Employees', 'Line-1 - Line-1<br>', '2021-01-14 17:15:22', 'EN69-1072', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_logs`
--

CREATE TABLE `t_user_logs` (
  `listId` int NOT NULL,
  `activityDate` datetime NOT NULL,
  `userID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `actDescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ipAdd` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_user_logs`
--

INSERT INTO `t_user_logs` (`listId`, `activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES
(1, '2021-01-14 05:13:40', '19-05168', 'De Chavez, Arrissa V.', 'Logout', '::1'),
(2, '2021-01-14 05:14:00', 'EN69-1072', 'Billones, Grace H.', 'Login', '::1'),
(3, '2021-01-14 05:15:35', 'EN69-1072', 'Billones, Grace H.', 'Logout', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_accounts`
--
ALTER TABLE `m_accounts`
  ADD PRIMARY KEY (`idNumber`);

--
-- Indexes for table `m_admin`
--
ALTER TABLE `m_admin`
  ADD PRIMARY KEY (`adminName`);

--
-- Indexes for table `m_adminacc`
--
ALTER TABLE `m_adminacc`
  ADD PRIMARY KEY (`idNumber`);

--
-- Indexes for table `m_agency`
--
ALTER TABLE `m_agency`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `m_costing`
--
ALTER TABLE `m_costing`
  ADD PRIMARY KEY (`costCenter`);

--
-- Indexes for table `m_department`
--
ALTER TABLE `m_department`
  ADD PRIMARY KEY (`deptCode`);

--
-- Indexes for table `m_employee`
--
ALTER TABLE `m_employee`
  ADD PRIMARY KEY (`idNumber`);

--
-- Indexes for table `m_lineno`
--
ALTER TABLE `m_lineno`
  ADD PRIMARY KEY (`lineNo`);

--
-- Indexes for table `m_outgoing`
--
ALTER TABLE `m_outgoing`
  ADD PRIMARY KEY (`outGoing`);

--
-- Indexes for table `m_overtime`
--
ALTER TABLE `m_overtime`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `m_position`
--
ALTER TABLE `m_position`
  ADD PRIMARY KEY (`position`);

--
-- Indexes for table `m_route`
--
ALTER TABLE `m_route`
  ADD PRIMARY KEY (`route`);

--
-- Indexes for table `m_sched`
--
ALTER TABLE `m_sched`
  ADD PRIMARY KEY (`schedTime`);

--
-- Indexes for table `t_absent`
--
ALTER TABLE `t_absent`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_attendance`
--
ALTER TABLE `t_attendance`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_change_shuttle`
--
ALTER TABLE `t_change_shuttle`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_code_resubmit_outgoing`
--
ALTER TABLE `t_code_resubmit_outgoing`
  ADD PRIMARY KEY (`resubmitCode`);

--
-- Indexes for table `t_data_holiday`
--
ALTER TABLE `t_data_holiday`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_data_outgoing`
--
ALTER TABLE `t_data_outgoing`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_data_sunday`
--
ALTER TABLE `t_data_sunday`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_data_weekly`
--
ALTER TABLE `t_data_weekly`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_employee_history`
--
ALTER TABLE `t_employee_history`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_employee_transfer`
--
ALTER TABLE `t_employee_transfer`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_filing_holiday`
--
ALTER TABLE `t_filing_holiday`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_filing_outgoing`
--
ALTER TABLE `t_filing_outgoing`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_filing_sunday`
--
ALTER TABLE `t_filing_sunday`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_filing_weekly`
--
ALTER TABLE `t_filing_weekly`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_notifs`
--
ALTER TABLE `t_notifs`
  ADD PRIMARY KEY (`listId`);

--
-- Indexes for table `t_user_logs`
--
ALTER TABLE `t_user_logs`
  ADD PRIMARY KEY (`listId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_agency`
--
ALTER TABLE `m_agency`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_overtime`
--
ALTER TABLE `m_overtime`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_absent`
--
ALTER TABLE `t_absent`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2373;

--
-- AUTO_INCREMENT for table `t_attendance`
--
ALTER TABLE `t_attendance`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_change_shuttle`
--
ALTER TABLE `t_change_shuttle`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_data_holiday`
--
ALTER TABLE `t_data_holiday`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_data_outgoing`
--
ALTER TABLE `t_data_outgoing`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_data_sunday`
--
ALTER TABLE `t_data_sunday`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_data_weekly`
--
ALTER TABLE `t_data_weekly`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_employee_history`
--
ALTER TABLE `t_employee_history`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_employee_transfer`
--
ALTER TABLE `t_employee_transfer`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_filing_holiday`
--
ALTER TABLE `t_filing_holiday`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_filing_outgoing`
--
ALTER TABLE `t_filing_outgoing`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_filing_sunday`
--
ALTER TABLE `t_filing_sunday`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_filing_weekly`
--
ALTER TABLE `t_filing_weekly`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_notifs`
--
ALTER TABLE `t_notifs`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_user_logs`
--
ALTER TABLE `t_user_logs`
  MODIFY `listId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
