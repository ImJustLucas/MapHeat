import React, { Component, useState } from 'react';
// import axios from 'axios';
import DataHero from './../Data/heroes.json';

export default class Map extends Component {
    constructor(props){
        super(props);

        this.state = {
            hero: "TwistedFate",
        };

        console.log(DataHero.data[this.state.hero])
    }

    componentDidMount(){
    }
    render() {

        const backgroundImageLol = {
            backgroundImage: 'url(https://ddragon.leagueoflegends.com/cdn/img/champion/splash/'+ this.state.hero +'_0.jpg)'
        }
    
        return (
            <div className='map-size'>
                <div className="background-image" style={backgroundImageLol}>

                <div className='overlay'></div>
                    
                </div>
                <div className='my-3'>
                    <h1 className='text-white text-2xl text-center'>Analysons votre partie du 27/09/2022 à 19h54</h1>
                    <div className='flex flex-row justify-center content-end w-full'>
                        <h2 className='text-white text-xl text-center'>Vous avez joué le champion {this.state.hero}</h2>
                        <img src={`https://ddragon.leagueoflegends.com/cdn/12.18.1/img/champion/${this.state.hero}.png`} width="50px" className='ml-2'></img>
                    </div>
                    {/* <h2 className='text-white text-xl text-center' dangerouslySetInnerHTML={{__html: DataHero.data[this.state.hero].blurb}}></h2> */}
                    <h2 className='text-white text-xl text-center'>{DataHero.data[this.state.hero].title}</h2>
                    {/* <img src={`https://ddragon.leagueoflegends.com/cdn/12.18.1/img/champion/${this.state.hero}.png`}></img> */}
                </div>
                <div className='map'>

                </div>
            </div>
        )
    }
}
