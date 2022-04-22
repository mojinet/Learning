const goodColor = '#abffab'
const badColor = '#ffabab'
const mailReg = /^\S+@\S+\.\S+$/
const passwordReg = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])/
let userPassword

let nameElt = document.getElementById('name')
let mailElt = document.getElementById('mail')
let passwordElt = document.getElementById('password')
let passwordConfirmElt = document.getElementById('password-confirm')
let submitElt = document.getElementById('submit')
let warningNameElt = document.getElementById('warning-message-name')
let warningMailElt = document.getElementById('warning-message-mail')
let warningPasswordElt = document.getElementById('warning-message-password')
let warningConfirmElt = document.getElementById('warning-message-confirm')

// name 3 to 24 character
// mail verify if its a mail
// password symbol, min, majuscule, chiffre
// confirm same

// Name must be contains between 3 and 24 characters
nameElt.addEventListener('keyup', (e) => {
    if ( e.target.value.length >= 3 && e.target.value.length <= 24){
        e.target.style.backgroundColor = goodColor
        warningNameElt.style.visibility = "hidden"
    }else{
        e.target.style.backgroundColor = badColor
        warningNameElt.style.visibility = "visible"
    }
})
//Check if mail is valid
mailElt.addEventListener('keyup', (e) => {
    if (e.target.value.search(mailReg) === 0){
        e.target.style.backgroundColor = goodColor
        warningMailElt.style.visibility = "hidden"
    }else{
        e.target.style.backgroundColor = badColor
        warningMailElt.style.visibility = "visible"
    }
})
// Password must be contains : 1 number, 1 special character, 1 lower+upper
passwordElt.addEventListener('keyup', (e) => {
    if (e.target.value.search(passwordReg) === 0){
        e.target.style.backgroundColor = goodColor
        warningPasswordElt.style.visibility = "hidden"
        userPassword = e.target.value
    }else{
        e.target.style.backgroundColor = badColor
        warningPasswordElt.style.visibility = "visible"
    }
})
// Confirm must be the same
passwordConfirmElt.addEventListener('keyup', (e) => {
    if (e.target.value.search(passwordReg) === 0 && e.target.value === userPassword){
        e.target.style.backgroundColor = goodColor
        warningConfirmElt.style.visibility = "hidden"
    }else{
        e.target.style.backgroundColor = badColor
        warningConfirmElt.style.visibility = "visible"
    }
})
submitElt.addEventListener('click', (e) => {
    e.preventDefault()
})

userInfo.userName = 'test'
console.log(userInfo.userName)