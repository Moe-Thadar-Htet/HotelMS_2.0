
<?php 



?>
<div style="margin-top: 120px;">
    <section id="superior">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">
                   Booking Request List
                </h3>
                <div class="card col-8 mx-auto">
                    <div class="card-title">
                        <div class="d-flex p-3">
                            <h2 class="" style="color: var(--nav-color);">Booking List</h2>
                            <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered  table-striped">
                                <thead>
                                
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>NRC</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Checkin Date</th>
                                        <th>Checkout Date</th>
                                        <th>Action</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $customers = get_customer($mysqli);$i = 1;?>
                                <?php while ($customer = $customers->fetch_assoc()) { ?>  
                                
                                    <tr>
                                        <td><?= $i?></td>
                                        <td><?= $customer["name"]?></td>
                                        <td><?= $customer["nrc"]?></td>
                                        <td><?= $customer["name"]?></td>
                                        <?php $i++; }?>
                                        <td><?= $booking["checkin_date"]?></td>
                                        <td><?= $booking["checkout_date"]?></td>
                                        <td><?= $booking["customer_id"]?></td>
                                        <td>
                                            <a href="?editId=<?=$booking['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                                            <button class="btn btn-sm btn-danger  deleteSelect" data-value="<?=$booking['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                        </td>
                                    
                                
                                    </tr>
                               
                                
                                </tbody>
                            </table>
                    <?php if (!isset($_POST['search'])) {
                            require_once("../layout/pagination.php");
                        } elseif (isset($_POST['search']) && $_POST['search'] == "") {
                            require_once("../layout/pagination.php");
                        } ?>
                </div> 
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
           