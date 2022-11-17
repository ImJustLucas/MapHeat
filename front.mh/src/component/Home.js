import React, { Component } from "react";
import { Link } from "react-router-dom";

export default class Home extends Component {
  constructor(props) {
    super(props);
    this.state = { pseudo: "" };

    this.handleChangePseudo = this.handleChangePseudo.bind(this);
  }

  handleChangePseudo = (event) => {
    this.setState({ pseudo: event.target.value });
  };

  render() {
    return (<div>
      <div className="containerVideo">
        <video
          loop="true"
          muted="true"
          autoplay="true"
          className="videoBackground"
        >
          <source src="/Videos/video.mp4" type="video/mp4" />
        </video>
      </div>
      <div className="Home-Content1 wrap-90">
        <div className="text-slate-300">
          <p className="text-6xl text-amber-400 uppercase tracking-widest mb-2 typo-lol">
            MapHeat
          </p>
          <div className="flex items-center">
            <div className="line1"></div>
            <p className="text-3xl uppercase font-extralight tracking-widest my-2">
              Redécouvrez votre partie
            </p>
          </div>
          <p className="text-xl font-extralight">
            Une analyse avancé de vos parties
          </p>
          <p className="text-xl font-extralight">
            Grace à notre client disponible pour tous
          </p>
          <label
            for="UserEmail"
            className="my-2 relative block px-3 pt-3 overflow-hidden border border-amber-300 focus-within:ring-1"
          >
            <input
              value={this.state.pseudo}
              onChange={this.handleChangePseudo}
              type="email"
              id="UserEmail"
              placeholder="Pseudo"
              className="h-8 p-0 placeholder-transparent bg-transparent border-none sm:text-sm focus:outline-none focus:border-transparent focus:ring-0 peer"
            />
            <span className="absolute text-xs text-slate-300 transition-all -translate-y-1/2 left-3 top-2 peer-focus:top-2 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:text-xs">
              Pseudo
            </span>
          </label>

          <Link
            to={`/player/${this.state.pseudo}`}
            className="my-5 relative inline-block text-sm font-medium text-amber-400 active:text-amber-200 group focus:outline-none focus:ring"
          >
            <span className="block px-6 py-3 transition-transform border border-current group-hover:-translate-x-1 group-hover:-translate-y-1 hover:bg-amber-400 hover:text-slate-900 text-xl text-amber-400 uppercase cursor-pointer font-extralight hover:font-normal tracking-widest">
              Analyser votre partie
            </span>
          </Link>
        </div>
      </div>
    </div>
    );
  }
}
