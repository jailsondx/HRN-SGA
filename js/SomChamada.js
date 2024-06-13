/**
 * Executa um som de notificação.
 */
function executarBipe() {
    var som = new Audio('../sound/Notification.mp3');
    som.play();
  }
  
  /**
   * Fala o texto usando a API de Text-to-Speech.
   * @param {string} texto - O texto a ser falado.
   */
  function falarTexto(texto) {
    // Verifica se a API de SpeechSynthesis está disponível no navegador
    if ('speechSynthesis' in window) {
      // Cria um novo objeto SpeechSynthesisUtterance
      var utterance = new SpeechSynthesisUtterance(texto);
  
      // Fala o texto
      window.speechSynthesis.speak(utterance);
    } else {
      console.error('API de Text-to-Speech não suportada neste navegador.');
    }
  }
  
  // Exporta as funções usando exportação nomeada
  export { executarBipe, falarTexto };
  