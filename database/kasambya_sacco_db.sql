-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2026 at 06:22 PM
-- Server version: 8.4.3
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasambya_sacco_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `employer` varchar(255) DEFAULT NULL,
  `monthly_income` decimal(15,2) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `message` text,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `clock_in` datetime DEFAULT NULL,
  `clock_out` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `username`, `ip_address`, `action`, `model_type`, `model_id`, `old_values`, `new_values`, `created_at`) VALUES
(1, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\User', 1, NULL, '{\"id\": 1, \"name\": \"Mubende SACCO Admin\", \"email\": \"admin@gmail.com\", \"password\": \"$2y$12$VXDal.3U4v346Jbbs4w1GuHSXAbXfL4P4ZLQwkykeZL3ADz.1uW0K\", \"created_at\": \"2026-07-09 16:42:56\", \"updated_at\": \"2026-07-09 16:42:56\", \"email_verified_at\": \"2026-07-09 16:42:56\"}', '2026-07-09 16:42:56'),
(2, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\User', 1, '{\"id\": 1, \"name\": \"Mubende SACCO Admin\", \"email\": \"admin@gmail.com\", \"password\": \"$2y$12$VXDal.3U4v346Jbbs4w1GuHSXAbXfL4P4ZLQwkykeZL3ADz.1uW0K\", \"created_at\": \"2026-07-09T16:42:56.000000Z\", \"updated_at\": \"2026-07-09T16:42:56.000000Z\", \"email_verified_at\": \"2026-07-09T16:42:56.000000Z\"}', '{\"id\": 1, \"name\": \"Mubende SACCO Admin\", \"email\": \"admin@gmail.com\", \"password\": \"$2y$12$rtJnMJ8dY5VUzKMeFwoWMOZ7cO.71RImySu2lFlMMWQkUwZqxUVgO\", \"created_at\": \"2026-07-09 16:42:56\", \"updated_at\": \"2026-07-09 16:42:57\", \"email_verified_at\": \"2026-07-09 16:42:56\"}', '2026-07-09 16:42:57'),
(3, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 1, NULL, '{\"id\": 1, \"key\": \"org_name\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"Mubende Employees and Community Sacco Ltd\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(4, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 2, NULL, '{\"id\": 2, \"key\": \"org_logo\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(5, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 3, NULL, '{\"id\": 3, \"key\": \"org_address\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"Kaweeri Cell, East Division opp Mubende District Head quaters\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(6, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 4, NULL, '{\"id\": 4, \"key\": \"org_phone\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"0775125122\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(7, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 5, NULL, '{\"id\": 5, \"key\": \"org_email\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"mubendehq@gmail.com\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(8, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 6, NULL, '{\"id\": 6, \"key\": \"org_registration_number\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"6682\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(9, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 7, NULL, '{\"id\": 7, \"key\": \"org_established_year\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"1999\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(10, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 8, NULL, '{\"id\": 8, \"key\": \"operating_hours\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"Mon–Fri 08:00–17:00\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(11, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 9, NULL, '{\"id\": 9, \"key\": \"theme_primary_color\", \"type\": \"string\", \"group\": \"theme\", \"value\": \"#1a6e3e\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(12, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 10, NULL, '{\"id\": 10, \"key\": \"theme_accent_color\", \"type\": \"string\", \"group\": \"theme\", \"value\": \"#f59e0b\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(13, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 11, NULL, '{\"id\": 11, \"key\": \"sms_provider\", \"type\": \"string\", \"group\": \"sms\", \"value\": \"africastalking\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(14, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 12, NULL, '{\"id\": 12, \"key\": \"sms_api_key\", \"type\": \"encrypted\", \"group\": \"sms\", \"value\": \"\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(15, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 13, NULL, '{\"id\": 13, \"key\": \"smtp_host\", \"type\": \"string\", \"group\": \"mail\", \"value\": \"\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(16, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 14, NULL, '{\"id\": 14, \"key\": \"smtp_port\", \"type\": \"integer\", \"group\": \"mail\", \"value\": \"587\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(17, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 15, NULL, '{\"id\": 15, \"key\": \"smtp_user\", \"type\": \"string\", \"group\": \"mail\", \"value\": \"\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(18, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 16, NULL, '{\"id\": 16, \"key\": \"smtp_password\", \"type\": \"encrypted\", \"group\": \"mail\", \"value\": \"\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(19, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Setting', 17, NULL, '{\"id\": 17, \"key\": \"meta_description\", \"type\": \"string\", \"group\": \"seo\", \"value\": \"Mubende Employees and Community SACCO Ltd — empowering our community through savings and credit in Mubande great region.\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 16:42:57\"}', '2026-07-09 16:42:57'),
(20, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Branch', 1, NULL, '{\"id\": 1, \"code\": \"MB-HQ\", \"name\": \"Mubende Office (HQ)\", \"email\": \"mubendehq@gmail.com\", \"phone\": \"0775125122\", \"region\": \"Central\", \"address\": \"Kaweeri Cell, East Division opp Mubende District Head quaters\", \"district\": \"Mubende\", \"is_active\": true, \"created_at\": \"2026-07-09 16:43:01\", \"updated_at\": \"2026-07-09 16:43:01\", \"manager_name\": \"Nsubuga John\"}', '2026-07-09 16:43:01'),
(21, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Branch', 2, NULL, '{\"id\": 2, \"code\": \"MB-KL\", \"name\": \"Kalamba Branch\", \"email\": \"kalambabranch@gmail.com\", \"phone\": \"0779892660\", \"region\": \"Central\", \"address\": \"opp. Akatale Komubuulo\", \"district\": \"Mubende\", \"is_active\": true, \"created_at\": \"2026-07-09 16:43:01\", \"updated_at\": \"2026-07-09 16:43:01\", \"manager_name\": \"Mukasa Sarah\"}', '2026-07-09 16:43:01'),
(22, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Branch', 3, NULL, '{\"id\": 3, \"code\": \"MB-KS\", \"name\": \"Kassanda Service Center\", \"email\": \"kassandaservice@gmail.com\", \"phone\": \"0700000003\", \"region\": \"Central\", \"address\": \"at The Arcade\", \"district\": \"Kassanda\", \"is_active\": true, \"created_at\": \"2026-07-09 16:43:01\", \"updated_at\": \"2026-07-09 16:43:01\", \"manager_name\": \"Atwine Ronald\"}', '2026-07-09 16:43:01'),
(23, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\LoanProduct', 1, NULL, '{\"id\": 1, \"code\": \"LP-AGRI\", \"name\": \"Agriculture Loan\", \"category\": \"Agriculture\", \"max_term\": 24, \"min_term\": 3, \"is_active\": true, \"created_at\": \"2026-07-09 16:43:01\", \"max_amount\": 10000000, \"min_amount\": 500000, \"updated_at\": \"2026-07-09 16:43:01\", \"description\": \"Low-interest loans for farmers to purchase seeds, fertilizer, and agricultural equipment.\", \"grace_period\": 30, \"penalty_rate\": 0.001, \"insurance_fee\": 0.005, \"interest_rate\": 0.02, \"processing_fee\": 0.015, \"interest_method\": \"reducing\", \"max_loan_to_share\": 4, \"collateral_required\": true, \"max_loan_to_savings\": 3}', '2026-07-09 16:43:01'),
(24, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\LoanProduct', 2, NULL, '{\"id\": 2, \"code\": \"LP-BIZ\", \"name\": \"Business Growth Loan\", \"category\": \"Business\", \"max_term\": 36, \"min_term\": 6, \"is_active\": true, \"created_at\": \"2026-07-09 16:43:01\", \"max_amount\": 30000000, \"min_amount\": 1000000, \"updated_at\": \"2026-07-09 16:43:01\", \"description\": \"Designed to assist small-to-medium enterprises with working capital.\", \"grace_period\": 15, \"penalty_rate\": 0.001, \"insurance_fee\": 0.005, \"interest_rate\": 0.02, \"processing_fee\": 0.02, \"interest_method\": \"reducing\", \"max_loan_to_share\": 4, \"collateral_required\": true, \"max_loan_to_savings\": 3}', '2026-07-09 16:43:01'),
(25, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\LoanProduct', 3, NULL, '{\"id\": 3, \"code\": \"LP-EDU\", \"name\": \"School Fees Loan\", \"category\": \"SchoolFees\", \"max_term\": 6, \"min_term\": 1, \"is_active\": true, \"created_at\": \"2026-07-09 16:43:01\", \"max_amount\": 3000000, \"min_amount\": 200000, \"updated_at\": \"2026-07-09 16:43:01\", \"description\": \"Short term loan to cover educational expenses for members children.\", \"grace_period\": 0, \"penalty_rate\": 0.002, \"insurance_fee\": 0.005, \"interest_rate\": 0.02, \"processing_fee\": 0.01, \"interest_method\": \"flat\", \"max_loan_to_share\": 3, \"collateral_required\": false, \"max_loan_to_savings\": 2}', '2026-07-09 16:43:01'),
(26, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\LoanProduct', 4, NULL, '{\"id\": 4, \"code\": \"LP-EMERG\", \"name\": \"Emergency Loan\", \"category\": \"Emergency\", \"max_term\": 4, \"min_term\": 1, \"is_active\": true, \"created_at\": \"2026-07-09 16:43:01\", \"max_amount\": 1500005, \"min_amount\": 100000, \"updated_at\": \"2026-07-09 16:43:01\", \"description\": \"Fast disbursed loans to handle unforeseen emergencies like medical bills.\", \"grace_period\": 0, \"penalty_rate\": 0.0015, \"insurance_fee\": 0.002, \"interest_rate\": 0.03, \"processing_fee\": 0.01, \"interest_method\": \"flat\", \"max_loan_to_share\": 2, \"collateral_required\": false, \"max_loan_to_savings\": 1.5}', '2026-07-09 16:43:01'),
(27, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Member', 1, NULL, '{\"id\": 1, \"dob\": \"1990-01-01 00:00:00\", \"email\": \"testmember@example.test\", \"phone\": \"0700000001\", \"gender\": \"M\", \"status\": \"active\", \"category\": \"Regular\", \"employer\": \"Self Employed\", \"branch_id\": 1, \"full_name\": \"Test Member\", \"joined_at\": \"2024-03-15 00:00:00\", \"created_at\": \"2026-07-09 16:43:01\", \"occupation\": \"Farmer\", \"updated_at\": \"2026-07-09 16:43:01\", \"national_id\": \"CM90012345XYZ\", \"monthly_income\": 750000, \"membership_number\": \"MS-2026-0001\"}', '2026-07-09 16:43:01'),
(28, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\User', 2, NULL, '{\"id\": 2, \"name\": \"Test Member\", \"email\": \"testmember@example.test\", \"password\": \"$2y$12$CRpJ1B8HV0c2gH6BziOwH.4EXl7LE2K7pOru2G/paVirsqFpHKww2\", \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\"}', '2026-07-09 16:43:02'),
(29, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 1, NULL, '{\"id\": 1, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 1, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-1-201\"}', '2026-07-09 16:43:02'),
(30, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 1, '{\"id\": 1, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 1, \"created_at\": \"2026-07-09T16:43:02.000000Z\", \"updated_at\": \"2026-07-09T16:43:02.000000Z\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-1-201\"}', '{\"id\": 1, \"status\": \"active\", \"balance\": 295155, \"branch_id\": 1, \"member_id\": 1, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-1-201\"}', '2026-07-09 16:43:02'),
(31, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 2, NULL, '{\"id\": 2, \"status\": \"active\", \"balance\": 450000, \"branch_id\": 1, \"member_id\": 1, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"account_type\": \"Target\", \"interest_rate\": 0.05, \"target_amount\": 1000000, \"account_number\": \"SV-1-209\"}', '2026-07-09 16:43:02'),
(32, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Loan', 1, NULL, '{\"id\": 1, \"status\": \"disbursed\", \"purpose\": \"Purchase of maize seeds and fertilizers for the season.\", \"branch_id\": 1, \"member_id\": 1, \"created_at\": \"2026-04-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"term_months\": 12, \"credit_score\": 720, \"disbursed_at\": \"2026-04-09 16:43:02\", \"interest_rate\": 0.08, \"applied_amount\": 3000000, \"approved_amount\": 3000000, \"loan_product_id\": 1, \"disbursed_amount\": 3000000, \"application_number\": \"LN-2026-001\", \"disbursement_method\": \"cash\"}', '2026-07-09 16:43:02'),
(33, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Member', 2, NULL, '{\"id\": 2, \"dob\": \"1985-05-12 00:00:00\", \"email\": \"joseph.mukasa@example.test\", \"phone\": \"0772111222\", \"gender\": \"M\", \"status\": \"active\", \"category\": \"Regular\", \"employer\": \"Mukasa Retail Shop\", \"branch_id\": 1, \"full_name\": \"Mukasa Joseph\", \"joined_at\": \"2023-01-10 00:00:00\", \"created_at\": \"2026-07-09 16:43:02\", \"occupation\": \"Trader\", \"updated_at\": \"2026-07-09 16:43:02\", \"national_id\": \"CM85054321ABC\", \"monthly_income\": 1800000, \"membership_number\": \"MS-2026-0002\"}', '2026-07-09 16:43:02'),
(34, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\User', 3, NULL, '{\"id\": 3, \"name\": \"Mukasa Joseph\", \"email\": \"joseph.mukasa@example.test\", \"password\": \"$2y$12$q053HMUYQn23BI/wvaNOzuJ/HEVgYrk7zLlck/Rl8Fg8TQxj7VOwe\", \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\"}', '2026-07-09 16:43:02'),
(35, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 3, NULL, '{\"id\": 3, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 2, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-2-201\"}', '2026-07-09 16:43:02'),
(36, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 3, '{\"id\": 3, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 2, \"created_at\": \"2026-07-09T16:43:02.000000Z\", \"updated_at\": \"2026-07-09T16:43:02.000000Z\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-2-201\"}', '{\"id\": 3, \"status\": \"active\", \"balance\": 347975, \"branch_id\": 1, \"member_id\": 2, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-2-201\"}', '2026-07-09 16:43:02'),
(37, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 4, NULL, '{\"id\": 4, \"status\": \"active\", \"balance\": 450000, \"branch_id\": 1, \"member_id\": 2, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"account_type\": \"Target\", \"interest_rate\": 0.05, \"target_amount\": 1000000, \"account_number\": \"SV-2-209\"}', '2026-07-09 16:43:02'),
(38, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Loan', 2, NULL, '{\"id\": 2, \"status\": \"disbursed\", \"purpose\": \"Restocking retail shop.\", \"branch_id\": 1, \"member_id\": 2, \"created_at\": \"2026-05-09 16:43:02\", \"updated_at\": \"2026-07-09 16:43:02\", \"term_months\": 18, \"credit_score\": 690, \"disbursed_at\": \"2026-05-09 16:43:02\", \"interest_rate\": 0.12, \"applied_amount\": 8000000, \"approved_amount\": 8000000, \"loan_product_id\": 2, \"disbursed_amount\": 8000000, \"application_number\": \"LN-2026-002\", \"disbursement_method\": \"bank\"}', '2026-07-09 16:43:02'),
(39, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Member', 3, NULL, '{\"id\": 3, \"dob\": \"1992-09-22 00:00:00\", \"email\": \"florence.nakitende@example.test\", \"phone\": \"0754888999\", \"gender\": \"F\", \"status\": \"active\", \"category\": \"Regular\", \"employer\": \"Mubende Primary School\", \"branch_id\": 2, \"full_name\": \"Nakitende Florence\", \"joined_at\": \"2025-02-18 00:00:00\", \"created_at\": \"2026-07-09 16:43:02\", \"occupation\": \"Teacher\", \"updated_at\": \"2026-07-09 16:43:02\", \"national_id\": \"CF92097654DEF\", \"monthly_income\": 600000, \"membership_number\": \"MS-2026-0003\"}', '2026-07-09 16:43:02'),
(40, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\User', 4, NULL, '{\"id\": 4, \"name\": \"Nakitende Florence\", \"email\": \"florence.nakitende@example.test\", \"password\": \"$2y$12$tHMrAhDMsgeOQMEk0H1RqOcBjN8uNpMpsyUSsPVoCcU5i4dVfZssu\", \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\"}', '2026-07-09 16:43:03'),
(41, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 5, NULL, '{\"id\": 5, \"status\": \"active\", \"balance\": 0, \"branch_id\": 2, \"member_id\": 3, \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-3-201\"}', '2026-07-09 16:43:03'),
(42, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 5, '{\"id\": 5, \"status\": \"active\", \"balance\": 0, \"branch_id\": 2, \"member_id\": 3, \"created_at\": \"2026-07-09T16:43:03.000000Z\", \"updated_at\": \"2026-07-09T16:43:03.000000Z\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-3-201\"}', '{\"id\": 5, \"status\": \"active\", \"balance\": 1228435, \"branch_id\": 2, \"member_id\": 3, \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-3-201\"}', '2026-07-09 16:43:03'),
(43, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 6, NULL, '{\"id\": 6, \"status\": \"active\", \"balance\": 450000, \"branch_id\": 2, \"member_id\": 3, \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\", \"account_type\": \"Target\", \"interest_rate\": 0.05, \"target_amount\": 1000000, \"account_number\": \"SV-3-209\"}', '2026-07-09 16:43:03'),
(44, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Loan', 3, NULL, '{\"id\": 3, \"status\": \"pending\", \"purpose\": \"Payment of secondary school fees.\", \"branch_id\": 2, \"member_id\": 3, \"created_at\": \"2026-07-04 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\", \"term_months\": 4, \"credit_score\": 610, \"interest_rate\": 0.06, \"applied_amount\": 1500000, \"approved_amount\": null, \"loan_product_id\": 3, \"disbursed_amount\": null, \"application_number\": \"LN-2026-003\", \"disbursement_method\": \"cash\"}', '2026-07-09 16:43:03'),
(45, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Member', 4, NULL, '{\"id\": 4, \"dob\": \"1988-11-30 00:00:00\", \"email\": \"ronald.atwine@example.test\", \"phone\": \"0702444555\", \"gender\": \"M\", \"status\": \"active\", \"category\": \"Regular\", \"employer\": \"Self Employed\", \"branch_id\": 3, \"full_name\": \"Atwine Ronald\", \"joined_at\": \"2024-07-01 00:00:00\", \"created_at\": \"2026-07-09 16:43:03\", \"occupation\": \"Boda Boda Operator\", \"updated_at\": \"2026-07-09 16:43:03\", \"national_id\": \"CM88112233GHI\", \"monthly_income\": 1200000, \"membership_number\": \"MS-2026-0004\"}', '2026-07-09 16:43:03'),
(46, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\User', 5, NULL, '{\"id\": 5, \"name\": \"Atwine Ronald\", \"email\": \"ronald.atwine@example.test\", \"password\": \"$2y$12$ULi/0QQhSZCPtPNJmQSEleh6vKKe2A0XCA1952ytJKPwNwCzidbca\", \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\"}', '2026-07-09 16:43:03'),
(47, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 7, NULL, '{\"id\": 7, \"status\": \"active\", \"balance\": 0, \"branch_id\": 3, \"member_id\": 4, \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-4-201\"}', '2026-07-09 16:43:03'),
(48, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 7, '{\"id\": 7, \"status\": \"active\", \"balance\": 0, \"branch_id\": 3, \"member_id\": 4, \"created_at\": \"2026-07-09T16:43:03.000000Z\", \"updated_at\": \"2026-07-09T16:43:03.000000Z\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-4-201\"}', '{\"id\": 7, \"status\": \"active\", \"balance\": 566761, \"branch_id\": 3, \"member_id\": 4, \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 16:43:03\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-4-201\"}', '2026-07-09 16:43:03'),
(49, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Member', 5, NULL, '{\"id\": 5, \"dob\": \"1995-07-04 00:00:00\", \"email\": \"patience.asiimwe@example.test\", \"phone\": \"0775333222\", \"gender\": \"F\", \"status\": \"active\", \"category\": \"Regular\", \"employer\": \"Patience Fashion Hub\", \"branch_id\": 1, \"full_name\": \"Asiimwe Patience\", \"joined_at\": \"2024-11-20 00:00:00\", \"created_at\": \"2026-07-09 16:43:03\", \"occupation\": \"Tailor\", \"updated_at\": \"2026-07-09 16:43:03\", \"national_id\": \"CF95079988JKL\", \"monthly_income\": 950000, \"membership_number\": \"MS-2026-0005\"}', '2026-07-09 16:43:03'),
(50, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\User', 6, NULL, '{\"id\": 6, \"name\": \"Asiimwe Patience\", \"email\": \"patience.asiimwe@example.test\", \"password\": \"$2y$12$1MTA.TEhBK56y7/xAwzHdOUm63dhhm8JbrKGdMKpZKClXbCKx4cTm\", \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 16:43:04\"}', '2026-07-09 16:43:04'),
(51, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 8, NULL, '{\"id\": 8, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 5, \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 16:43:04\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-5-201\"}', '2026-07-09 16:43:04'),
(52, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 8, '{\"id\": 8, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 5, \"created_at\": \"2026-07-09T16:43:04.000000Z\", \"updated_at\": \"2026-07-09T16:43:04.000000Z\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-5-201\"}', '{\"id\": 8, \"status\": \"active\", \"balance\": 418984, \"branch_id\": 1, \"member_id\": 5, \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 16:43:04\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-5-201\"}', '2026-07-09 16:43:04'),
(53, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\Member', 6, NULL, '{\"id\": 6, \"dob\": \"2010-06-15 00:00:00\", \"email\": \"farmersgroup@example.test\", \"phone\": \"0788222333\", \"gender\": \"Other\", \"status\": \"active\", \"category\": \"Group\", \"employer\": \"Community Members\", \"branch_id\": 1, \"full_name\": \"Mubende Farmers Group\", \"joined_at\": \"2023-05-15 00:00:00\", \"created_at\": \"2026-07-09 16:43:04\", \"occupation\": \"Cooperative Group\", \"updated_at\": \"2026-07-09 16:43:04\", \"national_id\": null, \"monthly_income\": 5000000, \"membership_number\": \"MS-2026-0006\"}', '2026-07-09 16:43:04'),
(54, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\User', 7, NULL, '{\"id\": 7, \"name\": \"Mubende Farmers Group\", \"email\": \"farmersgroup@example.test\", \"password\": \"$2y$12$GPVFzTTw6XiUlxYOMI3A6u1VdPS7v/o7pg6Xb/8rsuODh4cqfsBhq\", \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 16:43:04\"}', '2026-07-09 16:43:04'),
(55, NULL, 'system', '127.0.0.1', 'created', 'App\\Models\\SavingsAccount', 9, NULL, '{\"id\": 9, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 6, \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 16:43:04\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-6-201\"}', '2026-07-09 16:43:04'),
(56, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 9, '{\"id\": 9, \"status\": \"active\", \"balance\": 0, \"branch_id\": 1, \"member_id\": 6, \"created_at\": \"2026-07-09T16:43:04.000000Z\", \"updated_at\": \"2026-07-09T16:43:04.000000Z\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-6-201\"}', '{\"id\": 9, \"status\": \"active\", \"balance\": 1081649, \"branch_id\": 1, \"member_id\": 6, \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 16:43:04\", \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"account_number\": \"SV-6-201\"}', '2026-07-09 16:43:04'),
(57, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\User', 2, '{\"id\": 2, \"name\": \"Test Member\", \"email\": \"testmember@example.test\", \"password\": \"$2y$12$CRpJ1B8HV0c2gH6BziOwH.4EXl7LE2K7pOru2G/paVirsqFpHKww2\", \"locked_at\": null, \"created_at\": \"2026-07-09T16:43:02.000000Z\", \"updated_at\": \"2026-07-09T16:43:02.000000Z\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '{\"id\": 2, \"name\": \"Test Member\", \"email\": \"testmember@example.test\", \"password\": \"$2y$12$JuaOmtSDDk00JKxhIqtrpOrW/nUBmkWSOZafhR0i1OsBnHuneUQJK\", \"locked_at\": null, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 18:04:49\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '2026-07-09 18:04:49'),
(58, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 1, '{\"id\": 1, \"status\": \"active\", \"balance\": 295155, \"branch_id\": 1, \"member_id\": 1, \"created_at\": \"2026-07-09T16:43:02.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-07-09T16:43:02.000000Z\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-1-201\"}', '{\"id\": 1, \"status\": \"active\", \"balance\": 110873, \"branch_id\": 1, \"member_id\": 1, \"created_at\": \"2026-07-09 16:43:02\", \"deleted_at\": null, \"updated_at\": \"2026-07-09 18:04:49\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": \"0.0300\", \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-1-201\"}', '2026-07-09 18:04:49'),
(59, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\User', 3, '{\"id\": 3, \"name\": \"Mukasa Joseph\", \"email\": \"joseph.mukasa@example.test\", \"password\": \"$2y$12$q053HMUYQn23BI/wvaNOzuJ/HEVgYrk7zLlck/Rl8Fg8TQxj7VOwe\", \"locked_at\": null, \"created_at\": \"2026-07-09T16:43:02.000000Z\", \"updated_at\": \"2026-07-09T16:43:02.000000Z\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '{\"id\": 3, \"name\": \"Mukasa Joseph\", \"email\": \"joseph.mukasa@example.test\", \"password\": \"$2y$12$jywqwH5MsLU2dB9LGevJ4ehzAa2RRmcRU7arhg.iuD49BE4E.uWyC\", \"locked_at\": null, \"created_at\": \"2026-07-09 16:43:02\", \"updated_at\": \"2026-07-09 18:04:49\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '2026-07-09 18:04:49'),
(60, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 3, '{\"id\": 3, \"status\": \"active\", \"balance\": 347975, \"branch_id\": 1, \"member_id\": 2, \"created_at\": \"2026-07-09T16:43:02.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-07-09T16:43:02.000000Z\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-2-201\"}', '{\"id\": 3, \"status\": \"active\", \"balance\": 621091, \"branch_id\": 1, \"member_id\": 2, \"created_at\": \"2026-07-09 16:43:02\", \"deleted_at\": null, \"updated_at\": \"2026-07-09 18:04:49\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": \"0.0300\", \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-2-201\"}', '2026-07-09 18:04:49'),
(61, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\User', 4, '{\"id\": 4, \"name\": \"Nakitende Florence\", \"email\": \"florence.nakitende@example.test\", \"password\": \"$2y$12$tHMrAhDMsgeOQMEk0H1RqOcBjN8uNpMpsyUSsPVoCcU5i4dVfZssu\", \"locked_at\": null, \"created_at\": \"2026-07-09T16:43:03.000000Z\", \"updated_at\": \"2026-07-09T16:43:03.000000Z\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '{\"id\": 4, \"name\": \"Nakitende Florence\", \"email\": \"florence.nakitende@example.test\", \"password\": \"$2y$12$U6zBrKjsTsRjss7dAniQ7uP93XEYqKxVLDciTjM4uqkFvtQTLe60u\", \"locked_at\": null, \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 18:04:50\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '2026-07-09 18:04:50'),
(62, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 5, '{\"id\": 5, \"status\": \"active\", \"balance\": 1228435, \"branch_id\": 2, \"member_id\": 3, \"created_at\": \"2026-07-09T16:43:03.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-07-09T16:43:03.000000Z\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-3-201\"}', '{\"id\": 5, \"status\": \"active\", \"balance\": 529281, \"branch_id\": 2, \"member_id\": 3, \"created_at\": \"2026-07-09 16:43:03\", \"deleted_at\": null, \"updated_at\": \"2026-07-09 18:04:50\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": \"0.0300\", \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-3-201\"}', '2026-07-09 18:04:50'),
(63, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\User', 5, '{\"id\": 5, \"name\": \"Atwine Ronald\", \"email\": \"ronald.atwine@example.test\", \"password\": \"$2y$12$ULi/0QQhSZCPtPNJmQSEleh6vKKe2A0XCA1952ytJKPwNwCzidbca\", \"locked_at\": null, \"created_at\": \"2026-07-09T16:43:03.000000Z\", \"updated_at\": \"2026-07-09T16:43:03.000000Z\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '{\"id\": 5, \"name\": \"Atwine Ronald\", \"email\": \"ronald.atwine@example.test\", \"password\": \"$2y$12$V7szZqfFKF5XuK8yuOLzd.FRQSiSmALkog0dhoq9DNvs3FysF6Gj.\", \"locked_at\": null, \"created_at\": \"2026-07-09 16:43:03\", \"updated_at\": \"2026-07-09 18:04:50\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '2026-07-09 18:04:50'),
(64, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 7, '{\"id\": 7, \"status\": \"active\", \"balance\": 566761, \"branch_id\": 3, \"member_id\": 4, \"created_at\": \"2026-07-09T16:43:03.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-07-09T16:43:03.000000Z\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-4-201\"}', '{\"id\": 7, \"status\": \"active\", \"balance\": 164968, \"branch_id\": 3, \"member_id\": 4, \"created_at\": \"2026-07-09 16:43:03\", \"deleted_at\": null, \"updated_at\": \"2026-07-09 18:04:50\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": \"0.0300\", \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-4-201\"}', '2026-07-09 18:04:50'),
(65, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\User', 6, '{\"id\": 6, \"name\": \"Asiimwe Patience\", \"email\": \"patience.asiimwe@example.test\", \"password\": \"$2y$12$1MTA.TEhBK56y7/xAwzHdOUm63dhhm8JbrKGdMKpZKClXbCKx4cTm\", \"locked_at\": null, \"created_at\": \"2026-07-09T16:43:04.000000Z\", \"updated_at\": \"2026-07-09T16:43:04.000000Z\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '{\"id\": 6, \"name\": \"Asiimwe Patience\", \"email\": \"patience.asiimwe@example.test\", \"password\": \"$2y$12$LzWWjMYH8nZfzBdiSyggXu.L.8Z5gkSK5rqI5wLTNd1WV5imAw/EO\", \"locked_at\": null, \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 18:04:50\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '2026-07-09 18:04:50'),
(66, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 8, '{\"id\": 8, \"status\": \"active\", \"balance\": 418984, \"branch_id\": 1, \"member_id\": 5, \"created_at\": \"2026-07-09T16:43:04.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-07-09T16:43:04.000000Z\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-5-201\"}', '{\"id\": 8, \"status\": \"active\", \"balance\": 933010, \"branch_id\": 1, \"member_id\": 5, \"created_at\": \"2026-07-09 16:43:04\", \"deleted_at\": null, \"updated_at\": \"2026-07-09 18:04:50\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": \"0.0300\", \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-5-201\"}', '2026-07-09 18:04:50'),
(67, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\User', 7, '{\"id\": 7, \"name\": \"Mubende Farmers Group\", \"email\": \"farmersgroup@example.test\", \"password\": \"$2y$12$GPVFzTTw6XiUlxYOMI3A6u1VdPS7v/o7pg6Xb/8rsuODh4cqfsBhq\", \"locked_at\": null, \"created_at\": \"2026-07-09T16:43:04.000000Z\", \"updated_at\": \"2026-07-09T16:43:04.000000Z\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '{\"id\": 7, \"name\": \"Mubende Farmers Group\", \"email\": \"farmersgroup@example.test\", \"password\": \"$2y$12$hG3xHDtwp2.PMQjxM8iDfuDSXwE7RqKuTVlwbWhLZogRKuANbNt56\", \"locked_at\": null, \"created_at\": \"2026-07-09 16:43:04\", \"updated_at\": \"2026-07-09 18:04:51\", \"remember_token\": null, \"google2fa_secret\": null, \"email_verified_at\": null, \"failed_login_attempts\": 0}', '2026-07-09 18:04:51'),
(68, NULL, 'system', '127.0.0.1', 'updated', 'App\\Models\\SavingsAccount', 9, '{\"id\": 9, \"status\": \"active\", \"balance\": 1081649, \"branch_id\": 1, \"member_id\": 6, \"created_at\": \"2026-07-09T16:43:04.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-07-09T16:43:04.000000Z\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": 0.03, \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-6-201\"}', '{\"id\": 9, \"status\": \"active\", \"balance\": 689244, \"branch_id\": 1, \"member_id\": 6, \"created_at\": \"2026-07-09 16:43:04\", \"deleted_at\": null, \"updated_at\": \"2026-07-09 18:04:51\", \"approved_at\": null, \"approved_by\": null, \"account_type\": \"Normal\", \"interest_rate\": \"0.0300\", \"maturity_date\": null, \"target_amount\": null, \"account_number\": \"SV-6-201\"}', '2026-07-09 18:04:51'),
(69, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 1, '{\"id\": 1, \"key\": \"org_name\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"Mubende Employees and Community Sacco Ltd\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 1, \"key\": \"org_name\", \"type\": \"text\", \"group\": \"general\", \"value\": \"Mubende Employees and Community Sacco Ltd\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:18\"}', '2026-07-09 18:19:18'),
(70, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 4, '{\"id\": 4, \"key\": \"org_phone\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"0775125122\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 4, \"key\": \"org_phone\", \"type\": \"text\", \"group\": \"general\", \"value\": \"0775125122\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:18\"}', '2026-07-09 18:19:18'),
(71, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 5, '{\"id\": 5, \"key\": \"org_email\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"mubendehq@gmail.com\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 5, \"key\": \"org_email\", \"type\": \"text\", \"group\": \"general\", \"value\": \"mubendehq@gmail.com\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:18\"}', '2026-07-09 18:19:18'),
(72, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 8, '{\"id\": 8, \"key\": \"operating_hours\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"Mon–Fri 08:00–17:00\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 8, \"key\": \"operating_hours\", \"type\": \"text\", \"group\": \"general\", \"value\": \"Mon–Fri 08:00–17:00\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:18\"}', '2026-07-09 18:19:18'),
(73, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 3, '{\"id\": 3, \"key\": \"org_address\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"Kaweeri Cell, East Division opp Mubende District Head quaters\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 3, \"key\": \"org_address\", \"type\": \"text\", \"group\": \"general\", \"value\": \"Kaweeri Cell, East Division opp Mubende District Head quaters\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:18\"}', '2026-07-09 18:19:18'),
(74, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 7, '{\"id\": 7, \"key\": \"org_established_year\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"1999\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 7, \"key\": \"org_established_year\", \"type\": \"text\", \"group\": \"general\", \"value\": \"1999\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(75, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 6, '{\"id\": 6, \"key\": \"org_registration_number\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"6682\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 6, \"key\": \"org_registration_number\", \"type\": \"text\", \"group\": \"general\", \"value\": \"6682\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(76, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 2, '{\"id\": 2, \"key\": \"org_logo\", \"type\": \"string\", \"group\": \"organisation\", \"value\": \"\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 2, \"key\": \"org_logo\", \"type\": \"text\", \"group\": \"general\", \"value\": \"settings/3BOYuV2NoHIqU1vAyKsfkjLqTQfYksPlBG3qaZOU.jpg\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(77, 1, 'Mubende SACCO Admin', '::1', 'created', 'App\\Models\\Setting', 18, NULL, '{\"id\": 18, \"key\": \"org_favicon\", \"type\": \"text\", \"group\": \"general\", \"value\": \"settings/tv6V9d827OZR24nasRP47iY7ohfXOkI6K4X1ExxL.jpg\", \"created_at\": \"2026-07-09 18:19:19\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(78, 1, 'Mubende SACCO Admin', '::1', 'updated', 'App\\Models\\Setting', 17, '{\"id\": 17, \"key\": \"meta_description\", \"type\": \"string\", \"group\": \"seo\", \"value\": \"Mubende Employees and Community SACCO Ltd — empowering our community through savings and credit in Mubande great region.\", \"created_at\": \"2026-07-09T16:42:57.000000Z\", \"updated_at\": \"2026-07-09T16:42:57.000000Z\"}', '{\"id\": 17, \"key\": \"meta_description\", \"type\": \"text\", \"group\": \"general\", \"value\": \"Mubende Employees and Community SACCO Ltd — empowering our community through savings and credit in Mubande great region.\", \"created_at\": \"2026-07-09 16:42:57\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(79, 1, 'Mubende SACCO Admin', '::1', 'created', 'App\\Models\\Setting', 19, NULL, '{\"id\": 19, \"key\": \"meta_keywords\", \"type\": \"text\", \"group\": \"general\", \"value\": null, \"created_at\": \"2026-07-09 18:19:19\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(80, 1, 'Mubende SACCO Admin', '::1', 'created', 'App\\Models\\Setting', 20, NULL, '{\"id\": 20, \"key\": \"hero_copy\", \"type\": \"text\", \"group\": \"general\", \"value\": null, \"created_at\": \"2026-07-09 18:19:19\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(81, 1, 'Mubende SACCO Admin', '::1', 'created', 'App\\Models\\Setting', 21, NULL, '{\"id\": 21, \"key\": \"theme_primary\", \"type\": \"text\", \"group\": \"general\", \"value\": \"#10b981\", \"created_at\": \"2026-07-09 18:19:19\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(82, 1, 'Mubende SACCO Admin', '::1', 'created', 'App\\Models\\Setting', 22, NULL, '{\"id\": 22, \"key\": \"theme_secondary\", \"type\": \"text\", \"group\": \"general\", \"value\": \"#06b6d4\", \"created_at\": \"2026-07-09 18:19:19\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19'),
(83, 1, 'Mubende SACCO Admin', '::1', 'created', 'App\\Models\\Setting', 23, NULL, '{\"id\": 23, \"key\": \"theme_accent\", \"type\": \"text\", \"group\": \"general\", \"value\": \"#facc15\", \"created_at\": \"2026-07-09 18:19:19\", \"updated_at\": \"2026-07-09 18:19:19\"}', '2026-07-09 18:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text,
  `district` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `code`, `name`, `address`, `district`, `region`, `phone`, `email`, `manager_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'MB-HQ', 'Mubende Office (HQ)', 'Kaweeri Cell, East Division opp Mubende District Head quaters', 'Mubende', 'Central', '0775125122', 'mubendehq@gmail.com', 'Nsubuga John', 1, '2026-07-09 13:43:01', '2026-07-09 13:43:01'),
(2, 'MB-KL', 'Kalamba Branch', 'opp. Akatale Komubuulo', 'Mubende', 'Central', '0779892660', 'kalambabranch@gmail.com', 'Mukasa Sarah', 1, '2026-07-09 13:43:01', '2026-07-09 13:43:01'),
(3, 'MB-KS', 'Kassanda Service Center', 'at The Arcade', 'Kassanda', 'Central', '0700000003', 'kassandaservice@gmail.com', 'Atwine Ronald', 1, '2026-07-09 13:43:01', '2026-07-09 13:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin.dashboard.active_loans', 'i:2;', 1783621085),
('admin.dashboard.female_count', 'i:2;', 1783621085),
('admin.dashboard.loan_products_chart', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:4:{i:0;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:1;s:4:\"name\";s:16:\"Agriculture Loan\";s:4:\"code\";s:7:\"LP-AGRI\";s:11:\"description\";s:89:\"Low-interest loans for farmers to purchase seeds, fertilizer, and agricultural equipment.\";s:10:\"min_amount\";i:500000;s:10:\"max_amount\";i:10000000;s:8:\"min_term\";i:3;s:8:\"max_term\";i:24;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:30;s:14:\"processing_fee\";s:6:\"0.0150\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:11:\"Agriculture\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:1;}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:1;s:4:\"name\";s:16:\"Agriculture Loan\";s:4:\"code\";s:7:\"LP-AGRI\";s:11:\"description\";s:89:\"Low-interest loans for farmers to purchase seeds, fertilizer, and agricultural equipment.\";s:10:\"min_amount\";i:500000;s:10:\"max_amount\";i:10000000;s:8:\"min_term\";i:3;s:8:\"max_term\";i:24;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:30;s:14:\"processing_fee\";s:6:\"0.0150\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:11:\"Agriculture\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:2;s:4:\"name\";s:20:\"Business Growth Loan\";s:4:\"code\";s:6:\"LP-BIZ\";s:11:\"description\";s:68:\"Designed to assist small-to-medium enterprises with working capital.\";s:10:\"min_amount\";i:1000000;s:10:\"max_amount\";i:30000000;s:8:\"min_term\";i:6;s:8:\"max_term\";i:36;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:15;s:14:\"processing_fee\";s:6:\"0.0200\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:8:\"Business\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:1;}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:2;s:4:\"name\";s:20:\"Business Growth Loan\";s:4:\"code\";s:6:\"LP-BIZ\";s:11:\"description\";s:68:\"Designed to assist small-to-medium enterprises with working capital.\";s:10:\"min_amount\";i:1000000;s:10:\"max_amount\";i:30000000;s:8:\"min_term\";i:6;s:8:\"max_term\";i:36;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:15;s:14:\"processing_fee\";s:6:\"0.0200\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:8:\"Business\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:3;s:4:\"name\";s:16:\"School Fees Loan\";s:4:\"code\";s:6:\"LP-EDU\";s:11:\"description\";s:67:\"Short term loan to cover educational expenses for members children.\";s:10:\"min_amount\";i:200000;s:10:\"max_amount\";i:3000000;s:8:\"min_term\";i:1;s:8:\"max_term\";i:6;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.002000\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"2.00\";s:17:\"max_loan_to_share\";s:4:\"3.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:10:\"SchoolFees\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:1;}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:3;s:4:\"name\";s:16:\"School Fees Loan\";s:4:\"code\";s:6:\"LP-EDU\";s:11:\"description\";s:67:\"Short term loan to cover educational expenses for members children.\";s:10:\"min_amount\";i:200000;s:10:\"max_amount\";i:3000000;s:8:\"min_term\";i:1;s:8:\"max_term\";i:6;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.002000\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"2.00\";s:17:\"max_loan_to_share\";s:4:\"3.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:10:\"SchoolFees\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:4;s:4:\"name\";s:14:\"Emergency Loan\";s:4:\"code\";s:8:\"LP-EMERG\";s:11:\"description\";s:73:\"Fast disbursed loans to handle unforeseen emergencies like medical bills.\";s:10:\"min_amount\";i:100000;s:10:\"max_amount\";i:1500005;s:8:\"min_term\";i:1;s:8:\"max_term\";i:4;s:13:\"interest_rate\";s:6:\"0.0300\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.001500\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0020\";s:19:\"max_loan_to_savings\";s:4:\"1.50\";s:17:\"max_loan_to_share\";s:4:\"2.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:9:\"Emergency\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:0;}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:4;s:4:\"name\";s:14:\"Emergency Loan\";s:4:\"code\";s:8:\"LP-EMERG\";s:11:\"description\";s:73:\"Fast disbursed loans to handle unforeseen emergencies like medical bills.\";s:10:\"min_amount\";i:100000;s:10:\"max_amount\";i:1500005;s:8:\"min_term\";i:1;s:8:\"max_term\";i:4;s:13:\"interest_rate\";s:6:\"0.0300\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.001500\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0020\";s:19:\"max_loan_to_savings\";s:4:\"1.50\";s:17:\"max_loan_to_share\";s:4:\"2.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:9:\"Emergency\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";s:11:\"loans_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621085),
('admin.dashboard.male_count', 'i:3;', 1783621085),
('admin.dashboard.monthly_deposits', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;a:2:{s:5:\"month\";s:8:\"Feb 2026\";s:5:\"total\";i:0;}i:1;a:2:{s:5:\"month\";s:8:\"Mar 2026\";s:5:\"total\";i:0;}i:2;a:2:{s:5:\"month\";s:8:\"Apr 2026\";s:5:\"total\";s:7:\"1615028\";}i:3;a:2:{s:5:\"month\";s:8:\"May 2026\";s:5:\"total\";s:7:\"2492274\";}i:4;a:2:{s:5:\"month\";s:8:\"Jun 2026\";s:5:\"total\";s:7:\"3572598\";}i:5;a:2:{s:5:\"month\";s:8:\"Jul 2026\";s:5:\"total\";i:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621085),
('admin.dashboard.pending_applications', 'i:0;', 1783621085),
('admin.dashboard.pending_members', 'i:0;', 1783621085),
('admin.dashboard.recent_members', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:17:\"App\\Models\\Member\":31:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"members\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:6;s:9:\"full_name\";s:21:\"Mubende Farmers Group\";s:17:\"membership_number\";s:12:\"MS-2026-0006\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:04\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:6;s:9:\"full_name\";s:21:\"Mubende Farmers Group\";s:17:\"membership_number\";s:12:\"MS-2026-0006\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:04\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:3:\"dob\";s:4:\"date\";s:9:\"joined_at\";s:4:\"date\";s:14:\"blacklisted_at\";s:8:\"datetime\";s:14:\"monthly_income\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:25:{i:0;s:17:\"membership_number\";i:1;s:9:\"full_name\";i:2;s:3:\"dob\";i:3;s:6:\"gender\";i:4;s:11:\"national_id\";i:5;s:15:\"passport_number\";i:6;s:5:\"photo\";i:7;s:7:\"address\";i:8;s:8:\"district\";i:9;s:5:\"phone\";i:10;s:5:\"email\";i:11;s:10:\"occupation\";i:12;s:8:\"employer\";i:13;s:14:\"monthly_income\";i:14;s:16:\"next_of_kin_name\";i:15;s:17:\"next_of_kin_phone\";i:16;s:24:\"next_of_kin_relationship\";i:17;s:8:\"category\";i:18;s:9:\"branch_id\";i:19;s:6:\"status\";i:20;s:16:\"blacklist_reason\";i:21;s:14:\"blacklisted_by\";i:22;s:14:\"blacklisted_at\";i:23;s:9:\"joined_at\";i:24;s:12:\"qr_code_path\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:17:\"App\\Models\\Member\":31:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"members\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:4;s:9:\"full_name\";s:13:\"Atwine Ronald\";s:17:\"membership_number\";s:12:\"MS-2026-0004\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:03\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:4;s:9:\"full_name\";s:13:\"Atwine Ronald\";s:17:\"membership_number\";s:12:\"MS-2026-0004\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:03\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:3:\"dob\";s:4:\"date\";s:9:\"joined_at\";s:4:\"date\";s:14:\"blacklisted_at\";s:8:\"datetime\";s:14:\"monthly_income\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:25:{i:0;s:17:\"membership_number\";i:1;s:9:\"full_name\";i:2;s:3:\"dob\";i:3;s:6:\"gender\";i:4;s:11:\"national_id\";i:5;s:15:\"passport_number\";i:6;s:5:\"photo\";i:7;s:7:\"address\";i:8;s:8:\"district\";i:9;s:5:\"phone\";i:10;s:5:\"email\";i:11;s:10:\"occupation\";i:12;s:8:\"employer\";i:13;s:14:\"monthly_income\";i:14;s:16:\"next_of_kin_name\";i:15;s:17:\"next_of_kin_phone\";i:16;s:24:\"next_of_kin_relationship\";i:17;s:8:\"category\";i:18;s:9:\"branch_id\";i:19;s:6:\"status\";i:20;s:16:\"blacklist_reason\";i:21;s:14:\"blacklisted_by\";i:22;s:14:\"blacklisted_at\";i:23;s:9:\"joined_at\";i:24;s:12:\"qr_code_path\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:2;O:17:\"App\\Models\\Member\":31:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"members\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:5;s:9:\"full_name\";s:16:\"Asiimwe Patience\";s:17:\"membership_number\";s:12:\"MS-2026-0005\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:03\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:5;s:9:\"full_name\";s:16:\"Asiimwe Patience\";s:17:\"membership_number\";s:12:\"MS-2026-0005\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:03\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:3:\"dob\";s:4:\"date\";s:9:\"joined_at\";s:4:\"date\";s:14:\"blacklisted_at\";s:8:\"datetime\";s:14:\"monthly_income\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:25:{i:0;s:17:\"membership_number\";i:1;s:9:\"full_name\";i:2;s:3:\"dob\";i:3;s:6:\"gender\";i:4;s:11:\"national_id\";i:5;s:15:\"passport_number\";i:6;s:5:\"photo\";i:7;s:7:\"address\";i:8;s:8:\"district\";i:9;s:5:\"phone\";i:10;s:5:\"email\";i:11;s:10:\"occupation\";i:12;s:8:\"employer\";i:13;s:14:\"monthly_income\";i:14;s:16:\"next_of_kin_name\";i:15;s:17:\"next_of_kin_phone\";i:16;s:24:\"next_of_kin_relationship\";i:17;s:8:\"category\";i:18;s:9:\"branch_id\";i:19;s:6:\"status\";i:20;s:16:\"blacklist_reason\";i:21;s:14:\"blacklisted_by\";i:22;s:14:\"blacklisted_at\";i:23;s:9:\"joined_at\";i:24;s:12:\"qr_code_path\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:3;O:17:\"App\\Models\\Member\":31:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"members\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:2;s:9:\"full_name\";s:13:\"Mukasa Joseph\";s:17:\"membership_number\";s:12:\"MS-2026-0002\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:02\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:2;s:9:\"full_name\";s:13:\"Mukasa Joseph\";s:17:\"membership_number\";s:12:\"MS-2026-0002\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:02\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:3:\"dob\";s:4:\"date\";s:9:\"joined_at\";s:4:\"date\";s:14:\"blacklisted_at\";s:8:\"datetime\";s:14:\"monthly_income\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:25:{i:0;s:17:\"membership_number\";i:1;s:9:\"full_name\";i:2;s:3:\"dob\";i:3;s:6:\"gender\";i:4;s:11:\"national_id\";i:5;s:15:\"passport_number\";i:6;s:5:\"photo\";i:7;s:7:\"address\";i:8;s:8:\"district\";i:9;s:5:\"phone\";i:10;s:5:\"email\";i:11;s:10:\"occupation\";i:12;s:8:\"employer\";i:13;s:14:\"monthly_income\";i:14;s:16:\"next_of_kin_name\";i:15;s:17:\"next_of_kin_phone\";i:16;s:24:\"next_of_kin_relationship\";i:17;s:8:\"category\";i:18;s:9:\"branch_id\";i:19;s:6:\"status\";i:20;s:16:\"blacklist_reason\";i:21;s:14:\"blacklisted_by\";i:22;s:14:\"blacklisted_at\";i:23;s:9:\"joined_at\";i:24;s:12:\"qr_code_path\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:4;O:17:\"App\\Models\\Member\":31:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"members\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:3;s:9:\"full_name\";s:18:\"Nakitende Florence\";s:17:\"membership_number\";s:12:\"MS-2026-0003\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:02\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:3;s:9:\"full_name\";s:18:\"Nakitende Florence\";s:17:\"membership_number\";s:12:\"MS-2026-0003\";s:6:\"status\";s:6:\"active\";s:10:\"created_at\";s:19:\"2026-07-09 16:43:02\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:3:\"dob\";s:4:\"date\";s:9:\"joined_at\";s:4:\"date\";s:14:\"blacklisted_at\";s:8:\"datetime\";s:14:\"monthly_income\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:25:{i:0;s:17:\"membership_number\";i:1;s:9:\"full_name\";i:2;s:3:\"dob\";i:3;s:6:\"gender\";i:4;s:11:\"national_id\";i:5;s:15:\"passport_number\";i:6;s:5:\"photo\";i:7;s:7:\"address\";i:8;s:8:\"district\";i:9;s:5:\"phone\";i:10;s:5:\"email\";i:11;s:10:\"occupation\";i:12;s:8:\"employer\";i:13;s:14:\"monthly_income\";i:14;s:16:\"next_of_kin_name\";i:15;s:17:\"next_of_kin_phone\";i:16;s:24:\"next_of_kin_relationship\";i:17;s:8:\"category\";i:18;s:9:\"branch_id\";i:19;s:6:\"status\";i:20;s:16:\"blacklist_reason\";i:21;s:14:\"blacklisted_by\";i:22;s:14:\"blacklisted_at\";i:23;s:9:\"joined_at\";i:24;s:12:\"qr_code_path\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621085),
('admin.dashboard.total_applications', 'i:0;', 1783621085),
('admin.dashboard.total_branches', 'i:3;', 1783621085),
('admin.dashboard.total_loaned', 's:8:\"11000000\";', 1783621085),
('admin.dashboard.total_members', 'i:6;', 1783621085),
('admin.dashboard.total_savings', 's:7:\"4398467\";', 1783621085),
('admin.dashboard.unread_contacts', 'i:0;', 1783621085),
('admin.notifications', 'a:3:{s:20:\"pending_applications\";i:0;s:15:\"unread_contacts\";i:0;s:15:\"pending_members\";i:0;}', 1783621189),
('admin.notifications.pending_applications', 'i:0;', 1783621341),
('admin.notifications.pending_members', 'i:0;', 1783621341),
('admin.notifications.unread_contacts', 'i:0;', 1783621341),
('site.faqs.home', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621316),
('site.loan_products.featured', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:4:{i:0;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:22:{s:2:\"id\";i:1;s:4:\"name\";s:16:\"Agriculture Loan\";s:4:\"code\";s:7:\"LP-AGRI\";s:11:\"description\";s:89:\"Low-interest loans for farmers to purchase seeds, fertilizer, and agricultural equipment.\";s:10:\"min_amount\";i:500000;s:10:\"max_amount\";i:10000000;s:8:\"min_term\";i:3;s:8:\"max_term\";i:24;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:30;s:14:\"processing_fee\";s:6:\"0.0150\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:11:\"Agriculture\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:11:\"\0*\0original\";a:22:{s:2:\"id\";i:1;s:4:\"name\";s:16:\"Agriculture Loan\";s:4:\"code\";s:7:\"LP-AGRI\";s:11:\"description\";s:89:\"Low-interest loans for farmers to purchase seeds, fertilizer, and agricultural equipment.\";s:10:\"min_amount\";i:500000;s:10:\"max_amount\";i:10000000;s:8:\"min_term\";i:3;s:8:\"max_term\";i:24;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:30;s:14:\"processing_fee\";s:6:\"0.0150\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:11:\"Agriculture\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:22:{s:2:\"id\";i:2;s:4:\"name\";s:20:\"Business Growth Loan\";s:4:\"code\";s:6:\"LP-BIZ\";s:11:\"description\";s:68:\"Designed to assist small-to-medium enterprises with working capital.\";s:10:\"min_amount\";i:1000000;s:10:\"max_amount\";i:30000000;s:8:\"min_term\";i:6;s:8:\"max_term\";i:36;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:15;s:14:\"processing_fee\";s:6:\"0.0200\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:8:\"Business\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:11:\"\0*\0original\";a:22:{s:2:\"id\";i:2;s:4:\"name\";s:20:\"Business Growth Loan\";s:4:\"code\";s:6:\"LP-BIZ\";s:11:\"description\";s:68:\"Designed to assist small-to-medium enterprises with working capital.\";s:10:\"min_amount\";i:1000000;s:10:\"max_amount\";i:30000000;s:8:\"min_term\";i:6;s:8:\"max_term\";i:36;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:8:\"reducing\";s:12:\"penalty_rate\";s:8:\"0.001000\";s:12:\"grace_period\";i:15;s:14:\"processing_fee\";s:6:\"0.0200\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"3.00\";s:17:\"max_loan_to_share\";s:4:\"4.00\";s:19:\"collateral_required\";i:1;s:8:\"category\";s:8:\"Business\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:22:{s:2:\"id\";i:3;s:4:\"name\";s:16:\"School Fees Loan\";s:4:\"code\";s:6:\"LP-EDU\";s:11:\"description\";s:67:\"Short term loan to cover educational expenses for members children.\";s:10:\"min_amount\";i:200000;s:10:\"max_amount\";i:3000000;s:8:\"min_term\";i:1;s:8:\"max_term\";i:6;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.002000\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"2.00\";s:17:\"max_loan_to_share\";s:4:\"3.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:10:\"SchoolFees\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:11:\"\0*\0original\";a:22:{s:2:\"id\";i:3;s:4:\"name\";s:16:\"School Fees Loan\";s:4:\"code\";s:6:\"LP-EDU\";s:11:\"description\";s:67:\"Short term loan to cover educational expenses for members children.\";s:10:\"min_amount\";i:200000;s:10:\"max_amount\";i:3000000;s:8:\"min_term\";i:1;s:8:\"max_term\";i:6;s:13:\"interest_rate\";s:6:\"0.0200\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.002000\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0050\";s:19:\"max_loan_to_savings\";s:4:\"2.00\";s:17:\"max_loan_to_share\";s:4:\"3.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:10:\"SchoolFees\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:22:\"App\\Models\\LoanProduct\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"loan_products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:22:{s:2:\"id\";i:4;s:4:\"name\";s:14:\"Emergency Loan\";s:4:\"code\";s:8:\"LP-EMERG\";s:11:\"description\";s:73:\"Fast disbursed loans to handle unforeseen emergencies like medical bills.\";s:10:\"min_amount\";i:100000;s:10:\"max_amount\";i:1500005;s:8:\"min_term\";i:1;s:8:\"max_term\";i:4;s:13:\"interest_rate\";s:6:\"0.0300\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.001500\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0020\";s:19:\"max_loan_to_savings\";s:4:\"1.50\";s:17:\"max_loan_to_share\";s:4:\"2.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:9:\"Emergency\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:11:\"\0*\0original\";a:22:{s:2:\"id\";i:4;s:4:\"name\";s:14:\"Emergency Loan\";s:4:\"code\";s:8:\"LP-EMERG\";s:11:\"description\";s:73:\"Fast disbursed loans to handle unforeseen emergencies like medical bills.\";s:10:\"min_amount\";i:100000;s:10:\"max_amount\";i:1500005;s:8:\"min_term\";i:1;s:8:\"max_term\";i:4;s:13:\"interest_rate\";s:6:\"0.0300\";s:15:\"interest_method\";s:4:\"flat\";s:12:\"penalty_rate\";s:8:\"0.001500\";s:12:\"grace_period\";i:0;s:14:\"processing_fee\";s:6:\"0.0100\";s:13:\"insurance_fee\";s:6:\"0.0020\";s:19:\"max_loan_to_savings\";s:4:\"1.50\";s:17:\"max_loan_to_share\";s:4:\"2.00\";s:19:\"collateral_required\";i:0;s:8:\"category\";s:9:\"Emergency\";s:15:\"approval_levels\";N;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2026-07-09 16:43:01\";s:10:\"updated_at\";s:19:\"2026-07-09 16:43:01\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:15:\"approval_levels\";s:5:\"array\";s:9:\"is_active\";s:7:\"boolean\";s:19:\"collateral_required\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:19:{i:0;s:4:\"name\";i:1;s:4:\"code\";i:2;s:11:\"description\";i:3;s:10:\"min_amount\";i:4;s:10:\"max_amount\";i:5;s:8:\"min_term\";i:6;s:8:\"max_term\";i:7;s:13:\"interest_rate\";i:8;s:15:\"interest_method\";i:9;s:12:\"penalty_rate\";i:10;s:12:\"grace_period\";i:11;s:14:\"processing_fee\";i:12;s:13:\"insurance_fee\";i:13;s:19:\"max_loan_to_savings\";i:14;s:17:\"max_loan_to_share\";i:15;s:19:\"collateral_required\";i:16;s:8:\"category\";i:17;s:15:\"approval_levels\";i:18;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621316),
('site.news.latest', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621316),
('site.partners', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621316),
('site.services.featured', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621316);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('site.settings', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:23:{s:8:\"org_name\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:1;s:3:\"key\";s:8:\"org_name\";s:5:\"value\";s:41:\"Mubende Employees and Community Sacco Ltd\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:1;s:3:\"key\";s:8:\"org_name\";s:5:\"value\";s:41:\"Mubende Employees and Community Sacco Ltd\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:8:\"org_logo\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:2;s:3:\"key\";s:8:\"org_logo\";s:5:\"value\";s:53:\"settings/3BOYuV2NoHIqU1vAyKsfkjLqTQfYksPlBG3qaZOU.jpg\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:2;s:3:\"key\";s:8:\"org_logo\";s:5:\"value\";s:53:\"settings/3BOYuV2NoHIqU1vAyKsfkjLqTQfYksPlBG3qaZOU.jpg\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:11:\"org_address\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:3;s:3:\"key\";s:11:\"org_address\";s:5:\"value\";s:61:\"Kaweeri Cell, East Division opp Mubende District Head quaters\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:3;s:3:\"key\";s:11:\"org_address\";s:5:\"value\";s:61:\"Kaweeri Cell, East Division opp Mubende District Head quaters\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"org_phone\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:4;s:3:\"key\";s:9:\"org_phone\";s:5:\"value\";s:10:\"0775125122\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:4;s:3:\"key\";s:9:\"org_phone\";s:5:\"value\";s:10:\"0775125122\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"org_email\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:5;s:3:\"key\";s:9:\"org_email\";s:5:\"value\";s:19:\"mubendehq@gmail.com\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:5;s:3:\"key\";s:9:\"org_email\";s:5:\"value\";s:19:\"mubendehq@gmail.com\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:23:\"org_registration_number\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:6;s:3:\"key\";s:23:\"org_registration_number\";s:5:\"value\";s:4:\"6682\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:6;s:3:\"key\";s:23:\"org_registration_number\";s:5:\"value\";s:4:\"6682\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:20:\"org_established_year\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:7;s:3:\"key\";s:20:\"org_established_year\";s:5:\"value\";s:4:\"1999\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:7;s:3:\"key\";s:20:\"org_established_year\";s:5:\"value\";s:4:\"1999\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:15:\"operating_hours\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:8;s:3:\"key\";s:15:\"operating_hours\";s:5:\"value\";s:23:\"Mon–Fri 08:00–17:00\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:8;s:3:\"key\";s:15:\"operating_hours\";s:5:\"value\";s:23:\"Mon–Fri 08:00–17:00\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:19:\"theme_primary_color\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:9;s:3:\"key\";s:19:\"theme_primary_color\";s:5:\"value\";s:7:\"#1a6e3e\";s:5:\"group\";s:5:\"theme\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:9;s:3:\"key\";s:19:\"theme_primary_color\";s:5:\"value\";s:7:\"#1a6e3e\";s:5:\"group\";s:5:\"theme\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:18:\"theme_accent_color\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:10;s:3:\"key\";s:18:\"theme_accent_color\";s:5:\"value\";s:7:\"#f59e0b\";s:5:\"group\";s:5:\"theme\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:10;s:3:\"key\";s:18:\"theme_accent_color\";s:5:\"value\";s:7:\"#f59e0b\";s:5:\"group\";s:5:\"theme\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:12:\"sms_provider\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:11;s:3:\"key\";s:12:\"sms_provider\";s:5:\"value\";s:14:\"africastalking\";s:5:\"group\";s:3:\"sms\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:11;s:3:\"key\";s:12:\"sms_provider\";s:5:\"value\";s:14:\"africastalking\";s:5:\"group\";s:3:\"sms\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:11:\"sms_api_key\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:12;s:3:\"key\";s:11:\"sms_api_key\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:3:\"sms\";s:4:\"type\";s:9:\"encrypted\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:12;s:3:\"key\";s:11:\"sms_api_key\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:3:\"sms\";s:4:\"type\";s:9:\"encrypted\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"smtp_host\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:13;s:3:\"key\";s:9:\"smtp_host\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:13;s:3:\"key\";s:9:\"smtp_host\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"smtp_port\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:14;s:3:\"key\";s:9:\"smtp_port\";s:5:\"value\";s:3:\"587\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:7:\"integer\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:14;s:3:\"key\";s:9:\"smtp_port\";s:5:\"value\";s:3:\"587\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:7:\"integer\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"smtp_user\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:15;s:3:\"key\";s:9:\"smtp_user\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:15;s:3:\"key\";s:9:\"smtp_user\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:6:\"string\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:13:\"smtp_password\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:16;s:3:\"key\";s:13:\"smtp_password\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:9:\"encrypted\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:16;s:3:\"key\";s:13:\"smtp_password\";s:5:\"value\";s:0:\"\";s:5:\"group\";s:4:\"mail\";s:4:\"type\";s:9:\"encrypted\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 16:42:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:16:\"meta_description\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:17;s:3:\"key\";s:16:\"meta_description\";s:5:\"value\";s:122:\"Mubende Employees and Community SACCO Ltd — empowering our community through savings and credit in Mubande great region.\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:17;s:3:\"key\";s:16:\"meta_description\";s:5:\"value\";s:122:\"Mubende Employees and Community SACCO Ltd — empowering our community through savings and credit in Mubande great region.\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 16:42:57\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:11:\"org_favicon\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:18;s:3:\"key\";s:11:\"org_favicon\";s:5:\"value\";s:53:\"settings/tv6V9d827OZR24nasRP47iY7ohfXOkI6K4X1ExxL.jpg\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:18;s:3:\"key\";s:11:\"org_favicon\";s:5:\"value\";s:53:\"settings/tv6V9d827OZR24nasRP47iY7ohfXOkI6K4X1ExxL.jpg\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:13:\"meta_keywords\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:19;s:3:\"key\";s:13:\"meta_keywords\";s:5:\"value\";N;s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:19;s:3:\"key\";s:13:\"meta_keywords\";s:5:\"value\";N;s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"hero_copy\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:20;s:3:\"key\";s:9:\"hero_copy\";s:5:\"value\";N;s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:20;s:3:\"key\";s:9:\"hero_copy\";s:5:\"value\";N;s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:13:\"theme_primary\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:21;s:3:\"key\";s:13:\"theme_primary\";s:5:\"value\";s:7:\"#10b981\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:21;s:3:\"key\";s:13:\"theme_primary\";s:5:\"value\";s:7:\"#10b981\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:15:\"theme_secondary\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:22;s:3:\"key\";s:15:\"theme_secondary\";s:5:\"value\";s:7:\"#06b6d4\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:22;s:3:\"key\";s:15:\"theme_secondary\";s:5:\"value\";s:7:\"#06b6d4\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:12:\"theme_accent\";O:18:\"App\\Models\\Setting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:23;s:3:\"key\";s:12:\"theme_accent\";s:5:\"value\";s:7:\"#facc15\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:23;s:3:\"key\";s:12:\"theme_accent\";s:5:\"value\";s:7:\"#facc15\";s:5:\"group\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:10:\"created_at\";s:19:\"2026-07-09 18:19:19\";s:10:\"updated_at\";s:19:\"2026-07-09 18:19:19\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:3:\"key\";i:1;s:5:\"value\";i:2;s:5:\"group\";i:3;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621459),
('site.slides', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1783621316);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `normal_side` varchar(255) NOT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `code`, `name`, `type`, `category`, `normal_side`, `description`, `is_active`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1010', 'Cash & Cash Equivalents', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(2, '1020', 'Bank Account - Main', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(3, '1030', 'MTN MoMo Wallet', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(4, '1040', 'Airtel Money Wallet', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(5, '1050', 'Petty Cash', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(6, '1100', 'Loans Receivable', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(7, '1101', 'Loan Interest Receivable', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(8, '1110', 'Staff Loans', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(9, '1200', 'Accounts Receivable', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(10, '1210', 'Accrued Income', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(11, '1300', 'Prepayments', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(12, '1400', 'Investments', 'asset', 'non_current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(13, '1500', 'Fixed Assets', 'asset', 'non_current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(14, '1510', 'Accumulated Depreciation', 'asset', 'non_current_asset', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(15, '1520', 'Computer Equipment', 'asset', 'non_current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(16, '1530', 'Office Furniture', 'asset', 'non_current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(17, '1540', 'Motor Vehicles', 'asset', 'non_current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(18, '1600', 'Inventory', 'asset', 'current_asset', 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(19, '2010', 'Members\' Savings Deposits', 'liability', 'current_liability', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(20, '2100', 'Accounts Payable', 'liability', 'current_liability', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(21, '2110', 'Accrued Expenses', 'liability', 'current_liability', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(22, '2120', 'Interest Payable', 'liability', 'current_liability', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(23, '2200', 'Loans Payable', 'liability', 'non_current_liability', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(24, '2210', 'Borrowings', 'liability', 'non_current_liability', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(25, '3010', 'Share Capital', 'equity', 'equity', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(26, '3020', 'Retained Earnings', 'equity', 'equity', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(27, '3030', 'Revenue Reserves', 'equity', 'equity', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(28, '3100', 'Current Year Earnings', 'equity', 'equity', 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(29, '4010', 'Loan Interest Income', 'income', NULL, 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(30, '4020', 'Loan Application Fees', 'income', NULL, 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(31, '4030', 'Penalty Fees', 'income', NULL, 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(32, '4040', 'Membership Fees', 'income', NULL, 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(33, '4100', 'Investment Income', 'income', NULL, 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(34, '4110', 'Bank Interest Income', 'income', NULL, 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(35, '4200', 'Other Income', 'income', NULL, 'credit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(36, '5010', 'Staff Salaries', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(37, '5020', 'Staff Benefits', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(38, '5030', 'Rent & Utilities', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(39, '5040', 'Office Supplies', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(40, '5050', 'Communication Costs', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(41, '5060', 'Transport & Travel', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(42, '5070', 'Depreciation Expense', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(43, '5080', 'Bank Charges', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(44, '5090', 'Insurance', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(45, '5100', 'Audit & Legal Fees', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(46, '5110', 'Training & Capacity Building', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(47, '5120', 'Marketing & Promotion', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(48, '5130', 'Repairs & Maintenance', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(49, '5140', 'Interest Expense', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(50, '5150', 'Loan Loss Provision', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(51, '5200', 'Other Expenses', 'expense', NULL, 'debit', NULL, 1, NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `head_of_department_id` bigint UNSIGNED DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dividends`
--

CREATE TABLE `dividends` (
  `id` bigint UNSIGNED NOT NULL,
  `financial_year` varchar(255) NOT NULL,
  `total_amount` bigint UNSIGNED NOT NULL,
  `per_share_rate` bigint UNSIGNED NOT NULL,
  `declaration_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `notes` text,
  `declared_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dividend_allocations`
--

CREATE TABLE `dividend_allocations` (
  `id` bigint UNSIGNED NOT NULL,
  `dividend_id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `share_account_id` bigint UNSIGNED NOT NULL,
  `shares_held` int UNSIGNED NOT NULL,
  `amount` bigint UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `employee_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `salary` bigint NOT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `nssf_number` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `employment_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_assets`
--

CREATE TABLE `fixed_assets` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `category` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_cost` bigint NOT NULL,
  `depreciation_method` varchar(255) NOT NULL,
  `useful_life_years` int NOT NULL,
  `salvage_value` bigint NOT NULL DEFAULT '0',
  `book_value` bigint NOT NULL,
  `current_value` bigint NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `location` varchar(255) DEFAULT NULL,
  `asset_tag` varchar(255) DEFAULT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text,
  `unit_of_measure` varchar(255) NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `unit_cost` bigint NOT NULL DEFAULT '0',
  `total_value` bigint NOT NULL DEFAULT '0',
  `reorder_level` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transactions`
--

CREATE TABLE `inventory_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `inventory_item_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `unit_cost` bigint NOT NULL,
  `total_cost` bigint NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `amount` bigint NOT NULL,
  `rate` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `maturity_date` date NOT NULL,
  `interest_earned` bigint NOT NULL DEFAULT '0',
  `total_return` bigint DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(255) NOT NULL,
  `description` text,
  `posted_by` bigint UNSIGNED NOT NULL,
  `is_posted` tinyint(1) NOT NULL DEFAULT '1',
  `reversal_of` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_entry_lines`
--

CREATE TABLE `journal_entry_lines` (
  `id` bigint UNSIGNED NOT NULL,
  `journal_entry_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint UNSIGNED DEFAULT NULL,
  `debit` bigint NOT NULL DEFAULT '0',
  `credit` bigint NOT NULL DEFAULT '0',
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` int NOT NULL,
  `reason` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `loan_product_id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `application_number` varchar(255) NOT NULL,
  `applied_amount` bigint UNSIGNED NOT NULL,
  `approved_amount` bigint UNSIGNED DEFAULT NULL,
  `disbursed_amount` bigint UNSIGNED DEFAULT NULL,
  `term_months` smallint UNSIGNED NOT NULL,
  `interest_rate` decimal(5,4) NOT NULL,
  `purpose` text,
  `disbursement_method` enum('cash','bank','mtn_momo','airtel_money') NOT NULL,
  `status` enum('draft','pending','under_review','approved','rejected','disbursed','active','overdue','restructured','written_off','closed') NOT NULL DEFAULT 'draft',
  `credit_score` smallint UNSIGNED DEFAULT NULL,
  `rejection_reason` text,
  `disbursed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `member_id`, `loan_product_id`, `branch_id`, `application_number`, `applied_amount`, `approved_amount`, `disbursed_amount`, `term_months`, `interest_rate`, `purpose`, `disbursement_method`, `status`, `credit_score`, `rejection_reason`, `disbursed_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'LN-2026-001', 3000000, 3000000, 3000000, 12, 0.0800, 'Purchase of maize seeds and fertilizers for the season.', 'cash', 'disbursed', 720, NULL, '2026-04-09 13:43:02', '2026-04-09 13:43:02', '2026-07-09 13:43:02', NULL),
(2, 2, 2, 1, 'LN-2026-002', 8000000, 8000000, 8000000, 18, 0.1200, 'Restocking retail shop.', 'bank', 'disbursed', 690, NULL, '2026-05-09 13:43:02', '2026-05-09 13:43:02', '2026-07-09 13:43:02', NULL),
(3, 3, 3, 2, 'LN-2026-003', 1500000, NULL, NULL, 4, 0.0600, 'Payment of secondary school fees.', 'cash', 'pending', 610, NULL, NULL, '2026-07-04 13:43:03', '2026-07-09 13:43:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_approvals`
--

CREATE TABLE `loan_approvals` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint UNSIGNED NOT NULL,
  `level` tinyint UNSIGNED NOT NULL,
  `approver_id` bigint UNSIGNED NOT NULL,
  `action` enum('approved','rejected') NOT NULL,
  `reason` text,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_collaterals`
--

CREATE TABLE `loan_collaterals` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text,
  `estimated_value` bigint UNSIGNED NOT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_products`
--

CREATE TABLE `loan_products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text,
  `min_amount` bigint UNSIGNED NOT NULL,
  `max_amount` bigint UNSIGNED NOT NULL,
  `min_term` smallint UNSIGNED NOT NULL,
  `max_term` smallint UNSIGNED NOT NULL,
  `interest_rate` decimal(5,4) NOT NULL,
  `interest_method` enum('flat','reducing','compound') NOT NULL,
  `penalty_rate` decimal(8,6) NOT NULL,
  `grace_period` smallint UNSIGNED NOT NULL DEFAULT '0',
  `processing_fee` decimal(5,4) NOT NULL DEFAULT '0.0000',
  `insurance_fee` decimal(5,4) NOT NULL DEFAULT '0.0000',
  `max_loan_to_savings` decimal(5,2) DEFAULT NULL,
  `max_loan_to_share` decimal(5,2) DEFAULT NULL,
  `collateral_required` tinyint(1) NOT NULL DEFAULT '0',
  `category` enum('Agriculture','BodaBoda','Salary','Business','Group','Emergency','SchoolFees','Housing','Transport','General') NOT NULL,
  `approval_levels` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loan_products`
--

INSERT INTO `loan_products` (`id`, `name`, `code`, `description`, `min_amount`, `max_amount`, `min_term`, `max_term`, `interest_rate`, `interest_method`, `penalty_rate`, `grace_period`, `processing_fee`, `insurance_fee`, `max_loan_to_savings`, `max_loan_to_share`, `collateral_required`, `category`, `approval_levels`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Agriculture Loan', 'LP-AGRI', 'Low-interest loans for farmers to purchase seeds, fertilizer, and agricultural equipment.', 500000, 10000000, 3, 24, 0.0200, 'reducing', 0.001000, 30, 0.0150, 0.0050, 3.00, 4.00, 1, 'Agriculture', NULL, 1, '2026-07-09 13:43:01', '2026-07-09 13:43:01'),
(2, 'Business Growth Loan', 'LP-BIZ', 'Designed to assist small-to-medium enterprises with working capital.', 1000000, 30000000, 6, 36, 0.0200, 'reducing', 0.001000, 15, 0.0200, 0.0050, 3.00, 4.00, 1, 'Business', NULL, 1, '2026-07-09 13:43:01', '2026-07-09 13:43:01'),
(3, 'School Fees Loan', 'LP-EDU', 'Short term loan to cover educational expenses for members children.', 200000, 3000000, 1, 6, 0.0200, 'flat', 0.002000, 0, 0.0100, 0.0050, 2.00, 3.00, 0, 'SchoolFees', NULL, 1, '2026-07-09 13:43:01', '2026-07-09 13:43:01'),
(4, 'Emergency Loan', 'LP-EMERG', 'Fast disbursed loans to handle unforeseen emergencies like medical bills.', 100000, 1500005, 1, 4, 0.0300, 'flat', 0.001500, 0, 0.0100, 0.0020, 1.50, 2.00, 0, 'Emergency', NULL, 1, '2026-07-09 13:43:01', '2026-07-09 13:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayments`
--

CREATE TABLE `loan_repayments` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint UNSIGNED NOT NULL,
  `amount` bigint UNSIGNED NOT NULL,
  `principal_paid` bigint UNSIGNED NOT NULL,
  `interest_paid` bigint UNSIGNED NOT NULL,
  `penalty_paid` bigint UNSIGNED NOT NULL DEFAULT '0',
  `balance` bigint UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `paid_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedules`
--

CREATE TABLE `loan_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `principal_due` bigint UNSIGNED NOT NULL,
  `interest_due` bigint UNSIGNED NOT NULL,
  `penalty_due` bigint UNSIGNED NOT NULL DEFAULT '0',
  `total_due` bigint UNSIGNED NOT NULL,
  `paid_amount` bigint UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('pending','partial','paid','overdue') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_histories`
--

CREATE TABLE `login_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_histories`
--

INSERT INTO `login_histories` (`id`, `user_id`, `ip_address`, `user_agent`, `success`, `created_at`) VALUES
(1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 1, '2026-07-09 15:07:36'),
(2, 2, '127.0.0.1', 'Symfony', 1, '2026-07-09 15:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `membership_number` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('M','F','Other') NOT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` text,
  `district` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `employer` varchar(255) DEFAULT NULL,
  `monthly_income` bigint UNSIGNED DEFAULT NULL,
  `next_of_kin_name` varchar(255) DEFAULT NULL,
  `next_of_kin_phone` varchar(255) DEFAULT NULL,
  `next_of_kin_relationship` varchar(255) DEFAULT NULL,
  `category` enum('Regular','Associate','Institutional','Group') NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('pending','active','dormant','suspended','blacklisted','deceased') NOT NULL DEFAULT 'pending',
  `blacklist_reason` text,
  `blacklisted_by` bigint UNSIGNED DEFAULT NULL,
  `blacklisted_at` timestamp NULL DEFAULT NULL,
  `joined_at` date DEFAULT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `membership_number`, `full_name`, `dob`, `gender`, `national_id`, `passport_number`, `photo`, `address`, `district`, `phone`, `email`, `occupation`, `employer`, `monthly_income`, `next_of_kin_name`, `next_of_kin_phone`, `next_of_kin_relationship`, `category`, `branch_id`, `status`, `blacklist_reason`, `blacklisted_by`, `blacklisted_at`, `joined_at`, `qr_code_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'MS-2026-0001', 'Test Member', '1990-01-01', 'M', 'CM90012345XYZ', NULL, NULL, NULL, NULL, '0700000001', 'testmember@example.test', 'Farmer', 'Self Employed', 750000, NULL, NULL, NULL, 'Regular', 1, 'active', NULL, NULL, NULL, '2024-03-15', NULL, '2026-07-09 13:43:01', '2026-07-09 13:43:01', NULL),
(2, 'MS-2026-0002', 'Mukasa Joseph', '1985-05-12', 'M', 'CM85054321ABC', NULL, NULL, NULL, NULL, '0772111222', 'joseph.mukasa@example.test', 'Trader', 'Mukasa Retail Shop', 1800000, NULL, NULL, NULL, 'Regular', 1, 'active', NULL, NULL, NULL, '2023-01-10', NULL, '2026-07-09 13:43:02', '2026-07-09 13:43:02', NULL),
(3, 'MS-2026-0003', 'Nakitende Florence', '1992-09-22', 'F', 'CF92097654DEF', NULL, NULL, NULL, NULL, '0754888999', 'florence.nakitende@example.test', 'Teacher', 'Mubende Primary School', 600000, NULL, NULL, NULL, 'Regular', 2, 'active', NULL, NULL, NULL, '2025-02-18', NULL, '2026-07-09 13:43:02', '2026-07-09 13:43:02', NULL),
(4, 'MS-2026-0004', 'Atwine Ronald', '1988-11-30', 'M', 'CM88112233GHI', NULL, NULL, NULL, NULL, '0702444555', 'ronald.atwine@example.test', 'Boda Boda Operator', 'Self Employed', 1200000, NULL, NULL, NULL, 'Regular', 3, 'active', NULL, NULL, NULL, '2024-07-01', NULL, '2026-07-09 13:43:03', '2026-07-09 13:43:03', NULL),
(5, 'MS-2026-0005', 'Asiimwe Patience', '1995-07-04', 'F', 'CF95079988JKL', NULL, NULL, NULL, NULL, '0775333222', 'patience.asiimwe@example.test', 'Tailor', 'Patience Fashion Hub', 950000, NULL, NULL, NULL, 'Regular', 1, 'active', NULL, NULL, NULL, '2024-11-20', NULL, '2026-07-09 13:43:03', '2026-07-09 13:43:03', NULL),
(6, 'MS-2026-0006', 'Mubende Farmers Group', '2010-06-15', 'Other', NULL, NULL, NULL, NULL, NULL, '0788222333', 'farmersgroup@example.test', 'Cooperative Group', 'Community Members', 5000000, NULL, NULL, NULL, 'Group', 1, 'active', NULL, NULL, NULL, '2023-05-15', NULL, '2026-07-09 13:43:04', '2026-07-09 13:43:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_beneficiaries`
--

CREATE TABLE `member_beneficiaries` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `percentage_share` decimal(5,2) NOT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_documents`
--

CREATE TABLE `member_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `type` enum('NationalID','Passport','EmploymentLetter','Other') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rejection_reason` text,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_guarantors`
--

CREATE TABLE `member_guarantors` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `guarantor_member_id` bigint UNSIGNED NOT NULL,
  `max_amount` bigint UNSIGNED NOT NULL,
  `status` enum('pending','active','released') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_notes`
--

CREATE TABLE `member_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_number_sequences`
--

CREATE TABLE `member_number_sequences` (
  `id` bigint UNSIGNED NOT NULL,
  `year` year NOT NULL,
  `last_sequence` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_10_200851_create_pages_table', 1),
(5, '2026_05_10_200851_create_services_table', 1),
(6, '2026_05_10_200852_create_team_members_table', 1),
(7, '2026_05_10_200853_create_news_events_table', 1),
(8, '2026_05_10_200854_create_faqs_table', 1),
(9, '2026_05_10_200855_create_partners_table', 1),
(10, '2026_05_10_200856_create_contacts_table', 1),
(11, '2026_05_10_200857_create_applications_table', 1),
(12, '2026_05_10_200858_create_settings_table', 1),
(13, '2026_06_26_222203_create_permission_tables', 1),
(14, '2026_06_27_000001_add_group_type_to_settings_table', 1),
(15, '2026_06_27_000002_create_slides_table', 1),
(16, '2026_06_27_000003_create_branches_table', 1),
(17, '2026_06_27_000004_create_audit_logs_table', 1),
(18, '2026_06_27_000005_create_members_table', 2),
(19, '2026_06_27_000006_create_member_documents_table', 2),
(20, '2026_06_27_000007_create_member_beneficiaries_table', 2),
(21, '2026_06_27_000008_create_member_guarantors_table', 2),
(22, '2026_06_27_000009_create_member_notes_table', 2),
(23, '2026_06_27_000010_create_member_number_sequences_table', 2),
(24, '2026_06_27_000011_create_loan_products_table', 2),
(25, '2026_06_27_000012_create_loans_table', 2),
(26, '2026_06_27_000013_create_loan_collaterals_table', 2),
(27, '2026_06_27_000014_create_loan_approvals_table', 2),
(28, '2026_06_27_000015_create_loan_repayments_table', 2),
(29, '2026_06_27_000016_create_loan_schedules_table', 2),
(30, '2026_06_27_000017_add_2fa_to_users_table', 2),
(31, '2026_06_27_000018_add_lockout_to_users_table', 2),
(32, '2026_06_27_000019_create_login_histories_table', 2),
(33, '2026_06_27_000020_create_user_ip_allowlists_table', 2),
(34, '2026_06_27_000021_create_scheduled_job_logs_table', 2),
(35, '2026_06_27_000022_create_savings_accounts_table', 2),
(36, '2026_06_27_000023_create_savings_transactions_table', 2),
(37, '2026_06_27_000024_create_share_accounts_table', 2),
(38, '2026_06_27_000025_create_share_transactions_table', 2),
(39, '2026_06_27_000026_create_dividends_table', 2),
(40, '2026_06_27_000027_create_dividend_allocations_table', 2),
(41, '2026_06_27_000028_create_chart_of_accounts_table', 2),
(42, '2026_06_27_000029_create_journal_entries_table', 2),
(43, '2026_06_27_000030_create_journal_entry_lines_table', 2),
(44, '2026_06_27_000031_create_fixed_assets_table', 2),
(45, '2026_06_27_000032_create_inventory_items_table', 2),
(46, '2026_06_27_000033_create_inventory_transactions_table', 2),
(47, '2026_06_27_000034_create_investments_table', 2),
(48, '2026_06_27_212648_create_imports_table', 2),
(49, '2026_06_27_212649_create_exports_table', 2),
(50, '2026_06_27_212650_create_failed_import_rows_table', 2),
(51, '2026_06_28_000031_create_mobile_money_transactions_table', 2),
(52, '2026_06_28_000032_create_sms_logs_table', 2),
(53, '2026_06_28_000033_create_departments_table', 2),
(54, '2026_06_28_000034_create_employees_table', 2),
(55, '2026_06_28_000035_create_payroll_runs_table', 2),
(56, '2026_06_28_000036_create_payroll_items_table', 2),
(57, '2026_06_28_000037_create_leave_requests_table', 2),
(58, '2026_06_28_000038_create_attendance_table', 2),
(59, '2026_06_30_100643_drop_filament_tables', 2),
(60, '2026_07_04_000001_add_fields_to_applications_table', 2),
(61, '2026_07_05_000001_make_branch_id_nullable_in_members', 2),
(62, '2026_07_05_130222_modify_savings_accounts_add_pending_and_approval', 2),
(63, '2026_07_05_130254_modify_member_documents_add_status_and_approval', 2),
(64, '2026_07_08_120801_alter_loan_approvals_make_approved_at_nullable', 2),
(65, '2026_07_08_124623_add_indexes_to_core_tables', 2),
(66, '2026_07_08_124623_add_soft_deletes_to_core_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_money_transactions`
--

CREATE TABLE `mobile_money_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `savings_account_id` bigint UNSIGNED DEFAULT NULL,
  `member_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('deposit','withdrawal','transfer','payment') NOT NULL,
  `provider` enum('mtn','airtel') NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `amount` bigint UNSIGNED NOT NULL,
  `fee` bigint UNSIGNED NOT NULL DEFAULT '0',
  `reference` varchar(255) NOT NULL,
  `external_reference` varchar(255) DEFAULT NULL,
  `description` text,
  `status` enum('pending','processing','success','failed') NOT NULL DEFAULT 'pending',
  `initiated_by` bigint UNSIGNED DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `failure_reason` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE `news_events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_description` text,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_items`
--

CREATE TABLE `payroll_items` (
  `id` bigint UNSIGNED NOT NULL,
  `payroll_run_id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `gross_pay` bigint NOT NULL,
  `basic_pay` bigint NOT NULL,
  `allowances` bigint NOT NULL DEFAULT '0',
  `deductions` bigint NOT NULL DEFAULT '0',
  `paye` bigint NOT NULL DEFAULT '0',
  `nssf_employee` bigint NOT NULL DEFAULT '0',
  `nssf_employer` bigint NOT NULL DEFAULT '0',
  `net_pay` bigint NOT NULL,
  `overtime_pay` bigint NOT NULL DEFAULT '0',
  `bonus` bigint NOT NULL DEFAULT '0',
  `hours_worked` int DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_runs`
--

CREATE TABLE `payroll_runs` (
  `id` bigint UNSIGNED NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `payment_date` date NOT NULL,
  `total_gross` bigint NOT NULL,
  `total_deductions` bigint NOT NULL,
  `total_net` bigint NOT NULL,
  `total_paye` bigint NOT NULL,
  `total_nssf` bigint NOT NULL,
  `total_employer_nssf` bigint NOT NULL,
  `status` varchar(255) NOT NULL,
  `processed_by` bigint UNSIGNED DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'member:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(2, 'member:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(3, 'member:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(4, 'member:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(5, 'member:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(6, 'member:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(7, 'member_document:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(8, 'member_document:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(9, 'member_document:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(10, 'member_document:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(11, 'member_document:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(12, 'member_document:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(13, 'member_beneficiary:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(14, 'member_beneficiary:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(15, 'member_beneficiary:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(16, 'member_beneficiary:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(17, 'member_beneficiary:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(18, 'member_beneficiary:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(19, 'member_guarantor:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(20, 'member_guarantor:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(21, 'member_guarantor:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(22, 'member_guarantor:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(23, 'member_guarantor:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(24, 'member_guarantor:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(25, 'loan:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(26, 'loan:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(27, 'loan:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(28, 'loan:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(29, 'loan:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(30, 'loan:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(31, 'loan_product:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(32, 'loan_product:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(33, 'loan_product:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(34, 'loan_product:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(35, 'loan_product:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(36, 'loan_product:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(37, 'loan_collateral:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(38, 'loan_collateral:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(39, 'loan_collateral:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(40, 'loan_collateral:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(41, 'loan_collateral:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(42, 'loan_collateral:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(43, 'loan_approval:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(44, 'loan_approval:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(45, 'loan_approval:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(46, 'loan_approval:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(47, 'loan_approval:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(48, 'loan_approval:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(49, 'loan_repayment:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(50, 'loan_repayment:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(51, 'loan_repayment:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(52, 'loan_repayment:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(53, 'loan_repayment:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(54, 'loan_repayment:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(55, 'loan_schedule:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(56, 'loan_schedule:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(57, 'loan_schedule:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(58, 'loan_schedule:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(59, 'loan_schedule:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(60, 'loan_schedule:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(61, 'branch:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(62, 'branch:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(63, 'branch:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(64, 'branch:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(65, 'branch:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(66, 'branch:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(67, 'slide:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(68, 'slide:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(69, 'slide:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(70, 'slide:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(71, 'slide:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(72, 'slide:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(73, 'page:view', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(74, 'page:create', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(75, 'page:edit', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(76, 'page:delete', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(77, 'page:approve', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(78, 'page:export', 'web', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(79, 'service:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(80, 'service:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(81, 'service:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(82, 'service:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(83, 'service:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(84, 'service:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(85, 'faq:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(86, 'faq:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(87, 'faq:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(88, 'faq:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(89, 'faq:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(90, 'faq:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(91, 'partner:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(92, 'partner:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(93, 'partner:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(94, 'partner:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(95, 'partner:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(96, 'partner:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(97, 'team_member:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(98, 'team_member:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(99, 'team_member:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(100, 'team_member:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(101, 'team_member:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(102, 'team_member:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(103, 'news_event:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(104, 'news_event:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(105, 'news_event:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(106, 'news_event:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(107, 'news_event:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(108, 'news_event:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(109, 'setting:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(110, 'setting:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(111, 'setting:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(112, 'setting:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(113, 'setting:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(114, 'setting:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(115, 'application:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(116, 'application:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(117, 'application:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(118, 'application:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(119, 'application:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(120, 'application:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(121, 'contact:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(122, 'contact:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(123, 'contact:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(124, 'contact:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(125, 'contact:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(126, 'contact:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(127, 'audit_log:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(128, 'audit_log:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(129, 'audit_log:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(130, 'audit_log:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(131, 'audit_log:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(132, 'audit_log:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(133, 'savings_account:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(134, 'savings_account:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(135, 'savings_account:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(136, 'savings_account:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(137, 'savings_account:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(138, 'savings_account:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(139, 'savings_transaction:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(140, 'savings_transaction:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(141, 'savings_transaction:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(142, 'savings_transaction:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(143, 'savings_transaction:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(144, 'savings_transaction:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(145, 'share_account:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(146, 'share_account:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(147, 'share_account:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(148, 'share_account:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(149, 'share_account:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(150, 'share_account:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(151, 'share_transaction:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(152, 'share_transaction:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(153, 'share_transaction:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(154, 'share_transaction:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(155, 'share_transaction:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(156, 'share_transaction:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(157, 'dividend:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(158, 'dividend:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(159, 'dividend:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(160, 'dividend:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(161, 'dividend:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(162, 'dividend:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(163, 'dividend_allocation:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(164, 'dividend_allocation:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(165, 'dividend_allocation:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(166, 'dividend_allocation:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(167, 'dividend_allocation:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(168, 'dividend_allocation:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(169, 'chart_of_account:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(170, 'chart_of_account:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(171, 'chart_of_account:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(172, 'chart_of_account:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(173, 'chart_of_account:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(174, 'chart_of_account:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(175, 'journal_entry:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(176, 'journal_entry:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(177, 'journal_entry:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(178, 'journal_entry:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(179, 'journal_entry:approve', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(180, 'journal_entry:export', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(181, 'department:view', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(182, 'department:create', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(183, 'department:edit', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(184, 'department:delete', 'web', '2026-07-09 13:42:58', '2026-07-09 13:42:58'),
(185, 'department:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(186, 'department:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(187, 'employee:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(188, 'employee:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(189, 'employee:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(190, 'employee:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(191, 'employee:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(192, 'employee:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(193, 'payroll_run:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(194, 'payroll_run:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(195, 'payroll_run:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(196, 'payroll_run:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(197, 'payroll_run:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(198, 'payroll_run:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(199, 'leave_request:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(200, 'leave_request:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(201, 'leave_request:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(202, 'leave_request:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(203, 'leave_request:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(204, 'leave_request:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(205, 'attendance:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(206, 'attendance:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(207, 'attendance:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(208, 'attendance:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(209, 'attendance:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(210, 'attendance:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(211, 'fixed_asset:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(212, 'fixed_asset:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(213, 'fixed_asset:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(214, 'fixed_asset:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(215, 'fixed_asset:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(216, 'fixed_asset:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(217, 'inventory_item:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(218, 'inventory_item:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(219, 'inventory_item:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(220, 'inventory_item:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(221, 'inventory_item:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(222, 'inventory_item:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(223, 'investment:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(224, 'investment:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(225, 'investment:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(226, 'investment:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(227, 'investment:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(228, 'investment:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(229, 'mobile_money_transaction:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(230, 'mobile_money_transaction:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(231, 'mobile_money_transaction:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(232, 'mobile_money_transaction:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(233, 'mobile_money_transaction:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(234, 'mobile_money_transaction:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(235, 'sms_log:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(236, 'sms_log:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(237, 'sms_log:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(238, 'sms_log:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(239, 'sms_log:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(240, 'sms_log:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(241, 'user:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(242, 'user:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(243, 'user:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(244, 'user:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(245, 'user:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(246, 'user:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(247, 'role:view', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(248, 'role:create', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(249, 'role:edit', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(250, 'role:delete', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(251, 'role:approve', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(252, 'role:export', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(2, 'Branch Manager', 'web', '2026-07-09 13:42:59', '2026-07-09 13:42:59'),
(3, 'Loan Officer', 'web', '2026-07-09 13:43:00', '2026-07-09 13:43:00'),
(4, 'Teller', 'web', '2026-07-09 13:43:00', '2026-07-09 13:43:00'),
(5, 'Accountant', 'web', '2026-07-09 13:43:00', '2026-07-09 13:43:00'),
(6, 'HR Officer', 'web', '2026-07-09 13:43:00', '2026-07-09 13:43:00'),
(7, 'Auditor', 'web', '2026-07-09 13:43:00', '2026-07-09 13:43:00'),
(8, 'Read-Only Viewer', 'web', '2026-07-09 13:43:00', '2026-07-09 13:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(198, 1),
(199, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(206, 1),
(207, 1),
(208, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(213, 1),
(214, 1),
(215, 1),
(216, 1),
(217, 1),
(218, 1),
(219, 1),
(220, 1),
(221, 1),
(222, 1),
(223, 1),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(239, 1),
(240, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(1, 2),
(2, 2),
(3, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(96, 2),
(97, 2),
(98, 2),
(99, 2),
(102, 2),
(103, 2),
(104, 2),
(105, 2),
(108, 2),
(115, 2),
(116, 2),
(117, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
(126, 2),
(133, 2),
(134, 2),
(135, 2),
(138, 2),
(139, 2),
(140, 2),
(141, 2),
(144, 2),
(145, 2),
(146, 2),
(147, 2),
(150, 2),
(151, 2),
(152, 2),
(153, 2),
(156, 2),
(157, 2),
(158, 2),
(159, 2),
(162, 2),
(163, 2),
(164, 2),
(165, 2),
(168, 2),
(169, 2),
(170, 2),
(171, 2),
(174, 2),
(175, 2),
(176, 2),
(177, 2),
(180, 2),
(181, 2),
(182, 2),
(183, 2),
(186, 2),
(187, 2),
(188, 2),
(189, 2),
(192, 2),
(193, 2),
(194, 2),
(195, 2),
(198, 2),
(199, 2),
(200, 2),
(201, 2),
(204, 2),
(205, 2),
(206, 2),
(207, 2),
(210, 2),
(211, 2),
(212, 2),
(213, 2),
(216, 2),
(217, 2),
(218, 2),
(219, 2),
(222, 2),
(223, 2),
(224, 2),
(225, 2),
(228, 2),
(229, 2),
(230, 2),
(231, 2),
(234, 2),
(235, 2),
(236, 2),
(237, 2),
(240, 2),
(1, 3),
(2, 3),
(3, 3),
(25, 3),
(26, 3),
(27, 3),
(31, 3),
(37, 3),
(38, 3),
(39, 3),
(43, 3),
(49, 3),
(55, 3),
(61, 3),
(1, 4),
(25, 4),
(49, 4),
(50, 4),
(61, 4),
(133, 4),
(134, 4),
(135, 4),
(139, 4),
(140, 4),
(1, 5),
(6, 5),
(7, 5),
(12, 5),
(13, 5),
(18, 5),
(19, 5),
(24, 5),
(25, 5),
(30, 5),
(31, 5),
(36, 5),
(37, 5),
(42, 5),
(43, 5),
(48, 5),
(49, 5),
(54, 5),
(55, 5),
(60, 5),
(61, 5),
(66, 5),
(67, 5),
(72, 5),
(73, 5),
(78, 5),
(79, 5),
(84, 5),
(85, 5),
(90, 5),
(91, 5),
(96, 5),
(97, 5),
(102, 5),
(103, 5),
(108, 5),
(109, 5),
(114, 5),
(115, 5),
(120, 5),
(121, 5),
(126, 5),
(127, 5),
(132, 5),
(133, 5),
(138, 5),
(139, 5),
(144, 5),
(145, 5),
(150, 5),
(151, 5),
(156, 5),
(157, 5),
(162, 5),
(163, 5),
(168, 5),
(169, 5),
(170, 5),
(171, 5),
(172, 5),
(174, 5),
(175, 5),
(176, 5),
(177, 5),
(180, 5),
(181, 5),
(186, 5),
(187, 5),
(192, 5),
(193, 5),
(198, 5),
(199, 5),
(204, 5),
(205, 5),
(210, 5),
(211, 5),
(216, 5),
(217, 5),
(222, 5),
(223, 5),
(228, 5),
(229, 5),
(234, 5),
(235, 5),
(240, 5),
(241, 5),
(246, 5),
(247, 5),
(252, 5),
(61, 6),
(181, 6),
(182, 6),
(183, 6),
(184, 6),
(187, 6),
(188, 6),
(189, 6),
(190, 6),
(193, 6),
(194, 6),
(195, 6),
(197, 6),
(198, 6),
(199, 6),
(200, 6),
(201, 6),
(203, 6),
(205, 6),
(206, 6),
(207, 6),
(1, 7),
(6, 7),
(7, 7),
(12, 7),
(13, 7),
(18, 7),
(19, 7),
(24, 7),
(25, 7),
(30, 7),
(31, 7),
(36, 7),
(37, 7),
(42, 7),
(43, 7),
(48, 7),
(49, 7),
(54, 7),
(55, 7),
(60, 7),
(61, 7),
(66, 7),
(67, 7),
(72, 7),
(73, 7),
(78, 7),
(79, 7),
(84, 7),
(85, 7),
(90, 7),
(91, 7),
(96, 7),
(97, 7),
(102, 7),
(103, 7),
(108, 7),
(109, 7),
(114, 7),
(115, 7),
(120, 7),
(121, 7),
(126, 7),
(127, 7),
(132, 7),
(133, 7),
(138, 7),
(139, 7),
(144, 7),
(145, 7),
(150, 7),
(151, 7),
(156, 7),
(157, 7),
(162, 7),
(163, 7),
(168, 7),
(169, 7),
(174, 7),
(175, 7),
(180, 7),
(181, 7),
(186, 7),
(187, 7),
(192, 7),
(193, 7),
(198, 7),
(199, 7),
(204, 7),
(205, 7),
(210, 7),
(211, 7),
(216, 7),
(217, 7),
(222, 7),
(223, 7),
(228, 7),
(229, 7),
(234, 7),
(235, 7),
(240, 7),
(241, 7),
(246, 7),
(247, 7),
(252, 7),
(1, 8),
(7, 8),
(13, 8),
(19, 8),
(25, 8),
(31, 8),
(37, 8),
(43, 8),
(49, 8),
(55, 8),
(61, 8),
(67, 8),
(73, 8),
(79, 8),
(85, 8),
(91, 8),
(97, 8),
(103, 8),
(109, 8),
(115, 8),
(121, 8),
(127, 8),
(133, 8),
(139, 8),
(145, 8),
(151, 8),
(157, 8),
(163, 8),
(169, 8),
(175, 8),
(181, 8),
(187, 8),
(193, 8),
(199, 8),
(205, 8),
(211, 8),
(217, 8),
(223, 8),
(229, 8),
(235, 8),
(241, 8),
(247, 8);

-- --------------------------------------------------------

--
-- Table structure for table `savings_accounts`
--

CREATE TABLE `savings_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_type` enum('Normal','Emergency','Holiday','Children','Education','Target','FixedDeposit','Locked') NOT NULL,
  `balance` bigint UNSIGNED NOT NULL DEFAULT '0',
  `interest_rate` decimal(5,4) NOT NULL DEFAULT '0.0000',
  `target_amount` bigint UNSIGNED DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `status` enum('pending','active','dormant','closed','frozen') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `savings_accounts`
--

INSERT INTO `savings_accounts` (`id`, `member_id`, `branch_id`, `account_number`, `account_type`, `balance`, `interest_rate`, `target_amount`, `maturity_date`, `status`, `created_at`, `updated_at`, `approved_by`, `approved_at`, `deleted_at`) VALUES
(1, 1, 1, 'SV-1-201', 'Normal', 110873, 0.0300, NULL, NULL, 'active', '2026-07-09 13:43:02', '2026-07-09 15:04:49', NULL, NULL, NULL),
(2, 1, 1, 'SV-1-209', 'Target', 450000, 0.0500, 1000000, NULL, 'active', '2026-07-09 13:43:02', '2026-07-09 13:43:02', NULL, NULL, NULL),
(3, 2, 1, 'SV-2-201', 'Normal', 621091, 0.0300, NULL, NULL, 'active', '2026-07-09 13:43:02', '2026-07-09 15:04:49', NULL, NULL, NULL),
(4, 2, 1, 'SV-2-209', 'Target', 450000, 0.0500, 1000000, NULL, 'active', '2026-07-09 13:43:02', '2026-07-09 13:43:02', NULL, NULL, NULL),
(5, 3, 2, 'SV-3-201', 'Normal', 529281, 0.0300, NULL, NULL, 'active', '2026-07-09 13:43:03', '2026-07-09 15:04:50', NULL, NULL, NULL),
(6, 3, 2, 'SV-3-209', 'Target', 450000, 0.0500, 1000000, NULL, 'active', '2026-07-09 13:43:03', '2026-07-09 13:43:03', NULL, NULL, NULL),
(7, 4, 3, 'SV-4-201', 'Normal', 164968, 0.0300, NULL, NULL, 'active', '2026-07-09 13:43:03', '2026-07-09 15:04:50', NULL, NULL, NULL),
(8, 5, 1, 'SV-5-201', 'Normal', 933010, 0.0300, NULL, NULL, 'active', '2026-07-09 13:43:04', '2026-07-09 15:04:50', NULL, NULL, NULL),
(9, 6, 1, 'SV-6-201', 'Normal', 689244, 0.0300, NULL, NULL, 'active', '2026-07-09 13:43:04', '2026-07-09 15:04:51', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `savings_transactions`
--

CREATE TABLE `savings_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `savings_account_id` bigint UNSIGNED NOT NULL,
  `type` enum('deposit','withdrawal','interest','charge') NOT NULL,
  `amount` bigint UNSIGNED NOT NULL,
  `balance_after` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` text,
  `journal_entry_id` bigint UNSIGNED DEFAULT NULL,
  `processed_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `savings_transactions`
--

INSERT INTO `savings_transactions` (`id`, `savings_account_id`, `type`, `amount`, `balance_after`, `reference`, `description`, `journal_entry_id`, `processed_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'deposit', 195076, 195076, 'TXN-SV-8001', 'Cash deposit at branch counter', NULL, 1, '2026-04-20 05:43:02', '2026-04-20 05:43:02'),
(2, 1, 'withdrawal', 193922, 1154, 'TXN-SV-7001', 'Over the counter cash withdrawal', NULL, 1, '2026-04-30 10:43:02', '2026-04-30 10:43:02'),
(3, 1, 'deposit', 89802, 90956, 'TXN-SV-6001', 'Cash deposit at branch counter', NULL, 1, '2026-05-10 11:43:02', '2026-05-10 11:43:02'),
(4, 1, 'deposit', 211809, 302765, 'TXN-SV-5001', 'Cash deposit at branch counter', NULL, 1, '2026-05-20 09:43:02', '2026-05-20 09:43:02'),
(5, 1, 'deposit', 77623, 380388, 'TXN-SV-4001', 'Cash deposit at branch counter', NULL, 1, '2026-05-30 12:43:02', '2026-05-30 12:43:02'),
(6, 1, 'withdrawal', 239802, 140586, 'TXN-SV-3001', 'Over the counter cash withdrawal', NULL, 1, '2026-06-09 05:43:02', '2026-06-09 05:43:02'),
(7, 1, 'deposit', 235226, 375812, 'TXN-SV-2001', 'Cash deposit at branch counter', NULL, 1, '2026-06-19 01:43:02', '2026-06-19 01:43:02'),
(8, 1, 'withdrawal', 80657, 295155, 'TXN-SV-1001', 'Over the counter cash withdrawal', NULL, 1, '2026-06-29 01:43:02', '2026-06-29 01:43:02'),
(9, 2, 'deposit', 450000, 450000, 'TXN-SVT-2000', 'Target savings deposit', NULL, 1, '2026-06-24 13:43:02', '2026-07-09 13:43:02'),
(10, 3, 'deposit', 55935, 55935, 'TXN-SV-8002', 'Cash deposit at branch counter', NULL, 1, '2026-04-20 10:43:02', '2026-04-20 10:43:02'),
(11, 3, 'deposit', 107914, 163849, 'TXN-SV-7002', 'Cash deposit at branch counter', NULL, 1, '2026-04-30 03:43:02', '2026-04-30 03:43:02'),
(12, 3, 'deposit', 280582, 444431, 'TXN-SV-6002', 'Cash deposit at branch counter', NULL, 1, '2026-05-10 03:43:02', '2026-05-10 03:43:02'),
(13, 3, 'withdrawal', 175843, 268588, 'TXN-SV-5002', 'Over the counter cash withdrawal', NULL, 1, '2026-05-20 07:43:02', '2026-05-20 07:43:02'),
(14, 3, 'deposit', 143532, 412120, 'TXN-SV-4002', 'Cash deposit at branch counter', NULL, 1, '2026-05-30 09:43:02', '2026-05-30 09:43:02'),
(15, 3, 'deposit', 75868, 487988, 'TXN-SV-3002', 'Cash deposit at branch counter', NULL, 1, '2026-06-09 09:43:02', '2026-06-09 09:43:02'),
(16, 3, 'withdrawal', 293083, 194905, 'TXN-SV-2002', 'Over the counter cash withdrawal', NULL, 1, '2026-06-19 05:43:02', '2026-06-19 05:43:02'),
(17, 3, 'deposit', 153070, 347975, 'TXN-SV-1002', 'Cash deposit at branch counter', NULL, 1, '2026-06-29 01:43:02', '2026-06-29 01:43:02'),
(18, 4, 'deposit', 450000, 450000, 'TXN-SVT-4000', 'Target savings deposit', NULL, 1, '2026-06-24 13:43:02', '2026-07-09 13:43:02'),
(19, 5, 'deposit', 297026, 297026, 'TXN-SV-8003', 'Cash deposit at branch counter', NULL, 1, '2026-04-20 10:43:03', '2026-04-20 10:43:03'),
(20, 5, 'withdrawal', 126638, 170388, 'TXN-SV-7003', 'Over the counter cash withdrawal', NULL, 1, '2026-04-30 04:43:03', '2026-04-30 04:43:03'),
(21, 5, 'withdrawal', 124779, 45609, 'TXN-SV-6003', 'Over the counter cash withdrawal', NULL, 1, '2026-05-10 08:43:03', '2026-05-10 08:43:03'),
(22, 5, 'deposit', 191057, 236666, 'TXN-SV-5003', 'Cash deposit at branch counter', NULL, 1, '2026-05-20 04:43:03', '2026-05-20 04:43:03'),
(23, 5, 'deposit', 259324, 495990, 'TXN-SV-4003', 'Cash deposit at branch counter', NULL, 1, '2026-05-30 11:43:03', '2026-05-30 11:43:03'),
(24, 5, 'deposit', 205070, 701060, 'TXN-SV-3003', 'Cash deposit at branch counter', NULL, 1, '2026-06-09 04:43:03', '2026-06-09 04:43:03'),
(25, 5, 'deposit', 239101, 940161, 'TXN-SV-2003', 'Cash deposit at branch counter', NULL, 1, '2026-06-19 03:43:03', '2026-06-19 03:43:03'),
(26, 5, 'deposit', 288274, 1228435, 'TXN-SV-1003', 'Cash deposit at branch counter', NULL, 1, '2026-06-29 04:43:03', '2026-06-29 04:43:03'),
(27, 6, 'deposit', 450000, 450000, 'TXN-SVT-6000', 'Target savings deposit', NULL, 1, '2026-06-24 13:43:03', '2026-07-09 13:43:03'),
(28, 7, 'deposit', 187067, 187067, 'TXN-SV-8004', 'Cash deposit at branch counter', NULL, 1, '2026-04-20 07:43:03', '2026-04-20 07:43:03'),
(29, 7, 'deposit', 263755, 450822, 'TXN-SV-7004', 'Cash deposit at branch counter', NULL, 1, '2026-04-30 08:43:03', '2026-04-30 08:43:03'),
(30, 7, 'deposit', 86696, 537518, 'TXN-SV-6004', 'Cash deposit at branch counter', NULL, 1, '2026-05-10 07:43:03', '2026-05-10 07:43:03'),
(31, 7, 'withdrawal', 277951, 259567, 'TXN-SV-5004', 'Over the counter cash withdrawal', NULL, 1, '2026-05-20 09:43:03', '2026-05-20 09:43:03'),
(32, 7, 'deposit', 85692, 345259, 'TXN-SV-4004', 'Cash deposit at branch counter', NULL, 1, '2026-05-30 04:43:03', '2026-05-30 04:43:03'),
(33, 7, 'deposit', 218745, 564004, 'TXN-SV-3004', 'Cash deposit at branch counter', NULL, 1, '2026-06-09 11:43:03', '2026-06-09 11:43:03'),
(34, 7, 'withdrawal', 218913, 345091, 'TXN-SV-2004', 'Over the counter cash withdrawal', NULL, 1, '2026-06-19 05:43:03', '2026-06-19 05:43:03'),
(35, 7, 'deposit', 221670, 566761, 'TXN-SV-1004', 'Cash deposit at branch counter', NULL, 1, '2026-06-29 06:43:03', '2026-06-29 06:43:03'),
(36, 8, 'deposit', 239239, 239239, 'TXN-SV-8005', 'Cash deposit at branch counter', NULL, 1, '2026-04-20 08:43:04', '2026-04-20 08:43:04'),
(37, 8, 'withdrawal', 205976, 33263, 'TXN-SV-7005', 'Over the counter cash withdrawal', NULL, 1, '2026-04-30 07:43:04', '2026-04-30 07:43:04'),
(38, 8, 'deposit', 129954, 163217, 'TXN-SV-6005', 'Cash deposit at branch counter', NULL, 1, '2026-05-10 05:43:04', '2026-05-10 05:43:04'),
(39, 8, 'withdrawal', 97820, 65397, 'TXN-SV-5005', 'Over the counter cash withdrawal', NULL, 1, '2026-05-20 03:43:04', '2026-05-20 03:43:04'),
(40, 8, 'deposit', 245679, 311076, 'TXN-SV-4005', 'Cash deposit at branch counter', NULL, 1, '2026-05-30 07:43:04', '2026-05-30 07:43:04'),
(41, 8, 'withdrawal', 110612, 200464, 'TXN-SV-3005', 'Over the counter cash withdrawal', NULL, 1, '2026-06-09 09:43:04', '2026-06-09 09:43:04'),
(42, 8, 'deposit', 276189, 476653, 'TXN-SV-2005', 'Cash deposit at branch counter', NULL, 1, '2026-06-19 09:43:04', '2026-06-19 09:43:04'),
(43, 8, 'withdrawal', 57669, 418984, 'TXN-SV-1005', 'Over the counter cash withdrawal', NULL, 1, '2026-06-29 09:43:04', '2026-06-29 09:43:04'),
(44, 9, 'deposit', 121364, 121364, 'TXN-SV-8006', 'Cash deposit at branch counter', NULL, 1, '2026-04-20 08:43:04', '2026-04-20 08:43:04'),
(45, 9, 'deposit', 147652, 269016, 'TXN-SV-7006', 'Cash deposit at branch counter', NULL, 1, '2026-04-30 03:43:04', '2026-04-30 03:43:04'),
(46, 9, 'deposit', 222963, 491979, 'TXN-SV-6006', 'Cash deposit at branch counter', NULL, 1, '2026-05-10 09:43:04', '2026-05-10 09:43:04'),
(47, 9, 'deposit', 288607, 780586, 'TXN-SV-5006', 'Cash deposit at branch counter', NULL, 1, '2026-05-20 06:43:04', '2026-05-20 06:43:04'),
(48, 9, 'deposit', 178954, 959540, 'TXN-SV-4006', 'Cash deposit at branch counter', NULL, 1, '2026-05-30 07:43:04', '2026-05-30 07:43:04'),
(49, 9, 'deposit', 66082, 1025622, 'TXN-SV-3006', 'Cash deposit at branch counter', NULL, 1, '2026-06-09 03:43:04', '2026-06-09 03:43:04'),
(50, 9, 'deposit', 243303, 1268925, 'TXN-SV-2006', 'Cash deposit at branch counter', NULL, 1, '2026-06-19 02:43:04', '2026-06-19 02:43:04'),
(51, 9, 'withdrawal', 187276, 1081649, 'TXN-SV-1006', 'Over the counter cash withdrawal', NULL, 1, '2026-06-29 12:43:04', '2026-06-29 12:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_job_logs`
--

CREATE TABLE `scheduled_job_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `job_class` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cron_expression` varchar(255) NOT NULL,
  `last_run_at` timestamp NULL DEFAULT NULL,
  `last_run_status` varchar(255) DEFAULT NULL,
  `next_run_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `type` enum('saving','loan') NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `type`, `created_at`, `updated_at`) VALUES
(1, 'org_name', 'Mubende Employees and Community Sacco Ltd', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:18'),
(2, 'org_logo', 'settings/3BOYuV2NoHIqU1vAyKsfkjLqTQfYksPlBG3qaZOU.jpg', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:19'),
(3, 'org_address', 'Kaweeri Cell, East Division opp Mubende District Head quaters', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:18'),
(4, 'org_phone', '0775125122', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:18'),
(5, 'org_email', 'mubendehq@gmail.com', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:18'),
(6, 'org_registration_number', '6682', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:19'),
(7, 'org_established_year', '1999', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:19'),
(8, 'operating_hours', 'Mon–Fri 08:00–17:00', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:18'),
(9, 'theme_primary_color', '#1a6e3e', 'theme', 'string', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(10, 'theme_accent_color', '#f59e0b', 'theme', 'string', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(11, 'sms_provider', 'africastalking', 'sms', 'string', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(12, 'sms_api_key', '', 'sms', 'encrypted', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(13, 'smtp_host', '', 'mail', 'string', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(14, 'smtp_port', '587', 'mail', 'integer', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(15, 'smtp_user', '', 'mail', 'string', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(16, 'smtp_password', '', 'mail', 'encrypted', '2026-07-09 13:42:57', '2026-07-09 13:42:57'),
(17, 'meta_description', 'Mubende Employees and Community SACCO Ltd — empowering our community through savings and credit in Mubande great region.', 'general', 'text', '2026-07-09 13:42:57', '2026-07-09 15:19:19'),
(18, 'org_favicon', 'settings/tv6V9d827OZR24nasRP47iY7ohfXOkI6K4X1ExxL.jpg', 'general', 'text', '2026-07-09 15:19:19', '2026-07-09 15:19:19'),
(19, 'meta_keywords', NULL, 'general', 'text', '2026-07-09 15:19:19', '2026-07-09 15:19:19'),
(20, 'hero_copy', NULL, 'general', 'text', '2026-07-09 15:19:19', '2026-07-09 15:19:19'),
(21, 'theme_primary', '#10b981', 'general', 'text', '2026-07-09 15:19:19', '2026-07-09 15:19:19'),
(22, 'theme_secondary', '#06b6d4', 'general', 'text', '2026-07-09 15:19:19', '2026-07-09 15:19:19'),
(23, 'theme_accent', '#facc15', 'general', 'text', '2026-07-09 15:19:19', '2026-07-09 15:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `share_accounts`
--

CREATE TABLE `share_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `total_shares` int UNSIGNED NOT NULL DEFAULT '0',
  `share_value` bigint UNSIGNED NOT NULL DEFAULT '5000',
  `balance` bigint UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('active','dormant','closed') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `share_accounts`
--

INSERT INTO `share_accounts` (`id`, `member_id`, `branch_id`, `account_number`, `total_shares`, `share_value`, `balance`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'SH-1-101', 34, 5000, 170000, 'active', '2026-07-09 13:43:02', '2026-07-09 13:43:02', NULL),
(2, 2, 1, 'SH-2-101', 94, 5000, 470000, 'active', '2026-07-09 13:43:02', '2026-07-09 13:43:02', NULL),
(3, 3, 2, 'SH-3-101', 142, 5000, 710000, 'active', '2026-07-09 13:43:03', '2026-07-09 13:43:03', NULL),
(4, 4, 3, 'SH-4-101', 56, 5000, 280000, 'active', '2026-07-09 13:43:03', '2026-07-09 13:43:03', NULL),
(5, 5, 1, 'SH-5-101', 114, 5000, 570000, 'active', '2026-07-09 13:43:04', '2026-07-09 13:43:04', NULL),
(6, 6, 1, 'SH-6-101', 80, 5000, 400000, 'active', '2026-07-09 13:43:04', '2026-07-09 13:43:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `share_transactions`
--

CREATE TABLE `share_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `share_account_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `shares` int UNSIGNED NOT NULL,
  `amount` bigint UNSIGNED NOT NULL,
  `share_value_at_time` bigint UNSIGNED NOT NULL,
  `method` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `share_transactions`
--

INSERT INTO `share_transactions` (`id`, `share_account_id`, `type`, `shares`, `amount`, `share_value_at_time`, `method`, `reference`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'purchase', 34, 170000, 5000, 'cash', 'TXN-SH-INIT', 'Initial share purchase upon joining.', NULL, '2026-07-09 13:43:02', '2026-07-09 13:43:02'),
(2, 2, 'purchase', 94, 470000, 5000, 'cash', 'TXN-SH-INIT', 'Initial share purchase upon joining.', NULL, '2026-07-09 13:43:02', '2026-07-09 13:43:02'),
(3, 3, 'purchase', 142, 710000, 5000, 'cash', 'TXN-SH-INIT', 'Initial share purchase upon joining.', NULL, '2026-07-09 13:43:03', '2026-07-09 13:43:03'),
(4, 4, 'purchase', 56, 280000, 5000, 'cash', 'TXN-SH-INIT', 'Initial share purchase upon joining.', NULL, '2026-07-09 13:43:03', '2026-07-09 13:43:03'),
(5, 5, 'purchase', 114, 570000, 5000, 'cash', 'TXN-SH-INIT', 'Initial share purchase upon joining.', NULL, '2026-07-09 13:43:04', '2026-07-09 13:43:04'),
(6, 6, 'purchase', 80, 400000, 5000, 'cash', 'TXN-SH-INIT', 'Initial share purchase upon joining.', NULL, '2026-07-09 13:43:04', '2026-07-09 13:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `cta_text` varchar(255) DEFAULT NULL,
  `cta_url` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_logs`
--

CREATE TABLE `sms_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `provider` varchar(255) NOT NULL DEFAULT 'africastalking',
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `reference` varchar(255) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `segments_count` int NOT NULL DEFAULT '1',
  `attempts` tinyint NOT NULL DEFAULT '0',
  `cost` decimal(10,4) DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `failure_reason` text,
  `related_type` varchar(255) DEFAULT NULL,
  `related_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `bio` text,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `failed_login_attempts` tinyint NOT NULL DEFAULT '0',
  `locked_at` timestamp NULL DEFAULT NULL,
  `google2fa_secret` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `failed_login_attempts`, `locked_at`, `google2fa_secret`, `created_at`, `updated_at`) VALUES
(1, 'Mubende SACCO Admin', 'admin@gmail.com', '2026-07-09 13:42:56', '$2y$12$rtJnMJ8dY5VUzKMeFwoWMOZ7cO.71RImySu2lFlMMWQkUwZqxUVgO', NULL, 0, NULL, NULL, '2026-07-09 13:42:56', '2026-07-09 13:42:57'),
(2, 'Test Member', 'testmember@example.test', NULL, '$2y$12$JuaOmtSDDk00JKxhIqtrpOrW/nUBmkWSOZafhR0i1OsBnHuneUQJK', NULL, 0, NULL, NULL, '2026-07-09 13:43:02', '2026-07-09 15:04:49'),
(3, 'Mukasa Joseph', 'joseph.mukasa@example.test', NULL, '$2y$12$jywqwH5MsLU2dB9LGevJ4ehzAa2RRmcRU7arhg.iuD49BE4E.uWyC', NULL, 0, NULL, NULL, '2026-07-09 13:43:02', '2026-07-09 15:04:49'),
(4, 'Nakitende Florence', 'florence.nakitende@example.test', NULL, '$2y$12$U6zBrKjsTsRjss7dAniQ7uP93XEYqKxVLDciTjM4uqkFvtQTLe60u', NULL, 0, NULL, NULL, '2026-07-09 13:43:03', '2026-07-09 15:04:50'),
(5, 'Atwine Ronald', 'ronald.atwine@example.test', NULL, '$2y$12$V7szZqfFKF5XuK8yuOLzd.FRQSiSmALkog0dhoq9DNvs3FysF6Gj.', NULL, 0, NULL, NULL, '2026-07-09 13:43:03', '2026-07-09 15:04:50'),
(6, 'Asiimwe Patience', 'patience.asiimwe@example.test', NULL, '$2y$12$LzWWjMYH8nZfzBdiSyggXu.L.8Z5gkSK5rqI5wLTNd1WV5imAw/EO', NULL, 0, NULL, NULL, '2026-07-09 13:43:04', '2026-07-09 15:04:50'),
(7, 'Mubende Farmers Group', 'farmersgroup@example.test', NULL, '$2y$12$hG3xHDtwp2.PMQjxM8iDfuDSXwE7RqKuTVlwbWhLZogRKuANbNt56', NULL, 0, NULL, NULL, '2026-07-09 13:43:04', '2026-07-09 15:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_ip_allowlists`
--

CREATE TABLE `user_ip_allowlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_status_index` (`status`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendance_employee_id_date_unique` (`employee_id`,`date`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_index` (`user_id`),
  ADD KEY `audit_logs_action_index` (`action`),
  ADD KEY `audit_logs_model_type_index` (`model_type`),
  ADD KEY `audit_logs_model_id_index` (`model_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_code_unique` (`code`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chart_of_accounts_code_unique` (`code`),
  ADD KEY `chart_of_accounts_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_code_unique` (`code`),
  ADD KEY `departments_branch_id_foreign` (`branch_id`),
  ADD KEY `departments_head_of_department_id_index` (`head_of_department_id`);

--
-- Indexes for table `dividends`
--
ALTER TABLE `dividends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dividends_declared_by_foreign` (`declared_by`);

--
-- Indexes for table `dividend_allocations`
--
ALTER TABLE `dividend_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dividend_allocations_dividend_id_foreign` (`dividend_id`),
  ADD KEY `dividend_allocations_member_id_foreign` (`member_id`),
  ADD KEY `dividend_allocations_share_account_id_foreign` (`share_account_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_employee_number_unique` (`employee_number`),
  ADD KEY `employees_member_id_foreign` (`member_id`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

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
-- Indexes for table `fixed_assets`
--
ALTER TABLE `fixed_assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fixed_assets_asset_tag_unique` (`asset_tag`),
  ADD KEY `fixed_assets_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_items_sku_unique` (`sku`),
  ADD KEY `inventory_items_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_transactions_inventory_item_id_foreign` (`inventory_item_id`),
  ADD KEY `inventory_transactions_created_by_foreign` (`created_by`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investments_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `journal_entries_reference_unique` (`reference`),
  ADD KEY `journal_entries_posted_by_foreign` (`posted_by`),
  ADD KEY `journal_entries_reversal_of_foreign` (`reversal_of`);

--
-- Indexes for table `journal_entry_lines`
--
ALTER TABLE `journal_entry_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_entry_lines_journal_entry_id_foreign` (`journal_entry_id`),
  ADD KEY `journal_entry_lines_account_id_foreign` (`account_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_requests_employee_id_foreign` (`employee_id`),
  ADD KEY `leave_requests_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loans_application_number_unique` (`application_number`),
  ADD KEY `loans_member_id_index` (`member_id`),
  ADD KEY `loans_loan_product_id_index` (`loan_product_id`),
  ADD KEY `loans_branch_id_index` (`branch_id`),
  ADD KEY `loans_status_index` (`status`);

--
-- Indexes for table `loan_approvals`
--
ALTER TABLE `loan_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_approvals_loan_id_index` (`loan_id`),
  ADD KEY `loan_approvals_approver_id_index` (`approver_id`);

--
-- Indexes for table `loan_collaterals`
--
ALTER TABLE `loan_collaterals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_collaterals_loan_id_index` (`loan_id`);

--
-- Indexes for table `loan_products`
--
ALTER TABLE `loan_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loan_products_code_unique` (`code`);

--
-- Indexes for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_repayments_loan_id_index` (`loan_id`);

--
-- Indexes for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_schedules_loan_id_index` (`loan_id`),
  ADD KEY `loan_schedules_due_date_index` (`due_date`),
  ADD KEY `loan_schedules_status_index` (`status`);

--
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_membership_number_unique` (`membership_number`),
  ADD KEY `members_branch_id_index` (`branch_id`),
  ADD KEY `members_blacklisted_by_index` (`blacklisted_by`),
  ADD KEY `members_status_index` (`status`),
  ADD KEY `members_category_index` (`category`),
  ADD KEY `members_joined_at_index` (`joined_at`);

--
-- Indexes for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_beneficiaries_member_id_index` (`member_id`);

--
-- Indexes for table `member_documents`
--
ALTER TABLE `member_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_documents_approved_by_foreign` (`approved_by`),
  ADD KEY `member_documents_member_id_index` (`member_id`);

--
-- Indexes for table `member_guarantors`
--
ALTER TABLE `member_guarantors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_guarantors_member_id_index` (`member_id`),
  ADD KEY `member_guarantors_guarantor_member_id_index` (`guarantor_member_id`);

--
-- Indexes for table `member_notes`
--
ALTER TABLE `member_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_notes_member_id_index` (`member_id`),
  ADD KEY `member_notes_user_id_index` (`user_id`);

--
-- Indexes for table `member_number_sequences`
--
ALTER TABLE `member_number_sequences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_number_sequences_year_unique` (`year`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_money_transactions`
--
ALTER TABLE `mobile_money_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_money_transactions_reference_unique` (`reference`),
  ADD KEY `mobile_money_transactions_savings_account_id_foreign` (`savings_account_id`),
  ADD KEY `mobile_money_transactions_member_id_foreign` (`member_id`),
  ADD KEY `mobile_money_transactions_initiated_by_foreign` (`initiated_by`);

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
-- Indexes for table `news_events`
--
ALTER TABLE `news_events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_events_slug_unique` (`slug`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payroll_items`
--
ALTER TABLE `payroll_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_items_payroll_run_id_foreign` (`payroll_run_id`),
  ADD KEY `payroll_items_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `payroll_runs`
--
ALTER TABLE `payroll_runs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_runs_processed_by_foreign` (`processed_by`),
  ADD KEY `payroll_runs_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- Indexes for table `savings_accounts`
--
ALTER TABLE `savings_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `savings_accounts_account_number_unique` (`account_number`),
  ADD KEY `savings_accounts_member_id_foreign` (`member_id`),
  ADD KEY `savings_accounts_branch_id_foreign` (`branch_id`),
  ADD KEY `savings_accounts_approved_by_foreign` (`approved_by`),
  ADD KEY `savings_accounts_status_index` (`status`),
  ADD KEY `savings_accounts_account_type_index` (`account_type`);

--
-- Indexes for table `savings_transactions`
--
ALTER TABLE `savings_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `savings_transactions_savings_account_id_foreign` (`savings_account_id`),
  ADD KEY `savings_transactions_processed_by_foreign` (`processed_by`);

--
-- Indexes for table `scheduled_job_logs`
--
ALTER TABLE `scheduled_job_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `share_accounts`
--
ALTER TABLE `share_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `share_accounts_account_number_unique` (`account_number`),
  ADD KEY `share_accounts_member_id_foreign` (`member_id`),
  ADD KEY `share_accounts_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `share_transactions`
--
ALTER TABLE `share_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `share_transactions_share_account_id_foreign` (`share_account_id`),
  ADD KEY `share_transactions_created_by_foreign` (`created_by`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_logs_related_type_related_id_index` (`related_type`,`related_id`),
  ADD KEY `sms_logs_created_by_foreign` (`created_by`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_ip_allowlists`
--
ALTER TABLE `user_ip_allowlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_ip_allowlists_user_id_ip_address_unique` (`user_id`,`ip_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dividends`
--
ALTER TABLE `dividends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dividend_allocations`
--
ALTER TABLE `dividend_allocations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `fixed_assets`
--
ALTER TABLE `fixed_assets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_entry_lines`
--
ALTER TABLE `journal_entry_lines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_approvals`
--
ALTER TABLE `loan_approvals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_collaterals`
--
ALTER TABLE `loan_collaterals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_products`
--
ALTER TABLE `loan_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_documents`
--
ALTER TABLE `member_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_guarantors`
--
ALTER TABLE `member_guarantors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_notes`
--
ALTER TABLE `member_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_number_sequences`
--
ALTER TABLE `member_number_sequences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `mobile_money_transactions`
--
ALTER TABLE `mobile_money_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_items`
--
ALTER TABLE `payroll_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_runs`
--
ALTER TABLE `payroll_runs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `savings_accounts`
--
ALTER TABLE `savings_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `savings_transactions`
--
ALTER TABLE `savings_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `scheduled_job_logs`
--
ALTER TABLE `scheduled_job_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `share_accounts`
--
ALTER TABLE `share_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `share_transactions`
--
ALTER TABLE `share_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_ip_allowlists`
--
ALTER TABLE `user_ip_allowlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD CONSTRAINT `chart_of_accounts_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `departments_head_of_department_id_foreign` FOREIGN KEY (`head_of_department_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `dividends`
--
ALTER TABLE `dividends`
  ADD CONSTRAINT `dividends_declared_by_foreign` FOREIGN KEY (`declared_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `dividend_allocations`
--
ALTER TABLE `dividend_allocations`
  ADD CONSTRAINT `dividend_allocations_dividend_id_foreign` FOREIGN KEY (`dividend_id`) REFERENCES `dividends` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dividend_allocations_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dividend_allocations_share_account_id_foreign` FOREIGN KEY (`share_account_id`) REFERENCES `share_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fixed_assets`
--
ALTER TABLE `fixed_assets`
  ADD CONSTRAINT `fixed_assets_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD CONSTRAINT `inventory_items_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD CONSTRAINT `inventory_transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `inventory_transactions_inventory_item_id_foreign` FOREIGN KEY (`inventory_item_id`) REFERENCES `inventory_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD CONSTRAINT `journal_entries_posted_by_foreign` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `journal_entries_reversal_of_foreign` FOREIGN KEY (`reversal_of`) REFERENCES `journal_entries` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `journal_entry_lines`
--
ALTER TABLE `journal_entry_lines`
  ADD CONSTRAINT `journal_entry_lines_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `journal_entry_lines_journal_entry_id_foreign` FOREIGN KEY (`journal_entry_id`) REFERENCES `journal_entries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `leave_requests_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `loans_loan_product_id_foreign` FOREIGN KEY (`loan_product_id`) REFERENCES `loan_products` (`id`),
  ADD CONSTRAINT `loans_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `loan_approvals`
--
ALTER TABLE `loan_approvals`
  ADD CONSTRAINT `loan_approvals_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `loan_approvals_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_collaterals`
--
ALTER TABLE `loan_collaterals`
  ADD CONSTRAINT `loan_collaterals_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD CONSTRAINT `loan_repayments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  ADD CONSTRAINT `loan_schedules_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD CONSTRAINT `login_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_blacklisted_by_foreign` FOREIGN KEY (`blacklisted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `members_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`);

--
-- Constraints for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  ADD CONSTRAINT `member_beneficiaries_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_documents`
--
ALTER TABLE `member_documents`
  ADD CONSTRAINT `member_documents_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `member_documents_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_guarantors`
--
ALTER TABLE `member_guarantors`
  ADD CONSTRAINT `member_guarantors_guarantor_member_id_foreign` FOREIGN KEY (`guarantor_member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `member_guarantors_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_notes`
--
ALTER TABLE `member_notes`
  ADD CONSTRAINT `member_notes_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mobile_money_transactions`
--
ALTER TABLE `mobile_money_transactions`
  ADD CONSTRAINT `mobile_money_transactions_initiated_by_foreign` FOREIGN KEY (`initiated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mobile_money_transactions_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mobile_money_transactions_savings_account_id_foreign` FOREIGN KEY (`savings_account_id`) REFERENCES `savings_accounts` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `payroll_items`
--
ALTER TABLE `payroll_items`
  ADD CONSTRAINT `payroll_items_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payroll_items_payroll_run_id_foreign` FOREIGN KEY (`payroll_run_id`) REFERENCES `payroll_runs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_runs`
--
ALTER TABLE `payroll_runs`
  ADD CONSTRAINT `payroll_runs_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payroll_runs_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `savings_accounts`
--
ALTER TABLE `savings_accounts`
  ADD CONSTRAINT `savings_accounts_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `savings_accounts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `savings_accounts_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `savings_transactions`
--
ALTER TABLE `savings_transactions`
  ADD CONSTRAINT `savings_transactions_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `savings_transactions_savings_account_id_foreign` FOREIGN KEY (`savings_account_id`) REFERENCES `savings_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `share_accounts`
--
ALTER TABLE `share_accounts`
  ADD CONSTRAINT `share_accounts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `share_accounts_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `share_transactions`
--
ALTER TABLE `share_transactions`
  ADD CONSTRAINT `share_transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `share_transactions_share_account_id_foreign` FOREIGN KEY (`share_account_id`) REFERENCES `share_accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD CONSTRAINT `sms_logs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_ip_allowlists`
--
ALTER TABLE `user_ip_allowlists`
  ADD CONSTRAINT `user_ip_allowlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
