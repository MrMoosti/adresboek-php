-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 mei 2018 om 20:46
-- Serverversie: 10.1.32-MariaDB
-- PHP-versie: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `addressbook`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contactperson`
--

CREATE TABLE `contactperson` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `insertion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `business_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `telephone_private` varchar(255) COLLATE utf8_bin NOT NULL,
  `telephone_work` varchar(255) COLLATE utf8_bin NOT NULL,
  `work_location` varchar(255) COLLATE utf8_bin NOT NULL,
  `img_filename` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `img_size` int(11) DEFAULT NULL,
  `img_type` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `contactperson`
--

INSERT INTO `contactperson` (`id`, `first_name`, `insertion`, `last_name`, `business_name`, `email`, `telephone_private`, `telephone_work`, `work_location`, `img_filename`, `img_size`, `img_type`) VALUES
(2, 'philip', NULL, 'larsen', 'Kiehn, Kulas and Blick', 'philip.larsen@example.com', '91823903', '07256466', 'ishoej', 'https://randomuser.me/api/portraits/men/31.jpg', NULL, NULL),
(3, 'august', NULL, 'hansen', 'Streich Ltd', 'august.hansen@example.com', '98926605', '17476751', 'roslev', 'https://randomuser.me/api/portraits/men/26.jpg', NULL, NULL),
(4, 'christiana', NULL, 'slijkhuis', 'Will-Dickens', 'christiana.slijkhuis@example.com', '(893)-768-5159', '(541)-278-9332', 'strijen', 'https://randomuser.me/api/portraits/women/55.jpg', NULL, NULL),
(5, 'latife', NULL, 'erbay', 'Quitzon-Adams', 'latife.erbay@example.com', '(132)-831-2037', '(567)-837-7674', 'bitlis', 'https://randomuser.me/api/portraits/women/18.jpg', NULL, NULL),
(6, 'josca', NULL, 'taal', 'Anderson, Botsford and Hermann', 'josca.taal@example.com', '(809)-052-7907', '(638)-326-1199', 'vlaardingen', 'https://randomuser.me/api/portraits/women/66.jpg', NULL, NULL),
(7, 'scarlett', NULL, 'brooks', 'Luettgen, Hettinger and Hirthe', 'scarlett.brooks@example.com', '0740-855-306', '013873 91369', 'wolverhampton', 'https://randomuser.me/api/portraits/women/89.jpg', NULL, NULL),
(8, 'arjun', NULL, 'schildmeijer', 'Kihn-McLaughlin', 'arjun.schildmeijer@example.com', '(206)-662-6428', '(818)-812-0435', 'purmerend', 'https://randomuser.me/api/portraits/men/22.jpg', NULL, NULL),
(9, 'alessio', NULL, 'leclerc', 'Effertz, Aufderhar and Corkery', 'alessio.leclerc@example.com', '(086)-233-3057', '(911)-085-5674', 'montricher', 'https://randomuser.me/api/portraits/men/25.jpg', NULL, NULL),
(10, 'arturo', NULL, 'mendez', 'Spinka-Gorczany', 'arturo.mendez@example.com', '670-247-693', '918-036-338', 'oviedo', 'https://randomuser.me/api/portraits/men/13.jpg', NULL, NULL),
(11, 'leta', NULL, 'garrett', 'Brekke, Dickinson and Nader', 'leta.garrett@example.com', '(060)-888-3688', '(722)-778-6888', 'escondido', 'https://randomuser.me/api/portraits/women/1.jpg', NULL, NULL),
(12, 'nete', NULL, 'da paz', 'Kutch and Sons', 'nete.dapaz@example.com', '(27) 9690-1250', '(60) 2201-0966', 'santarÃ©m', 'https://randomuser.me/api/portraits/women/8.jpg', NULL, NULL),
(13, 'debra', NULL, 'bishop', 'Murazik PLC', 'debra.bishop@example.com', '0744-261-346', '013873 39188', 'salisbury', 'https://randomuser.me/api/portraits/women/15.jpg', NULL, NULL),
(14, 'julius', NULL, 'remes', '', 'julius.remes@example.com', '041-989-21-12', '02-854-007', 'kaavi', 'https://randomuser.me/api/portraits/men/42.jpg', NULL, NULL),
(15, 'micaela', NULL, 'da costa', 'Johnson, Heller and Emmerich', 'micaela.dacosta@example.com', '(19) 6140-2372', '(57) 3938-7320', 'araraquara', 'https://randomuser.me/api/portraits/women/67.jpg', NULL, NULL),
(16, 'bruce', NULL, 'montgomery', 'Turcotte LLC', 'bruce.montgomery@example.com', '0730-394-543', '0118142 017 9022', 'swansea', 'https://randomuser.me/api/portraits/men/14.jpg', NULL, NULL),
(17, 'yasemin', NULL, 'Ã¶nÃ¼r', 'Murray-Hodkiewicz', 'yasemin.Ã¶nÃ¼r@example.com', '(830)-025-8734', '(183)-212-0466', 'Ã§ankÄ±rÄ±', 'https://randomuser.me/api/portraits/women/48.jpg', NULL, NULL),
(18, 'mya', NULL, 'perez', 'Auer Ltd', 'mya.perez@example.com', '06-43-10-87-96', '04-39-16-24-79', 'paris', 'https://randomuser.me/api/portraits/women/20.jpg', NULL, NULL),
(19, 'Ã¼lkÃ¼', NULL, 'yorulmaz', 'Bruen, Barton and Ernser', 'Ã¼lkÃ¼.yorulmaz@example.com', '(077)-120-9435', '(448)-444-7297', 'aydÄ±n', 'https://randomuser.me/api/portraits/women/67.jpg', NULL, NULL),
(20, 'anthony', NULL, 'stanley', 'Ernser-Kuhic', 'anthony.stanley@example.com', '081-231-6187', '051-474-7399', 'limerick', 'https://randomuser.me/api/portraits/men/75.jpg', NULL, NULL),
(21, 'jacob', NULL, 'miller', 'Heathcote PLC', 'jacob.miller@example.com', '101-707-5082', '833-851-0686', 'carleton', 'https://randomuser.me/api/portraits/men/91.jpg', NULL, NULL),
(22, 'elli', NULL, 'keto', 'Sauer PLC', 'elli.keto@example.com', '044-738-77-28', '03-994-093', 'larsmo', 'https://randomuser.me/api/portraits/women/63.jpg', NULL, NULL),
(23, 'justine', NULL, 'bouchard', 'Wunsch-Corkery', 'justine.bouchard@example.com', '139-845-8357', '074-991-5444', 'westport', 'https://randomuser.me/api/portraits/women/56.jpg', NULL, NULL),
(24, 'josefa', NULL, 'duarte', 'Farrell Inc', 'josefa.duarte@example.com', '(68) 7596-5316', '(01) 0000-7565', 'campo largo', 'https://randomuser.me/api/portraits/women/57.jpg', NULL, NULL),
(25, 'kÃ¼bra', NULL, 'akgÃ¼l', 'Sipes, Altenwerth and Walker', 'kÃ¼bra.akgÃ¼l@example.com', '(142)-770-5248', '(758)-225-0415', 'bartÄ±n', 'https://randomuser.me/api/portraits/women/44.jpg', NULL, NULL),
(26, 'danile', NULL, 'moreira', 'Jones-Rosenbaum', 'danile.moreira@example.com', '(36) 7671-4359', '(84) 5545-4685', 'trÃªs lagoas', 'https://randomuser.me/api/portraits/women/67.jpg', NULL, NULL),
(27, 'aaron', NULL, 'turner', 'Hettinger Inc', 'aaron.turner@example.com', '(784)-277-0709', '(402)-393-8173', 'boulder', 'https://randomuser.me/api/portraits/men/91.jpg', NULL, NULL),
(28, 'dave', NULL, 'ward', 'Hagenes-Steuber', 'dave.ward@example.com', '(828)-959-3988', '(776)-107-7182', 'cedar hill', 'https://randomuser.me/api/portraits/men/22.jpg', NULL, NULL),
(29, 'meral', NULL, 'erberk', 'Walter, Kuvalis and Mitchell', 'meral.erberk@example.com', '(513)-505-4292', '(560)-700-5892', 'sakarya', 'https://randomuser.me/api/portraits/women/41.jpg', NULL, NULL),
(30, 'rÃ©mi', NULL, 'deschamps', 'Schulist-Armstrong', 'rÃ©mi.deschamps@example.com', '06-19-09-52-29', '04-74-31-64-48', 'metz', 'https://randomuser.me/api/portraits/men/10.jpg', NULL, NULL),
(31, 'johan', NULL, 'thomsen', 'Walter and Sons', 'johan.thomsen@example.com', '92655939', '78656155', 'nÃ¸rrebro', 'https://randomuser.me/api/portraits/men/10.jpg', NULL, NULL),
(32, 'mattie', NULL, 'rice', 'Carter-Wilkinson', 'mattie.rice@example.com', '(802)-994-2383', '(900)-941-2448', 'irvine', 'https://randomuser.me/api/portraits/women/76.jpg', NULL, NULL),
(33, 'jade', NULL, 'lecomte', 'Gerlach-Zboncak', 'jade.lecomte@example.com', '06-35-46-18-63', '05-72-82-97-47', 'perpignan', 'https://randomuser.me/api/portraits/women/92.jpg', NULL, NULL),
(34, 'emily', NULL, 'jones', 'Dickens, Jacobi and Cartwright', 'emily.jones@example.com', '(442)-660-2425', '(491)-829-8881', 'napier', 'https://randomuser.me/api/portraits/women/75.jpg', NULL, NULL),
(35, 'rosa', NULL, 'petersen', 'Veum PLC', 'rosa.petersen@example.com', '61876604', '55090335', 'snertinge', 'https://randomuser.me/api/portraits/women/91.jpg', NULL, NULL),
(36, 'bertram', NULL, 'poulsen', 'Smitham, Wuckert and Prosacco', 'bertram.poulsen@example.com', '02663255', '90743757', 'amager', 'https://randomuser.me/api/portraits/men/28.jpg', NULL, NULL),
(37, 'frankie', NULL, 'palmer', 'Marvin, Kautzer and Strosin', 'frankie.palmer@example.com', '0723-718-272', '017687 12443', 'newcastle upon tyne', 'https://randomuser.me/api/portraits/men/7.jpg', NULL, NULL),
(38, 'brenda', NULL, 'da mota', 'Daugherty, Jast and Heaney', 'brenda.damota@example.com', '(84) 9594-9707', '(67) 5283-4876', 'santos', 'https://randomuser.me/api/portraits/women/10.jpg', NULL, NULL),
(39, 'viljami', NULL, 'waisanen', 'Smith, Bailey and Heller', 'viljami.waisanen@example.com', '043-738-13-01', '03-254-213', 'humppila', 'https://randomuser.me/api/portraits/men/72.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `insertion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `telephone` varchar(255) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `img_filename` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `img_size` int(11) DEFAULT NULL,
  `img_type` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `first_name`, `insertion`, `last_name`, `email`, `telephone`, `username`, `password`, `admin`, `img_filename`, `img_size`, `img_type`) VALUES
