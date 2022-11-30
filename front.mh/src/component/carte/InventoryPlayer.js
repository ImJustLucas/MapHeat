import React from 'react';

function InventoryPlayer(props){
    // let ListItem = props.playerI.filter(
    //     function(item, pos, self){ 
    //         return self.indexOf(item) == pos;
    //     })

    let ListItem = props.playerI;

    return (
        <div className='flex flex-row gap-1'>
            <div className='flex flex-row gap-1'>
                <div className='w-9 h-9 border'>
                    { ListItem[0] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${ListItem[0]}.png`} />): (<span></span>)}
                </div>
                <div className='w-9 h-9 border'>
                    { ListItem[1] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${ListItem[1]}.png`} />): (<span></span>)}
                </div>
                <div className='w-9 h-9 border'>
                    { ListItem[2] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${ListItem[2]}.png`} />): (<span></span>)}
                </div>
            </div>
            <div className='flex flex-row gap-1'>
                <div className='w-9 h-9 border'>
                    { ListItem[3] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${ListItem[3]}.png`} />): (<span></span>)}
                </div>
                <div className='w-9 h-9 border'>
                    { ListItem[4] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${ListItem[4]}.png`} />): (<span></span>)}
                </div>
                <div className='w-9 h-9 border'>
                    { ListItem[5] ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${ListItem[5]}.png`} />): (<span></span>)}
                </div>
            </div>
            <div className='flex flex-row gap-1'>
                <div className='w-9 h-9 border'>
                    { props.playerIB ? (<img src={`https://ddragon.leagueoflegends.com/cdn/12.21.1/img/item/${props.playerIB}.png`} />): (<span></span>)}
                </div>

            </div>
        </div>
    );
};

export default InventoryPlayer;