/***************************************************/
// ** API
/***************************************************/

// fetch : its asynchrom method
const url = 'https://geo.api.gouv.fr/communes?codePostal=78000'
let town;
await fetch(url) // GET request
    .then((res) => { // promise
        return res.json()
    })
    .then((value) => { // exploitable result
        town = value
        console.log(value)
        // use data here
    })
    .catch( (error) => {
        console.log(error)
    })

console.log(town) // is undefinied because fetch its a asynchronous method !


// we can passed argument in fetch
let myHeaders = new Headers()
let myInit = {
    method: 'GET', // can use POST, GET, PUTT, REMOVE
    headers: myHeaders,
    mode: 'cors',
    cache: 'default'
}
fetch(url, myInit)// with custom request
    .then(function(response){
        return response.json()
    })
    .then((value) => {
        console.log(value)
    })
    .catch((error)=> {
        console.log(error)
    })

// Send
let jsonBody = [ // our object
    name= 'Bob',
    age= 25
]
fetch("url", {
    method: 'POST', // can use PUT
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(jsonBody) // convert for send data in JSON
});

// Convert
// JSON => JS Object : JSON.parse(json)
// JS => JSON : JSON.stringify(object)