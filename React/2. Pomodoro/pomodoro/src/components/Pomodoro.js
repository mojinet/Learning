import '../style/Pomodoro.scss'
import Control from "./Control";
// import Timer from "./Timer";
import {useState, useEffect} from "react";

// todo why dont work ?
function Pomodoro(){
    const [timer, setTimer] = useState(10)
    useEffect(() =>{
        const timer = setInterval(()=>{
            console.log(timer)
            setTimer(timer - 1)
        },1000)
        return () => clearInterval(timer)
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