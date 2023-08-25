import './App.css'
import {  Routes, Route } from 'react-router-dom'
import Header from './components/Header'
import Home from './components/Home'
import Footer from './components/Footer'
import UserList from './components/UserList'
import AddUser from './Components/AddUser'
import EditUser from './Components/EditUser'

function App() {

  return (
    <>
    <div className="App">
      <Header/>
      <Routes>
      <Route path="/" element= { <Home/> } />
      <Route path="/userlist" element= { <UserList/> } />
      <Route path="/adduser" element= { <AddUser/> } />
      <Route path="/edituser/:id" element= { <EditUser/> } />
      </Routes>
      <Footer/>    
 </div>

    </>
  )
}

export default App
