<?php 
function  add_staff($mysqli,$staff_name,$age,$phone_no,$email,$gender,$role)
{
    $sql = "INSERT INTO `staff` (`staff_name`,`age`,`phone_no`,`email`,`gender`,`role`) VALUE ('$staff_name','$age','$phone_no','$email','$gender','$role')";
    return $mysqli->query($sql);
}
function get_staff($mysqli)
{
    $sql = "SELECT * FROM `staff`";
    return $mysqli->query($sql);
}

function get_staff_id($mysqli,$id)
{
    $sql = "SELECT * FROM `staff` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function get_staffs($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `staff` ORDER BY `id` LIMIT 7 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_staff_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `staff` WHERE `staff_name` LIKE '%$key%' OR `email`='$key'";
    return $mysqli->query($sql);
}

function get_staffs_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `staff`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 2) ;
    return $page;
}

function delete_staff($mysqli,$id)
{
    $sql = "DELETE FROM `staff` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_staff($mysqli,$id,$staff_name,$age,$phone_no,$email,$gender,$role)
{
    $sql = "UPDATE `staff` SET `staff_name` = '$staff_name',`age`= '$age',`phone_no`= '$phone_no',`email` = '$email',`gender`= '$gender',`role`= '$role' WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>