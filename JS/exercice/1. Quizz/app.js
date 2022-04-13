// set Questions
class Question{
    constructor(question, goodResponse, ...badResponses) {
        this.question = question
        this.goodResponse = goodResponse
        this.allResponses = this.shuffle([goodResponse, ...badResponses])
    }

    shuffle(array) {
        return array.sort( () => Math.random() -0.5 )
    }

    checkAwnser(response){
        return response === this.goodResponse
    }
}

const question0 = new Question("Qu’est-ce qui vient toujours, mais n’arrive jamais ?", "Demain", "Un train", "Votre Salaire", "Le courrier")
const question1 = new Question("Tout le monde m’a, mais je suis impossible à perdre. Qui suis-je ?", "Ombre", "Argent", "Cheveu", "Peau")
const question2 = new Question("Que pouvez-vous attraper, mais ne pouvez-vous pas lancer ?", "Un rhume", "Une balle de tennis", "Un boomerang", "Vos jouets")
const question3 = new Question("Mes mains bougent mais je ne peux pas applaudir. Qu’est-ce que je suis ?", "Une horloge", "Un gratte-dos", "Un enfant", "Un fan malheureux à un concert de Justing Bieber")
const question4 = new Question("Si vous l’avez, vous voulez le partager. Si vous le partagez, vous ne l’avez plus. Qu’est-ce que c’est ?", "Un secret", "Amour", "Talent", "Aucune de ces réponses")
const questions = [question0, question1, question2, question3, question4]

// Html Elt
const questionsElt = document.getElementById("questions")
const submitElt = document.getElementById("submit")
const resultatElt = document.getElementById("resultat")

// Submit : iterate on all question and check if awnser is good
submitElt.addEventListener("click", (e) => {
    let goodResponse = 0;
    let allQuestions = document.querySelectorAll(".question")
    // iterate question
    allQuestions.forEach((question, k)=>{
        // iterate div radio
        for (let elt of question.children){
            if( elt.tagName === "DIV"){
                let radio = elt.children[0]
                // check awnser
                if( radio.checked && questions[k].checkAwnser(radio.getAttribute("value")) ){
                    goodResponse++
                    question.style.backgroundColor = "#ccffcc"
                    question.classList.remove("badResponse")
                }else if (radio.checked && !questions[k].checkAwnser(radio.getAttribute("value"))){
                    question.style.backgroundColor = "#ff9999"
                    question.classList.add("badResponse")
                }
            }
        }
    })

    // display result
    let sentence
    switch (goodResponse){
        case 0: sentence = "👎 Vous etes NULL !"
            break
        case 1 : sentence = "👎 T'a eu de la chance !"
            break
        case 2 : sentence = "✌ Ah c'est presque pas mal !"
            break
        case 3 : sentence = "✌ Au dessus de la moyenne !"
            break
        case 4 : sentence = "👍 C'est presque parfait !"
            break
        case 5 : sentence = "👏 C'est un sans faute !"
    }

    resultatElt.innerHTML = ` 
        <h2> ${sentence} <h2>
        <span> ${goodResponse}/5 </span>
    `
})

// Add question in page
for (let i in questions){
    let questionElt = document.createElement("div")
    questionElt.classList.add("question")
    questionElt.setAttribute("id", "q" + i)
    let titleElt = document.createElement("h2")
    titleElt.innerText = questions[i].question
    questionElt.appendChild(titleElt)

    // add response
    questions[i].allResponses.forEach( (value,j) =>{
        const id = "q" + i + "r" + j
        let wrapperElt = document.createElement("div")
        let radioELt = document.createElement("input")
        radioELt.setAttribute("type","radio")
        radioELt.setAttribute("id",id)
        radioELt.setAttribute("name","q" + i)
        radioELt.setAttribute("value",value)
        radioELt.checked = j === 0
        wrapperElt.append(radioELt)

        let labelElt = document.createElement("label")
        labelElt.setAttribute("for",id)
        labelElt.innerText = value
        wrapperElt.append(labelElt)
        questionElt.append(wrapperElt)
    })
    questionsElt.append(questionElt)
}