document.addEventListener("DOMContentLoaded", function() {

// Seleciona o elemento select
var select = document.getElementById('defineGuiche');

// Adiciona um evento de mudança ao select
select.addEventListener('change', function() {
    // Obtém o valor selecionado
    var valorSelecionado = select.value;
    
    // Salva o valor selecionado no localStorage
    localStorage.setItem('Guiche', valorSelecionado);
});

// Verifica se há um valor previamente salvo no localStorage
var valorSalvo = localStorage.getItem('Guiche');

// Se houver um valor salvo, define o valor do select para ele
if (valorSalvo) {
    select.value = valorSalvo;
}

});
