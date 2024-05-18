
document.addEventListener("DOMContentLoaded", function() {
    function exibirTicket(tipo) {
        // Faz uma chamada AJAX para o arquivo PHP
        $.ajax({
            url: '../php/geraTickets.php',
            type: 'POST', // ou 'GET', dependendo da sua configuração no arquivo PHP
            data: { action: tipo }, // Passa o tipo como um parâmetro para o arquivo PHP
            success: function(response) {
                // Trata a resposta do servidor
                var data = {
                    'Arquivo JS': 'geraTickets.js',
                    'Arquivo PHP': 'geraTickets.php',
                    'Ticket gerado': response
                };
                console.table(data);
            },
            error: function(xhr, status, error) {
                // Trata erros de requisição AJAX
                console.error('ERROR: geraTickets.js (Resposta recebida do geraTickets.php): ' + xhr.responseText);
            }
        });
    }

    $('#A').click(function() {
        exibirTicket('A');
        //window.location.href = "totem.html";
    });

    $('#V').click(function() {
        exibirTicket('V');
        //window.location.href = "totem.html";
    });

    $('#I').click(function() {
        exibirTicket('I');
        //window.location.href = "totem.html";
    });
    
    $('#AP').click(function() {
        exibirTicket('AP');
        //window.location.href = "../totem.html";
    });

    $('#DHO').click(function() {
        exibirTicket('DHO');
        window.location.href = "totem.html";
    });

    $('#SESMT').click(function() {
        exibirTicket('SESMT');
        window.location.href = "totem.html";
    });
    
    $('#SC').click(function() {
        exibirTicket('SC');
        window.location.href = "totem.html";
    });

    $('#EX').click(function() {
        exibirTicket('EX');
        window.location.href = "totem.html";
    });

    $('#VA').click(function() {
        exibirTicket('VA');
        window.location.href = "totem.html";
    });

    $('#INF').click(function() {
        exibirTicket('INF');
        window.location.href = "totem.html";
    });


});