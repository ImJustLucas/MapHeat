import React, { Component, useEffect, useState } from 'react';
import axios from 'axios';
import MatchResumeRow from './MatchResume/MatchResumeRow';

const playerUrl = "http://127.0.0.1:8000/games/WoiKî";
const summonerUrl = 'https://ddragon.leagueoflegends.com/cdn/12.21.1/data/en_US/summoner.json';
export default class PlayerResume extends React.Component {

  constructor(props) {
    super(props);
    this.state = { isLoading: true, persons: undefined, summonerData: undefined };
  }

  componentDidMount() {
    console.debug("After mount! Let's load data from API...");
    axios.get(playerUrl).then(response => {
      this.setState({ persons: response.data });
      this.setState({ isLoading: false });
    });

    axios.get(summonerUrl).then(response => {
      this.setState({ summonerData: response.data.data });;  
    });
  }

  render() {
    const { isLoading, persons, summonerData } = this.state;
    if (isLoading) {
      return <div className="App">Loading...</div>;
    }
    // console.log(persons);
    // console.log(summonerData); 
    const firstSlicedArray = persons.matchs.slice(0, 2);
    
    const secondSlicedArray = persons.matchs.slice(2);
    // console.log(persons);
    return (
      <div className="App">
        {/* {console.log(summonerData)} */}
        {/* <h1>{persons.matchs[1].Matchid}</h1> */}
        {/* <li>{this.state.persons.matchs[1].Matchid}</li> */}
        {/* <img alt={persons.name} src={persons.sprites.front_default} /> */}
        <section className="mcresume">
          <div className='mcresume__bgfilter'></div>
        </section>
        <div className="mcresume__header">
          <form action="" method="post" className='mcresume__header--wrap'>
            <input type="text" name="pseudo" id="" placeholder="Pseudo" />
            <button type="submit">ANALYSER VOTRE PARTY</button>
          </form>
        </div>
        <div className="mcresume__banner">
          <div className="mcresume__banner--infos">
            <h3>{persons.user.username}</h3>
            <div className='mcresume__infos--wrapimg'>
              <img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/profileicon/${persons.user.icon}.png`} alt="" />
              <div className='mcresume__infos--lv'>
                <p>{persons.user.summonersLvl}</p>
              </div>
            </div>
          </div>
          {firstSlicedArray.map((match, index) => (
                      <MatchResumeRow key={index} parentToChild={persons} summonerData={summonerData} bannerMatch={match} />
          ))} 
        </div>
        <div className="mcresume__match">
        {/* {secondSlicedArray.map((match, index) => (
                      <MatchResumeRow key={index} parentToChild={persons} summonerData={summonerData} bannerMatch={match} />
          ))}  */}
        </div>
      </div>
    );
  }
}

