-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2017 at 10:50 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--Database: 'henkilot'
--


create database henkilot;
use henkilot;

create table henkilo (
id int(11) null,
etunimi varchar(50) not null,
sukunimi varchar(50) not null,
syntymaaika varchar(25) allow null,
sahkoposti varchar (150) allow null,
ammatti varchar(50) not null,
harrastukset varchar(500) not null,
sukupuoli varchar (20) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--Lisätään dataa tietokantaan
INSERT INTO `henkilo`(`id`, `etunimi`, `sukunimi`, `syntymaaika`, `sahkoposti`, `ammatti`, `harrastukset`, `sukupuoli`)
 VALUES ('1','James','Bond','08.06.1985','james.bond@mi6.com','salainen agentti','lupaa tappaa, mutta ei rikkoa lakia','Mies');

INSERT INTO `henkilo`(`id`, `etunimi`, `sukunimi`, `syntymaaika`, `sahkoposti`, `ammatti`, `harrastukset`, `sukupuoli`)
 VALUES ('2','satar','Bond','07.09.1992
','satar.qaderi@palvelin.com','Opiskellija','Ohjelmointi','Mies');

INSERT INTO `henkilo`(`id`, `etunimi`, `sukunimi`, `syntymaaika`, `sahkoposti`, `ammatti`, `harrastukset`, `sukupuoli`)
 VALUES ('3','Liisa','meikäläinen','08.06.1965
','liisa.meikalainen@mi6.com','asiakaspalvelija','lenkeily','Nainen');



ALTER TABLE `henkilo`
    ADD PRIMARY KEY (`id`)



ALTER TABLE `henkilo`
    MODIFY `id` int (10) null AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;