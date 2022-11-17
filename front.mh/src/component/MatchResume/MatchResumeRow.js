import React from 'react';
import MatchResumeGameStatus from './MatchResumeGameStatus';
import MatchResumeGameDetails from './MatchResumeGameDetails';

function MatchResumeRow({parentToChild , summonerData , bannerMatch}) {
    return (
        <div className="mcresume__banner--wrapmc">
            <MatchResumeGameStatus data={bannerMatch}/>
            <MatchResumeGameDetails data={bannerMatch} summonerData={summonerData}/>
        </div>
    );
}

export default MatchResumeRow;