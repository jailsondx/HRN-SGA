<!DOCTYPE html>
<html lang="pr-bt">
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

<div class="container">

  <div class="left-column">
    <h1>Ticket em Atendimento</h1>
        <!-- Local onde o valor retornado do banco de dados será exibido -->
       <div id="ticketInfo"></div>
        <!-- Botão para chamar Tickets -->
        <p><button id='btnExibeTicketEmOrdem' type="button" class="btn btn-warning btn-lg btn-block">Chamar Próximo</button></p>
        <button id='btnExibeTicketAcompanhante' type="button" class="btn btn-primary">Chamar Acompanhante</button>
        <button id='btnExibeTicketVisitante' type="button" class="btn btn-primary">Chamar Visitante</button>
        
        <div class="square-container">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
  </div>

  <div class="right-column">
    <h2>Próximos Tickets</h2>
    <div id="tickets"> <!-- Aqui será exibida a lista de tickets gerados --> </div>

  </div>
</div>

</body>
</html>