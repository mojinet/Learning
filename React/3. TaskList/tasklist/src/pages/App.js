import logo from '../logo.svg';
import '../styles/App.css';
import {useEffect, useState} from "react";

function App() {
    const [popupVisible, setPopupVisible] = useState(false)
    const [input, setInput] = useState('')
    const [task, setTask] = useState([])

    useEffect({

    },[input])

    const addTask = () => {
        setPopupVisible( v => !popupVisible)
    }

    const onSubmit = (e) => {
        e.preventDefault()
        let copyOfTask = task.filter(v => v)
        copyOfTask.push(input)
        setTask(copyOfTask)
        console.log(task)
    }

  return (
    <div className="App">
        <div className={!popupVisible ? "hidden" : "popUpTask"}>
            <span className="closed-cross" onClick={addTask}>❌</span>
            <h2>Add Task</h2>
            <form action="">
                <input type="text" name="taskName" id="taskName" placeholder="Task name" onChange={(e) => setInput(v => e.target.value)}/>
                <input type="submit" value="Add" onClick={onSubmit}/>
            </form>
        </div>
        <div className="newTask" onClick={addTask}>+</div>
    </div>
  );
}

export default App;
