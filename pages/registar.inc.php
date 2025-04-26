<?php
//pra pegar os dados do form la
if (isset($_POST["submit"])){
    
    
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];
    
    //instancia do controller do registar 
    include "../classes/Database.class.php";
    include "../classes/registar.model.class.php";
    include "../classes/registar.controller.class.php";

    $registar = new registarController($uid, $pwd, $pwdrepeat, $email);
    
    $registar->registarUtilizador(); 
    
    header("location: ../index.php?error=none");
}
