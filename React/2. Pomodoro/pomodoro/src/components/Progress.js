import '../style/Progress.css'
function Progress({timerWork, timerPause}){
    const calcProgress = (timerWork,timerPause) => {

    }

    return (
        <div className="progress-bar">{calcProgress(timerWork,timerPause)}</div>
    )
}

export default Progress