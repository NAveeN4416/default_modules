-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2020 at 08:58 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `default_modules_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `link` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `lang_key` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `parent_id` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `name`, `slug`, `link`, `status`, `lang_key`, `icon`, `is_parent`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Dashbaord', 'dashbaord', 'admin/index', 1, 'dashboard', 'dashboard', 0, 0, '2020-02-07 06:41:12', '0000-00-00 00:00:00'),
(2, 'Products', 'products', 'admin/products/listall', 1, 'products', 'products icon', 0, 0, '2020-02-07 06:55:20', '0000-00-00 00:00:00'),
(3, 'Emails List', 'emails_list', 'admin/emails', 1, 'emails_list', 'info-circle', 1, 0, '2020-02-26 05:13:53', '0000-00-00 00:00:00'),
(4, 'send emails', 'send_emails', 'acp/emails/send_emails', 1, 'send_emails', 'books', 0, 3, '2020-02-26 06:54:42', '0000-00-00 00:00:00'),
(5, 'Email Subscribers', 'email_subscribers', 'admin/emails/subscribers', 1, 'email_subscribers', 'info-circle', 0, 3, '2020-02-26 10:04:58', '0000-00-00 00:00:00'),
(6, 'Sent Emails', 'sent_emails', 'acp/courses/listall', 0, 'sent_emails', 'info-circle', 0, 3, '2020-02-26 10:15:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `auth_blocked_users`
--

CREATE TABLE `auth_blocked_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `web` enum('blocked','not blocked') NOT NULL,
  `mobile` enum('blocked','not blocked') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=>Active,0=>InAcive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `group_name`, `status`, `created_at`) VALUES
