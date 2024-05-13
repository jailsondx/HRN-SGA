<?php

require_once "conexaoDB.php";
require_once "geraLog.php";

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set("America/Fortaleza");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tipo"]) && isset($_POST["guiche"])) {
    $tipoTicketChamado = "";
    switch ($_POST["tipo"]) {
        case "btnExibeTicketAcompanhante":
            $tipoTicketChamado = "ACOMPANHANTE";
            $guiche = $_POST["guiche"];
            buscarTicketEAtualizarEstado($conn, $tipoTicketChamado, $guiche);
            break;
        case "btnExibeTicketVisitante":
            $tipoTicketChamado = "VISITANTE";
            $guiche = $_POST["guiche"];
            buscarTicketEAtualizarEstado($conn, $tipoTicketChamado, $guiche);
            break;
        case "btnExibeAtendimentoPrioritario":
            $tipoTicketChamado = "ATENDIMENTO PRIORITARIO";
            $guiche = $_POST["guiche"];
            buscarTicketEAtualizarEstado($conn, $tipoTicketChamado, $guiche);
            break;
        case "btnExibeOutros":
            $tipoTicketChamado = "VISITA ADMINISTRATIVA";
            $guiche = $_POST["guiche"];
            buscarTicketEAtualizarEstado($conn, $tipoTicketChamado, $guiche);
            break;
        case "btnExibeOutros":
            $tipoTicketChamado = "CREDENCIAL ESQUECIDA";
            $guiche = $_POST["guiche"];
            buscarTicketEAtualizarEstado($conn, $tipoTicketChamado, $guiche);
            break;
        case "btnExibeTicketEmOrdem":
            $tipoTicketChamado = "ORDEM";
            break;
        case "btnRepeteUltimo":
            $tipoTicketChamado = "REPETIR";
            repeteTicket($conn, $tipoTicketChamado);
            break;
        default:
            // Responda com um erro se a ação não for reconhecida
            http_response_code(400); // Bad Request
            echo "Ação desconhecida!";
            exit();
    }
}//FIM IF

// Função para buscar o acompanhante e atualizar o estado do registro
function buscarTicketEAtualizarEstado($conn, $tipoTicketChamado, $guiche){
    $data = date("d-m-Y H:i:s");
    // Query SQL para buscar o acompanhante com o estado 'GERADO'
    $sql = "SELECT * FROM tickets WHERE estado = 'GERADO' AND tipo='$tipoTicketChamado' ORDER BY id ASC LIMIT 1";
    $result = $conn->query($sql);

    // Verifique se há resultados
    if ($result->num_rows > 0) {
        // Retorne o primeiro ID encontrado
        $row = $result->fetch_assoc();
        $id_ticket = $row["id"];
        $tipo_ticket = $row["tipo"];
        $numero_ticket = $row["numero"];

        // Query SQL para atualizar o estado do registro com o ID encontrado
        $sql_update = "UPDATE tickets SET estado = 'ATENDIMENTO', dia = '$data' WHERE id = $id_ticket";
        $sql_update_atual = "UPDATE atual SET tipo='$tipo_ticket', numero='$numero_ticket', guiche='$guiche' WHERE id = 1";

        // Armazene o valor onde você preferir, como um arquivo de texto ou um banco de dados
        //escreverArquivoTxt($tipo_ticket, $numero_ticket);

        // Execute a query SQL de atualização
        if (
            $conn->query($sql_update) === true &&
            $conn->query($sql_update_atual) === true
        ) {
            // Envie uma resposta de sucesso
            echo json_encode($tipo_ticket . "-" . $numero_ticket);
            //Gera Log da Chamada
            $operacao = "Chamado com sucesso!";
            geraLogTicketChamados($tipo_ticket, $numero_ticket, $operacao, $guiche);
        } else {
            // Envie uma resposta de erro se houver um problema ao atualizar o estado
            echo json_encode([
                "error" =>
                    "Erro ao atualizar o estado do registro no banco de dados (function buscarTicketEAtualizarEstado): " .
                    $conn->error,
            ]);
            //Gera Log da Chamada
            $operacao = json_encode([
                "error" =>
                    "Erro ao atualizar o estado do registro no banco de dados (function buscarTicketEAtualizarEstado): " .
                    $conn->error,
            ]);
            geraLogTicketChamados($tipo_ticket, $numero_ticket, $operacao, $guiche);
        }
    } else {
        // Se não houver acompanhantes com estado 'GERADO', envie uma resposta indicando que não há acompanhantes disponíveis
        echo "Não há tickets do tipo " .
            $tipoTicketChamado .
            " esperando atendimento.";
    }

    // Feche a conexão com o banco de dados
    $conn->close();
}

function repeteTicket($conn, $tipoTicketChamado){
    if ($tipoTicketChamado === "REPETIR") {
        $sql = "SELECT * FROM atual WHERE id = 1";
        $result = $conn->query($sql);

        // Verifique se há resultados
        if ($result->num_rows > 0) {
            // Retorne o primeiro ID encontrado
            $row = $result->fetch_assoc();
            $tipo_ticket = ":" . $row["tipo"] . ":";
            $numero_ticket = $row["numero"];

            $sql_update_atual = "UPDATE atual SET tipo='$tipo_ticket', numero='$numero_ticket' WHERE id = 1";

            // Execute a query SQL de atualização
            if ($conn->query($sql_update_atual) === true) {
                // Envie uma resposta de sucesso
                echo json_encode($tipo_ticket . " " . $numero_ticket);
                //Gera Log da Chamada
                //$operacao = "Chamado com sucesso!";
                //geraLog($tipo_ticket, $numero_ticket, $operacao);
            } else {
                // Envie uma resposta de erro se houver um problema ao atualizar o estado
                echo json_encode([
                    "error" =>
                        "Erro ao atualizar o estado do registro no banco de dados (function repeteTicket): " .
                        $conn->error,
                ]);
                //Gera Log da Chamada
                /*$operacao = json_encode([
                    "error" =>
                        "Erro ao atualizar o estado do registro no banco de dados (function repeteTicket): " .
                        $conn->error,
                ]);*/
                //geraLog($tipo_ticket, $numero_ticket, $operacao);
            }
        }
    } else {
        echo "Não há tickets do tipo";
    }
    // Feche a conexão com o banco de dados
    $conn->close();
}

?>
