
const API_KEY = "5b00684f02da1f25a31a387bb21ba0b4" // todo .env
// node elt
const meteoInfo = document.getElementById("meteo-info")
const meteoTemperature = document.getElementById("meteo-temperature")
const meteoTown = document.getElementById("meteo-town")
const meteoIcon = document.getElementById("meteo-icon")

const tempHour = [
    document.querySelector("#h3"),
    document.querySelector("#h6"),
    document.querySelector("#h9"),
    document.querySelector("#h12"),
    document.querySelector("#h15"),
    document.querySelector("#h18"),
    document.querySelector("#h21"),
]

const tempDay = [
    document.querySelector("#d1"),
    document.querySelector("#d2"),
    document.querySelector("#d3"),
    document.querySelector("#d4"),
    document.querySelector("#d5"),
    document.querySelector("#d6"),
    document.querySelector("#d7"),
]

// ast auth & get lat/lon of town
navigator.geolocation.getCurrentPosition(
    pos => apiMeteoUrl(pos),
    e => console.error(e))

// get API URL with (latitude,longitude)
let apiMeteoUrl = function(pos){
    const API_URL = `https://api.openweathermap.org/data/2.5/onecall?lat=${pos.coords.latitude}&lon=${pos.coords.longitude}&appid=${API_KEY}&units=metric&lang=fr`

    fetch(API_URL)
        .then( (data) => { return data.json() })
        .then ( value => { bindValue(value) })
        .catch( (error) => { console.log(error) })
}

// bind value
function bindValue(value){
    let now = new Date();
    meteoTown.innerText = value.timezone
    meteoTemperature.innerText = Math.floor(value.current.temp) + "°"
    meteoInfo.innerText = value.current.weather[0].description
    meteoIcon.setAttribute("src",`http://openweathermap.org/img/wn/${value.current.weather[0].icon}@4x.png`)

    // bind hours
    for (let hourIndex = 0; hourIndex < 7; hourIndex++){
        let hourInterval = (hourIndex +1) * 3
        let displayTime = hourInterval + now.getHours() > 24 ? hourInterval + now.getHours() - 24 : hourInterval + now.getHours()
        tempHour[hourIndex].innerHTML = `
            <span class="hour">${displayTime}H</span> <br> 
            <span class="hour-temp">${Math.floor(value.hourly[hourInterval].temp)}°</span>`
    }

    // bind day
    for (let dayIndex = 0; dayIndex < 7; dayIndex++){
        let options = {weekday: "long"}
        now.setDate(now.getDate() + 1)
        let day = now.toLocaleDateString("fr-FR", options)
        tempDay[dayIndex].innerHTML = `
            <span class="day">${day}</span> <br>
            <span class="day-temp">${Math.floor(value.daily[dayIndex+1].temp.day)}°</span>`
    }
}