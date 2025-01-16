
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
                            <?php $requests = join_customer_booking($mysqli); ?>
                                    <?php $i =1 ;?>
                                    <?php while ($request = $requests->fetch_assoc()) { ?> 
                                
                                    <tr>
                                        <td><?= $i?></td>
                                        <td><?= $request["customer_name"]?></td>
                                        <td><?= $request["nrc"]?></td>
                                        <td><?= $request["phone_no"]?></td>
                                        <td><?= $request["email"]?></td>
                                        <td><?= $request["checkin_date"]?></td>
                                        <td><?= $request["checkout_date"]?></td>
                                        
                                        <td>
                                            <a href="./bookroom.php?editId=<?=$request['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                                            <button class="btn btn-sm btn-danger  deleteSelect" data-value="<?=$request['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                        </td>
                                    
                                
                                    </tr>
                                    <?php $i++;} ?>
                               
                                
                                </tbody>
                            </table>
                    
                </div> 
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
           