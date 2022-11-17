import React from 'react';

function MatchResumeGameStatus({ data }) {
    
    const arr = [data]
    return (
        <div>
            {arr.map((match, index) => (
                <div className='mcresume__banner--wrapbox' key={index}>
                    <div className='mcresume__banner--item'>
                        <h5>{match.gameMode}</h5>
                        <div className='mcresume__banner--item_win'>
                            <h4>Victoire</h4>
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