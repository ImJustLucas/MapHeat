import React, { Component, useState} from 'react';
import Game from './../Data/gametest.json';

export default class Map extends Component {
    constructor(props){
        super(props);

        this.state = {
            hero: "Annie",
            timer: 0,
            frame: 0,
            start: false,
            game: Game,
            player1I : [],
            player1IB : "",
        };


        this.handleChangeFrame = this.handleChangeFrame.bind(this);
        this.incrementeState = this.incrementeState.bind(this);
        this.deincrementeState = this.deincrementeState.bind(this);
    }

        handleChangeFrame(event){
            this.setState({frame: event.target.value});
            this.Start()
        }

    //-----------------------------------------//
                    //FUNCTION
    //-----------------------------------------//

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

    //Inventaire
    PlayerInv(player, itemID, method, itemBis = "null"){
        if(method === "SET"){
            if(player === 1){
                if(itemID === 3340){
                    this.setState({player1IB: itemID})
                }else{
                    var ItemInv = this.state.player1I;
                    ItemInv.push(itemID);
                }
            }

        }
        if(method === "DELETE"){
            //supprime item a l'inventaire
            if(player === 1){
                var ItemInv = this.state.player1I;
                var Indexdelete = ItemInv.indexOf(itemID);
                ItemInv.splice(Indexdelete, 1)
            }
        }
        if(method === "UNDO"){
            if(player === 1){
                var ItemInv = this.state.player1I;
                if(itemID === 0){
                    var Indexdelete = ItemInv.indexOf(itemBis);
                    ItemInv.splice(Indexdelete, 1)     
                }else{
                    var Indexdelete = ItemInv.indexOf(itemBis);
                    ItemInv[Indexdelete] = itemID;
                }
            }
        }
        if(method === "UNDO_r"){
            if(player === 1){
                var ItemInv = this.state.player1I;
                if(itemID === 0){
                    ItemInv.push(itemBis);   
                }else{
                    var Indexdelete = ItemInv.indexOf(itemID);
                    ItemInv[Indexdelete] = itemBis;
                }
            }
        }
    }

    Start(a, status){
        const frame = this.state.game.info.frames[a].events

        //Supprimer icone kill

        var test = document.getElementsByClassName('Lastkill');

        for(var i = test.length - 1; i >= 0; --i){
            test[i].remove()
        }

        if(status === "down"){
            for(i = frame.length - 1; i>0;i--){
                if(frame[i].type === "ITEM_DESTROYED" || frame[i].type === "ITEM_SOLD"){
                    this.PlayerInv(frame[i].participantId, frame[i].itemId, "SET");
                }
                if(frame[i].type === "ITEM_PURCHASED"){
                    this.PlayerInv(frame[i].participantId, frame[i].itemId, "DELETE");
                }
                if(frame[i].type === "ITEM_UNDO"){
                    this.PlayerInv(frame[i].participantId, frame[i].afterId, "UNDO_r", frame[i].beforeId);
                }
            }
        }


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
            }
        });

       


    }



    componentDidMount(){


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
                <div className='flex flex-row gap-4'>
                    <div className='map' id='map'>
                        <div className='player' style={Player1} id="1"></div>
                        <div className='player' style={Player2} id="2"></div>
                        <div id="insert">
                        </div>
                    </div>
                    <div>
                        <div className='card'>
                            <p className='text-white text-xl'>Joueur 1</p>
                            <div className='flex flex-row gap-1'>
                                <div className='flex flex-row gap-1'>
                                    <div className='w-10 h-10 border'>
                                        { this.state.player1I[0] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${this.state.player1I[0]}.png`} />): (<span></span>)}
                                    </div>
                                    <div className='w-10 h-10 border'>
                                        { this.state.player1I[1] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${this.state.player1I[1]}.png`} />): (<span></span>)}
                                    </div>
                                    <div className='w-10 h-10 border'>
                                        { this.state.player1I[2] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${this.state.player1I[2]}.png`} />): (<span></span>)}
                                    </div>
                                </div>
                                <div className='flex flex-row gap-1'>
                                    <div className='w-10 h-10 border'>
                                        { this.state.player1I[3] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${this.state.player1I[3]}.png`} />): (<span></span>)}
                                    </div>
                                    <div className='w-10 h-10 border'>
                                        { this.state.player1I[4] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${this.state.player1I[4]}.png`} />): (<span></span>)}
                                    </div>
                                    <div className='w-10 h-10 border'>
                                        { this.state.player1I[5] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${this.state.player1I[5]}.png`} />): (<span></span>)}
                                    </div>
                                </div>
                                <div className='flex flex-row gap-1'>
                                    <div className='w-10 h-10 border'>
                                        { this.state.player1IB ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${this.state.player1IB}.png`} />): (<span></span>)}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="slidecontainer">
                    <p className='text-white text-3xl'>Minute : {this.state.frame}</p>
                    {/* <input type="range" min="0" max={Object.keys(this.state.game.info.frames).length - 1} value={this.state.frame} onChange={this.handleChangeFrame} /> */}
                    {/* <button onClick={this.incrementeState()}>-1</button> */}
                    <button className='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded' onClick={this.deincrementeState}>-1</button>
                    <button className='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded' onClick={this.incrementeState}>+1</button>
                </div>
            </div>
        )
    }
}
