SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `crud_app`
--
CREATE DATABASE IF NOT EXISTS `crud_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `crud_app`;

--
-- Tabel: `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(100) NOT NULL,
  `beschrijving` text NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `aantal` int(11) NOT NULL,
  `aangemaakt_op` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Testgegevens
--

INSERT INTO `items` (`naam`, `beschrijving`, `categorie`, `aantal`) VALUES
('Laptop', 'Lenovo ThinkPad', 'Elektronica', 5),
('Bureaustoel', 'Ergonomische stoel', 'Meubilair', 10),
('Monitor', '24 inch Full HD', 'Elektronica', 8);
