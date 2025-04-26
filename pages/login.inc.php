<?php
//pra pegar os dados do form la
if (isset($_POST["submit"])){
    
    
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    
    //instancia do controller do registar 
    include "../classes/Database.class.php";
    include "../classes/login.model.class.php";
    include "../classes/login.controller.class.php";

    $login = new loginController($uid, $pwd);
    
    $login->logarUtilizador(); 
    
    header("location: ../index.php?error+none");
}
