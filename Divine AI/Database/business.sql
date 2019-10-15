-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2019 at 10:55 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `business`
--

-- --------------------------------------------------------

--
-- Table structure for table `plata_status`
--

CREATE TABLE `plata_status` (
  `id_plata` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plata_status`
--

INSERT INTO `plata_status` (`id_plata`, `status`) VALUES
(1, 'Isplacena'),
(2, 'neisplacena');

-- --------------------------------------------------------

--
-- Table structure for table `radnik`
--

CREATE TABLE `radnik` (
  `id_radnik` int(11) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `datum_zaposlenja` date NOT NULL,
  `telefon` int(11) NOT NULL,
  `slika` varchar(120) DEFAULT NULL,
  `plata` int(7) NOT NULL,
  `id_rola` int(11) NOT NULL,
  `radno_mesto` int(11) NOT NULL,
  `id_plata` int(11) NOT NULL,
  `poslednja_plata` date NOT NULL,
  `sledeca_plata` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `radnik`
--

INSERT INTO `radnik` (`id_radnik`, `ime`, `prezime`, `email`, `lozinka`, `datum_rodjenja`, `datum_zaposlenja`, `telefon`, `slika`, `plata`, `id_rola`, `radno_mesto`, `id_plata`, `poslednja_plata`, `sledeca_plata`) VALUES
(1, 'Marko', 'Maricic', 'marko@gmail.com', 'marko', '1999-04-15', '2019-10-16', 381773332, '../../GUI/imgprofile/iconfinder_boy_4030241570538613.png', 50000, 5, 7, 2, '2019-01-14', '2019-06-02'),
(20, 'Andjela', 'Todorovic', 'andjelatodorovich@gmail.com', 'andjela1', '1998-11-22', '2019-10-08', 2147483647, '../../GUI/imgprofile/iconfinder_female1_4030231570532779.png', 100000, 5, 8, 2, '2018-10-02', '2019-07-01'),
(23, 'Petar', 'Peric', 'petar@gmail.com', 'petar', '1997-11-21', '2019-10-08', 2147483647, '../../GUI/imgprofile/iconfinder_boy_4030241570538613.png', 70000, 6, 2, 1, '2019-10-13', '2019-11-12'),
(24, 'Anja', 'Todorovic', 'anja@gmail.com', 'anja', '2006-12-16', '2019-10-08', 2147483647, '../../GUI/imgprofile/iconfinder_girl_4030211570538735.png', 70000, 6, 7, 1, '2019-10-09', '2019-11-08'),
(25, 'Nikola', 'Nikolic', 'nikola@gmail.com', 'nikola', '1997-12-12', '2019-10-08', 381373737, '../../GUI/imgprofile/iconfinder_supportmale_4030201570538832.png', 60000, 5, 1, 2, '2019-02-12', '2019-06-03'),
(27, 'Stefan', 'Stojanovic', 'stefan@gmail.com', 'stefan', '1991-11-11', '2019-10-08', 2147483647, '../../GUI/imgprofile/iconfinder_matureman1_6282841570539496.png', 100000, 5, 3, 1, '2019-10-08', '2019-11-07'),
(28, 'Jovan', 'Jovanovic', 'jovan@gmail.com', 'jovan', '1991-11-01', '2019-10-08', 2147483647, '../../GUI/imgprofile/iconfinder_male3_4030191570540184.png', 120000, 6, 4, 1, '2019-10-08', '2019-11-07'),
(29, 'Petra', 'Krstic', 'petra@gmail.com', 'petra', '2006-06-12', '2019-10-08', 2147483647, '../../GUI/imgprofile/iconfinder_supportfemale_4030181570563976.png', 100000, 6, 4, 1, '2019-10-08', '2019-11-07'),
(30, 'Administrator', ' â €â €â €â €â €â €â €â €â €', 'admin@gmail.com', 'admin', '1990-10-10', '2019-10-11', 38172727, '../../GUI/imgprofile/iconfinder_malecostume_4030221570802682.png', 70000, 5, 1, 1, '2019-10-11', '2019-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `radno_mesto`
--

CREATE TABLE `radno_mesto` (
  `id_radno_mesto` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `opis` varchar(500) NOT NULL,
  `kreirano` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `radno_mesto`
--

INSERT INTO `radno_mesto` (`id_radno_mesto`, `naziv`, `opis`, `kreirano`) VALUES
(1, 'Administrator', 'Zaduzen za odrzavanje funkcionalnosti sajta', '2018-06-19 20:14:07'),
(2, 'Product Owner', 'Zaduzen za menadzment SCRUM tima', '2018-06-19 20:14:07'),
(3, 'General Manager', 'Vodi kompletan tim inzinjera', '2019-09-29 19:44:03'),
(4, 'Frontend developer', 'Razvija web aplikacije na frontendu . Zahteva se temeljno poznavanje JavaScripta, dizajn paterna i nekog JS frameworka.', '2019-09-29 19:43:04'),
(6, '.NET developer', 'Radi na razvoju ASP .NET MVC aplikacija. Zahteva se poznavanje C# programskog jezika, Entity Frameworka i Linq upita', '2018-05-18 10:20:07'),
(7, 'QA Engineer', 'Zaduzen za testiranje i obezbedjivanje kvaliteta kompletnog softvera', '2018-07-19 20:22:07'),
(8, 'Data Scientist', 'Obradjuje prikupljene podatke i pomocu modela masinskog ucenja dolazi do zakljucaka o informacijama', '2018-07-19 20:22:07'),
(9, 'PHP developer', 'Radi na razvoju aplikacija koristeci PHP frejmvorke, npr. Laravel ili CodeIgniter', '2019-10-11 15:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `rola`
--

CREATE TABLE `rola` (
  `id_rola` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rola`
--

INSERT INTO `rola` (`id_rola`, `naziv`) VALUES
(5, 'Admin'),
(6, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `taskovi`
--

CREATE TABLE `taskovi` (
  `id_task` int(11) NOT NULL,
  `id_radno_mesto` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `opis` text NOT NULL,
  `naziv_radnog_mesta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taskovi`
--

INSERT INTO `taskovi` (`id_task`, `id_radno_mesto`, `naziv`, `opis`, `naziv_radnog_mesta`) VALUES
(1, 1, 'Edituj korisnike', 'Ukloni profile neaktivnih radnika i radnih mesta za koje ne postoje otvorene pozicije', 'Administrator'),
(2, 1, 'Dodaj nove pozicije za posao', 'Dodaje nova radna mesta - i to za iOS i Android developera pojedinacno', 'Administrator'),
(3, 8, 'Predprocesiranje nad podacima', 'Dobro ocistiti i pripremiti dataset za buducu upotrebu.', 'Data Scientist'),
(4, 8, 'Odabir modela', 'Na osnovu seta podataka dobro proceniti koji bi model bio apsolutno prigodan za dalje koriscenje.', 'Data Scientist'),
(5, 2, 'Sastanak sa generalnim menadzerom', 'Diskutovati o procesu zaposljavanja novih radnika za Android i iOS tim. Planirati detaljnu strategiju za narednu nedelju.', 'Product Owner'),
(6, 7, 'Testiraj prvu fazu aplikacije', 'Manuelnim testiranjem proveri da li postoji do sada neispitan use case.', 'QA Engineer'),
(7, 4, 'Prodiskutuj izgled aplikacije', 'Nacrtaj plan i okvirno implementiraj sablonski izgled aplikacije, polozaj tabela, dugmica, teksta itd', 'Frontend developer'),
(8, 9, 'Prodiskutuj funkcionalnosti', 'Osmisli plan i okvirno implementiraj sablonske funkcionalnosti aplikacije, polozaj tabela, dugmica, teksta itd', 'PHP developer'),
(9, 2, 'Sastanak sa vodjom Data Science tima', 'Diskutovati o postojecim resenjima vezanim za samu implementaciju modela.', 'Product Owner'),
(10, 8, 'Sastanak sa Product Ownerom', 'Predlozi osmisljene modele i prodiskutuj ocekivano ponasanje i preciznost svakog od njih.', 'Data Scientist'),
(11, 3, 'Sastanak sa klijentom iz Delte', 'Izvrsi potrebne pregovore vezane za use case koji ce se resavati, celokupan plan partnerstva i zaradu.', 'General Manager'),
(12, 7, 'Testiranje Frontend dela', 'Ispitaj neke od neocekivanih ponasanja prilikom koriscenja ekrana razlicitih rezolucija.', 'QA Engineer'),
(13, 4, 'Sastanak sa vodjom QA tima', 'Prodiskutujte o potencijalnim bagovima i slabostima u sigurnosti aplikacije', 'Frontend developer'),
(14, 1, 'Zatvori neaktivne oglase', 'Ukoliko se niko nije javio na oglas o datoj poziciji, potpuno izbrisi zastareo oglas', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id_token`, `email`, `token`, `status`) VALUES
(9, 'petar@gmail.com', '2041727479', 1),
(10, 'petar@gmail.com', '666887900', 1),
(11, 'andjelatodorovich@gmail.com', '226869959', 1),
(12, 'andjelatodorovich@gmail.com', '927126276', 1),
(13, 'andjelatodorovich@gmail.com', '1829293050', 1),
(14, 'andjelatodorovich@gmail.com', '179292169', 1),
(15, 'andjelatodorovich@gmail.com', '1745071957', 1),
(16, 'andjelatodorovich@gmail.com', '1249846608', 0),
(17, 'andjelatodorovich@gmail.com', '119600756', 1),
(18, 'andjelatodorovich@gmail.com', '2125679609', 0),
(19, 'andjelatodorovich@gmail.com', '2011463540', 0),
(20, 'andjelatodorovich@gmail.com', '853001756', 0),
(21, 'andjelatodorovich@gmail.com', '2000044637', 0),
(22, 'nikola@gmail.com', '915017264', 1),
(23, 'andjelatodorovich@gmail.com', '334806802', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plata_status`
--
ALTER TABLE `plata_status`
  ADD PRIMARY KEY (`id_plata`);

--
-- Indexes for table `radnik`
--
ALTER TABLE `radnik`
  ADD PRIMARY KEY (`id_radnik`),
  ADD KEY `radno_mesto` (`radno_mesto`),
  ADD KEY `id_rola` (`id_rola`),
  ADD KEY `id_plata` (`id_plata`);

--
-- Indexes for table `radno_mesto`
--
ALTER TABLE `radno_mesto`
  ADD PRIMARY KEY (`id_radno_mesto`);

--
-- Indexes for table `rola`
--
ALTER TABLE `rola`
  ADD PRIMARY KEY (`id_rola`);

--
-- Indexes for table `taskovi`
--
ALTER TABLE `taskovi`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `radnomesto` (`id_radno_mesto`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plata_status`
--
ALTER TABLE `plata_status`
  MODIFY `id_plata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `radnik`
--
ALTER TABLE `radnik`
  MODIFY `id_radnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `radno_mesto`
--
ALTER TABLE `radno_mesto`
  MODIFY `id_radno_mesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rola`
--
ALTER TABLE `rola`
  MODIFY `id_rola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taskovi`
--
ALTER TABLE `taskovi`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `radnik`
--
ALTER TABLE `radnik`
  ADD CONSTRAINT `id_plata` FOREIGN KEY (`id_plata`) REFERENCES `plata_status` (`id_plata`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_rola` FOREIGN KEY (`id_rola`) REFERENCES `rola` (`id_rola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `radno_mesto` FOREIGN KEY (`radno_mesto`) REFERENCES `radno_mesto` (`id_radno_mesto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taskovi`
--
ALTER TABLE `taskovi`
  ADD CONSTRAINT `radnomesto` FOREIGN KEY (`id_radno_mesto`) REFERENCES `radno_mesto` (`id_radno_mesto`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
