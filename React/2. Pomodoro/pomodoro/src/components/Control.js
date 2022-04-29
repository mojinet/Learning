import playIcon from '../assets/002-play-button.png'
import stopIcon from '../assets/001-stop-button.png'
import resetIcon from '../assets/003-reset.png'

function Control({name, onClick}){
    return (
        <div className={name + '-control'} onClick={onClick}>
            <img src={getIcon(name)} alt={name + ' icon'}/>
        </div>
    )
}

function getIcon(name){
    switch (name){
        case 'play' : return playIcon;
        case 'stop' : return stopIcon;
        case 'reset' : return resetIcon;
    }
}

export default Control