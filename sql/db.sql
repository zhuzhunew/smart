--------------------- Setup -------------------
-- remove 'NO_ZERO_IN_DATE & NO_ZERO_DATE' from_sql mode to allow '0000-00-00 00:00:00' can be inserted into table.
-- add following lines to my.cnf file:
-- [mysqld]
-- sql_mode=ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION

--------------------- Create tables ----------------
-- manufacturer
CREATE TABLE `smart_z_manufacturer` (
  `manufacturer_id` bigint(20) UNSIGNED NOT NULL,
  `manufacturer_name` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `manufacturer_description` text COLLATE utf8mb4_unicode_520_ci,
  `manufacturer_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

ALTER TABLE `smart_z_manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`),
  ADD UNIQUE KEY `manufacturer_name` (`manufacturer_name`);

ALTER TABLE `smart_z_manufacturer`
  MODIFY `manufacturer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- product
CREATE TABLE `smart_z_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `product_description` text COLLATE utf8mb4_unicode_520_ci,
  `product_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `product_publish_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_manufacturer_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

ALTER TABLE `smart_z_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_name` (`product_name`),
  ADD KEY `product_publish_date` (`product_publish_date`),
  ADD KEY `product_post_date` (`product_post_date`),
  ADD KEY `product_manufacturer_id` (`product_manufacturer_id`);

ALTER TABLE `smart_z_product`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- category
CREATE TABLE `smart_z_category` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent_category_id`  bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

ALTER TABLE `smart_z_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`),
  ADD KEY `parent_category_id` (`parent_category_id`);

ALTER TABLE `smart_z_category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- product_category
CREATE TABLE `smart_z_product_category` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

ALTER TABLE `smart_z_product_category`
  ADD CONSTRAINT `PK_product_category` PRIMARY KEY (`product_id`, `category_id`),
  ADD KEY `product_category_product_id` (`product_id`),
  ADD KEY `product_category_category_id` (`category_id`);

-- platform
CREATE TABLE `smart_z_platform` (
  `platform_id` bigint(20) UNSIGNED NOT NULL,
  `platform_name` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `platform_description` text COLLATE utf8mb4_unicode_520_ci,
  `platform_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

ALTER TABLE `smart_z_platform`
  ADD PRIMARY KEY (`platform_id`),
  ADD UNIQUE KEY `platform_name` (`platform_name`);

ALTER TABLE `smart_z_platform`
  MODIFY `platform_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- product_platform
CREATE TABLE `smart_z_product_platform` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

ALTER TABLE `smart_z_product_platform`
  ADD CONSTRAINT `PK_product_platform` PRIMARY KEY (`product_id`, `platform_id`),
  ADD KEY `product_category_product_id` (`product_id`),
  ADD KEY `product_category_platform_id` (`platform_id`);

-- vote
CREATE TABLE `smart_z_vote` (
  `vote_product_id` bigint(20) UNSIGNED NOT NULL,
  `vote_ip` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

ALTER TABLE `smart_z_vote`
  ADD CONSTRAINT `PK_vote` PRIMARY KEY (`vote_product_id`, `vote_ip`),
  ADD KEY `vote_product_id` (`vote_product_id`),
  ADD KEY `vote_ip` (`vote_ip`);

--------------------- Drop tables --------------------
DROP TABLE smart_z_manufacturer;
DROP TABLE smart_z_product;
DROP TABLE smart_z_category;
DROP TABLE smart_z_product_category;
DROP TABLE smart_z_platform;
DROP TABLE smart_z_product_platform;
DROP TABLE smart_z_vote;