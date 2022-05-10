import logo from '../logo.svg';
import '../styles/App.css';
import {useEffect, useState} from "react";
import {findAllByDisplayValue} from "@testing-library/react";

function App() {
    const [popupVisible, setPopupVisible] = useState(false)
    const [input, setInput] = useState('')
    const [task, setTask] = useState([])
    const [taskID, setTaskID] = useState(0)

    const addTask = () => {
        setPopupVisible( v => !popupVisible)
    }

    const deleteTask = (e) => {
        const curTask = e.target.innerText
        let copyOfTask = task.filter(v => v.content != curTask)
        setTask(copyOfTask)
    }

    const onSubmit = (e) => {
        e.preventDefault()
        let copyOfTask = task.filter(v => v)
        copyOfTask.push({content: input,id: taskID})
        setTaskID(v => v + 1)
        setTask(copyOfTask)
        setPopupVisible(v => false)
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

        <div className="taskList">
            {task.map((v)=> <div key={v.id} className="task" onClick={deleteTask}>{v.content}</div>)}
        </div>
        <div className="newTask" onClick={addTask}>+</div>
    </div>
  );
}

export default App;
