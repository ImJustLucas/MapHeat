import React, { Component, createElement, useEffect, useState } from 'react';
import { ReactDOM } from 'react';
import DataHero from './../Data/heroes.json';
import Game from './../Data/gametest.json';

export default class Map extends Component {
    constructor(props){
        super(props);

        this.state = {
            hero: "Lux",
            timer: 0,
            frame: 0,
            start: false,
        };
    }

    //-----------------------------------------//
                    //FUNCTION
    //-----------------------------------------//

    MovePlayerTo(playerid, x, y){
        const MovePlayer = document.getElementById(playerid);
        MovePlayer.style.left = 'calc(' + x.toString() + '% - 15px )';
        MovePlayer.style.top = 'calc(' + y.toString() + '% - 15px )';
    }
    //Pose les events Kill sur la cart
    SetEventKill(x, y){
        if(this.state.start == true){
            const killicon = document.createElement('div')
            killicon.className = 'Lastkill'
            killicon.style.left = 'calc(' + this.ConvertCoordToPercentX(x).toString() + '% - 15px )';
            killicon.style.top= 'calc(' + this.ConvertCoordToPercentY(y).toString() + '% - 15px )';
            document.getElementById("insert").parentNode.insertBefore(killicon, document.getElementById('insert'))
        }
    }
    //Convertir les Coord LOL en Pourcentage
    ConvertCoordToPercent(valuex, valuey){
        valuex = (valuex/15000) * 100;
        valuey = (valuey/15000) * 100;
        return {valuex, valuey}
    }

    ConvertCoordToPercentX(valuex){
        valuex = (valuex/15000) * 100;
        return valuex
    }

    ConvertCoordToPercentY(valuey){
        valuey = (valuey/15000) * 100;
        return valuey
    }
    //-----------------------------------------//
                    //DidMount
    //-----------------------------------------//


    componentDidMount(){
        this.MovePlayerTo("1", 0, 0);
        this.MovePlayerTo("2", 100, 0);
        this.SetEventKill("1", "2", 50, 50);

        const frame = Game.info.frames[7].events
        // console.log(frame[31].position.x)

        const ReadFrame = frame.forEach(element => {
            this.state.start = true;
            if(element.type == "CHAMPION_KILL"){
                return this.SetEventKill(element.position.x, element.position.y)
            }
        });

    }

    //-----------------------------------------//
                    //Render
    //-----------------------------------------//
    
    render() {
        
        const backgroundImageLol = {
            backgroundImage: 'url(https://ddragon.leagueoflegends.com/cdn/img/champion/splash/'+ this.state.hero +'_0.jpg)'
        }
        
        const Player1 = {
            backgroundImage: 'url(https://ddragon.leagueoflegends.com/cdn/12.18.1/img/champion/' + this.state.hero + '.png)',
            display: "none"
        }

        const Player2 = {
            backgroundImage: 'url(https://ddragon.leagueoflegends.com/cdn/12.18.1/img/champion/Morgana.png)',
            display: "none"
        }
        


    
        return (
            <div className='map-size'>
                <div className="background-image" style={backgroundImageLol}>

                <div className='overlay'></div>
                    
                </div>
                <div className='my-3'>
                    <h1 className='text-white text-2xl text-center'>Analysons votre partie du 27/09/2022 à 19h54</h1>
                    <h1 className='text-white text-2xl text-center'>{this.state.timer}</h1>
                    <div className='flex flex-row justify-center content-end w-full'>
                        <h2 className='text-white text-xl text-center'>Vous avez joué le champion {this.state.hero}</h2>
                        <img src={`https://ddragon.leagueoflegends.com/cdn/12.18.1/img/champion/${this.state.hero}.png`} width="50px" className='ml-2'></img>
                    </div>
                </div>
                <div className='map' id='map'>
                    <div className='player' style={Player1} id="1"></div>
                    <div className='player' style={Player2} id="2"></div>
                    <div id="insert">
                    </div>
                </div>
                <div class="slidecontainer">
                    <p className='text-white text-3xl'>Frame : </p>
                    <input type="range" min="0" max="10" value="0" step="1" id="Frame" />
                </div>
            </div>
        )
    }
}
