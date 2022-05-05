import logo from '../logo.svg';
import '../styles/App.css';
import {useState} from "react";

function App() {
    const [popupVisible, setPopupVisible] = useState(false)
    const addTask = () => {
        setPopupVisible( v => !popupVisible)
    }
  return (
    <div className="App">
        <div className={!popupVisible ? "hidden" : "popUpTask"}>
            <span className="closed-cross" onClick={addTask}>❌</span>
            <h2>Add Task</h2>
            <form action="">
                <input type="text" name="taskName" id="taskName" placeholder="Task name"/>
                <input type="submit" value="Add"/>
            </form>
        </div>
        <div className="newTask" onClick={addTask}>+</div>
    </div>
  );
}

export default App;
