<?php

function connection(){

    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=public_report", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    return $conn;
}

function page_pregistration($page){
    switch($_REQUEST['reg']){

        case"admin";
            $view ="admin/views/register.php";
        break;

        case"district";
            $view ="districts/views/register.php";
        break;

        case"public-service";
            $view ="districts/views/register.php";
        break;

        case"client";
            $view ="districts/views/register.php";
        break;
    }
    require($page['registeration']);
    exit;
}

?>