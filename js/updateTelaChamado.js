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
setInterval(ticketNaTV, 1000);