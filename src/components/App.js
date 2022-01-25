import "../styles/style.scss";
import Header from "./sections/Header"
import Home from "./pages/Home"
import AboutUs from "./pages/AboutUs"

import Cupcake from "./pages/Cupcake"
import {
  BrowserRouter as Router,
  Routes,
  Route
  } from "react-router-dom";
const App = ()=> (
  <Router>
    <Header/>
    <Routes>
      <Route path="/cupcakes" element={<Cupcake peticion="cupcakes" title />}/>
      <Route path="/aboutus" element={<AboutUs/>}/>
      <Route path="/" element={<Home/>}/>
    </Routes>
  </Router>
  
)

export default App;
