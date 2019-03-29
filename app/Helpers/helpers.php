<?php 


function currentWeek(){
    if(date('D')!='Mon'){    
        $start = strtotime('last Monday');    
    }else{
        $start = strtotime('-1  day',time());   
    }
    if(date('D')!='Sat'){
        $end = strtotime('next Saturday');
    }else{
        $end = strtotime('-1  day',time());  
    }
    return [$start,$end];
}


function unique_slot($slot,$booking){
    foreach($slot as $key => $value){
        
    }
}