-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 22, 2020 at 07:55 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `DB_Univer_Prodesat`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cat_Alumnos`
--

CREATE TABLE `Cat_Alumnos` (
  `iCodigoAlumno` int(10) UNSIGNED NOT NULL,
  `vchNombres` varchar(50) NOT NULL,
  `vchApellidos` varchar(50) NOT NULL,
  `dtFechaNac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cat_Alumnos`
--

INSERT INTO `Cat_Alumnos` (`iCodigoAlumno`, `vchNombres`, `vchApellidos`, `dtFechaNac`) VALUES
(8, 'Carlos', 'Ramos', '2020-06-12'),
(9, 'Cesar', 'Ramos', '2020-06-05'),
(10, 'Cesar', 'Ramos', '2020-06-05'),
(11, 'Cesar', 'Ramos', '2020-06-05'),
(12, 'Cesar', 'Ramos', '2020-06-05'),
(14, 'Cesar', 'Ramos', '2020-06-10'),
(15, 'Cesar', 'Ramos', '2020-06-10'),
(16, 'Cesar', 'Ramos', '2020-06-02'),
(17, 'Cesar', 'Ramos', '2020-06-10'),
(18, 'Cesar', 'Ramos', '2020-06-05'),
(19, 'Cesar', 'Ramos', '2020-06-04'),
(20, 'Cesar', 'Ramos', '2020-06-04'),
(22, 'mOHAMED', 'aLI', '2020-06-10'),
(23, 'Cesar', 'Ramos', '2020-06-10'),
(24, 'Cesar', 'Ramos', '2020-06-02'),
(25, 'Cesar', 'Ramos', '2020-06-10'),
(26, 'Cesar', 'Arellano', '2020-06-02'),
(27, 'Mauricio', 'Robledo', '2020-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `Cat_Materias`
--

CREATE TABLE `Cat_Materias` (
  `vchCodigoMateria` int(5) NOT NULL,
  `vchMateria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cat_Materias`
--

INSERT INTO `Cat_Materias` (`vchCodigoMateria`, `vchMateria`) VALUES
(11616, 'jiji'),
(11617, 'Ingles 3');

-- --------------------------------------------------------

--
-- Table structure for table `Cat_rel_Alumno_Materia`
--

CREATE TABLE `Cat_rel_Alumno_Materia` (
  `iCodigoAlumno` int(11) NOT NULL,
  `vchCodigoMateria` varchar(5) NOT NULL,
  `fCalificacion` decimal(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cat_Alumnos`
--
ALTER TABLE `Cat_Alumnos`
  ADD PRIMARY KEY (`iCodigoAlumno`);

--
-- Indexes for table `Cat_Materias`
--
ALTER TABLE `Cat_Materias`
  ADD PRIMARY KEY (`vchCodigoMateria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cat_Alumnos`
--
ALTER TABLE `Cat_Alumnos`
  MODIFY `iCodigoAlumno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `Cat_Materias`
--
ALTER TABLE `Cat_Materias`
  MODIFY `vchCodigoMateria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11618;
