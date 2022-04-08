 console.log("Welcome to basic !")

 /***************************************************/
 // ** Variables & type
 /***************************************************/

// Variables : use camelCase
let limitedScope = 5 // limited scope : bloc
var largeScope = 15 // large scope : function
const IMMUTABLE = 10 // immutable USE CAPITAL

// Type
let number = 681 // number
number = false // boolean
number = "this is not a number, use TS :)" // string
number = null // null
number = NaN // Not a number
number = undefined // usualy not affected
number = Infinity // or -Infinity
number = Number.MAX_SAFE_INTEGER // maximum of number

// Some method on string
let thisIsAString = "Hello i'm a string !"
thisIsAString.length
thisIsAString.toLowerCase()
thisIsAString.toUpperCase()
thisIsAString.trim()
thisIsAString.charAt(0)
thisIsAString.charCodeAt(0)
thisIsAString.lastIndexOf("m")
thisIsAString

 /***************************************************/
 // ** Operation
 /***************************************************/

// Prefer use whole number !
strangeNumber = 0.1 + 0.2
console.log(strangeNumber == 0.3) // false ! 0.1 + 0.2 != 0.3 !

// Number limit
console.log(Number.MAX_SAFE_INTEGER + 1 === Number.MAX_SAFE_INTEGER + 2) // true :o
console.log(BigInt(Number.MAX_SAFE_INTEGER) + 2n === BigInt(Number.MAX_SAFE_INTEGER) + 2n) // true : use BigInt & n after number

// == & ===
console.log(" == & ===")
console.log( 5 == "5" ) // true, dont test type, just value
console.log( 5 === "5" ) // false, test type & value

// || &&
console.log(" || &&")
console.log (true || false) // true
console.log (true && false) // false

// concat
let firstName = "Bill"
let lastName = "Gates"
let fullName = firstName + " " + lastName

 /***************************************************/
 // ** Object
 /***************************************************/

// JSON
let myBook = {
    title: 'My learning',
    author: 'Mojinet',
    isAvailable: false
}

// Use dot notation to use property
let titleOfBook = myBook.title
let aboutBook = myBook.title + " is writing by " + myBook.author + " and is " + (myBook.isAvailable == true ? "available" : "not available")
console.log(aboutBook)

// Use bracket notation to use property
let propertyToAccess = "title"
titleOfBook = myBook[propertyToAccess]
console.log(titleOfBook)

 /***************************************************/
 // ** Class
 /***************************************************/

// Create class
class Book{
    constructor(title, author, isAvailable, price){
        this.title = title
        this.author = author
        this.isAvailable = isAvailable
        this.price = price
    }
    showPrice(){
        console.log("the price of " + this.title + " is " + this.price + "$")
    }
    setPrice(price){
        this.price = price
    }

    static whoIAm(){
        console.log("Hey ! i'm a class, instance me !")
    }
}

// Use class
let otherBook = new Book("its an other book", "bob michel", true, 100)
otherBook.setPrice(25)
otherBook.showPrice()
Book.whoIAm() // use static method

 /***************************************************/
 // ** Array
 /***************************************************/

let guests = [] // init array
guests = ["toto", "titi", "tata", "tutu"]
console.log(guests[1]) // access to 2nd occurence

// Be carefull : passed by reference
let otherGuests = guests
otherGuests[0] = "Bob"
console.log(guests[0] + " " + otherGuests[0]) // Bob Bob != toto Bob

// Arrays methode
guests.length // lenght of array : 4
guests.push("Pop") // place in end of array
guests.unshift("Pup") // place in start of array
guests.pop() // delete last element

// Map
const map1 = guests.map(x => "Mr " + x)
console.log(map1)

 /***************************************************/
 // ** Fonction
 /***************************************************/

 // Traditional
 function addition(a, b){
    return a + b
 }
 console.log(addition(54,21))

 // In variable
 const multiple = (a, b, c = 5) => { // c is optional and have a default value
    return a*b+c
 }
 console.log(multiple(5,5))

 // Recursive in order array
 const arrayOfNumber = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
 const searchInArray = (searchNumber, array, min, max) =>{
    if (min > max){
        return false
    }
    let middle = Math.floor((min + max) / 2)
    let currentNumber =  array[middle];
     if (currentNumber === searchNumber){
         return true
     }else{
         currentNumber < searchNumber ?
             searchInArray(searchNumber, array, min+1, middle) :
             searchInArray(searchNumber, array, middle, max-1)
     }
 }
 searchInArray(15,arrayOfNumber,0,arrayOfNumber.length)

 // anonym function et setInterval
 /*
 const int = setInterval(() =>{
     console.log("hi")
 },250)
*/

 /***************************************************/
 // ** Loops
 /***************************************************/

 // For : determined loop
 const repeat = 5
 for (let i = 0; i < repeat; i++){
     console.log("i repeat")
 }

 // For...in : need indice
 const passengers = [
     "will",
     "bob",
     "charlie"
 ]
 for(let i in passengers){
     console.log(passengers[i])
 }

 // For...of : dont need indice
 for(let passenger of passengers){
     console.log(passenger)
 }

 // While : undetermined loop
 let random = Math.floor(Math.random()*10)+1 //random number 1 - 10
 console.log(random)
 while (random > 0){
     random--
 }

 // Do... while : at least once
 do{
     //something
 }while(false) //

 /***************************************************/
 // ** Conditions
 /***************************************************/

 // If, else if, else
let userConnected = true
if (userConnected){
    console.log("Your connected !")
}else{
    console.log("Not connected :(")
}

// Switch
let choice = 1
switch (choice){
    case 1 :
        console.log("Choice 1")
        break
    case 2 :
        console.log("Choice 2")
        break
    default :
        console.log("other choice")
}

 /***************************************************/
 // ** Error
 /***************************************************/

 try{
    // code who can provoque error
 }catch (error){
    console.log(error)
 }finally {
     // executed in all case
 }

 console.error("this is an error message")