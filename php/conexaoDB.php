<?php
/*
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'hrn_SGS');
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrn_sga";

$conn = new mysqli($servername, $username, $password, $dbname);
// Verifique a conexão
if ($conn->connect_error) {
    die("ERRO AO CONECTAR COM O BD MYSQLi " . $conn->connect_error . "<br>");
} else {
    //echo "CONEXÃO COM BD MYSQLi REALIZADA COM SUCESSO <br>";
}
