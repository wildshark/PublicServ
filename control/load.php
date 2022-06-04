<?php

if(!file_exists("deploy")){
    require("frame/ui-500.php");
    exit();
}else{
    $json = json_decode(file_get_contents("deploy"));

    function load_application($config){

        $s = $config->application;
        if(false == password_verify($_SERVER['SERVER_NAME'],$s->key)){
            header("location: https://key.iquipedigital.com?q=project-wonder");
            exit;
        }else{
            return true;
        };

    }
    load_application($json);
}

?>