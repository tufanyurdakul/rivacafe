-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 17 Kas 2021, 22:34:29
-- Sunucu sürümü: 10.3.31-MariaDB
-- PHP Sürümü: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ptowncC3_dbrest`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `food_name` varchar(22) NOT NULL,
  `food_price` varchar(10) NOT NULL,
  `food_stock` varchar(10) NOT NULL,
  `food_reduce` int(11) NOT NULL,
  `food_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `menu`
--

INSERT INTO `menu` (`id`, `food_name`, `food_price`, `food_stock`, `food_reduce`, `food_type`) VALUES
(1, 'Hamburger', '22', '0', 0, 'Yemek'),
(3, 'KutuCola', '7', '-6', 0, 'SoÄŸukÄ°Ã§ecek'),
(4, 'Soda', '4', '6', 0, 'SoÄŸukÄ°Ã§ecek'),
(5, 'PatatesKÄ±zartmasÄ±', '12.5', '10', 0, 'Yemek'),
(6, 'KaramBitter', '7.5', '-2', 0, 'Ã‡ikolata'),
(7, 'Ã‡ay', '2.5', '982', 0, 'SÄ±cakÄ°Ã§ecek'),
(8, 'TÃ¼rkKahvesi', '8', '485', 0, 'SÄ±cakÄ°Ã§ecek'),
(9, 'Cola(1L)', '9', '900', 0, 'SoÄŸukÄ°Ã§ecek'),
(10, 'Popkek', '2', '22', 0, NULL),
(12, 'KaÅŸarlÄ± Tost', '12.5', '1000', 0, NULL),
(13, 'KarÄ±ÅŸÄ±k Tost', '15', '999', 0, NULL),
(14, 'GÃ¶zleme', '15', '0', 0, NULL),
(15, 'KÃ¶fte Ekmek', '25', '0', 0, NULL),
(16, 'Porsiyon KÃ¶fte', '30', '1000', 0, NULL),
(17, 'MantÄ±', '20', '-2', 0, NULL),
(18, 'Sucuk Ekmek', '20', '100', 0, NULL),
(19, 'Patso', '15', '0', 0, NULL),
(20, 'Tavuk Burger', '20', '0', 0, NULL),
(21, 'Tavuk Ekmek', '20', '0', 0, NULL),
(22, 'IceTea', '8', '0', 0, 'SoÄŸukÄ°Ã§ecek'),
(23, 'BÃ¼yÃ¼kAyran', '5', '0', 0, 'SoÄŸukÄ°Ã§ecek'),
(24, 'KÃ¼Ã§Ã¼kAyran', '4.5', '0', 0, 'SoÄŸukÄ°Ã§ecek'),
(25, 'ÅžiÅŸeKola', '6', '-4', 0, 'SoÄŸukÄ°Ã§ecek'),
(26, 'Su', '2', '-9', 0, NULL),
(27, 'FiltreKahve', '10', '-1', 0, 'SÄ±cakÄ°Ã§ecek'),
(28, 'Nescafe', '6', '-1', 0, 'SÄ±cakÄ°Ã§ecek'),
(29, 'YeÅŸilÃ‡ay', '5', '-5', 0, 'SÄ±cakÄ°Ã§ecek'),
(30, 'Sprite', '7', '0', 0, 'SoÄŸukÄ°Ã§ecek'),
(31, 'Fanta', '7', '-2', 0, 'SoÄŸukÄ°Ã§ecek'),
(32, 'KahvaltÄ± TabaÄŸÄ±', '40', '0', 0, NULL),
(33, 'Serpme KahvaltÄ±', '60', '0', 0, NULL),
(34, 'Magnum', '10', '-4', 0, 'Dondurma'),
(35, 'CornetGrubu', '7', '-5', 0, 'Dondurma'),
(36, 'Unicorn(Dondurma)', '8', '0', 0, 'Dondurma'),
(37, 'OreoDondurma', '8', '0', 0, 'Dondurma'),
(38, 'TwisterDondurma', '4', '0', 0, 'Dondurma'),
(39, 'MaraÅŸCup', '6.5', '0', 0, 'Dondurma'),
(40, 'Nugger', '6.5', '-5', 0, 'Dondurma'),
(41, 'AlgidaClassic', '4.5', '-11', 0, 'Dondurma'),
(42, 'YazbuzDondurma', '3', '0', 0, 'Dondurma'),
(43, 'GokkusagÄ±Dondurma', '3.5', '0', 0, 'Dondurma'),
(44, 'SusamlÄ± Kraker', '3.5', '-3', 0, NULL),
(45, '20TLÃ–DEME', '-20', '-3', 0, 'Ã–DEME'),
(47, '50TLÃ–DEME', '-50', '-1', 0, 'Ã–DEME'),
(50, '100TLÃ–DEME', '-100', '1000', 0, 'Ã–DEME'),
(51, '200TLÃ–DEME', '-200', '1000', 0, 'Ã–DEME');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `request_user`
--

CREATE TABLE `request_user` (
  `id` int(11) NOT NULL,
  `home_no` varchar(9) NOT NULL,
  `pass` varchar(22) NOT NULL,
  `username` varchar(22) NOT NULL,
  `surname` varchar(22) NOT NULL,
  `phone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `show_tables`
--

CREATE TABLE `show_tables` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `show_tables`
--

INSERT INTO `show_tables` (`id`, `table_id`, `food_id`, `count`, `date`) VALUES
(36, 12, 6, 3, '2021-09-14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `show_users`
--

CREATE TABLE `show_users` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `reduce` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `show_users`
--

INSERT INTO `show_users` (`id`, `users_id`, `menu_id`, `date`, `reduce`, `count`, `price`) VALUES
(12, 14, 3, '2021-06-04', 0, 8, '7.50'),
(44, 17, 4, '2021-07-07', 0, 5, '4'),
(45, 17, 1, '2021-07-07', 10, 1, '22'),
(76, 18, 26, '2021-07-08', 0, 3, '2'),
(77, 18, 44, '2021-07-08', 0, 1, '3.5'),
(92, 2, 41, '2021-09-02', 0, 4, '4.5'),
(93, 2, 25, '2021-09-02', 0, 1, '6');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_name` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tables`
--

INSERT INTO `tables` (`id`, `table_name`) VALUES
(5, 'MASA-1'),
(7, 'MASA-2'),
(8, 'MASA-3'),
(9, 'Tufan'),
(10, 'ErgÃ¼n'),
(11, 'selamibey'),
(12, 'bbÃ¼lent');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `home_no` varchar(9) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `name` varchar(22) NOT NULL,
  `surname` varchar(22) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `access` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `home_no`, `pass`, `name`, `surname`, `phone`, `access`) VALUES
(1, 'CAFE', 'yasincaferiva', 'yasin', 'AyduÄŸan', '05452167935', 1),
(2, 'A13D', 'voleybolcu2', 'MayisAyi', 'Yurdakul', '05354951884', 0),
(18, 'A26A', '111111111', 'A26A', 'A26A', '1261', 0),
(19, '1', '1', '1', '1', '1', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `request_user`
--
ALTER TABLE `request_user`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `show_tables`
--
ALTER TABLE `show_tables`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `show_users`
--
ALTER TABLE `show_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Tablo için AUTO_INCREMENT değeri `request_user`
--
ALTER TABLE `request_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `show_tables`
--
ALTER TABLE `show_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `show_users`
--
ALTER TABLE `show_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Tablo için AUTO_INCREMENT değeri `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
