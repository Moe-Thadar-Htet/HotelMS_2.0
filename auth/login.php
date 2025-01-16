<?php


$user = json_decode($_COOKIE["user"],true);
if(!$user){
    header("location:../index.php?invalid=Please Login First!");
}else{

    $url = $_SERVER["REQUEST_URI"];
    $url_arr = explode("/", $url);
    $code = 0;
    if ($url_arr[count( $url_arr) - 2] !== "hms") {
        $role_name =  $url_arr[count( $url_arr) - 2];
        // var_dump($role_name);
        switch ($role_name) {
            case 'admin':
                $code = 1;
                break;
            case 'reception':
                $code = 2;
                break;
            case 'cleaning':
                $code = 3;
                break;
    }
}
if ($code != $user['role']) {
    if($user['role'] != 1){
        header("location:../401.html");
    }
}
}



if(isset($_POST["logout"])){
    setcookie("user", "", -1, "/");
    header("location:../index.php"); 
}
