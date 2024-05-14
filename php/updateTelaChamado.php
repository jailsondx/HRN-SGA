<?php
require 'conexaoDB.php';
require 'formataNumeroTicket.php';

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Fortaleza');

// Consulta SQL para recuperar o tipo e o número do ticket da tabela 'atual'
$sql = "SELECT * FROM atual";
$resultado = $conn->query($sql);

// Verificar se há resultados
if ($resultado->num_rows > 0) {
    // Retornar o tipo e o número do ticket
    $row = $resultado->fetch_assoc();
    echo $row["tipo"] . " " . formatarNumeroTicket($row["numero"]) . "," . $row["guiche"];
} else {
    echo "Nenhum ticket encontrado";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
