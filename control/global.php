<?php

$config ="deploy";
$prefix ="json";
$_TEMPLATE = array(
    "registeration"=>"frame/ui-register.php",
    "login"=>"frame/ui-login.php",
    "table"=>"frame/ui-table.php",
    "404"=>"frame/ui-404.php"   
);

$c = array(
    "domain"=>"iquipdigital.com",   
    "config"=>"deploy"
);

function cmbDistrict($data){

    if($data == false){
        $combo = "<option></option>";
    }else{
        foreach($data as $r){
            $id = $r['distID'];
            $string = $r['districts'];
            $combo .= "<option value='{$id}'>{$string}</option>";
        }
    }
    return $combo;
}

function cmbPublicAuth($data){

    if($data == false){
        $combo = "<option></option>";
    }else{
        foreach($data as $r){
            $id = $r['public_authID'];
            $string = $r['public_name'];
            $combo .= "<option value='{$id}'>{$string}</option>";
        }
    }
    return $combo;
}

function userinfo(){
    $user = $_COOKIE['username'];
    return"<span>$user</span>
    <small>Admin</small>";
}



?>