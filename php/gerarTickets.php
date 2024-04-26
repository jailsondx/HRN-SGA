<?php

require_once 'conexaoDB.php';
require_once 'geraLog.php';

require_once '../plugins/vendor/autoload.php'; // Inclua o autoload do Composer

use Mike42\Escpos\PrintConnectors\FilePrintConnector; //Realizar impressão em Arquivo
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector; //Realizar impressão em impressora via rede (IP e Porta)
use Mike42\Escpos\Printer; //Função de comandos para impressão
use Mike42\Escpos\EscposImage;

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Fortaleza');


// Verifica qual botão foi clicado recebendo via FORM da pagina cliente.html
if (isset($_POST['tipoTicket'])) {
    $tipoTicketParamentro = $_POST['tipoTicket'];
    // Chama a função correspondente
    switch ($tipoTicketParamentro) {
        case 'A':
            $tipo = 'Acompanhante';
            geraTicket($conn, $tipo);
            break;
        case 'V':
            $tipo = 'Visitante';
            geraTicket($conn, $tipo);
            break;
        default:
            echo "Função não encontrada!";
            break;
    }
}



function geraTicket($conn, $tipo){
        // Consulta SQL para obter o último valor da coluna "numero"
        $sql = "SELECT MAX(numero) AS ultimo_numero FROM tickets WHERE tipo = '$tipo'";
        $result = $conn->query($sql);

        $estado = 'GERADO';
        $data = date("d-m-Y H:i:s");


    // Verifica se a consulta retornou algum resultado
        if ($result->num_rows > 0) {
            // Extrai o valor do último número da consulta
            $row = $result->fetch_assoc();
            $ultimo_numero = $row["ultimo_numero"];

            // Incrementa o último número para obter o próximo número
            $proximo_numero = $ultimo_numero + 1;
            $numero = $proximo_numero;

            // Insere o novo registro com o próximo número na tabela
            $sql_insert = "INSERT INTO tickets (tipo, numero, estado, dia) VALUES ('$tipo', '$proximo_numero', '$estado', '$data')";
            if ($conn->query($sql_insert) === TRUE) {
                $operacao = "Ticket Gerado, Novo registro inserido com sucesso!";
                geraLog($tipo, $numero, $operacao);
            } else {
                $operacao = "Erro ao inserir novo registro: " . $conn->error;
                geraLog($tipo, $numero, $operacao);
            }
        } else {
            // Se não houver registros na tabela, define o próximo número como 1
            $proximo_numero = 1;
            $numero = $proximo_numero;
            // Insere o primeiro registro na tabela
            $sql_insert_primeiro = "INSERT INTO tickets (tipo, numero, estado, dia) VALUES ('$tipo', '$proximo_numero', '$estado', '$data')";
            if ($conn->query($sql_insert_primeiro) === TRUE) {
                $operacao = "Primeor Ticket Gerado, Primeiro registro inserido com sucesso!";
                geraLog($tipo, $numero, $operacao);
            } else {
                $operacao = "Erro ao inserir primeiro registro: " . $conn->error;
                geraLog($tipo, $numero, $operacao);
            }
        }

    // Fecha a conexão com o banco de dados
    $conn->close();
    //imprimirTermica($tipo, $numero);
    //visualizar($tipo, $numero);
    header("Location: ../cliente.html");
}

