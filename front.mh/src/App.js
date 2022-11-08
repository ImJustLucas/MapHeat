import React from "react";
import {
  BrowserRouter as Router,
  Routes,
  Route,
} from "react-router-dom";
import Home from "./component/Home";
import Map from "./component/Map";
import PlayerResume from "./component/PlayerResume";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Home />} /> 
        <Route path="/home" element={<Home />} />
        <Route path="/map" element={<Map />} />
        <Route path="/player" element={<PlayerResume />} />
      </Routes>
    </Router>
  );
}

export default App;
