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