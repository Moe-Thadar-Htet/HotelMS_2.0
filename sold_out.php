
<div style="margin-top: 120px;">
    <section id="superior">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">
                    Superior Room
                </h3>
                <!-- <div class="d-flex justify-content-between">
                    <h6><i class="text-primary">Even Number = Double Bed</i></h6>
                    <h6><i class="text-primary">Odd Number = Twin Bed</i></h6>
                </div> -->
                <div class="container mt-5">
                    <?php $superior = get_sold_out_superior_rooms($mysqli) ?>
                    <div class="row g-3">
                        <?php while ($room = $superior->fetch_assoc()) { ?>
                            <div class="col-2">
                                <button class="d-none" id="clickYellow" data-bs-toggle="modal" data-bs-target="#bookingModal" > </button>
                                <button class="d-none" id="clickRed" data-bs-toggle="modal" data-bs-target="#customerModal" > </button>
                                <button onclick="<?php
                                if ($room['taken'] == 2) {
                                    ?>
                                    location.replace('?bookingConfirm=<?= $room['id'] ?>');
                                    <?php
                                }else if($room['taken'] == 1){
                                    ?>
                                    location.replace('?availableNow=<?= $room['id'] ?>');
                                    <?php
                                }
                                ?>" data-id="<?= $room['id'] ?>" data-value="<?= $room['room_no'] ?>" data-bs-toggle="modal"
                                    data-bs-target="#<?php
                                                        if ($room['taken'] == 0) {
                                                            echo "addModal";
                                                        } else if ($room['taken'] == 1) {
                                                            echo "customerModal";
                                                        } else {
                                                            echo "bookingModal";
                                                        }
                                                        ?>"
                                    class="room-btn <?php
                                                    if ($room['taken'] == 0) {
                                                        echo "green";
                                                    } else if ($room['taken'] == 1) {
                                                        echo "red";
                                                    } else {
                                                        echo "yellow";
                                                    }
                                                    ?>">
                                    <span><?= $room['room_type_name'] ?></span>
                                    <h1><?= $room['room_no'] ?></h1>
                                </button>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div style="margin-top: 30px;">
    <section id="deluxe">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">
                    Deluxe Room
                </h3>
                <!-- <div class="d-flex justify-content-between">
                    <h6><i class="text-primary">Even Number = Twin Bed</i></h6>
                    <h6><i class="text-primary">Odd Number = Double Bed</i></h6>
                </div> -->
                <!-- Grid container for buttons -->
                <div class="container mt-5">
                    <?php $superior = get_sold_out_deluxe_rooms($mysqli) ?>
                    <div class="row g-3">
                        <?php while ($room = $superior->fetch_assoc()) { ?>
                            <div class="col-2">
                                <button class="d-none" id="clickYellow" data-bs-toggle="modal" data-bs-target="#bookingModal" > </button>
                                <button class="d-none" id="clickRed" data-bs-toggle="modal" data-bs-target="#customerModal" > </button>
                                <button onclick="<?php
                                if ($room['taken'] == 2) {
                                    ?>
                                    location.replace('?bookingConfirm=<?= $room['id'] ?>');
                                    <?php
                                }else if($room['taken'] == 1){
                                    ?>
                                    location.replace('?availableNow=<?= $room['id'] ?>');
                                    <?php
                                }
                                ?>" data-id="<?= $room['id'] ?>" data-value="<?= $room['room_no'] ?>" data-bs-toggle="modal"
                                    data-bs-target="#<?php
                                                        if ($room['taken'] == 0) {
                                                            echo "addModal";
                                                        } else if ($room['taken'] == 1) {
                                                            echo "customerModal";
                                                        } else {
                                                            echo "bookingModal";
                                                        }
                                                        ?>"
                                    class="room-btn <?php
                                                    if ($room['taken'] == 0) {
                                                        echo "green";
                                                    } else if ($room['taken'] == 1) {
                                                        echo "red";
                                                    } else {
                                                        echo "yellow";
                                                    }
                                                    ?>">
                                    <span><?= $room['room_type_name'] ?></span>
                                    <h1><?= $room['room_no'] ?></h1>
                                </button>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="customerModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title">Room Number: <span class="room-no-value"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Customer Name: <span id="sell_cus_name" style="color: #007bff; padding-left: 10px"></span></p>
                <p>Phone Number: <span id="sell_cus_phone" style="color: #007bff; padding-left: 10px"></span></p>
                <p>NRC : <span id="sell_cus_nrc" style="color: #007bff; padding-left: 10px"></span></p>
                <p>Email Address: <span id="sell_cus_email" style="color: #007bff; padding-left: 10px"></span></p>
                <p>Check In Date: <span id="sell_cus_checkin" style="color: #007bff; padding-left: 10px"></span></p>
                <p>Check Out Date: <span id="sell_cus_checkout" style="color: #007bff; padding-left: 10px"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a  class="btn btn-success make_it_available">Make it Available</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bookingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Number: <span class="room-no-value"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <p>Customer Name: <span id="cust__name"style="color: #007bff; padding-left: 10px" ></span></p>
                    <p>Phone Number: <span id="cust__phone" style="color: #007bff; padding-left: 10px"></span></p>
                    <p>Check In Date: <span id="book__checkingdate" style="color: #007bff; padding-left: 10px"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a  class="btn btn-success make_it_available">Make it Available</a>
                <a  class="btn btn-danger make_it_sold_out">Make it Sold-out</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Number: <span class="room-no-value"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <button type="button" id="openSellRoomMOdal" data-bs-toggle="modal" data-bs-target="#sellRoomModal" class="btn btn-danger" style="width: 48%; height: 50px">Sell a room</button>
                <button type="submit" id="openBookModal" data-bs-toggle="modal" data-bs-target="#bookRoomModal" class="btn btn-warning" style="width: 48%; height: 50px">Book a room</button>
            </div>
        </div>
    </div>

</div>
<!-- for sell room  -->
<?php require_once('../sellroom.php') ?>
<!-- for book room -->
<?php require_once('../bookroom.php') ?>


</div>

<?php require_once("../layout/footer2.php") ?>