(1, 'Mustafa', '', 'Yilmaz', 'mustafa.yilmaz@gmail.com', '0315-123456789', 'mustafa.yilmaz', 'yilmaz', 0, '', 0, ''),
(2, 'Bram', NULL, 'Korbeetje', 'bram.korbeetje@gmail.com', '0315-123456789', 'bram.korbeetje', 'korbeetje', 0, NULL, NULL, NULL),
(3, 'Jacco', NULL, 'Wacko', 'jacko.wacko@gmail.com', '0315-123456789', 'jacko.wacko', 'wacko', 0, NULL, NULL, NULL),
(4, 'Jesse', NULL, 'Baljeet', 'jesse.baljeet@gmail.com', '0315-123456789', 'jesse.baljeet', 'baljeet', 0, NULL, NULL, NULL),
(5, 'Jelmer', NULL, 'Jasgoed', 'jelmer.jasgoed@gmail.com', '0315-123456789', 'jelmer.jasgoed', 'jasgoed', 0, NULL, NULL, NULL),
(6, 'Admin', '', 'Admin', 'admin@admin.com', '0315-123456789', 'admin', 'admin', 1, '', 0, '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contactperson`
--
ALTER TABLE `contactperson`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contactperson`
--
ALTER TABLE `contactperson`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

