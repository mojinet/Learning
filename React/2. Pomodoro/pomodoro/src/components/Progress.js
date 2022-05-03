import '../style/Progress.css'
import {useEffect, useState} from "react";

function Progress({timerWork, timerPause,totalWork,totalPause}){
    const [progressBarPourcent, setProgressBarPourcent] = useState('100%')
    const [statusColor, setStatusColor] = useState('green')

    useEffect(()=>{
        let progressValue = ''
        if(timerWork > 0){
            setStatusColor('green')
            progressValue = (timerWork/totalWork)*100
        }else if(timerWork <= 0 && timerPause >= 0){
            setStatusColor('red')
            progressValue = (timerPause/totalPause)*100
        }
        setProgressBarPourcent(v => progressValue + '%')
    },[timerWork,timerPause])

    return (
        <div className="progress-bar" style={{width: progressBarPourcent,backgroundColor: statusColor}}></div>
    )
}

export default Progress