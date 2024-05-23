function listaTicketsGerados() {
    $.ajax({
        url: '../php/listaTicketsAnteriores.php', // Arquivo PHP que retorna a lista de tickets gerados
        method: 'GET',
        success: function(data) {
            $('#ticketsAnteriores').html(data); // Atualiza o conteúdo da div com a lista de tickets gerados
        },
        error: function(xhr, status, error) {
            console.error('Erro ao obter tickets gerados:', error); // Exibe erro no console em caso de falha
        }
    });
}

// Chama a função para atualizar a lista de tickets gerados a cada 5 segundos
setInterval(listaTicketsGerados, 5000); // 5000 milissegundos = 5 segundos

// Chama a função para atualizar a lista de tickets gerados imediatamente ao carregar a página
$(document).ready(function() {
    listaTicketsGerados();
});