<?php

function add_customer_room($mysqli,$customer_id,$room_id,$checkin_time,$checkout_time,$extra_bed)
{
    $sql = "INSERT INTO `customer_room` (`customer_id`,`room_id`,`checkin_id`,`checkout_time`,`extra_bed`,`status`) VALUE ('$customer_id','$room_id','$checkin_time','$checkout_time','$extra_bed')";
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
function get_customers($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `customer` ORDER BY `id` LIMIT 7 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_customer_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `customer` WHERE `customer_name` LIKE '%$key%' OR `email`='$key'";
    return $mysqli->query($sql);
}

function get_customers_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `customer`";
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