import React from 'react';
import MatchResumeGameStatus from './MatchResumeGameStatus';
import MatchResumeGameDetails from './MatchResumeGameDetails';
import MatchResumeLink from "./MatchResumeLink";
function MatchResumeRow({ Passclass, summonerData, bannerMatch }) {
    let itemList=[];
    if (bannerMatch.gameMode != 'ARAM') {
        itemList.push( <MatchResumeLink data={bannerMatch} />)
    } else {
        itemList.push( <div class="mcLink"><p>BUTTON</p></div>)
    }
    return (
        <div className={Passclass?.Classrow}>
            <div className={Passclass?.Classflex} >
                <MatchResumeGameStatus data={bannerMatch} />
                <MatchResumeGameDetails data={bannerMatch} summonerData={summonerData} />
            </div>
            {itemList}
        </div>
    );
}
export default MatchResumeRow;