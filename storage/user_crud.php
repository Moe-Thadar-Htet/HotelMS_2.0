<?php 
function  add_user($mysqli,$user_name,$email,$password,$phone_number,$role)
{
    $sql = "INSERT INTO `user` (`user_name`,`email`,`password`,`phone_number`,`role`) VALUE ('$user_name','$email','$password','$phone_number','$role')";
    return $mysqli->query($sql);
}
function get_user($mysqli)
{
    $sql = "SELECT * FROM `user`";
    return $mysqli->query($sql);
}


function get_user_id($mysqli,$id)
{
    $sql = "SELECT * FROM `user` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function get_user_with_email($mysqli,$email)
{
    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}
function get_users($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `user` ORDER BY `id` LIMIT 7 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_user_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `user` WHERE `user_name` LIKE '%$key%' OR `email`='$key'";
    return $mysqli->query($sql);
}

function get_users_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `user`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 2) ;
    return $page;
}

function delete_user($mysqli,$id)
{
    $sql = "DELETE FROM `user` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_user($mysqli,$id,$user_name,$email,$password,$phone_number,$role)
{
    $sql = "UPDATE `user` SET `user_name` = '$user_name', `email` = '$email', `password` = '$password',`phone_number`= '$phone_number', `role` = '$role' WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_password($mysqli,$id,$password){
    $hashPassword = password_hash($password,PASSWORD_BCRYPT);
    $sql = "UPDATE `user` SET  `password` = '$hashPassword' WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>