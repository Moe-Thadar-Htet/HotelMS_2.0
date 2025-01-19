<?php require_once("../layout/header2.php") ?>
<?php include_once("../layout/navbar2.php") ?>

<div class="content">
    <?php
    if (isset($_GET['available'])) {
        require_once("../available.php");
    } else if (isset($_GET['soldout'])) {
        require_once("../sold_out.php");
    } else if (isset($_GET['booked'])) {
        require_once("../booked.php");
    } else if (isset($_GET['request'])) {
        require_once("../booking_request.php");
    }else if (isset($_GET['cleaning_list'])) {
        require_once("../cleaning_list.php");
    } else {
        require_once("../all_room.php");
    }
    ?>
</div>
<?php require_once("../layout/footer2.php") ?>

<?php

if(isset($_POST['sell_cus_room_id'])){
    $room_id = $_POST['sell_cus_room_id'];
    $staff_id = $_POST['staff_id'];
    $sql = "UPDATE `room` SET `taken`=0 where `id`=$room_id";
    $mysqli->query($sql);
    $sql = "INSERT INTO `cleaning` (`duty_staff_id`, `room_id`) VALUES ($staff_id, $room_id)";
    $mysqli->query($sql);
    echo "<script>location.replace('?')</script>";
}

if (isset($_GET['make_it_sold_out'])) {
    $room_id = $_GET['make_it_sold_out'];
    $sql = "UPDATE `room` SET `taken`=1 where `id`=$room_id";
    $mysqli->query($sql);
    $sql = "SELECT * FROM `booking` WHERE `room_id`=$room_id order by id desc";
    $bookingResult = $mysqli->query($sql);
    $booking = $bookingResult->fetch_assoc();
    $sql = "INSERT INTO `customer_room` (`customer_id`,`room_id`,`checkin_time`,`checkout_time`) VALUE ($booking[customer_id],$room_id,'$booking[checkin_date]','$booking[checkout_date]')";
    $mysqli->query($sql);
    echo "<script>location.replace('?');</script>";
}

if (isset($_GET['make_it_available'])) {
    $room_id = $_GET['make_it_available'];
    $sql = "UPDATE `room` SET `taken`=0 where `id`=$room_id";
    $mysqli->query($sql);
    echo "<script>location.replace('?');</script>";
}

if (isset($_POST["customer_name"])) {
?>
    <script>
        document.querySelector("#openSellRoomMOdal").click();
    </script>
<?php
}
if (isset($_POST["name"])) {
?>
    <script>
        document.querySelector("#openBookModal").click();
    </script>
<?php
}
if (isset($_GET['bookingConfirm'])) { ?>
    <script>
        document.querySelector("#clickYellow").click();
    </script>
    <?php
    $room_id = $_GET['bookingConfirm'];
    $sql = "select * from `booking` where `room_id`=$room_id order by id desc";
    $customerIdResult = $mysqli->query($sql);
    $customerIdR = $customerIdResult->fetch_assoc();
    $sql = "select * from `room` where `id`=$room_id";
    $roomNumberResult = $mysqli->query($sql);
    $roomNumber = $roomNumberResult->fetch_assoc();
    $customerId = $customerIdR['customer_id'];
    $sql = "select * from `customer` where `id`=$customerId";
    $customerResult = $mysqli->query($sql);
    $customerR = $customerResult->fetch_assoc();

    ?>
    <script>
        let roomNumbers = document.querySelectorAll(".room-no-value");
        roomNumbers.forEach((element) => {
            element.innerHTML = "<?= $roomNumber['room_no'] ?>";
            document.querySelector("#cust__name").innerHTML = "<?= $customerR['customer_name'] ?>";
            document.querySelector("#cust__phone").innerHTML = "<?= $customerR['phone_no'] ?>";
            document.querySelector("#cust__nrc").innerHTML = "<?= $customerR['nrc'] ?>";
            document.querySelector("#book__checkingdate").innerHTML = "<?= $customerIdR['checkin_date'] ?>";
            let available_link = document.querySelectorAll(".make_it_available");
            available_link.forEach((link) => {
                link.href = "?make_it_available=<?= $room_id ?>";
            })
            let sold_link = document.querySelectorAll(".make_it_sold_out");
            sold_link.forEach((link) => {
                link.href = "?make_it_sold_out=<?= $room_id ?>";
            })
        })
    </script>


<?php
}



if (isset($_GET['availableNow'])) {
?>
    <script>
        document.querySelector("#clickRed").click();
    </script>

    <?php
    $room_id = $_GET['availableNow'];
    $sql = "select * from `customer_room` where `room_id`=$room_id order by id desc";
    $customerRoomResult = $mysqli->query($sql);
    $customerRoom = $customerRoomResult->fetch_assoc();
    $customerId = $customerRoom['customer_id'];
    $sql = "select * from `customer` where `id`=$customerId";
    $customerResult = $mysqli->query($sql);
    $customer = $customerResult->fetch_assoc();
    $sql = "select * from `room` where `id`=$room_id";
    $roomNumberResult = $mysqli->query($sql);
    $roomNumber = $roomNumberResult->fetch_assoc();
    $sql = "SELECT ds.id,st.staff_name FROM `staff` st INNER JOIN `duty_staff` ds ON st.id=ds.staff_id INNER JOIN `duty` d ON d.id=ds.duty_id WHERE NOW() BETWEEN d.start_time AND d.end_time";
    $staffRoom = $mysqli->query($sql);
    $staffs = $staffRoom->fetch_all();
    ?>
    <script>
        document.querySelector("#sell_cus_room_id_id").value = "<?= $room_id ?>";
        <?php foreach ($staffs as $key => $value) { ?>
            let option<?= $key ?> = document.createElement("option"); // Create a new option inside the loop
            option<?= $key ?>.value = "<?= $value[0] ?>";
            option<?= $key ?>.textContent = "<?= $value[1] ?>";
            document.querySelector('#sell_cus_select').appendChild(option<?= $key ?>);
        <?php } ?>
    </script>
    <script>
        let roomNumbers2 = document.querySelectorAll(".room-no-value");
        roomNumbers2.forEach((element) => {
            element.innerHTML = "<?= $roomNumber['room_no'] ?>";
            document.querySelector("#sell_cus_name").innerHTML = "<?= $customer['customer_name'] ?>";
            document.querySelector("#sell_cus_phone").innerHTML = "<?= $customer['phone_no'] ?>";
            document.querySelector("#sell_cus_email").innerHTML = "<?= $customer['email'] ?>";
            document.querySelector("#sell_cus_nrc").innerHTML = "<?= $customer['nrc'] ?>";
            document.querySelector("#sell_cus_room_id_id").innerHTML = "<?= $room_id ?>";
            document.querySelector("#sell_cus_checkin").innerHTML = "<?= $customerRoom['checkin_time'] ?>";
            document.querySelector("#sell_cus_checkout").innerHTML = "<?= $customerRoom['checkout_time'] ?>";
            let available_link = document.querySelectorAll(".make_it_available");
            available_link.forEach((link) => {
                link.href = "?make_it_available=<?= $room_id ?>";
            })
        })
    </script>

<?php
}
?>