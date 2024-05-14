document.addEventListener("DOMContentLoaded", function() {

    // Função para fazer uma requisição AJAX para o PHP e atualizar a div com o ticket
    function atualizarTicket() {                   
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var ticketChamado = document.getElementById("ticketChamado");
                
                // Divide o valor recebido em duas partes usando a vírgula como delimitador
                const valorRecebidoTabelaAtual = this.responseText.split(',');
                        
                // Atribui as partes divididas às variáveis
                var novoTicket = valorRecebidoTabelaAtual[0];
                var guiche = valorRecebidoTabelaAtual[1];
                
                //var novoTicket = this.responseText.trim(); // Remove espaços em branco no início e no fim
                novoTicket = novoTicket.trim(); // Remove espaços em branco no início e no fim

                var ticketAnterior = ticketChamado.innerText.trim();
                //var novoTicket = this.responseText;
                //var ticketAnterior = ticketChamado.innerText;

                // Verifica se o novo valor é diferente do valor anterior
                if (novoTicket !== ticketAnterior) {
                    // Adiciona a classe 'flash'
                    ticketChamado.classList.add("flash");

                    // Remove a classe 'flash' após 3 segundos
                    setTimeout(function() {
                        ticketChamado.classList.remove("flash");
                    }, 3000); // 3000 milissegundos = 3 segundos

                    //Execute o BIPE mp3
                    executarBipe();

                    // Falar o novo valor usando a API de Text-to-Speech
                    falarTexto(novoTicket);
                    falarTexto(guiche);

                    //$('#Guiche').html(selectedOption);
                }

                // Atualiza o conteúdo da div com o novo valor
                ticketChamado.innerText = novoTicket;
                guicheChamado.innerText = guiche;
            }
        };
        xhr.open("GET", "../php/updateTelaChamado.php", true);
        xhr.send();
    }

    // Atualizar o ticket a cada 1 segundo
    setInterval(atualizarTicket, 1000);

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
    

function executarBipe(){
    var som = new Audio('../sound/Notification.mp3');
    som.play();
}
});

