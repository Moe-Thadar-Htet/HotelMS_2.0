<?php 
function  add_bed($mysqli,$bed_name)
{
    $sql = "INSERT INTO `bed` (`bed_name`) VALUE ('$bed_name')";
    return $mysqli->query($sql);
}
function get_bed($mysqli)
{
    $sql = "SELECT * FROM `bed`";
    return $mysqli->query($sql);
}

function get_bed_id($mysqli,$id)
{
    $sql = "SELECT * FROM `bed` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function delete_bed($mysqli,$id)
{
    $sql = "DELETE FROM `bed` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_bed($mysqli,$id,$bed_name)
{
    $sql = "UPDATE `bed` SET `bed_name` = '$bed_name' WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>