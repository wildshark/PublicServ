<?php

class client{

    public static function signup($conn,$r){

        $sql ="INSERT INTO `public_report`.`city_user`(`distID`, `username`, `password`, `email`) VALUES (:distr,:usr,:pwd,:mail)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':usr'=>$r['username'],
            ':pwd'=>$r['password'],
            ':mail'=>$r['email'],
            ':distr'=>$r['district']
        ]);
    }

    public static function login($conn,$r){

        $sql ="SELECT city_user.* FROM city_user WHERE city_user.email LIKE :usr AND city_user.`password` = :pwd";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':usr'=>'%'.$r['username'].'%',
            ':pwd'=>$r['password']
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>