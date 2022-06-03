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



?>