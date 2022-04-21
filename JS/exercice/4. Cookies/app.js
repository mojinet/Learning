let cookieNameElt = document.getElementById('cookie-name')
let cookieValueElt = document.getElementById('cookie-value')
let cookieDateElt = document.getElementById('cookie-date')
let createElt = document.getElementById('btn-create')
let displayElt = document.getElementById('btn-display')
let cookiesElt = document.getElementById('cookies')

const now = new Date();
const nextWeek = new Date(now.getTime() + 7 * 24 * 60 * 60 * 1000) // 7days * 24hours * 60minutes * 60secondes * 1000ms = 1 week

// set date + 1 week in default
cookieDateElt.value = `${nextWeek.getFullYear()}-${('' + (nextWeek.getMonth() + 1)).padStart(2,'0')}-${nextWeek.getDate()}`

// create cookie
createElt.addEventListener('click', e => {
    e.preventDefault()
    if(cookieNameElt.value !== '' && cookieValueElt.value !== ''){
        const expiresDate = new Date(cookieDateElt.value)
        document.cookie = `${encodeURIComponent(cookieNameElt.value)}=${encodeURIComponent(cookieValueElt.value)};expires=${expiresDate.toUTCString()}`
    }
})

// display all cookies
displayElt.addEventListener( 'click',e => {
    // delete all child
    cookiesElt.innerHTML = ''
    e.preventDefault()
    let cookies = document.cookie.split(';')
    cookies.forEach( cookie => {
        let name = decodeURIComponent(cookie.trim().split('=')[0])
        let value = decodeURIComponent(cookie.trim().split('=')[1])
        makeCookieElt(value,name)
    })
})

// make a item cookie on dom and add eventListener on cross to delete elt
function makeCookieElt(value,name){
    //create elt
    let cookieElt = document.createElement('div')
    cookieElt.classList.add('cookie')
    let nameElt = document.createElement('span')
    nameElt.classList.add('name')
    nameElt.innerText = `name = ${name}`
    let valueElt = document.createElement('span')
    valueElt.classList.add('value')
    valueElt.innerText = `value = ${value}`
    let crossElt = document.createElement('span')
    crossElt.classList.add('delete')
    crossElt.innerText = '❌'
    // append
    cookieElt.appendChild(nameElt)
    cookieElt.appendChild(valueElt)
    cookieElt.appendChild(crossElt)
    cookiesElt.appendChild(cookieElt)
    //event on cross
    crossElt.addEventListener('click', (e) =>{
        cookiesElt.removeChild(e.target.parentElement)
        deleteCookie(e.target.parentElement.children)
    })
}

function deleteCookie(cookieElt){
    let name = cookieElt[0].innerText.split(' = ')[1]
    let value = cookieElt[1].innerText.split(' = ')[1]
    document.cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)};expires=${new Date().toUTCString()}`
}