<?php

class publicauth{

    public static function signup($conn,$r){

        $sql ="INSERT INTO `public_report`.`public_serv`(`distID`, `public_name`, `username`, `password`, `email`) VALUES (:distr, '1', '1', '1', '1')";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':usr'=>$r['username'],
            ':pwd'=>$r['password'],
            ':mail'=>$r['email'],
            ':distr'=>$r['district']
        ]);
    }

    public static function login($conn,$r){

        $sql ="SELECT public_serv.* FROM public_serv WHERE public_serv.email LIKE :usr AND public_serv.`password` = :pwd";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':usr'=>'%'.$r['username'].'%',
            ':pwd'=>$r['password']
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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