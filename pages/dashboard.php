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

<div class="container">

  <div class="left-column">
      <div class="quadro-infor-tickets">
        <h1><b>Ticket em Atendimento</b></h1>
        <!-- Local onde o valor retornado do banco de dados será exibido -->
       <div id="ticketInfo"></div>
       
        <!-- Botão para chamar Tickets -->
        <div class="botoesSup">
          <button id='btnExibeTicketEmOrdem' type="button" class="btn btn-warning">Chamar Próximo</button>
          <button id='btnRepeteUltimo' type="button" class="btn btn-secondary">Chamar Novamente o Ultimo</button>
        </div>
        <div class="botoesInf">
          <button id='btnExibeTicketAcompanhante' type="button" class="btn btn-primary">Chamar Acompanhante</button>
          <button id='btnExibeTicketVisitante' type="button" class="btn btn-primary">Chamar Visitante</button>
          <button id='btnExibeInternacao' type="button" class="btn btn-primary">Chamar Internação</button>
          <button id='btnExibeAtendimentoPrioritario' type="button" class="btn btn-primary">Chamar Atendimento Prioritario</button>
          
          <button id='btnExibeDHO' type="button" class="btn btn-primary">Chamar DHO</button>
          <button id='btnExibeSESMT' type="button" class="btn btn-primary">Chamar SESMT</button>
          <button id='btnExibeSemCredencial' type="button" class="btn btn-primary">Chamar Sem Credencial</button>
          <button id='btnExibeVisitaAdministrativa' type="button" class="btn btn-primary">Chamar Visita Administrativa</button>
          
          <button id='btnExibeExames' type="button" class="btn btn-primary">Chamar Entrega de Exames</button>
          <button id='btnExibeInformacoes' type="button" class="btn btn-primary">Chamar Informações</button>
        </div>
      </div>
      <div class="estatisticas">
        <h3>Estatisticas</h3>
        <div class="quadros">
          
          <div id="Q01">
            <span class="titulos_quadros"><b>Atendimentos realizados hoje</b></span><br>
            <span id="Q01-dados"></span>
          </div>
          
          <div id="Q02">TESTE 02</div>
          
          <div id="Q03">
          <span class="titulos_quadros"><b>Guichê</b></span><br>
            <select id="defineGuiche">
              <option value="null">---</option>
              <option value="Guiche 01">guichê 01</option>
              <option value="Guiche 02">guichê 02</option>
            </select>
          </div>

        </div>
      </div>

  </div>
        
  <div class="right-column">
          <h2>Próximos Tickets</h2>
        <div id="tickets"> <!-- Aqui será exibida a lista de tickets gerados --> </div>

  </div>

</div><!--FIM DIV CONTAINER-->


</body>
</html>