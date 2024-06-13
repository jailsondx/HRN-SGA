import { iniciarWebSocket } from './WebSocketConnection.js'; // Importa a função para iniciar a conexão WebSocket
import { executarBipe, falarTexto } from '../js/SomChamada.js'; // Importa as funções de som

document.addEventListener('DOMContentLoaded', function() {

const Local = localStorage.getItem('Local_Atendimento');


// Inicia a conexão WebSocket com o identificador 'tv_principal'
iniciarWebSocket('ws://localhost:3001', Local, handleMessage);

/**
 * Função para lidar com a mensagem recebida do WebSocket.
 * @param {string} message - A mensagem recebida do WebSocket.
 */
function handleMessage(message) {
    const ticketChamadoDiv = document.getElementById('ticketChamado'); // Obtém a div onde o texto será exibido
    const guicheChamadoDiv = document.getElementById('guicheChamado'); // Obtém a div onde o texto será exibido
    console.log('Mensagem recebida:', message);

    try {

        // Divide o valor recebido em duas partes usando a vírgula como delimitador
        const valorRecebidoTabelaAtual = message.split(',');
                        
        // Atribui as partes divididas às variáveis
        var novoTicket = valorRecebidoTabelaAtual[0];
        var guiche = valorRecebidoTabelaAtual[1];

        // Atualiza a div com o texto recebido
        ticketChamadoDiv.innerText = novoTicket;
        guicheChamadoDiv.innerText = guiche;
        executarBipe(); // Executa o som de notificação
        falarTexto(ticketChamadoDiv.innerText); // Faz a leitura em voz alta do texto recebido
        falarTexto(guicheChamadoDiv.innerText); // Faz a leitura em voz alta do texto recebido
        //console.log('ticketChamadoDiv: ' + ticketChamadoDiv.innerText);
    } catch (error) {
        console.error('Erro ao processar mensagem:', error);
    }
}

});

console.log('TV UPDATE CHAMADO'); // Log de inicialização do script


