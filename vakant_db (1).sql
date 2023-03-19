-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2023 at 06:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vakant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `created_at`, `updated_at`) VALUES
(1, '2023-02-13 07:42:03', '2023-02-13 07:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `about_companies`
--

CREATE TABLE `about_companies` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_companies`
--

INSERT INTO `about_companies` (`id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `about_translations`
--

CREATE TABLE `about_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `about_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_translations`
--

INSERT INTO `about_translations` (`id`, `about_id`, `locale`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'az', 'Lorem standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ', NULL, NULL),
(2, 1, 'en', 'sadsadsadsad', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\Admin', 'updated', 4, 'App\\Models\\User', 3, '{\"old\": {\"name\": \"Balabey\", \"email\": \"balabeymuxtarov1@gmail.com\", \"login\": null, \"password\": \"$2y$10$ffGgoL7FkGk9EJmSCoJlXuogoYtJ3S0ILvAX8hTqqq4ZelfDPDTvq\"}, \"attributes\": {\"name\": \"Balabey\", \"email\": \"balabeymuxtarov1@gmail.com\", \"login\": null, \"password\": \"$2y$10$TNcgEISQU79rSGq0SCQ/r.lnBaDyhKJ7bkGnIsBrNGm8Avq3ydLNm\"}}', NULL, '2023-03-07 10:08:21', '2023-03-07 10:08:21'),
(2, 'default', 'deleted', 'App\\Models\\Admin', 'deleted', 4, 'App\\Models\\User', 3, '{\"old\": {\"name\": \"Balabey\", \"email\": \"balabeymuxtarov1@gmail.com\", \"login\": null, \"password\": \"$2y$10$TNcgEISQU79rSGq0SCQ/r.lnBaDyhKJ7bkGnIsBrNGm8Avq3ydLNm\"}}', NULL, '2023-03-07 10:16:28', '2023-03-07 10:16:28'),
(3, 'default', 'deleted', 'App\\Models\\Admin', 'deleted', 1, 'App\\Models\\User', 3, '{\"old\": {\"name\": \"510\", \"email\": \"user@vakant.az\", \"login\": null, \"password\": \"$2y$10$s6glp3/J3Y0pL08tE6ogiu95p37YbEi9t8X3HbUwWD5kV2L2MrC2m\"}}', NULL, '2023-03-07 10:19:40', '2023-03-07 10:19:40'),
(4, 'default', 'created', 'App\\Models\\Admin', 'created', 10, 'App\\Models\\User', 3, '{\"attributes\": {\"name\": \"Heidi Roman\", \"email\": \"salam@example.az\", \"login\": null, \"password\": \"$2y$10$OvPY9UIQX1DIrmTiwq/1OuBmWzhAvEGL7z15Yq/F.Z9ld6n9yjXDq\"}}', NULL, '2023-03-07 10:20:20', '2023-03-07 10:20:20'),
(5, 'default', 'deleted', 'App\\Models\\Admin', 'deleted', 10, 'App\\Models\\User', 3, '{\"old\": {\"name\": \"Heidi Roman\", \"email\": \"salam@example.az\", \"login\": null, \"password\": \"$2y$10$OvPY9UIQX1DIrmTiwq/1OuBmWzhAvEGL7z15Yq/F.Z9ld6n9yjXDq\"}}', NULL, '2023-03-07 10:41:51', '2023-03-07 10:41:51'),
(6, 'default', 'created', 'App\\Models\\Admin', 'created', 11, 'App\\Models\\User', 3, '{\"attributes\": {\"name\": \"Balaeli\", \"email\": \"malik@malik.ru\", \"login\": null, \"password\": \"$2y$10$Nf7O0wpkZj8BBbSGIdwVjeRQ9SeRrEJ7NpeW9h8xxt4zjgrx.C.wW\"}}', NULL, '2023-03-07 10:43:10', '2023-03-07 10:43:10'),
(7, 'default', 'updated', 'App\\Models\\Admin', 'updated', 3, 'App\\Models\\User', 3, '{\"old\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$Nf7O0wpkZj8BBbSGIdwVjeRQ9SeRrEJ7NpeW9h8xxt4zjgrx.C.wW\"}, \"attributes\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$PQYLPnBTcOL2USOLuItVz.sm51s.PLImSg4x64NQYRhtxsh96aXI2\"}}', NULL, '2023-03-07 13:03:38', '2023-03-07 13:03:38'),
(8, 'default', 'updated', 'App\\Models\\Admin', 'updated', 3, 'App\\Models\\Admin', 3, '{\"old\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$PQYLPnBTcOL2USOLuItVz.sm51s.PLImSg4x64NQYRhtxsh96aXI2\"}, \"attributes\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a\"}}', NULL, '2023-03-07 13:07:12', '2023-03-07 13:07:12'),
(9, 'default', 'updated', 'App\\Models\\Admin', 'updated', 3, NULL, NULL, '{\"old\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a\"}, \"attributes\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a\"}}', NULL, '2023-03-08 05:19:19', '2023-03-08 05:19:19'),
(10, 'default', 'updated', 'App\\Models\\Admin', 'updated', 3, NULL, NULL, '{\"old\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a\"}, \"attributes\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a\"}}', NULL, '2023-03-08 05:19:44', '2023-03-08 05:19:44'),
(11, 'default', 'updated', 'App\\Models\\Admin', 'updated', 3, NULL, NULL, '{\"old\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a\"}, \"attributes\": {\"name\": \"Taleh\", \"email\": \"info@vakant.az\", \"login\": null, \"password\": \"$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a\"}}', NULL, '2023-03-08 05:19:52', '2023-03-08 05:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `last_seen`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(2, 'Developer Vakant', 'developer@vakant.az', NULL, '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm', NULL, NULL, NULL, NULL, '2023-02-13 12:41:04', '2023-02-13 12:41:04'),
(3, 'Taleh', 'info@vakant.az', NULL, '$2y$10$iVo28VHrF2UPGyY5MvUC2.tOoFUWypiwE0wkNrdAKFSUp/LN5XK2a', 'hxAxsj3A9Uofkv9n6nfODnh4GS8OItV9FpiPytD6yP0Ilv9Nfb5cfQ9VHkWv', NULL, NULL, NULL, '2023-02-28 10:38:31', '2023-03-07 13:07:12'),
(5, 'Tofiq Rehimov', 'tofiqrehimov@gmail.com', NULL, '$2y$10$T1Jb/XFQahfDQESf/yLwV.290DT7JdeokIU3M7NIug5fH30ykdo32', NULL, NULL, NULL, NULL, '2023-03-04 06:31:19', '2023-03-04 06:31:19'),
(11, 'Balaeli', 'malik@malik.ru', NULL, '$2y$10$Nf7O0wpkZj8BBbSGIdwVjeRQ9SeRrEJ7NpeW9h8xxt4zjgrx.C.wW', NULL, NULL, NULL, NULL, '2023-03-07 10:43:10', '2023-03-07 10:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `altcategory_translations`
--

CREATE TABLE `altcategory_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `alt_category_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `altcategory_translations`
--

INSERT INTO `altcategory_translations` (`id`, `alt_category_id`, `locale`, `name`) VALUES
(1, 1, 'az', 'Kredit mütəxəssisi'),
(2, 1, 'en', 'Credit Specialist'),
(3, 1, 'ru', 'Кредитный специалист'),
(4, 2, 'az', 'Sığorta'),
(5, 2, 'en', 'Insurance'),
(6, 2, 'ru', 'Страхование'),
(7, 3, 'az', 'Audit'),
(8, 3, 'en', 'Audit'),
(9, 3, 'ru', 'Аудит'),
(10, 4, 'az', 'Mühasibat'),
(11, 4, 'en', 'Accounting'),
(12, 4, 'ru', 'Бухгалтерия'),
(13, 5, 'az', 'Maliyyə analiz'),
(14, 5, 'en', 'Financial Analysis'),
(15, 5, 'ru', 'Финансовый анализ'),
(16, 6, 'az', 'Bank xidməti'),
(17, 6, 'en', 'Banking Services'),
(18, 6, 'ru', 'Банковское обслуживание'),
(19, 7, 'az', 'Kassir'),
(20, 7, 'en', 'Cashier'),
(21, 7, 'ru', 'Кассир'),
(22, 8, 'az', 'İqtisadçı'),
(23, 8, 'en', 'Economist'),
(24, 8, 'ru', 'Экономист'),
(25, 9, 'az', 'Digər'),
(26, 9, 'en', 'Other'),
(27, 9, 'ru', 'Другое'),
(28, 10, 'az', 'Marketinq menecment'),
(29, 10, 'en', 'Marketing Management'),
(30, 10, 'ru', 'Маркетинг менеджмент'),
(31, 11, 'az', 'İctimayətlə əlaqələr'),
(32, 11, 'en', 'Public Relations'),
(33, 11, 'ru', 'Связи с общественностью'),
(34, 12, 'az', 'Reklam'),
(35, 12, 'en', 'Advertising'),
(36, 12, 'ru', 'Реклама'),
(37, 13, 'az', 'Kopiraytinq'),
(38, 13, 'en', 'Copywriting'),
(39, 13, 'ru', 'Копирайтинг'),
(40, 14, 'az', 'Sistem idarəetməsi'),
(41, 14, 'en', 'System Administration'),
(42, 14, 'ru', 'Системное администрирование'),
(43, 15, 'az', 'Məlumat bazasının idarə edilməsi və inkişafı'),
(44, 15, 'en', 'Database Development and Management'),
(45, 15, 'ru', 'Разработка и управление базами данных'),
(46, 16, 'az', 'İT mütəxəssisi / məsləhətçi'),
(47, 16, 'en', 'IT Specialist / Consultant'),
(48, 16, 'ru', 'IT специалист / консультант'),
(49, 17, 'az', 'Proqramlaşdırma'),
(50, 17, 'en', 'Programming'),
(51, 17, 'ru', 'Программирование'),
(52, 18, 'az', 'İT layihələrin idarə edilməsi'),
(53, 18, 'en', 'IT Project Management'),
(54, 18, 'ru', 'Управление IT проектами'),
(55, 19, 'az', 'Texniki avadanlıq mütəxəssisi'),
(56, 19, 'en', 'Hardware Specialist'),
(57, 19, 'ru', 'Специалист по аппаратному обеспечению'),
(58, 20, 'az', 'Digər'),
(59, 20, 'en', 'Other'),
(60, 20, 'ru', 'Другое'),
(61, 21, 'az', 'İnzibati dəstək'),
(62, 21, 'en', 'Administrative Support'),
(63, 21, 'ru', 'Административная поддержка'),
(64, 22, 'az', 'Menecment'),
(65, 22, 'en', 'Management'),
(66, 22, 'ru', 'Менеджмент'),
(67, 23, 'az', 'Ofis menecmenti'),
(68, 23, 'en', 'Office Management'),
(69, 23, 'ru', 'Офис менеджмент'),
(70, 24, 'az', 'Katibə / Resepşn'),
(71, 24, 'en', 'Secretary / Receptionist'),
(72, 24, 'ru', 'Секретарь / Ресепшн'),
(73, 25, 'az', 'Heyətin idarəolunması'),
(74, 25, 'en', 'Personnel Management'),
(75, 25, 'ru', 'Управление персоналом'),
(76, 26, 'az', 'Digər'),
(77, 26, 'en', 'Other'),
(78, 26, 'ru', 'Другое'),
(79, 27, 'az', 'Daşınmaz əmlak agenti / makler'),
(80, 27, 'en', 'Real Estate Agent / Broker'),
(81, 27, 'ru', 'Агент по недвижимости / маклер'),
(82, 28, 'az', 'Satış üzrə mütəxəssis'),
(83, 28, 'en', 'Sales Specialist'),
(84, 28, 'ru', 'Специалист по продажам'),
(85, 29, 'az', 'Veb-dizayn'),
(86, 29, 'en', 'Web Design'),
(87, 29, 'ru', 'Веб-дизайн'),
(88, 30, 'az', 'Memar / İnteryer dizaynı'),
(89, 30, 'en', 'Architect / Interior Design'),
(90, 30, 'ru', 'Архитектор / дизайн интерьеров'),
(91, 31, 'az', 'Geyim dizaynı'),
(92, 31, 'en', 'Clothing Design'),
(93, 31, 'ru', 'Дизайн одежды'),
(94, 32, 'az', 'Rəssam'),
(95, 32, 'en', 'Painter'),
(96, 32, 'ru', 'Художник'),
(97, 33, 'az', 'Digər'),
(98, 33, 'en', 'Other'),
(99, 33, 'ru', 'Другое'),
(100, 34, 'az', 'Vəkil'),
(101, 34, 'en', 'Lawyer'),
(102, 34, 'ru', 'Адвокат'),
(103, 35, 'az', 'Cinayət hüququ'),
(104, 35, 'en', 'Criminal Law'),
(105, 35, 'ru', 'Криминальное право'),
(106, 36, 'az', 'Hüquqşünas'),
(107, 36, 'en', 'Lawyer'),
(108, 36, 'ru', 'Юрист'),
(109, 37, 'az', 'Digər'),
(110, 37, 'en', 'Other'),
(111, 37, 'ru', 'Другое'),
(112, 38, 'az', 'Məktəb tədrisi'),
(113, 38, 'en', 'Teaching in Schools'),
(114, 38, 'ru', 'Преподавание в школах'),
(115, 39, 'az', 'Universitet tədrisi'),
(116, 39, 'en', 'Teaching at Universities'),
(117, 39, 'ru', 'Преподавание в университетах'),
(118, 40, 'az', 'Repetitor'),
(119, 40, 'en', 'Tutoring'),
(120, 40, 'ru', 'Репетиторство'),
(121, 41, 'az', 'Xüsusi təhsil/ Təlim'),
(122, 41, 'en', 'Special Education / Trainings'),
(123, 41, 'ru', 'Специальное обучение / Тренинги'),
(124, 42, 'az', 'Digər'),
(125, 42, 'en', 'Other'),
(126, 42, 'ru', 'Другое'),
(127, 43, 'az', 'Avtomatlaşdırılmış idarəetmə'),
(128, 43, 'en', 'Automated Construction'),
(129, 43, 'ru', 'Автоматизированное проектирование'),
(130, 44, 'az', 'Tikinti'),
(131, 44, 'en', 'Construction'),
(132, 44, 'ru', 'Строительство'),
(133, 45, 'az', 'Kənd təsərrüfatı'),
(134, 45, 'en', 'Agriculture'),
(135, 45, 'ru', 'Сельское хозяйство'),
(136, 46, 'az', 'Mühəndis'),
(137, 46, 'en', 'Engineer'),
(138, 46, 'ru', 'Инженерия'),
(139, 47, 'az', 'Geologiya və ətraf mühit'),
(140, 47, 'en', 'Geology and Environment'),
(141, 47, 'ru', 'Геология и окружающая среда'),
(142, 48, 'az', 'Digər'),
(143, 48, 'en', 'Other'),
(144, 48, 'ru', 'Другое'),
(145, 49, 'az', 'Kuryer'),
(146, 49, 'en', 'Courier'),
(147, 49, 'ru', 'Курьер'),
(148, 50, 'az', 'SPA və gözəllik'),
(149, 50, 'en', 'SPA and Beauty'),
(150, 50, 'ru', 'СПА и красота'),
(151, 51, 'az', 'Xadimə'),
(152, 51, 'en', 'Cleaner'),
(153, 51, 'ru', 'Уборщица'),
(154, 52, 'az', 'Anbardar'),
(155, 52, 'en', 'Warehouseman'),
(156, 52, 'ru', 'Складчик'),
(157, 53, 'az', 'Restoran işi'),
(158, 53, 'en', 'Catering Trade'),
(159, 53, 'ru', 'Ресторанное дело'),
(160, 54, 'az', 'Sürücü'),
(161, 54, 'en', 'Driver'),
(162, 54, 'ru', 'Водитель'),
(163, 55, 'az', 'Dayə'),
(164, 55, 'en', 'Nanny'),
(165, 55, 'ru', 'Няня'),
(166, 56, 'az', 'Fəhlə'),
(167, 56, 'en', 'Worker'),
(168, 56, 'ru', 'Рабочий'),
(169, 57, 'az', 'Turizm və mehmanxana işi'),
(170, 57, 'en', 'Tourism and Hospitality Management'),
(171, 57, 'ru', 'Туризм и гостиничное дело'),
(172, 58, 'az', 'Tərcüməçi'),
(173, 58, 'en', 'Translator / Interpreter'),
(174, 58, 'ru', 'Переводчик'),
(175, 59, 'az', 'Mühafizə xidməti'),
(176, 59, 'en', 'Security Service'),
(177, 59, 'ru', 'Охрана'),
(178, 60, 'az', 'Digər'),
(179, 60, 'en', 'Other'),
(180, 60, 'ru', 'Другое'),
(181, 61, 'az', 'Həkim'),
(182, 61, 'en', 'Medic'),
(183, 61, 'ru', 'Врач'),
(184, 62, 'az', 'Tibbi personal'),
(185, 62, 'en', 'Medical Staff'),
(186, 62, 'ru', 'Медицинский персонал'),
(187, 63, 'az', 'Tibb təmsilçisi'),
(188, 63, 'en', 'Medical Representative'),
(189, 63, 'ru', 'Медицинский представитель'),
(190, 64, 'az', 'Jurnalistika'),
(191, 64, 'en', 'Journalism'),
(192, 64, 'ru', 'Журналистика'),
(193, 65, 'az', 'Tələbələr üçün'),
(194, 65, 'en', 'For students'),
(195, 65, 'ru', 'Для студентов');

-- --------------------------------------------------------

--
-- Table structure for table `alt_categories`
--

CREATE TABLE `alt_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alt_categories`
--

INSERT INTO `alt_categories` (`id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 5),
(28, 5),
(29, 6),
(30, 6),
(31, 6),
(32, 6),
(33, 6),
(34, 7),
(35, 7),
(36, 7),
(37, 7),
(38, 8),
(39, 8),
(40, 8),
(41, 8),
(42, 8),
(43, 9),
(44, 9),
(45, 9),
(46, 9),
(47, 9),
(48, 9),
(49, 10),
(50, 10),
(51, 10),
(52, 10),
(53, 10),
(54, 10),
(55, 10),
(56, 10),
(57, 10),
(58, 10),
(59, 10),
(60, 10),
(61, 11),
(62, 11),
(63, 11),
(64, 12),
(65, 12);

