// Código da cidade já definido
const locationKey = '32239'; // Substitua 'YOUR_LOCATION_KEY' pelo código da cidade desejada

// Substitua 'YOUR_API_KEY' pela sua chave de API da AccuWeather
const apiKey = 'ZNqSOZcALTobUAISCOK3QxZYw7SCGg0Y';

// Construa a URL da solicitação para obter as condições climáticas atuais
const currentConditionsUrl = `http://dataservice.accuweather.com/currentconditions/v1/${locationKey}?apikey=${apiKey}&details=true`;

// Faça a solicitação para obter as condições climáticas atuais
fetch(currentConditionsUrl)
    .then(response => {
        // Verifique se a resposta está OK (status 200)
        if (!response.ok) {
            throw new Error('Erro ao buscar os dados da AccuWeather');
        }
        // Converta a resposta para JSON
        return response.json();
    })
    .then(data => {
        // Verifique se há resultados
        if (data.length === 0) {
            console.error('Não foi possível obter as condições climáticas atuais.');
            return;
        }

        // Exiba as informações de condições climáticas atuais na página
        const weatherInfo = data[0];
        document.getElementById("weather-info").innerHTML = 
            "<h2>Sobral, CE</h2>"+
            "<p>Temperatura: ${weatherInfo.Temperature.Metric.Value} ${weatherInfo.Temperature.Metric.Unit}</p>"+
            "<p>Clima: ${weatherInfo.WeatherText}</p>";
    })
    .catch(error => {
        console.error('Erro ao buscar os dados da AccuWeather:', error);
        //alert('Erro ao buscar os dados da AccuWeather. Por favor, tente novamente mais tarde.');
        document.getElementById("weather-info").innerHTML = 
            "<h2>Sobral, CE</h2>"+
            "<p>Temperatura: --</p>"+
            "<p>Clima: ---</p>";
    });


    //<p>Última atualização: ${new Date(weatherInfo.LocalObservationDateTime).toLocaleString()}</p>