import '../styles/Banner.css'
import logo from '../assets/logo.png'

function Banner(){
    return <header>
        <h1 className='main-title'>
            <img src={logo} alt="House of plants" className='logo'/>
            House of plants
        </h1>
    </header>
}

export default Banner