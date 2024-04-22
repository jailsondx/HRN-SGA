<?php
include_once 'conexaoDB.php';


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

        // Armazene o valor onde você preferir, como um arquivo de texto ou um banco de dados
        escreverArquivoTxt($tipo_ticket, $numero_ticket);
        
        // Execute a query SQL de atualização
        if ($conn->query($sql_update) === TRUE) {
            // Envie uma resposta de sucesso 
            echo json_encode($tipo_ticket . "-" . $numero_ticket);
        } else {
            // Envie uma resposta de erro se houver um problema ao atualizar o estado
            echo json_encode(array('error' => 'Erro ao atualizar o estado do registro no banco de dados: ' . $conn->error));
        }
    } else {
        // Se não houver acompanhantes com estado 'GERADO', envie uma resposta indicando que não há acompanhantes disponíveis
        echo ('Não há tickets do tipo ' . $tipoTicketChamado . ' esperando atendimento.');
    }
    
    // Feche a conexão com o banco de dados
    $conn->close();
}

function escreverArquivoTxt($tipo_ticket, $numero_ticket) {
    $conteudo = $tipo_ticket . "-" . $numero_ticket;
    $nome_arquivo = '../Tickets/dados.txt'; // Nome do arquivo onde os dados serão armazenados

    // Escreve o conteúdo no arquivo, sobrescrevendo qualquer conteúdo anterior
    if (file_put_contents($nome_arquivo, $conteudo) !== false) {
        echo "<script>console.log('Conteúdo escrito no arquivo com sucesso!');</script>";
    } else {
        echo "Erro ao escrever no arquivo!";
    }
}

?>