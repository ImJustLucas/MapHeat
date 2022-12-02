import React, { Component, useState} from 'react';
import Game from './../Data/gametest.json';
import InventoryPlayer from './carte/InventoryPlayer';
import {
    useParams
  } from "react-router-dom";
  import axios from "axios";



export default class Map extends Component {
    constructor(props){
        super(props);

        this.state = {
            hero: null,
            timer: 0,
            frame: 0,
            start: false,
            game: null,
            gameL: 0,
            player1I : [],
            player2I : [],
            player3I : [],
            player4I : [],
            player5I : [],
            player6I : [],
            player7I : [],
            player8I : [],
            player9I : [],
            player10I : [],
            player1IB : 3340,
            player2IB : 3340,
            player3IB : 3340,
            player4IB : 3340,
            player5IB : 3340,
            player6IB : 3340,
            player7IB : 3340,
            player8IB : 3340,
            player9IB : 3340,
            player10IB : 3340,
            isLoading: true,
        };


        this.handleChangeFrame = this.handleChangeFrame.bind(this);
        this.incrementeState = this.incrementeState.bind(this);
        this.deincrementeState = this.deincrementeState.bind(this);
    }

    handleChangeFrame(event){
        if(event.target.value > this.state.frame){
            var minute = this.state.frame + 1;
            for (let index = 0; index < event.target.value - this.state.frame ; index++) {
                this.setState({frame: minute});
                this.Start(minute, "up")
                minute = minute + 1;
            }
        }else if(event.target.value < this.state.frame){
            var minute = this.state.frame;
            for (let index = 0; index < this.state.frame - event.target.value ; index++){
                this.setState({frame: minute});
                this.Start(minute, "down")
                minute = minute - 1;
                this.setState({frame: minute});
                this.Start(minute, "null")
            }
        }
    }


    //Deplacement player
    MovePlayerTo(playerid, x, y){
        const MovePlayer = document.getElementById(playerid);
        MovePlayer.style.left = 'calc(' + x.toString() + '% - 15px )';
        MovePlayer.style.top = 'calc(' + y.toString() + '% - 15px )';
    }

    //Convertir les Coord LOL en Pourcentage
    ConvertCoordToPercent(valuex, valuey){
        valuex = (valuex/15000) * 100;
        valuey = (valuey/15000) * 100;
        return {valuex, valuey}
    }

    //Pose les events Kill sur la cart
    SetEventKill(x, y){
    if(this.state.start === true){

        //Ajout icone kill
        const killicon = document.createElement('div')
        killicon.className = "Lastkill"
        killicon.style.left = 'calc(' + this.ConvertCoordToPercentX(x).toString() + '% - 15px )';
        killicon.style.top= 'calc(' + this.ConvertCoordToPercentY(y).toString() + '% - 15px )';
        document.getElementById("insert").parentNode.insertBefore(killicon, document.getElementById('insert'))
    }
    }

    ConvertCoordToPercentX(valuex){
        valuex = (valuex/15000) * 100;
        return valuex
    }

    ConvertCoordToPercentY(valuey){
        valuey = (valuey/15000) * 100;
        return valuey
    }

    incrementeState(){
        var minute = this.state.frame + 1;
        this.setState({frame: minute});
        this.Start(minute, "up")
    }

    deincrementeState(){
        var minute = this.state.frame;
        this.setState({frame: minute});
        this.Start(minute, "down")
        var minute = this.state.frame - 1;
        this.setState({frame: minute});
        this.Start(minute, "null")
    }

    checkValue(value, arr) {
        var status = false;
    
        for (var i = 0; i < arr.length; i++) {
            var name = arr[i];
            if (name == value) {
                status = true;
                break;
            }
        }
        return status;
    }

