let ws; // Variável para armazenar a conexão WebSocket

/**
 * Função para iniciar a conexão WebSocket.
 * @param {string} url - A URL do servidor WebSocket.
 * @param {string} identifier - O identificador único para este cliente.
 * @param {function} handleMessage - Função para lidar com mensagens recebidas.
 */
export function iniciarWebSocket(url, identifier, handleMessage) {
  ws = new WebSocket(url);

  // Evento disparado quando a conexão com o WebSocket é aberta
  ws.onopen = () => {
    console.log('Conectado ao servidor WebSocket com ID: ' + identifier);
    // Registra este cliente com o identificador fornecido
    ws.send(JSON.stringify({ type: 'register', id: identifier }));
  };

  // Evento disparado quando a conexão com o WebSocket é fechada
  ws.onclose = () => {
    console.log('Desconectado do servidor WebSocket');
  };

  // Evento disparado quando uma mensagem é recebida do WebSocket
  ws.onmessage = (event) => {
    const message = event.data; // Obtém a mensagem recebida
    handleMessage(message); // Chama a função de tratamento de mensagem fornecida
  };
}

/**
 * Função para enviar mensagem via WebSocket.
 * @param {string} message - A mensagem a ser enviada.
 * @param {string} sourceId - O identificador da origem da mensagem.
 */
export function enviarMensagemWebSocket(message, sourceId) {
  if (ws && ws.readyState === WebSocket.OPEN) {
    ws.send(JSON.stringify({ type: 'send', sourceId: sourceId, data: message }));
  } else {
    console.error('Erro ao enviar mensagem: conexão WebSocket não está aberta.');
  }
}
