-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Tempo de geração: 10/06/2025 às 16:29
-- Versão do servidor: 10.4.21-MariaDB
-- Versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- banco de dados: `bd_aquario`

CREATE DATABASE IF NOT EXISTS `bd_aquario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bd_aquario`;

-- --------------------------------------------------------

-- tabela `tb_funcionarios`

CREATE TABLE `tb_funcionarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, -- Tamanho aumentado para senhas (hashed)
  `matricula` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE, -- Alterado para VARCHAR para matrículas como '001' e maior flexibilidade
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- dados tabela `tb_funcionarios`
--
INSERT INTO `tb_funcionarios` (`id`, `usuario`, `senha`, `matricula`, `email`) VALUES
(1, 'Vinicius', 'vinicius123', '001', 'vinicius@aquario.com'),
(2, 'Jonas', 'jonas123', '002', 'jonas@aquario.com'),
(3, 'Clara', 'clara123', '003', 'clara@aquario.com');

-- --------------------------------------------------------

-- tabela `tb_peixes`

CREATE TABLE `tb_peixes` (
  `id_peixe` int(11) NOT NULL,
  `nome_comum` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_cientifico` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especie` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `habitat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_chegada` DATE NOT NULL,
  `responsavel_cadastro` int(11) NOT NULL -- Chave estrangeira para tb_funcionarios
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- dados tabela `tb_peixes`

INSERT INTO `tb_peixes` (`id_peixe`, `nome_comum`, `nome_cientifico`, `especie`, `habitat`, `data_chegada`, `responsavel_cadastro`) VALUES
(1, 'Palhaço', 'Amphiprioninae', 'Marinho', 'Recife de Coral', '2025-01-15', 1),
(2, 'Neon', 'Paracheirodon innesi', 'Água Doce', 'Rios amazônicos', '2025-02-20', 2),
(3, 'Tubarão Bamboo', 'Chiloscyllium punctatum', 'Marinho', 'Águas costeiras indo-pacíficas', '2025-03-10', 1);


-- indices tabela `tb_funcionarios`

ALTER TABLE `tb_funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`);


-- indices tabela `tb_peixes`

ALTER TABLE `tb_peixes`
  ADD PRIMARY KEY (`id_peixe`),
  ADD KEY `responsavel_cadastro` (`responsavel_cadastro`);


-- AUTO_INCREMENT de tabela `tb_funcionarios`

ALTER TABLE `tb_funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT de tabela `tb_peixes`

ALTER TABLE `tb_peixes`
  MODIFY `id_peixe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- restrição `tb_peixes`

ALTER TABLE `tb_peixes`
  ADD CONSTRAINT `fk_responsavel_cadastro` FOREIGN KEY (`responsavel_cadastro`) REFERENCES `tb_funcionarios` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```
