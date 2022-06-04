<?php

function connection($config){
    $config = $config->server;
    $servername = $config->host;
    $username = $config->usr;
    $password = $config->pwd;
    $dbname = $config->dbm;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    return $conn;
}

function UI_PAGE_LOGIN($page){

    if(!isset($_REQUEST['login'])){
        $href['signup'] ="?reg=client";
    }else{
        switch($_REQUEST['login']){
    
            case"govt";
                $href['signup'] ="?reg=govt";
            break;
        
            case"district"; 
                $href['signup'] ="?reg=district";
            break;
        
            case"public-auth";
                $data = district::all($conn);
                $href['signup'] ="?reg=public-auth";
            break;
        
            default:
                $href['signup'] ="?reg=client";
        }
    }    
    $btn['login'] = "login";
    require($page['login']);
}

function UI_PAGE_REGISTRATION($page){

    switch($_REQUEST['reg']){

        case"admin";
            $view ="admin/views/register.php";
        break;

        case"district";
            $view ="districts/views/register.php";
        break;

        case"public-auth";
            $view ="districts/views/register.php";
        break;

        case"client";
            $view ="districts/views/register.php";
        break;
    }
    require($page['registeration']);
    exit;
}

function UI_PAGE_DASHBOARD_PORTAL($conn,$page){

    $_SESSION['main'] = $_REQUEST['main'];
    
    switch($_SESSION['main']){

        case"govt-portal";
            $side_menu = govt_side_menu($_SESSION['token']);
            if($_REQUEST['ui'] === "dashboard"){
                $table_title = "
                <tr>
                    <th></th>
                    <th>Clock</th>
                    <th>District</th>
                    <th>Public Auth.</th>
                    <th>Geo Location</th>
                    <th>Action</th>
                </tr>";
                $data = govt::list($conn);
                $data_table = all_report_datasheet($data);
                $view = "govt/views/report.php";
                $wp = $page['table'];
            }elseif($_REQUEST['ui'] === "districts"){
                $table_title = "
                <tr>
                    <th></th>
                    <th>District</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>";
                $data = govt::list_district($conn);
                $data_table = district_datasheet($data);
                $view = "govt/views/report.php";
                $wp = $page['table'];
            }elseif($_REQUEST['ui'] === "public-auth"){
                $table_title = "
                <tr>
                    <th></th>
                    <th>District</th>
                    <th>Public Auth.</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>";
                $data = govt::list_public_auth($conn);
                $data_table = public_auth_datasheet($data);
                $view = "govt/views/report.php";
                $wp = $page['table'];
            }else{
                $wp = $page['404'];
            }
        break;

        case"distr-portal";
            $id = $_SESSION['userID'];
            $side_menu = district_side_menu($_COOKIE['token']);
            if($_REQUEST['ui'] == "dashboard"){
                $table_title = "
                <tr>
                    <th></th>
                    <th>Clock</th>
                    <th>District</th>
                    <th>Public Auth.</th>
                    <th>Geo Location</th>
                    <th>Action</th>
                </tr>";
                $data = districts::list($conn,$id);
                $data_table = districts_report_datasheet($data);
                $view = "districts/views/report.php";
                $wp = $page['table'];
            }else{
                $wp = $page['404'];
            }
        break;

        case"pubauth-portal";
            $id = $_SESSION['userID'];
            if($_REQUEST['ui'] == "dashboard"){
                $table_title = "
                <tr>
                    <th></th>
                    <th>Clock</th>
                    <th>District</th>
                    <th>Public Auth.</th>
                    <th>Geo Location</th>
                    <th>Action</th>
                </tr>";
                $data = districts::list($conn,$id);
                $data_table = public_auth_report_datasheet($data);
                $view = "districts/views/report.php";
                $wp = $page['table'];
            }else{
                $wp = $page['404'];
            }
        break;

        case"user-portal";
            if($_REQUEST['ui'] == "dashboard"){

            }else{
                $wp = $page['404'];
            }
        break;

        default:
            $wp = $page['404'];
    }

    require($wp);
}

?>