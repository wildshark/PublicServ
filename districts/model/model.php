<?php

class districts{

    public static function all($conn,$r){

        $sql ="SELECT * FROM `public_report`.`districts` LIMIT 0,1000";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public static function signup($conn,$r){

        $sql ="INSERT INTO `public_report`.`districts`(`username`, `password`, `email`, `districts`) VALUES (:user,:pwd,:mail, :distr)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':usr'=>$r['username'],
            ':pwd'=>$r['password'],
            ':mail'=>$r['email'],
            ':distr'=>$r['district']
        ]);
    }

    public static function login($conn,$r){

        $sql ="SELECT districts.* FROM districts WHERE districts.username = :usr AND districts.`password` = :pwd";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':usr'=>$r['username'],
            ':pwd'=>$r['password']
        ]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function list($conn,$r){

        $sql ="SELECT report_data.* FROM report_data WHERE report_data.distID LIKE :distr";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':distr'=>'%'.$r['district'].'%'
        ]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function details($conn,$r){
        
        $sql ="SELECT report_data.* FROM report_data WHERE report_data.rpt_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id'=>'%'.$r['id'].'%'
        ]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>