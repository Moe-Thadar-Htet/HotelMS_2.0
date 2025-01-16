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
?>