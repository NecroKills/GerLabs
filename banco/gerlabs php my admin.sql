-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Nov-2017 às 17:57
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gerlabs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `turnos_id` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hardwares`
--

CREATE TABLE `hardwares` (
  `id` int(11) NOT NULL,
  `placa_de_video_id` int(11) NOT NULL,
  `memoria_id` int(11) NOT NULL,
  `processador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `hardwares`
--

INSERT INTO `hardwares` (`id`, `placa_de_video_id`, `memoria_id`, `processador_id`) VALUES
(1, 1, 1, 1),
(2, 5, 2, 2),
(3, 4, 4, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios`
--

CREATE TABLE `laboratorios` (
  `id` int(11) NOT NULL,
  `hardwares_id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `situacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `laboratorios`
--

INSERT INTO `laboratorios` (`id`, `hardwares_id`, `nome`, `capacidade`, `situacao`) VALUES
(1, 1, 'Laboratorio 01', 30, 1),
(2, 2, 'Laboratorio 02', 35, 1),
(3, 3, 'Laboratorio 03', 40, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios_softwares`
--

CREATE TABLE `laboratorios_softwares` (
  `laboratorios_id` int(11) NOT NULL,
  `softwares_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `laboratorios_softwares`
--

INSERT INTO `laboratorios_softwares` (`laboratorios_id`, `softwares_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 7),
(1, 8),
(2, 1),
(2, 3),
(2, 4),
(2, 7),
(2, 8),
(2, 9),
(2, 13),
(2, 14),
(3, 1),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `memoria`
--

CREATE TABLE `memoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `memoria`
--

INSERT INTO `memoria` (`id`, `nome`) VALUES
(1, '4GB'),
(2, '8GB'),
(3, '12GB'),
(4, '16GB'),
(5, '32GB'),
(6, '64GB');

-- --------------------------------------------------------

--
-- Estrutura da tabela `placa_de_video`
--

CREATE TABLE `placa_de_video` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `placa_de_video`
--

INSERT INTO `placa_de_video` (`id`, `nome`) VALUES
(1, 'GTX 650TI 1GB'),
(2, 'GTX 1060TI 4GB'),
(3, 'GTX 1080TI 11GB'),
(4, 'GTX 1050TI 4GB'),
(5, 'GT 210 1GB'),
(6, 'RADEON HD 6570 2GB');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processador`
--

CREATE TABLE `processador` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `processador`
--

INSERT INTO `processador` (`id`, `nome`) VALUES
(1, 'I3'),
(2, 'i5'),
(3, 'i7'),
(6, 'i9');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `matricula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `matricula`) VALUES
(4, 'Nishi', '00004512'),
(5, 'Marcio', '00001123'),
(6, 'Marcelo', '00001112'),
(7, 'Rosana', '00001113'),
(8, 'Millys', '00001115'),
(9, 'Kleber', '00001118');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `professores_id` int(11) NOT NULL,
  `laboratorios_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(10) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `situacao` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`id`, `professores_id`, `laboratorios_id`, `usuarios_id`, `title`, `color`, `start`, `end`, `situacao`) VALUES
