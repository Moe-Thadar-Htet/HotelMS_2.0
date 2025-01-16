<?php 
function  add_room_bed($mysqli,$room_bed_name,$room_id,$bed_id,$qty)
{
    $sql = "INSERT INTO `room_bed` (`room_bed_name`,`room_id`,`bed_id`,`qty`) VALUE ('$room_bed_name','$room_id','$bed_id','$qty')";
    return $mysqli->query($sql);
}
function get_room_bed($mysqli)
{
    $sql = "SELECT * FROM `room_bed`";
    return $mysqli->query($sql);
}

function get_room_bed_id($mysqli,$id)
{
    $sql = "SELECT * FROM `room_bed` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function delete_room_bed($mysqli,$id)
{
    $sql = "DELETE FROM `room_bed` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_room_bed($mysqli,$id,$room_bed_name,$room_id,$bed_id,$qty)
{
    $sql = "UPDATE `room_bed` SET `room_bed_name` = '$room_bed_name', `room_id`= $room_id, `bed_id`= $bed_id,`qty`= $qty WHERE `id` = $id";
    return $mysqli->query($sql);
}

?>