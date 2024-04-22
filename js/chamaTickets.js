
$(document).ready(function() {
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
});
/*
$(document).ready(function() {
    function exibirTicket(tipo) {
        // Obtém o conteúdo da div
        var ticketInfoContent = $('#ticketInfo').text().trim();
        if (!ticketInfoContent) {
            // Se a div estiver vazia, adiciona o valor "1"
            ticketInfoContent = "1";
            // Atualiza a div com o novo valor
            $('#ticketInfo').text(ticketInfoContent);
        }
        console.log('Ticket Anterior: ' + ticketInfoContent);

        // Faz uma chamada AJAX para o arquivo PHP
        $.ajax({
            url: './php/chamaTickets.php', // Substitua 'arquivo.php' pelo caminho correto do seu arquivo PHP
            type: 'POST', // ou 'GET', dependendo da sua configuração no arquivo PHP
            data: { action: tipo, conteudo: ticketInfoContent }, // Passa o tipo e o conteúdo como parâmetros para o arquivo PHP
            success: function(response) {
                // Trata a resposta do servidor
                var ticketData = JSON.parse(response);
                var ticketAtual = ticketData.ticketAtualExibido;
                var idTicket = ticketData.id_ticket;

                // Atualiza a div com o ticket atual
                $('#ticketInfo').text(ticketAtual);
                console.log('Ticket Atual: ' + ticketAtual);
                console.log('ID do Ticket: ' + idTicket);
                console.log('chamaTickets.js: Função PHP chamada com sucesso!');
            },
            error: function(xhr, status, error) {
                // Trata erros de requisição AJAX
                console.error(xhr.responseText);
                console.log('chamaTickets.js: Erro ao chamar a função PHP.');
            }
        });
    }

    $('#btnExibeTicketAcompanhante').click(function() {
        exibirTicket('btnExibeTicketAcompanhante');
    });

    $('#btnExibeTicketVisitante').click(function() {
        exibirTicket('btnExibeTicketVisitante');
    });
});
*/