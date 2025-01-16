<?php 

function add_booking($mysqli,$room_id,$checkin_date,$checkout_date,$customer_id)
{
    
    $sql = "INSERT INTO `booking` (`room_id`,`checkin_date`,`checkout_date`,`customer_id`) VALUE ('$room_id','$checkin_date','$checkout_date','$customer_id')";
    return $mysqli->query( $sql);
   
    
}
function sell_booking($mysqli,$room_id,$checkin_date,$checkout_date,$email,$name,$phonenumber,$nrc)
{
    $sql = "SELECT * FROM `customer` WHERE `nrc`='$nrc'";
    $customerResult = $mysqli->query($sql);
    $customerResultID = $mysqli->query($sql);
    if(count($customerResult->fetch_all())==0){
        $sql = "INSERT INTO `customer` (`customer_name`,`phone_no`,`email`) VALUE ('$name','$phonenumber','$email')";
        if($mysqli->query($sql)){
            $sql = "SELECT id FROM `customer` ORDER BY `id` desc limit 1";
            $idResult = $mysqli->query($sql);
            $id = $idResult->fetch_assoc()['id'];
            $sql = "INSERT INTO `booking` (`room_id`,`checkin_date`,`checkout_date`,`customer_id`) VALUE ($room_id,'$checkin_date','$checkout_date',$id)";
            $mysqli->query( $sql);
            $sql = "UPDATE `room` SET `taken`=2 where `id`=$room_id";
            $mysqli->query($sql);
            return true;
        }else{
            return false;
        }
    }else{
        $sql = "UPDATE `customer` SET `customer_name`='$name',`phone_no`='$phonenumber',`email`='$email' WHERE `nrc`='$nrc'";
        if($mysqli->query($sql)) {
            $id = $customerResultID->fetch_assoc()['id'];
            $sql = "INSERT INTO `booking` (`room_id`,`checkin_date`,`checkout_date`,`customer_id`) VALUE ($room_id,'$checkin_date','$checkout_date',$id)";
            $mysqli->query( $sql);
            $sql = "UPDATE `room` SET `taken`=2 where `id`=$room_id";
            $mysqli->query($sql);
            return true;
        }
    }
    
    
    
}
function get_booking($mysqli)
{
    $sql = "SELECT * FROM `booking`";
    return $mysqli->query( $sql);
}
function get_booking_id($mysqli,$id)
{
    $sql = "SELECT * FROM `booking` WHERE `id`='$id'";
    $result = $mysqli->query( $sql);
    return $result->fetch_assoc();
}
function get_bookings($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `booking` ORDER BY `id` LIMIT 7 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_booking_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `booking` WHERE `room_id` LIKE '%$key%' OR `room_id`='$key'";
    return $mysqli->query($sql);
}

function get_booking_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `booking`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 2) ;
    return $page;
}


function delete_booking($mysqli,$id)
{
    $sql = "DELETE FROM `booking` WHERE `id` = $id";
    return $mysqli->query($sql);
}
function update_booking($mysqli,$id,$room_id,$checkin_date,$checkout_date,$customer_id)
{
    $sql = "UPDATE `booking` SET `room_id`='$room_id',`checkin_date`='$checkin_date',`checkout_date`='$checkout_date',`customer_id`='$customer_id' WHERE `id` = $id";
    return $mysqli->query($sql);
}






?>