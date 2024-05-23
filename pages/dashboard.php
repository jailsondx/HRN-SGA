<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- BOOTBOX -->
    <script src="../libs/js/bootbox.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <!-- POPPINSJS -->
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.5"></script>

    <!-- Links Proprios -->
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="icon" href="../imgs/logo.ico" type="image/x-icon">



    <title>Dashboard</title>
</head>
<body>
    <script type="module" src="../js/listaTickets.js"></script>
    <script type="module" src="../js/chamaTickets.js"></script>
    <script type="module" src="../js/contadorAtendimentos.js"></script>
    <script type="module" src="../js/defineGuiche.js"></script>

    <!-- <script type="module" src="../js/apiTempo.js"></script> -->

<div class="container">

  <div class="left-column">
      <div class="quadro-infor-tickets">
        <h1><b>Ticket em Atendimento</b></h1>
        <!-- Local onde o valor retornado do banco de dados será exibido -->
       <div id="ticketInfo"></div>
       
        <!-- Botão para chamar Tickets -->
        <div class="botoesSup">
          <button id='btnChamaTicketEmOrdem' type="button" class="btn btn-warning">Chamar Próximo</button>
          <button id='btnRepeteUltimo' type="button" class="btn btn-secondary">Chamar Novamente o Ultimo</button>
        </div>
        <div class="botoesInf">
          <button id='btnChamaTicketAcompanhante' type="button" class="btn btn-success">Chamar Acompanhante</button>
          <button id='btnChamaTicketVisitante' type="button" class="btn btn-success">Chamar Visitante</button>
          <button id='btnChamaInternacao' type="button" class="btn btn-success">Chamar Internação</button>
          <button id='btnChamaAtendimentoPrioritario' type="button" class="btn btn-success">Chamar Atendimento Prioritario</button>
          
          <button id='btnChamaDHO' type="button" class="btn btn-success">Chamar DHO</button>
          <button id='btnChamaSESMT' type="button" class="btn btn-success">Chamar SESMT</button>
          <button id='btnChamaEsquecimentoCracha' type="button" class="btn btn-success">Chamar Esquecimento de Crachá</button>
          <button id='btnChamaVisitaAdministrativa' type="button" class="btn btn-success">Chamar Visita Administrativa</button>
          
          <button id='btnChamaExames' type="button" class="btn btn-success">Chamar Entrega de Exames</button>
          <button id='btnChamaInformacoes' type="button" class="btn btn-success">Chamar Informações</button>
        </div>
      </div>
      <div class="estatisticas">
      <div class="titulo-left-column"><b>Estatisticas</b></div>
        <div class="quadros">
          
          <div id="Q01">
            <span class="titulos-quadros"><b>Atendimentos realizados hoje</b></span><br>
            <span id="Q01-dados"></span>
          </div>
          
          <div id="Q02">
          <!--
           <span class="titulos-quadros"><b>Sobral - CE </b></span>
           <div id="weather-info"></div>
           <img src="../imgs/icone_tempo.png" id="img_tempo">
          -->
          </div>
          
          <div id="Q03">
          <span class="titulos-quadros"><b>Guichê</b></span><br>
            <select id="defineGuiche">
              <option value="null">---</option>
              <option value="Guiche 01">Guichê 01</option>
              <option value="Guiche 02">Guichê 02</option>
            </select>
          </div>

        </div>
      </div>

  </div>
        
  <div class="right-column">
    <div class="titulo-right-column"><b>Próximos Tickets</b></div>
    <div id="tickets"> <!-- Aqui será exibida a lista de tickets gerados --> </div>
    <div class="version">v1.1</div>
  </div>

</div><!--FIM DIV CONTAINER-->


</body>
</html>