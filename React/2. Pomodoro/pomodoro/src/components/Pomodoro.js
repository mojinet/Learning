import '../style/Pomodoro.scss'
import Control from "./Control";
// import Timer from "./Timer";
import {useState, useEffect} from "react";

function Pomodoro(){
    const TIMER_WORK = 5
    const TIMER_PAUSE = 10
    const [timer, setTimer] = useState(TIMER_WORK)
    const [timerPause, setTimerPause] = useState(TIMER_PAUSE)
    const [intervalId, setIntervalId] = useState(0)

    useEffect(() =>{
        timer <= 0 && clearInterval(intervalId)
    },[timer])

    const startPauseTimer = () => {
        clearInterval(intervalId)
        const newIntervalId = setInterval(()=>{
            timerPause > 0 && setTimerPause(t => t - 1)
        },1000)
        setIntervalId(newIntervalId)
    }
    const startTimer = () => {
        clearInterval(intervalId)
        const newIntervalId = setInterval(()=>{
            timer > 0 && setTimer(t => t - 1)
        },1000)
        setIntervalId(newIntervalId)
    }

    const stopTimer = () => {
        clearInterval(intervalId)
    }

    const resetTimer = () => {
        clearInterval(intervalId)
        setTimer(TIMER_WORK)
        setTimerPause(TIMER_PAUSE)
    }

    const displayTime = (time) => {
        let min = Math.trunc(time/60) < 10 ? '0' + Math.trunc(time/60) : Math.trunc(time/60)
        let sec = time%60 < 10 ? '0' + time%60 : time%60
        return min + ':' + sec
    }

    return (
        <div className="Pomodoro">
            <div className="top-progress"></div>
            <div className="timers">
                <div>{displayTime(timer)}</div>
                <div>{displayTime(timerPause)}</div>
            </div>
            <div className="controls">
                <Control name="play" onClick={startTimer}/>
                <Control name="stop" onClick={stopTimer}/>
                <Control name="reset" onClick={resetTimer}/>
            </div>
        </div>
    )
}

export default Pomodoro