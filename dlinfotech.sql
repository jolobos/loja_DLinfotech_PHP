-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/10/2024 às 02:16
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
(30, 6, 1, '2024-05-01 14:45:54', 17.50, 0, 0, 'BOLETO', 1),
(32, 6, 1, '2024-10-09 08:06:49', 99.99, 0, 0, 'PIX', 1),
(33, 6, 1, '2024-10-09 08:57:15', 99.99, 0, 0, 'PIX', 1);

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
(1, 13, '2 metros', '2 metros', '', '250 gm', '', 'PIX', '3 meses', 'bivolt', '', '', '', '', '', 'pix', '4k-ultra', 'if(isset($_FILES[\'arquivo1\'])){\r\n    $extensao1 = strtolower(substr($_FILES[\'arquivo1\'][\'name\'], -4)); //pega a extensao do arquivo\r\n    if($extensao1 == \'.png\' || $extensao1 == \'.jpg\' || $extensao1 == \'.svg\' || $extensao1 == \'.gif\'){\r\n    $novo_nome1 = md5(microtime()) . $extensao1; //define o nome do arquivo\r\n    $diretorio1 = \"../../img/produtos/\"; //define o diretorio para onde enviaremos o arquivo\r\n    move_uploaded_file($_FILES[\'arquivo1\'][\'tmp_name\'], $diretorio1.$novo_nome1); //efetua o upload\r\n    $foto_1 = $novo_nome1;\r\n}else{$foto_1 = \'\'; }}if(isset($_FILES[\'arquivo1\'])){\r\n    $extensao1 = strtolower(substr($_FILES[\'arquivo1\'][\'name\'], -4)); //pega a extensao do arquivo\r\n    if($extensao1 == \'.png\' || $extensao1 == \'.jpg\' || $extensao1 == \'.svg\' || $extensao1 == \'.gif\'){\r\n    $novo_nome1 = md5(microtime()) . $extensao1; //define o nome do arquivo\r\n    $diretorio1 = \"../../img/produtos/\"; //define o diretorio para onde enviaremos o arquivo\r\n    move_uploaded_file($_FILES[\'arq', 0, 0, '18gbps'),
(2, 15, '3.5 cm', '--', '1cm', '25 gm', '--', 'XIOAMI', '1 ano', 'bivolt', '---', '--', '--', '--', '1 hora 30 minutos', 'XIOAMI', 'md-756', 'Fone de ouvido Xiaomi de alta qualidade.\npossui conexão bluetooth 3.1, com sistema anti-ruído e longo alcance.\nproduto ideal para quem gosta de jogar e olhar videos.\n\nAqui eu vou dar uma enchida de linguiça para não ficar tão vazio a parte da descrição.\n\nEra uma vez, um lugarzzinho no meio do nad, com sabor de chocolate, cheiro de terra molhada.....\nMas pra gente ser feliz, tem que comemorar as nossas amizaades, os amigos de verdade,\ntah taha taharta rara.....\n', 0, 0, '--'),
(3, 16, '3.5 cm', '--', '1cm', '25 gm', '--', 'XIOAMI', '1 ano', 'bivolt', '---', '--', '--', '--', '1 hora 30 minutos', 'XIOAMI', 'md-756', 'Fone de ouvido Xiaomi de alta qualidade.\r\npossui conexão bluetooth 3.1, com sistema anti-ruído e longo alcance.\r\nproduto ideal para quem gosta de jogar e olhar videos.\r\n\r\nAqui eu vou dar uma enchida de linguiça para não ficar tão vazio a parte da descrição.\r\n\r\nEra uma vez, um lugarzzinho no meio do nad, com sabor de chocolate, cheiro de terra molhada.....\r\nMas pra gente ser feliz, tem que comemorar as nossas amizaades, os amigos de verdade,\r\ntah taha taharta rara.....\r\n', 0, 0, '--'),
(4, 17, '3.5 cm', '--', '1cm', '25 gm', '--', 'XIOAMI', '1 ano', 'bivolt', '---', '--', '--', '--', '1 hora 30 minutos', 'XIOAMI', 'md-756', 'Fone de ouvido Xiaomi de alta qualidade.\r\npossui conexão bluetooth 3.1, com sistema anti-ruído e longo alcance.\r\nproduto ideal para quem gosta de jogar e olhar videos.\r\n\r\nAqui eu vou dar uma enchida de linguiça para não ficar tão vazio a parte da descrição.\r\n\r\nEra uma vez, um lugarzzinho no meio do nad, com sabor de chocolate, cheiro de terra molhada.....\r\nMas pra gente ser feliz, tem que comemorar as nossas amizaades, os amigos de verdade,\r\ntah taha taharta rara.....\r\n', 0, 0, '--'),
(5, 18, '3.5 cm', '--', '1cm', '25 gm', '--', 'XIOAMI', '1 ano', 'bivolt', '---', '--', '--', '--', '1 hora 30 minutos', 'XIOAMI', 'md-756', 'Fone de ouvido Xiaomi de alta qualidade.\r\npossui conexão bluetooth 3.1, com sistema anti-ruído e longo alcance.\r\nproduto ideal para quem gosta de jogar e olhar videos.\r\n\r\nAqui eu vou dar uma enchida de linguiça para não ficar tão vazio a parte da descrição.\r\n\r\nEra uma vez, um lugarzzinho no meio do nad, com sabor de chocolate, cheiro de terra molhada.....\r\nMas pra gente ser feliz, tem que comemorar as nossas amizaades, os amigos de verdade,\r\ntah taha taharta rara.....\r\n', 0, 0, '--'),
(6, 19, '3.5 cm', '--', '1cm', '25 gm', '--', 'XIOAMI', '1 ano', 'bivolt', '---', '--', '--', '--', '1 hora 30 minutos', 'XIOAMI', 'md-756', 'Fone de ouvido Xiaomi de alta qualidade.\r\npossui conexão bluetooth 3.1, com sistema anti-ruído e longo alcance.\r\nproduto ideal para quem gosta de jogar e olhar videos.\r\n\r\nAqui eu vou dar uma enchida de linguiça para não ficar tão vazio a parte da descrição.\r\n\r\nEra uma vez, um lugarzzinho no meio do nad, com sabor de chocolate, cheiro de terra molhada.....\r\nMas pra gente ser feliz, tem que comemorar as nossas amizaades, os amigos de verdade,\r\ntah taha taharta rara.....\r\n', 0, 0, '--'),
(7, 20, '3.5 cm', '--', '1cm', '25 gm', '--', 'XIOAMI', '1 ano', 'bivolt', '---', '--', '--', '--', '1 hora 30 minutos', 'XIOAMI', 'md-756', 'Fone de ouvido Xiaomi de alta qualidade.\r\npossui conexão bluetooth 3.1, com sistema anti-ruído e longo alcance.\r\nproduto ideal para quem gosta de jogar e olhar videos.\r\n\r\nAqui eu vou dar uma enchida de linguiça para não ficar tão vazio a parte da descrição.\r\n\r\nEra uma vez, um lugarzzinho no meio do nad, com sabor de chocolate, cheiro de terra molhada.....\r\nMas pra gente ser feliz, tem que comemorar as nossas amizaades, os amigos de verdade,\r\ntah taha taharta rara.....\r\n', 0, 0, '--'),
(8, 21, '19X13', '19 cm', '-------', '197 gm', '-------', 'Tilibra', '3 meses', '', '------', '--------', '-------', '--------', '-------', 'Tilibra', 'Aloha-Tilibra', 'O Caderno Tilibra Capa Dura Costurado Universitário 1X1 80 Folhas Flamingo Aloha 292575 26384 possui capa dura com a parte interna decorada, folha dupla de adesivos e folhas pautadas. Ideal para o dia a dia na escola.\r\n\r\n\r\n', 0, 0, '------'),
(9, 22, '19X13', '19 cm', '-------', '197 gm', '-------', 'Tilibra', '3 meses', '', '------', '--------', '-------', '--------', '-------', 'Tilibra', 'Aloha-Tilibra', 'O Caderno Tilibra Capa Dura Costurado Universitário 1X1 80 Folhas Flamingo Aloha 292575 26384 possui capa dura com a parte interna decorada, folha dupla de adesivos e folhas pautadas. Ideal para o dia a dia na escola.\r\n\r\n\r\n', 0, 0, '------'),
(10, 23, '19X13', '19 cm', '-------', '197 gm', '-------', 'Tilibra', '3 meses', '', '------', '--------', '-------', '--------', '-------', 'Tilibra', 'Aloha-Tilibra', 'O Caderno Tilibra Capa Dura Costurado Universitário 1X1 80 Folhas Flamingo Aloha 292575 26384 possui capa dura com a parte interna decorada, folha dupla de adesivos e folhas pautadas. Ideal para o dia a dia na escola.\r\n\r\n\r\n', 0, 0, '------');

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
(23, 30, 5, 1.00, '2024-05-01 14:45:54'),
(25, 32, 3, 1.00, '2024-10-09 08:06:49'),
(26, 33, 3, 1.00, '2024-10-09 08:57:15');

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
  `v_110` int(1) NOT NULL,
  `v_220` int(1) NOT NULL,
  `v_bivolt` int(1) NOT NULL,
  `s_volt` int(1) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `status` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `foto_1` varchar(50) NOT NULL,
  `foto_2` varchar(50) NOT NULL,
  `foto_3` varchar(50) NOT NULL,
  `foto_4` varchar(50) NOT NULL,
  `foto_5` varchar(50) NOT NULL,
  `foto_6` varchar(50) NOT NULL,
  `var_cores` int(1) NOT NULL,
  `link_110` varchar(50) NOT NULL,
  `link_220` varchar(50) NOT NULL,
  `link_bivolt` varchar(50) NOT NULL,
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
  `dourado` int(1) NOT NULL,
  `link_azul` varchar(45) NOT NULL,
  `link_vermelho` varchar(45) NOT NULL,
  `link_preto` varchar(45) NOT NULL,
  `link_branco` varchar(45) NOT NULL,
  `link_amarelo` varchar(45) NOT NULL,
  `link_verde` varchar(45) NOT NULL,
  `link_laranja` varchar(45) NOT NULL,
  `link_cinza` varchar(45) NOT NULL,
  `link_rosa` varchar(45) NOT NULL,
  `link_marrom` varchar(45) NOT NULL,
  `link_roxo` varchar(45) NOT NULL,
  `link_prata` varchar(45) NOT NULL,
  `link_dourado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `cod_produto`, `nome`, `valor`, `quantidade`, `categoria`, `cor`, `voltagem`, `v_110`, `v_220`, `v_bivolt`, `s_volt`, `descricao`, `status`, `foto`, `foto_1`, `foto_2`, `foto_3`, `foto_4`, `foto_5`, `foto_6`, `var_cores`, `link_110`, `link_220`, `link_bivolt`, `azul`, `vermelho`, `preto`, `branco`, `amarelo`, `verde`, `laranja`, `cinza`, `rosa`, `marrom`, `roxo`, `prata`, `dourado`, `link_azul`, `link_vermelho`, `link_preto`, `link_branco`, `link_amarelo`, `link_verde`, `link_laranja`, `link_cinza`, `link_rosa`, `link_marrom`, `link_roxo`, `link_prata`, `link_dourado`) VALUES
(1, '212121', 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 220V', 529.00, 3.00, 'eletronicos', 'azul', '220', 1, 1, 0, 0, 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 0, '121212', '212121', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '212121', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, '121212', 'Estação de Solda e Retrabalho Yaxun 886D ESD Safe 2 em 1 de Uso Industrial - 110V\n', 500.00, 5.00, 'eletronicos', 'azul', '110', 1, 1, 0, 0, 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto6.png', 'produto6_1.png', 'produto6_2.png', 'produto6_3.png', 'produto6_4.png', '', '', 0, '121212', '212121', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '121212', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, '313131', 'Carregador Motorola TurboPower 20w - Tipo-C - bivolt', 99.99, 12.00, 'carregadores', 'preto', '', 0, 0, 1, 0, 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto7.png', 'produto7_1.png', 'produto7_2.png', 'produto7_3.png', 'produto7_4.png', 'produto7_5.png', '', 0, '', '', '313131', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, '131313', 'Carregador KAIDI 2.4 Amperes - c/2 saidas USB mod. KD-301s - bivolt', 20.00, 45.00, 'carregadores', 'branco', '', 0, 0, 0, 0, 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto8.png', 'produto8_1.png', 'produto8_2.png', 'produto8_3.png', 'produto8_4.png', '', '', 0, '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, '414141', 'Carregador para Iphone simples 2.4 Amperes - bivolt', 17.50, 20.00, 'carregadores', 'branco', '', 0, 0, 0, 0, 'Colocarei uma descrição qualquer aqui apenas para ilustrar esse produto, não sendo necessario especifica-lo nesse momento, eu só preciso desse texto mesmo.', 1, 'produto9.png', 'produto9_1.png', 'produto9_2.png', '', '', '', '', 0, '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, '1124232', 'Cabo HDMI pix 2 mts', 0.10, 25.00, 'cabos', 'preto', '', 0, 0, 0, 0, 'adicione uma descrição rapida.', 1, '23d4d9b5c26523e78fcfa235086abfdb.jpg', 'c2651ef93f6c67524860edc685193b8b.jpg', '6d86194c9cb692ce87c1d48c9cd349c2.jpg', 'd6d480bf7636b60e55719541f3a3a6ef.jpg', '213e8b4f8997971bf057201053f7721b.jpg', '', '', 0, '', '', '', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, '2222222', 'fone de ouvido xiaomi via bluetooth', 90.50, 20.00, 'audio', 'azul', '', 0, 0, 0, 1, 'Fone de ouvido da marca XIOAMI via Bluetooth 3.1', 1, 'produto_null.png', 'c2d875ec9f5094d95038f6a8f25f70d4.png', '491aa62c03774825e5735704c62f9be2.png', 'f79c62c08d874f7b54f6074feaa9567c.png', 'cb13f2f3178b35ca577b444d906f3415.png', '', '', 1, '', '', '', 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, '2222222', '', '4444444', '5555555', '', '8888888', '', '', '', '', '7777777', '', '6666666'),
(15, '3333333', 'fone de ouvido xiaomi via bluetooth', 90.50, 20.00, 'audio', 'azul', '', 1, 1, 0, 0, 'Fone de ouvido da marca XIOAMI via Bluetooth 3.1', 1, 'produto_null.png', '5cbee13e2d3fb291115ffb86535a4479.png', 'd00825ff62a7e39e457c152e75e34e3e.png', '444636ed60c277101ff9f92262eaadba.png', '303f3abfdea2e90b1828dfe3e210fec2.png', '', '', 1, '2222222', '3333333', '', 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, '15', '', '16', '17', '', '', '', '', '', '', '19', '', '18'),
(16, '4444444', 'fone de ouvido xiaomi via bluetooth', 90.50, 20.00, 'audio', 'preto', '', 0, 0, 0, 1, 'Fone de ouvido da marca XIOAMI via Bluetooth 3.1', 1, 'e5158611001608e7f38559d5641b58b8.png', 'd30743d0756b346b7ed7cb7c19ec7086.png', 'd6059ed3fc9a5cc9937496376ddcb645.png', '0af7967ecb4ec94c6e261067c1cfa1df.png', 'caf9f457c14cc51f5947c62d023b1e5f.png', '', '', 1, '', '', '', 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, '2222222', '', '4444444', '5555555', '', '8888888', '', '', '', '', '7777777', '', '6666666'),
(17, '5555555', 'fone de ouvido xiaomi via bluetooth', 90.50, 20.00, 'audio', 'branco', '', 0, 0, 0, 0, 'Fone de ouvido da marca XIOAMI via Bluetooth 3.1', 1, '619cf42139df60b4b6deb288d144c2ec.png', '0d2f4ca474001d7903b9ad87c27e1764.png', '61508bd6b6ac1b742b482388968c5175.png', '6f87e41f778f09f18ab0f82f3b27919f.png', 'd88a9b87567ed092da432ae12fbbc387.png', '', '', 1, '', '', '', 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, '2222222', '', '4444444', '5555555', '', '8888888', '', '', '', '', '7777777', '', '6666666'),
(18, '6666666', 'fone de ouvido xiaomi via bluetooth', 90.50, 20.00, 'audio', 'dourado', '', 0, 0, 0, 0, 'Fone de ouvido da marca XIOAMI via Bluetooth 3.1', 1, '69c48b83bb50cf39974946e64264ff86.png', 'fede0edc6e3914a2e4e4d342e9a93ea0.png', '5ec7112002b67a37abbe4de22b6704e2.png', '', '', '', '', 1, '', '', '', 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, '2222222', '', '4444444', '5555555', '', '8888888', '', '', '', '', '7777777', '', '6666666'),
(19, '7777777', 'fone de ouvido xiaomi via bluetooth', 90.50, 20.00, 'audio', 'roxo', '', 0, 0, 0, 0, 'Fone de ouvido da marca XIOAMI via Bluetooth 3.1', 1, '4566a72b49c21a7672c06c84e5ed4466.png', '', '', '', '', '', '', 1, '', '', '', 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, '2222222', '', '4444444', '5555555', '', '8888888', '', '', '', '', '7777777', '', '6666666'),
(20, '8888888', 'fone de ouvido xiaomi via bluetooth', 90.50, 20.00, 'audio', 'verde', '', 0, 0, 0, 0, 'Fone de ouvido da marca XIOAMI via Bluetooth 3.1', 1, '2dd25e0428dd5335e26bd2be9170b753.png', 'eeb1928efa181cb216a2807d79bd9c82.png', '62ae8041e6ad2fcb5cb5ea8e5181a2fe.png', '', '', '', '', 1, '', '', '', 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, '2222222', '', '4444444', '5555555', '', '8888888', '', '', '', '', '7777777', '', '6666666'),
(23, '7891027295561', 'Caderno Aloha', 10.00, 23.00, 'acessorios', 'rosa', '', 0, 0, 0, 1, 'caderno pequeno tilibra', 1, 'f459790eaf5d1d80f10ec1b1665e92c3.png', '', '', '', '', '', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '7891027295561', '', '', '', '');

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
(1, 'e8cad0e6e3d44e076b9f7f9c4a2cc80b.jpg', '9dea3afc4a69d6811b7c76d0b7881d29.jpg', 'img3.jpg', '', '', '#', '#', '#', '', '', 'Tudo em PC´s Gamer', 'Consulte nossos preços', 'Amplo estoque em Carregadores', '', '', '9e00a727bc3123b70f37df48ba5ecafe.png', '0795aa396c555479efe3691e6996de24.png', 'card3.png', 'card4.png', 'card5.png', 'carregadores', 'Computadores', 'Capinhas para celulares', 'Troca de display', 'Acessórios', ' Encontre carregadores para todas as marcas e modelos em celulares, notebooks e computadores.', 'Querendo efetuar um upgrade na carroça? click e veja as opções e valores.', 'Temos capinhas e peliculas para inumeros modelos e marcas, com o melhor preço.', 'Consulte nossos valores e marcas disponiveis.', 'Temos inumeros acessórios para toda area de informatica e smartphones.', 'carregadores', 'computadores', 'capinhas', 'vazio', 'acessorios', 1, 2, 13, 4, 5, 1, 2, 3, 4, 5, 4, 1, 2, 3, 4, 5, 13, 3, 4, 5, 0);

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
  `status` int(1) NOT NULL,
  `administrador` int(1) NOT NULL,
  `token_recupercao` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `CPF`, `telefone`, `celular`, `CEP`, `UF`, `cidade`, `bairro`, `logradouro`, `complemento`, `email`, `senha`, `foto`, `apelido`, `data_entrada`, `status`, `administrador`, `token_recupercao`) VALUES
(6, 'nome teste ', 2351055039, 51985078897, 51985078897, 94945330, 'RS', 'kaxuxa', 'vista', 'logo ali', 'casa', 'email.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '8c34c4ee0b0ce8ba859f0a6ac21be992.jpg', 'digo', '2024-04-01 10:56:47', 0, 1, 'a4FPJG'),
(7, 'seliria santos de azevedo', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'ail.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:32:57', 1, 0, ''),
(8, 'Asus_m1', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'il.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-04-01 13:45:34', 1, 0, ''),
(9, 'malaquias', 0, 5198995452, 5198995452, 0, '', '', '', '', '', 'malaquias.teste@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-09-13 15:18:30', 1, 0, ''),
(10, 'Luana Koling Ribeiro', 0, 51987057798, 51987057798, 0, '', '', '', '', '', 'luana.koling@gmail.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-10-18 19:05:26', 1, 0, 'Hq3PUp'),
(11, 'barilochi', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'email.testeas@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-10-19 15:35:19', 1, 0, ''),
(12, 'jujubalindah', 0, 51985078897, 51985078897, 0, '', '', '', '', '', 'email.testandoconexao@testando.com', '854a3864c2bef0b3948892a2c7b93ddd', '', '', '2024-10-19 15:47:17', 1, 0, '');

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
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `endereco_usuario`
--
ALTER TABLE `endereco_usuario`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `ficha_tec_produto`
--
ALTER TABLE `ficha_tec_produto`
  MODIFY `id_ficha_tec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `itens_da_compra`
--
ALTER TABLE `itens_da_compra`
  MODIFY `id_item_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tela_principal`
--
ALTER TABLE `tela_principal`
  MODIFY `id_tela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
