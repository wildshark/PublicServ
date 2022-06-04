<?php

class govt{

    public static function login($conn,$r){

        $sql ="SELECT user_admin.* FROM user_admin WHERE user_admin.email LIKE :usr AND user_admin.`password` = :pwd";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':usr'=>'%'.$r['username'].'%',
            ':pwd'=>$r['password']
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function list_public_auth($conn){

        $sql ="SELECT public_serv.*, districts.district FROM public_serv INNER JOIN districts ON public_serv.distID = districts.distID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function list_district($conn){

        $sql ="SELECT * FROM `public_report`.`districts` LIMIT 0,1000";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function list($conn){

        $sql ="SELECT report_data.*, public_serv.public_name, districts.district FROM report_data INNER JOIN public_serv ON report_data.public_authID = public_serv.public_authID INNER JOIN districts ON report_data.distID = districts.distID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>