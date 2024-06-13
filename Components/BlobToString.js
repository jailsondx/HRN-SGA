/**
 * Converte um Blob em uma string.
 * @param {Blob} blob - O objeto Blob a ser convertido.
 * @returns {Promise<string>} - Uma Promise que resolve para a string convertida.
 */
function blobToString(blob) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();

    reader.onloadend = () => {
      console.log('Leitura do Blob concluída.');
      resolve(reader.result);
    };

    reader.onerror = (error) => {
      console.error('Erro ao ler o Blob:', error);
      reject(error);
    };

    console.log('Iniciando leitura do Blob...');
    reader.readAsText(blob);
  });
}

export default blobToString;
