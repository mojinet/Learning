const canvas = document.getElementById('canvas')
let particules = []
const colors = [
    'white',
    'red',
    'yellow',
    'green',
    'brown',
    'pink',
    'purple',
    'blue',
]
const ctx = canvas.getContext('2d')
ctx.canvas.width = window.innerWidth
ctx.canvas.height = window.innerHeight

class Particule{
    constructor(x,y,directionX, directionY, size, color){
        this.x = x
        this.y = y
        this.directionX = directionX
        this.directionY = directionY
        this.size = size
        this.color = color
    }
    draw(){
        ctx.beginPath()
        ctx.arc(this.x,this.y,this.size,0, Math.PI * 2, false)
        ctx.fillStyle = this.color
        ctx.fill()
    }
    MAJ(){
        if(this.x + this.size > canvas.width || this.x - this.size < 0){
            this.directionX = - this.directionX
        }
        if(this.y + this.size > canvas.height || this.y - this.size < 0){
            this.directionY = - this.directionY
        }
        this.x += this.directionX
        this.y += this.directionY
        this.draw()
    }
}

function init(){
    particules = []
    for (let i = 0; i < 100; i++) {
        let size = (Math.random() + 1) * 5
        let x = (Math.random() + 0.01) * (window.innerWidth - (size * 2))
        let y = (Math.random() + 0.01) * (window.innerHeight - (size * 2))
        let directionX = (Math.random() * 2) * -1
        let directionY = (Math.random() * 2) * -1
        let color = colors[Math.floor(Math.random() * 8)]
        particules.push(new Particule(x,y,directionX,directionY,size,color))
    }

    for (let i = 0; i < particules.length; i++) {
        particules[i].draw()
    }
}

function animation(){
    requestAnimationFrame(animation) // call around 60fps
    ctx.clearRect(0,0,window.innerWidth, window.innerHeight) // clean screen
    for (let i = 0; i < particules.length; i++) {
        particules[i].MAJ()
    }
}

function resize(){
    init()
    animation()
}

let doIt
window.addEventListener('resize', () => {
    clearTimeout(doIt)
    doit = setTimeout(resize,100)
    ctx.canvas.width = window.innerWidth
    ctx.canvas.height = window.innerHeight
})

init()
animation()