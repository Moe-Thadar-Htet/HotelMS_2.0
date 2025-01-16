<?php 
function  add_duty_staff($mysqli,$duty_id,$staff_id,$start_date,$end_date)
{
    $sql = "INSERT INTO `duty_staff` (`duty_id`,`staff_id`,`start_date`,`end_date`) VALUE ('$duty_id','$staff_id','$start_date','$end_date')";
    return $mysqli->query($sql);
}
function get_duty_staff($mysqli)
{
    $sql = "SELECT * FROM `duty_staff`";
    return $mysqli->query($sql);
}

function get_duty_staff_id($mysqli,$id)
{
    $sql = "SELECT * FROM `duty_staff` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function delete_duty_staff($mysqli,$id)
{
    $sql = "DELETE FROM `duty_staff` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_duty_staff($mysqli,$id,$duty_id,$staff_id,$start_date,$end_date)
{
    $sql = "UPDATE `duty_staff` SET `duty_id` = '$duty_id',`staff_id`= '$staff_id',`start_date`='$start_date',`end_date` = '$end_date' WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>