function imprimirZebra($tipo, $numero){
        //Recebe o parâmetro da função JS chamaImprimir(tipoTicket) do arquivo functions.js
        //$tipoTicket = $_GET['parametro'];
        //$parametro = " TESTE ";
        // Faça algo com o parâmetro recebido
        
        // Endereço IP e porta da impressora
        $ip = '10.2.5.151';
        $port = 9100;
        
        // Dados de impressão
        $hoje = date('d/m/Y H:i:s'); //H format 24h e h Format 12h
        //$conteudoImpressao = "^XA^FO100,100^ADN,36,20^FDExemplo de impressao^FS^XZ"; // Exemplo de conteúdo para impressão
        $conteudoImpressao = 
        '^XA
        ^LH0,30
        
        ^FO30,0^GFA,960,960,16,,:01QFE,03RF8,07RFC,0SFC,0SFE,1SFE,::::::::::1MF8003FFE,:17LF8003FFE,107KF8003FFE,100KF8003FFE,1003JF8003FFE,1I0JF8003FFE,1I07IF8003FFE,1I01IF8003FFE0188F8F3C4F8C2,1J0IF8003FFE01I8C822421C2,1J07FF8003FFE01890482242142,1J03FF8003FFE00F90462642122,18I01FF8003FFE01890433842322,18I0EFF8003FFE01898C120423E2,18T0188D8B2042213C,1CW0204,1E,:1F,1F8T0C2C380E10042,1FCS01B30C499188C2,1FES0192080909C0A2,1FFS0193080B094122,1FF8S0E3598A096122,1FFER0192088B0931F2,1IF8Q01920C89193312,1IFER09BC788F11213C,1JFE018003FFE,:::1JFE018003FFE0088F8F7EF,1KF018003FFE00C9881088,1KF018003FFE0049041088,0KF838003FFE002904E08F,0KF838003FFE002904A088,0KFC38003FFC0019089088,07JFE78003FF80018D8918F,03LF8003FF,007KF8003FC,,:^FS
        
        ^PW780
        ^PR203
        ^FX Abaixo: labels de impressão; Acima: tamanho do width de impressão.
        ^A0N,50,50
        ^FO180,30,2^FB760,1,0,VC^FDHospital Regional Norte^FS
        ^LH0,100
        ^A0N,70,70
        ^FO160,100,2^FB760,1,0,VC^FD'.$tipo.'-'.$numero.'^FS
        ^FO0,170^GB900,1,3^FS
        ^A0N,30,30
        ^FO300,180,2^FB760,1,0,VC^FD'.$hoje.'^FS
        ^XZ';

        
        // Abre uma conexão com a impressora
        $socket = fsockopen($ip, $port, $errno, $errstr, 30);
        
        // Verifica se a conexão foi estabelecida com sucesso
        if (!$socket) {
            $operacao =  "Erro ao conectar com a impressora:" . $errstr ($errno);
            geraLog($tipo, $numero, $operacao);
        } else {
            // Envia os dados de impressão para a impressora
            fwrite($socket, $conteudoImpressao);
        
            // Fecha a conexão com a impressora
            fclose($socket);
            //echo "<script>alert('Impressão Enviada');</>";
            $operacao =  "Impressão Realizada Ticket: " . $tipo . "-" . $numero;
            geraLog($tipo, $numero, $operacao);
        }

}

function imprimirTermica($tipo, $numero){

    $hoje = date('d/m/Y H:i:s'); //H format 24h e h Format 12h

    // Conector para a impressora (nesse exemplo, a impressora é um arquivo)
    $connector = new NetworkPrintConnector("10.2.5.151",9100);

    // Crie uma nova instância da classe Printer
    $printer = new Printer($connector);
    //$printer -> initialize();

    // Configurar a justificação do texto para centralizar
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $tux = EscposImage::load("../imgs/logo-hrn.png", false);
    $printer -> bitImage($tux);

    // Definir tamanho do texto = height & width
    $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);

    $printer -> setTextSize(1, 1);
    $printer -> text("\n");
    $printer->feed(3);

    $printer -> setTextSize(2, 2);
    $printer -> text($tipo."-".$numero);
    $printer->feed(5);

    $printer -> setTextSize(1, 1);
    $printer -> text($hoje);
    $printer -> text("\nHospital mantido com recursos publicos, sem fins lucrativos");
    $printer->feed(3);
    
    $printer -> selectPrintMode(); // Reset

    // Corte o papel
    $printer->cut();

    // Feche a conexão com a impressora
    $printer->close();

    //Gera Log de Impressão
    $operacao = "Impressão do ticket ".$tipo."-".$numero." com sucesso!";
    geraLog($tipo, $numero, $operacao);

}

function visualizar($tipo, $numero){
    $hoje = date('d/m/Y H:i:s'); //H format 24h e h Format 12h

    // Conteúdo ZPL
    $zplContent = '^XA
    ^PW780
    ^FX Abaixo: labels de impressão; Acima: tamanho do width de impressão.
    ^CFA,11
    ^FO10,25^FDHospital Regional Norte^FS
    ^CFA,25
    ^FO140,100^FD'.$tipo.'-'.$numero.'^FS
    ^FO0,135^GB1625,1,3^FS
    ^CFA,15
    ^FO70,140^FD'.$hoje.'^FS
    ^XZ';

    // Caminho do arquivo temporário
    $tempFilePath = 'temp.zpl';

    // Escreva o conteúdo ZPL no arquivo temporário
    file_put_contents($tempFilePath, $zplContent);

    // Saída do arquivo temporário no navegador
    header('Content-Type: application/zpl');
    header('Content-Disposition: inline; filename="documento.zpl"');
    readfile($tempFilePath);

    // Remover o arquivo temporário após exibição
    unlink($tempFilePath);
}


?>
