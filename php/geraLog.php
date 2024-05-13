<?php
function geraLog($tipoTicket, $numero, $operacao){
    //função que escreve os tickets em txt
    //Cria o log; se der erro na pasta dar acesso chmod 777
    $hoje = date("d-m-Y");
    $data = date("d-m-Y H-i-s");
    $ip = getIp();

    $msg = "\n\n[".$data."]\nIP de Origem do Evento: " . $ip . "\nTicket: " . $tipoTicket . "-" . $numero . "\nOperação: " . $operacao;
    $fp = fopen("../Tickets/Tickets_Logs ".$hoje.".txt",'a+');
    fwrite($fp,$msg); 
    fclose($fp);
}

function geraLogTicketGerados($tipoTicket, $numero, $operacao){
        //função que escreve os tickets em txt
    //Cria o log; se der erro na pasta dar acesso chmod 777
    $hoje = date("d-m-Y");
    $data = date("d-m-Y H-i-s");
    $ip = getIp();

    $msg = "\n\n[".$data."]\nIP de Origem do Evento: " . $ip . "\nTicket: " . $tipoTicket . "-" . $numero . "\nOperação: " . $operacao;
    $fp = fopen("../Tickets/Gerados/Tickets_Gerados ".$hoje.".txt",'a+');
    fwrite($fp,$msg); 
    fclose($fp);
}

function geraLogTicketChamados($tipoTicket, $numero, $operacao, $guiche){
    //função que escreve os tickets em txt
    //Cria o log; se der erro na pasta dar acesso chmod 777
    $hoje = date("d-m-Y");
    $data = date("d-m-Y H-i-s");
    $ip = getIp();

    $msg = "\n\n[".$data."]\nIP de Origem do Evento: " . $ip . "\nTicket: " . $tipoTicket . "-" . $numero . "\nGuiche: " . $guiche ."\nOperação: " . $operacao;
    $fp = fopen("../Tickets/Chamados/Tickets_Chamados ".$hoje.".txt",'a+');
    fwrite($fp,$msg); 
    fclose($fp);
}

//função que pega o IP do computador
function getIp() {

   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
       $ip = $_SERVER['HTTP_CLIENT_IP'];

   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

   } else {
       $ip = $_SERVER['REMOTE_ADDR'];
   }

   return $ip;
}
?>