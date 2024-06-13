// WebSocketClient.js

import blobToString from "./BlobToString.js";

const ws = new WebSocket('ws://localhost:3001');

/**
 * Evento disparado quando a conexão com o WebSocket é aberta.
 */
ws.onopen = () => {
  console.log('Conectado ao servidor WebSocket');
  const identifier = 'atendimento_principal'; // Identificador único para este cliente
  ws.send(JSON.stringify({ type: 'register', id: identifier })); // Envia o identificador ao servidor
};

/**
 * Evento disparado quando a conexão com o WebSocket é fechada.
 */
ws.onclose = () => {
  console.log('Desconectado do servidor WebSocket');
};

/**
 * Evento disparado quando uma mensagem é recebida do WebSocket.
 * @param {MessageEvent} event - O evento que contém a mensagem recebida.
 */
ws.onmessage = async (event) => {
  const message = await blobToString(event.data); // Converte o Blob em string
  console.log('Mensagem recebida do Dashboard:', message);
};

/**
 * Função para enviar mensagem para o WebSocket.
 * @param {string} ticketInfo - Informações do ticket a ser enviadas.
 */
export function enviarMensagemWebSocket(ticketInfo) {
  const message = {
    type: 'send', // Tipo de mensagem para indicar envio
    targetId: 'tv_principal', // ID do destinatário
    data: ticketInfo
  };
  ws.send(JSON.stringify(message)); // Envia a mensagem com o identificador do destinatário
}

/**
 * Função para iniciar a conexão WebSocket.
 */
export function iniciarWebSocket() {
  // Nenhuma ação adicional necessária aqui, pois a conexão já é iniciada automaticamente.
}

console.log('ChamaTicketNaTv.js');
