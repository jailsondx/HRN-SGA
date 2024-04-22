function geraLog(tipoTicket) {
    if (tipoTicket) {
        switch (tipoTicket) {
            case 'A':
                console.log("Geração de Ticket tipo: Acompanhante");
                break;
            case 'V':
                console.log("Geração de Ticket tipo: Visitante");
                break;
        }
    }
}

