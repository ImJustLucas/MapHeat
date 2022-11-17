import React from 'react';

function MatchResumeGameStatus({ data }) {

    const arr = [data]
    let WinList=[];
    {arr.map((match, index) => {
        if (match.win == true) {
            WinList.push(<h4 key={index}>Victoire</h4>)
            
        } else {
            WinList.push(<h4 key={index}>Défaite</h4>)
        }
    })}
    console.log(WinList)
    return (
        <div>
            {arr.map((match, index) => (
                <div className='mcresume__banner--wrapbox' key={index}>
                    <div className='mcresume__banner--item'>
                        <h5>{match.gameMode}</h5>
                        <div className='mcresume__banner--item_win'>
                            {WinList}
                            <p>{((match.gameLength / 60).toFixed(2))}</p>
                        </div>
                    </div>
                    <div className='mcresume__banner--icon'>
                        <img src={`https://ddragon.leagueoflegends.com/cdn/12.18.1/img/champion/${match.championName}.png`} alt="" />
                        <div className='mcresume__banner--iconlv'>
                            <p>{match.champLevel}</p>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
}

export default MatchResumeGameStatus;