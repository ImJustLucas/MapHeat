import React from 'react';
import MatchResumeItem from './MatchResumeItem';
import MatchResumeSummPerks from './MatchResumeSummPerks';
function MatchResumeGameDetails({ data, summonerData }) {
  const arr = [data]
  return (
    <div className='mcresume__banner--details'>
      {arr.map((match, index) => (
        <div className='mcresume__banner--wrapdetails' key={index}>
          <div>
            <div className='mcresume__banner--details--item'>
              <p>{match.kills}/</p>
              <p>{match.deaths}/</p>
              <p>{match.assists}</p>
            </div>
            {/* kill + assist / mort  */}
            <p>{((match.kills + match.assists) / match.deaths).toFixed(2)} KDA</p>
            <MatchResumeSummPerks dataBanner={arr} dataToChild={summonerData}  />
          </div>
          <div><MatchResumeItem dataToChild={data} /></div>
        </div>
      ))}
    </div>
  );
}

export default MatchResumeGameDetails;