    //Inventaire (usine a gaz)
    PlayerInv(player, itemID, method, itemBis = "null"){
        //Certains items sont problématique car évolution, passif ... donc relou
        if(itemID === 2010 || itemID === 2422 || itemID === 2140 || itemID === 3851 || itemID === 3859 || itemID === 2419 || itemID === 2423 || itemID === 2424 || itemID === 2403 || itemID === 3855 || itemID === 2139 || itemID === 2052 || itemID === 2421){
            console.log("Item invalid désoler");
            return null;
        }else{
            if(method === "SET"){
                if(itemID === 3340 || itemID === 3364 || itemID === 3363 || itemID === 3513){
                    this.setState({ ["player"+player+"IB"]: itemID})
                    // this.setState({ [`player${player}IB`]: itemID})
                }else{
                    var ItemInv = this.state["player"+player+"I"];
                    ItemInv.push(itemID);
                }
            }
            if(method === "DELETE"){
                if(itemID === 3340 || itemID === 3364 || itemID === 3363 || itemID === 3513){
                    this.setState({ [`player${player}IB`]: itemID})
                }else{
            
                    if(this.checkValue(itemID, this.state["player"+player+"I"])){
                        var ItemInv = this.state["player"+player+"I"];
                        ItemInv.splice(ItemInv.indexOf(itemID), 1)
                    }else{
                        return null
                    } 
                }
            }
            if(method === "UNDO"){
                var ItemInv = this.state["player"+player+"I"];
                if(itemID === 0){
                    var Indexdelete = ItemInv.indexOf(itemBis);
                    ItemInv.splice(Indexdelete, 1)    
                }else{
                    var Indexdelete = ItemInv.indexOf(itemBis);
                    ItemInv.splice(Indexdelete, 1, itemID)    
                }
            }
            if(method === "UNDO_r"){
                var ItemInv = this.state["player"+player+"I"];
                if(itemID === 0){
                    ItemInv.push(itemBis);   
                }else{
                    var index = ItemInv.indexOf(itemID);
                    if (index > -1) {
                        ItemInv.splice(index, 1);
                    }

                }
            }

        }

    }

    Start(a, status){
        
        if(a === 0)
        {
            //on reset tout les state inventaire car item spéciaux 
            this.setState({
                player1I : [],
                player2I : [],
                player3I : [],
                player4I : [],
                player5I : [],
                player6I : [],
                player7I : [],
                player8I : [],
                player9I : [],
                player10I : [],
        })
            
        }
        if(a < 0){
            return null;
        }

         //Supprimer icone kill

         var deletekill = document.getElementsByClassName('Lastkill');
         var deleteplayerRed = document.getElementsByClassName('playerRed');
         var deleteplayerBleu = document.getElementsByClassName('playerBleu');

         for(var i = deletekill.length - 1; i >= 0; --i){
             deletekill[i].remove()
        }

        for(var i = deleteplayerRed.length - 1; i >= 0; --i){
            deleteplayerRed[i].remove()
       }

       for(var i = deleteplayerBleu.length - 1; i >= 0; --i){
        deleteplayerBleu[i].remove()
   }
            

        const frame = this.state.game.info.frames[a].events
        const participantFrames = this.state.game.info.frames[a].participantFrames

        //gestion participantframe joueur deplacmeent
        for (let player = 1; player <= 10; player++) {
            if(this.state.start === true){
                const playerIcon = document.createElement('div');
                if(player > 5){
                    playerIcon.className = "playerRed";
                }else{
                    playerIcon.className = "playerBleu";
                }
                playerIcon.innerHTML = player;
                playerIcon.style.left = 'calc(' + this.ConvertCoordToPercentX(participantFrames[player].position.x).toString() + '% - 15px )';
                playerIcon.style.top= 'calc(' + this.ConvertCoordToPercentY(participantFrames[player].position.y).toString() + '% - 15px )';
                document.getElementById("insert").parentNode.insertBefore(playerIcon, document.getElementById('insert'))
            }

        }

       
        if(status === "down"){
            for(i = frame.length - 1; i>=0;i--){
                if(frame[i].type === "ITEM_DESTROYED" || frame[i].type === "ITEM_SOLD"){
                    this.PlayerInv(frame[i].participantId, frame[i].itemId, "SET");
                }
                if(frame[i].type === "ITEM_PURCHASED"){
                    this.PlayerInv(frame[i].participantId, frame[i].itemId, "DELETE");
                }
                if(frame[i].type === "ITEM_UNDO"){
                    this.PlayerInv(frame[i].participantId, frame[i].afterId, "UNDO_r", frame[i].beforeId);
                }
                // if(frame[i].type === "WARD_PLACED"){
                //     console.log("remove ward");
                //     var playerYard = frame[i].type.creatorId;
                //     if(playerYard > 5){
                //         this.setState(prevState => ({
                //             wardRed: prevState.wardRed - 1
                //         }));
                //     }else{
                //         this.setState(prevState => ({
                //             wardBleu: prevState.wardBleu - 1
                //         }));
                //     }
    
                // }
            }
        }

        //Gestion events item et kill
        const ReadFrame = frame.forEach(element => {
            this.state.start = true;
            if(element.type === "CHAMPION_KILL"){
                this.SetEventKill(element.position.x, element.position.y);
            }
            if(status === "up"){
                if(element.type === "ITEM_PURCHASED"){

                    this.PlayerInv(element.participantId, element.itemId, "SET");
                }
                if(element.type === "ITEM_DESTROYED" || element.type === "ITEM_SOLD"){
                    this.PlayerInv(element.participantId, element.itemId, "DELETE");
                }if(element.type === "ITEM_UNDO"){
                    this.PlayerInv(element.participantId, element.afterId, "UNDO", element.beforeId);
                }
                // if(element.type === "WARD_PLACED"){
                //     console.log("add ward");
                //     var playerYard = element.creatorId;
                //     if(playerYard > 5){
                //         this.setState(prevState => ({
                //             wardRed: prevState.wardRed + 1
                //         }));
                //     }else{
                //         this.setState(prevState => ({
                //             wardBleu: prevState.wardBleu + 1
                //         }));
                //     }
    
                // }
            }
        });



    }



