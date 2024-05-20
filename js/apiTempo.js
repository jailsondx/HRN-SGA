// Código da cidade já definido
const locationKey = '32239'; // Substitua 'YOUR_LOCATION_KEY' pelo código da cidade desejada

// Substitua 'YOUR_API_KEY' pela sua chave de API da AccuWeather
const apiKey = 'ZNqSOZcALTobUAISCOK3QxZYw7SCGg0Y';

// Construa a URL da solicitação para obter as condições climáticas atuais
const currentConditionsUrl = `http://dataservice.accuweather.com/currentconditions/v1/${locationKey}?apikey=${apiKey}&details=true`;

 // Dicionário de tradução
 const translationDictionary = {
    "Sunny": "Ensolarado",
    "Partly sunny": "Parcialmente ensolarado",
    "Cloudy": "Nublado",
    "Some clouds": "Algumas nuvens",
    "Rain": "Chuva",
    "Clear": "Limpo",
    "Partly cloudy": "Parcialmente nublado",
    // Adicione mais traduções conforme necessário
};

// Função para traduzir o texto das condições climáticas
function translateWeatherText(weatherText) {
    return translationDictionary[weatherText] || weatherText;
}

// Função para obter as condições climáticas atuais
async function getCurrentConditions() {
    try {
        const response = await fetch(currentConditionsUrl);
        if (!response.ok) {
            throw new Error(`Erro na solicitação: ${response.status}`);
        }
        const data = await response.json();
        
        // Tratar os dados
        const weather = data[0];
        const localObservationTime = weather.LocalObservationDateTime;
        const weatherText = translateWeatherText(weather.WeatherText);
        const hasPrecipitation = weather.HasPrecipitation;
        const isDayTime = weather.IsDayTime;
        const temperatureMetric = weather.Temperature.Metric.Value;
        const temperatureImperial = weather.Temperature.Imperial.Value;
        const mobileLink = weather.MobileLink;
        const link = weather.Link;

        // Atualizar a div com ID 'weather-info'
        const weatherInfoDiv = document.getElementById('weather-info');
        weatherInfoDiv.innerHTML = `
            <strong>Temperatura:</strong> ${temperatureMetric}°C<br>
            <strong>Condições Climáticas:</strong> ${weatherText}<br>
            <strong>Precipitação:</strong> ${hasPrecipitation ? 'Sim' : 'Não'}</br>
            <strong>Período do Dia:</strong> ${isDayTime ? 'Diurno' : 'Noturno'}

        `;
    } catch (error) {
        console.error('Erro ao obter as condições climáticas:', error);
    }
}
  
  // Chamar a função para obter as condições climáticas
  getCurrentConditions();


/*
  const weatherInfoDiv = document.getElementById('weather-info');
  weatherInfoDiv.innerHTML = `
      <p><strong>Data e Hora da Observação Local:</strong> ${localObservationTime}</p>
      <p><strong>Condições Climáticas:</strong> ${weatherText}</p>
      <p><strong>Precipitação:</strong> ${hasPrecipitation ? 'Sim' : 'Não'}</p>
      <p><strong>Período do Dia:</strong> ${isDayTime ? 'Diurno' : 'Noturno'}</p>
      <p><strong>Temperatura:</strong> ${temperatureMetric}°C (${temperatureImperial}°F)</p>
      <p><a href="${mobileLink}" target="_blank">Link para Mobile</a></p>
      <p><a href="${link}" target="_blank">Link para Web</a></p>
  `;
  */