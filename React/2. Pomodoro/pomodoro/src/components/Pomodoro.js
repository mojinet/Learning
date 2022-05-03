import '../style/Pomodoro.scss'
import Control from "./Control";
import {useState, useEffect} from "react";
import Timer from "./Timer";
import Progress from "./Progress";

function Pomodoro(){
    const TIMER_WORK = 52*60
    const TIMER_PAUSE = 17*60
    const [timer, setTimer] = useState(TIMER_WORK)
    const [timerPause, setTimerPause] = useState(TIMER_PAUSE)
    const [intervalId, setIntervalId] = useState(0)
    const [timeWork, setTimeWork] = useState(true)

    useEffect(() =>{
        if(timer <= 0){
            clearInterval(intervalId)
            setTimeWork(t => false)
            startTimer()
        }
    },[timer, timerPause, timeWork])

    const startTimer = () => {
        clearInterval(intervalId)
        let newIntervalId = null
        if (timeWork){
            newIntervalId = setInterval(()=>{
                timer > 0 && setTimer(t => t - 1)
            },1000)
        }else{
            newIntervalId = setInterval(()=>{
                timerPause > 0 && setTimerPause(t => t - 1)
            },1000)
        }
        setIntervalId(newIntervalId)
    }

    const stopTimer = () => {
        clearInterval(intervalId)
    }

    const resetTimer = () => {
        clearInterval(intervalId)
        setTimeWork(t => true)
        setTimer(TIMER_WORK)
        setTimerPause(TIMER_PAUSE)
    }

    return (
        <div className="Pomodoro">
            <Progress timerWork={timer} timerPause={timerPause} totalWork={TIMER_WORK} totalPause={TIMER_PAUSE}/>
            <div className="timers">
                <Timer time={timer} />
                <Timer time={timerPause} />
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