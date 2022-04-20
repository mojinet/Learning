
let allPokemon = []
let allSortPokemons = []

let itemsElt = document.getElementById('items')
let searchElt = document.getElementById('search')
const types = {
    grass: '#78c850',
    ground: '#E2BF65',
    dragon: '#6F35FC',
    fire: '#F58271',
    electric: '#F7D02C',
    fairy: '#D685AD',
    poison: '#966DA3',
    bug: '#B3F594',
    water: '#6390F0',
    normal: '#D9D5D8',
    psychic: '#F95587',
    flying: '#A98FF3',
    fighting: '#C25956',
    rock: '#B6A136',
    ghost: '#735797',
    ice: '#96D9D6'
};

function fetchPokemonBase(){
    fetch("https://pokeapi.co/api/v2/pokemon?limit=151")
        .then(response => response.json())
        .then(value => {
            value.results.forEach(pokemon => {
                fetchPokemonComplet(pokemon)
            })

        })
}

// get all informations for each pokemon
function fetchPokemonComplet(pokemon){
    let pokemonData = {}

    fetch(pokemon.url)
        .then(response => response.json())
        .then(value => {
            pokemonData.img = value.sprites.front_default
            pokemonData.type = value.types[0].type.name
            pokemonData.id = value.id

            // get name in FR
            fetch(value.species.url)
                .then( response => response.json())
                .then( value => {
                    pokemonData.name = value.names[4].name
                    allPokemon.push(pokemonData)

                    // when binding is ending
                    if (allPokemon.length === 151){
                        bindHTML()
                    }
                })
        })
}

// bind of 21 first pokemons
function bindHTML(){
    // sort by id
    allSortPokemons = allPokemon.sort( (a,b) => a.id - b.id)
        .slice(0,21) // 21 first

    // for each pokemon bind HTML
    allSortPokemons.forEach(pokemon => {
        createItem(pokemon)
    })
}

// create item
function createItem(pokemon){
        let itemElt = document.createElement('div')
        itemElt.classList.add('item')
        itemElt.style.backgroundColor = types[pokemon.type]
        let imgElt = document.createElement('img')
        imgElt.setAttribute('src', pokemon.img)
        let nameElt = document.createElement('span')
        nameElt.innerText = pokemon.name
        let idElt = document.createElement('span')
        idElt.innerText = `ID #${pokemon.id}`
        // append
        itemElt.appendChild(imgElt)
        itemElt.appendChild(nameElt)
        itemElt.appendChild(idElt)
        itemsElt.appendChild(itemElt)
}

let index = 21; // initial display counter

//infinite scroll
window.addEventListener('scroll', () => {
    const {scrollTop, scrollHeight, clientHeight } = document.documentElement
    //scroll = scroll depuis top
    //scrollheight = hauteur total
    //clientheight = hauteur fenetre partie visible

    if(clientHeight + scrollTop >= scrollHeight - 20) {
        addPoke(6)
    }
})

//adding pokemon
function addPoke(count){
    let pokemonToDisplay = allPokemon.slice(index, index + count)
    pokemonToDisplay.forEach( pokemon => createItem(pokemon))
    index += count;
}

// start
fetchPokemonBase();