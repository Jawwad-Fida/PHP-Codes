CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` text COLLATE utf8_unicode_ci,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_profile` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_category` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `receipt_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `refunds` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_ref_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


