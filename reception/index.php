<?php require_once("../layout/header2.php") ?>
<?php include_once("../layout/navbar2.php") ?>

<div class="content">
    <?php
        if(isset($_GET['available'])){
            require_once("../available.php");
        }  else if(isset($_GET['soldout'])) {
            require_once("../sold_out.php");
        } else if(isset($_GET['booked'])){
            require_once("../booked.php");
        } else if(isset($_GET['request'])){
            require_once("../booking_request.php");
        }else{
            require_once("../all_room.php");
        }
     ?>
</div>
<?php require_once("../layout/footer2.php") ?>

<?php 

if(isset($_GET['make_it_sold_out'])){
    $room_id = $_GET['make_it_sold_out'];
    $sql = "UPDATE `room` SET `taken`=1 where `id`=$room_id";
    $mysqli->query($sql);
    echo "<script>location.replace('?');</script>";
}

if(isset($_GET['make_it_available'])){
    $room_id = $_GET['make_it_available'];
    $sql = "UPDATE `room` SET `taken`=0 where `id`=$room_id";
    $mysqli->query($sql);
    echo "<script>location.replace('?');</script>";
}

if(isset($_POST["customer_name"])){
    ?>
    <script>
        document.querySelector("#openSellRoomMOdal").click();
    </script>
    <?php
}
if(isset($_POST["name"])){
    ?>
    <script>
        document.querySelector("#openBookModal").click();
    </script>
    <?php
}
if(isset($_GET['bookingConfirm'])){ ?>
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
            roomNumbers.forEach((element)=>{
                element.innerHTML = "<?= $roomNumber['room_no']?>";
                document.querySelector("#cust__name").innerHTML = "<?= $customerR['customer_name']?>";
                document.querySelector("#cust__phone").innerHTML = "<?= $customerR['phone_no'] ?>";
                document.querySelector("#book__checkingdate").innerHTML = "<?= $customerIdR['checkin_date'] ?>";
                let available_link = document.querySelectorAll(".make_it_available");
                available_link.forEach((link)=>{
                    link.href = "?make_it_available=<?= $room_id ?>";
                })
                let sold_link = document.querySelectorAll(".make_it_sold_out");
                sold_link.forEach((link)=>{
                    link.href = "?make_it_sold_out=<?= $room_id ?>";
                })
            })
    </script>


    <?php
}



if(isset($_GET['availableNow'])){
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
    ?>
    <script>
    let roomNumbers2 = document.querySelectorAll(".room-no-value");
            roomNumbers2.forEach((element)=>{
                element.innerHTML = "<?= $roomNumber['room_no']?>";
                document.querySelector("#sell_cus_name").innerHTML = "<?= $customer['customer_name']?>";
                document.querySelector("#sell_cus_phone").innerHTML = "<?= $customer['phone_no']?>";
                document.querySelector("#sell_cus_email").innerHTML = "<?= $customer['email']?>";
                document.querySelector("#sell_cus_checkin").innerHTML = "<?= $customerRoom['checkin_time']?>";
                document.querySelector("#sell_cus_checkout").innerHTML = "<?= $customerRoom['checkout_time']?>";
                let available_link = document.querySelectorAll(".make_it_available");
                available_link.forEach((link)=>{
                    link.href = "?make_it_available=<?= $room_id ?>";
                })
            })
    </script>

<?php
}
?>