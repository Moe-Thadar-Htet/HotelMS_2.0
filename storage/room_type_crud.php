<?php 
function  add_room_type($mysqli,$room_type_name,$description)
{
    $sql = "INSERT INTO `room_type` (`room_type_name`,`description`) VALUE ('$room_type_name','$description')";
    return $mysqli->query($sql);
}
function get_room_type($mysqli)
{
    $sql = "SELECT * FROM `room_type`";
    return $mysqli->query($sql);
}

function get_room_type_id($mysqli,$id)
{
    $sql = "SELECT * FROM `room_type` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}
function get_room_types($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `room_type` ORDER BY `id` LIMIT 7 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_room_types_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `room_type` WHERE `room_type_name` LIKE '%$key%' OR `room_type_name`='$key'";
    return $mysqli->query($sql);
}

function get_room_types_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `room_type`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 2) ;
    return $page;
}

function delete_room_type($mysqli,$id)
{
    $sql = "DELETE FROM `room_type` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_room_type($mysqli,$id,$room_type_name,$description)
{
    $sql = "UPDATE `room_type` SET `room_type_name` = '$room_type_name',`description`='$description' WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>