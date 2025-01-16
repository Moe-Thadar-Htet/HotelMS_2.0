<?php 
function  add_room($mysqli, $room_no, $room_type, $single_bed, $double_bed, $twin_bed, $price, $taken)
{
    $sql = "INSERT INTO `room` (`room_no`,`room_type`,`single_bed`,`double_bed`,`twin_bed`,`price`,`taken`) VALUE ('$room_no','$room_type',$single_bed,$double_bed,$twin_bed,'$price',0)";
    try {
        $mysqli->query($sql);
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage() . $e->getCode();
    }
    
}
function get_room($mysqli)
{
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id";
    return $mysqli->query($sql);
}

function get_room_join($mysqli)
{
    $sql= "SELECT r.*,rt.`room_type_name` FROM `room` r INNER JOIN `room_type` rt ON r.room_type= rt.id ";
    return $mysqli->query($sql);

}

function get_room_id($mysqli,$id)
{
    $sql = "SELECT * FROM `room` WHERE `id` = $id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function delete_room($mysqli,$id)
{
    $sql = "DELETE FROM `room` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function update_room($mysqli,$id,$room_no,$room_type,$single_bed, $double_bed, $twin_bed,$price,$taken)
{
    $sql = "UPDATE `room` SET `room_no` = '$room_no', `room_type` = '$room_type',`single_bed`='$single_bed',`double_bed`='$double_bed',`twin_bed`='$twin_bed', `price` = '$price', `taken` = '$taken' WHERE `id` = $id";
    return $mysqli->query($sql);
}
function get_room_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `room` WHERE `room_no` LIKE '%$key%' OR `email`='$key'";
    return $mysqli->query($sql);
}

function get_user_pag_count($mysqli)
{
    $sql = "SELECT COUNT(*) AS total FROM `room`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 9) ;
    return $page;
}

function get_room_by_floor($mysqli,$floor){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id where `room`.room_no like '$floor%'";
    return $mysqli->query($sql);
}

function get_superior_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id where `room_type`.room_type_name like 'Superior%'";
    return $mysqli->query($sql);
}
function get_deluxe_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id  where `room_type`.room_type_name like 'Deluxe%'";
    return $mysqli->query($sql);
}
function get_available_superior_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id where `room_type`.room_type_name like 'Superior%' and `room`.`taken`=0";
    return $mysqli->query($sql);
}
function get_available_deluxe_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id  where `room_type`.room_type_name like 'Deluxe%' and `room`.`taken`=0";
    return $mysqli->query($sql);
}
function get_sold_out_superior_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id where `room_type`.room_type_name like 'Superior%' and `room`.`taken`=1";
    return $mysqli->query($sql);
}
function get_sold_out_deluxe_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id  where `room_type`.room_type_name like 'Deluxe%' and `room`.`taken`=1";
    return $mysqli->query($sql);
}
function get_booked_superior_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id where `room_type`.room_type_name like 'Superior%' and `room`.`taken`=2";
    return $mysqli->query($sql);
}
function get_booked_deluxe_rooms($mysqli){
    $sql = "SELECT `room`.*,`room_type`.room_type_name FROM `room` INNER JOIN `room_type` on `room`.room_type=`room_type`.id  where `room_type`.room_type_name like 'Deluxe%' and `room`.`taken`=2";
    return $mysqli->query($sql);
}
?>