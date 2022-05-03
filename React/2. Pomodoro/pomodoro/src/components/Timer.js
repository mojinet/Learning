function Timer({time}){
    return (
        <div>
            {displayTime(time)}
        </div>
    )
}

const displayTime = (time) => {
    let min = Math.trunc(time/60) < 10 ? '0' + Math.trunc(time/60) : Math.trunc(time/60)
    let sec = time%60 < 10 ? '0' + time%60 : time%60
    return min + ':' + sec
}

export default Timer