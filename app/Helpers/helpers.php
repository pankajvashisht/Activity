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


function IsUcreateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
    $email=explode('@',$email);
    if($email[1]=='ucreate.co.in'){
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