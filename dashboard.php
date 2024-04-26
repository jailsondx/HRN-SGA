<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="icon" href="./imgs/logo.ico" type="image/x-icon">



    <title>Dashboard</title>
</head>
<body>
    <script src="./js/listaTickets.js"></script>
    <script src="./js/chamaTickets.js"></script>
    <script src="./js/contadorAtendimentos.js"></script>

<div class="container">

  <div class="left-column">
      <div class="quadro-infor-tickets">
        <h1><b>Ticket em Atendimento</b></h1>
        <!-- Local onde o valor retornado do banco de dados será exibido -->
       <div id="ticketInfo"></div>
        <!-- Botão para chamar Tickets -->
        <p><button id='btnExibeTicketEmOrdem' type="button" class="btn btn-warning btn-lg btn-block">Chamar Próximo</button></p>
        <div class="botoes">
          <button id='btnExibeTicketAcompanhante' type="button" class="btn btn-primary">Chamar Acompanhante</button>
          <button id='btnExibeTicketVisitante' type="button" class="btn btn-primary">Chamar Visitante</button>
        </div>
      </div>
      <div class="estatisticas">
        <h3>Estatisticas</h3>
        <div class="quadros">
          <div id="Q01">
            <b>Atendimentos realizados hoje</b><br>
            <span id="Q01-dados"></span>
          </div>
          <div id="Q02">TESTE 02</div>
          <div id="Q03">TESTE 03</div>
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