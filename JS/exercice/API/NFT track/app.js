fetch("api-mainnet.magiceden.dev/v2/tokens/4uvpqEL73361hRXCrHqBZQWeqfbKPQw55yKSFZvLQYTq")
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));