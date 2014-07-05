-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2014 at 11:15 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tgctemp`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consultant_user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `startdate` datetime NOT NULL,
  `contracttext` longtext COLLATE utf8_unicode_ci,
  `registrationtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E98F285949257338` (`consultant_user_id`),
  KEY `IDX_E98F2859166D1F9C` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `businessName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `university` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `universityEmail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skills` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `cv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invitation_id` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `bio` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clubName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `locations` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479A35D7AF0` (`invitation_id`),
  KEY `IDX_957A6479D60322AC` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `role_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `status`, `firstName`, `lastName`, `location`, `businessName`, `phone`, `website`, `university`, `universityEmail`, `degree`, `skills`, `cv`, `linkedin`, `invitation_id`, `description`, `bio`, `photo`, `clubName`, `created`, `updated`, `locations`) VALUES
(6, NULL, 'tgcsuperadmin', 'tgcsuperadmin', 'ugnius.ramanauskas@gmail.com', 'ugnius.ramanauskas@gmail.com', 1, 'rs2ag1br868gg4sg8cos0ccggs8wsso', 'X5nswJkPVZfNoU0GeD7Jr4QAscrsytyJidU0/ymo3brVOJ2w9Wxtyxy3Vj3TRaDgbMJ/RwgnSlaBH5wPi7e19w==', '2014-06-29 17:54:46', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, 'approved', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-06-29 17:54:46', NULL),
(9, NULL, 'consultant4', 'consultant4', 'ugnius4@gmail.com', 'ugnius4@gmail.com', 1, 'd37pvza5bagog0o0kcog840w0k804s0', 'Ufo0vKRIwp8q4JDAOQM2MZ18HMyXEMnIzyvzeeJF0mpqCGZ4rRMY1KCIdokS444awTnw+jkTw+mmUffsJ1H48g==', '2014-04-26 16:45:07', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_CONSULTANT";}', 0, NULL, 'approved', 'Ugnius', 'Ramanauskas', 'Vilnius, Lithuania', NULL, NULL, NULL, 'GWU', 'ugnius@gwu.edu', 'MA in IA', NULL, '/tmp/php3kwQvI', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-04-26 16:45:07', NULL),
(11, NULL, 'business', 'business', 'business@gradconsultancy.com', 'business@gradconsultancy.com', 1, 'c6ek16qgu5ko0k4808o8ckc8wc0g4sw', '123123', '2014-04-26 09:05:48', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:13:"ROLE_BUSINESS";}', 0, NULL, 'approved', 'Business', 'Demo', 'London', 'DEMO BUSINESS', '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-06-29 17:55:38', NULL),
(12, NULL, 'consultant', 'consultant', 'consultant@gradconsultancy.com', 'consultant@gradconsultancy.com', 1, 'qop5zi9qipwgso48s8swskssso8wg8k', 'phtgRuA4CSWCqH8bTvqKFOg4KyreM6xU4KWH1sc/NLzc0JnJ8s++Ln8MFkcaoAewZ80VTSqN7yeHDliCO0E/Eg==', '2014-04-26 09:25:45', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_CONSULTANT";}', 0, NULL, 'approved', 'Demo', 'Consultant', 'London', NULL, NULL, NULL, 'LSE', 'consultant@gradconsultancy.com', 'Finance', NULL, '/tmp/phpG0ML38', '...', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-04-26 09:25:45', NULL),
(13, NULL, 'lisett', 'lisett', 'l.luik@lse.ac.uk', 'l.luik@lse.ac.uk', 1, 'o22uhh5yoms8os08sowg8go08s0kc40', '7xgznQyVdKrp8zPzleU+RzJK33x8XXZ0G+iBHpkv8BgOcEFwf8fNNnho35KRaY7Rzruv+Wv94uQOnS2UQHF8Hw==', '2014-04-15 12:40:11', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_CONSULTANT";}', 0, NULL, 'approved', 'Lisett', 'Luik', 'London', NULL, NULL, NULL, 'LSE', 'l.luik@lse.ac.uk', 'BSc Philosophy and Economics', NULL, '/tmp/phpjwUc1v', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(14, NULL, 'biz2', 'biz2', 'ugnius2@gmail.com', 'ugnius2@gmail.com', 1, '8vis40vgvokk4s8o8cc0www8k40co04', 'IgrO9mJ9W8m0CRJG04bzwg2vzyZEv5WQSStk0ZycNU+evy7ROu7QWfl+m1gl3mlWK6/EG4TBhyR7yqrjpVURkg==', '2014-06-29 17:56:09', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:13:"ROLE_BUSINESS";}', 0, NULL, 'approved', 'Ugnius', 'Ramanauskas', 'London', 'Biz2', '0700000000', 'tgc', NULL, NULL, NULL, 'a:1:{i:0;N;}', NULL, NULL, NULL, 'None', 'a:1:{i:0;N;}', NULL, NULL, '2014-04-21 20:36:06', '2014-06-29 17:56:09', NULL),
(15, NULL, 'club1', 'club1', 'club1@test.com', 'club1@test.com', 1, 'g2l9q4zyh8o48g4wsw8cg4ccc44og40', 'DksYp3n38VvW0nPNTfz8fR7tU1UrdHrtckfW9TADYLQX9kydYdseHyKYgr9QsqzjqBuvYmAjJm0erTjVXgJinA==', '2014-04-24 16:28:57', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_CLUB";}', 0, NULL, 'approved', NULL, NULL, 'Oxford', NULL, NULL, 'http://test.test', 'Oxford', 'ox@ox.co', NULL, 'a:1:{i:0;s:4:"Test";}', NULL, NULL, '123123', 'Test', 'N;', 'club1.png', 'TestClub', '2014-04-22 20:27:34', '2014-04-24 16:28:57', NULL),
(16, NULL, 'jason', 'jason', 'jasonw306@gmail.com', 'jasonw306@gmail.com', 1, 'a5a89ev0dt4okc0skcc4o00oogwcwow', 'M54CGjc8HwbFV9KCfTo1mluRJ5GbwoaWWYJTYL5iVqFk4y+jRN4XRL9MsIslbZ+zkqpYsFN8lh+j8jvRdCWRqQ==', '2014-04-26 20:46:19', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_CONSULTANT";}', 0, NULL, 'approved', 'Jason', 'Wong', 'London', NULL, NULL, NULL, 'j.h.y.wong@lse.ac.uk', 'j.h.y.wong@lse.ac.uk', 'Government', 'a:3:{i:0;s:3:"...";i:1;s:3:"...";i:2;s:3:"...";}', 'cv.zip', 'uk.linkedin.com/in/jasonwonglse', NULL, '...', 'a:1:{i:0;s:3:"...";}', 'jason.jpeg', NULL, '2014-04-24 17:39:54', '2014-04-26 20:46:19', 'N;'),
(17, NULL, 'jasonw', 'jasonw', 'jason@gradconsultancy.com', 'jason@gradconsultancy.com', 1, 'jxgpc6opirk4c0owocwc0w4gc88g080', 'OaVDfyXVzJLV1raaEHvAq3SyRZH+1Pzs4Tx4Zzt7PQxzM68g0Fgo6VRKkG1Uzv5F6h9KZ8Ry5E/kqUxioN8czA==', '2014-04-25 03:13:38', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:13:"ROLE_BUSINESS";}', 0, NULL, 'approved', 'Jason', 'Wong', 'London', 'The Graduate Consultancy', '07760506113', 'www.gradconsultancy.com', NULL, NULL, NULL, 'a:1:{i:0;N;}', NULL, NULL, NULL, '...', 'a:1:{i:0;N;}', NULL, NULL, '2014-04-24 22:23:24', '2014-04-25 03:13:38', 'N;'),
(18, NULL, 'ugniusr', 'ugniusr', 'ugnius@ugniustest.com', 'ugnius@ugniustest.com', 1, 'ouar50vq5q80owwkkw8wgsccc8osk8c', 'K1D1xqimmIbuimwBV3u1Cg5iRVO17jeQVBsesVdyVGSWHiHgRP3UBeLMr+z6phlDhI/2jMvS0vj3cWp0EnZXLQ==', '2014-06-14 15:26:06', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_CONSULTANT";}', 0, NULL, 'approved', 'Ugnius', 'Ramanauskas', 'United Kingdom', NULL, '07543812395', NULL, 'GWU', 'ugnius@gwu.edu', 'MA in International Affairs', 'a:1:{i:2;s:15:"Market research";}', 'cv.pdf', 'http://uk.linkedin.com/in/ugniusramanauskas', NULL, 'Software engineer with 2 years of startup experience.', 'a:3:{i:0;s:13:"Graduated GWU";i:1;s:14:"Worked for E&Y";i:2;s:24:"Had good times at school";}', 'ugniusr.png', NULL, '2014-04-26 17:54:05', '2014-06-14 15:41:35', 'N;'),
(19, NULL, 'test_oxford', 'test_oxford', 'ugnius@ox.ac.co.uk', 'ugnius@ox.ac.co.uk', 1, '40baumci4reo4cg40gcwkoc4c84o80c', 'ucoIGDijW4RwV1pk8iZlTu71RGBmWbnW56dyQeZ5Zpj/9+flVKMPGdAnEdNqE+38sPX7iMrbHvvak3axq88O6w==', '2014-04-27 13:23:16', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_CLUB";}', 0, NULL, 'approved', NULL, NULL, NULL, NULL, NULL, 'http://oxfordisthebest.co.uk', 'Oxford University', 'admin@ox.ac.co.uk', NULL, 'a:3:{i:0;s:15:"Market research";i:1;s:25:"Marketing strategy review";i:2;s:19:"Financial modelling";}', NULL, NULL, 'oxford', 'The Student Consulting Club at Oxford University has long traditions of both educating students, and serving the business community by allowing students get involved in real life consulting projects.', 'N;', 'test_oxford.png', 'Test Oxford University Student Consulting Club', '2014-04-26 18:06:58', '2014-04-27 13:23:16', 'a:1:{i:0;s:10:"Oxford, UK";}'),
(20, NULL, 'test_cambridge', 'test_cambridge', 'cambridgetest@gmail.com', 'cambridgetest@gmail.com', 1, 'r0676sjtuk0so8o8w8gscwsk0cwg4c0', 'R/RBi5hWwoscEeHwwzL0B1+i9/YOyDPBSs4Q/fSgIDfIVko6cdpq01qhuB3bwtw1UNNAVgC5pF1XQbnRXjVAgA==', '2014-04-28 20:04:03', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_CLUB";}', 0, NULL, 'approved', NULL, NULL, NULL, NULL, NULL, 'http://www.cuscg.co.uk/', 'University of Cambridge', 'admin@cam.ac.co.uk', NULL, 'a:3:{i:0;s:50:"Market entry analysis, including product appraisal";i:1;s:71:"Marketing strategy, including social media and internet-based marketing";i:2;s:54:"Private equity (e.g. recommending acquisition targets)";}', NULL, NULL, 'cam', 'The Cambridge University Student Consulting Group is a student-run organisation that aims to assist organisations of all kinds with real business problems by providing consulting services. We have branches in Cambridge, London and Washington DC.', 'N;', 'test_cambridge.png', 'The Cambridge University Student Consulting Group', '2014-04-28 19:14:56', '2014-04-28 20:04:03', 'a:1:{i:0;s:25:"Cambridge, United Kingdom";}');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `code` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`code`, `email`, `sent`) VALUES
('123123', 'ugnius.ramanauskas@gmail.com', 1),
('cam', 'cambridgetest@test.test', 0),
('oxford', 'ugnius@oxford.test.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_user_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `budget` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `registrationtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `deadline` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2FB3D0EEFA5D68D8` (`business_user_id`),
  KEY `IDX_2FB3D0EEDE95C867` (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `business_user_id`, `title`, `startdate`, `budget`, `duration`, `description`, `registrationtimestamp`, `status`, `sector_id`, `deadline`) VALUES
(2, 11, 'Supply Chain Analysis for a German Export Business', '2014-06-30', 1000, 5, '...', '2014-04-15 00:29:39', 1, 2, '0000-00-00'),
(3, 14, 'Sample project1', '2014-04-21', 10, 10, 'smth', '2014-04-21 17:39:22', 1, 1, '2014-04-21'),
(4, 14, 'Sample project2', '2014-04-21', 123, 123, '123', '2014-04-21 17:40:18', 1, 2, '2014-04-21'),
(5, 14, 'Sample project3', '2014-04-21', 12, 12, '123', '2014-04-21 17:40:49', 1, 3, '2014-04-21'),
(6, 11, 'Report on Political Risk in MENA', '2014-05-01', 250, 2, '.', '2014-04-23 02:23:07', 1, 4, '2014-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consultant_user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `coverletter` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hourlyrate` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `registrationtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BFE5947249257338` (`consultant_user_id`),
  KEY `IDX_BFE59472166D1F9C` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`id`, `name`, `color`) VALUES
(1, 'Finance & Accounting', '#E3E3E3'),
(2, 'Strategy', '#E3E3E3'),
(3, 'Marketing', '#E3E3E3'),
(4, 'Public affairs & Policy analysis', '#E3E3E3');

-- --------------------------------------------------------

--
-- Table structure for table `user_sector`
--

CREATE TABLE `user_sector` (
  `user_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`sector_id`),
  KEY `IDX_2EF1C2D5A76ED395` (`user_id`),
  KEY `IDX_2EF1C2D5DE95C867` (`sector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_sector`
--

INSERT INTO `user_sector` (`user_id`, `sector_id`) VALUES
(9, 1),
(9, 2),
(12, 1),
(13, 2),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(16, 3),
(16, 4),
(18, 2),
(18, 3),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(20, 1),
(20, 2),
(20, 3),
(20, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_D4E6F81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `FK_E98F2859166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_E98F285949257338` FOREIGN KEY (`consultant_user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD CONSTRAINT `FK_957A6479A35D7AF0` FOREIGN KEY (`invitation_id`) REFERENCES `invitation` (`code`),
  ADD CONSTRAINT `FK_957A6479D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_2FB3D0EEDE95C867` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`),
  ADD CONSTRAINT `FK_2FB3D0EEFA5D68D8` FOREIGN KEY (`business_user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `FK_BFE59472166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_BFE5947249257338` FOREIGN KEY (`consultant_user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `user_sector`
--
ALTER TABLE `user_sector`
  ADD CONSTRAINT `FK_2EF1C2D5DE95C867` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`),
  ADD CONSTRAINT `FK_2EF1C2D5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