(1, 'admin', '1', '2020-02-07 05:42:42'),
(2, 'developer', '1', '2020-02-07 06:56:09'),
(3, 'Manager', '1', '2020-02-19 06:38:34'),
(4, 'HR Manager', '0', '2020-02-19 13:10:43'),
(5, 'SubAdmin', '0', '2020-02-19 13:17:12'),
(6, 'HR', '0', '2020-02-24 06:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `auth_group_permissions`
--

CREATE TABLE `auth_group_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `permissions` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_group_permissions`
--

INSERT INTO `auth_group_permissions` (`id`, `group_id`, `permissions`, `created_at`) VALUES
(1, 1, '{"permissions":["admin\\/index","admin\\/products\\/listall"]}', '2020-02-24 11:34:15'),
(2, 2, '{"permissions":["admin\\/products\\/listall"]}', '2020-02-24 11:34:28'),
(3, 5, '{"permissions":["admin\\/index","admin\\/products\\/listall"]}', '2020-02-24 11:34:44'),
(4, 3, '{"permissions":["admin\\/index","admin\\/products\\/listall"]}', '2020-02-24 12:09:21'),
(5, 4, '{"permissions":["1","2","3","4","5","6"]}', '2020-02-25 16:12:59'),
(6, 6, '{"permissions":["admin\\/index","admin\\/products\\/listall"]}', '2020-02-26 15:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE `auth_users` (
  `id` int(10) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_superuser` int(1) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '0',
  `is_staff` int(11) NOT NULL DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`id`, `username`, `name`, `email`, `phone`, `password`, `is_superuser`, `is_active`, `is_staff`, `last_login`, `created_at`, `modified_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '99519293', 'MTIzNDU2', 1, 1, 1, '2020-02-03 06:47:02', '2020-02-03 06:44:30', '0000-00-00 00:00:00'),
(2, 'Developer', 'Developer', 'developer@gmail.com', '9999999999', 'MTIzNDU2', 0, 1, 1, '2020-02-03 06:47:02', '2020-02-03 06:44:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_details`
--

CREATE TABLE `auth_user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `location` varchar(500) NOT NULL,
  `device_type` text NOT NULL,
  `device_token` text NOT NULL,
  `notifications_flag` enum('send','don''t send') NOT NULL,
  `notification_timings` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_groups`
--

CREATE TABLE `auth_user_groups` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_user_groups`
--

INSERT INTO `auth_user_groups` (`id`, `group_id`, `user_id`, `created_at`) VALUES
(2, 2, 2, '2020-02-07 06:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `chat_threads`
--

CREATE TABLE `chat_threads` (
  `id` int(11) NOT NULL,
  `chat_key` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '1=>Completed, 0=>Progressing',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name_en` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name_en`, `name_ar`, `status`, `created_at`) VALUES
(1, 191, 'Riyadh ', 'الرياض', 1, '2018-11-22 06:22:56'),
(2, 191, 'Makkah ', 'مكه', 1, '2018-11-22 06:24:02'),
(3, 191, 'Medina ', 'المدينه', 1, '2018-11-22 06:24:19'),
(4, 191, 'Jeddah ', 'جده', 1, '2018-11-22 06:24:36'),
(5, 191, 'Dammam ', 'الدمام', 1, '2018-11-22 06:24:52'),
(6, 191, 'Hail', 'حائل', 1, '2018-11-22 06:25:13'),
(7, 191, 'Tabuk', 'تبوك', 1, '2018-11-22 06:25:32'),
(8, 191, 'Qassim', 'القصيم', 1, '2018-11-22 06:25:48'),
(9, 191, 'Abha ', 'أبها', 1, '2018-11-22 06:26:02'),
(10, 191, 'Baha ', 'الباحة', 1, '2018-11-22 06:26:17'),
(11, 191, 'Jazan ', 'جيزان', 1, '2018-11-22 06:26:31'),
(12, 191, 'Najran ', 'نجران', 1, '2018-11-22 06:27:08'),
(13, 191, 'Rafha ', 'رفحاء', 1, '2018-11-22 06:27:23'),
(14, 191, 'Bisha ', 'بيشه', 1, '2018-11-22 06:27:37'),
(15, 191, 'Arar ', 'عرعر', 1, '2018-11-22 06:27:55'),
(16, 191, 'Taif ', 'الطائف', 1, '2018-11-22 06:28:09'),
(17, 191, 'Hafar Al Batin', 'حفرالباطن', 1, '2018-11-22 06:28:24'),
(18, 191, 'Yanbu ', 'ينبع', 1, '2018-11-22 06:28:39'),
(19, 191, 'Sakaka ', 'سكاكا', 1, '2018-11-22 06:29:19'),
(20, 191, 'Hasa ', 'الاحساء', 1, '2018-11-22 06:31:32'),
(21, 191, 'Kharj ', 'الخرج', 1, '2018-11-22 06:31:46'),
(22, 191, 'Qurayyat ', 'القريات', 1, '2018-11-22 06:32:02'),
(23, 191, 'Jubail ', 'الجبيل', 1, '2018-11-22 06:32:13'),
(24, 191, 'Duwadmi ', 'الدوادمي', 1, '2018-11-22 06:32:28'),
(25, 191, 'Dubai ', 'دبي', 1, '2018-11-22 06:32:43'),
(26, 191, 'Kuwait ', 'الكويت', 1, '2018-11-22 06:32:56'),
(27, 191, 'Bahrain ', 'البحرين', 1, '2018-11-22 06:33:10'),
(28, 191, 'Abu Dhabi', 'ابوظبي', 1, '2018-11-22 06:33:24'),
(29, 191, 'Muscat ', 'مسقط', 1, '2018-11-22 06:33:37'),
(30, 1, 'testcity', 'testcity', 0, '2018-12-01 06:47:27'),
(31, 1, 'Hyderbad', 'Hyderbad', 0, '2018-12-04 09:46:45'),
(32, 1, 'aaa', 'aaa', 0, '2018-12-04 13:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `country_flag` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`, `priority`, `country_flag`) VALUES
(1, 'AF', 'Afghanistan', 93, 0, ''),
(2, 'AL', 'Albania', 355, 0, ''),
(3, 'DZ', 'Algeria', 213, 0, ''),
(4, 'AS', 'American Samoa', 1684, 0, ''),
(5, 'AD', 'Andorra', 376, 0, ''),
(6, 'AO', 'Angola', 244, 0, ''),
(7, 'AI', 'Anguilla', 1264, 0, ''),
(8, 'AQ', 'Antarctica', 0, 0, ''),
(9, 'AG', 'Antigua And Barbuda', 1268, 0, ''),
(10, 'AR', 'Argentina', 54, 0, ''),
(11, 'AM', 'Armenia', 374, 0, ''),
(12, 'AW', 'Aruba', 297, 0, ''),
(13, 'AU', 'Australia', 61, 0, ''),
(14, 'AT', 'Austria', 43, 0, ''),
(15, 'AZ', 'Azerbaijan', 994, 0, ''),
(16, 'BS', 'Bahamas The', 1242, 0, ''),
(17, 'BH', 'Bahrain', 973, 1, 'assets/flags/Bahrain.png'),
(18, 'BD', 'Bangladesh', 880, 0, ''),
(19, 'BB', 'Barbados', 1246, 0, ''),
(20, 'BY', 'Belarus', 375, 0, ''),
(21, 'BE', 'Belgium', 32, 0, ''),
(22, 'BZ', 'Belize', 501, 0, ''),
(23, 'BJ', 'Benin', 229, 0, ''),
(24, 'BM', 'Bermuda', 1441, 0, ''),
(25, 'BT', 'Bhutan', 975, 0, ''),
(26, 'BO', 'Bolivia', 591, 0, ''),
(27, 'BA', 'Bosnia and Herzegovina', 387, 0, ''),
(28, 'BW', 'Botswana', 267, 0, ''),
(29, 'BV', 'Bouvet Island', 0, 0, ''),
(30, 'BR', 'Brazil', 55, 0, ''),
(31, 'IO', 'British Indian Ocean Territory', 246, 0, ''),
(32, 'BN', 'Brunei', 673, 0, ''),
(33, 'BG', 'Bulgaria', 359, 0, ''),
(34, 'BF', 'Burkina Faso', 226, 0, ''),
(35, 'BI', 'Burundi', 257, 0, ''),
(36, 'KH', 'Cambodia', 855, 0, ''),
(37, 'CM', 'Cameroon', 237, 0, ''),
(38, 'CA', 'Canada', 1, 0, ''),
(39, 'CV', 'Cape Verde', 238, 0, ''),
(40, 'KY', 'Cayman Islands', 1345, 0, ''),
(41, 'CF', 'Central African Republic', 236, 0, ''),
(42, 'TD', 'Chad', 235, 0, ''),
(43, 'CL', 'Chile', 56, 0, ''),
(44, 'CN', 'China', 86, 0, ''),
(45, 'CX', 'Christmas Island', 61, 0, ''),
(46, 'CC', 'Cocos (Keeling) Islands', 672, 0, ''),
(47, 'CO', 'Colombia', 57, 0, ''),
(48, 'KM', 'Comoros', 269, 0, ''),
(49, 'CG', 'Republic Of The Congo', 242, 0, ''),
(50, 'CD', 'Democratic Republic Of The Congo', 242, 0, ''),
(51, 'CK', 'Cook Islands', 682, 0, ''),
(52, 'CR', 'Costa Rica', 506, 0, ''),
(53, 'CI', 'Cote D''Ivoire (Ivory Coast)', 225, 0, ''),
(54, 'HR', 'Croatia (Hrvatska)', 385, 0, ''),
(55, 'CU', 'Cuba', 53, 0, ''),
(56, 'CY', 'Cyprus', 357, 0, ''),
(57, 'CZ', 'Czech Republic', 420, 0, ''),
(58, 'DK', 'Denmark', 45, 0, ''),
(59, 'DJ', 'Djibouti', 253, 0, ''),
(60, 'DM', 'Dominica', 1767, 0, ''),
(61, 'DO', 'Dominican Republic', 1809, 0, ''),
(62, 'TP', 'East Timor', 670, 0, ''),
(63, 'EC', 'Ecuador', 593, 0, ''),
(64, 'EG', 'Egypt', 20, 0, ''),
(65, 'SV', 'El Salvador', 503, 0, ''),
(66, 'GQ', 'Equatorial Guinea', 240, 0, ''),
(67, 'ER', 'Eritrea', 291, 0, ''),
(68, 'EE', 'Estonia', 372, 0, ''),
(69, 'ET', 'Ethiopia', 251, 0, ''),
(70, 'XA', 'External Territories of Australia', 61, 0, ''),
(71, 'FK', 'Falkland Islands', 500, 0, ''),
(72, 'FO', 'Faroe Islands', 298, 0, ''),
(73, 'FJ', 'Fiji Islands', 679, 0, ''),
(74, 'FI', 'Finland', 358, 0, ''),
(75, 'FR', 'France', 33, 0, ''),
(76, 'GF', 'French Guiana', 594, 0, ''),
(77, 'PF', 'French Polynesia', 689, 0, ''),
(78, 'TF', 'French Southern Territories', 0, 0, ''),
(79, 'GA', 'Gabon', 241, 0, ''),
(80, 'GM', 'Gambia The', 220, 0, ''),
(81, 'GE', 'Georgia', 995, 0, ''),
(82, 'DE', 'Germany', 49, 0, ''),
(83, 'GH', 'Ghana', 233, 0, ''),
(84, 'GI', 'Gibraltar', 350, 0, ''),
(85, 'GR', 'Greece', 30, 0, ''),
(86, 'GL', 'Greenland', 299, 0, ''),
(87, 'GD', 'Grenada', 1473, 0, ''),
(88, 'GP', 'Guadeloupe', 590, 0, ''),
(89, 'GU', 'Guam', 1671, 0, ''),
(90, 'GT', 'Guatemala', 502, 0, ''),
(91, 'XU', 'Guernsey and Alderney', 44, 0, ''),
(92, 'GN', 'Guinea', 224, 0, ''),
(93, 'GW', 'Guinea-Bissau', 245, 0, ''),
(94, 'GY', 'Guyana', 592, 0, ''),
(95, 'HT', 'Haiti', 509, 0, ''),
(96, 'HM', 'Heard and McDonald Islands', 0, 0, ''),
(97, 'HN', 'Honduras', 504, 0, ''),
(98, 'HK', 'Hong Kong S.A.R.', 852, 0, ''),
(99, 'HU', 'Hungary', 36, 0, ''),
(100, 'IS', 'Iceland', 354, 0, ''),
(101, 'IN', 'India', 91, 0, ''),
(102, 'ID', 'Indonesia', 62, 0, ''),
(103, 'IR', 'Iran', 98, 0, ''),
(104, 'IQ', 'Iraq', 964, 0, 'assets/flags/iraq.png'),
(105, 'IE', 'Ireland', 353, 0, ''),
(106, 'IL', 'Israel', 972, 0, ''),
(107, 'IT', 'Italy', 39, 0, ''),
(108, 'JM', 'Jamaica', 1876, 0, ''),
(109, 'JP', 'Japan', 81, 0, ''),
(110, 'XJ', 'Jersey', 44, 0, ''),
(111, 'JO', 'Jordan', 962, 0, 'assets/flags/jordan.png'),
(112, 'KZ', 'Kazakhstan', 7, 0, ''),
(113, 'KE', 'Kenya', 254, 0, ''),
(114, 'KI', 'Kiribati', 686, 0, ''),
(115, 'KP', 'Korea North', 850, 0, ''),
(116, 'KR', 'Korea South', 82, 0, ''),
(117, 'KW', 'Kuwait', 965, 1, 'assets/flags/Kuwait.png'),
(118, 'KG', 'Kyrgyzstan', 996, 0, ''),
(119, 'LA', 'Laos', 856, 0, ''),
(120, 'LV', 'Latvia', 371, 0, ''),
(121, 'LB', 'Lebanon', 961, 0, ''),
(122, 'LS', 'Lesotho', 266, 0, ''),
(123, 'LR', 'Liberia', 231, 0, ''),
(124, 'LY', 'Libya', 218, 0, ''),
(125, 'LI', 'Liechtenstein', 423, 0, ''),
(126, 'LT', 'Lithuania', 370, 0, ''),
(127, 'LU', 'Luxembourg', 352, 0, ''),
(128, 'MO', 'Macau S.A.R.', 853, 0, ''),
(129, 'MK', 'Macedonia', 389, 0, ''),
(130, 'MG', 'Madagascar', 261, 0, ''),
(131, 'MW', 'Malawi', 265, 0, ''),
(132, 'MY', 'Malaysia', 60, 0, ''),
(133, 'MV', 'Maldives', 960, 0, ''),
(134, 'ML', 'Mali', 223, 0, ''),
(135, 'MT', 'Malta', 356, 0, ''),
(136, 'XM', 'Man (Isle of)', 44, 0, ''),
(137, 'MH', 'Marshall Islands', 692, 0, ''),
(138, 'MQ', 'Martinique', 596, 0, ''),
(139, 'MR', 'Mauritania', 222, 0, ''),
(140, 'MU', 'Mauritius', 230, 0, ''),
(141, 'YT', 'Mayotte', 269, 0, ''),
(142, 'MX', 'Mexico', 52, 0, ''),
(143, 'FM', 'Micronesia', 691, 0, ''),
(144, 'MD', 'Moldova', 373, 0, ''),
(145, 'MC', 'Monaco', 377, 0, ''),
(146, 'MN', 'Mongolia', 976, 0, ''),
(147, 'MS', 'Montserrat', 1664, 0, ''),
(148, 'MA', 'Morocco', 212, 0, ''),
(149, 'MZ', 'Mozambique', 258, 0, ''),
(150, 'MM', 'Myanmar', 95, 0, ''),
(151, 'NA', 'Namibia', 264, 0, ''),
(152, 'NR', 'Nauru', 674, 0, ''),
(153, 'NP', 'Nepal', 977, 0, ''),
(154, 'AN', 'Netherlands Antilles', 599, 0, ''),
(155, 'NL', 'Netherlands The', 31, 0, ''),
(156, 'NC', 'New Caledonia', 687, 0, ''),
(157, 'NZ', 'New Zealand', 64, 0, ''),
(158, 'NI', 'Nicaragua', 505, 0, ''),
(159, 'NE', 'Niger', 227, 0, ''),
(160, 'NG', 'Nigeria', 234, 0, ''),
(161, 'NU', 'Niue', 683, 0, ''),
(162, 'NF', 'Norfolk Island', 672, 0, ''),
(163, 'MP', 'Northern Mariana Islands', 1670, 0, ''),
(164, 'NO', 'Norway', 47, 0, ''),
(165, 'OM', 'Oman', 968, 1, 'assets/flags/oman.png'),
(166, 'PK', 'Pakistan', 92, 0, ''),
(167, 'PW', 'Palau', 680, 0, ''),
(168, 'PS', 'Palestinian Territory Occupied', 970, 0, ''),
(169, 'PA', 'Panama', 507, 0, ''),
(170, 'PG', 'Papua new Guinea', 675, 0, ''),
(171, 'PY', 'Paraguay', 595, 0, ''),
(172, 'PE', 'Peru', 51, 0, ''),
(173, 'PH', 'Philippines', 63, 0, ''),
(174, 'PN', 'Pitcairn Island', 0, 0, ''),
(175, 'PL', 'Poland', 48, 0, ''),
(176, 'PT', 'Portugal', 351, 0, ''),
(177, 'PR', 'Puerto Rico', 1787, 0, ''),
(178, 'QA', 'Qatar', 974, 1, 'assets/flags/Qatar.png'),
(179, 'RE', 'Reunion', 262, 0, ''),
(180, 'RO', 'Romania', 40, 0, ''),
(181, 'RU', 'Russia', 70, 0, ''),
(182, 'RW', 'Rwanda', 250, 0, ''),
(183, 'SH', 'Saint Helena', 290, 0, ''),
(184, 'KN', 'Saint Kitts And Nevis', 1869, 0, ''),
(185, 'LC', 'Saint Lucia', 1758, 0, ''),
(186, 'PM', 'Saint Pierre and Miquelon', 508, 0, ''),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784, 0, ''),
(188, 'WS', 'Samoa', 684, 0, ''),
(189, 'SM', 'San Marino', 378, 0, ''),
(190, 'ST', 'Sao Tome and Principe', 239, 0, ''),
(191, 'SA', 'Saudi Arabia', 966, 1, 'assets/flags/saudi.png'),
(192, 'SN', 'Senegal', 221, 0, ''),
(193, 'RS', 'Serbia', 381, 0, ''),
(194, 'SC', 'Seychelles', 248, 0, ''),
(195, 'SL', 'Sierra Leone', 232, 0, ''),
(196, 'SG', 'Singapore', 65, 0, ''),
(197, 'SK', 'Slovakia', 421, 0, ''),
(198, 'SI', 'Slovenia', 386, 0, ''),
(199, 'XG', 'Smaller Territories of the UK', 44, 0, ''),
(200, 'SB', 'Solomon Islands', 677, 0, ''),
(201, 'SO', 'Somalia', 252, 0, ''),
(202, 'ZA', 'South Africa', 27, 0, ''),
(203, 'GS', 'South Georgia', 0, 0, ''),
(204, 'SS', 'South Sudan', 211, 0, ''),
(205, 'ES', 'Spain', 34, 0, ''),
(206, 'LK', 'Sri Lanka', 94, 0, ''),
(207, 'SD', 'Sudan', 249, 0, ''),
(208, 'SR', 'Suriname', 597, 0, ''),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47, 0, ''),
(210, 'SZ', 'Swaziland', 268, 0, ''),
(211, 'SE', 'Sweden', 46, 0, ''),
(212, 'CH', 'Switzerland', 41, 0, ''),
(213, 'SY', 'Syria', 963, 0, ''),
(214, 'TW', 'Taiwan', 886, 0, ''),
(215, 'TJ', 'Tajikistan', 992, 0, ''),
(216, 'TZ', 'Tanzania', 255, 0, ''),
(217, 'TH', 'Thailand', 66, 0, ''),
(218, 'TG', 'Togo', 228, 0, ''),
(219, 'TK', 'Tokelau', 690, 0, ''),
(220, 'TO', 'Tonga', 676, 0, ''),
(221, 'TT', 'Trinidad And Tobago', 1868, 0, ''),
(222, 'TN', 'Tunisia', 216, 0, ''),
(223, 'TR', 'Turkey', 90, 0, ''),
(224, 'TM', 'Turkmenistan', 7370, 0, ''),
(225, 'TC', 'Turks And Caicos Islands', 1649, 0, ''),
(226, 'TV', 'Tuvalu', 688, 0, ''),
(227, 'UG', 'Uganda', 256, 0, ''),
(228, 'UA', 'Ukraine', 380, 0, ''),
(229, 'AE', 'United Arab Emirates', 971, 1, 'assets/flags/UAE.png'),
(230, 'GB', 'United Kingdom', 44, 0, ''),
(231, 'US', 'United States', 1, 0, ''),
(232, 'UM', 'United States Minor Outlying Islands', 1, 0, ''),
(233, 'UY', 'Uruguay', 598, 0, ''),
(234, 'UZ', 'Uzbekistan', 998, 0, ''),
(235, 'VU', 'Vanuatu', 678, 0, ''),
(236, 'VA', 'Vatican City State (Holy See)', 39, 0, ''),
(237, 'VE', 'Venezuela', 58, 0, ''),
(238, 'VN', 'Vietnam', 84, 0, ''),
(239, 'VG', 'Virgin Islands (British)', 1284, 0, ''),
(240, 'VI', 'Virgin Islands (US)', 1340, 0, ''),
(241, 'WF', 'Wallis And Futuna Islands', 681, 0, ''),
(242, 'EH', 'Western Sahara', 212, 0, ''),
(243, 'YE', 'Yemen', 967, 0, ''),
(244, 'YU', 'Yugoslavia', 38, 0, ''),
(245, 'ZM', 'Zambia', 260, 0, ''),
(246, 'ZW', 'Zimbabwe', 263, 0, ''),
(247, 'tt', 'test', 22, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `db_constants`
--

CREATE TABLE `db_constants` (
  `id` int(11) NOT NULL,
  `table_name` int(11) NOT NULL,
  `constant_name` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_address` text CHARACTER SET utf8 NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_address`, `date_created`) VALUES
(1, '963524', 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_config`
--

CREATE TABLE `login_config` (
  `id` int(11) NOT NULL,
  `web_key` varchar(20) NOT NULL,
  `mobile_key` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_config`
--

INSERT INTO `login_config` (`id`, `web_key`, `mobile_key`) VALUES
(1, 'email', 'phone');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_apis`
--

CREATE TABLE `mobile_apis` (
  `id` int(11) NOT NULL,
  `api_name` varchar(200) NOT NULL,
  `api_description` text NOT NULL,
  `api_method` varchar(100) NOT NULL,
  `http_method` varchar(100) NOT NULL,
  `status` blob NOT NULL COMMENT '1=> Works fine, 0=>Won''t Work',
  `default_authentication` enum('Authentication Required','Authentication Not Required') NOT NULL COMMENT '1=>Authentication Required, 2=>No Authentication Required',
  `authentication_type` int(11) NOT NULL,
  `check_permissions` enum('Yes','No') NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_authentications`
--

CREATE TABLE `mobile_authentications` (
  `id` int(11) NOT NULL,
  `authentication_name` int(11) NOT NULL,
  `authentication_type` int(11) NOT NULL,
  `status` blob NOT NULL COMMENT '1=>Active, 0=>InActive',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_auth_tokens`
--

CREATE TABLE `mobile_auth_tokens` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_configurations`
--

CREATE TABLE `mobile_configurations` (
  `id` int(11) NOT NULL,
  `device_type` int(11) NOT NULL,
  `configuration_dev` text NOT NULL,
  `configuration_prod` text NOT NULL,
  `mode` enum('Development','Production') NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile_configurations`
--

INSERT INTO `mobile_configurations` (`id`, `device_type`, `configuration_dev`, `configuration_prod`, `mode`, `modified_at`, `created_at`) VALUES
(1, 1, 'ada', 'asd', 'Development', '2020-02-15 10:53:46', '0000-00-00 00:00:00'),
(2, 2, 'fd', 'safd', 'Development', '2020-02-15 10:54:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_devices`
--

CREATE TABLE `mobile_devices` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `order_in_list` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile_devices`
--

INSERT INTO `mobile_devices` (`id`, `name`, `slug`, `icon_class`, `status`, `order_in_list`, `created_at`) VALUES
(1, 'Android', 'android', 'fab fa-android', '1', 1, '2020-02-15 10:51:23'),
(2, 'iOS', 'ios', 'fab fa-apple', '1', 2, '2020-02-15 10:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `notification_strings`
--

CREATE TABLE `notification_strings` (
  `id` int(11) NOT NULL,
  `api_id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `titles` text CHARACTER SET utf8 NOT NULL,
  `contents` text CHARACTER SET utf8 NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_configurations`
--

CREATE TABLE `site_configurations` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `location` text NOT NULL,
  `lang` varchar(10) NOT NULL COMMENT 'en or ar or en-ar',
  `smtp_credentials` text NOT NULL,
  `social_media` text NOT NULL,
  `site_db` enum('Development','Production') NOT NULL,
  `mode` enum('Development','Production') NOT NULL COMMENT 'Modes => Development or Production',
  `status` enum('1','0') NOT NULL COMMENT '1=>Active,0=>Under development',
  `rest_mode` enum('Development','Production') NOT NULL,
  `rest_status` enum('1','0') NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_configurations`
--

INSERT INTO `site_configurations` (`id`, `title`, `description`, `email`, `phone`, `address`, `location`, `lang`, `smtp_credentials`, `social_media`, `site_db`, `mode`, `status`, `rest_mode`, `rest_status`, `modified_at`, `created_at`) VALUES
(1, 'Site Name', 'Site Description', 'yoursite@yopmail.com', '123456789', 'Addrress of your Company', 'Latitude & Longitude of your Company', 'en', '', '', 'Production', 'Production', '1', 'Development', '0', '2020-03-03 19:40:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `third_party_configurations`
--

CREATE TABLE `third_party_configurations` (
  `id` int(11) NOT NULL,
  `type` enum('SMS','PAYMENT','BOOKINGS') NOT NULL,
  `icon_class` enum('far fa-money-bill-alt','fas fa-sms','fas fa-shopping-cart','') NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `configuration_dev` text NOT NULL,
  `configuration_prod` text NOT NULL,
  `mode` enum('Development','Production') NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=>Active,0=>InActive',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `third_party_configurations`
--

INSERT INTO `third_party_configurations` (`id`, `type`, `icon_class`, `name`, `slug`, `configuration_dev`, `configuration_prod`, `mode`, `status`, `modified_at`) VALUES
(1, 'PAYMENT', 'far fa-money-bill-alt', 'Hyperpay', 'hyperpay', 'asdfs', 'sdf', 'Development', '1', '2020-02-15 11:57:18'),
(2, 'SMS', 'fas fa-sms', 'Nexmo', 'nexmo', 'd', 'asdfa', 'Development', '1', '2020-02-15 11:58:18'),
(3, 'BOOKINGS', 'fas fa-shopping-cart', 'Book Seat', 'book_seat', 'sd', 'fsdf', 'Development', '1', '2020-02-15 12:28:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_blocked_users`
--
ALTER TABLE `auth_blocked_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `group_id_2` (`group_id`);

--
-- Indexes for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_user_details`
--
ALTER TABLE `auth_user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chat_threads`
--
ALTER TABLE `chat_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_constants`
--
ALTER TABLE `db_constants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_config`
--
ALTER TABLE `login_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_apis`
--
ALTER TABLE `mobile_apis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authentication_type` (`authentication_type`);

--
-- Indexes for table `mobile_authentications`
--
ALTER TABLE `mobile_authentications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_auth_tokens`
--
ALTER TABLE `mobile_auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mobile_configurations`
--
ALTER TABLE `mobile_configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_type` (`device_type`);

--
-- Indexes for table `mobile_devices`
--
ALTER TABLE `mobile_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_strings`
--
ALTER TABLE `notification_strings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_configurations`
--
ALTER TABLE `site_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_party_configurations`
--
ALTER TABLE `third_party_configurations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `auth_blocked_users`
--
ALTER TABLE `auth_blocked_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `auth_users`
--
ALTER TABLE `auth_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `auth_user_details`
--
ALTER TABLE `auth_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `chat_threads`
--
ALTER TABLE `chat_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT for table `db_constants`
--
ALTER TABLE `db_constants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_config`
--
ALTER TABLE `login_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mobile_apis`
--
ALTER TABLE `mobile_apis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mobile_authentications`
--
ALTER TABLE `mobile_authentications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mobile_auth_tokens`
--
ALTER TABLE `mobile_auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mobile_configurations`
--
ALTER TABLE `mobile_configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mobile_devices`
--
ALTER TABLE `mobile_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notification_strings`
--
ALTER TABLE `notification_strings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_configurations`
--
ALTER TABLE `site_configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `third_party_configurations`
--
ALTER TABLE `third_party_configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_blocked_users`
--
ALTER TABLE `auth_blocked_users`
  ADD CONSTRAINT `auth_blocked_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `auth_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD CONSTRAINT `auth_group_permissions_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_user_details`
--
ALTER TABLE `auth_user_details`
  ADD CONSTRAINT `auth_users` FOREIGN KEY (`user_id`) REFERENCES `auth_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  ADD CONSTRAINT `auth_user_groups_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_user_groups_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `auth_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mobile_apis`
--
ALTER TABLE `mobile_apis`
  ADD CONSTRAINT `mobile_apis_ibfk_1` FOREIGN KEY (`authentication_type`) REFERENCES `mobile_authentications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mobile_auth_tokens`
--
ALTER TABLE `mobile_auth_tokens`
  ADD CONSTRAINT `mobile_auth_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `auth_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mobile_configurations`
--
ALTER TABLE `mobile_configurations`
  ADD CONSTRAINT `mobile_configurations_ibfk_1` FOREIGN KEY (`device_type`) REFERENCES `mobile_devices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