    componentDidMount(){
        const timeline = window.location.search.slice(10, 25);
        const player = window.location.search.slice(32);
        this.setState({hero : player});
        
        axios.get(`http://127.0.0.1:8000/game/timeline/${timeline}`).then((response) => {
            this.setState({game : response.data.matchTimeline});
            this.setState({gameL : response.data.matchTimeline.info.frames.length - 1});
            this.setState({isLoading: false});
        });

        setTimeout(() => {
            //Relance si jamais l'api "bug"
            if(this.state.isLoading == true){
                axios.get(`http://127.0.0.1:8000/game/timeline/${timeline}`).then((response) => {
                this.setState({game : response.data.matchTimeline});
                this.setState({gameL : response.data.matchTimeline.info.frames.length - 1});
                this.setState({isLoading: false});
            });

            }
        }, "4000");
        

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
        
        if (this.state.isLoading) {
            return <div className="App text-center text-4xl text-white">Loading...</div>;
        }


    
        return (
            <div className='map-size'>
                <div className="background-image" style={backgroundImageLol}>
                    <div className='overlay'></div>
                </div>

                <div className='slidecontainer w-[100vw] fixed z-50 bottom-[0%] flex flex-row justify-between items-center p-3'>
                    <div className='w-[10%]'>
                        <h1 className='text-white text-2xl text-center'>0</h1>
                    </div>
                    <div className='w-[80%]'>
                        <input id="large-range" type="range" defaultValue={this.state.frame} min="0" max={this.state.gameL} onChange={this.handleChangeFrame} step="1" className="my-4 h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer range-lg dark:bg-gray-700 custom-ranger"></input>
                    </div>
                    <div className='w-[10%]'>
                        <h1 className='text-white text-2xl text-center'>{this.state.gameL}</h1>
                    </div>
                </div>

                <div className='mt-3'>
                    <div className='flex flex-row justify-center content-end w-full'>
                        <h2 className='text-white md:text-2xl text-center'>Vous avez joué le champion {this.state.hero}</h2>
                        <img src={`https://ddragon.leagueoflegends.com/cdn/12.18.1/img/champion/${this.state.hero}.png`} width="50px" className='ml-2'></img>
                    </div>
                </div>
                <div className='flex flex-col lg:flex-row gap-4'>
                    <div className='map h-[320px] w-[320px] md:h-[400px] md:w-[400px]' id='map'>
                        <div className='player' style={Player1} id="1"></div>
                        <div className='player' style={Player2} id="2"></div>
                        <div id="insert">
                        </div>
                    </div>
                    <div className='px-[50px] pb-[100px] lg:pb-0 flex flex-col justify-center content-center'>

                        <p className='text-white text-l'>Joueur 1</p>
                        <InventoryPlayer playerI={this.state.player1I} playerIB={this.state.player1IB}/>
                        <p className='text-white text-l'>Joueur 2</p>
                        <InventoryPlayer playerI={this.state.player2I} playerIB={this.state.player2IB}/>
                        <p className='text-white text-l'>Joueur 3</p>
                        <InventoryPlayer playerI={this.state.player3I} playerIB={this.state.player3IB}/>
                        <p className='text-white text-l'>Joueur 4</p>
                        <InventoryPlayer playerI={this.state.player4I} playerIB={this.state.player4IB}/>
                        <p className='text-white text-l'>Joueur 5</p>
                        <InventoryPlayer playerI={this.state.player5I} playerIB={this.state.player5IB}/>
                        <p className='text-white text-l'>Joueur 6</p>
                        <InventoryPlayer playerI={this.state.player6I} playerIB={this.state.player6IB}/>
                        <p className='text-white text-l'>Joueur 7</p>
                        <InventoryPlayer playerI={this.state.player7I} playerIB={this.state.player7IB}/>
                        <p className='text-white text-l'>Joueur 8</p>
                        <InventoryPlayer playerI={this.state.player8I} playerIB={this.state.player8IB}/>
                        <p className='text-white text-l'>Joueur 9</p>
                        <InventoryPlayer playerI={this.state.player9I} playerIB={this.state.player9IB}/>
                        <p className='text-white text-l'>Joueur 10</p>
                        <InventoryPlayer playerI={this.state.player10I} playerIB={this.state.player10IB}/>
                    </div>
                </div>

            </div>
        )
    }
}
