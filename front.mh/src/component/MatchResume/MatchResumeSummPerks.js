import React from 'react';

function MatchResumeSummPerks(summonerData) {
    const Summ = summonerData.dataToChild;
    const arrPlayer = summonerData.dataBanner;
    let SummList=[];
    {arrPlayer.map((match, index) => (
        <div key={index}>
            {Object.values(Summ || {}).map((test, index2) => {
                if (test.key == match.sum_1 || test.key == match.sum_2) { 
                    SummList.push( <img key={index2} src={`http://ddragon.leagueoflegends.com/cdn/12.22.1/img/spell/${test.id}.png`} alt="" />)
                }
            })}
        </div>
    ))
    }
    return (
        <div className='mcresume__banner--img-summ'>
           {SummList}
        </div>
    );
}
export default MatchResumeSummPerks;