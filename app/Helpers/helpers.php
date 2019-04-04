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


function unique_slot($slot,$booking,$date){
    $final=[];
    foreach($slot as $key => $value){
        if(!check_slot($value['id'],$booking)){
            if(date('y-m-d')==date('y-m-d',$date)){
                $current_hr = date('H:i');
                if(strtotime($value['to']) > strtotime($current_hr)){
                    $final[]=$value;
                }
            }else{
                $final[]=$value;
            }
        }    
    }
    return $final;
}

function check_slot($slot,$booking){
    $booked_slot= array_column($booking,'slot_id');
    if(in_array($slot,$booked_slot)){
        foreach($booking as $key => $value){
            if($value['game']['total_games'] == slot($booking,$slot)){
                return true;
            }
        }
    }
    return false;
}

function slot($booking,$slot_id){
    $count=0;
    foreach ($booking as $key => $value) {
        if($value['slot_id']==$slot_id){
            $count++;
        }
    }
    return $count;
}

function IsUcreateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
    $email=explode('@',$email);
    if($email[1]=='ucreate.co.in' || $email[1]=='ucreate.it'){
        return true;
    }
    return false;
}


function flash_message($message='',$class="i"){
    switch ($class) {
        case "s":
            $active_class="success";
            break;
        case "i":
            $active_class="info";
            break;
        case "d":
            $active_class="danger";
            break;
        case "p":
            $active_class="primary";
            break;    
        default:
            $active_class="default";
            break;  
    }

    session()->flash('message',$message);
    session()->flash('class',$active_class);
}