<?php
header('Content-Type: application/json');

require_once 'conexaoDB.php';
require_once 'geraLog.php';

require_once '../plugins/vendor/autoload.php'; // Inclua o autoload do Composer

use Mike42\Escpos\PrintConnectors\FilePrintConnector; //Realizar impressão em Arquivo
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector; //Realizar impressão em impressora via rede (IP e Porta)
use Mike42\Escpos\Printer; //Função de comandos para impressão
use Mike42\Escpos\EscposImage;

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Fortaleza');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'A':
            $tipo = 'A';
            geraTicket($conn, $tipo);
            break;
        case 'V':
            $tipo = 'V';
            geraTicket($conn, $tipo);
            break;
        case 'I':
            $tipo = 'I';
            geraTicket($conn, $tipo);
            break;
        case 'AP':
            $tipo = 'AP';
            geraTicket($conn, $tipo);
            break;
        case 'DHO':
            $tipo = 'DHO';
            geraTicket($conn, $tipo);
            break;
        case 'SESMT':
            $tipo = 'SESMT';
            geraTicket($conn, $tipo);
            break;
        case 'SC':
            $tipo = 'SC';
            geraTicket($conn, $tipo);
            break;
        case 'EX':
            $tipo = 'EX';
            geraTicket($conn, $tipo);
            break;
        case 'VA':
            $tipo = 'VA';
            geraTicket($conn, $tipo);
            break;
        case 'INF':
            $tipo = 'INF';
            geraTicket($conn, $tipo);
            break;
        default:
            // Responda com um erro se a ação não for reconhecida
            http_response_code(400); // Bad Request
            echo 'Ação desconhecida!';
            exit;
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
            $numero = $ultimo_numero + 1;

            // Insere o novo registro com o próximo número na tabela
            $sql_insert = "INSERT INTO tickets (tipo, numero, estado, dia) VALUES ('$tipo', '$numero', '$estado', '$data')";
            if ($conn->query($sql_insert) === TRUE) {
                $operacao = "Ticket Gerado, Novo registro inserido com sucesso!";
                geraLogTicketGerados($tipo, $numero, $operacao);
                echo json_encode($tipo . '-' . formatarNumeroTicket($numero));
            } else {
                $operacao = "Erro ao inserir novo registro: " . $conn->error;
                geraLogTicketGerados($tipo, $numero, $operacao);
            }
        } else {
            // Se não houver registros na tabela, define o próximo número como 1
            $numero = 1;
            // Insere o primeiro registro na tabela
            $sql_insert_primeiro = "INSERT INTO tickets (tipo, numero, estado, dia) VALUES ('$tipo', '$numero', '$estado', '$data')";
            if ($conn->query($sql_insert_primeiro) === TRUE) {
                $operacao = "Primeiro Ticket Gerado, Primeiro registro inserido com sucesso!";
                geraLogTicketGerados($tipo, $numero, $operacao);
            } else {
                $operacao = "Erro ao inserir primeiro registro: " . $conn->error;
                geraLogTicketGerados($tipo, $numero, $operacao);
            }
        }

    // Fecha a conexão com o banco de dados
    $conn->close();
    imprimirTermica($tipo, $numero);
    //echo json_encode(imprimirTermica($tipo, $numero));
    //visualizar($tipo, $numero);
    //header("Location: ../pages/cliente.html");
}

function imprimirTermica($tipo, $numero_nao_formatado) {
    $numero = formatarNumeroTicket($numero_nao_formatado);
    $hoje = date('d/m/Y H:i:s'); // H format 24h e h Format 12h

        // Conector para a impressora (nesse exemplo, a impressora é um arquivo)
        $connector = new NetworkPrintConnector("10.2.5.151", 9100);

        // Tente criar uma nova instância da classe Printer
        $printer = new Printer($connector);

        // Configurar a justificação do texto para centralizar
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $tux = EscposImage::load("../imgs/logo-hrn.png", false);
        $printer->bitImage($tux);

        // Definir tamanho do texto = height & width
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);

        $printer->setTextSize(1, 1);
        $printer->text("\n");
        $printer->feed(3);

        $printer->setTextSize(2, 2);
        $printer->text($tipo . "-" . $numero);
        $printer->feed(5);

        $printer->setTextSize(1, 1);
        $printer->text($hoje);
        $printer->feed(1);
        $printer->text("\nHospital mantido com\nrecursos publicos\nsem fins lucrativos");
        $printer->feed(3);

        $printer->selectPrintMode(); // Reset

        // Corte o papel
        $printer->cut();

        // Feche a conexão com a impressora
        $printer->close();

        // Gera Log de Impressão
        $operacao_impressao = "Impressão do ticket " . $tipo . "-" . $numero . " com sucesso!";
        geraLogTicketImpressos($operacao_impressao);

}


?>
