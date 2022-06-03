<?php
session_start();
require("control/control.php");
require("control/global.php");
require("districts/model/model.php");
require("districts/model/function.php");
$conn = connection();
if(!isset($_REQUEST['submit'])){
    if(!isset($_REQUEST['reg'])){
        require($_TEMPLATE['login']);
    }else{
        page_pregistration($_TEMPLATE);
    }
}else{

    switch($_REQUEST['submit']){

        case"public-auth";
            $response = publicauth::signup($conn,$_REQUEST);
        break;

        case"district-signup";
            $response = districts::signup($conn,$_REQUEST);
            var_dump($response);
        break;

        case"client-signup";
            $response = client::signup($conn,$_REQUEST);
        break;
    }

}

?>