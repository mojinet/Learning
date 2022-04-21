let workTimerElt = document.getElementById('work-timer')
let pauseTimerElt = document.getElementById('pause-timer')
let startElt = document.getElementById('btn-start')
let pauseElt = document.getElementById('btn-pause')
let resetElt = document.getElementById('btn-reset')
let workTimer = 60*30 // 30 minutes
let pauseTimer = 60*5 // 5 minutes
let timer

//event
startElt.addEventListener('click', ()=>{
        timer = setInterval( ()=> {
            if(workTimer > 0){
                workTimer--
                workTimerElt.innerText = `${Math.floor(workTimer/60)} : ${workTimer%60}`
            } else if( workTimer <= 0 && pauseTimer > 0){
                pauseTimer--
                pauseTimerElt.innerText = `${Math.floor(pauseTimer/60)} : ${pauseTimer%60}`
            }
        },1000)
})
pauseElt.addEventListener('click', ()=>{
    clearInterval(timer)
})
resetElt.addEventListener('click', ()=>{
    clearInterval(timer)
    workTimer = 60*30
    pauseTimer = 60*5
    workTimerElt.innerText = `${Math.floor(workTimer/60)} : ${workTimer%60}`
    pauseTimerElt.innerText = `${Math.floor(pauseTimer/60)} : ${pauseTimer%60}`
})