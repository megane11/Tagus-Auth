<?php

    class Connect extends PDO{
        public function __construct()
        {
           parent::__construct("mysql:host=localhost;dbname=Google_login", "root","megane", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
           
        }
        
    }
    class Controller{
        //generate char
        // function generateCode($length){
        //     $char = "vwyABC01256";
        //     $code ="";
        //     $clean = strlen($char) - 1;
        //     while(strlen($code) < $length){
        //         $code .= $char[mt_rand(0, $clean)];
        //     }
        //     return $code;
        // }
        //insert data in db
        function insertData($data){
            $db = new Connect;
            // return $data['avatar'];
            $checkuser = $db->prepare("SELECT * FROM users WHERE email=:email");
            $checkuser->execute(['email' => $data["email"]]);
            $info = $checkuser->fetch(PDO::FETCH_ASSOC);

            if(!$info['id']){
                // $session = $this->generateCode(10);
                $insertUser = $db -> prepare("INSERT INTO users (Fname, Lname, Avatar, Email, Password, Session) VALUES (:f_name, :l_name, :avatar, :email, :password, :session)");
                $insertUser-> execute([
                    ':f_name' => $data["givenName"],
                    ':l_name' => $data["familyName"],
                    ':avatar' => $data["avatar"],
                    ':email' => $data["email"],
                    ':password' => "123" /*$this->generateCode(5)*/,
                    ':session' => "456"/*$session*/

                ]);
                // if($insertUser){
                //     setcookie("id", $db->lastInsertId(), time()+60*60*24*30, "/", NULL);
                //     setcookie("id",$session, time()+60*60*24*30, "/", NULL);
                // }
            }
        }
    }
?>