(1, 4, 1, 7, 'IHC - Eng. Computacao', '#0071c5', '2017-11-13 19:00:00', '2017-11-13 22:40:00', 1),
(2, 5, 1, 7, 'Calculo 2 - Eng. Computacao', '#0071c5', '2017-11-13 07:00:00', '2017-11-13 11:40:00', 1),
(3, 4, 2, 7, 'IHC - Eng. Computacao', '#0071c5', '2017-11-13 19:00:00', '2017-11-13 22:40:00', 1),
(4, 5, 1, 7, 'Calculo 2 - Eng. Computacao', '#0071c5', '2017-11-14 19:00:00', '2017-11-14 22:40:00', 1),
(5, 5, 2, 7, 'Fisica - Eng. Computacao', '#0071c5', '2017-11-17 19:00:00', '2017-11-17 22:00:00', 1),
(6, 8, 3, 7, 'Projeto - Eng. Computacao', '#0071c5', '2017-11-17 13:00:00', '2017-11-17 17:00:00', 1),
(7, 6, 3, 7, 'Computacao Grafica - Eng. Computacao', '#0071c5', '2017-11-18 19:00:00', '2017-11-18 22:40:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas_aulas`
--

CREATE TABLE `reservas_aulas` (
  `id` int(11) NOT NULL,
  `aulas_id` int(11) NOT NULL,
  `reservas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `softwares`
--

CREATE TABLE `softwares` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `versao` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `softwares`
--

INSERT INTO `softwares` (`id`, `nome`, `versao`, `tipo`) VALUES
(1, 'Windows 10', '1607', 0),
(3, 'Psiphon', '115', 1),
(4, 'NetBeans', '8.2', 1),
(5, 'PgAdmin', '4', 1),
(6, 'Baidu', 'v 1.0.1', 1),
(7, 'Git', '2.15.0', 1),
(8, 'Office', '2010', 1),
(9, 'Chrome', '14.0.4763', 1),
(10, 'NetBeans IDE', '8.0.2', 1),
(11, 'Team Viewer', '12', 1),
(12, 'Ubuntu', '17.10', 0),
(13, 'Adobe Photoshop', '1.0', 1),
(14, 'AutoCAD', '2018', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nivel` int(11) NOT NULL DEFAULT '1',
  `situacao` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`, `nivel`, `situacao`) VALUES
(7, 'admin', 'admin', 'admin', 'admin@admin.com', 2, 1),
(42, 'User', 'user', 'user', 'User@usuario.com', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_AULAS_TURNOS_ID` (`turnos_id`);

--
-- Indexes for table `hardwares`
--
ALTER TABLE `hardwares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_HARDWARES_PROCESSADOR_ID` (`processador_id`),
  ADD KEY `IX_HARDWARES_MEMORIA_ID` (`memoria_id`),
  ADD KEY `IX_HARDWARES_PLACA_DE_VIDEO_ID` (`placa_de_video_id`);

--
-- Indexes for table `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_LABORATORIOS_HARDWARES_ID` (`hardwares_id`);

--
-- Indexes for table `laboratorios_softwares`
--
ALTER TABLE `laboratorios_softwares`
  ADD PRIMARY KEY (`laboratorios_id`,`softwares_id`),
  ADD UNIQUE KEY `UQ_LABORATORIOS_SOFTWARES_LABORATORIOS_SOFTWARES_ID` (`laboratorios_id`,`softwares_id`),
  ADD KEY `IX_LABORATORIOS_SOFTWARES_LABORATORIOS_ID` (`laboratorios_id`),
  ADD KEY `IX_LABORATORIOS_SOFTWARES_SOFTWARES_ID` (`softwares_id`);

--
-- Indexes for table `memoria`
--
ALTER TABLE `memoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `placa_de_video`
--
ALTER TABLE `placa_de_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `processador`
--
ALTER TABLE `processador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_RESERVAS_USUARIOS_ID` (`usuarios_id`),
  ADD KEY `IX_RESERVAS_LABORATORIOS_ID` (`laboratorios_id`),
  ADD KEY `IX_RESERVAS_PROFESSORES_ID` (`professores_id`);

--
-- Indexes for table `reservas_aulas`
--
ALTER TABLE `reservas_aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_RESERVAS_AULAS_RESERVAS_ID` (`reservas_id`),
  ADD KEY `IX_RESERVAS_AULAS_AULAS_ID` (`aulas_id`);

--
-- Indexes for table `softwares`
--
ALTER TABLE `softwares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hardwares`
--
ALTER TABLE `hardwares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `memoria`
--
ALTER TABLE `memoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `placa_de_video`
--
ALTER TABLE `placa_de_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `processador`
--
ALTER TABLE `processador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reservas_aulas`
--
ALTER TABLE `reservas_aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `softwares`
--
ALTER TABLE `softwares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`turnos_id`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `hardwares`
--
ALTER TABLE `hardwares`
  ADD CONSTRAINT `hardwares_ibfk_1` FOREIGN KEY (`processador_id`) REFERENCES `processador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hardwares_ibfk_2` FOREIGN KEY (`memoria_id`) REFERENCES `memoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hardwares_ibfk_3` FOREIGN KEY (`placa_de_video_id`) REFERENCES `placa_de_video` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD CONSTRAINT `laboratorios_ibfk_1` FOREIGN KEY (`hardwares_id`) REFERENCES `hardwares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `laboratorios_softwares`
--
ALTER TABLE `laboratorios_softwares`
  ADD CONSTRAINT `laboratorios_softwares_ibfk_1` FOREIGN KEY (`laboratorios_id`) REFERENCES `laboratorios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `laboratorios_softwares_ibfk_2` FOREIGN KEY (`softwares_id`) REFERENCES `softwares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`laboratorios_id`) REFERENCES `laboratorios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`professores_id`) REFERENCES `professores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reservas_aulas`
--
ALTER TABLE `reservas_aulas`
  ADD CONSTRAINT `reservas_aulas_ibfk_1` FOREIGN KEY (`reservas_id`) REFERENCES `reservas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservas_aulas_ibfk_2` FOREIGN KEY (`aulas_id`) REFERENCES `aulas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
