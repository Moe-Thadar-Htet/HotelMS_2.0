<?php 
function  add_duty($mysqli,$duty_name,$start_time,$end_time)
{
    $sql = "INSERT INTO `duty` (`duty_name`,`start_time`,`end_time`) VALUE ('$duty_name','$start_time','$end_time')";
    return $mysqli->query($sql);
}
function get_duty($mysqli)
{
    $sql = "SELECT * FROM `duty`";
    return $mysqli->query($sql);
}

function get_duty_id($mysqli,$id)
{
    $sql = "SELECT * FROM `duty` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function get_duties($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `duty` ORDER BY `id` LIMIT 7 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_duty_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `duty` WHERE `duty_name` LIKE '%$key%' OR `duty_name`='$key'";
    return $mysqli->query($sql);
}

function get_duty_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `duty`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 2) ;
    return $page;
}

function delete_duty($mysqli,$id)
{
    $sql = "DELETE FROM `duty` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_duty($mysqli,$id,$duty_name,$start_time,$end_time)
{
    $sql = "UPDATE `duty` SET `duty_name` = '$duty_name',`start_time`='$start_time',`end_time` = '$end_time' WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>