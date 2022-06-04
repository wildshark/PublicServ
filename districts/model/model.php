<?php

class districts{

    public static function all($conn,$r){

        $sql ="SELECT * FROM `public_report`.`districts` LIMIT 0,1000";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public static function signup($conn,$request){

        $sql ="INSERT INTO `districts`(`username`, `password`, `email`, `district`) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute($request);
    }

    public static function login($conn,$r){

        $sql ="SELECT districts.* FROM districts WHERE districts.email LIKE :usr AND districts.`password` = :pwd";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':usr'=>'%'.$r['username'].'%',
            ':pwd'=>$r['password']
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function list($conn,$id){

        $sql ="SELECT
        report_data.*, 
        public_serv.public_name, 
        districts.district
    FROM
        report_data
        INNER JOIN
        public_serv
        ON 
            report_data.public_authID = public_serv.public_authID
        INNER JOIN
        districts
        ON 
            report_data.distID = districts.distID
    WHERE
        report_data.distID =:id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id'=>$id]);
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