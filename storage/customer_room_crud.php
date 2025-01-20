<?php

function add_customer_room($mysqli,$customer_id,$room_id,$checkin_time,$checkout_time,$extra_bed)
{
    $sql = "INSERT INTO `customer_room` (`customer_id`,`room_id`,`checkin_time`,`checkout_time`,`extra_bed`) VALUE ('$customer_id','$room_id','$checkin_time','$checkout_time','$extra_bed')";
    return $mysqli->query($sql);
}
function get_customer_room($mysqli)
{
    $sql = "SELECT * FROM `customer_room`";
    return $mysqli->query($sql);
}

function get_customer_room_id($mysqli,$id)
{
    $sql = "SELECT * FROM `customer_room`WHERE `id`='$id'";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}
function get_customer_rooms_join($mysqli, $currentPage)
{
    $sql = "SELECT cr.*,c.customer_name,r.room_no FROM `customer_room` cr INNER JOIN `customer` c ON cr.customer_id = c.id INNER JOIN `room` r ON cr.room_id = r.id ORDER BY cr.`id`LIMIT 7 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_customer_rooms_filter($mysqli, $key)
{
    $sql = "SELECT cr.*,c.customer_name,r.room_no FROM `customer_room` cr INNER JOIN `customer` c ON cr.customer_id = c.id INNER JOIN `room` r ON cr.room_id = r.id WHERE c.`customer_name` LIKE '%$key%' OR c.`customer_name`='$key'";
    return $mysqli->query($sql);
}

function get_customer_rooms_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `customer_room`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 2) ;
    return $page;
}


function delete_customer_room($mysqli,$id)
{
    $sql = "DELETE FROM `customer_room` WHERE `id`='$id'";
    return $mysqli->query($sql);
}

function update_customer_room($mysqli,$id,$customer_id,$room_id,$checkin_time,$checkout_time,$extra_bed)
{
    $sql = "UPDATE `customer_room` SET`customer_id`='$customer_id',`room_id`='$room_id',`checkin_time`='$checkin_time',`checkout_time`='$checkout_time',`extra_bed`='$extra_bed'  WHERE `id`='$id'";
    return $mysqli->query($sql);
}


?>