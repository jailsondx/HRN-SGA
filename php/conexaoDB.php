<?php

$servername = "localhost";
$username = "hrn_user";
$password = "@isgh#nti01";
$dbname = "hrn_sga";

$conn = new mysqli($servername, $username, $password, $dbname);
// Verifique a conexão
if ($conn->connect_error) {
    die("ERRO AO CONECTAR COM O BD MYSQLi " . $conn->connect_error . "<br>");
} else {
    //echo "CONEXÃO COM BD MYSQLi REALIZADA COM SUCESSO <br>";
}
