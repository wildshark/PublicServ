<?php

function govt_side_menu($token){

    return"
    <li><a href='?main=govt-portal&ui=dashboard&token=$token' class='ai-icon' aria-expanded='false'>
        <i class='flaticon-admin'></i>
        <span class='nav-text'>Dashboard</span>
    </a>
    </li>
    <li><a href='?main=govt-portal&ui=districts&token=$token' class='ai-icon' aria-expanded='false'>
        <i class='flaticon-admin'></i>
        <span class='nav-text'>District Assembly</span>
    </a>
    </li>
    <li><a href='?main=govt-portal&ui=public-auth&token=$token' class='ai-icon' aria-expanded='false'>
        <i class='flaticon-admin'></i>
        <span class='nav-text'>Public Authority</span>
    </a>
    </li>
    <li><a href='?exit=govt' class='ai-icon' aria-expanded='false'>
        <i class='flaticon-admin'></i>
        <span class='nav-text'>Exit</span>
    </a>
    </li>
  ";
}

function all_report_datasheet($data){
    $output ="";
    if($data == false){
       $output="";
    }else{
       foreach($data as $r){
        
        $time = $r['time'];
        $distr = $r['district'];
        $public = $r['public_name'];
        $long = $r['longitude'];
        $lat = $r['latitude'];
        $file = $r['file']; 

        if(!isset($n)){
            $n = 1;
        }else{
            $n = $n + 1;
        }

        $output.="
            <tr>
                <td>$n</td>
                <td>$time</td>
                <td>$distr</td>
                <td>$public</td>
                <td>$long,$lat</td>
                <td>
                    <div class='d-flex'>
                        <a href='javascript:void(0);' class='btn btn-primary shadow btn-xs sharp me-1'><i
                                class='fas fa-pencil-alt'></i></a>
                        <a href='javascript:void(0);' class='btn btn-danger shadow btn-xs sharp'><i
                                class='fa fa-trash'></i></a>
                    </div>
                </td>
            </tr>
        ";
       }
    }
    return $output;
}

function district_datasheet($data){
    $output ="";
    if($data == false){
       $output="";
    }else{
       foreach($data as $r){

        $distr = $r['district'];
        $username = $r['username'];
        $email = $r['email'];
        
        if(!isset($n)){
            $n = 1;
        }else{
            $n = $n + 1;
        }

        $output.="
            <tr>
                <td>$n</td>
                <td>$distr</td>
                <td>$username</td>
                <td>$email</td>
                <td>
                    <div class='d-flex'>
                        <a href='javascript:void(0);' class='btn btn-primary shadow btn-xs sharp me-1'><i
                                class='fas fa-pencil-alt'></i></a>
                        <a href='javascript:void(0);' class='btn btn-danger shadow btn-xs sharp'><i
                                class='fa fa-trash'></i></a>
                    </div>
                </td>
            </tr>
        ";
       }
    }
    return $output;
}

function public_auth_datasheet($data){
    $output ="";
    if($data == false){
       $output="";
    }else{
       foreach($data as $r){
        $distr = $r['district'];
        $public = $r['public_name'];
        $username = $r['username'];
        $email = $r['email'];
        
        if(!isset($n)){
            $n = 1;
        }else{
            $n = $n + 1;
        }

        $output.="
            <tr>
                <td>$n</td>
                <td>$distr</td>
                <td>$public</td>
                <td>$username</td>
                <td>$email</td>
                <td>
                    <div class='d-flex'>
                        <a href='javascript:void(0);' class='btn btn-primary shadow btn-xs sharp me-1'><i
                                class='fas fa-pencil-alt'></i></a>
                        <a href='javascript:void(0);' class='btn btn-danger shadow btn-xs sharp'><i
                                class='fa fa-trash'></i></a>
                    </div>
                </td>
            </tr>
        ";
       }
    }
    return $output;
}



?>