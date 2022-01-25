import { NavLink } from "react-router-dom";

const Headers = () =>(
    <header className="main-header">
      <div className="ed-grid s-grid-5 lg-grid-4">
        <div className="s-cols-4 lg-cols-1 s-cross-center">
          <a href="/">
          <img className="main-logo" src="https://ux.ed.team/img/edteam-ux.svg" />
          </a>
        </div>
        <div className="s-grid-1 lg-cols-3 s-cross-center s-main-end header- link s">
          <nav className="main-menu" id="main-menu">
            <ul>
              <li><NavLink to="/" exact>Inicio</NavLink></li>
              <li><NavLink to="/cupcakes" exact>Cupcakes</NavLink></li>
              <li><NavLink to="/aboutus" exact>Nosotros</NavLink></li>
            </ul>
          </nav>
          <div className="main-menu-toggle to-l" id="main-menu-toggle"></div>
        </div>
      </div>
    </header>
)

export default Headers;