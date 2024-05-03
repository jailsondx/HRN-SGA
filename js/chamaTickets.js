
document.addEventListener("DOMContentLoaded", function() {
    function exibirTicket(tipo) {
        // Faz uma chamada AJAX para o arquivo PHP
        $.ajax({
            url: './php/chamaTickets.php',
            type: 'POST', // ou 'GET', dependendo da sua configuração no arquivo PHP
            data: { action: tipo }, // Passa o tipo como um parâmetro para o arquivo PHP
            success: function(response) {
                // Trata a resposta do servidor
                $('#ticketInfo').html(response);
                console.log('chamaTickets.js: Ticket no caixa/recepção: ' + response);
            },
            error: function(xhr, status, error) {
                // Trata erros de requisição AJAX
                console.error('chamaTickets.js: ' + xhr.responseText);
            }
        });
    }

    $('#btnExibeTicketAcompanhante').click(function() {
        exibirTicket('btnExibeTicketAcompanhante');
    });

    $('#btnExibeTicketVisitante').click(function() {
        exibirTicket('btnExibeTicketVisitante');
    });

    $('#btnExibeAtendimentoPrioritario').click(function() {
        exibirTicket('btnExibeAtendimentoPrioritario');
    });

    $('#btnExibeOutros').click(function() {
        exibirTicket('btnExibeOutros');
    });

    
    $('#btnExibeTicketEmOrdem').click(function() {
        exibirTicket('btnExibeTicketEmOrdem');
    });

    $('#btnRepeteUltimo').click(function() {
        exibirTicket('btnRepeteUltimo');
    });
    

});

//Função para repetir o ULTIMO ticket chamado
function repeteTicket(ticketrepetido) {
    //$.get("./php/updateTelaChamado.php", function(response) {
    //    $("#ticketInfo").text(response);
    //});
    $("#ticketChamado").text(ticketrepetido);
}
