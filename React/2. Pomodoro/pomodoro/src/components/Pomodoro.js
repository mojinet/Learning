import '../style/Pomodoro.scss'
import Control from "./Control";
// import Timer from "./Timer";
import {useState, useEffect} from "react";

// todo why dont work ?
function Pomodoro(){
    const [timer, setTimer] = useState(10)
    useEffect(() =>{
        const mainInterval = setInterval(()=>{
            timer > 0 && setTimer(t => t - 1)
            timer <= 0 && clearInterval(mainInterval)
            console.log(timer)
        },1000)
        return () => clearInterval(mainInterval)
    },[timer])

    return (
        <div className="Pomodoro">
            <div className="top-progress"></div>
            <div className="timers">
                <div>Count : {timer}</div>
                {/*<Timer time={timerWork} />*/}
            </div>
            <div className="controls">
                <Control name="play"/>
                <Control name="stop"/>
                <Control name="reset"/>
            </div>
        </div>
    )
}

export default Pomodoro