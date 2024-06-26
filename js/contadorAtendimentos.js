// Caminho do arquivo TXT
const filePath = `../Tickets/Chamados/Tickets_Chamados ${getDate()}.txt`;

// Palavras específicas que queremos contar
const wordsToCount = ['A', 'V', 'I', 'AP', 'DHO', 'SESMT', 'SC', 'VA', 'EX', 'INF'];




// Função para ler o arquivo de texto
async function readFile(filePath) {
    try {
        const response = await fetch(filePath);
        return await response.text();
    } catch (error) {
        console.error('Erro ao ler o arquivo:', error);
    }
}




//--------------------------------------------------------------------------------------------------------------------------------------
// Função para contar ocorrências de palavras específicas
function countWords_Estratificado(text, words) {
    const wordCounts = words.reduce((acc, word) => {
        acc[word] = 0;
        return acc;
    }, {});

    text.split('\n').forEach(line => {
        words.forEach(word => {
            const regex = new RegExp(`\\b${word}\\b`, 'gi');
            const matches = line.match(regex);
            if (matches) wordCounts[word] += matches.length;
        });
    });

    return wordCounts;
}

// Função para exibir os resultados na div "result"
function displayResults_Estratificado(results) {
    const resultDiv = document.getElementById('Q01-dados');
    const html = `
        <table>
            <tr>
                <td id="td-ico">
                    <img src="../imgs/icone_quantidade.png" id="icons-estatisticas">
                </td>
                <td>
                    ${Object.entries(results).map(([word, count]) => `${word}: ${count}`).join('<br>')}
                </td>
            </tr>
        </table>
    `;
    resultDiv.innerHTML = html;
}
//-------------------------------------------------------------------------------------------------------------------------------------





//--------------------------------------------------------------------------------------------------------------------------------------
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

// Função para exibir o total de contagens na div "result"
function displayTotalCount(results) {
    const resultDiv = document.getElementById('Q01-dados');
    const totalCount = Object.values(results).reduce((sum, count) => sum + count, 0);
    resultDiv.innerHTML = `
        <table>
            <tr>
                <td id="td-ico">
                    <img src="../imgs/icone_quantidade.png" id="icons-estatisticas">
                </td>
                <td>
                    ${totalCount}
                </td>
            </tr>
        </table>
    `;
}
//--------------------------------------------------------------------------------------------------------------------------------------






//--------------------------------------------------------------------------------------------------------------------------------------
// Função GETDATA
function getDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); 
    const day = String(today.getDate()).padStart(2, '0');
    return `${day}-${month}-${year}`;
}

// Função para atualizar as informações
async function updateInfo() {
    const text = await readFile(filePath);
    if (text) {
        const wordCounts = countWords(text, wordsToCount);
        displayTotalCount(wordCounts);
    }
}
//--------------------------------------------------------------------------------------------------------------------------------------






// Atualizar as informações imediatamente ao carregar a página
updateInfo();

// Atualizar as informações a cada 5 segundos
setInterval(updateInfo, 60000);