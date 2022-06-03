<?php

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

?>