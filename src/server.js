import express from 'express';
import { WebSocketServer } from 'ws';
import http from 'http';

const app = express();
const server = http.createServer(app);
const wss = new WebSocketServer({ server });

const clients = new Map(); // Mapeamento de clientes com identificadores únicos

wss.on('connection', (ws) => {
  ws.on('message', (message) => {
    try {
      const parsedMessage = JSON.parse(message);
      console.log(parsedMessage);
      
      // Registro de clientes
      if (parsedMessage.type === 'register') {
        const id = parsedMessage.id;
        clients.set(id, ws);
        console.log(`Cliente registrado com ID: ${id}`);
      } else if (parsedMessage.type === 'send') {
        // Envia a mensagem para os clientes 'tv_principal' se o remetente for 'Atendimento_Principal'
        if (parsedMessage.sourceId === 'Atendimento_Principal') {
          clients.forEach((client, clientId) => {
            if (clientId.startsWith('tv_principal')) {
              client.send(parsedMessage.data);
            }
          });        
        }
        // Envia a mensagem para os clientes 'tv_emergencia' se o remetente for 'Atendimento_Principal'
        if (parsedMessage.sourceId === 'Atendimento_Emergencia') {
          clients.forEach((client, clientId) => {
            if (clientId.startsWith('tv_emergencia')) {
              client.send(parsedMessage.data);
            }
          });        
        }
      }
    } catch (error) {
      console.error('Erro ao processar mensagem:', error);
    }
  });

  ws.on('close', () => {
    // Remove o cliente do mapa quando ele se desconecta
    for (const [id, client] of clients) {
      if (client === ws) {
        clients.delete(id);
        console.log(`Cliente desconectado com ID: ${id}`);
        break;
      }
    }
  });
});

server.listen(3001, '0.0.0.0', () => {
  console.log('Servidor WebSocket rodando na porta 3001');
});
