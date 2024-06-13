document.addEventListener('DOMContentLoaded', function() {
    const localStorageKey = 'Local_Atendimento';
    const localStorage_Atendimento = localStorage.getItem('Local_Atendimento');
    const telaChamada = document.getElementById('Conteudo'); // Elemento que contém o conteúdo da página
    const formSelecao = document.getElementById('selectLocal'); // Elemento select para escolha do local de atendimento
  

    // Verifica se já existe um valor no LocalStorage e preenche o select se houver
    if (localStorage_Atendimento) {
        console.log('Recepção: ' + localStorage_Atendimento);
      exibirConteudoPagina();
    } else {
        console.log('Recepção: NÃO DEFINIDA');
      exibirSelecaoLocal();
    }
  
    // Evento disparado ao enviar o formulário
    document.getElementById('formLocalAtendimento').addEventListener('submit', function(event) {
      //event.preventDefault(); // Evita o envio padrão do formulário
  
      // Obtém o valor selecionado
      const selectedValue = localAtendimento.value;
  
      // Armazena o valor escolhido no LocalStorage
      localStorage.setItem(localStorageKey, selectedValue);
  
      // Exibe uma mensagem ou realiza outra ação após armazenar o valor (opcional)
      alert('Local de Atendimento salvo com sucesso!');
  
      // Após salvar, exibe o conteúdo da página
      exibirConteudoPagina();
    });
  
    function exibirConteudoPagina() {
      telaChamada.style.display = 'block';
      formSelecao.style.display = 'none';
    }
  
    function exibirSelecaoLocal() {
      telaChamada.style.display = 'none';
      formSelecao.style.display = 'flex';
    }
  
    console.log('Verifica LocalStorage');
  });
  