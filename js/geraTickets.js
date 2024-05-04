
document.addEventListener("DOMContentLoaded", function() {
    function exibirTicket(tipo) {
        // Faz uma chamada AJAX para o arquivo PHP
        $.ajax({
            url: '../php/geraTickets.php',
            type: 'POST', // ou 'GET', dependendo da sua configuração no arquivo PHP
            data: { action: tipo }, // Passa o tipo como um parâmetro para o arquivo PHP
            success: function(response) {
                // Trata a resposta do servidor
                console.log('geraTickets.js: Ticket (geraTickets.php)' + response);
            },
            error: function(xhr, status, error) {
                // Trata erros de requisição AJAX
                console.error('geraTickets.js: ' + xhr.responseText);
            }
        });
    }

    $('#A').click(function() {
        exibirTicket('A');
        //window.location.href = "cliente.html";
    });

    $('#V').click(function() {
        exibirTicket('V');
        //window.location.href = "cliente.html";
    });

    $('#AP').click(function() {
        exibirTicket('AP');
        //window.location.href = "cliente.html";
    });
    
    $('#VA').click(function() {
        exibirTicket('VA');
        //window.location.href = "../cliente.html";
    });
    
    $('#CE').click(function() {
        exibirTicket('CE');
        //window.location.href = "../cliente.html";
    });


});