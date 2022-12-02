import React from 'react';
import { Link } from "react-router-dom";

function MatchResumeLink({ data }) {
    const arrData = [data]


    return (
        <div className='mcLink'>
            {arrData?.map((data, key) => (
                <Link key={key} to={`/map?timeline=${data.Matchid}&champ=${data.championName}`}>
                    BUTTON
                </Link>
            ))}

        </div>
    );
}

export default MatchResumeLink;