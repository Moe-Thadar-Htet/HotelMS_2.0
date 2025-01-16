
<div style="margin-top: 120px;">
    <section id="superior">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">
                    Superior Room
                </h3>
                <div class="container mt-5">
                    <?php $superior = get_sold_out_superior_rooms($mysqli) ?>
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
                    <?php $deluxe = get_sold_out_deluxe_rooms($mysqli) ?>
                    <div class="row g-3">
                        <?php while ($room = $deluxe->fetch_assoc()) { ?>
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
    <div class="modal fade" id="customerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Number: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Customer Name: </p>
                <p>NRC: </p>
                <p>Phone Number: </p>
                <p>Email Address: </p>
                <p>Check In Date: </p>
                <p>Check Out Date: </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Make it Available</button>
            </div>
        </div>
    </div>
</div>
<?php require_once("../layout/footer2.php") ?>
