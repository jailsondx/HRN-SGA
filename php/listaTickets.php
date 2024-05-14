<?php
include_once 'conexaoDB.php';
include_once 'formataNumeroTicket.php';

//---------------------------VERIFICAÇÃO PARA ATUALIZAR A LISTA DE TICKETS NA TELA DE DASHBOARD--------------------------------------
// Verificar se a requisição é AJAX e, em seguida, chamar a função e imprimir a lista
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo obterTicketsGerados($conn);
}


function obterTicketsGerados($conn) {
    // Verificar conexão
    if ($conn->connect_error) {
       return "Erro ao conectar ao banco de dados: " . $conn->connect_error;
   }

   // Consulta SQL para selecionar os resultados da tabela 'ticket' com estado 'GERADO'
   $sql = "SELECT * FROM tickets WHERE estado = 'GERADO' ORDER BY id LIMIT 20";
   $resultado = $conn->query($sql);

   // Verificar se há resultados
   if ($resultado->num_rows > 0) {
       // Iniciar a saída HTML
       $html = "<ul>";

       // Iterar sobre os resultados e adicionar cada um à saída HTML
       while ($row = $resultado->fetch_assoc()) {
           $html .= "<li>" . $row["tipo"] . " " . formatarNumeroTicket($row["numero"]) . "</li>";
       }

       // Fechar a lista UL
       $html .= "</ul>";
   } else {
       $html = "Nenhum resultado encontrado.";
   }

   // Fechar a conexão com o banco de dados
   $conn->close();

   // Retornar a string HTML resultante
   return $html;
}



?>