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