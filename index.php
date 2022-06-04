<?php
session_start();

include("control/control.php");
include("control/global.php");
include("control/load.php");

include("govt/model/model.php");
include("govt/model/function.php");

include("publicauth/model/model.php");
include("publicauth/model/function.php");

include("districts/model/model.php");
include("districts/model/function.php");

include("user/model/model.php");
include("user/model/function.php");

$_CONN = connection(json_decode(file_get_contents($c['config'])));

if(isset($_REQUEST['exit'])){
    session_destroy();
    unset($_COOKIE);
    header("location: ?login=".$_REQUEST['exit']);
}

if(!isset($_REQUEST['submit'])){
    if(!isset($_REQUEST['main'])){
        if(!isset($_REQUEST['reg'])){
            UI_PAGE_LOGIN($_TEMPLATE);
        }else{
            UI_PAGE_REGISTRATION($_TEMPLATE);
        }
    }else{
        UI_PAGE_DASHBOARD_PORTAL($_CONN,$_TEMPLATE);
    }
}else{

    switch($_REQUEST['submit']){

        case"login";
            
            $response = client::login($_CONN,$_REQUEST);
            if($response == false){
                $response = publicauth::login($_CONN,$_REQUEST);
                if($response == false){
                    $response = districts::login($_CONN,$_REQUEST);
                    if($response == false){
                        $response = govt::login($_CONN,$_REQUEST);
                        if($response == false){
                            header("Location: " . $_SERVER["HTTP_REFERER"]);
                        }else{
                            $usr = md5($response['adm_id']);
                            $_SESSION['token'] = $usr;
                            $_SESSION['userID'] = $response['adm_id'];
                            setcookie("token",$usr);
                            setcookie("username",$response['username']);
                            $url=array(
                                "main"=>"govt-portal",
                                "ui"=>"dashboard",
                                "token"=>$usr
                            );
                        }
                    }else{
                        $usr = md5($response['distID']);
                        $_SESSION['userID'] = $response['distID'];
                        setcookie("token",$usr);
                        setcookie("district",$response['district']);
                        setcookie("username",$response['username']);

                        $url=array(
                            "main"=>"distr-portal",
                            "ui"=>"dashboard",
                            "token"=>$usr
                        );
                    }
                }else{
                    $usr = md5($response['public_authID']);
                    $_SESSION['userID'] = $response['public_authID'];
                    setcookie("token",$usr);
                    setcookie("district",$response['distID']);
                    setcookie("username",$response['username']);

                    $url=array(
                        "main"=>"pubauth-portal",
                        "ui"=>"dashboard",
                        "token"=>$usr
                    );
                }
            }else{
                //client
                setcookie("user",$response['']);
                setcookie("user",$response['']);
            }
           
        break;

        case"public-auth";
            $_R[] = $_REQUEST['username'];
            $_R[] = $_REQUEST['password'];
            $_R[] = $_REQUEST['email'];
            $_R[] = $_REQUEST['district'];
            $response = publicauth::signup($_CONN,$_R);
            var_dump($response);
            exit;
        break;

        case"district-signup";
            $_R[] = $_REQUEST['username'];
            $_R[] = $_REQUEST['password'];
            $_R[] = $_REQUEST['email'];
            $_R[] = $_REQUEST['district'];
            $response = districts::signup($_CONN,$_R);
            if($response == false){
                $url = array(
                    "reg"=>"district",
                    "status"=>"failed"
                );
            }else{
                $url = array(
                    "login"=>"district",
                    "status"=>"success"
                );
            }
        break;

        case"client-signup";
            $response = client::signup($_CONN,$_REQUEST);
            var_dump($response);
            exit;
        break;
    }

    header("location: ?".http_build_query($url));

}
$_CONN = null;
?>