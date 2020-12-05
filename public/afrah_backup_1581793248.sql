

CREATE TABLE `bill_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO bill_items VALUES('1','1','2','25','1','25','2020-01-02 20:07:36','2020-01-02 20:07:36');
INSERT INTO bill_items VALUES('2','2','2','25','2','50','2020-01-02 20:08:45','2020-01-02 20:08:45');
INSERT INTO bill_items VALUES('3','3','2','25','1','25','2020-01-02 20:32:56','2020-01-02 20:32:56');
INSERT INTO bill_items VALUES('4','4','1','20','1','20','2020-01-18 03:28:40','2020-01-18 03:28:40');
INSERT INTO bill_items VALUES('5','5','2','25','1','25','2020-01-29 19:45:52','2020-01-29 19:45:52');
INSERT INTO bill_items VALUES('6','6','2','25','1','25','2020-01-29 19:45:52','2020-01-29 19:45:52');
INSERT INTO bill_items VALUES('7','7','2','25','1','25','2020-02-08 10:37:41','2020-02-08 10:37:41');
INSERT INTO bill_items VALUES('8','8','1','20','1','20','2020-02-08 10:38:11','2020-02-08 10:38:11');
INSERT INTO bill_items VALUES('9','9','2','25','1','25','2020-02-08 10:38:41','2020-02-08 10:38:41');



CREATE TABLE `bills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agentName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agentPhone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deliveryDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `turnover` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `remainder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO bills VALUES('1','احمد محمد','','2020-01-02','25','25','0','1','2020-01-02 20:07:36','2020-01-02 20:07:36');
INSERT INTO bills VALUES('2','محمود عامر حسن','','2020-01-02','50','50','0','1','2020-01-02 20:08:45','2020-01-02 20:08:45');
INSERT INTO bills VALUES('3','علي محمود عمار','','2020-01-02','25','25','0','1','2020-01-02 20:32:56','2020-01-02 20:32:56');
INSERT INTO bills VALUES('4','محمود علاء الدين','','2020-01-19','20','5','15','1','2020-01-18 03:28:39','2020-01-18 03:28:39');
INSERT INTO bills VALUES('5','سامي سامي','','2020-01-29','25','0','25','1','2020-01-29 19:45:52','2020-01-29 19:45:52');
INSERT INTO bills VALUES('6','سامي سامي','','2020-01-29','25','0','25','0','2020-01-29 19:45:52','2020-01-29 19:45:52');
INSERT INTO bills VALUES('7','ممدوح رئفت غندور','','2020-02-08','25','25','0','1','2020-02-08 10:37:41','2020-02-08 10:37:41');
INSERT INTO bills VALUES('8','عبير السيد ابراهيم','','2020-02-09','20','20','0','1','2020-02-08 10:38:11','2020-02-08 10:38:11');
INSERT INTO bills VALUES('9','سناء عبدالمولي ابرهيم','','2020-02-08','25','20','5','0','2020-02-08 10:38:41','2020-02-08 10:38:41');



CREATE TABLE `copying` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO copying VALUES('1','4','1','["archives\\2020\\01-2020\\18-01-2020\\4\\\u0635\u0648\u0631\u0629 4x6\\5_23.jpg"]','2020-01-18 04:48:24','2020-01-18 04:48:24');
INSERT INTO copying VALUES('2','5','2','["archives\\2020\\01-2020\\29-01-2020\\5\\\u0641\u0648\u0631\u064a 4x6\\960x0.jpg"]','2020-02-08 11:21:22','2020-02-08 11:21:22');
INSERT INTO copying VALUES('3','6','2','["archives\\2020\\01-2020\\29-01-2020\\6\\\u0641\u0648\u0631\u064a 4x6\\maxresdefault.jpg"]','2020-02-08 11:21:40','2020-02-08 11:21:40');
INSERT INTO copying VALUES('4','7','2','["archives\\2020\\02-2020\\08-02-2020\\7\\\u0641\u0648\u0631\u064a 4x6\\westworld-season-2-facebook-cover.jpg"]','2020-02-08 11:21:57','2020-02-08 11:21:57');
INSERT INTO copying VALUES('5','8','1','["archives\\2020\\02-2020\\08-02-2020\\8\\\u0635\u0648\u0631\u0629 4x6\\06 (1).jpg"]','2020-02-08 11:22:19','2020-02-08 11:22:19');
INSERT INTO copying VALUES('6','9','2','["archives\\2020\\02-2020\\08-02-2020\\9\\\u0641\u0648\u0631\u064a 4x6\\best-plano-web-designer-1.jpg"]','2020-02-08 11:22:30','2020-02-08 11:22:30');



CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `delivery` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO items VALUES('1','صورة 4x6','20','1','2020-01-02 20:07:02','2020-01-02 20:07:02','1');
INSERT INTO items VALUES('2','فوري 4x6','25','0','2020-01-02 20:07:16','2020-01-02 20:07:16','1');



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO migrations VALUES('1','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('2','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('3','2019_10_24_034030_create_items_table','1');
INSERT INTO migrations VALUES('4','2019_11_02_134108_create_bill_items_table','2');
INSERT INTO migrations VALUES('5','2019_11_02_134805_create_bills_table','2');
INSERT INTO migrations VALUES('6','2019_11_15_140047_create_copying_table','3');
INSERT INTO migrations VALUES('7','2019_12_08_224717_create_remainders_table','4');
INSERT INTO migrations VALUES('8','2019_12_13_113446_create_settings_table','5');
INSERT INTO migrations VALUES('9','2019_12_16_192506_add_role_to_users','6');
INSERT INTO migrations VALUES('10','2019_12_21_005949_add_columns_to_items','7');



CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




CREATE TABLE `remainders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO remainders VALUES('1','4','15','2020-01-18 04:29:35','2020-01-18 04:29:35');
INSERT INTO remainders VALUES('2','5','25','2020-02-08 10:39:11','2020-02-08 10:39:11');



CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO settings VALUES('1','site_name','استوديو افراح',,);
INSERT INTO settings VALUES('2','archive_path','E:\',,);
INSERT INTO settings VALUES('3','phones','0123456780 - 0100123456789',,);
INSERT INTO settings VALUES('4','archive_folder','archives',,);



CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users VALUES('1','admin','admin@admin.co','$2y$10$CLmvaatQ/Y7.jye60LcNFuqCOCyYxqqf2lxwFXay5tfq8Z8MXsxT2','KHl64FXudiKG5pPhYSj1YWsCISuULoC9fZvfIxzBU2R6mpDer6DfR0Yvb8fr','2019-12-17 16:50:02','2020-01-02 16:28:36','1');
INSERT INTO users VALUES('2','mahmoud','sale@one.co','$2y$10$lLmc32zoWVnxEU9uTt0oce1ijfvuU0Wf34dZA4191AbPBtiQoUAqC',,'2019-12-30 22:54:55','2019-12-30 22:54:55','2');

