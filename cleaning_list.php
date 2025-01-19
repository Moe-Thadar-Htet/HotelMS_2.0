<?php



?>
<div style="margin-top: 120px;">
    <section id="superior">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">
                    Cleaning List
                </h3>
                <div class="card col-8 mx-auto">
                    <div class="card-body">
                        <table class="table table-bordered  table-striped">
                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Staff Name</th>
                                    <th>Duty Shift</th>
                                    <th>Cleaning Date</th>
                                    <th>Cleaning Time</th>
                                    <th>Room Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $requests = join_cleaning_list($mysqli); ?>
                                <?php $i = 1; ?>
                                <?php while ($request = $requests->fetch_assoc()) { ?>

                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $request["staff_name"] ?></td>
                                        <td><?= $request["duty_name"] ?></td>
                                        <td><?= $request["cleaning_date"] ?></td>
                                        <td><?= $request["cleaning_time"] ?></td>
                                        <td><?= $request["room_no"] ?></td>




                                    </tr>
                                <?php $i++;
                                } ?>


                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
</div>
</section>
</div>