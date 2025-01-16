<?php require_once("./auth/login.php")?> 
<?php

if($user['role']== 1){
    header("location:./admin/index.php");
}
if($user['role']== 2){
    header("location:./reception/index.php");
}
if($user['role']== 3){
    header("location:./cleaning/index.php");
}
?>




