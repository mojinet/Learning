const imgUrl = [
    'img/803.png',
    'img/1317.png',
    'img/4586.png',
    'img/6309.png',
    'img/8285.png',
    'img/9034.png',
    'img/1213.png',
    'img/1333.png',
    'img/621.png',
    'img/804.png',
    'img/386.png',
    'img/322.png',
]
const backSide = 'img/backSide.png'
const boardGameElt = document.getElementById('game')
let pairOfCards = 6
let cards = []
let flipCount = 0
let firstFlipSrc = {src: null, elt: null}
let secondFlipSrc = {src: null, elt: null}

// Create a pair of div.card elt
function makeCardsElt(){
    for (let i = 0; i < pairOfCards; i++){
        for (let j = 0; j < 2; j++) {
            // Create card
            let pairCard = document.createElement('div')
            pairCard.classList.add('card')
            let pairBackImg = document.createElement('img')
            pairBackImg.setAttribute('src', backSide)
            pairCard.appendChild(pairBackImg)
            let pairFrontImg = document.createElement('img')
            pairFrontImg.setAttribute('src', imgUrl[i])
            pairCard.appendChild(pairFrontImg)
            // Add event & push
            pairCard.addEventListener('click', flipCard)
            cards.push(pairCard)
        }
    }
}

// Shuffle array and append cards
function initGameBoard(){
    // reset board
    boardGameElt.innerHTML = ''
    // Shuffle
    cards.sort(() => Math.random() - 0.5)
    // Append card to boardgame
    cards.forEach(card => {
        boardGameElt.appendChild(card)
    })
}

// Flip
function flipCard(event) {
    event.stopPropagation()
    // First card flip
    if ( flipCount === 0){
        firstFlipSrc.src = event.target.parentElement.children[1].getAttribute('src')
        firstFlipSrc.elt = event.target.parentElement
        event.target.parentElement.classList.add('flip')
        flipCount++
    // Second card flip
    }else if( flipCount === 1){
        // if is not the same card
        if (event.target.parentElement !== firstFlipSrc.elt){
            secondFlipSrc.src = event.target.parentElement.children[1].getAttribute('src')
            secondFlipSrc.elt = event.target.parentElement
            event.target.parentElement.classList.add('flip')
            flipCount++
            // If is the same image but not the same card it's a good flip
            if (firstFlipSrc.src === secondFlipSrc.src && firstFlipSrc.elt !== secondFlipSrc.elt){
                firstFlipSrc.elt.removeEventListener('click', flipCard)
                secondFlipSrc.elt.removeEventListener('click', flipCard)
                flipCount = 0
                // If is not the same image it's a bad flip
            }else{
                setTimeout(() =>{
                    firstFlipSrc.elt.classList.remove('flip')
                    secondFlipSrc.elt.classList.remove('flip')
                    flipCount = 0
                },500)
            }
        }
    }
}

// Start
makeCardsElt()
initGameBoard()