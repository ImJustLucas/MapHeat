
import React from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import MatchResumeRow from './MatchResume/MatchResumeRow';
import { Link } from "react-router-dom";
const summonerUrl = 'https://ddragon.leagueoflegends.com/cdn/12.21.1/data/en_US/summoner.json';

function withParams(Component) {
  return (props) => <Component {...props} params={useParams()} />;
}


class PlayerResume extends React.Component {
  constructor(props) {
    super(props);
    this.state = { isLoading: true, persons: undefined, summonerData: undefined, pseudo: "" };
    this.handleChangePseudo = this.handleChangePseudo.bind(this);
  }

  handleChangePseudo = (event) => {
    this.setState({ pseudo: event.target.value });
  };

  componentDidMount() {

    const { pseudo } = this.props.params;
    axios.get(`http://127.0.0.1:8000/games/${pseudo}`).then((response) => {
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
    console.log(persons.matchs);
    // console.log(summonerData); 
    const firstSlicedArray = persons.matchs.slice(0, 2);

    const secondSlicedArray = persons.matchs.slice(2);
    let PassClassM1 = {
      Classrow: "mcresume__banner--wrapmc",
      Classflex: "mcresume__banner--flex"
    }
    let PassClassM2 = {
      Classrow: "mcresume__match-boxwrap",
      Classflex: "mcresume__match--ftbox"
    }
    return (
      <div className="App">
        <section className="mcresume">
          {/* <div className='mcresume__bgfilter'></div> */}
          <div className="mcresume__header">
            <div action="" method="post" className='mcresume__header--wrap'>
              <input value={this.state.pseudo}
                onChange={this.handleChangePseudo}
                id="UserEmail"
                placeholder="Pseudo" />
              <Link onClick={this.forceUpdate} to={`/player/${this.state.pseudo}`} >
                <button >ANALYSER VOTRE PARTY</button>
              </Link>
            </div>
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
            <div className="mcresume__banner--bigbox">
              {firstSlicedArray.map((match, index) => (
                <MatchResumeRow Passclass={PassClassM1} key={index} summonerData={summonerData} bannerMatch={match} />
              ))}
            </div>

          </div>
          <div className="mcresume__match">
            {secondSlicedArray.map((match, index) => (
              <MatchResumeRow Passclass={PassClassM2} key={index} summonerData={summonerData} bannerMatch={match} />
            ))}
          </div>
        </section>
      </div>
    );
  }
}

export default withParams(PlayerResume);
