-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Abr-2024 às 04:19
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dlinfotech`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_usuario`
--

CREATE TABLE `cartao_usuario` (
  `nome` varchar(120) NOT NULL,
  `numero` varchar(16) NOT NULL,
  `vencimento` date NOT NULL,
  `CCV` varchar(6) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cartao` int(11) NOT NULL,
  `data_entrada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cartao_usuario`
--

INSERT INTO `cartao_usuario` (`nome`, `numero`, `vencimento`, `CCV`, `id_usuario`, `id_cartao`, `data_entrada`) VALUES
('josias santos', '1234123412341234', '2030-04-30', '123', 6, 1, '2024-04-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id_notificacoes` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `conteudo` varchar(250) NOT NULL,
  `link_1` int(120) NOT NULL,
  `link_2` int(120) NOT NULL,
  `link_3` int(120) NOT NULL,
  `link_4` int(120) NOT NULL,
  `link_5` int(120) NOT NULL,
  `condicao` int(1) NOT NULL,
  `data_envio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `quantidade` double(10,2) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `status` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `CPF` bigint(14) NOT NULL,
  `telefone` bigint(14) NOT NULL,
  `celular` bigint(14) NOT NULL,
  `CEP` int(8) NOT NULL,
  `UF` varchar(30) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `logradouro` varchar(120) NOT NULL,
  `complemento` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `apelido` varchar(100) NOT NULL,
  `data_entrada` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `CPF`, `telefone`, `celular`, `CEP`, `UF`, `cidade`, `bairro`, `logradouro`, `complemento`, `email`, `senha`, `foto`, `apelido`, `data_entrada`, `status`) VALUES
(6, 'nome teste ', 2351055039, 51985078897, 51985078897, 94945330, 'RS', 'kaxuxa', 'vista', 'logo ali', 'casa', 'email.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '85db0f27f3e9f6f7cd936e6de5c026e9.jpg', 'digo', '2024-04-01 10:56:47', 0),
(7, 'seliria santos de azevedo', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'ail.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:32:57', 1),
(8, 'Asus_m1', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'il.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:45:34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id_notificacoes`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
