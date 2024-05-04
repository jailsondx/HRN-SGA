function displayTime() {
    var date = new Date();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var day = date.getDate();
    var month = date.getMonth() + 1; // Os meses em JavaScript são baseados em zero, então adicionamos 1 para obter o mês correto
    var year = date.getFullYear();
    
    // Formata os minutos, segundos, dia e mês para terem sempre dois dígitos
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    day = day < 10 ? '0' + day : day;
    month = month < 10 ? '0' + month : month;
    
    var timeString = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes + ':' + seconds;
    document.getElementById('clock').innerHTML = timeString;
}

// Chama a função displayTime a cada segundo para atualizar o relógio
setInterval(displayTime, 1000);
