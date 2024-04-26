<?php

require_once 'conexaoDB.php';
require_once 'geraLog.php';

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Fortaleza');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'btnExibeTicketAcompanhante') {
        $tipoTicketChamado = 'ACOMPANHANTE';
        // Execute a função PHP aqui
        buscarTicketEAtualizarEstado($conn, $tipoTicketChamado);
    } elseif ($_POST['action'] == 'btnExibeTicketVisitante') {
        $tipoTicketChamado = 'VISITANTE';
        // Execute a função PHP aqui
        buscarTicketEAtualizarEstado($conn, $tipoTicketChamado);
    } else {
        // Responda com um erro se a ação não for reconhecida
        http_response_code(400); // Bad Request
        echo 'Ação desconhecida!';
        exit;
    }
}


// Função para buscar o acompanhante e atualizar o estado do registro
function buscarTicketEAtualizarEstado($conn, $tipoTicketChamado) {

    $data = date("d-m-Y H:i:s");
    // Query SQL para buscar o acompanhante com o estado 'GERADO'
    $sql = "SELECT * FROM tickets WHERE estado = 'GERADO' AND tipo='$tipoTicketChamado' ORDER BY id ASC LIMIT 1";
    $result = $conn->query($sql);
    
    // Verifique se há resultados
    if ($result->num_rows > 0) {
        // Retorne o primeiro ID encontrado
        $row = $result->fetch_assoc();
        $id_ticket = $row['id'];
        $tipo_ticket = $row['tipo'];
        $numero_ticket = $row['numero'];
        
        // Query SQL para atualizar o estado do registro com o ID encontrado
        $sql_update = "UPDATE tickets SET estado = 'ATENDIMENTO' WHERE id = $id_ticket";
        $sql_update_atual = "UPDATE atual SET tipo='$tipo_ticket', numero='$numero_ticket' WHERE id = 1";


        // Armazene o valor onde você preferir, como um arquivo de texto ou um banco de dados
        //escreverArquivoTxt($tipo_ticket, $numero_ticket);
        
        // Execute a query SQL de atualização
        if (($conn->query($sql_update) === TRUE) && ($conn->query($sql_update_atual) === TRUE)) {
            // Envie uma resposta de sucesso 
            echo json_encode($tipo_ticket . "-" . $numero_ticket);
                //Gera Log da Chamada
                $operacao = "Chamado com sucesso!";
                geraLog($tipo_ticket, $numero_ticket, $operacao);
        } else {
            // Envie uma resposta de erro se houver um problema ao atualizar o estado
            echo json_encode(array('error' => 'Erro ao atualizar o estado do registro no banco de dados (function buscarTicketEAtualizarEstado): ' . $conn->error));
                //Gera Log da Chamada
                $operacao = json_encode(array('error' => 'Erro ao atualizar o estado do registro no banco de dados (function buscarTicketEAtualizarEstado): ' . $conn->error));
                geraLog($tipo_ticket, $numero_ticket, $operacao);
        }
    } else {
        // Se não houver acompanhantes com estado 'GERADO', envie uma resposta indicando que não há acompanhantes disponíveis
        echo ('Não há tickets do tipo ' . $tipoTicketChamado . ' esperando atendimento.');
    }
    
    // Feche a conexão com o banco de dados
    $conn->close();
}

?>