-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 06 2017 г., 15:30
-- Версия сервера: 5.7.20-0ubuntu0.16.04.1
-- Версия PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shopmvc9`
--

-- --------------------------------------------------------

--
-- Структура таблицы `backgrounds`
--

CREATE TABLE `backgrounds` (
  `id` int(10) UNSIGNED NOT NULL,
  `aboutUs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `downloads` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacts` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `aboutUs`, `downloads`, `contacts`, `created_at`, `updated_at`) VALUES
(1, 'Fugiat voluptatem accusamus sint. Sapiente vero pariatur omnis eius ratione odio ut. Numquam necessitatibus at consequatur doloremque aut optio est sapiente.', 'Laboriosam aut voluptates atque dolores rerum est ut. Reiciendis placeat ut eaque similique vel et. Facilis dignissimos quas voluptatem quidem.', 'Et sit mollitia ut ea. Rerum reprehenderit optio enim unde ut rerum. Molestias maxime doloribus libero ea aut minus in.', '2017-10-15 12:03:20', '2017-10-15 12:03:20');

-- --------------------------------------------------------

--
-- Структура таблицы `carousels`
--

CREATE TABLE `carousels` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `carousels`
--

INSERT INTO `carousels` (`id`, `image`, `url`, `created_at`, `updated_at`) VALUES
(1, 'carrier.gif', '/carousel1', NULL, NULL),
(2, 'ch.gif', '/carousel2', NULL, NULL),
(3, 'daikin.gif', '/carousel3', NULL, NULL),
(4, 'fujitsu.gif', '/carousel4', NULL, NULL),
(5, 'gree.gif', '/carousel5', NULL, NULL),
(6, 'mitsubishi.gif', '/carousel6', NULL, NULL),
(7, 'panasonic.gif', '/carousel7', NULL, NULL),
(8, 'site1.gif', '/carousel8', NULL, NULL),
(9, 'site2.gif', '/carousel9', NULL, NULL),
(10, 'telo.gif', '/carousel10', NULL, NULL),
(11, 'toshiba.gif', '/carousel11', NULL, NULL),
(12, 'general_climat.gif', '/carousel12', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 0, 'category1', NULL, NULL),
(2, 0, 'category2', NULL, NULL),
(3, 1, 'category3', NULL, NULL),
(4, 1, 'category4', NULL, NULL),
(5, 1, 'category5', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category_product`
--

CREATE TABLE `category_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_product`
--

