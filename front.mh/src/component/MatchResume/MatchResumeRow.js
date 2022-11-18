import React from 'react';
import MatchResumeGameStatus from './MatchResumeGameStatus';
import MatchResumeGameDetails from './MatchResumeGameDetails';
import MatchResumeLink  from "./MatchResumeLink";
function MatchResumeRow({ Passclass, summonerData, bannerMatch }) {
    console.log(Passclass)
    return (
        <div className={Passclass?.Classrow}>
            <div className={Passclass?.Classflex} >
                <MatchResumeGameStatus data={bannerMatch} />
                <MatchResumeGameDetails data={bannerMatch} summonerData={summonerData} />
            </div>
            <MatchResumeLink data={bannerMatch} />
        </div>
    );
}
export default MatchResumeRow;