-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2016 at 12:39 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drustvene_igre`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_forum`
--

CREATE TABLE `kategorija_forum` (
  `ID_fkat` int(3) UNSIGNED NOT NULL,
  `Naziv_fkat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Opis_fkat` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_proizvod`
--

CREATE TABLE `kategorija_proizvod` (
  `ID_pkat` int(3) NOT NULL,
  `Naziv_pkat` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija_proizvod`
--

INSERT INTO `kategorija_proizvod` (`ID_pkat`, `Naziv_pkat`) VALUES
(0, 'TRADICIONALNE IGRE'),
(1, 'IGRE NA PLOCI'),
(2, 'DODATNA OPREMA'),
(3, 'KARTASKE IGRE');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `ID_korisnik` int(6) UNSIGNED NOT NULL,
  `Ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Spol` enum('M','Z') COLLATE utf8_unicode_ci NOT NULL,
  `Datum_rodjenja` date NOT NULL,
  `Adresa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Email_kor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Mob_tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Post_broj` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Mjesto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Korisnicko_ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Lozinka` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Drzava` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `VK_uloga` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID_korisnik`, `Ime`, `Prezime`, `Spol`, `Datum_rodjenja`, `Adresa`, `Email_kor`, `Mob_tel`, `Post_broj`, `Mjesto`, `Korisnicko_ime`, `Lozinka`, `Drzava`, `VK_uloga`) VALUES
(1, 'ad', 'min', 'M', '1990-08-04', 'neka adresa', 'neki@mail.hr', '000999888', '34043', 'mjesto', 'admin', 'admin', 'hr', 1),
(2, 'Ivan', 'Markovic', 'M', '1997-02-03', 'Neka Adresa 17', 'inarkky@gmail.com', '099666999', '31311', 'Grad', 'user', 'user', 'Drzava', 2),
(3, 'Katarina', 'Bunikic', '', '0000-00-00', 'Neka Ulica 2A', 'inarkky@gmail.com', '099998887', '34322', 'Brestovac', 'kejt', 'kejt', 'Hrvatska', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kosarica`
--

CREATE TABLE `kosarica` (
  `ID_kos` int(6) UNSIGNED NOT NULL,
  `Kolicina` int(4) UNSIGNED NOT NULL,
  `Ukupno` float(7,2) NOT NULL,
  `VK_proizvod` int(8) UNSIGNED NOT NULL,
  `VK_korisnik` int(6) UNSIGNED NOT NULL,
  `VK_narudzba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kosarica`
--

INSERT INTO `kosarica` (`ID_kos`, `Kolicina`, `Ukupno`, `VK_proizvod`, `VK_korisnik`, `VK_narudzba`) VALUES
(2, 1, 8.00, 52, 2, 15),
(3, 29, 232.00, 52, 2, 16),
(4, 19, 475.00, 41, 2, 16),
(5, 6, 1800.00, 51, 2, 17),
(6, 1, 25.00, 41, 2, 17),
(7, 13, 104.00, 52, 2, 18),
(8, 1, 24.00, 50, 2, 18),
(9, 1, 24.00, 50, 2, 19),
(10, 13, 104.00, 52, 2, 20),
(11, 1, 300.00, 51, 2, 20),
(12, 1, 8.00, 52, 2, 21),
(13, 1, 8.00, 52, 2, 22),
(14, 1, 8.00, 52, 2, 23),
(15, 1, 8.00, 52, 2, 24),
(16, 1, 49.99, 42, 2, 25),
(17, 1, 49.99, 42, 2, 26),
(18, 1, 8.00, 52, 2, 27),
(19, 1, 300.00, 51, 2, 28),
(20, 8, 88.00, 43, 3, 29),
(21, 2, 150.00, 45, 3, 29);

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `ID_nar` int(6) UNSIGNED NOT NULL,
  `Datum_nar` date NOT NULL,
  `Napomena` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Postarina` float(5,2) NOT NULL DEFAULT '25.00',
  `Ukupno_pdv` float(10,2) NOT NULL,
  `adresa_dostave` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`ID_nar`, `Datum_nar`, `Napomena`, `Postarina`, `Ukupno_pdv`, `adresa_dostave`) VALUES
(15, '2016-02-22', 'rsgf', 25.00, 35.00, 'trsgts'),
(16, '2016-02-23', 'hgfhfgc', 0.00, 883.75, 'dfgdfgf'),
(17, '2016-02-23', 'ftzgfzhnugbtzfgki', 0.00, 2281.25, 'sedsxtrjdc 12'),
(18, '2016-02-23', 'sdffds', 25.00, 185.00, 'dsadas'),
(19, '2016-02-23', 'lalalalllala', 25.00, 55.00, 'lalalalal'),
(20, '2016-02-23', 'utzujt', 0.00, 505.00, 'rtz'),
(21, '2016-02-24', 'dfssdfsdfs', 25.00, 35.00, 'dsffsdfds'),
(22, '2016-02-24', 'gdfgrfg', 25.00, 35.00, 'grfdgf'),
(23, '2016-02-24', 'grfggd', 25.00, 35.00, 'gdf'),
(24, '2016-02-24', 'dftkv', 25.00, 35.00, 'gzuvgzf'),
(25, '2016-02-26', 'gfrxd', 25.00, 87.49, 'fdvfd'),
(26, '2016-02-26', 'tgdtz', 25.00, 87.49, 'tgfdhzt'),
(27, '2016-02-26', 'tfsgrsd', 25.00, 35.00, 'tesgt'),
(28, '2016-02-26', 'hztdh', 25.00, 400.00, 'hfthtz'),
(29, '2016-03-21', 'Lijepo sloziti', 25.00, 322.50, 'Nova Gradiska');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE `novosti` (
  `id` int(11) NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `full` text COLLATE utf8_unicode_ci NOT NULL,
  `naslov` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kategorija` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'novosti'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`id`, `slika`, `short`, `full`, `naslov`, `kategorija`) VALUES
(2, 'images/cl_2.jpg', 'Jednog jutra u Beliscu..', 'Desilo seDesilo seDesilo seDesilo se http://www.Desilose.De/silo seDesilo seDesilo seDesilo seDesilo www.seDesilo.se/Des.ilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo seDesilo se', 'Novi clanak', 'novosti'),
(3, '', 'Bla bldudgusdbfh ug zsdfs zgf fzsgf...', 'novosti', 'Jos jedan', ''),
(4, 'images/cl_4.jpg', 'o nama', 'â€žWizard Storeâ€œ web shop je trgovina koja u svojoj ponudi ima iskljuÄivo druÅ¡tvene igre. U naÅ¡em web shopu moÅ¾ete pronaÄ‡i bogati izbor razliÄitih druÅ¡tvenih igara i dodatne opreme. Korisnicima je omoguÄ‡en pregled druÅ¡tvenih igara, novosti vezanih za njih i kupnja.\r\nâ€žWizard Storeâ€œ osnovan je u veljaÄi  2016. godine. Pri stvaranju ovog web shopa predano je radio tim od 6 ljudi, a nadamo se da Ä‡e u buduÄ‡nosti taj broj joÅ¡ i rasti. Na profesionalni naÄin pomaÅ¾emo naÅ¡im klijentima da doÄ‘u do Å¾eljenih igara.\r\nSvim klijentima koji koriste Å¡iroku paletu naÅ¡ih usluga uvijek odobravamo posebne cijene i popuste. Za viÅ¡e informacija moÅ¾ete nas kontaktirati putem naÅ¡e e-mail adrese.\r\nMi smo zadovoljni kada su naÅ¡i klijenti zadovoljni!\r\n\r\nVaÅ¡ â€žWizard Storeâ€œ tim', 'O nama', 'about'),
(5, 'images/cl_5.jpg', '--', 'PruÅ¾iti svakom kupcu i korisniku Å¡iroki aspekt proizvoda, te ugodnu i uspjeÅ¡nu kupnju. \r\n\r\nTo provide each customer and user broad aspect of products, and pleasant and successful purchase. \r\n', 'Vizija', 'about'),
(6, 'images/cl_6.jpg', '--', 'Kontinuiranim ulaganjem u poboljÅ¡anje usluga i razvoj, te dobrim odnosima s partnerima postati vodeÄ‡i duÄ‡an u trgovanju druÅ¡tvenim igrama. Istovremeno, aktivno sudjelovati u razvoju druÅ¡tva kako bi svi ljubitelji igara imali pristup svojim hobijima. ', 'ProÅ¡irena vizija', 'about'),
(7, 'images/cl_7.jpg', '--', 'UoÄavanje i zadovoljavanje potreba naÅ¡ih kupaca i korisnika, dobavljaÄa, zaposlenika, vlasnika i ostalih partnera s kojima direktno ili indirektno suraÄ‘ujemo na naÅ¡em trÅ¾iÅ¡tu i Å¡ire. Wizard store duÄ‡an stalnim unapreÄ‘enjem poslovanja i kvalitete usluga, usmjerena je na stvaranje veÄ‡e vrijednosti i osiguranje izvrsnosti.', 'Misija', 'about'),
(8, 'images/cl_8.jpg', '--', 'SIGURNOST I KVALITETA<br>\r\nSvi ponuÄ‘eni proizvodi i usluge uvijek su u skladu s najviÅ¡im standardima sigurnosti i kvalitete.<hr>\r\nISKRENOST  I POÅ TOVANJE<br>\r\nPoÅ¡tujemo dostojanstvo svakog pojedinca, njegova zakonska i etiÄka prava. SluÅ¡amo, podrÅ¾avamo i vjerujemo jedni drugima. Odgovorni smo i drÅ¾imo dana obeÄ‡anja.<hr>\r\nRAZVOJ<br>\r\nTeÅ¾imo unaprijeÄ‘enu naÅ¡ih vjeÅ¡tina, sposobnosti i kapaciteta ponude.<hr>\r\nENTUZIJAZAM<br>\r\nUnosimo pozitivnu energiju, zabavu i strast u sve Å¡to radimo.<hr>\r\nETIÄŒNOST U RADU<br>\r\nNaÅ¡e je poslovanje druÅ¡tveno odgovorno i poÅ¡tujemo najviÅ¡e profesionalne i etiÄke standarde\r\n', 'Vrijednosti', 'about');

-- --------------------------------------------------------

--
-- Table structure for table `odgovor`
--

CREATE TABLE `odgovor` (
  `ID_odg` int(5) UNSIGNED NOT NULL,
  `Sadrzaj` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Datum_odg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `VK_korisnik` int(6) UNSIGNED NOT NULL,
  `VK_tema` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poduzece`
--

CREATE TABLE `poduzece` (
  `OIB` int(11) UNSIGNED NOT NULL,
  `Naziv_pod` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Naziv_djelatnosti` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Adresa_pod` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Telefon_pod` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Ziroracun` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `Naziv_banke` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email_pod` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poduzece`
--

INSERT INTO `poduzece` (`OIB`, `Naziv_pod`, `Naziv_djelatnosti`, `Adresa_pod`, `Telefon_pod`, `Ziroracun`, `Naziv_banke`, `Email_pod`) VALUES
(1111111111, 'ime', 'trgovina', 'adresa poduzeca', '000000000', 'hr01234000986985698', 'splitska', 'opet@neki.ml');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `ID_pro` int(8) UNSIGNED NOT NULL,
  `Naziv_pro` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `Opis_pro` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `Cijena_kn` float(7,2) DEFAULT '0.00',
  `Kol_lager` int(4) NOT NULL DEFAULT '0',
  `Slika_pro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `VK_pkat` int(3) UNSIGNED NOT NULL,
  `stara_cijena` float(7,2) NOT NULL,
  `akcija` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`ID_pro`, `Naziv_pro`, `Opis_pro`, `Cijena_kn`, `Kol_lager`, `Slika_pro`, `VK_pkat`, `stara_cijena`, `akcija`) VALUES
(41, 'Prvi', 'Lorem ipsum dolor sit amet ipsum dolor sit amet ipsum dolor sit amet ipsum dolor sit amet', 25.00, 30, 'images/41.jpg', 0, 0.00, 0),
(42, 'Drugi', 'Mate i Matilda, Mate i Matilda\r\nMate Matildu volio na brigu\r\nna brigu i na snigu \r\nkucici i zidu\r\nMate Matildu volio auf\r\n\r\nMate bija mali, Matilda jos i manja\r\nljubili se grlili se cijeli bozji dan\r\n', 49.99, 10, 'images/42.jpg', 0, 50.00, 1),
(43, 'Treci', 'jahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjjahaci konjja', 11.00, 17, 'images/43.jpg', 1, 0.00, 0),
(44, 'Cetvrti', 'Nemoj Sanja da se mijenjas\r\nda se stidis lazi \r\nnajlijepsa si kakva jesi \r\nne dozvoli da te iko kvari \r\nnajgori su Boziji cuvari\r\nne, ne, ne, ne \r\nNecu Sanja da ti pricam \r\none stare pjesme \r\nzajedno', 150.00, 3, 'images/44.jpg', 2, 0.00, 0),
(45, 'Peti', 'Tekstovi.net je galerija muziÄkih tekstova sa podruÄja Bosne i Hercegovine, Crne Gore, Hrvatske i Srbije.\r\n\r\nZa razliku od drugih se ne hvalimo ni da smo najveÄ‡i ni najbolji. NaÅ¡i posjetioci su na', 75.00, 20, 'images/45.jpg', 0, 0.00, 0),
(46, 'Sesti', 'Kurkuma je svijetlo naranÄasto-Å¾uti zaÄin koji juÅ¾noazijskom curryju daje tu osobitu boju i okus. The Washington Post piÅ¡e da taj zaÄin nije samo dodatak jelima nego se u tradicionalnoj biljnoj', 12.00, 15, 'images/46.jpg', 0, 0.00, 0),
(47, 'Sedmi', 'Kurkuma je svijetlo naranÄasto-Å¾uti zaÄin koji juÅ¾noazijskom curryju daje tu osobitu boju i okus. The Washington Post piÅ¡e da taj zaÄin nije samo dodatak jelima nego se u tradicionalnoj biljnoj', 11.00, 65, 'images/47.jpg', 0, 0.00, 0),
(48, 'Osmi', 'Kurkuma je svijetlo naranÄasto-Å¾uti zaÄin koji juÅ¾noazijskom curryju daje tu osobitu boju i okus. The Washington Post piÅ¡e da taj zaÄin nije samo dodatak jelima nego se u tradicionalnoj biljnoj', 22.00, 22, 'images/48.jpg', 0, 0.00, 0),
(49, 'Deveti', 'Kurkuma je svijetlo naranÄasto-Å¾uti zaÄin koji juÅ¾noazijskom curryju daje tu osobitu boju i okus. The Washington Post piÅ¡e da taj zaÄin nije samo dodatak jelima nego se u tradicionalnoj biljnoj', 150.00, 17, 'images/49.jpg', 0, 0.00, 0),
(50, 'Deseti', 'Kurkuma je svijetlo naranÄasto-Å¾uti zaÄin koji juÅ¾noazijskom curryju daje tu osobitu boju i okus. The Washington Post piÅ¡e da taj zaÄin nije samo dodatak jelima nego se u tradicionalnoj biljnoj', 24.00, 22, 'images/50.jpg', 0, 0.00, 0),
(51, 'Jedanaesti', 'Kurkuma je svijetlo naranÄasto-Å¾uti zaÄin koji juÅ¾noazijskom curryju daje tu osobitu boju i okus. The Washington Post piÅ¡e da taj zaÄin nije samo dodatak jelima nego se u tradicionalnoj biljnoj', 300.00, 2, 'images/51.jpg', 0, 0.00, 0),
(52, 'Dvanaesti', 'Kurkuma je svijetlo naranÄasto-Å¾uti zaÄin koji juÅ¾noazijskom curryju daje tu osobitu boju i okus. The Washington Post piÅ¡e da taj zaÄin nije samo dodatak jelima nego se u tradicionalnoj biljnoj', 8.00, 19, 'images/52.jpg', 0, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `ID_tema` int(3) UNSIGNED NOT NULL,
  `Naziv_teme` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Datum_teme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `VK_korisnik` int(6) UNSIGNED NOT NULL,
  `VK_fkat` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `ID_uloga` int(3) UNSIGNED NOT NULL,
  `Naziv_uloge` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`ID_uloga`, `Naziv_uloge`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija_forum`
--
ALTER TABLE `kategorija_forum`
  ADD PRIMARY KEY (`ID_fkat`);

--
-- Indexes for table `kategorija_proizvod`
--
ALTER TABLE `kategorija_proizvod`
  ADD PRIMARY KEY (`ID_pkat`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`ID_korisnik`);

--
-- Indexes for table `kosarica`
--
ALTER TABLE `kosarica`
  ADD PRIMARY KEY (`ID_kos`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`ID_nar`);

--
-- Indexes for table `novosti`
--
ALTER TABLE `novosti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odgovor`
--
ALTER TABLE `odgovor`
  ADD PRIMARY KEY (`ID_odg`);

--
-- Indexes for table `poduzece`
--
ALTER TABLE `poduzece`
  ADD PRIMARY KEY (`OIB`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`ID_pro`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`ID_tema`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`ID_uloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija_forum`
--
ALTER TABLE `kategorija_forum`
  MODIFY `ID_fkat` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `ID_korisnik` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kosarica`
--
ALTER TABLE `kosarica`
  MODIFY `ID_kos` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `ID_nar` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `novosti`
--
ALTER TABLE `novosti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `odgovor`
--
ALTER TABLE `odgovor`
  MODIFY `ID_odg` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `ID_pro` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `ID_tema` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `ID_uloga` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