INSERT INTO `category_product` (`product_id`, `category_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `changed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `avatar`, `name`, `email`, `parent_id`, `product_id`, `comment`, `published`, `changed`, `created_at`, `updated_at`) VALUES
(1, NULL, ' Bіктор', 'oksana.lisenko@dmitrenko.com.ua', 47, 48, 'Incidunt ex quam omnis debitis reprehenderit non. Et et culpa doloremque qui incidunt qui doloribus et. Et ut minus impedit voluptatum dolore.', '1', '0', '2017-10-15 12:03:20', '2017-10-15 12:03:20'),
(2, NULL, 'Тарас', 'fgnatyk@gmail.com', 25, 34, 'Vitae non deleniti vel magni omnis. Perferendis ad praesentium omnis iusto est commodi. Sit aut dolor consequatur voluptatibus corrupti.', '1', '0', '2017-10-15 12:03:20', '2017-10-15 12:03:20'),
(3, NULL, 'Валерій', 'marina06@sevcuk.net.ua', 26, 32, 'Esse quam facilis quibusdam earum. In minus maxime quia blanditiis qui. Officiis quo saepe qui id.', '1', '0', '2017-10-15 12:03:20', '2017-10-15 12:03:20'),
(4, NULL, 'Назар', 'jmrosnicenko@mail.ru', 6, 32, 'Magni modi architecto repudiandae voluptatum. Sed ut iusto possimus quia at sed dolorem. Quibusdam et odio quaerat totam et dicta incidunt.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(5, NULL, 'Олександр', 'xmikityk@ponomarenko.com', 12, 47, 'Nulla accusamus nobis architecto. Voluptas temporibus laborum distinctio voluptatem non necessitatibus. Libero eius architecto voluptatibus.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(6, NULL, 'Любов', 'yri46@rambler.ru', 40, 32, 'Atque animi eligendi quia est necessitatibus. Ut dolor pariatur non eaque quam ad.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(7, NULL, 'Ніна', 'kravcenko.vgen@kravcuk.org.ua', 36, 1, 'Animi in officiis iste adipisci sunt assumenda ut. Autem quod iusto adipisci in ex.', '1', '0', '2017-10-15 12:03:21', '2017-10-16 03:30:45'),
(8, NULL, 'Олег', 'sergnko.vtali@sevcuk.com.ua', 41, 49, 'Voluptatem aut libero vel. Iure assumenda fugit aut. Laudantium qui consequuntur libero harum.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(9, NULL, 'Вікторія', 'sereda.maksim@lisenko.ua', 24, 27, 'Omnis possimus aut amet autem. Voluptatem rerum magnam cumque. Voluptatem autem et itaque quos non. Ad ipsum beatae eius laboriosam ullam repudiandae. Sunt optio id numquam ratione.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(10, NULL, 'Діана', 'artem.kravcuk@ukr.net', 33, 3, 'Id sint est sed dolorum vitae nam. Quibusdam quia modi nam unde. Facere est non aliquid et quia. Est aut fugiat quae ab architecto.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(11, NULL, 'Олександр', 'aantonenko@bodnarenko.ua', 38, 6, 'Dicta aut quo commodi. Deleniti voluptas enim maxime. Id odio vero ut vel. Et totam et eum odit labore.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(12, NULL, 'Юрій', 'iponomarenko@antonenko.org', 10, 35, 'Perferendis itaque omnis reiciendis magni modi odio. Quo aut aliquid voluptatum. Vel dolor in ea quibusdam. Nisi ipsa est fugit itaque voluptates vero.', '1', '0', '2017-10-15 12:03:21', '2017-11-02 08:04:06'),
(13, NULL, 'Алла', 'oleksandra.tarasuk@ukr.net', 33, 19, 'Error esse quia ut nulla voluptatum quas. Nam iure voluptatem consequatur enim harum facere non. Nisi ratione et maxime et.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(14, NULL, 'Григорій', 'brovarenko.polna@gmail.com', 26, 13, 'Ad ipsum unde necessitatibus consequatur exercitationem. Rerum voluptas consequatur eligendi earum nulla repellat cupiditate. Natus distinctio omnis neque ut saepe aperiam ea. Cum rerum id sint qui.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(15, NULL, 'Артем', 'polna05@mail.ru', 48, 43, 'Voluptatibus sed minima enim ex. Et et odit et qui explicabo. Aut et magnam quisquam deleniti at.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(16, NULL, 'Ольга', 'fpanasyk@mail.ru', 47, 17, 'Sed sequi quo et sunt eius odio. Non nam adipisci adipisci repellat sunt voluptate possimus accusantium. Atque et consequuntur quo rerum id quis. Velit quia voluptas provident porro ut voluptas.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(17, NULL, 'Олена', 'larisa.vasilv@rambler.ru', 40, 36, 'Officiis aspernatur sunt voluptas quis totam eveniet. Quaerat eveniet enim ab ut esse. Assumenda dignissimos eligendi eveniet impedit.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(18, NULL, 'Олександра', 'lydmila28@sereda.org.ua', 26, 8, 'Vel itaque nihil dicta. Quaerat ratione vel sed voluptates voluptatem quia mollitia ratione. Modi est sint iste sed quasi aut rerum. Rerum est nostrum velit maiores.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(19, NULL, 'Павло', 'ytarasuk@kramarenko.net', 1, 5, 'Debitis atque facilis voluptas ea est. Debitis asperiores consequatur quam voluptas rerum doloremque consequatur. Accusantium quibusdam qui eligendi ut id nisi similique.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(20, NULL, 'Артем', 'iosip26@pavlyk.net', 37, 23, 'Rerum voluptatem ea quaerat consectetur vel. Corrupti aliquid optio dignissimos beatae qui. Quam explicabo pariatur nisi similique fuga. Ipsa et quia voluptas quidem similique qui omnis.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(21, NULL, 'Софія', 'artur93@vancenko.org.ua', 34, 45, 'Nobis ut libero exercitationem. Nostrum porro nihil repudiandae quae et laudantium aliquam. Qui odit et voluptas omnis tempore impedit rerum. Provident laboriosam laborum natus.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(22, NULL, 'Галина', 'valeri.ponomarcuk@rambler.ru', 13, 19, 'Ipsum et et officiis pariatur. Iste quibusdam dicta nulla voluptatem. Et quia et quidem dolorem eos esse.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(23, NULL, 'Олена', 'lbrovarcuk@pavlyk.com.ua', 27, 42, 'Explicabo accusantium facilis saepe. Tenetur rerum molestias ipsam est quidem pariatur non. Dolores sit mollitia ipsam voluptatibus labore alias beatae.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(24, NULL, 'Анастасія', 'antonenko.sergi@mail.ru', 11, 22, 'Voluptas nam quia et ut. Et magnam aut laboriosam minima accusamus iste cum eaque. Fuga iusto natus autem ut aut et non.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(25, NULL, 'Сергій', 'taras.gnatyk@ukr.net', 1, 1, 'Omnis omnis iure natus debitis commodi. Quis explicabo odio temporibus illo ut sit. Id voluptatem fuga impedit explicabo et. Qui ad nulla qui et eos atque libero asperiores.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(26, NULL, 'Кіра', 'nna.antonenko@petrenko.org', 27, 19, 'Ut explicabo facere et sed vel ut quos. Ea atque quas quia culpa velit id.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(27, NULL, 'Єлизавета', 'larisa88@gmail.com', 39, 19, 'Voluptatibus nihil amet aut possimus. Magnam cupiditate consequatur error quam non.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(28, NULL, 'Микола', 'galina.panasyk@mikityk.net.ua', 36, 10, 'Minima ut voluptatem aut rem. Eos vero nulla quos. Quasi sint omnis odio quia eum qui. Eaque quo excepturi saepe ipsa.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(29, NULL, 'Костянтин', 'kmelnicenko@kramarenko.net.ua', 15, 29, 'Eius et eveniet quis dignissimos perferendis adipisci. Et quasi vel id magnam magni. Voluptatibus impedit consectetur et magni ut commodi distinctio vero. Sit et sunt qui.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(30, NULL, 'Поліна', 'wsevcenko@sinkarenko.net', 11, 1, 'Aut officia tempora enim ratione temporibus dolor. Itaque voluptatem quia eligendi harum. Quam ratione et odit iure. Atque nesciunt modi nisi iure ipsum nisi aperiam accusantium.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(31, NULL, 'Анна', 'yly.vancenko@i.ua', 27, 48, 'Impedit nam saepe aut deserunt assumenda. Aut laboriosam soluta est quo illo rerum.', '1', '0', '2017-10-15 12:03:21', '2017-10-15 12:03:21'),
(32, NULL, 'B\'ячеслав', 'oleksandra95@rambler.ru', 22, 16, 'Tempore consequatur aut rerum labore voluptas accusantium quod ipsum. Doloremque culpa maxime mollitia qui.\nDolorem vel omnis et qui. Ipsum qui enim debitis fugit. Maxime odio assumenda quam.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(33, NULL, 'Павло', 'melnicenko.yly@mikityk.org', 44, 17, 'Sed fugit perferendis fugit ea consequatur tenetur in. Minus voluptatem nulla veritatis. Facilis totam consequatur commodi eos voluptate.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(34, NULL, 'Катерина', 'zzakarcuk@rambler.ru', 43, 23, 'Placeat neque quo consequatur doloremque non aut adipisci. Et odio quasi omnis nostrum sit corrupti officia.\nRerum praesentium laudantium ab eum. Animi quos alias nesciunt eveniet molestiae.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(35, NULL, 'Олександр', 'kramarcuk.valery@kravcenko.com', 22, 40, 'Rerum tempora dicta ad sequi facere. Tenetur eligendi in provident vero aut. Et nam neque voluptas atque et assumenda.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(36, NULL, 'Леонід', 'vasilenko.olena@i.ua', 7, 27, 'Quaerat praesentium accusamus quia laudantium vero. Libero accusantium numquam exercitationem ullam rerum. Voluptas nisi delectus ut sint est.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(37, NULL, 'Марина', 'panasyk.dary@mrosnicenko.net', 13, 43, 'Sit et qui libero rerum. Animi et non maiores in. Nemo velit et nobis repellendus.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(38, NULL, 'Катерина', 'vladislav15@gmail.com', 42, 10, 'Saepe nesciunt explicabo non ducimus ducimus dolores. Nemo tenetur neque est sint aut. Ad nemo et placeat. Quisquam ex vel aut.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(40, NULL, 'Марія', 'polna.petrenko@sereda.net.ua', 47, 12, 'Amet odit omnis et et. Veniam et sint et quia aperiam aut. Et earum illum nihil error facilis aut aspernatur ipsam. Laudantium qui voluptas quidem expedita dolor nostrum laudantium sed.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(41, NULL, 'Назар', 'sergnko.gennadi@mail.ru', 43, 9, 'Debitis et exercitationem at eius. Aut qui et dicta. Consequatur ut molestias est reiciendis sit esse.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(42, NULL, 'Любов', 'nromancenko@i.ua', 3, 32, 'Porro totam ab aut a quia. Nisi aut dolores aliquid sed. Consequuntur vero ducimus autem occaecati porro minus delectus.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(43, NULL, 'Поліна', 'lisenko.roman@mail.ru', 22, 24, 'Omnis provident corporis quo. Odio esse nulla praesentium maiores architecto. Illum sit veritatis qui et tempora beatae. Occaecati nesciunt quasi quia maiores praesentium velit dolorum.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(44, NULL, 'Володимир', 'sereda.kra@ukr.net', 35, 14, 'Non quia optio commodi aut deleniti a. Velit sint dolores aliquam sint adipisci odio sapiente aut. Occaecati nemo enim unde dignissimos ducimus a.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(45, NULL, ' Bіктор', 'nady.ponomarenko@mail.ru', 2, 33, 'Temporibus voluptas illo nemo nesciunt mollitia qui eius. Dolorum cupiditate qui sit et consequatur.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(46, NULL, 'Олексій', 'larisa.vasilcuk@sevcuk.com', 28, 14, 'Dolorum ipsam quis sed dolorem quis. Voluptatibus est sed magnam quia fugit adipisci. Nihil suscipit minus inventore sit. Rerum earum sit dolorem vel.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(47, NULL, 'Раїса', 'lisenko.georgi@i.ua', 45, 23, 'A et fugiat fugiat ut et quia amet. Consequatur aspernatur at commodi possimus et aut sint qui. Repellat et autem numquam rem id.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(48, NULL, 'Галина', 'bodnarenko.ruslan@rambler.ru', 8, 14, 'Est et est quos est pariatur. Quisquam autem aut omnis architecto est sed nemo ipsam. Ipsa quos autem voluptatibus.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22'),
(49, NULL, ' Bсеволод', 'brovarenko.lizaveta@ukr.net', 24, 3, 'Id illo omnis distinctio impedit et sunt molestias. Voluptatibus qui laudantium inventore a similique quisquam eius. Sed quis eius cum. Asperiores expedita voluptatem possimus nam magnam et.', '1', '0', '2017-10-15 12:03:22', '2017-10-15 12:03:22');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `product_id`, `path`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'photo1.jpg', 1, NULL, NULL),
(2, 1, 'photo2.jpg', 2, NULL, NULL),
(3, 1, 'photo3.jpg', 3, NULL, NULL),
(4, 1, 'photo4.jpg', 4, NULL, NULL),
(5, 1, 'photo5.jpg', 5, NULL, NULL),
(6, 1, 'photo6.jpg', 6, NULL, NULL),
(7, 1, 'photo7.jpg', 7, NULL, NULL),
(8, 1, 'photo8.jpg', 8, NULL, NULL),
(9, 1, 'photo9.jpg', 9, NULL, NULL),
(10, 1, 'photo10.jpg', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(10) UNSIGNED NOT NULL,
  `eng_translit_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `eng_translit_title`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 'siemens', 'siemens', '/siemens', NULL, NULL),
(2, 'audi', 'audi', '/audi', NULL, NULL),
(3, 'agf', 'agf', '/agf', NULL, NULL),
(4, 'qwerty123', 'qwerty123', '/qwerty123', '2017-11-05 06:25:48', '2017-11-05 06:25:48'),
(5, '11111111111111111', '11111111111111111', '/11111111111111111', '2017-11-05 06:26:37', '2017-11-05 06:50:21');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_04_14_145343_create_sliders_table', 1),
(4, '2017_04_14_145737_create_carousels_table', 1),
(5, '2017_04_14_145910_create_categories_table', 1),
(6, '2017_04_23_162206_create_manufacturers_table', 1),
(7, '2017_04_23_162448_create_products_table', 1),
(8, '2017_04_23_162551_create_images_table', 1),
(9, '2017_05_18_145013_create_backgrounds_table', 1),
(10, '2017_06_18_153443_create_jobs_table', 1),
(11, '2017_06_20_135743_create_orders_table', 1),
(12, '2017_07_10_141805_create_comments_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivered` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `author`, `title`, `description`, `body`, `price`, `manufacturer_id`, `created_at`, `updated_at`) VALUES
(1, 'Поліна Васильович Захарчук', 'Magnam aut impedit repellendus quia dolores natus.', 'Dolorum molestiae earum dicta qui. Quidem officiis animi dolorem possimus. Veritatis ipsum totam nobis sed dignissimos voluptates.', 'Rem vel qui ipsa quis quos sit. Ducimus sint et aut quibusdam voluptas rerum. Quidem occaecati et rem hic sit nesciunt.', 73817, 1, '2017-10-15 12:03:09', '2017-10-15 12:03:09'),
(2, 'Марія Олександрович Панасюк', 'Quae omnis qui error ipsa eligendi.', 'Voluptatum magnam dolorem in illum corporis amet sit similique. Sint asperiores fugit omnis culpa qui. Rem voluptatem natus sit non sapiente voluptatem rerum. Qui ut odio quasi autem.', 'Consequatur numquam error ullam est voluptatum laudantium distinctio. Rerum quasi velit et iusto corrupti sed et dignissimos.', 66138, 2, '2017-10-15 12:03:12', '2017-10-15 12:03:12'),
(3, 'Іванченко Валентин Сергійович', 'Voluptatem repellendus ea nostrum.', 'Assumenda inventore reiciendis quia. Sed consequatur earum omnis sint et. Sunt illo nulla aut quia.', 'Ut harum vel neque optio dolores et. Rerum officiis inventore assumenda voluptatibus quas voluptatem. Adipisci in magni voluptatibus eaque distinctio officiis dolores.', 86536, 1, '2017-10-15 12:03:13', '2017-10-15 12:03:13'),
(4, 'Алла Романович Броварчук', 'Ea maiores ex provident consequatur.', 'Voluptate voluptas veniam quasi. Et quas id numquam voluptatem totam natus qui eligendi. Nihil consequatur facilis eligendi similique. Omnis veritatis esse enim.', 'Et est quis ut mollitia voluptas. Itaque quis tempore unde est ad nulla amet nobis. Et quia dolores molestiae praesentium sed optio. Saepe explicabo est sunt eos totam reprehenderit odio consequatur.', 46492, 3, '2017-10-15 12:03:13', '2017-10-15 12:03:13'),
(5, 'Роман Володимирович Шевчук', 'Perspiciatis non quia animi officia.', 'Rem quia nisi quasi eveniet error neque. Consequuntur omnis quibusdam eius beatae. Et explicabo totam laudantium aut accusantium neque vel.', 'Similique doloremque ea tempora officia. Iure et at beatae modi porro necessitatibus occaecati maxime. Optio autem adipisci pariatur ipsam maxime quae et. Maxime qui minima nobis magnam.', 69751, 1, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(6, ' Bіктор Іванович Боднаренко', 'Est dolor non est.', 'Repellat rerum sint ullam dolore autem esse. Esse est qui ullam cupiditate sed rerum voluptas. Consequatur ipsa et inventore aut quae temporibus vero. Aut pariatur veniam mollitia voluptatibus sint aut delectus.', 'Eveniet dolores aliquid debitis blanditiis. Et sint aperiam placeat. Recusandae id maxime quam. Et culpa in labore eius omnis nam iste aperiam.', 67974, 1, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(7, 'Дмитренко Поліна Олексійович', 'Iste doloribus optio odio numquam impedit sit sequi.', 'Cumque tempore fugiat voluptate sunt molestias sit temporibus. Debitis minima quidem minus placeat delectus. Quae et est sed sint. Eveniet velit ipsam inventore.', 'Quia ullam id et enim dolorem sed. Aut quam vero optio et porro. Quasi unde rerum soluta neque.', 49313, 1, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(8, 'Броваренко Сергій Андрійович', 'Quo veritatis praesentium ex aut hic et est.', 'Unde molestiae corrupti dolores quasi voluptas placeat voluptas. Earum et est dolor quasi. Quia temporibus voluptas qui delectus. Maiores consequatur nostrum dolorem temporibus accusantium iste et.', 'Nulla sed eligendi doloremque consequuntur nobis quae. Unde enim esse deleniti mollitia qui dolor. Odio amet cumque aspernatur ad quia ut.', 69672, 1, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(9, 'Валентина Романович Сергієнко', 'Laudantium inventore explicabo doloribus sapiente nisi.', 'Libero dolore aliquam ut necessitatibus adipisci. Inventore aliquid aperiam illo repellendus nisi est. Omnis molestiae in beatae. Eaque qui perspiciatis libero nostrum necessitatibus.', 'Qui dicta quisquam placeat optio. Id sit qui quis voluptate. Quibusdam velit culpa enim architecto voluptatum dolores quia. Omnis excepturi neque necessitatibus ut.', 44047, 1, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(10, 'Антоненко Олександр Володимирович', 'Soluta error rerum rem voluptas.', 'Dolores quod omnis odit doloremque harum modi. Earum facere illum vel.', 'Sit eaque ad soluta ut rem. Ipsum velit libero eos possimus excepturi porro. Qui libero ullam mollitia aliquam qui ipsam voluptas.', 55590, 3, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(11, 'Лисенко Микола Олексійович', 'Laudantium expedita sed similique doloremque.', 'Nobis dolorum accusamus provident ab. Voluptatem esse cumque qui omnis quidem nisi vero eos. Et illo provident deserunt.', 'Ipsa explicabo voluptas numquam et magnam ullam doloribus. Quo est sint velit. Eos dolorem et illum nemo dicta accusamus commodi. Et ad et tempora et nemo consequuntur.', 52919, 2, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(12, 'Антоненко Роман Федорович', 'Dignissimos perspiciatis consectetur ipsum ducimus repellendus et.', 'Inventore fugit quia quia sunt est omnis voluptatem. Dolorem ut voluptas ea aliquid ipsa magni repellendus. Tenetur earum distinctio non omnis dolorum quos. Tempore sunt perspiciatis beatae aut.', 'Temporibus dicta enim incidunt doloribus saepe ipsum. Et maiores expedita minus cum et reiciendis. Voluptatem a sit reiciendis incidunt et quia. Enim maiores suscipit explicabo aliquid fuga vero.', 66307, 1, '2017-10-15 12:03:14', '2017-10-15 12:03:14'),
(13, 'Валерій Олексійович Кравчук', 'Reprehenderit voluptatum beatae nisi tempora quos.', 'Doloribus nostrum repellendus blanditiis amet et hic. Accusantium dignissimos quod dolorem et error aliquid voluptate. Aut rerum commodi fugit aspernatur hic quos corporis sit. Eaque expedita aut voluptate recusandae quo voluptas voluptatem qui.', 'Et vel et reprehenderit voluptatum dolor perferendis veritatis. Necessitatibus iure placeat ut ut et et vitae. Consequatur inventore tenetur id voluptatem. Accusantium labore pariatur ad maxime vel.', 79210, 2, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(14, 'Володимир Андрійович Крамарчук', 'Non tempore harum est nisi quia beatae.', 'Consequuntur eius quibusdam et beatae. Quisquam nulla enim eius saepe cupiditate et qui. Qui inventore nulla non ullam nisi.', 'Praesentium qui voluptatum ipsa sed. Ad asperiores autem dicta qui dignissimos eius. Nobis nulla illo molestiae sint eveniet aut temporibus.', 30950, 3, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(15, 'Світлана Євгенович Пономарчук', 'Corporis ut delectus ut ullam.', 'Repellat tempore sit molestiae officia debitis. Cumque recusandae voluptatum fugit totam blanditiis explicabo magni. Odio magnam provident dolore qui beatae est alias quaerat.', 'Magnam architecto sed molestiae doloribus nihil. Molestiae accusantium delectus adipisci illo. Nostrum sunt reiciendis sint sint explicabo in rem.', 13753, 2, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(16, 'Лев Олександрович Крамаренко', 'Magni omnis cupiditate sint error non molestiae mollitia.', 'Quaerat et sint et id ut aperiam. Omnis esse quo voluptate fuga. Veniam eos minus aperiam dolorem.', 'Iure reiciendis esse sit quia quod. Voluptatum consequatur possimus eos iure.', 36584, 1, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(17, 'Іванченко Ірина Петрович', 'Dolorum quis voluptas doloremque cupiditate quia nihil.', 'Voluptatum vero in consequatur aut sit dolorum quis. Occaecati modi et explicabo voluptatem et beatae dignissimos. Et culpa quo nulla quam consequuntur. Quisquam eos sit tenetur et aut. Quasi veritatis est pariatur magni est voluptatibus.', 'Ea et sapiente ut beatae est saepe ut alias. Magni est aut fugiat modi eligendi. At sapiente id repellendus rerum ut aspernatur et.', 80569, 2, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(18, 'Боднаренко Ярослава Михайлович', 'Necessitatibus est a quaerat deserunt.', 'Qui aut earum cumque asperiores voluptatem. Ullam sequi ut rerum rerum. Sit porro molestiae soluta rem.', 'Nam ut voluptatem est animi laudantium non. Temporibus architecto quibusdam ut aut magni nemo sit.', 62919, 3, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(19, 'Панасюк Олена Миколайович', 'Aut quos voluptatibus tempore dignissimos est optio et.', 'Assumenda qui amet magni aut sint. Nesciunt nemo et nobis non est minima a. Necessitatibus sequi laudantium laudantium libero fugit deserunt.', 'Vero nesciunt aut est labore. Atque voluptas vitae laborum esse et qui. Voluptas officiis officia cum alias.', 68201, 3, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(20, 'Пономарчук Любов Янович', 'Velit harum repellendus sed ea dolor.', 'Voluptates praesentium quidem odit qui et. Deserunt corrupti sit quidem. Sunt illo sapiente ut voluptas magni rem. Possimus aperiam iusto eius nobis occaecati nulla laudantium.', 'Sequi voluptates ducimus molestiae. Aliquid accusamus et incidunt tenetur cum sapiente quis. Et nulla doloribus consequatur optio consequatur maxime.', 19757, 1, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(21, 'Артур Олександрович Василенко', 'Vero repellat deserunt et perspiciatis quo.', 'Iusto hic aut consequatur. Optio veniam quod in temporibus recusandae neque. Ipsam necessitatibus cumque et sint. Quisquam in doloribus id natus. Molestiae ea autem commodi et quis esse.', 'Beatae consequatur voluptate ab quod animi quibusdam molestiae doloribus. Laborum ab sunt quasi cum reiciendis quos. Tenetur laudantium sint itaque. Quae tempore neque ipsa consequatur quaerat ut.', 2593, 2, '2017-10-15 12:03:15', '2017-10-15 12:03:15'),
(22, 'Захарчук Вікторія Андрійович', 'Sapiente consequatur saepe omnis exercitationem sunt expedita quia.', 'Dolorum voluptatem aut non voluptate provident sed. Qui sint architecto vero ipsam. Quo qui minima sed est porro. Excepturi beatae dolores dicta rem facilis qui.', 'Sint similique magnam cum excepturi. Porro et consequuntur a magni. Exercitationem saepe eveniet voluptatibus voluptatem. Doloribus eius exercitationem voluptates soluta ut.', 35343, 2, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(23, 'Романченко Валерій Янович', 'Iure consequatur esse rerum mollitia voluptas magni possimus.', 'Autem culpa vel sint molestiae ad et magnam. Quam architecto sunt qui nobis autem nesciunt. Repudiandae voluptatum aspernatur neque fuga consequuntur quaerat rerum. Unde eum reiciendis doloremque. Aspernatur id dolorum non provident modi qui dolores adipisci.', 'Dolores rem aut libero praesentium sed. Facilis dolore dolores earum et. Adipisci esse non sed ipsum vel eum.', 2428, 3, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(24, 'Ніна Йосипович Васильчук', 'Quo non reiciendis dignissimos ut distinctio.', 'Quis porro suscipit voluptatem. Veniam sed culpa quam iste beatae iusto repellendus. Id iure commodi porro voluptatem vitae.', 'Sunt est voluptatum velit repudiandae tempora repudiandae. Enim architecto dolorem ut ipsa sed. Suscipit expedita et ab nulla voluptate vero similique omnis.', 17572, 1, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(25, 'Євген Анатолійович Кравченко', 'Debitis cumque quia atque possimus.', 'Excepturi molestiae voluptatem libero cumque iure eos dolores placeat. Qui dolorum culpa temporibus voluptas. Delectus ipsam aut quia architecto non earum praesentium.', 'Accusamus est fugit expedita dignissimos nobis quas sequi. Odit illo perspiciatis ab. Odio eum repellendus recusandae qui consequuntur et eius. Rerum qui aliquid sequi dolor et.', 14633, 1, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(26, 'Середа Анатолій Миколайович', 'Doloremque voluptas ab quam eaque incidunt.', 'Voluptates excepturi odio aspernatur quidem dolores dolor assumenda. Qui est soluta necessitatibus. Asperiores nam eligendi voluptas eos. Et illo aut ullam beatae provident laboriosam.', 'Corporis facilis et qui unde omnis est. Quos ut aut culpa cumque iste sed adipisci. Error ratione hic et est. Eius et corrupti optio tempora vel amet id.', 42852, 3, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(27, 'Крамарчук Роман Анатолійович', 'Consectetur voluptatem enim soluta omnis reprehenderit cum.', 'Porro voluptatibus quibusdam veniam. Quasi delectus eaque perspiciatis provident ullam. Et facilis molestiae aut iste quae labore eum. Quia ea sed quibusdam similique.', 'Omnis quas ipsam occaecati nobis. Repellat asperiores eveniet rerum blanditiis saepe assumenda. Architecto in dolor itaque aspernatur.', 32053, 2, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(28, 'Артем Валентинович Панасюк', 'Temporibus ea voluptatem dolores vitae repudiandae blanditiis.', 'Voluptate aliquam fugiat illo repudiandae officia ea molestiae impedit. Provident in doloribus maxime est. Minus dolore qui cum vero.', 'Magnam cum et alias commodi et et veritatis. Voluptas laudantium laborum magnam cupiditate quia veniam occaecati. Repellendus sit ducimus tenetur culpa consequuntur natus quasi non.', 39820, 1, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(29, 'Шевчук Станіслав Борисович', 'Vel soluta pariatur iste et enim dolor.', 'Itaque ratione qui qui velit. Porro et enim repellendus esse vel. Numquam dolore minus delectus iusto molestiae recusandae consequuntur. Impedit non in voluptatem nobis sed.', 'Nihil perferendis autem et consectetur consequatur. Quae consequuntur vitae recusandae est architecto.', 54382, 2, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(30, 'Таращук Кіра Євгенійович', 'Voluptatibus sed corrupti et commodi provident modi.', 'Voluptatum ut id sint id odio dolores doloremque doloribus. Culpa velit aut laudantium dolores error culpa. Enim ea eaque atque ut vel blanditiis enim.', 'Eum aliquid necessitatibus illo vitae et sit et. Asperiores eligendi beatae occaecati natus quam officia esse. Est facere debitis ratione. Alias ad adipisci voluptatem odit ab nihil.', 59040, 3, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(31, 'Любов Миколайович Броварчук', 'Sapiente et cum et consequatur.', 'Quasi ad recusandae esse accusamus voluptatem ea corporis. Itaque necessitatibus sequi et sunt sunt sint. Omnis corporis praesentium minima rem nesciunt eaque.', 'Ut nulla voluptatibus ipsum minus omnis quia vel. Aperiam doloribus adipisci ex ut sit architecto sed. Aut dolor eveniet quia ipsa laborum maiores eos.', 85055, 2, '2017-10-15 12:03:16', '2017-10-15 12:03:16'),
(32, 'Геннадій Борисович Павлюк', 'Earum similique ea sit quae natus.', 'Quo iusto fugit accusamus voluptates recusandae et consequatur. Eligendi voluptatem asperiores nihil. Minus quia eligendi est. Id dignissimos porro omnis architecto error.', 'Possimus explicabo quae eum aut repellendus temporibus. Praesentium enim dolor unde aut omnis. Et voluptates qui voluptatem et quo voluptatem labore.', 4628, 2, '2017-10-15 12:03:17', '2017-10-15 12:03:17'),
(33, 'Васильєв Віра Сергійович', 'Ullam et consequatur corrupti eaque adipisci ipsum odit numquam.', 'Minus doloribus nobis repudiandae provident dicta. Ut dignissimos vel qui iure tempora consectetur nihil. Corrupti eveniet provident sed dolores repellendus voluptas. Aut est libero eius.', 'Officia error accusamus molestias velit. Commodi voluptas sunt cumque doloremque velit soluta temporibus quasi. Molestiae facere error est animi amet id.', 85574, 2, '2017-10-15 12:03:17', '2017-10-15 12:03:17'),
(34, 'Євген Васильович Іванченко', 'Nam quisquam ut consequatur.', 'Saepe voluptatem ut exercitationem et consequuntur placeat. Recusandae molestiae officiis sed ipsum dolorem. Laborum laborum totam aut necessitatibus.', 'Nobis sint assumenda eum et. Doloribus quo ullam ut voluptatem molestiae eius. Aperiam ipsum repellendus ut iusto enim autem. Quisquam nam quis nostrum laborum eum tenetur quod.', 25154, 3, '2017-10-15 12:03:17', '2017-10-15 12:03:17'),
(35, 'Романченко Іван Тарасович', 'Facere soluta vel quis ut.', 'Eveniet distinctio et ratione vitae repellendus. Rerum voluptas id rerum delectus ducimus sapiente qui. Similique omnis id voluptas tempora eos qui. Doloremque repellat non magnam itaque. Quo qui officiis atque consequatur.', 'Molestiae saepe est sed repellendus. Natus et minus corporis aut. Totam ex cupiditate debitis et dolor recusandae. Necessitatibus corrupti quidem aut nulla. Dolorum a incidunt laboriosam ut.', 70963, 2, '2017-10-15 12:03:17', '2017-10-15 12:03:17'),
(36, 'Анастасія Васильович Панасюк', 'Expedita voluptatem a harum perferendis aut.', 'Nesciunt assumenda aut quod. Recusandae in iste accusantium qui. Temporibus qui pariatur quia qui deserunt voluptatem.', 'Et hic aut dolor repudiandae quidem ipsam dignissimos. Consequatur laborum incidunt provident reprehenderit omnis autem velit.', 76710, 3, '2017-10-15 12:03:18', '2017-10-15 12:03:18'),
(37, 'Валерій Володимирович Павлюк', 'Explicabo corporis ut aut numquam veritatis.', 'Neque dolorem delectus doloribus consequatur. In amet aliquid in dicta et omnis consectetur.', 'Tempora voluptas et et nam atque temporibus. Rerum est hic recusandae aliquid et rem dolores. Et adipisci officiis totam sapiente vitae rerum consequatur quia.', 70374, 2, '2017-10-15 12:03:18', '2017-10-15 12:03:18'),
(38, 'Пономаренко Ніна Валентинович', 'Aperiam maxime rerum voluptatem.', 'Eum assumenda enim vitae voluptatem numquam. Mollitia dolores porro in nam illo debitis. Saepe sit qui temporibus. Deleniti id vero magnam architecto necessitatibus.', 'Aliquid odit nobis occaecati dolorem amet. Et esse quo ut consequatur vero. Id voluptas ipsa est illo beatae. Officiis tenetur sint et asperiores ut a. Quo corrupti dolores alias doloribus eum et.', 38204, 3, '2017-10-15 12:03:18', '2017-10-15 12:03:18'),
(39, 'Дмитро Олександрович Боднаренко', 'Quam atque ut est.', 'Vel temporibus ut velit voluptatem voluptas. Quos debitis ut deserunt temporibus eos eius. Recusandae inventore beatae qui sed qui beatae. Est iusto nisi animi consequatur non itaque facilis sapiente.', 'Voluptatem explicabo quam quo illum. Inventore est est et assumenda quasi consequatur autem.', 64573, 1, '2017-10-15 12:03:18', '2017-10-15 12:03:18'),
(40, 'Віра Анатолійович Шевченко', 'Eligendi iure beatae aperiam ut praesentium qui.', 'Adipisci quis porro eum nam. Voluptatem nihil laudantium placeat adipisci. Maiores necessitatibus reprehenderit reprehenderit rerum velit quasi sint.', 'Voluptatem nesciunt aut nobis omnis laudantium. Ut nostrum cupiditate dolores officia. Commodi repellat maxime voluptatem iure natus omnis id. Eum possimus id quo similique.', 11337, 1, '2017-10-15 12:03:18', '2017-10-15 12:03:18'),
(41, 'Васильчук Юлія Євгенійович', 'Et tenetur quos distinctio exercitationem architecto.', 'Vero assumenda omnis eaque et. Quis perspiciatis rerum sed quidem adipisci. Qui quo saepe fugiat delectus. Sapiente quo voluptates blanditiis quia autem non ratione. Doloremque itaque quia quibusdam enim dignissimos.', 'Eaque est porro veritatis. Itaque cupiditate expedita sunt enim. Nemo culpa modi eaque excepturi voluptatem sit id. Accusantium eos est asperiores eveniet delectus libero debitis quo.', 85192, 2, '2017-10-15 12:03:18', '2017-10-15 12:03:18'),
(42, 'Марина Тарасович Шинкаренко', 'Ipsam quis culpa amet totam consectetur repellendus.', 'Aut nulla ut sed quae cumque consectetur ipsam. Voluptates aut aperiam qui sint incidunt expedita. Sunt ad laudantium expedita dolor molestiae.', 'Repellendus ducimus et ut asperiores veritatis. Rerum ut quo at vero voluptas dicta. Doloremque qui ut cumque quisquam corrupti doloribus. Occaecati sequi fuga et explicabo.', 28924, 2, '2017-10-15 12:03:18', '2017-10-15 12:03:18'),
(43, 'Наташа Євгенович Мельниченко', 'Ipsam molestias rerum non repellat.', 'Qui sit nemo ad nemo esse. Quis nisi fuga similique officiis voluptas qui. Recusandae illo nostrum quod id.', 'Commodi optio reiciendis corporis rerum quis vel. Tempore eaque quibusdam quos totam. Autem a eligendi minus facere labore ut dignissimos.', 17536, 2, '2017-10-15 12:03:19', '2017-10-15 12:03:19'),
(44, 'Кравченко Павло Володимирович', 'Commodi molestiae in adipisci.', 'Temporibus magnam explicabo est earum placeat. Est ipsa praesentium ea non id pariatur. Fuga enim officia maiores hic qui corporis.', 'Distinctio sit doloremque et officiis voluptate est. Ut eos atque quisquam eos. Saepe saepe delectus quaerat.', 39314, 3, '2017-10-15 12:03:19', '2017-10-15 12:03:19'),
(45, 'Кирил Васильович Кравчук', 'Voluptatem quaerat molestiae quo ratione tenetur odit est.', 'Omnis est animi aperiam dolores ut. Veniam modi dolor et doloremque perspiciatis. A dolorum aliquid dignissimos nisi nulla est.', 'Iusto voluptas quos et voluptate odit. Suscipit id placeat quis et saepe. Maiores fugiat culpa est omnis. Ducimus consequatur laboriosam unde.', 31246, 1, '2017-10-15 12:03:19', '2017-10-15 12:03:19'),
(46, 'Віра Олексійович Сергієнко', 'Nesciunt ut provident dolorem deleniti.', 'Quaerat dolores suscipit non molestiae vitae. Sit suscipit eum atque animi. Perspiciatis suscipit voluptatum voluptate.', 'Dicta praesentium quidem consequatur et velit ullam. Enim dolore aut enim et. Cumque illum sequi corrupti suscipit praesentium nam. Aspernatur accusamus in sed eveniet.', 15830, 3, '2017-10-15 12:03:19', '2017-10-15 12:03:19'),
(47, 'Людмила Миколайович Таращук', 'Aut nihil est blanditiis cupiditate similique aut.', 'Nisi corrupti sit natus. Fuga error corrupti incidunt veniam molestiae. Odit iste deserunt et qui delectus dolores alias.', 'Rem non voluptatem qui. Qui deleniti exercitationem molestiae et. Ut est distinctio inventore quidem architecto optio ea.', 50584, 2, '2017-10-15 12:03:19', '2017-10-15 12:03:19'),
(48, 'Боднаренко Єлизавета Іванович', 'Fugiat quis nesciunt assumenda.', 'Commodi reiciendis commodi dicta. Tempore deleniti autem ipsa. Earum qui voluptatem consequuntur aut est. Sed expedita et quo exercitationem. Ratione rerum vel corporis.', 'Numquam magnam quos consequatur eum sed quidem dolores eveniet. Dolores ea recusandae consectetur impedit quia. Voluptates hic aliquam odio sed iusto.', 18930, 2, '2017-10-15 12:03:19', '2017-10-15 12:03:19'),
(49, 'Броварчук Антон Володимирович', 'Quis animi in facilis exercitationem quia aliquam cum.', 'Consequuntur autem molestiae esse doloribus eos assumenda. Sint aut aliquid id ab totam accusamus beatae in. Quo ut vel eum excepturi.', 'Tempore animi sed et molestias animi velit. Quibusdam consequatur fugit et nostrum in magni et. Dolores voluptas ipsam voluptas quos. Tempora sed fuga laudantium quia ratione eum cum.', 49929, 2, '2017-10-15 12:03:19', '2017-10-15 12:03:19'),
(50, 'Микитюк Раїса Олексійович', 'Et quia dolore laudantium sit.', 'Commodi aliquam voluptatem consequatur aliquid. Optio cumque at tempora ipsa numquam commodi. Aut qui in dolores consequatur. Quis soluta qui eum qui atque.', 'Ea molestiae magnam soluta minus. Cupiditate velit sed est quia tempora. Mollitia est vel totam cupiditate tempore eum et.', 53382, 1, '2017-10-15 12:03:20', '2017-10-15 12:03:20');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `url`, `title`, `created_at`, `updated_at`) VALUES
(1, 'slider1.jpg', '/slider1', 'slider1', NULL, NULL),
(2, 'slider2.jpg', '/slider2', 'slider2', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@user.user', '$2y$10$PrA.Op4PHU/cmaZCnPCN4uquHPglpayl48XOVishVTUc9ePe9N13q', 'bTrvaxoHoeuXlZTVcpHZQqr2SHHm0RJuTaDehHGqVREzObrbi2sQeQmh9FSI', '2017-10-16 02:56:03', '2017-10-16 02:56:03');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_product`
--
ALTER TABLE `category_product`
  ADD KEY `category_product_product_id_index` (`product_id`),
  ADD KEY `category_product_category_id_index` (`category_id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_parent_id_index` (`parent_id`),
  ADD KEY `comments_product_id_index` (`product_id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id_index` (`product_id`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Индексы таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_author_index` (`author`),
  ADD KEY `products_title_index` (`title`),
  ADD KEY `products_manufacturer_id_index` (`manufacturer_id`);

--
-- Индексы таблицы `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `backgrounds`
--
ALTER TABLE `backgrounds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT для таблицы `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
