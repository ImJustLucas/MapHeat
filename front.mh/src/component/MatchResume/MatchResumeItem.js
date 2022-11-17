import React from 'react';

function MatchResumeItem({ dataToChild }) {
    let itemList=[];
    dataToChild.item.forEach((item,index)=>{
        
        if (item == 0) {
            itemList.push (<div key={index} ></div>)
        } else {
            itemList.push( <img key={index} src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${item}.png`}/>)
        }
    })
    return (
        <div className='mcresume__banner--details-img'> 
            {itemList}
        </div>
    );
}

export default MatchResumeItem;