-- --------------------------------------------------------

--
-- Table structure for table `catalogs`
--

CREATE TABLE `catalogs` (
  `id` bigint UNSIGNED NOT NULL,
  `front_photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `back_photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_photos`
--

CREATE TABLE `catalog_photos` (
  `id` int UNSIGNED NOT NULL,
  `catalog_id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_translations`
--

CREATE TABLE `catalog_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `catalog_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'finance', 1, '2023-02-16 11:01:46', '2023-02-16 11:01:46'),
(2, 'marketing', 1, '2023-02-16 11:01:46', '2023-02-16 11:01:46'),
(3, 'information-technology', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(4, 'admininstration-and-management', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(5, 'sales', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(6, 'design', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(7, 'legal', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(8, 'education-and-science', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(9, 'industry-and-agriculture', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(10, 'services', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(11, 'medicine-and-pharmacy', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47'),
(12, 'other', 1, '2023-02-16 11:01:47', '2023-02-16 11:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `locale`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'az', 'Maliyyə', NULL, NULL),
(2, 1, 'en', 'Finance', NULL, NULL),
(3, 1, 'ru', 'Финансы', NULL, NULL),
(4, 2, 'az', 'Marketinq', NULL, NULL),
(5, 2, 'en', 'Marketing', NULL, NULL),
(6, 2, 'ru', 'Маркетинг', NULL, NULL),
(7, 3, 'az', 'İnformasiya texnologiyaları', NULL, NULL),
(8, 3, 'en', 'Information Technology', NULL, NULL),
(9, 3, 'ru', 'Информационные технологии', NULL, NULL),
(10, 4, 'az', 'İnzibati', NULL, NULL),
(11, 4, 'en', 'Admininstration and management', NULL, NULL),
(12, 4, 'ru', 'Администрация и управление', NULL, NULL),
(13, 5, 'az', 'Satış', NULL, NULL),
(14, 5, 'en', 'Sales', NULL, NULL),
(15, 5, 'ru', 'Продажи', NULL, NULL),
(16, 6, 'az', 'Dizayn', NULL, NULL),
(17, 6, 'en', 'Design', NULL, NULL),
(18, 6, 'ru', 'Дизайн', NULL, NULL),
(19, 7, 'az', 'Hüquqşünaslıq', NULL, NULL),
(20, 7, 'en', 'Legal', NULL, NULL),
(21, 7, 'ru', 'Юриспруденция', NULL, NULL),
(22, 8, 'az', 'Təhsil və elm', NULL, NULL),
(23, 8, 'en', 'Education and Science', NULL, NULL),
(24, 8, 'ru', 'Образование и наука', NULL, NULL),
(25, 9, 'az', 'Sənaye və kənd təsərrüfatı', NULL, NULL),
(26, 9, 'en', 'Industry and Agriculture', NULL, NULL),
(27, 9, 'ru', 'Промышленность и сельское хозяйство', NULL, NULL),
(28, 10, 'az', 'Xidmət', NULL, NULL),
(29, 10, 'en', 'Services', NULL, NULL),
(30, 10, 'ru', 'Обслуживание', NULL, NULL),
(31, 11, 'az', 'Tibb və əczaçılıq', NULL, NULL),
(32, 11, 'en', 'Medicine and Pharmacy', NULL, NULL),
(33, 11, 'ru', 'Медицина и фармация', NULL, NULL),
(34, 12, 'az', 'Müxtəlif', NULL, NULL),
(35, 12, 'en', 'Other', NULL, NULL),
(36, 12, 'ru', 'Разное', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `created_at`, `updated_at`) VALUES
(1, '2023-02-13 11:10:03', '2023-02-13 11:10:03'),
(2, '2023-02-13 11:10:03', '2023-02-13 11:10:03'),
(3, '2023-02-13 11:10:03', '2023-02-13 11:10:03'),
(4, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(5, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(6, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(7, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(8, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(9, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(10, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(11, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(12, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(13, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(14, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(15, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(16, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(17, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(18, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(19, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(20, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(21, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(22, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(23, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(24, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(25, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(26, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(27, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(28, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(29, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(30, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(31, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(32, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(33, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(34, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(35, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(36, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(37, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(38, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(39, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(40, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(41, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(42, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(43, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(44, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(45, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(46, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(47, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(48, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(49, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(50, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(51, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(52, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(53, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(54, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(55, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(56, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(57, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(58, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(59, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(60, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(61, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(62, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(63, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(64, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(65, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(66, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(67, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(68, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(69, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(70, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(71, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(72, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(73, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(74, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(75, '2023-02-13 11:10:04', '2023-02-13 11:10:04'),
(76, '2023-02-13 11:10:04', '2023-02-13 11:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `city_translations`
--

CREATE TABLE `city_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_translations`
--

INSERT INTO `city_translations` (`id`, `city_id`, `locale`, `name`) VALUES
(1, 1, 'az', 'Ağcabədi'),
(2, 1, 'en', 'Aghjabadi'),
(3, 1, 'ru', 'Агджабеди'),
(4, 2, 'az', 'Ağdam'),
(5, 2, 'en', 'Aghdam'),
(6, 2, 'ru', 'Агдам'),
(7, 3, 'az', 'Ağdaş'),
(8, 3, 'en', 'Agdash'),
(9, 3, 'ru', 'Агдаш'),
(10, 4, 'az', 'Ağdərə'),
(11, 4, 'en', 'Agdere'),
(12, 4, 'ru', 'Агдере'),
(13, 5, 'az', 'Ağstafa'),
(14, 5, 'en', 'Agstafa'),
(15, 5, 'ru', 'Агстафа'),
(16, 6, 'az', 'Ağsu'),
(17, 6, 'en', 'Agsu'),
(18, 6, 'ru', 'Агсу'),
(19, 7, 'az', 'Astara'),
(20, 7, 'en', 'Astara'),
(21, 7, 'ru', 'Астара'),
(22, 8, 'az', 'Bakı'),
(23, 8, 'en', 'Baku'),
(24, 8, 'ru', 'Баку'),
(25, 9, 'az', 'Balakən'),
(26, 9, 'en', 'Balakan'),
(27, 9, 'ru', 'Белоканы'),
(28, 10, 'az', 'Beyləqan'),
(29, 10, 'en', 'Beylagan'),
(30, 10, 'ru', 'Бейлаган'),
(31, 11, 'az', 'Bərdə'),
(32, 11, 'en', 'Barda'),
(33, 11, 'ru', 'Барда'),
(34, 12, 'az', 'Biləsuvar'),
(35, 12, 'en', 'Bilasuvar'),
(36, 12, 'ru', 'Билясувар'),
(37, 13, 'az', 'Cəbrayıl'),
(38, 13, 'en', 'Jabrayil'),
(39, 13, 'ru', 'Джабраил'),
(40, 14, 'az', 'Cəlilabad'),
(41, 14, 'en', 'Jalilabad'),
(42, 14, 'ru', 'Джалилабад'),
(43, 15, 'az', 'Culfa'),
(44, 15, 'en', 'Julfa'),
(45, 15, 'ru', 'Джульфа'),
(46, 16, 'az', 'Daşkəsən'),
(47, 16, 'en', 'Dashkesan'),
(48, 16, 'ru', 'Дашкесан'),
(49, 17, 'az', 'Əli-Bayramlı'),
(50, 17, 'en', 'Ali-Bayramli'),
(51, 17, 'ru', 'Али - Байрамлы'),
(52, 18, 'az', 'Füzuli'),
(53, 18, 'en', 'Fizuli'),
(54, 18, 'ru', 'Физули'),
(55, 19, 'az', 'Gədəbəy'),
(56, 19, 'en', 'Gadabay'),
(57, 19, 'ru', 'Гедабек'),
(58, 20, 'az', 'Gəncə'),
(59, 20, 'en', 'Ganja'),
(60, 20, 'ru', 'Гянджа'),
(61, 21, 'az', 'Goranboy'),
(62, 21, 'en', 'Goranboy'),
(63, 21, 'ru', 'Геранбой'),
(64, 22, 'az', 'Göyçay'),
(65, 22, 'en', 'Goychay'),
(66, 22, 'ru', 'Гойчай'),
(67, 23, 'az', 'Göygöl'),
(68, 23, 'en', 'Goygol'),
(69, 23, 'ru', 'Гёйгёль'),
(70, 24, 'az', 'Göytəpə'),
(71, 24, 'en', 'Goytepe'),
(72, 24, 'ru', 'Гёйтепе'),
(73, 25, 'az', 'Hacıqabul'),
(74, 25, 'en', 'Hajiqabul'),
(75, 25, 'ru', 'Гаджигабул'),
(76, 26, 'az', 'İmişli'),
(77, 26, 'en', 'Imishli'),
(78, 26, 'ru', 'Имишли'),
(79, 27, 'az', 'İsmayıllı'),
(80, 27, 'en', 'Ismayilli'),
(81, 27, 'ru', 'Исмаиллы'),
(82, 28, 'az', 'Kəlbəcər'),
(83, 28, 'en', 'Kalbajar'),
(84, 28, 'ru', 'Кельбаджар'),
(85, 29, 'az', 'Kürdəmir'),
(86, 29, 'en', 'Kurdamir'),
(87, 29, 'ru', 'Кюрдамир'),
(88, 30, 'az', 'Laçın'),
(89, 30, 'en', 'Lachin'),
(90, 30, 'ru', 'Лачын'),
(91, 31, 'az', 'Lerik'),
(92, 31, 'en', 'Lerik'),
(93, 31, 'ru', 'Лерик'),
(94, 32, 'az', 'Lənkəran'),
(95, 32, 'en', 'Lankaran'),
(96, 32, 'ru', 'Ленкорань'),
(97, 33, 'az', 'Masallı'),
(98, 33, 'en', 'Masally'),
(99, 33, 'ru', 'Масаллы'),
(100, 34, 'az', 'Mingəçevir'),
(101, 34, 'en', 'Mingachevir'),
(102, 34, 'ru', 'Мингячевир'),
(103, 35, 'az', 'Naftalan'),
(104, 35, 'en', 'Naftalan'),
(105, 35, 'ru', 'Нафталан'),
(106, 36, 'az', 'Naxçıvan'),
(107, 36, 'en', 'Nakhchivan'),
(108, 36, 'ru', 'Нахчыван'),
(109, 37, 'az', 'Neftçala'),
(110, 37, 'en', 'Neftchala'),
(111, 37, 'ru', 'Нефтечала'),
(112, 38, 'az', 'Oğuz'),
(113, 38, 'en', 'Oghuz'),
(114, 38, 'ru', 'Огуз'),
(115, 39, 'az', 'Ordubad'),
(116, 39, 'en', 'Ordubad'),
(117, 39, 'ru', 'Ордубад'),
(118, 40, 'az', 'Qaradağ'),
(119, 40, 'en', 'Garadagh'),
(120, 40, 'ru', 'Карадаг'),
(121, 41, 'az', 'Qax'),
(122, 41, 'en', 'Gakh'),
(123, 41, 'ru', 'Ках'),
(124, 42, 'az', 'Qazax'),
(125, 42, 'en', 'Gazakh'),
(126, 42, 'ru', 'Газах'),
(127, 43, 'az', 'Qəbələ'),
(128, 43, 'en', 'Gabala'),
(129, 43, 'ru', 'Габала'),
(130, 44, 'az', 'Qobustan'),
(131, 44, 'en', 'Gobustan'),
(132, 44, 'ru', 'Гобустан'),
(133, 45, 'az', 'Quba'),
(134, 45, 'en', 'Guba'),
(135, 45, 'ru', 'Губа'),
(136, 46, 'az', 'Qubadlı'),
(137, 46, 'en', 'Gubadly'),
(138, 46, 'ru', 'Губадлы'),
(139, 47, 'az', 'Qusar'),
(140, 47, 'en', 'Gusar'),
(141, 47, 'ru', 'Гусар'),
(142, 48, 'az', 'Saatlı'),
(143, 48, 'en', 'Saatly'),
(144, 48, 'ru', 'Саатлы'),
(145, 49, 'az', 'Sabirabad'),
(146, 49, 'en', 'Sabirabad'),
(147, 49, 'ru', 'Сабирабад'),
(148, 50, 'az', 'Şabran'),
(149, 50, 'en', 'Shabran'),
(150, 50, 'ru', 'Шабран'),
(151, 51, 'az', 'Şahbuz'),
(152, 51, 'en', 'Shakhbuz'),
(153, 51, 'ru', 'Шахбуз'),
(154, 52, 'az', 'Salyan'),
(155, 52, 'en', 'Salyan'),
(156, 52, 'ru', 'Сальян'),
(157, 53, 'az', 'Şamaxı'),
(158, 53, 'en', 'Shamakhi'),
(159, 53, 'ru', 'Шамахы'),
(160, 54, 'az', 'Samux'),
(161, 54, 'en', 'Samukh'),
(162, 54, 'ru', 'Самух'),
(163, 55, 'az', 'Şəki'),
(164, 55, 'en', 'Shaki'),
(165, 55, 'ru', 'Шеки'),
(166, 56, 'az', 'Şəmkir'),
(167, 56, 'en', 'Shamkir'),
(168, 56, 'ru', 'Шамкир'),
(169, 57, 'az', 'Şərur'),
(170, 57, 'en', 'Sharur'),
(171, 57, 'ru', 'Шарур'),
(172, 58, 'az', 'Şirvan'),
(173, 58, 'en', 'Shirvan'),
(174, 58, 'ru', 'Ширван'),
(175, 59, 'az', 'Siyəzən'),
(176, 59, 'en', 'Siyazan'),
(177, 59, 'ru', 'Сиазань'),
(178, 60, 'az', 'Sumqayıt'),
(179, 60, 'en', 'Sumgayit'),
(180, 60, 'ru', 'Сумгайыт'),
(181, 61, 'az', 'Şuşa'),
(182, 61, 'en', 'Shusha'),
(183, 61, 'ru', 'Шуша'),
(184, 62, 'az', 'Tərtər'),
(185, 62, 'en', 'Tartar'),
(186, 62, 'ru', 'Тертер'),
(187, 63, 'az', 'Tovuz'),
(188, 63, 'en', 'Tovuz'),
(189, 63, 'ru', 'Товуз'),
(190, 64, 'az', 'Ucar'),
(191, 64, 'en', 'Ujar'),
(192, 64, 'ru', 'Уджар'),
(193, 65, 'az', 'Xaçmaz'),
(194, 65, 'en', 'Khachmaz'),
(195, 65, 'ru', 'Хачмаз'),
(196, 66, 'az', 'Xankəndi'),
(197, 66, 'en', 'Khankendi'),
(198, 66, 'ru', 'Ханкенди'),
(199, 67, 'az', 'Xırdalan'),
(200, 67, 'en', 'Khirdalan'),
(201, 67, 'ru', 'Хырдалан'),
(202, 68, 'az', 'Xızı'),
(203, 68, 'en', 'Khizi'),
(204, 68, 'ru', 'Хызы'),
(205, 69, 'az', 'Xocalı'),
(206, 69, 'en', 'Khojaly'),
(207, 69, 'ru', 'Ходжалы'),
(208, 70, 'az', 'Xocavənd'),
(209, 70, 'en', 'Khojavend'),
(210, 70, 'ru', 'Ходжаве́нд'),
(211, 71, 'az', 'Xudat'),
(212, 71, 'en', 'Khudat'),
(213, 71, 'ru', 'Худат'),
(214, 72, 'az', 'Yardımlı'),
(215, 72, 'en', 'Yardimli'),
(216, 72, 'ru', 'Ярдымлы'),
(217, 73, 'az', 'Yevlax'),
(218, 73, 'en', 'Yevlakh'),
(219, 73, 'ru', 'Евлах'),
(220, 74, 'az', 'Zaqatala'),
(221, 74, 'en', 'Zaqatala'),
(222, 74, 'ru', 'Загатала'),
(223, 75, 'az', 'Zəngilan'),
(224, 75, 'en', 'Zangilan'),
(225, 75, 'ru', 'Зангелан'),
(226, 76, 'az', 'Zərdab'),
(227, 76, 'en', 'Zardab'),
(228, 76, 'ru', 'Зардаб');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `admin_id`, `name`, `phone`, `email`, `adress`, `photo`) VALUES
(1, 3, 'Taleh Maharramov123', '505100171', 'talehmeherrem85@gmail.com', 'Baki', 'images/user/company/1678183654.png'),
(6, 11, 'Brent Martinez', '27', 'rapana@mailinator.com', 'Dolor atque quis con', 'images/user/company/1678185847.png');

-- --------------------------------------------------------

--
-- Table structure for table `company_translations`
--

CREATE TABLE `company_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_translations`
--

INSERT INTO `company_translations` (`id`, `company_id`, `locale`, `about`) VALUES
(1, 1, 'az', 'Sirketim'),
(2, 1, 'en', 'My Company'),
(3, 1, 'ru', 'May Kampaniya'),
(13, 5, 'az', '<p>Ut eveniet, incididu.</p>'),
(14, 5, 'en', '<p>Irure laborum magna .</p>'),
(15, 5, 'ru', '<p>Est possimus, cumque.</p>'),
(16, 6, 'az', '<p>Est, veritatis sint .</p>'),
(17, 6, 'en', '<p>Ea sed facere ut occ.</p>'),
(18, 6, 'ru', '<p>Quo deserunt non tem.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corporates`
--

CREATE TABLE `corporates` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corporate_translations`
--

CREATE TABLE `corporate_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `corporate_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_v_s`
--

CREATE TABLE `c_v_s` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacancy_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `created_at`, `updated_at`) VALUES
(1, '2023-02-15 12:19:25', '2023-02-15 12:19:25'),
(2, '2023-02-15 12:19:25', '2023-02-15 12:19:25'),
(3, '2023-02-15 12:19:25', '2023-02-15 12:19:25'),
(4, '2023-02-15 12:19:25', '2023-02-15 12:19:25'),
(5, '2023-02-15 12:19:25', '2023-02-15 12:19:25'),
(6, '2023-02-15 12:19:25', '2023-02-15 12:19:25'),
(7, '2023-02-15 12:19:25', '2023-02-15 12:19:25'),
(8, '2023-02-15 12:19:25', '2023-02-15 12:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `education_translations`
--

CREATE TABLE `education_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `education_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education_translations`
--

INSERT INTO `education_translations` (`id`, `education_id`, `locale`, `name`) VALUES
(1, 1, 'az', 'Vacib deyil'),
(2, 1, 'en', 'Any'),
(3, 1, 'ru', 'Не имеет значения'),
(4, 2, 'az', 'Elmi dərəcə'),
(5, 2, 'en', 'Science Degree'),
(6, 2, 'ru', 'Научная степень'),
(7, 3, 'az', 'Ali'),
(8, 3, 'en', 'Higher'),
(9, 3, 'ru', 'Высшее'),
(10, 4, 'az', 'Natamam ali'),
(11, 4, 'en', 'Incomplete Higher'),
(12, 4, 'ru', 'Неполное высшее'),
(13, 5, 'az', 'Orta texniki'),
(14, 5, 'en', 'Secondary Technical'),
(15, 5, 'ru', 'Среднее техническое'),
(16, 6, 'az', 'Orta xüsusi'),
(17, 6, 'en', 'Specialized Secondary'),
(18, 6, 'ru', 'Среднее специальное'),
(19, 7, 'az', 'Orta'),
(20, 7, 'en', 'Secondary'),
(21, 7, 'ru', 'Среднее'),
(22, 8, 'az', '-'),
(23, 8, 'en', '-'),
(24, 8, 'ru', '-');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `created_at`, `updated_at`) VALUES
(1, '2023-02-15 12:17:50', '2023-02-15 12:17:50'),
(2, '2023-02-15 12:17:50', '2023-02-15 12:17:50'),
(3, '2023-02-15 12:17:50', '2023-02-15 12:17:50'),
(4, '2023-02-15 12:17:50', '2023-02-15 12:17:50'),
(5, '2023-02-15 12:17:50', '2023-02-15 12:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `experience_translations`
--

CREATE TABLE `experience_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `experience_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience_translations`
--

INSERT INTO `experience_translations` (`id`, `experience_id`, `locale`, `name`) VALUES
(1, 1, 'az', 'Vacib deyil'),
(2, 1, 'en', 'Any'),
(3, 1, 'ru', 'Не имеет значения'),
(4, 2, 'az', '1 ildən aşağı'),
(5, 2, 'en', 'Less than 1 year'),
(6, 2, 'ru', 'Менее 1 года'),
(7, 3, 'az', '1 ildən 3 ilə qədər'),
(8, 3, 'en', 'from 1 to 3 years'),
(9, 3, 'ru', 'От 1 года до 3 лет'),
(10, 4, 'az', '3 ildən 5 ilə qədər'),
(11, 4, 'en', 'from 3 to 5 years'),
(12, 4, 'ru', 'От 3 до 5 лет'),
(13, 5, 'az', '5 ildən artıq'),
(14, 5, 'en', 'More than 5 years'),
(15, 5, 'ru', 'Более 5 лет');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `faq_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forigners`
--

CREATE TABLE `forigners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_translations`
--

CREATE TABLE `history_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `history_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content3` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_lists`
--

CREATE TABLE `mail_lists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_users` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_faqs`
--

CREATE TABLE `main_faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_11_29_124818_create_site_languages_table', 1),
(7, '2022_11_29_153348_create_categories_table', 1),
(8, '2022_11_29_153428_create_category_translations_table', 1),
(9, '2022_11_29_221350_create_contacts_table', 1),
(10, '2022_11_29_235515_create_abouts_table', 1),
(11, '2022_11_29_235608_create_about_translations_table', 1),
(13, '2022_12_01_001151_create_sessions_table', 1),
(14, '2022_12_01_150615_create_permission_tables', 1),
(15, '2022_12_05_212509_create_paylasims_table', 1),
(16, '2022_12_05_212619_create_paylasim_translations_table', 1),
(17, '2022_12_10_223146_create_newsletters_table', 1),
(18, '2022_12_20_125226_create_activity_log_table', 1),
(19, '2022_12_20_125227_add_event_column_to_activity_log_table', 1),
(20, '2022_12_20_125228_add_batch_uuid_column_to_activity_log_table', 1),
(21, '2022_12_20_214153_create_forigners_table', 1),
(22, '2022_12_21_132433_create_views_table', 1),
(23, '2022_12_21_211129_create_sliders_table', 1),
(24, '2023_01_03_121913_create_mail_lists_table', 1),
(25, '2023_01_31_110809_create_slider_translations_table', 1),
(26, '2023_01_31_122524_create_menus_table', 1),
(27, '2023_01_31_163200_create_productlists_table', 1),
(28, '2023_01_31_164003_create_productlist_translations_table', 1),
(29, '2023_02_01_102035_create_about_companies_table', 1),
(30, '2023_02_01_142033_create_our_brands_table', 1),
(31, '2023_02_01_163237_create_statistics_table', 1),
(32, '2023_02_02_130653_create_histories_table', 1),
(33, '2023_02_02_134323_create_history_translations_table', 1),
(35, '2023_02_03_125604_create_vacancy_translations_table', 1),
(36, '2023_02_04_110403_create_faqs_table', 1),
(37, '2023_02_04_110716_create_faq_translations_table', 1),
(38, '2023_02_04_140338_create_teams_table', 1),
(39, '2023_02_04_140519_create_team_translations_table', 1),
(40, '2023_02_04_163213_create_projects_table', 1),
(41, '2023_02_04_163230_create_project_translations_table', 1),
(42, '2023_02_06_110837_create_c_v_s_table', 1),
(43, '2023_02_06_144627_create_project_photos_table', 1),
(46, '2023_02_07_145514_create_products_table', 1),
(47, '2023_02_07_145529_create_product_translations_table', 1),
(48, '2023_02_08_111555_create_certificates_table', 1),
(49, '2023_02_08_111728_create_certificate_translations_table', 1),
(50, '2023_02_08_144003_create_corporates_table', 1),
(51, '2023_02_08_144033_create_successes_table', 1),
(52, '2023_02_08_144134_create_success_translations_table', 1),
(53, '2023_02_08_145002_create_corporate_translations_table', 1),
(54, '2023_02_09_104250_create_news_table', 1),
(55, '2023_02_09_104348_create_news_translations_table', 1),
(56, '2023_02_09_142201_create_services_table', 1),
(57, '2023_02_09_142218_create_service_translations_table', 1),
(58, '2023_02_10_130709_create_catalogs_table', 1),
(59, '2023_02_10_130802_create_catalog_translations_table', 1),
(60, '2023_02_10_141359_create_catalog_photos_table', 1),
(61, '2023_02_11_154426_create_supports_table', 1),
(62, '2023_02_11_154454_create_support_translations_table', 1),
(63, '2023_02_13_115819_create_cities_table', 2),
(64, '2023_02_13_115843_create_city_translations_table', 2),
(65, '2023_02_13_160713_create_admins_table', 3),
(66, '2023_02_15_121553_create_salaries_table', 4),
(67, '2023_02_15_121628_create_salary_translations_table', 4),
(68, '2023_02_15_151846_create_education_table', 5),
(69, '2023_02_15_151932_create_experiences_table', 5),
(70, '2023_02_15_151948_create_education_translations_table', 5),
(71, '2023_02_15_152058_create_experience_translations_table', 5),
(75, '2023_02_07_100339_create_alt_categories_table', 8),
(76, '2023_02_07_100413_create_altcategory_translations_table', 9),
(77, '2022_11_30_010012_create_settings_table', 10),
(78, '2023_02_16_160135_create_modes_table', 11),
(79, '2023_02_16_160207_create_mode_translations_table', 11),
(80, '2023_02_17_104538_create_site_users_table', 12),
(82, '2023_02_03_124706_create_vacancies_table', 13),
(83, '2023_02_17_155628_create_main_faqs_table', 14),
(84, '2023_02_20_174328_create_our_brand_translations_table', 14),
(85, '2023_02_28_163208_create_packages_table', 14),
(86, '2023_02_28_163250_create_package_translations_table', 14),
(88, '2023_03_01_173220_create_package_components_table', 15),
(89, '2023_03_01_173419_create_package_component_translations_table', 1),
(90, '2023_03_02_171058_create_companies_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 1),
(14, 'App\\Models\\User', 1),
(15, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 1),
(18, 'App\\Models\\User', 1),
(19, 'App\\Models\\User', 1),
(20, 'App\\Models\\User', 1),
(21, 'App\\Models\\User', 1),
(22, 'App\\Models\\User', 1),
(23, 'App\\Models\\User', 1),
(24, 'App\\Models\\User', 1),
(25, 'App\\Models\\User', 1),
(26, 'App\\Models\\User', 1),
(27, 'App\\Models\\User', 1),
(28, 'App\\Models\\User', 1),
(29, 'App\\Models\\User', 1),
(30, 'App\\Models\\User', 1),
(31, 'App\\Models\\User', 1),
(32, 'App\\Models\\User', 1),
(33, 'App\\Models\\User', 1),
(34, 'App\\Models\\User', 1),
(35, 'App\\Models\\User', 1),
(36, 'App\\Models\\User', 1),
(37, 'App\\Models\\User', 1),
(38, 'App\\Models\\User', 1),
(39, 'App\\Models\\User', 1),
(40, 'App\\Models\\User', 1),
(41, 'App\\Models\\User', 1),
(42, 'App\\Models\\User', 1),
(43, 'App\\Models\\User', 1),
(44, 'App\\Models\\User', 1),
(45, 'App\\Models\\User', 1),
(46, 'App\\Models\\User', 1),
(47, 'App\\Models\\User', 1),
(48, 'App\\Models\\User', 1),
(49, 'App\\Models\\User', 1),
(50, 'App\\Models\\User', 1),
(51, 'App\\Models\\User', 1),
(52, 'App\\Models\\User', 1),
(53, 'App\\Models\\User', 1),
(54, 'App\\Models\\User', 1),
(55, 'App\\Models\\User', 1),
(56, 'App\\Models\\User', 1),
(57, 'App\\Models\\User', 1),
(58, 'App\\Models\\User', 1),
(59, 'App\\Models\\User', 1),
(60, 'App\\Models\\User', 1),
(61, 'App\\Models\\User', 1),
(62, 'App\\Models\\User', 1),
(63, 'App\\Models\\User', 1),
(64, 'App\\Models\\User', 1),
(65, 'App\\Models\\User', 1),
(66, 'App\\Models\\User', 1),
(67, 'App\\Models\\User', 1),
(68, 'App\\Models\\User', 1),
(69, 'App\\Models\\User', 1),
(70, 'App\\Models\\User', 1),
(71, 'App\\Models\\User', 1),
(72, 'App\\Models\\User', 1),
(73, 'App\\Models\\User', 1),
(74, 'App\\Models\\User', 1),
(75, 'App\\Models\\User', 1),
(76, 'App\\Models\\User', 1),
(77, 'App\\Models\\User', 1),
(78, 'App\\Models\\User', 1),
(79, 'App\\Models\\User', 1),
(80, 'App\\Models\\User', 1),
(81, 'App\\Models\\User', 1),
(82, 'App\\Models\\User', 1),
(83, 'App\\Models\\User', 1),
(84, 'App\\Models\\User', 1),
(85, 'App\\Models\\User', 1),
(86, 'App\\Models\\User', 1),
(87, 'App\\Models\\User', 1),
(88, 'App\\Models\\User', 1),
(89, 'App\\Models\\User', 1),
(90, 'App\\Models\\User', 1),
(91, 'App\\Models\\User', 1),
(92, 'App\\Models\\User', 1),
(93, 'App\\Models\\User', 1),
(94, 'App\\Models\\User', 1),
(95, 'App\\Models\\User', 1),
(96, 'App\\Models\\User', 1),
(97, 'App\\Models\\User', 1),
(98, 'App\\Models\\User', 1),
(99, 'App\\Models\\User', 1),
(100, 'App\\Models\\User', 1),
(101, 'App\\Models\\User', 1),
(102, 'App\\Models\\User', 1),
(103, 'App\\Models\\User', 1),
(104, 'App\\Models\\User', 1),
(105, 'App\\Models\\User', 1),
(106, 'App\\Models\\User', 1),
(107, 'App\\Models\\User', 1),
(108, 'App\\Models\\User', 1),
(109, 'App\\Models\\User', 1),
(110, 'App\\Models\\User', 1),
(111, 'App\\Models\\User', 1),
(112, 'App\\Models\\User', 1),
(113, 'App\\Models\\User', 1),
(114, 'App\\Models\\User', 1),
(115, 'App\\Models\\User', 1),
(116, 'App\\Models\\User', 1),
(117, 'App\\Models\\User', 1),
(118, 'App\\Models\\User', 1),
(119, 'App\\Models\\User', 1),
(120, 'App\\Models\\User', 1),
(121, 'App\\Models\\User', 1),
(122, 'App\\Models\\User', 1),
(123, 'App\\Models\\User', 1),
(126, 'App\\Models\\User', 1),
(127, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 2),
(6, 'App\\Models\\User', 2),
(7, 'App\\Models\\User', 2),
(8, 'App\\Models\\User', 2),
(9, 'App\\Models\\User', 2),
(10, 'App\\Models\\User', 2),
(11, 'App\\Models\\User', 2),
(12, 'App\\Models\\User', 2),
(13, 'App\\Models\\User', 2),
(14, 'App\\Models\\User', 2),
(15, 'App\\Models\\User', 2),
(16, 'App\\Models\\User', 2),
(17, 'App\\Models\\User', 2),
(18, 'App\\Models\\User', 2),
(19, 'App\\Models\\User', 2),
(20, 'App\\Models\\User', 2),
(21, 'App\\Models\\User', 2),
(22, 'App\\Models\\User', 2),
(23, 'App\\Models\\User', 2),
(24, 'App\\Models\\User', 2),
(25, 'App\\Models\\User', 2),
(26, 'App\\Models\\User', 2),
(27, 'App\\Models\\User', 2),
(28, 'App\\Models\\User', 2),
(29, 'App\\Models\\User', 2),
(30, 'App\\Models\\User', 2),
(31, 'App\\Models\\User', 2),
(32, 'App\\Models\\User', 2),
(33, 'App\\Models\\User', 2),
(34, 'App\\Models\\User', 2),
(35, 'App\\Models\\User', 2),
(36, 'App\\Models\\User', 2),
(37, 'App\\Models\\User', 2),
(38, 'App\\Models\\User', 2),
(39, 'App\\Models\\User', 2),
(40, 'App\\Models\\User', 2),
(41, 'App\\Models\\User', 2),
(42, 'App\\Models\\User', 2),
(43, 'App\\Models\\User', 2),
(44, 'App\\Models\\User', 2),
(45, 'App\\Models\\User', 2),
(46, 'App\\Models\\User', 2),
(47, 'App\\Models\\User', 2),
(48, 'App\\Models\\User', 2),
(49, 'App\\Models\\User', 2),
(50, 'App\\Models\\User', 2),
(51, 'App\\Models\\User', 2),
(52, 'App\\Models\\User', 2),
(53, 'App\\Models\\User', 2),
(54, 'App\\Models\\User', 2),
(55, 'App\\Models\\User', 2),
(56, 'App\\Models\\User', 2),
(57, 'App\\Models\\User', 2),
(58, 'App\\Models\\User', 2),
(59, 'App\\Models\\User', 2),
(60, 'App\\Models\\User', 2),
(61, 'App\\Models\\User', 2),
(62, 'App\\Models\\User', 2),
(63, 'App\\Models\\User', 2),
(64, 'App\\Models\\User', 2),
(65, 'App\\Models\\User', 2),
(66, 'App\\Models\\User', 2),
(67, 'App\\Models\\User', 2),
(68, 'App\\Models\\User', 2),
(69, 'App\\Models\\User', 2),
(70, 'App\\Models\\User', 2),
(71, 'App\\Models\\User', 2),
(72, 'App\\Models\\User', 2),
(73, 'App\\Models\\User', 2),
(74, 'App\\Models\\User', 2),
(75, 'App\\Models\\User', 2),
(76, 'App\\Models\\User', 2),
(77, 'App\\Models\\User', 2),
(78, 'App\\Models\\User', 2),
(79, 'App\\Models\\User', 2),
(80, 'App\\Models\\User', 2),
(81, 'App\\Models\\User', 2),
(82, 'App\\Models\\User', 2),
(83, 'App\\Models\\User', 2),
(84, 'App\\Models\\User', 2),
(85, 'App\\Models\\User', 2),
(86, 'App\\Models\\User', 2),
(87, 'App\\Models\\User', 2),
(88, 'App\\Models\\User', 2),
(89, 'App\\Models\\User', 2),
(90, 'App\\Models\\User', 2),
(91, 'App\\Models\\User', 2),
(92, 'App\\Models\\User', 2),
(93, 'App\\Models\\User', 2),
(94, 'App\\Models\\User', 2),
(95, 'App\\Models\\User', 2),
(96, 'App\\Models\\User', 2),
(97, 'App\\Models\\User', 2),
(98, 'App\\Models\\User', 2),
(99, 'App\\Models\\User', 2),
(100, 'App\\Models\\User', 2),
(101, 'App\\Models\\User', 2),
(102, 'App\\Models\\User', 2),
(103, 'App\\Models\\User', 2),
(104, 'App\\Models\\User', 2),
(105, 'App\\Models\\User', 2),
(106, 'App\\Models\\User', 2),
(107, 'App\\Models\\User', 2),
(108, 'App\\Models\\User', 2),
(109, 'App\\Models\\User', 2),
(110, 'App\\Models\\User', 2),
(111, 'App\\Models\\User', 2),
(112, 'App\\Models\\User', 2),
(113, 'App\\Models\\User', 2),
(114, 'App\\Models\\User', 2),
(115, 'App\\Models\\User', 2),
(116, 'App\\Models\\User', 2),
(117, 'App\\Models\\User', 2),
(118, 'App\\Models\\User', 2),
(119, 'App\\Models\\User', 2),
(120, 'App\\Models\\User', 2),
(121, 'App\\Models\\User', 2),
(122, 'App\\Models\\User', 2),
(123, 'App\\Models\\User', 2),
(126, 'App\\Models\\User', 2),
(127, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 3),
(6, 'App\\Models\\User', 3),
(7, 'App\\Models\\User', 3),
(8, 'App\\Models\\User', 3),
(9, 'App\\Models\\User', 3),
(10, 'App\\Models\\User', 3),
(11, 'App\\Models\\User', 3),
(12, 'App\\Models\\User', 3),
(13, 'App\\Models\\User', 3),
(14, 'App\\Models\\User', 3),
(15, 'App\\Models\\User', 3),
(16, 'App\\Models\\User', 3),
(17, 'App\\Models\\User', 3),
(18, 'App\\Models\\User', 3),
(19, 'App\\Models\\User', 3),
(20, 'App\\Models\\User', 3),
(21, 'App\\Models\\User', 3),
(22, 'App\\Models\\User', 3),
(23, 'App\\Models\\User', 3),
(24, 'App\\Models\\User', 3),
(25, 'App\\Models\\User', 3),
(26, 'App\\Models\\User', 3),
(27, 'App\\Models\\User', 3),
(28, 'App\\Models\\User', 3),
(29, 'App\\Models\\User', 3),
(30, 'App\\Models\\User', 3),
(31, 'App\\Models\\User', 3),
(32, 'App\\Models\\User', 3),
(33, 'App\\Models\\User', 3),
(34, 'App\\Models\\User', 3),
(35, 'App\\Models\\User', 3),
(36, 'App\\Models\\User', 3),
(37, 'App\\Models\\User', 3),
(38, 'App\\Models\\User', 3),
(39, 'App\\Models\\User', 3),
(40, 'App\\Models\\User', 3),
(41, 'App\\Models\\User', 3),
(42, 'App\\Models\\User', 3),
(43, 'App\\Models\\User', 3),
(44, 'App\\Models\\User', 3),
(45, 'App\\Models\\User', 3),
(46, 'App\\Models\\User', 3),
(47, 'App\\Models\\User', 3),
(48, 'App\\Models\\User', 3),
(49, 'App\\Models\\User', 3),
(50, 'App\\Models\\User', 3),
(51, 'App\\Models\\User', 3),
(52, 'App\\Models\\User', 3),
(53, 'App\\Models\\User', 3),
(54, 'App\\Models\\User', 3),
(55, 'App\\Models\\User', 3),
(56, 'App\\Models\\User', 3),
(57, 'App\\Models\\User', 3),
(58, 'App\\Models\\User', 3),
(59, 'App\\Models\\User', 3),
(60, 'App\\Models\\User', 3),
(61, 'App\\Models\\User', 3),
(62, 'App\\Models\\User', 3),
(63, 'App\\Models\\User', 3),
(64, 'App\\Models\\User', 3),
(65, 'App\\Models\\User', 3),
(66, 'App\\Models\\User', 3),
(67, 'App\\Models\\User', 3),
(68, 'App\\Models\\User', 3),
(69, 'App\\Models\\User', 3),
(70, 'App\\Models\\User', 3),
(71, 'App\\Models\\User', 3),
(72, 'App\\Models\\User', 3),
(73, 'App\\Models\\User', 3),
(74, 'App\\Models\\User', 3),
(75, 'App\\Models\\User', 3),
(76, 'App\\Models\\User', 3),
(77, 'App\\Models\\User', 3),
(78, 'App\\Models\\User', 3),
(79, 'App\\Models\\User', 3),
(80, 'App\\Models\\User', 3),
(81, 'App\\Models\\User', 3),
(82, 'App\\Models\\User', 3),
(83, 'App\\Models\\User', 3),
(84, 'App\\Models\\User', 3),
(85, 'App\\Models\\User', 3),
(86, 'App\\Models\\User', 3),
(87, 'App\\Models\\User', 3),
(88, 'App\\Models\\User', 3),
(89, 'App\\Models\\User', 3),
(90, 'App\\Models\\User', 3),
(91, 'App\\Models\\User', 3),
(92, 'App\\Models\\User', 3),
(93, 'App\\Models\\User', 3),
(94, 'App\\Models\\User', 3),
(95, 'App\\Models\\User', 3),
(100, 'App\\Models\\User', 3),
(101, 'App\\Models\\User', 3),
(102, 'App\\Models\\User', 3),
(103, 'App\\Models\\User', 3),
(104, 'App\\Models\\User', 3),
(105, 'App\\Models\\User', 3),
(106, 'App\\Models\\User', 3),
(107, 'App\\Models\\User', 3),
(108, 'App\\Models\\User', 3),
(109, 'App\\Models\\User', 3),
(110, 'App\\Models\\User', 3),
(111, 'App\\Models\\User', 3),
(112, 'App\\Models\\User', 3),
(113, 'App\\Models\\User', 3),
(114, 'App\\Models\\User', 3),
(115, 'App\\Models\\User', 3),
(116, 'App\\Models\\User', 3),
(117, 'App\\Models\\User', 3),
(118, 'App\\Models\\User', 3),
(119, 'App\\Models\\User', 3),
(120, 'App\\Models\\User', 3),
(121, 'App\\Models\\User', 3),
(122, 'App\\Models\\User', 3),
(123, 'App\\Models\\User', 3),
(126, 'App\\Models\\User', 3),
(127, 'App\\Models\\User', 3),
(128, 'App\\Models\\User', 3),
(129, 'App\\Models\\User', 3),
(130, 'App\\Models\\User', 3),
(131, 'App\\Models\\User', 3),
(132, 'App\\Models\\User', 3),
(133, 'App\\Models\\User', 3),
(134, 'App\\Models\\User', 3),
(135, 'App\\Models\\User', 3),
(136, 'App\\Models\\User', 3),
(137, 'App\\Models\\User', 3),
(138, 'App\\Models\\User', 3),
(139, 'App\\Models\\User', 3),
(140, 'App\\Models\\User', 3),
(141, 'App\\Models\\User', 3),
(142, 'App\\Models\\User', 3),
(143, 'App\\Models\\User', 3),
(144, 'App\\Models\\User', 3),
(145, 'App\\Models\\User', 3),
(146, 'App\\Models\\User', 3),
(147, 'App\\Models\\User', 3),
(148, 'App\\Models\\User', 3),
(149, 'App\\Models\\User', 3),
(150, 'App\\Models\\User', 3),
(151, 'App\\Models\\User', 3),
(152, 'App\\Models\\User', 3),
(153, 'App\\Models\\User', 3),
(154, 'App\\Models\\User', 3),
(155, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 4),
(7, 'App\\Models\\User', 4),
(8, 'App\\Models\\User', 4),
(9, 'App\\Models\\User', 4),
(10, 'App\\Models\\User', 4),
(11, 'App\\Models\\User', 4),
(12, 'App\\Models\\User', 4),
(13, 'App\\Models\\User', 4),
(14, 'App\\Models\\User', 4),
(15, 'App\\Models\\User', 4),
(16, 'App\\Models\\User', 4),
(17, 'App\\Models\\User', 4),
(18, 'App\\Models\\User', 4),
(19, 'App\\Models\\User', 4),
(20, 'App\\Models\\User', 4),
(21, 'App\\Models\\User', 4),
(22, 'App\\Models\\User', 4),
(23, 'App\\Models\\User', 4),
(24, 'App\\Models\\User', 4),
(25, 'App\\Models\\User', 4),
(26, 'App\\Models\\User', 4),
(27, 'App\\Models\\User', 4),
(28, 'App\\Models\\User', 4),
(29, 'App\\Models\\User', 4),
(30, 'App\\Models\\User', 4),
(31, 'App\\Models\\User', 4),
(32, 'App\\Models\\User', 4),
(33, 'App\\Models\\User', 4),
(34, 'App\\Models\\User', 4),
(35, 'App\\Models\\User', 4),
(36, 'App\\Models\\User', 4),
(37, 'App\\Models\\User', 4),
(38, 'App\\Models\\User', 4),
(39, 'App\\Models\\User', 4),
(40, 'App\\Models\\User', 4),
(41, 'App\\Models\\User', 4),
(42, 'App\\Models\\User', 4),
(43, 'App\\Models\\User', 4),
(44, 'App\\Models\\User', 4),
(45, 'App\\Models\\User', 4),
(46, 'App\\Models\\User', 4),
(47, 'App\\Models\\User', 4),
(48, 'App\\Models\\User', 4),
(49, 'App\\Models\\User', 4),
(50, 'App\\Models\\User', 4),
(51, 'App\\Models\\User', 4),
(52, 'App\\Models\\User', 4),
(53, 'App\\Models\\User', 4),
(54, 'App\\Models\\User', 4),
(55, 'App\\Models\\User', 4),
(56, 'App\\Models\\User', 4),
(57, 'App\\Models\\User', 4),
(58, 'App\\Models\\User', 4),
(59, 'App\\Models\\User', 4),
(60, 'App\\Models\\User', 4),
(61, 'App\\Models\\User', 4),
(62, 'App\\Models\\User', 4),
(63, 'App\\Models\\User', 4),
(64, 'App\\Models\\User', 4),
(65, 'App\\Models\\User', 4),
(66, 'App\\Models\\User', 4),
(67, 'App\\Models\\User', 4),
(68, 'App\\Models\\User', 4),
(69, 'App\\Models\\User', 4),
(70, 'App\\Models\\User', 4),
(71, 'App\\Models\\User', 4),
(72, 'App\\Models\\User', 4),
(73, 'App\\Models\\User', 4),
(74, 'App\\Models\\User', 4),
(75, 'App\\Models\\User', 4),
(76, 'App\\Models\\User', 4),
(77, 'App\\Models\\User', 4),
(78, 'App\\Models\\User', 4),
(79, 'App\\Models\\User', 4),
(80, 'App\\Models\\User', 4),
(81, 'App\\Models\\User', 4),
(82, 'App\\Models\\User', 4),
(83, 'App\\Models\\User', 4),
(84, 'App\\Models\\User', 4),
(85, 'App\\Models\\User', 4),
(86, 'App\\Models\\User', 4),
(87, 'App\\Models\\User', 4),
(88, 'App\\Models\\User', 4),
(89, 'App\\Models\\User', 4),
(90, 'App\\Models\\User', 4),
(91, 'App\\Models\\User', 4),
(92, 'App\\Models\\User', 4),
(93, 'App\\Models\\User', 4),
(94, 'App\\Models\\User', 4),
(95, 'App\\Models\\User', 4),
(96, 'App\\Models\\User', 4),
(97, 'App\\Models\\User', 4),
(98, 'App\\Models\\User', 4),
(99, 'App\\Models\\User', 4),
(100, 'App\\Models\\User', 4),
(101, 'App\\Models\\User', 4),
(102, 'App\\Models\\User', 4),
(103, 'App\\Models\\User', 4),
(104, 'App\\Models\\User', 4),
(105, 'App\\Models\\User', 4),
(106, 'App\\Models\\User', 4),
(107, 'App\\Models\\User', 4),
(108, 'App\\Models\\User', 4),
(109, 'App\\Models\\User', 4),
(110, 'App\\Models\\User', 4),
(111, 'App\\Models\\User', 4),
(112, 'App\\Models\\User', 4),
(113, 'App\\Models\\User', 4),
(114, 'App\\Models\\User', 4),
(115, 'App\\Models\\User', 4),
(116, 'App\\Models\\User', 4),
(117, 'App\\Models\\User', 4),
(118, 'App\\Models\\User', 4),
(119, 'App\\Models\\User', 4),
(120, 'App\\Models\\User', 4),
(121, 'App\\Models\\User', 4),
(122, 'App\\Models\\User', 4),
(123, 'App\\Models\\User', 4),
(126, 'App\\Models\\User', 4),
(127, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 6),
(7, 'App\\Models\\User', 6),
(8, 'App\\Models\\User', 6),
(9, 'App\\Models\\User', 6),
(10, 'App\\Models\\User', 6),
(11, 'App\\Models\\User', 6),
(12, 'App\\Models\\User', 6),
(13, 'App\\Models\\User', 6),
(14, 'App\\Models\\User', 6),
(15, 'App\\Models\\User', 6),
(16, 'App\\Models\\User', 6),
(17, 'App\\Models\\User', 6),
(18, 'App\\Models\\User', 6),
(19, 'App\\Models\\User', 6),
(20, 'App\\Models\\User', 6),
(21, 'App\\Models\\User', 6),
(22, 'App\\Models\\User', 6),
(23, 'App\\Models\\User', 6),
(24, 'App\\Models\\User', 6),
(25, 'App\\Models\\User', 6),
(26, 'App\\Models\\User', 6),
(27, 'App\\Models\\User', 6),
(28, 'App\\Models\\User', 6),
(29, 'App\\Models\\User', 6),
(30, 'App\\Models\\User', 6),
(31, 'App\\Models\\User', 6),
(32, 'App\\Models\\User', 6),
(33, 'App\\Models\\User', 6),
(34, 'App\\Models\\User', 6),
(35, 'App\\Models\\User', 6),
(36, 'App\\Models\\User', 6),
(37, 'App\\Models\\User', 6),
(38, 'App\\Models\\User', 6),
(39, 'App\\Models\\User', 6),
(40, 'App\\Models\\User', 6),
(41, 'App\\Models\\User', 6),
(42, 'App\\Models\\User', 6),
(43, 'App\\Models\\User', 6),
(44, 'App\\Models\\User', 6),
(45, 'App\\Models\\User', 6),
(46, 'App\\Models\\User', 6),
(47, 'App\\Models\\User', 6),
(48, 'App\\Models\\User', 6),
(49, 'App\\Models\\User', 6),
(50, 'App\\Models\\User', 6),
(51, 'App\\Models\\User', 6),
(52, 'App\\Models\\User', 6),
(53, 'App\\Models\\User', 6),
(54, 'App\\Models\\User', 6),
(55, 'App\\Models\\User', 6),
(56, 'App\\Models\\User', 6),
(57, 'App\\Models\\User', 6),
(58, 'App\\Models\\User', 6),
(59, 'App\\Models\\User', 6),
(60, 'App\\Models\\User', 6),
(61, 'App\\Models\\User', 6),
(62, 'App\\Models\\User', 6),
(63, 'App\\Models\\User', 6),
(64, 'App\\Models\\User', 6),
(65, 'App\\Models\\User', 6),
(66, 'App\\Models\\User', 6),
(67, 'App\\Models\\User', 6),
(68, 'App\\Models\\User', 6),
(69, 'App\\Models\\User', 6),
(70, 'App\\Models\\User', 6),
(71, 'App\\Models\\User', 6),
(72, 'App\\Models\\User', 6),
(73, 'App\\Models\\User', 6),
(74, 'App\\Models\\User', 6),
(75, 'App\\Models\\User', 6),
(76, 'App\\Models\\User', 6),
(77, 'App\\Models\\User', 6),
(78, 'App\\Models\\User', 6),
(79, 'App\\Models\\User', 6),
(80, 'App\\Models\\User', 6),
(81, 'App\\Models\\User', 6),
(82, 'App\\Models\\User', 6),
(83, 'App\\Models\\User', 6),
(84, 'App\\Models\\User', 6),
(85, 'App\\Models\\User', 6),
(86, 'App\\Models\\User', 6),
(87, 'App\\Models\\User', 6),
(88, 'App\\Models\\User', 6),
(89, 'App\\Models\\User', 6),
(90, 'App\\Models\\User', 6),
(91, 'App\\Models\\User', 6),
(92, 'App\\Models\\User', 6),
(93, 'App\\Models\\User', 6),
(94, 'App\\Models\\User', 6),
(95, 'App\\Models\\User', 6),
(96, 'App\\Models\\User', 6),
(97, 'App\\Models\\User', 6),
(98, 'App\\Models\\User', 6),
(99, 'App\\Models\\User', 6),
(100, 'App\\Models\\User', 6),
(101, 'App\\Models\\User', 6),
(102, 'App\\Models\\User', 6),
(103, 'App\\Models\\User', 6),
(104, 'App\\Models\\User', 6),
(105, 'App\\Models\\User', 6),
(106, 'App\\Models\\User', 6),
(107, 'App\\Models\\User', 6),
(108, 'App\\Models\\User', 6),
(109, 'App\\Models\\User', 6),
(110, 'App\\Models\\User', 6),
(111, 'App\\Models\\User', 6),
(112, 'App\\Models\\User', 6),
(113, 'App\\Models\\User', 6),
(114, 'App\\Models\\User', 6),
(115, 'App\\Models\\User', 6),
(116, 'App\\Models\\User', 6),
(117, 'App\\Models\\User', 6),
(118, 'App\\Models\\User', 6),
(119, 'App\\Models\\User', 6),
(120, 'App\\Models\\User', 6),
(121, 'App\\Models\\User', 6),
(122, 'App\\Models\\User', 6),
(123, 'App\\Models\\User', 6),
(126, 'App\\Models\\User', 6),
(127, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 7),
(6, 'App\\Models\\User', 7),
(7, 'App\\Models\\User', 7),
(8, 'App\\Models\\User', 7),
(9, 'App\\Models\\User', 7),
(10, 'App\\Models\\User', 7),
(11, 'App\\Models\\User', 7),
(12, 'App\\Models\\User', 7),
(13, 'App\\Models\\User', 7),
(14, 'App\\Models\\User', 7),
(15, 'App\\Models\\User', 7),
(16, 'App\\Models\\User', 7),
(17, 'App\\Models\\User', 7),
(18, 'App\\Models\\User', 7),
(19, 'App\\Models\\User', 7),
(20, 'App\\Models\\User', 7),
(21, 'App\\Models\\User', 7),
(22, 'App\\Models\\User', 7),
(23, 'App\\Models\\User', 7),
(24, 'App\\Models\\User', 7),
(25, 'App\\Models\\User', 7),
(26, 'App\\Models\\User', 7),
(27, 'App\\Models\\User', 7),
(28, 'App\\Models\\User', 7),
(29, 'App\\Models\\User', 7),
(30, 'App\\Models\\User', 7),
(31, 'App\\Models\\User', 7),
(32, 'App\\Models\\User', 7),
(33, 'App\\Models\\User', 7),
(34, 'App\\Models\\User', 7),
(35, 'App\\Models\\User', 7),
(36, 'App\\Models\\User', 7),
(37, 'App\\Models\\User', 7),
(38, 'App\\Models\\User', 7),
(39, 'App\\Models\\User', 7),
(40, 'App\\Models\\User', 7),
(41, 'App\\Models\\User', 7),
(42, 'App\\Models\\User', 7),
(43, 'App\\Models\\User', 7),
(44, 'App\\Models\\User', 7),
(45, 'App\\Models\\User', 7),
(46, 'App\\Models\\User', 7),
(47, 'App\\Models\\User', 7),
(48, 'App\\Models\\User', 7),
(49, 'App\\Models\\User', 7),
(50, 'App\\Models\\User', 7),
(51, 'App\\Models\\User', 7),
(52, 'App\\Models\\User', 7),
(53, 'App\\Models\\User', 7),
(54, 'App\\Models\\User', 7),
(55, 'App\\Models\\User', 7),
(56, 'App\\Models\\User', 7),
(57, 'App\\Models\\User', 7),
(58, 'App\\Models\\User', 7),
(59, 'App\\Models\\User', 7),
(60, 'App\\Models\\User', 7),
(61, 'App\\Models\\User', 7),
(62, 'App\\Models\\User', 7),
(63, 'App\\Models\\User', 7),
(64, 'App\\Models\\User', 7),
(65, 'App\\Models\\User', 7),
(66, 'App\\Models\\User', 7),
(67, 'App\\Models\\User', 7),
(68, 'App\\Models\\User', 7),
(69, 'App\\Models\\User', 7),
(70, 'App\\Models\\User', 7),
(71, 'App\\Models\\User', 7),
(72, 'App\\Models\\User', 7),
(73, 'App\\Models\\User', 7),
(74, 'App\\Models\\User', 7),
(75, 'App\\Models\\User', 7),
(76, 'App\\Models\\User', 7),
(77, 'App\\Models\\User', 7),
(78, 'App\\Models\\User', 7),
(79, 'App\\Models\\User', 7),
(80, 'App\\Models\\User', 7),
(81, 'App\\Models\\User', 7),
(82, 'App\\Models\\User', 7),
(83, 'App\\Models\\User', 7),
(84, 'App\\Models\\User', 7),
(85, 'App\\Models\\User', 7),
(86, 'App\\Models\\User', 7),
(87, 'App\\Models\\User', 7),
(88, 'App\\Models\\User', 7),
(89, 'App\\Models\\User', 7),
(90, 'App\\Models\\User', 7),
(91, 'App\\Models\\User', 7),
(92, 'App\\Models\\User', 7),
(93, 'App\\Models\\User', 7),
(94, 'App\\Models\\User', 7),
(95, 'App\\Models\\User', 7),
(96, 'App\\Models\\User', 7),
(97, 'App\\Models\\User', 7),
(98, 'App\\Models\\User', 7),
(99, 'App\\Models\\User', 7),
(100, 'App\\Models\\User', 7),
(101, 'App\\Models\\User', 7),
(102, 'App\\Models\\User', 7),
(103, 'App\\Models\\User', 7),
(104, 'App\\Models\\User', 7),
(105, 'App\\Models\\User', 7),
(106, 'App\\Models\\User', 7),
(107, 'App\\Models\\User', 7),
(108, 'App\\Models\\User', 7),
(109, 'App\\Models\\User', 7),
(110, 'App\\Models\\User', 7),
(111, 'App\\Models\\User', 7),
(112, 'App\\Models\\User', 7),
(113, 'App\\Models\\User', 7),
(114, 'App\\Models\\User', 7),
(115, 'App\\Models\\User', 7),
(116, 'App\\Models\\User', 7),
(117, 'App\\Models\\User', 7),
(118, 'App\\Models\\User', 7),
(119, 'App\\Models\\User', 7),
(120, 'App\\Models\\User', 7),
(121, 'App\\Models\\User', 7),
(122, 'App\\Models\\User', 7),
(123, 'App\\Models\\User', 7),
(126, 'App\\Models\\User', 7),
(127, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modes`
--

CREATE TABLE `modes` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modes`
--

INSERT INTO `modes` (`id`, `created_at`, `updated_at`) VALUES
(2, '2023-02-16 12:21:34', '2023-02-16 12:21:34'),
(3, '2023-02-16 12:21:34', '2023-02-16 12:21:34'),
(4, '2023-02-16 12:21:34', '2023-02-16 12:21:34'),
(5, '2023-02-16 12:21:34', '2023-02-16 12:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `mode_translations`
--

CREATE TABLE `mode_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `mode_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_translations`
--

INSERT INTO `mode_translations` (`id`, `mode_id`, `locale`, `name`) VALUES
(6, 2, 'az', 'Tam ştat'),
(7, 2, 'en', 'Full time'),
(8, 2, 'ru', 'На постоянной основе'),
(9, 3, 'az', 'Frinlans'),
(10, 3, 'en', 'Freelance'),
(11, 3, 'ru', 'Фриланс'),
(12, 4, 'az', 'Yarım ştat'),
(13, 4, 'en', 'Part time'),
(14, 4, 'ru', 'Неполная занятость'),
(15, 5, 'az', 'Təcrübəçi'),
(16, 5, 'en', 'Intern'),
(17, 5, 'ru', 'Стажер');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint UNSIGNED NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_translations`
--

CREATE TABLE `news_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `news_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content3` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `our_brands`
--

CREATE TABLE `our_brands` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `our_brand_translations`
--

CREATE TABLE `our_brand_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `ads_count` int NOT NULL,
  `monthly_payment` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `ads_count`, `monthly_payment`, `status`, `created_at`, `updated_at`) VALUES
(1, 39, 43, 1, '2023-03-01 11:04:36', '2023-03-02 08:23:13'),
(3, 80, 92, 1, '2023-03-01 11:50:41', '2023-03-01 11:50:41'),
(4, 97, 23, 1, '2023-03-01 11:51:00', '2023-03-01 11:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `package_components`
--

CREATE TABLE `package_components` (
  `id` int UNSIGNED NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_components`
--

INSERT INTO `package_components` (`id`, `package_id`) VALUES
(2, 1),
(3, 1),
(4, 3),
(5, 3),
(6, 4),
(7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `package_component_translations`
--

CREATE TABLE `package_component_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `package_component_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_component_translations`
--

INSERT INTO `package_component_translations` (`id`, `package_component_id`, `locale`, `title`) VALUES
(1, 1, 'az', 'Voluptas qui provide'),
(2, 1, 'en', 'In cupidatat quam ea'),
(3, 1, 'ru', 'Aliqua Nisi explica'),
(4, 2, 'az', 'sasasasas'),
(5, 2, 'en', 'birden 5 e'),
(6, 2, 'ru', 'Ut esse quam nihil a'),
(7, 3, 'az', 'Aliquam inventore la'),
(8, 3, 'en', 'Aut autem et qui qua'),
(9, 3, 'ru', 'Hic ratione adipisci'),
(10, 4, 'az', 'Voluptatem exercita'),
(11, 4, 'en', 'Id et obcaecati ulla'),
(12, 4, 'ru', 'Eum fugit aliquid e'),
(13, 5, 'az', 'Aute doloremque aliq'),
(14, 5, 'en', 'Beatae sit rem cupi'),
(15, 5, 'ru', 'Dolor excepteur prae'),
(16, 6, 'az', 'Laboriosam impedit'),
(17, 6, 'en', 'Enim quia nisi quide'),
(18, 6, 'ru', 'Dolore est unde cons'),
(19, 7, 'az', 'elanlar elan'),
(20, 7, 'en', 'Vitae odio quasi exc'),
(21, 7, 'ru', 'Eiusmod nostrum eos'),
(22, 8, 'az', 'Possimus ut elit e'),
(23, 8, 'en', 'Id in distinctio A'),
(24, 8, 'ru', 'Et lorem ut sit ill');

-- --------------------------------------------------------

--
-- Table structure for table `package_translations`
--

CREATE TABLE `package_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_translations`
--

INSERT INTO `package_translations` (`id`, `package_id`, `locale`, `title`, `description`) VALUES
(1, 1, 'az', 'Id harum eu do maio', 'Occaecat aliquam et'),
(2, 1, 'en', 'Aut ut irure ut solu', 'Quaerat similique du'),
(3, 1, 'ru', 'Ut velit sit volup', 'Est saepe veniam c'),
(7, 3, 'az', 'Aut nisi veniam neq', 'Est id beatae nisi'),
(8, 3, 'en', 'Sunt iusto perspicia', 'Maxime consectetur'),
(9, 3, 'ru', 'Modi consequatur et', 'Magni eos anim facil'),
(10, 4, 'az', 'Fuga Aut excepturi', 'Omnis voluptate id q'),
(11, 4, 'en', 'Doloribus quis labor', 'Rerum minus et est n'),
(12, 4, 'ru', 'Doloribus proident', 'Eu nobis anim elit');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paylasims`
--

CREATE TABLE `paylasims` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_status` tinyint(1) NOT NULL,
  `admin_id` int NOT NULL,
  `view_count` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paylasim_translations`
--

CREATE TABLE `paylasim_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `paylasim_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'menus index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(2, 'menus create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(3, 'menus delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(4, 'menus edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(5, 'posts index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(6, 'posts create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(7, 'posts edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(8, 'posts delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(9, 'slider index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(10, 'slider create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(11, 'slider edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(12, 'slider delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(13, 'directors index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(14, 'directors create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(15, 'directors edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(16, 'directors delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(17, 'about index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(18, 'about edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(19, 'categories index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(20, 'categories create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(21, 'categories edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(22, 'categories delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(23, 'forigners index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(24, 'forigners create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(25, 'forigners edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(26, 'forigners delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(27, 'languages index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(28, 'languages create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(29, 'languages edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(30, 'languages delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(31, 'contact-us index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(32, 'contact-us delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(33, 'settings index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(34, 'settings create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(35, 'settings edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(36, 'settings delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(37, 'seo-tags index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(38, 'seo-tags create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(39, 'seo-tags edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(40, 'seo-tags delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(41, 'users index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(42, 'users create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(43, 'users edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(44, 'users delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(45, 'permissions index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(46, 'permissions create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(47, 'permissions edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(48, 'permissions delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(49, 'new-permission index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(50, 'new-permission create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(51, 'new-permission edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(52, 'new-permission delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(53, 'report index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(54, 'report delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(55, 'information index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(56, 'information create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(57, 'information edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(58, 'information delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(59, 'dashboard index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(60, 'confirm-post', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(61, 'newsletter index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(62, 'newsletter create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(63, 'newsletter delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(64, 'team index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(65, 'team create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(66, 'team edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(67, 'team delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(68, 'projects create', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(69, 'projects edit', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(70, 'projects delete', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(71, 'projects index', 'web', '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(72, 'products create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(73, 'products edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(74, 'products delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(75, 'products index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(76, 'alt-categories create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(77, 'alt-categories edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(78, 'alt-categories delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(79, 'alt-categories index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(80, 'history edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(81, 'history index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(82, 'vacancy create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(83, 'vacancy edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(84, 'vacancy delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(85, 'vacancy index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(86, 'appeals index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(87, 'appeals delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(88, 'news create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(89, 'news edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(90, 'news delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(91, 'news index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(92, 'corporate create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(93, 'corporate edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(94, 'corporate delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(95, 'corporate index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(96, 'our-success create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(97, 'our-success edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(98, 'our-success delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(99, 'our-success index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(100, 'company-and-products create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(101, 'company-and-products edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(102, 'company-and-products delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(103, 'company-and-products index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(104, 'services create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(105, 'services edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(106, 'services delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(107, 'services index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(108, 'certificates create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(109, 'certificates edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(110, 'certificates delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(111, 'certificates index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(112, 'brands create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(113, 'brands edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(114, 'brands delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(115, 'brands index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(116, 'statistics create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(117, 'statistics edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(118, 'statistics delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(119, 'statistics index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(120, 'faq create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(121, 'faq edit', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(122, 'faq delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(123, 'faq index', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(126, 'catalog create', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(127, 'catalog delete', 'web', '2023-02-13 07:42:03', '2023-02-13 07:42:03'),
(128, 'city index', 'web', '2023-02-15 07:09:44', '2023-02-15 07:09:44'),
(129, 'city edit', 'web', '2023-02-15 07:09:50', '2023-02-15 07:09:50'),
(130, 'city create', 'web', '2023-02-15 07:09:57', '2023-02-15 07:09:57'),
(131, 'city delete', 'web', '2023-02-15 07:11:04', '2023-02-15 07:11:04'),
(132, 'salary index', 'web', '2023-02-15 09:44:24', '2023-02-15 09:44:24'),
(133, 'salary edit', 'web', '2023-02-15 09:44:37', '2023-02-15 09:44:37'),
(134, 'salary create', 'web', '2023-02-15 09:44:46', '2023-02-15 09:44:46'),
(135, 'salary delete', 'web', '2023-02-15 09:45:02', '2023-02-15 09:45:02'),
(136, 'education index', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(137, 'education create', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(138, 'education edit', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(139, 'education delete', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(140, 'experience index', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(141, 'experience create', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(142, 'experience edit', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(143, 'experience delete', 'web', '2023-02-15 12:46:36', '2023-02-15 12:46:36'),
(144, 'mode index', 'web', '2023-02-16 12:28:03', '2023-02-16 12:28:03'),
(145, 'mode create', 'web', '2023-02-16 12:28:03', '2023-02-16 12:28:03'),
(146, 'mode edit', 'web', '2023-02-16 12:28:03', '2023-02-16 12:28:03'),
(147, 'mode delete', 'web', '2023-02-16 12:28:03', '2023-02-16 12:28:03'),
(148, 'packages index', 'web', '2023-02-28 12:36:13', '2023-02-28 12:36:13'),
(149, 'packages create', 'web', '2023-02-28 12:36:14', '2023-02-28 12:36:14'),
(150, 'packages edit', 'web', '2023-02-28 12:36:14', '2023-02-28 12:36:14'),
(151, 'packages delete', 'web', '2023-02-28 12:36:14', '2023-02-28 12:36:14'),
(152, 'site-users index', 'web', '2023-03-04 08:13:28', '2023-03-04 08:13:28'),
(153, 'site-users create', 'web', '2023-03-04 08:13:28', '2023-03-04 08:13:28'),
(154, 'site-users edit', 'web', '2023-03-04 08:13:28', '2023-03-04 08:13:28'),
(155, 'site-users delete', 'web', '2023-03-04 08:13:28', '2023-03-04 08:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productlists`
--

CREATE TABLE `productlists` (
  `id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productlist_translations`
--

CREATE TABLE `productlist_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `productlist_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_photos`
--

CREATE TABLE `project_photos` (
  `id` int UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_translations`
--

CREATE TABLE `project_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content3` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint UNSIGNED NOT NULL,
  `salary` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `salary`, `created_at`, `updated_at`) VALUES
(1, 100, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(2, 200, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(3, 300, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(4, 400, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(5, 500, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(6, 600, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(7, 700, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(8, 800, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(9, 900, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(10, 1000, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(11, 1100, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(12, 1200, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(13, 1300, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(14, 1400, '2023-02-15 09:29:31', '2023-02-15 09:29:31'),
(15, 1500, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(16, 1600, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(17, 1700, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(18, 1800, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(19, 1900, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(20, 2000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(21, 2100, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(22, 2200, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(23, 2300, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(24, 2400, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(25, 2500, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(26, 2600, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(27, 2700, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(28, 2800, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(29, 2900, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(30, 3000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(31, 3100, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(32, 3200, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(33, 3300, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(34, 3400, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(35, 3500, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(36, 3600, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(37, 3700, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(38, 3800, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(39, 3900, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(40, 4000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(41, 5000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(42, 6000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(43, 7000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(44, 8000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(45, 9000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(46, 10000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(47, 11000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(48, 12000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(49, 13000, '2023-02-15 09:29:32', '2023-02-15 09:29:32'),
(50, 14000, '2023-02-15 09:29:32', '2023-02-15 09:29:32');

-- --------------------------------------------------------

--
-- Table structure for table `salary_translations`
--

CREATE TABLE `salary_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `salary_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_translations`
--

INSERT INTO `salary_translations` (`id`, `salary_id`, `locale`, `name`) VALUES
(1, 1, 'az', 'minimum 100 AZN'),
(2, 1, 'en', 'at least 100 AZN'),
(3, 1, 'ru', 'от 100 AZN'),
(4, 2, 'az', 'minimum 200 AZN'),
(5, 2, 'en', 'at least 200 AZN'),
(6, 2, 'ru', 'от 200 AZN'),
(7, 3, 'az', 'minimum 300 AZN'),
(8, 3, 'en', 'at least 300 AZN'),
(9, 3, 'ru', 'от 300 AZN'),
(10, 4, 'az', 'minimum 400 AZN'),
(11, 4, 'en', 'at least 400 AZN'),
(12, 4, 'ru', 'от 400 AZN'),
(13, 5, 'az', 'minimum 500 AZN'),
(14, 5, 'en', 'at least 500 AZN'),
(15, 5, 'ru', 'от 500 AZN'),
(16, 6, 'az', 'minimum 600 AZN'),
(17, 6, 'en', 'at least 600 AZN'),
(18, 6, 'ru', 'от 600 AZN'),
(19, 7, 'az', 'minimum 700 AZN'),
(20, 7, 'en', 'at least 700 AZN'),
(21, 7, 'ru', 'от 700 AZN'),
(22, 8, 'az', 'minimum 800 AZN'),
(23, 8, 'en', 'at least 800 AZN'),
(24, 8, 'ru', 'от 800 AZN'),
(25, 9, 'az', 'minimum 900 AZN'),
(26, 9, 'en', 'at least 900 AZN'),
(27, 9, 'ru', 'от 900 AZN'),
(28, 10, 'az', 'minimum 1000 AZN'),
(29, 10, 'en', 'at least 1000 AZN'),
(30, 10, 'ru', 'от 1000 AZN'),
(31, 11, 'az', 'minimum 1100 AZN'),
(32, 11, 'en', 'at least 1100 AZN'),
(33, 11, 'ru', 'от 1100 AZN'),
(34, 12, 'az', 'minimum 1200 AZN'),
(35, 12, 'en', 'at least 1200 AZN'),
(36, 12, 'ru', 'от 1200 AZN'),
(37, 13, 'az', 'minimum 1300 AZN'),
(38, 13, 'en', 'at least 1300 AZN'),
(39, 13, 'ru', 'от 1300 AZN'),
(40, 14, 'az', 'minimum 1400 AZN'),
(41, 14, 'en', 'at least 1400 AZN'),
(42, 14, 'ru', 'от 1400 AZN'),
(43, 15, 'az', 'minimum 1500 AZN'),
(44, 15, 'en', 'at least 1500 AZN'),
(45, 15, 'ru', 'от 1500 AZN'),
(46, 16, 'az', 'minimum 1600 AZN'),
(47, 16, 'en', 'at least 1600 AZN'),
(48, 16, 'ru', 'от 1600 AZN'),
(49, 17, 'az', 'minimum 1700 AZN'),
(50, 17, 'en', 'at least 1700 AZN'),
(51, 17, 'ru', 'от 1700 AZN'),
(52, 18, 'az', 'minimum 1800 AZN'),
(53, 18, 'en', 'at least 1800 AZN'),
(54, 18, 'ru', 'от 1800 AZN'),
(55, 19, 'az', 'minimum 1900 AZN'),
(56, 19, 'en', 'at least 1900 AZN'),
(57, 19, 'ru', 'от 1900 AZN'),
(58, 20, 'az', 'minimum 2000 AZN'),
(59, 20, 'en', 'at least 2000 AZN'),
(60, 20, 'ru', 'от 2000 AZN'),
(61, 21, 'az', 'minimum 2100 AZN'),
(62, 21, 'en', 'at least 2100 AZN'),
(63, 21, 'ru', 'от 2100 AZN'),
(64, 22, 'az', 'minimum 2200 AZN'),
(65, 22, 'en', 'at least 2200 AZN'),
(66, 22, 'ru', 'от 2200 AZN'),
(67, 23, 'az', 'minimum 2300 AZN'),
(68, 23, 'en', 'at least 2300 AZN'),
(69, 23, 'ru', 'от 2300 AZN'),
(70, 24, 'az', 'minimum 2400 AZN'),
(71, 24, 'en', 'at least 2400 AZN'),
(72, 24, 'ru', 'от 2400 AZN'),
(73, 25, 'az', 'minimum 2500 AZN'),
(74, 25, 'en', 'at least 2500 AZN'),
(75, 25, 'ru', 'от 2500 AZN'),
(76, 26, 'az', 'minimum 2600 AZN'),
(77, 26, 'en', 'at least 2600 AZN'),
(78, 26, 'ru', 'от 2600 AZN'),
(79, 27, 'az', 'minimum 2700 AZN'),
(80, 27, 'en', 'at least 2700 AZN'),
(81, 27, 'ru', 'от 2700 AZN'),
(82, 28, 'az', 'minimum 2800 AZN'),
(83, 28, 'en', 'at least 2800 AZN'),
(84, 28, 'ru', 'от 2800 AZN'),
(85, 29, 'az', 'minimum 2900 AZN'),
(86, 29, 'en', 'at least 2900 AZN'),
(87, 29, 'ru', 'от 2900 AZN'),
(88, 30, 'az', 'minimum 3000 AZN'),
(89, 30, 'en', 'at least 3000 AZN'),
(90, 30, 'ru', 'от 3000 AZN'),
(91, 31, 'az', 'minimum 3100 AZN'),
(92, 31, 'en', 'at least 3100 AZN'),
(93, 31, 'ru', 'от 3100 AZN'),
(94, 32, 'az', 'minimum 3200 AZN'),
(95, 32, 'en', 'at least 3200 AZN'),
(96, 32, 'ru', 'от 3200 AZN'),
(97, 33, 'az', 'minimum 3300 AZN'),
(98, 33, 'en', 'at least 3300 AZN'),
(99, 33, 'ru', 'от 3300 AZN'),
(100, 34, 'az', 'minimum 3400 AZN'),
(101, 34, 'en', 'at least 3400 AZN'),
(102, 34, 'ru', 'от 3400 AZN'),
(103, 35, 'az', 'minimum 3500 AZN'),
(104, 35, 'en', 'at least 3500 AZN'),
(105, 35, 'ru', 'от 3500 AZN'),
(106, 36, 'az', 'minimum 3600 AZN'),
(107, 36, 'en', 'at least 3600 AZN'),
(108, 36, 'ru', 'от 3600 AZN'),
(109, 37, 'az', 'minimum 3700 AZN'),
(110, 37, 'en', 'at least 3700 AZN'),
(111, 37, 'ru', 'от 3700 AZN'),
(112, 38, 'az', 'minimum 3800 AZN'),
(113, 38, 'en', 'at least 3800 AZN'),
(114, 38, 'ru', 'от 3800 AZN'),
(115, 39, 'az', 'minimum 3900 AZN'),
(116, 39, 'en', 'at least 3900 AZN'),
(117, 39, 'ru', 'от 3900 AZN'),
(118, 40, 'az', 'minimum 4000 AZN'),
(119, 40, 'en', 'at least 4000 AZN'),
(120, 40, 'ru', 'от 4000 AZN'),
(121, 41, 'az', 'minimum 5000 AZN'),
(122, 41, 'en', 'at least 5000 AZN'),
(123, 41, 'ru', 'от 5000 AZN'),
(124, 42, 'az', 'minimum 6000 AZN'),
(125, 42, 'en', 'at least 6000 AZN'),
(126, 42, 'ru', 'от 6000 AZN'),
(127, 43, 'az', 'minimum 7000 AZN'),
(128, 43, 'en', 'at least 7000 AZN'),
(129, 43, 'ru', 'от 7000 AZN'),
(130, 44, 'az', 'minimum 8000 AZN'),
(131, 44, 'en', 'at least 8000 AZN'),
(132, 44, 'ru', 'от 8000 AZN'),
(133, 45, 'az', 'minimum 9000 AZN'),
(134, 45, 'en', 'at least 9000 AZN'),
(135, 45, 'ru', 'от 9000 AZN'),
(136, 46, 'az', 'minimum 10000 AZN'),
(137, 46, 'en', 'at least 10000 AZN'),
(138, 46, 'ru', 'от 10000 AZN'),
(139, 47, 'az', 'minimum 11000 AZN'),
(140, 47, 'en', 'at least 11000 AZN'),
(141, 47, 'ru', 'от 11000 AZN'),
(142, 48, 'az', 'minimum 12000 AZN'),
(143, 48, 'en', 'at least 12000 AZN'),
(144, 48, 'ru', 'от 12000 AZN'),
(145, 49, 'az', 'minimum 13000 AZN'),
(146, 49, 'en', 'at least 13000 AZN'),
(147, 49, 'ru', 'от 13000 AZN'),
(148, 50, 'az', 'minimum 14000 AZN'),
(149, 50, 'en', 'at least 14000 AZN'),
(150, 50, 'ru', 'от 14000 AZN');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('QoGSOuHMT9SfMEfT2WlhfjSxBUuCGHLCw7VQJJ5F', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEVINXhwWWc2aEJtNmM2VEkxZGM5cVF1YzdzZ0dDQjR5NmxDU2pBWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3QvdmFrYW50Mi9wdWJsaWMvdXNlci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1678258321),
('xkpLsnlBkmH2A5KcymOBJj3aF1nqyByX7KwNQ7MU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiQ1dHZmlZOHdPWVI1RzF1N3VHVUFieDROMHk3U3d3WlBJc1JIUlpZeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly92YWthbnQudGVzdCI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly92YWthbnQudGVzdC91c2VyL3Byb2ZpbGUiO319', 1678258387);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_languages`
--

CREATE TABLE `site_languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_languages`
--

INSERT INTO `site_languages` (`id`, `name`, `code`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Azərbaycan', 'az', 'images/flags/az.png', 1, '2023-02-13 07:42:02', '2023-02-13 07:42:02'),
(2, 'English', 'en', 'images/flags/en.jpg', 1, '2023-02-13 07:42:02', '2023-02-13 10:18:58'),
(3, 'Русский', 'ru', 'images/flags/ru.jpg', 1, '2023-02-13 07:42:02', '2023-02-13 10:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_users`
--

INSERT INTO `site_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin Vakant', 'admin@admin.az', NULL, '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm', NULL, NULL, NULL, '2023-02-17 07:25:37', '2023-02-17 07:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider_translations`
--

CREATE TABLE `slider_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `slider_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_translations`
--

CREATE TABLE `support_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `support_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `last_seen`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(3, 'Admin Vakant', 'admin@vakant.az', NULL, '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm', NULL, NULL, NULL, NULL, NULL, '2023-03-08 05:19:49', NULL, '2023-02-13 07:48:28', '2023-03-08 05:19:49'),
(4, 'Developer Vakant', 'd@vakant.az', NULL, '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm', NULL, NULL, NULL, NULL, NULL, '2023-03-07 10:15:24', NULL, '2023-02-13 07:48:28', '2023-03-07 10:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_salary` int NOT NULL,
  `max_salary` int NOT NULL,
  `education_id` int NOT NULL,
  `experience_id` int NOT NULL,
  `city_id` int NOT NULL,
  `company_type` int NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relevant_people` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candidate_requirement` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint UNSIGNED NOT NULL,
  `home_views` int NOT NULL,
  `categories_views` int NOT NULL,
  `news_views` int NOT NULL,
  `about_views` int NOT NULL,
  `contact_us_views` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_companies`
--
ALTER TABLE `about_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_translations`
--
ALTER TABLE `about_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `about_translations_about_id_locale_unique` (`about_id`,`locale`),
  ADD KEY `about_translations_locale_index` (`locale`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `altcategory_translations`
--
ALTER TABLE `altcategory_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `altcategory_translations_alt_category_id_locale_unique` (`alt_category_id`,`locale`),
  ADD KEY `altcategory_translations_locale_index` (`locale`);

--
-- Indexes for table `alt_categories`
--
ALTER TABLE `alt_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alt_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_photos`
--
ALTER TABLE `catalog_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_photos_catalog_id_foreign` (`catalog_id`);

--
-- Indexes for table `catalog_translations`
--
ALTER TABLE `catalog_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catalog_translations_catalog_id_locale_unique` (`catalog_id`,`locale`),
  ADD KEY `catalog_translations_locale_index` (`locale`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_locale_unique` (`category_id`,`locale`),
  ADD KEY `category_translations_locale_index` (`locale`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_translations_city_id_locale_unique` (`city_id`,`locale`),
  ADD KEY `city_translations_locale_index` (`locale`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `company_translations`
--
ALTER TABLE `company_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_translations_company_id_locale_unique` (`company_id`,`locale`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporates`
--
ALTER TABLE `corporates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporate_translations`
--
ALTER TABLE `corporate_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `corporate_translations_corporate_id_locale_unique` (`corporate_id`,`locale`),
  ADD KEY `corporate_translations_locale_index` (`locale`);

--
-- Indexes for table `c_v_s`
--
ALTER TABLE `c_v_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_translations`
--
ALTER TABLE `education_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `education_translations_education_id_locale_unique` (`education_id`,`locale`),
  ADD KEY `education_translations_locale_index` (`locale`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_translations`
--
ALTER TABLE `experience_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `experience_translations_experience_id_locale_unique` (`experience_id`,`locale`),
  ADD KEY `experience_translations_locale_index` (`locale`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_translations_faq_id_locale_unique` (`faq_id`,`locale`),
  ADD KEY `faq_translations_locale_index` (`locale`);

--
-- Indexes for table `forigners`
--
ALTER TABLE `forigners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_translations`
--
ALTER TABLE `history_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `history_translations_history_id_locale_unique` (`history_id`,`locale`),
  ADD KEY `history_translations_locale_index` (`locale`);

--
-- Indexes for table `mail_lists`
--
ALTER TABLE `mail_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_faqs`
--
ALTER TABLE `main_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modes`
--
ALTER TABLE `modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode_translations`
--
ALTER TABLE `mode_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mode_translations_mode_id_locale_unique` (`mode_id`,`locale`),
  ADD KEY `mode_translations_locale_index` (`locale`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_mail_unique` (`mail`);

--
-- Indexes for table `news_translations`
--
ALTER TABLE `news_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_translations_news_id_locale_unique` (`news_id`,`locale`),
  ADD KEY `news_translations_locale_index` (`locale`);

--
-- Indexes for table `our_brands`
--
ALTER TABLE `our_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_brand_translations`
--
ALTER TABLE `our_brand_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_components`
--
ALTER TABLE `package_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_components_package_id_foreign` (`package_id`);

--
-- Indexes for table `package_component_translations`
--
ALTER TABLE `package_component_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_translations_package_id_locale_unique` (`package_id`,`locale`),
  ADD KEY `package_translations_locale_index` (`locale`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paylasims`
--
ALTER TABLE `paylasims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paylasim_translations`
--
ALTER TABLE `paylasim_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paylasim_translations_paylasim_id_locale_unique` (`paylasim_id`,`locale`),
  ADD KEY `paylasim_translations_locale_index` (`locale`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `productlists`
--
ALTER TABLE `productlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productlist_translations`
--
ALTER TABLE `productlist_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productlist_translations_productlist_id_locale_unique` (`productlist_id`,`locale`),
  ADD KEY `productlist_translations_locale_index` (`locale`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_translations_product_id_locale_unique` (`product_id`,`locale`),
  ADD KEY `product_translations_locale_index` (`locale`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_photos`
--
ALTER TABLE `project_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_photos_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_translations`
--
ALTER TABLE `project_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_translations_project_id_locale_unique` (`project_id`,`locale`),
  ADD KEY `project_translations_locale_index` (`locale`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_translations`
--
ALTER TABLE `salary_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salary_translations_salary_id_locale_unique` (`salary_id`,`locale`),
  ADD KEY `salary_translations_locale_index` (`locale`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`),
  ADD KEY `service_translations_locale_index` (`locale`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_languages`
--
ALTER TABLE `site_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_users`
--
ALTER TABLE `site_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_users_email_unique` (`email`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_translations`
--
ALTER TABLE `slider_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slider_translations_slider_id_locale_unique` (`slider_id`,`locale`),
  ADD KEY `slider_translations_locale_index` (`locale`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_translations`
--
ALTER TABLE `support_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `support_translations_support_id_locale_unique` (`support_id`,`locale`),
  ADD KEY `support_translations_locale_index` (`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_companies`
--
ALTER TABLE `about_companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_translations`
--
ALTER TABLE `about_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `altcategory_translations`
--
ALTER TABLE `altcategory_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `alt_categories`
--
ALTER TABLE `alt_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `catalogs`
--
ALTER TABLE `catalogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog_photos`
--
ALTER TABLE `catalog_photos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog_translations`
--
ALTER TABLE `catalog_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `city_translations`
--
ALTER TABLE `city_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_translations`
--
ALTER TABLE `company_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corporates`
--
ALTER TABLE `corporates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corporate_translations`
--
ALTER TABLE `corporate_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_v_s`
--
ALTER TABLE `c_v_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `education_translations`
--
ALTER TABLE `education_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `experience_translations`
--
ALTER TABLE `experience_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forigners`
--
ALTER TABLE `forigners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_translations`
--
ALTER TABLE `history_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_lists`
--
ALTER TABLE `mail_lists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_faqs`
--
ALTER TABLE `main_faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `modes`
--
ALTER TABLE `modes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mode_translations`
--
ALTER TABLE `mode_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_translations`
--
ALTER TABLE `news_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `our_brands`
--
ALTER TABLE `our_brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `our_brand_translations`
--
ALTER TABLE `our_brand_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_components`
--
ALTER TABLE `package_components`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package_component_translations`
--
ALTER TABLE `package_component_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `package_translations`
--
ALTER TABLE `package_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `paylasims`
--
ALTER TABLE `paylasims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paylasim_translations`
--
ALTER TABLE `paylasim_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productlists`
--
ALTER TABLE `productlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productlist_translations`
--
ALTER TABLE `productlist_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_photos`
--
ALTER TABLE `project_photos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_translations`
--
ALTER TABLE `project_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `salary_translations`
--
ALTER TABLE `salary_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `site_languages`
--
ALTER TABLE `site_languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider_translations`
--
ALTER TABLE `slider_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_translations`
--
ALTER TABLE `support_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_translations`
--
ALTER TABLE `about_translations`
  ADD CONSTRAINT `about_translations_about_id_foreign` FOREIGN KEY (`about_id`) REFERENCES `abouts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `altcategory_translations`
--
ALTER TABLE `altcategory_translations`
  ADD CONSTRAINT `altcategory_translations_alt_category_id_foreign` FOREIGN KEY (`alt_category_id`) REFERENCES `alt_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `alt_categories`
--
ALTER TABLE `alt_categories`
  ADD CONSTRAINT `alt_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog_photos`
--
ALTER TABLE `catalog_photos`
  ADD CONSTRAINT `catalog_photos_catalog_id_foreign` FOREIGN KEY (`catalog_id`) REFERENCES `catalogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog_translations`
--
ALTER TABLE `catalog_translations`
  ADD CONSTRAINT `catalog_translations_catalog_id_foreign` FOREIGN KEY (`catalog_id`) REFERENCES `catalogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD CONSTRAINT `city_translations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `corporate_translations`
--
ALTER TABLE `corporate_translations`
  ADD CONSTRAINT `corporate_translations_corporate_id_foreign` FOREIGN KEY (`corporate_id`) REFERENCES `corporates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `education_translations`
--
ALTER TABLE `education_translations`
  ADD CONSTRAINT `education_translations_education_id_foreign` FOREIGN KEY (`education_id`) REFERENCES `education` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experience_translations`
--
ALTER TABLE `experience_translations`
  ADD CONSTRAINT `experience_translations_experience_id_foreign` FOREIGN KEY (`experience_id`) REFERENCES `experiences` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD CONSTRAINT `faq_translations_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faqs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `history_translations`
--
ALTER TABLE `history_translations`
  ADD CONSTRAINT `history_translations_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `histories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mode_translations`
--
ALTER TABLE `mode_translations`
  ADD CONSTRAINT `mode_translations_mode_id_foreign` FOREIGN KEY (`mode_id`) REFERENCES `modes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_translations`
--
ALTER TABLE `news_translations`
  ADD CONSTRAINT `news_translations_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_components`
--
ALTER TABLE `package_components`
  ADD CONSTRAINT `package_components_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD CONSTRAINT `package_translations_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paylasim_translations`
--
ALTER TABLE `paylasim_translations`
  ADD CONSTRAINT `paylasim_translations_paylasim_id_foreign` FOREIGN KEY (`paylasim_id`) REFERENCES `paylasims` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productlist_translations`
--
ALTER TABLE `productlist_translations`
  ADD CONSTRAINT `productlist_translations_productlist_id_foreign` FOREIGN KEY (`productlist_id`) REFERENCES `productlists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD CONSTRAINT `product_translations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_photos`
--
ALTER TABLE `project_photos`
  ADD CONSTRAINT `project_photos_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_translations`
--
ALTER TABLE `project_translations`
  ADD CONSTRAINT `project_translations_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_translations`
--
ALTER TABLE `salary_translations`
  ADD CONSTRAINT `salary_translations_salary_id_foreign` FOREIGN KEY (`salary_id`) REFERENCES `salaries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD CONSTRAINT `service_translations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slider_translations`
--
ALTER TABLE `slider_translations`
  ADD CONSTRAINT `slider_translations_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_translations`
--
ALTER TABLE `support_translations`
  ADD CONSTRAINT `support_translations_support_id_foreign` FOREIGN KEY (`support_id`) REFERENCES `supports` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
