<?php
require_once('../../verifica_session.php');
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../../database.php");
header('Content-Type: charset=utf-8');
// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 3.50;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $_GET['valor']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = '12345678';  // Nosso numero - REGRA: Máximo de 8 caracteres!
$dadosboleto["numero_documento"] = '0123';	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

$sql3 = "SELECT * FROM usuarios WHERE id_usuario = '".$id_usuario."'";
$consulta3 = $conexao->query($sql3);
$d3 = $consulta3->fetch(PDO::FETCH_ASSOC);

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $d3['nome'];//nome do cliente
$dadosboleto["endereco1"] = $d3['logradouro'];//"Endereço do seu Cliente";
$dadosboleto["endereco2"] = ''.$d3['cidade'].' - '.$d3['UF'].' - '.$d3['CEP'];"Cidade - Estado -  CEP: 00000-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de Compra na Loja DLInfotech";
$dadosboleto["demonstrativo2"] = "Pagamento referente a compra de produtos ou serviços oferecido pelo estabelecimento<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "BoletoPhp - http://www.boletophp.com.br";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = "- Receber até 5 dias após o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco pelo email: digo8432@gmail.com ";
$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = "1444"; // Num da agencia, sem digito
$dadosboleto["conta"] = "86045";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "4"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"] = "BoletoPhp - Código Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = "02351055039";
$dadosboleto["endereco"] = "Rua Lima e silva n 535 Vista Alegre";
$dadosboleto["cidade_uf"] = "Cachoeirinha / RS";
$dadosboleto["cedente"] = "DLInfotech - Soluções em tecnologia";

// NÃO ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau.php");
	