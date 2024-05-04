function geraLog(tipoTicket) {
    if (tipoTicket) {
        switch (tipoTicket) {
            case 'A':
                console.log("Geração de Ticket tipo: Acompanhante");
                break;
            case 'V':
                console.log("Geração de Ticket tipo: Visitante");
                break;
            case 'AP':
                console.log("Geração de Ticket tipo: Atendimento Prioritario");
                break;
            case 'VA':
                console.log("Geração de Ticket tipo: Visita Administrativa");
                break;
            case 'CE':
                console.log("Geração de Ticket tipo: Credencial Esquecida");
                break;
            case 'SS':
                console.log("Geração de Ticket tipo: Serviço Social");
                break;
        }
    }
}

