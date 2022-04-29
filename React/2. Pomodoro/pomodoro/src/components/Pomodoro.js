import '../style/Pomodoro.scss'
import playIcon from '../assets/002-play-button.png'
import stopIcon from '../assets/001-stop-button.png'
import resetIcon from '../assets/003-reset.png'

function Pomodoro(){
    return (
        <div className="Pomodoro">
            <div className="top-progress"></div>
            <div className="timers">
                <div className="work-timer">
                    00 : 45 : 00
                </div>
                <div className="pause-timer">
                    00 : 5 : 00
                </div>
            </div>
            <div className="controls">
                <div className="play-control">
                    <img src={playIcon} alt="Play icon"/>
                </div>
                <div className="stop-control">
                    <img src={stopIcon} alt="Stop icon"/>
                </div>
                <div className="reset-control">
                    <img src={resetIcon} alt="Reset icon"/>
                </div>
            </div>
        </div>
    )
}

export default Pomodoro