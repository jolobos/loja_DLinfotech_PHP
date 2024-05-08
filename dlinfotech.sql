-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/05/2024 às 18:46
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
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `total` double(10,2) NOT NULL,
  `autorizado` int(1) NOT NULL,
  `entregue` int(1) NOT NULL,
  `pagamento` varchar(30) NOT NULL,
  `parcelas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `compras`
--

INSERT INTO `compras` (`id_compra`, `id_usuario`, `id_endereco`, `data`, `total`, `autorizado`, `entregue`, `pagamento`, `parcelas`) VALUES
(14, 6, 1, '2024-04-23 14:31:35', 1.00, 0, 0, 'PIX', 1),
(16, 6, 1, '2024-04-25 14:11:51', 287.48, 0, 0, 'PIX', 1),
(17, 6, 1, '2024-04-25 14:12:53', 287.48, 0, 0, 'PIX', 1),
(18, 6, 1, '2024-04-25 14:13:21', 287.48, 1, 0, 'PIX', 1),
(19, 6, 1, '2024-04-25 14:14:13', 529.00, 1, 0, 'PIX', 1),
(20, 6, 1, '2024-04-25 14:14:37', 529.00, 1, 1, 'PIX', 1),
(21, 6, 1, '2024-04-25 14:14:48', 529.00, 0, 0, 'PIX', 1),
(22, 6, 1, '2024-04-28 18:16:21', 20.00, 0, 0, 'PIX', 1),
(29, 6, 1, '2024-04-30 13:35:01', 20.00, 0, 0, 'BOLETO', 1),
(30, 6, 1, '2024-05-01 14:45:54', 17.50, 0, 0, 'BOLETO', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco_usuario`
--

