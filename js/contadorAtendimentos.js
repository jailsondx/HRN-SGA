// Caminho do arquivo TXT
const filePath = './Tickets/Tickets_Logs '+getDate()+'.txt';

// Palavras específicas que queremos contar
const wordsToCount = ['Acompanhante', 'Visitante'];

// Função para ler o arquivo de texto
function readFile(filePath, callback) {
    fetch(filePath)
        .then(response => response.text())
        .then(text => callback(text))
        .catch(error => console.error('Erro ao ler o arquivo:', error));
}

// Função para contar ocorrências de palavras específicas
function countWords(text, words) {
    const wordCounts = {};
    const lines = text.split('\n');

    lines.forEach(line => {
        words.forEach(word => {
            const regex = new RegExp('\\b' + word + '\\b', 'gi');
            const matches = line.match(regex);
            if (matches) {
                wordCounts[word] = (wordCounts[word] || 0) + matches.length;
            }
        });
    });

    return wordCounts;
}

// Função para exibir os resultados na div "result"
function displayResults(results) {
    const resultDiv = document.getElementById('Q01-dados');
    //let html = 'Atendimentos Totais Hoje';
    let html = '<table><tr><td id="td-ico"><img src="./imgs/silhueta-do-grupo-de-usuarios.png" id="icons-estatisticas"></td><td>';
    Object.keys(results).forEach(word => {
        html += word + ': ' + results[word] + '<br>';
    });
    html += '</td></tr></table>';
    resultDiv.innerHTML = html;
}

//Função GETDATA
function getDate() {
    // Criar um novo objeto Date
    const today = new Date();
    
    // Extrair o ano, mês e dia
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Os meses são indexados a partir de zero, então adicionamos 1
    const day = String(today.getDate()).padStart(2, '0');
    
    // Formatar a data no formato desejado (por exemplo, DD-MM-YYYY)
    const formattedDate = day + '-' + month + '-' + year;
    
     // Saída: 31-03-2023 (para 31 de março de 2023)
    console.log(formattedDate);
    return formattedDate;
    
}

// Função para atualizar as informações a cada 5 segundos
function updateInfo() {
    // Caminho do arquivo TXT
    const filePath = './Tickets/Tickets_Logs ' + getDate() + '.txt';

    // Ler o arquivo de texto e contar as ocorrências das palavras específicas
    readFile(filePath, text => {
        const wordCounts = countWords(text, wordsToCount);
        displayResults(wordCounts);
    });
}


// Atualizar as informações imediatamente ao carregar a página
updateInfo();

// Atualizar as informações a cada 5 segundos
setInterval(updateInfo, 5000);