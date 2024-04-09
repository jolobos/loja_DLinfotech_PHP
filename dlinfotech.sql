-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/04/2024 às 15:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dlinfotech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cartao_usuario`
--

CREATE TABLE `cartao_usuario` (
  `nome` varchar(120) NOT NULL,
  `numero` varchar(16) NOT NULL,
  `vencimento` date NOT NULL,
  `CCV` varchar(6) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cartao` int(11) NOT NULL,
  `data_entrada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cartao_usuario`
--

INSERT INTO `cartao_usuario` (`nome`, `numero`, `vencimento`, `CCV`, `id_usuario`, `id_cartao`, `data_entrada`) VALUES
('josias santos', '1234123412341234', '2030-04-30', '123', 6, 1, '2024-04-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `quantidade` double(10,2) NOT NULL,
  `categoria` varchar(120) NOT NULL,
  `cor` varchar(15) NOT NULL,
  `voltagem` varchar(10) NOT NULL,
  `voltagem_opcoes` varchar(10) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `status` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `foto_1` varchar(50) NOT NULL,
  `foto_2` varchar(50) NOT NULL,
  `foto_3` varchar(50) NOT NULL,
  `foto_4` varchar(50) NOT NULL,
  `foto_5` varchar(50) NOT NULL,
  `foto_6` varchar(50) NOT NULL,
  `azul` int(1) NOT NULL,
  `vermelho` int(1) NOT NULL,
  `preto` int(1) NOT NULL,
  `branco` int(1) NOT NULL,
  `amarelo` int(1) NOT NULL,
  `verde` int(1) NOT NULL,
  `laranja` int(1) NOT NULL,
  `cinza` int(1) NOT NULL,
  `rosa` int(1) NOT NULL,
  `marrom` int(1) NOT NULL,
  `roxo` int(1) NOT NULL,
  `prata` int(1) NOT NULL,
  `dourado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `valor`, `quantidade`, `categoria`, `cor`, `voltagem`, `voltagem_opcoes`, `descricao`, `status`, `foto`, `foto_1`, `foto_2`, `foto_3`, `foto_4`, `foto_5`, `foto_6`, `azul`, `vermelho`, `preto`, `branco`, `amarelo`, `verde`, `laranja`, `cinza`, `rosa`, `marrom`, `roxo`, `prata`, `dourado`) VALUES
(1, 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 220V', 529.00, 3.00, 'eletronicos', 'azul', '220', 'bi-volt', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 110V\n', 500.00, 5.00, 'eletronicos', 'azul', '110', 'bi-volt', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'Carregador Motorola TurboPower 20w - Tipo-C - bivolt', 99.99, 12.00, 'carregadores', 'preto', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto7.png', 'produto7_1.png', 'produto7_2.png', 'produto7_3.png', 'produto7_4.png', 'produto7_5.png', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Carregador KAIDI 2.4 Amperes - c/2 saidas USB mod. KD-301s - bivolt', 20.00, 45.00, 'carregadores', 'branco', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto8.png', 'produto8_1.png', 'produto8_2.png', 'produto8_3.png', 'produto8_4.png', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Carregador para Iphone simples 2.4 Amperes - bivolt', 17.50, 20.00, 'carregadores', 'branco', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto9.png', 'produto9_1.png', 'produto9_2.png', '', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `CPF`, `telefone`, `celular`, `CEP`, `UF`, `cidade`, `bairro`, `logradouro`, `complemento`, `email`, `senha`, `foto`, `apelido`, `data_entrada`, `status`) VALUES
(6, 'nome teste ', 2351055039, 51985078897, 51985078897, 94945330, 'RS', 'kaxuxa', 'vista', 'logo ali', 'casa', 'email.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '8c34c4ee0b0ce8ba859f0a6ac21be992.jpg', 'digo', '2024-04-01 10:56:47', 0),
(7, 'seliria santos de azevedo', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'ail.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:32:57', 1),
(8, 'Asus_m1', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'il.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:45:34', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id_notificacoes`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
