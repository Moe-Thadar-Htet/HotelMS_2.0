<?php 
function  add_customer($mysqli,$customer_name,$nrc,$phone_no,$email)
{
    $sql = "INSERT INTO `customer` (`customer_name`,`nrc`,`phone_no`,`email`) VALUE ('$customer_name','$nrc','$phone_no','$email')";
    return $mysqli->query($sql);
    

}
function  sell_customer($mysqli,$customer_name,$nrc,$phone_no,$email,$checkin,$checkout,$roomIdValue)
{
    $sql = "INSERT INTO `customer` (`customer_name`,`nrc`,`phone_no`,`email`) VALUE ('$customer_name','$nrc','$phone_no','$email')";
    if($mysqli->query($sql)) {
        $sql = "SELECT id FROM `customer` ORDER BY `id` desc limit 1";
        $idResult = $mysqli->query($sql);
        $id = $idResult->fetch_assoc()['id'];
        $sql = "UPDATE `room` SET `taken`=1 where `id`=$roomIdValue";
        $mysqli->query($sql);
    }

}

function join_customer_booking($mysqli)
{
    $sql= "SELECT c.*,b.checkin_date,b.checkout_date FROM `customer` c INNER JOIN `booking` b ON c.id = b.customer_id";
    return $mysqli->query($sql);

}
function get_customer($mysqli)
{
    $sql = "SELECT * FROM `customer`";
    return $mysqli->query($sql);
}

function get_customer_id($mysqli,$id)
{
    $sql = "SELECT * FROM `customer` WHERE `id` = $id";
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

function delete_customer($mysqli,$id)
{
    $sql = "DELETE FROM `customer` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_customer($mysqli,$id,$customer_name,$nrc,$phone_no,$email)
{
    $sql = "UPDATE `customer` SET `customer_name` = '$customer_name',`nrc`= '$nrc',`phone_no`= '$phone_no' ,`email` = '$email' WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>