console.log("Welcome to basic !")

// ** Variables & type
// variables : use camelCase
let limitedScope = 5 // limited scope
var largeScope = 15 // large scope
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

// ** operation
// prefer use whole number !
strangeNumber = 0.1 + 0.2
console.log(strangeNumber == 0.3) // false ! 0.1 + 0.2 != 0.3 !
// number limit
console.log(Number.MAX_SAFE_INTEGER + 1 === Number.MAX_SAFE_INTEGER + 2) // true :o
console.log(BigInt(Number.MAX_SAFE_INTEGER) + 2n === BigInt(Number.MAX_SAFE_INTEGER) + 2n) // true : use BigInt & n after number

// concat
let firstName = "Bill"
let lastName = "Gates"
let fullName = firstName + " " + lastName

// ** Object
// JSON
let myBook = {
    title: 'My learning',
    author: 'Mojinet',
    isAvailable: false
}
// use dot notation to use property
let titleOfBook = myBook.title
let aboutBook = myBook.title + " is writing by " + myBook.author + " and is " + (myBook.isAvailable == true ? "available" : "not available")
console.log(aboutBook)
// use bracket notation to use property
let propertyToAccess = "title"
titleOfBook = myBook[propertyToAccess]
console.log(titleOfBook)

//class
// basic class with constructor
class Book{
    constructor(title, author, isAvailable){
        this.title = title
        this.author = author
        this.isAvailable = isAvailable
    }
}
// use class
let otherBook = new Book("its an other book", "bob michel", true)

// ** arrays
let guests = [] // init array
guests = ["toto", "titi", "tata", "tutu"]
console.log(guests[1]) // access to 2nd occurence
// be carefull : passed by reference
let otherGuests = guests
otherGuests[0] = "Bob"
console.log(guests[0] + " " + otherGuests[0]) // Bob Bob != toto Bob
// arrays methode
guests.length // lenght of array : 4
guests.push("Pop") // place in end of array
guests.unshift("Pup") // place in start of array
guests.pop() // delete last element

// fonctions

// loops

// conditions

// dates

// errors

// promises