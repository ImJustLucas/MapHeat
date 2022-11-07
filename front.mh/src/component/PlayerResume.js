import React, { Component,  useEffect, useState } from 'react';
import axios from 'axios';

const baseURL = "http://127.0.0.1:8000/games/Azzticow";
export default class PlayerResume extends React.Component {

  constructor(props) {
    super(props);
    this.state = { isLoading: true, persons: undefined };
  }

  componentDidMount() {
    console.debug("After mount! Let's load data from API...");
    axios.get(baseURL).then(response => {
      this.setState({ persons: response.data });
      this.setState({ isLoading: false });
    });
  }

  render() {
    const { isLoading, persons } = this.state;

    if (isLoading) {
      return <div className="App">Loading...</div>;
    }

    return (
      <div className="App">
        <h1>{persons.matchs[1].Matchid}</h1>
        {/* <li>{this.state.persons.matchs[1].Matchid}</li> */}
        {/* <img alt={persons.name} src={persons.sprites.front_default} /> */}
      </div>
    );
  }
}

