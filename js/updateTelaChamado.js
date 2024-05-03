
/*
document.addEventListener("DOMContentLoaded", function() {
    // Função para fazer uma requisição AJAX para o PHP e atualizar a div com o ticket
    function atualizarTicket() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ticketChamado").innerText = this.responseText;
            }
        };
        xhr.open("GET", "./php/updateTelaChamado.php", true);
        xhr.send();
    }

    // Atualizar o ticket a cada 1 segundo
    setInterval(atualizarTicket, 1000);

    // Atualizar o ticket imediatamente ao carregar a página
    atualizarTicket();
});

*/


document.addEventListener("DOMContentLoaded", function() {
    // Função para fazer uma requisição AJAX para o PHP e atualizar a div com o ticket
    function atualizarTicket() {                   
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var ticketChamado = document.getElementById("ticketChamado");
                var novoValor = this.responseText.trim(); // Remove espaços em branco no início e no fim
                var valorAnterior = ticketChamado.innerText.trim();
                //var novoValor = this.responseText;
                //var valorAnterior = ticketChamado.innerText;

                // Verifica se o novo valor é diferente do valor anterior
                if (novoValor !== valorAnterior) {
                    // Adiciona a classe 'flash'
                    ticketChamado.classList.add("flash");

                    // Remove a classe 'flash' após 3 segundos
                    setTimeout(function() {
                        ticketChamado.classList.remove("flash");
                    }, 3000); // 3000 milissegundos = 3 segundos

                    //Execute o BIPE mp3
                    executarBipe();

                    // Falar o novo valor usando a API de Text-to-Speech
                    falarTexto(novoValor);
                }

                // Atualiza o conteúdo da div com o novo valor
                ticketChamado.innerText = novoValor;
            }
        };
        xhr.open("GET", "./php/updateTelaChamado.php", true);
        xhr.send();
    }

    // Atualizar o ticket a cada 1 segundo
    setInterval(atualizarTicket, 1000);

    // Atualizar o ticket imediatamente ao carregar a página
    //atualizarTicket();

    // Função para falar o texto usando a API de Text-to-Speech
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
    
/*
    // Seleciona o botão pelo ID
    var btnRepeteUltimo = document.getElementById("btnRepeteUltimo");

    // Adiciona o evento de clique ao botão
    btnRepeteUltimo.addEventListener("click", function() {
        // Chama a função para falar o texto
        //falarTexto(document.getElementById('ticketInfo').innerText);
        window.speechSynthesis.speak(document.getElementById('ticketInfo').innerText);
    });
});
*/

function executarBipe(){
    var som = new Audio('./sound/Notification.mp3');
    som.play();
}
});
