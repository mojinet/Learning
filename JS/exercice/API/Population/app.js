const townCP = document.getElementById("townCP")
const townName = document.getElementById("townName")
const population = document.getElementById("population")
const URL_API_GEO = "https://geo.api.gouv.fr/communes?codePostal="
let townsSelect

// Event
townCP.addEventListener("change", (e) => {
    setTownsSelect(e.target.value)
})
townName.addEventListener("change", (e) => {
    population.innerText = townsSelect[e.target.value].population
})

// Set values of townsSelect with all town with same postal code
function setTownsSelect(postalCode) {
    fetch(URL_API_GEO + postalCode)
        .then( (response) => {
            return response.json()
        }).then( (value) => {
            townsSelect = value
            generateTownsSelect(townsSelect)
        })
}

// Generate townName select input
function generateTownsSelect(townArray){
    // Remove old choices
    let selects = document.querySelectorAll("#townName option")
    for(let option of selects){
        option.remove()
    }

    // Generate new choices
    for( let town in townArray){
        let elt = document.createElement("option")
        elt.setAttribute("value", town)
        elt.textContent = townArray[town].nom
        townName.appendChild(elt)
    }
}