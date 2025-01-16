<?php 



?>
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
                    <?php $superior = get_booked_superior_rooms($mysqli) ?>
                    <div class="row g-3">
                        <?php while ($room = $superior->fetch_assoc()) { ?>
                            <div class="col-2">
                                <button data-bs-toggle="modal"
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
                    <?php $superior = get_booked_deluxe_rooms($mysqli) ?>
                    <div class="row g-3">
                        <?php while ($room = $superior->fetch_assoc()) { ?>
                            <div class="col-2">
                                <button data-bs-toggle="modal"
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
<div class="modal fade" id="bookingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Number: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <div class="modal-body">
                    <p>Customer Name: </p>
                    <p>Phone Number: </p>
                    <p>Check In Date: </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Make it Available</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sellRoomModal">Make it Sold-out</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sellRoomModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Number: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-floating mt-2">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Customer name" />
                        <label for="name" class="form-label">Customer Name</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="text" name="nrc" class="form-control" id="nrc" placeholder="NRC" />
                        <label for="nrc" class="form-label">NRC</label>
                    </div>

                    <div class="form-floating mt-2">
                        <input type="phoneNumber" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Phone Number" />
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                    </div>

                    <div class="form-floating mt-2">
                        <input type="email" name="email" class="form-control" id="email" placeholder="email" />
                        <label for="email" class="form-label">Email Address</label>
                    </div>

                    <div class="form-floating mt-2">
                        <div class="mt-4">Check-in Date
                            <input type="date" name="checkin" class="form-control" id="checkin" required="">
                        </div>
                        <div class="mt-4">Check-out Date
                            <input type="date" name="checkout" class="form-control" id="checkout" required="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Sell a Room</button>
            </div>
        </div>
    </div>
</div>

<?php require_once("../layout/footer2.php") ?>
