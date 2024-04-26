/*
function ticketNaTV() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ticketChamado").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "./Tickets/dados.txt", true);
    xhttp.send();
}

// Atualiza o valor a cada 1 segundo
setInterval(ticketNaTV, 100);
*/
document.addEventListener("DOMContentLoaded", function() {
    // Função para fazer uma requisição AJAX para o PHP e atualizar a div com o ticket
    function atualizarTicket() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ticketChamado").innerText = this.responseText;
            }
        };
        xhr.open("GET", "./php/updateTelaChamado.php", true);
        xhr.send();
    }

    // Atualizar o ticket a cada 1 segundo
    setInterval(atualizarTicket, 1000);

    // Atualizar o ticket imediatamente ao carregar a página
    atualizarTicket();
});
