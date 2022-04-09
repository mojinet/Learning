/***************************************************/
// ** Selection and navigation
/***************************************************/

// Selection
let mainTitle = document.getElementById("main-title") // search by ID
let boxs = document.getElementsByClassName("box") // search by Class
let links = document.getElementsByTagName('a') // Search by generique tagname
let firstSpan = document.querySelector('div > span') // css selector : just first result
let spans = document.querySelectorAll('div > span') // css selector : all result in array
let body = document.querySelector('body')

// Navigation
let childOfBoxs = boxs.children // get child
let parentOfTitle = mainTitle.parentElement // get parent
let nextBox = boxs[0].nextElementSibling // get next element
let previousBox = nextBox.previousElementSibling // get previous element

/***************************************************/
// ** Modification
/***************************************************/

// Content
mainTitle.textContent = "This is a title !" // change text of element
links[0].innerHTML = "<b> google </b>" // change HTML of element

// Class
firstSpan.classList.add("new-class") // add class to element
firstSpan.classList.contains("new-class") // return true if class contain in node
firstSpan.classList.replace("new-class", "trueNew-class") // replace class : old,new
firstSpan.classList.remove("trueNew-class") // remove class to element

// Style & attribute
mainTitle.style.color = "red" // change style color of element
links[0].setAttribute("href", "http://www.google.fr")
links[0].getAttribute("href") // get attribute

// Create & add/remove element
let newElt = document.createElement("div") // create div
let newEltSpan = document.createElement("span") // create span
newElt.appendChild(newEltSpan) // add newEltSpan in newElt
// newElt.replaceChild() // replace : new, old
newElt.removeChild(newEltSpan) // remove element

/***************************************************/
// ** Event
/***************************************************/

// Add event : click
links[0].addEventListener("click", (e) =>{
    window.alert("clicked !")
    e.stopPropagation() // cancel propagation to parents elements
    e.preventDefault() // cancel the default reaction
})

// Mouse move
body.addEventListener('mousemove', (e) =>{
    let x = e.offsetX // x position of mouse
    let y = e.offsetY // y position of mouse
})

// input text
const name = document.getElementById("name")
name.addEventListener("input", (e) => {
    console.log(e.target.value) // return value of text in input #name
})