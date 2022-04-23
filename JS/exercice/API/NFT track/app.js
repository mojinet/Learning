let myInit = {
    method: 'GET',
    // mode: 'no-cors',
}

fetch('https://api-mainnet.magiceden.dev/v2/collections?offset=0&limit=3', myInit)
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));