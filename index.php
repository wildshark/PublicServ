<?php
session_start();

require("districts/model/model.php");
require("districts/model/function.php");

if(!isset($_REQUEST['submit'])){
    if(!isset($_REQUEST['usr'])){
        header("location: ?usr=client&p=login");
        exit();
    }else{
        if($_REQUEST['usr']==="public-auth"){
            if(!isset($_REQUEST['main'])){
                header("location: ?usr=district&p=login");
            }else{
                switch($_REQUEST['main']){
    
                    case"login";
    
                    break;
                    
                    case"dashboard";
    
                    break;
                }
            }
        }elseif($_REQUEST['usr']==="district"){
            if(!isset($_REQUEST['main'])){
                header("location: ?usr=district&p=login");
            }else{
                switch($_REQUEST['main']){
                    
                    case"dashboard";
    
                    break;
                }
            }
        }else{
            require("frame/ui-login.php");
        }
    }
}else{

}

?>