CREATE TABLE `endereco_usuario` (
  `id_endereco` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `logradouro` varchar(120) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `cidade` varchar(60) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `numero` int(6) NOT NULL,
  `complemento` varchar(60) NOT NULL,
  `ponto_referencia` varchar(100) NOT NULL,
  `retirada_com` varchar(100) NOT NULL,
  `telefone_entrega` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `endereco_usuario`
--

INSERT INTO `endereco_usuario` (`id_endereco`, `id_usuario`, `CEP`, `logradouro`, `bairro`, `cidade`, `UF`, `numero`, `complemento`, `ponto_referencia`, `retirada_com`, `telefone_entrega`) VALUES
(1, 6, '94945-330', 'so testando', 'Vista Alegre', 'Cachoeirinha', 'RS', 12, 'casa', 'igreja dos macumba', 'parangole', '(51) 98507-889'),
(6, 6, '94945-330', 'rua do mane', 'logo ali', 'Cachoeirinha', 'RS', 21, 'beco', 'arvore mijada', 'rolifilty', '(51) 98507-889');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_tec_produto`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `ficha_tec_produto`
--

INSERT INTO `ficha_tec_produto` (`id_ficha_tec`, `id_produto`, `tamanho`, `altura`, `largura`, `peso`, `potencia`, `fabricante`, `garantia`, `voltagem`, `temperatura_max`, `temperatura_min`, `capacidade_armazenamento`, `durabilidade`, `tempo_recarga`, `marca`, `modelo`, `descricao_longa`, `prova_agua`, `resistente_agua`, `velocidade`) VALUES
(0, 13, '2 metros', '2 metros', '', '250 gm', '', 'PIX', '3 meses', 'bivolt', '', '', '', '', '', 'pix', '4k-ultra', 'if(isset($_FILES[\'arquivo1\'])){\r\n    $extensao1 = strtolower(substr($_FILES[\'arquivo1\'][\'name\'], -4)); //pega a extensao do arquivo\r\n    if($extensao1 == \'.png\' || $extensao1 == \'.jpg\' || $extensao1 == \'.svg\' || $extensao1 == \'.gif\'){\r\n    $novo_nome1 = md5(microtime()) . $extensao1; //define o nome do arquivo\r\n    $diretorio1 = \"../../img/produtos/\"; //define o diretorio para onde enviaremos o arquivo\r\n    move_uploaded_file($_FILES[\'arquivo1\'][\'tmp_name\'], $diretorio1.$novo_nome1); //efetua o upload\r\n    $foto_1 = $novo_nome1;\r\n}else{$foto_1 = \'\'; }}if(isset($_FILES[\'arquivo1\'])){\r\n    $extensao1 = strtolower(substr($_FILES[\'arquivo1\'][\'name\'], -4)); //pega a extensao do arquivo\r\n    if($extensao1 == \'.png\' || $extensao1 == \'.jpg\' || $extensao1 == \'.svg\' || $extensao1 == \'.gif\'){\r\n    $novo_nome1 = md5(microtime()) . $extensao1; //define o nome do arquivo\r\n    $diretorio1 = \"../../img/produtos/\"; //define o diretorio para onde enviaremos o arquivo\r\n    move_uploaded_file($_FILES[\'arq', 0, 0, '18gbps'),
(1, 1, '-----', '20cm', '30cm', '1,05kg', '600w', 'yaxun', '1 ano', '220', '450 °c', '100°c', '---', '---', '---', 'yaxun', '886D', 'Lorem ipsum dolor sit amet. Eum esse quia aut voluptas illum est voluptatem harum non dolorem quia in rerum maiores eum ipsum incidunt aut Quis fugiat. Non iure asperiores qui suscipit illo aut dolores iure eum fuga amet ut voluptatem tempore sit perspiciatis vero. Ab illo fuga ut tenetur sequi et aperiam temporibus qui omnis omnis in voluptas quae sed fuga molestiae sed asperiores architecto. Aut quasi molestiae est laudantium vero est doloremque accusantium qui quasi sequi At molestias autem aut labore laborum. </p><p>Ex ullam dignissimos sed quidem corrupti aut internos quae vel pariatur adipisci eum explicabo voluptatem. Ut iusto debitis ut placeat quae id architecto voluptas ut optio possimus. </p><p>Ea fuga nisi ex dolore rerum sed velit obcaecati ut galisum magni id illo praesentium. Sit earum similique non exercitationem eveniet ea dolorem porro et delectus voluptas. Qui veniam temporibus et error porro et esse similique nam asperiores ullam et atque dolor qui harum fugit. S', 0, 0, '25 s aquecimento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_da_compra`
--

CREATE TABLE `itens_da_compra` (
  `id_item_compra` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` double(10,2) NOT NULL,
  `data_item` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `itens_da_compra`
--

INSERT INTO `itens_da_compra` (`id_item_compra`, `id_compra`, `id_produto`, `quantidade`, `data_item`) VALUES
(2, 14, 13, 10.00, '2024-04-23 14:31:35'),
(6, 16, 3, 2.00, '2024-04-25 14:11:51'),
(7, 16, 5, 5.00, '2024-04-25 14:11:51'),
(8, 17, 3, 2.00, '2024-04-25 14:12:53'),
(9, 17, 5, 5.00, '2024-04-25 14:12:53'),
(10, 18, 3, 2.00, '2024-04-25 14:13:21'),
(11, 18, 5, 5.00, '2024-04-25 14:13:21'),
(12, 19, 1, 1.00, '2024-04-25 14:14:13'),
(13, 20, 1, 1.00, '2024-04-25 14:14:37'),
(14, 21, 1, 1.00, '2024-04-25 14:14:48'),
(15, 22, 4, 1.00, '2024-04-28 18:16:21'),
(16, 23, 4, 1.00, '2024-04-28 18:18:06'),
(17, 24, 4, 1.00, '2024-04-28 18:18:18'),
(18, 25, 4, 1.00, '2024-04-28 18:18:39'),
(19, 26, 4, 1.00, '2024-04-28 18:21:52'),
(20, 27, 4, 1.00, '2024-04-28 18:23:48'),
(21, 28, 4, 1.00, '2024-04-28 18:24:43'),
(22, 29, 4, 1.00, '2024-04-30 13:35:01'),
(23, 30, 5, 1.00, '2024-05-01 14:45:54');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id_notificacoes` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `conteudo` varchar(250) NOT NULL,
  `link_1` varchar(120) NOT NULL,
  `link_2` varchar(120) NOT NULL,
  `link_3` varchar(120) NOT NULL,
  `link_4` varchar(120) NOT NULL,
  `link_5` varchar(120) NOT NULL,
  `condicao` int(1) NOT NULL,
  `data_envio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id_notificacoes`, `id_usuario`, `titulo`, `conteudo`, `link_1`, `link_2`, `link_3`, `link_4`, `link_5`, `condicao`, `data_envio`) VALUES
(1, 6, '', 'OLa!!!!\r\ncolocando essa notificação apenas para ver oque pode ser colocado.', '0', '0', '0', '0', '0', 0, '0000-00-00 00:00:00'),
(2, 6, '', 'OLa!!!!\r\ncolocando essa notificação apenas para ver oque pode ser colocado.', '0', '0', '0', '0', '0', 0, '0000-00-00 00:00:00'),
(3, 6, 'Testando as notitifacações', 'OLa!!!!\r\ncolocando essa notificação apenas para ver oque pode ser colocado.', '0', '0', '0', '0', '0', 0, '0000-00-00 00:00:00'),
(4, 6, '', 'OLa!!!!\r\ncolocando essa notificação apenas para ver oque pode ser colocado.', '0', '0', '0', '0', '0', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `cod_produto`, `nome`, `valor`, `quantidade`, `categoria`, `cor`, `voltagem`, `voltagem_opcoes`, `descricao`, `status`, `foto`, `foto_1`, `foto_2`, `foto_3`, `foto_4`, `foto_5`, `foto_6`, `azul`, `vermelho`, `preto`, `branco`, `amarelo`, `verde`, `laranja`, `cinza`, `rosa`, `marrom`, `roxo`, `prata`, `dourado`) VALUES
(1, '', 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 220V', 529.00, 3.00, 'eletronicos', 'azul', '220', 'bi-volt', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '', 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 110V\n', 500.00, 5.00, 'eletronicos', 'azul', '110', 'bi-volt', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '', 'Carregador Motorola TurboPower 20w - Tipo-C - bivolt', 99.99, 12.00, 'carregadores', 'preto', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto7.png', 'produto7_1.png', 'produto7_2.png', 'produto7_3.png', 'produto7_4.png', 'produto7_5.png', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '', 'Carregador KAIDI 2.4 Amperes - c/2 saidas USB mod. KD-301s - bivolt', 20.00, 45.00, 'carregadores', 'branco', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto8.png', 'produto8_1.png', 'produto8_2.png', 'produto8_3.png', 'produto8_4.png', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '', 'Carregador para Iphone simples 2.4 Amperes - bivolt', 17.50, 20.00, 'carregadores', 'branco', '', '', 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto9.png', 'produto9_1.png', 'produto9_2.png', '', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, '1124232', 'Cabo HDMI pix 2 mts', 0.10, 25.00, 'cabos', 'preto', 'bivolt', 'bivolt', 'adicione uma descrição rapida.', 1, '23d4d9b5c26523e78fcfa235086abfdb.jpg', 'c2651ef93f6c67524860edc685193b8b.jpg', '6d86194c9cb692ce87c1d48c9cd349c2.jpg', 'd6d480bf7636b60e55719541f3a3a6ef.jpg', '213e8b4f8997971bf057201053f7721b.jpg', '', '', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tela_principal`
--

CREATE TABLE `tela_principal` (
  `id_tela` int(11) NOT NULL,
  `banner_1` varchar(40) NOT NULL,
  `banner_2` varchar(40) NOT NULL,
  `banner_3` varchar(40) NOT NULL,
  `banner_4` varchar(40) NOT NULL,
  `banner_5` varchar(40) NOT NULL,
  `link_banner_1` varchar(70) NOT NULL,
  `link_banner_2` varchar(70) NOT NULL,
  `link_banner_3` varchar(70) NOT NULL,
  `link_banner_4` varchar(70) NOT NULL,
  `link_banner_5` varchar(70) NOT NULL,
  `titulo_banner_1` varchar(40) NOT NULL,
  `titulo_banner_2` varchar(40) NOT NULL,
  `titulo_banner_3` varchar(40) NOT NULL,
  `titulo_banner_4` varchar(40) NOT NULL,
  `titulo_banner_5` varchar(40) NOT NULL,
  `ft_box_1` varchar(40) NOT NULL,
  `ft_box_2` varchar(40) NOT NULL,
  `ft_box_3` varchar(40) NOT NULL,
  `ft_box_4` varchar(40) NOT NULL,
  `ft_box_5` varchar(40) NOT NULL,
  `titulo_box_1` varchar(40) NOT NULL,
  `titulo_box_2` varchar(40) NOT NULL,
  `titulo_box_3` varchar(40) NOT NULL,
  `titulo_box_4` varchar(40) NOT NULL,
  `titulo_box_5` varchar(40) NOT NULL,
  `descricao_box_1` varchar(150) NOT NULL,
  `descricao_box_2` varchar(150) NOT NULL,
  `descricao_box_3` varchar(150) NOT NULL,
  `descricao_box_4` varchar(150) NOT NULL,
  `descricao_box_5` varchar(150) NOT NULL,
  `categoria_box_1` varchar(40) NOT NULL,
  `categoria_box_2` varchar(40) NOT NULL,
  `categoria_box_3` varchar(40) NOT NULL,
  `categoria_box_4` varchar(40) NOT NULL,
  `categoria_box_5` varchar(40) NOT NULL,
  `id_oferta_1` int(40) NOT NULL,
  `id_oferta_2` int(40) NOT NULL,
  `id_oferta_3` int(40) NOT NULL,
  `id_oferta_4` int(40) NOT NULL,
  `id_oferta_5` int(40) NOT NULL,
  `id_car_prod_1` int(40) NOT NULL,
  `id_car_prod_2` int(40) NOT NULL,
  `id_car_prod_3` int(40) NOT NULL,
  `id_car_prod_4` int(40) NOT NULL,
  `id_car_prod_5` int(40) NOT NULL,
  `id_car_prod_6` int(40) NOT NULL,
  `id_car_prod_7` int(40) NOT NULL,
  `id_car_prod_8` int(40) NOT NULL,
  `id_car_prod_9` int(40) NOT NULL,
  `id_car_prod_10` int(40) NOT NULL,
  `id_car_prod_11` int(40) NOT NULL,
  `id_car_prod_12` int(40) NOT NULL,
  `id_car_prod_13` int(40) NOT NULL,
  `id_car_prod_14` int(40) NOT NULL,
  `id_car_prod_15` int(40) NOT NULL,
  `id_car_prod_16` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tela_principal`
--

INSERT INTO `tela_principal` (`id_tela`, `banner_1`, `banner_2`, `banner_3`, `banner_4`, `banner_5`, `link_banner_1`, `link_banner_2`, `link_banner_3`, `link_banner_4`, `link_banner_5`, `titulo_banner_1`, `titulo_banner_2`, `titulo_banner_3`, `titulo_banner_4`, `titulo_banner_5`, `ft_box_1`, `ft_box_2`, `ft_box_3`, `ft_box_4`, `ft_box_5`, `titulo_box_1`, `titulo_box_2`, `titulo_box_3`, `titulo_box_4`, `titulo_box_5`, `descricao_box_1`, `descricao_box_2`, `descricao_box_3`, `descricao_box_4`, `descricao_box_5`, `categoria_box_1`, `categoria_box_2`, `categoria_box_3`, `categoria_box_4`, `categoria_box_5`, `id_oferta_1`, `id_oferta_2`, `id_oferta_3`, `id_oferta_4`, `id_oferta_5`, `id_car_prod_1`, `id_car_prod_2`, `id_car_prod_3`, `id_car_prod_4`, `id_car_prod_5`, `id_car_prod_6`, `id_car_prod_7`, `id_car_prod_8`, `id_car_prod_9`, `id_car_prod_10`, `id_car_prod_11`, `id_car_prod_12`, `id_car_prod_13`, `id_car_prod_14`, `id_car_prod_15`, `id_car_prod_16`) VALUES
(1, 'e8cad0e6e3d44e076b9f7f9c4a2cc80b.jpg', '9dea3afc4a69d6811b7c76d0b7881d29.jpg', 'img3.jpg', '', '', '#', '#', '#', '', '', 'Tudo em PC´s Gamer', 'Consulte nossos preços', 'Amplo estoque em Carregadores', '', '', '9e00a727bc3123b70f37df48ba5ecafe.png', '0795aa396c555479efe3691e6996de24.png', 'card3.png', 'card4.png', 'card5.png', 'carregadores', 'Computadores', 'Capinhas para celulares', 'Troca de display', 'Acessórios', ' Encontre carregadores para todas as marcas e modelos em celulares, notebooks e computadores.', 'Querendo efetuar um upgrade na carroça? click e veja as opções e valores.', 'Temos capinhas e peliculas para inumeros modelos e marcas, com o melhor preço.', 'Consulte nossos valores e marcas disponiveis.', 'Temos inumeros acessórios para toda area de informatica e smartphones.', 'carregadores', 'computadores', 'capinhas', 'vazio', 'acessorios', 1, 2, 13, 4, 5, 1, 2, 3, 4, 5, 0, 1, 2, 3, 4, 5, 13, 3, 4, 5, 0);

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
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Índices de tabela `endereco_usuario`
--
ALTER TABLE `endereco_usuario`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Índices de tabela `ficha_tec_produto`
--
ALTER TABLE `ficha_tec_produto`
  ADD PRIMARY KEY (`id_ficha_tec`);

--
-- Índices de tabela `itens_da_compra`
--
ALTER TABLE `itens_da_compra`
  ADD PRIMARY KEY (`id_item_compra`);

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
-- Índices de tabela `tela_principal`
--
ALTER TABLE `tela_principal`
  ADD PRIMARY KEY (`id_tela`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `endereco_usuario`
--
ALTER TABLE `endereco_usuario`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `itens_da_compra`
--
ALTER TABLE `itens_da_compra`
  MODIFY `id_item_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tela_principal`
--
ALTER TABLE `tela_principal`
  MODIFY `id_tela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
