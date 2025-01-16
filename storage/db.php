<?php

try{
    $mysqli = new mysqli("localhost","root", "");
    $sql = "CREATE DATABASE IF NOT EXISTS `HMS`";
    if($mysqli->query($sql)){
        if($mysqli-> select_db("HMS")){
            create_tables($mysqli);
        }
    }

}catch(\throwable $th){
    echo "Cannot connect the database!";
    die();
}
function create_tables($mysqli)
{
    $sql = "CREATE TABLE IF NOT EXISTS `user`(`id` INT AUTO_INCREMENT,`user_name` VARCHAR(45) NOT NULL ,`email` VARCHAR(100) UNIQUE NOT NULL ,`password` VARCHAR(100) NOT NULL,`phone_number`INT NOT NULL,`role` INT NOT NULL,PRIMARY KEY(`id`)) ";
    if(!$mysqli->query($sql)){
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `customer` (`id` INT AUTO_INCREMENT,`customer_name` VARCHAR(45) NOT NULL,`nrc` VARCHAR(45),`phone_no` INT NOT NULL ,`email` VARCHAR(100) NOT NULL,PRIMARY KEY (`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `room_type`(`id` INT AUTO_INCREMENT,`room_type_name` VARCHAR(45) NOT NULL,`description` VARCHAR(100) NOT NULL, PRIMARY KEY(`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `room`(`id` INT AUTO_INCREMENT,`room_no` VARCHAR(45) UNIQUE NOT NULL,`room_type` INT NOT NULL,`single_bed` INT NOT NULL ,`double_bed` INT NOT NULL ,`twin_bed` INT NOT NULL ,`price` INT NOT NULL,`taken` BOOLEAN NOT NULL,PRIMARY KEY(`id`),FOREIGN KEY (`room_type`) REFERENCES `room_type`(`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
      $sql = "CREATE TABLE IF NOT EXISTS `booking`(`id` INT AUTO_INCREMENT,`room_id` INT NOT NULL,`checkin_date` DATETIME NOT NULL,`checkout_date` DATETIME NOT NULL,`customer_id` INT NOT NULL ,PRIMARY KEY (`id`),FOREIGN KEY (`customer_id`) REFERENCES `customer`(`id`),FOREIGN KEY (`room_id`) REFERENCES `room`(`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }

    // $sql = "CREATE TABLE IF NOT EXISTS `booking`(`id` INT AUTO_INCREMENT,`room_id` INT NOT NULL,`checkin_date` DATETIME NOT NULL,`checkout_date` DATETIME NOT NULL,`customer_id` INT NOT NULL ,PRIMARY KEY (`id`),FOREIGN KEY (`customer_id`) REFERENCES `customer`(`id`),FOREIGN KEY (`room_id`) REFERENCES `room`(`id`))";
    // if (!$mysqli->query($sql)) {
    //     return false;
    // }

    $sql = "CREATE TABLE IF NOT EXISTS `customer_room`(`id` INT AUTO_INCREMENT,`customer_id` INT NOT NULL,`room_id` INT NOT NULL,`checkin_time` DATETIME NOT NULL,`checkout_time` DATETIME NOT NULL,`extra_bed` INT NOT NULL,PRIMARY KEY(`id`),FOREIGN KEY (`customer_id`) REFERENCES `customer`(`id`),FOREIGN KEY (`room_id`) REFERENCES `room`(`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }


    $sql = "CREATE TABLE IF NOT EXISTS `customer` (`id` INT AUTO_INCREMENT,`customer_name` VARCHAR(45) NOT NULL,`nrc` VARCHAR(45) NOT NULL,`phone_no` INT NOT NULL ,`email` VARCHAR(100) NOT NULL,PRIMARY KEY (`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `staff` (`id` INT AUTO_INCREMENT,`staff_name` VARCHAR(45) NOT NULL,`age` INT NOT NULL,`phone_no` INT NOT NULL ,`email` VARCHAR(100) NOT NULL,`gender` INT NOT NULL,`role` VARCHAR(45) NOT NULL ,PRIMARY KEY (`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `duty` (`id` INT AUTO_INCREMENT,`duty_name` VARCHAR(45) NOT NULL,`start_time` TIME NOT NULL,`end_time` TIME NOT NULL,PRIMARY KEY (`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `duty_staff` (`id` INT AUTO_INCREMENT,`duty_id` INT NOT NULL,`staff_id` INT NOT NULL,`start_date` DATE NOT NULL,`end_date` DATE NOT NULL,PRIMARY KEY (`id`),FOREIGN KEY (`duty_id`) REFERENCES `duty`(`id`),FOREIGN KEY (`staff_id`) REFERENCES `staff`(`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
    return true;
}

?>