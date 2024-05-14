document.addEventListener("DOMContentLoaded", function() {
    function exibirTicket(tipo, guiche) {

        if ((guiche === null) || (guiche === '---') || (guiche === 'null')){

        // Exibe um alerta com a mensagem definida e o título 'Guiche'
        bootbox.alert({
            title: 'AVISO',
            message: 'O Guichê não pode ser vazio, favor escolher um guichê'
        });

        }else{
        // Faz uma chamada AJAX para o arquivo PHP
        $.ajax({
            url: '../php/chamaTickets.php',
            type: 'POST', // ou 'GET', dependendo da sua configuração no arquivo PHP
            data: { tipo: tipo, guiche: guiche }, // Passa o tipo como um parâmetro para o arquivo PHP
            success: function(response) {
                // Trata a resposta do servidor
                $('#ticketInfo').html(response);

                // Define o valor de selectedGuiche no elemento com id guicheChamado
                //document.getElementById('guicheChamado').innerText = selectedGuiche;

                var data = {
                    'Arquivo': 'chamaTickets.js',
                    'Ticket chamado caixa/recepção': response,
                    'Guiché': recebeGuiche()
                };
                console.table(data);
            },
            error: function(xhr, status, error) {
                // Trata erros de requisição AJAX
                console.error('chamaTickets.js: ' + xhr.responseText);
            }
        });
    }
}
    $('#btnExibeTicketAcompanhante').click(function() {
        exibirTicket('A', recebeGuiche());
    });

    $('#btnExibeTicketVisitante').click(function() {
        exibirTicket('V', recebeGuiche());
    });

    $('#btnExibeInternacao').click(function() {
        exibirTicket('I', recebeGuiche());
    });

    $('#btnExibeAtendimentoPrioritario').click(function() {
        exibirTicket('AP', recebeGuiche());
    });

    $('#btnExibeDHO').click(function() {
        exibirTicket('DHO', recebeGuiche());
    });

    $('#btnExibeSESMT').click(function() {
        exibirTicket('SESMT', recebeGuiche());
    });

    $('#btnExibeSemCredencial').click(function() {
        exibirTicket('SC', recebeGuiche());
    });

    $('#btnExibeVisitaAdministrativa').click(function() {
        exibirTicket('VA', recebeGuiche());
    });

    $('#btnExibeExames').click(function() {
        exibirTicket('EX', recebeGuiche());
    });

    $('#btnExibeInformacoes').click(function() {
        exibirTicket('INF', recebeGuiche());
    });

    //Botões 'Especiais'
    $('#btnExibeTicketEmOrdem').click(function() {
        exibirTicket('btnExibeTicketEmOrdem', recebeGuiche());
    });

    $('#btnRepeteUltimo').click(function() {
        exibirTicket('btnRepeteUltimo', recebeGuiche());
    });
    
});


function recebeGuiche(){
    var selectedGuiche = localStorage.getItem('Guiche');

// Verifica se há um valor armazenado
    if (selectedGuiche !== null) {
        // Define o valor do select para o valor armazenado
        document.getElementById('defineGuiche').value = selectedGuiche;
    }
    return selectedGuiche;
}


