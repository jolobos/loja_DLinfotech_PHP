-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Abr-2024 às 05:20
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
-- Estrutura da tabela `ficha_tec_produto`
--

CREATE TABLE `ficha_tec_produto` (
  `id_ficha_tec` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `altura` varchar(15) NOT NULL,
  `largura` varchar(15) NOT NULL,
  `peso` varchar(20) NOT NULL,
  `potencia` varchar(20) NOT NULL,
  `fabricante` varchar(35) NOT NULL,
  `garantia` varchar(20) NOT NULL,
  `voltagem` varchar(15) NOT NULL,
  `temperatura_max` varchar(25) NOT NULL,
  `temperatura_min` varchar(25) NOT NULL,
  `capacidade_armazenamento` varchar(25) NOT NULL,
  `durabilidade` varchar(25) NOT NULL,
  `tempo_recarga` varchar(25) NOT NULL,
  `marca` varchar(35) NOT NULL,
  `modelo` varchar(25) NOT NULL,
  `descricao_longa` varchar(1000) NOT NULL,
  `prova_agua` int(1) NOT NULL,
  `resistente_agua` int(1) NOT NULL,
  `velocidade` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ficha_tec_produto`
--

INSERT INTO `ficha_tec_produto` (`id_ficha_tec`, `id_produto`, `tamanho`, `altura`, `largura`, `peso`, `potencia`, `fabricante`, `garantia`, `voltagem`, `temperatura_max`, `temperatura_min`, `capacidade_armazenamento`, `durabilidade`, `tempo_recarga`, `marca`, `modelo`, `descricao_longa`, `prova_agua`, `resistente_agua`, `velocidade`) VALUES
(1, 1, '-----', '20cm', '30cm', '1,05kg', '600w', 'yaxun', '1 ano', '220', '450 °c', '100°c', '---', '---', '---', 'yaxun', '886D', 'Lorem ipsum dolor sit amet. Eum esse quia aut voluptas illum est voluptatem harum non dolorem quia in rerum maiores eum ipsum incidunt aut Quis fugiat. Non iure asperiores qui suscipit illo aut dolores iure eum fuga amet ut voluptatem tempore sit perspiciatis vero. Ab illo fuga ut tenetur sequi et aperiam temporibus qui omnis omnis in voluptas quae sed fuga molestiae sed asperiores architecto. Aut quasi molestiae est laudantium vero est doloremque accusantium qui quasi sequi At molestias autem aut labore laborum. </p><p>Ex ullam dignissimos sed quidem corrupti aut internos quae vel pariatur adipisci eum explicabo voluptatem. Ut iusto debitis ut placeat quae id architecto voluptas ut optio possimus. </p><p>Ea fuga nisi ex dolore rerum sed velit obcaecati ut galisum magni id illo praesentium. Sit earum similique non exercitationem eveniet ea dolorem porro et delectus voluptas. Qui veniam temporibus et error porro et esse similique nam asperiores ullam et atque dolor qui harum fugit. S', 0, 0, '25 s aquecimento');

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
  `cod_produto` varchar(40) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `cod_produto`, `nome`, `valor`, `quantidade`, `categoria`, `cor`, `voltagem`, `voltagem_opcoes`, `descricao`, `status`, `foto`, `foto_1`, `foto_2`, `foto_3`, `foto_4`, `foto_5`, `foto_6`, `azul`, `vermelho`, `preto`, `branco`, `amarelo`, `verde`, `laranja`, `cinza`, `rosa`, `marrom`, `roxo`, `prata`, `dourado`) VALUES
(1, '', 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 220V', 529.00, 3.00, 'eletronicos', 'azul', '220', 'bi-volt', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.ÂÂÂ', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '', 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 110V\n', 500.00, 5.00, 'eletronicos', 'azul', '110', 'bi-volt', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '', 'Carregador Motorola TurboPower 20w - Tipo-C - bivolt', 99.99, 12.00, 'carregadores', 'preto', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto7.png', 'produto7_1.png', 'produto7_2.png', 'produto7_3.png', 'produto7_4.png', 'produto7_5.png', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '', 'Carregador KAIDI 2.4 Amperes - c/2 saidas USB mod. KD-301s - bivolt', 20.00, 45.00, 'carregadores', 'branco', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto8.png', 'produto8_1.png', 'produto8_2.png', 'produto8_3.png', 'produto8_4.png', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '', 'Carregador para Iphone simples 2.4 Amperes - bivolt', 17.50, 20.00, 'carregadores', 'branco', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto9.png', 'produto9_1.png', 'produto9_2.png', '', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `celular` varchar(14) NOT NULL,
  `CEP` varchar(9) NOT NULL,
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
(6, 'nome teste ', '02351055039', '51985078897', '51985078897', '94945330', 'RS', 'kaxuxa', 'vista', 'logo ali', 'casa', 'email.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '8c34c4ee0b0ce8ba859f0a6ac21be992.jpg', 'digÃ£o', '2024-04-01 10:56:47', 0),
(7, 'seliria santos de azevedo', '0', '51985078897', '51985078897', '0', '', '', '', '', '', 'ail.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:32:57', 1),
(8, 'Asus_m1', '0', '51985078897', '51985078897', '0', '', '', '', '', '', 'il.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:45:34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ficha_tec_produto`
--
ALTER TABLE `ficha_tec_produto`
  ADD PRIMARY KEY (`id_ficha_tec`);

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
-- AUTO_INCREMENT for table `ficha_tec_produto`
--
ALTER TABLE `ficha_tec_produto`
  MODIFY `id_ficha_tec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
