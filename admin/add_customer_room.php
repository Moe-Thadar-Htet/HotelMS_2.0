<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$customer_id = $customer_id_err = "";
$room_id     = $room_id_err = "";
$checkin_time= $checkin_time_err = "";
$checkout_time = $checkout_time_err = "";
$extra_bed = $extra_bed_err ="";
$invalid    = true;

$currentPage = 0;
    if (isset($_GET["pageNo"])) {
        $currentPage = (int) $_GET["pageNo"];
    }

    $pagTotal = get_customer_rooms_pag_count($mysqli);
    if (isset($_GET['lest'])) {
        $currentPage = ($pagTotal * 7) - 7;
    }



if(isset($_GET["editId"])){
  $editId = $_GET["editId"];
  $customer_room =  get_customer_room_id($mysqli,$editId);
  $room_id = $customer_room["room_id"];
  $checkin_time = $customer_room["checkin_time"];
  $checkout_time = $customer_room["checkout_time"];
  $extra_bed = $customer_room["extra_bed"];

}

if(isset($_GET['deleteId'])){
    if(delete_customer_room($mysqli,$_GET['deleteId']));
    echo"<script>location.replace('./add_customer_room.php')</script>";
}


if(isset($_POST["customer_id"])){
    $customer_id = $_POST["customer_id"];
    $room_id = $_POST["room_id"];
    $checkin_time = $_POST["checkin_time"];
    $checkout_time = $_POST["checkout_time"];
    $extra_bed  = $_POST["extra_bed"];
    // $status     = $_POST["status"];


    if($customer_id === ""){
        $customer_id_err = "Customer Id does't blank!";
        $invalid     = false;
    }
    if($room_id === ""){
        $room_id_err = "Room Id does't blank!";
        $invalid     = false;
    }
    
    if($checkin_time  === ""){
        $checkin_time_err = "Checkin Time does't blank!";
        $invalid     = false;
    }

    if($checkout_time  === ""){
        $checkout_time_err = "Checkout Time does't blank!";
        $invalid     = false;
    }

    if($extra_bed  === ""){
        $extra_bed_err = "Extra Bed does't blank!";
        $invalid     = false;
    }

    // if($status === ""){
    //     $status_err = "Status does't blank!";
    //     $invalid     = false;
    // }

    if($invalid){
        if(isset($_GET["editId"])){
            $update = update_customer_room($mysqli,$editId,$customer_id,$room_id,$checkin_time,$checkout_time,$extra_bed);
            if($update){
                echo "<script>location.replace('./add_customer_room.php')</script>";
            }
        }else{
            $add = add_customer_room($mysqli,$customer_id,$room_id,$checkin_time,$checkout_time,$extra_bed);
            if($add){
                echo "<script>location.replace('./add_customer_room.php')</script>";
            }

        }
    }
}?>

<div class="room">
    <div class="card-form col-4 mt-3 p-3">
        <div class="card-title ">
            <?php if (isset($_GET["editId"])){?>
                <h2 class="text-center title-color">Update Customer Room Detail </h2>
            <?php }else { ?>
                <h2 class="text-center title-color" >Add Customer Room Detail </h2>
            <?php }?>
            
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group"> 
                    <label for="customer_id" class="form-label">Customer Id</label>
                    <select name="customer_id" class="form-select" id="customer_id">
                    <option value="">Select Customer</option> 
                        <?php $customers= get_customer($mysqli);
                        ?>
                        <?php while($customer = $customers->fetch_assoc()){  ?>
                        <option value="<?= $customer["id"] ?>"
                        <?php 
                        if(isset($_GET["editId"])){
                            if($customer["id"] == $customer_id){
                                echo "selected";
                                }
                        }    
                        ?>>
                        <?= $customer["customer_name"]?>
                        </option>
                        <?php } ?> 
                    </select>    
                    <div class="text-danger" id="valid"><?= $customer_id_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="room_id" class="form-label">Room Id</label>
                    <select name="room_id" class="form-select" id="room_id">
                    <option value="">Select Room</option> 
                        <?php $rooms = get_room($mysqli);
                        ?>
                        <?php while($room = $rooms->fetch_assoc()){  ?>
                        <option value="<?= $room["id"] ?>"
                        <?php 
                        if(isset($_GET["editId"])){
                            if($room["id"] == $room_id){
                                echo "selected";
                                }
                        }    
                        ?>>
                        <?= $room["room_no"]?>
                        </option>
                        <?php } ?> 
                    </select>    
                    <div class="text-danger" id="valid"><?= $room_id_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="checkin_time" class="form-label">Checkin Time</label>
                    <input type="datetime-local" name="checkin_time" class="form-control" id="checkin_time" value="<?=$checkin_time ?>">
                    <div class="text-danger" id="valid"><?= $checkin_time_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="checkout_time" class="form-label">Checkout Time</label>
                    <input type="datetime-local" name="checkout_time" class="form-control" id="checkout_time" value="<?=$checkout_time ?>">
                    <div class="text-danger" id="valid"><?= $checkout_time_err ?></div>
                </div>

                <div class="form-group"> 
                    <label for="extra_bed" class="form-label">Extra Bed</label>
                    <input type="number" name="extra_bed" class="form-control" id="extra_bed" value="<?=$extr_bed ?>"/>
                    <div class="text-danger" id="valid"><?= $extra_bed_err ?></div>
                </div>
                <!-- <div class="form-group"> 
                    <label for="status" class="form-label">Status</label>
                    <input type="text" name="status" class="form-control" id="status" value="<?= $status?>"/>
                    <div class="text-danger" id="valid"><?= $status_err ?></div>
                </div> -->
                <div>
                    <?php if(isset($_GET['editId'])){?>
                        <button class="btn col-2" type="submit" style="color:#fff;background-color:var(--nav-color);">Update</button> 
                    <?php } else {?>
                        <button class="btn col-2" type="submit" style="color:#fff;background-color:var(--nav-color);">Add</button> 
                    <?php }?>
                </div>   
            </form>
        </div>
    </div>

    <div class="card-form col-7 mt-3 p-3">
        <div id="search-wapper" class="search-form">
            <form method="post">
                <div class="search-wapper d-flex">
                    <div class="search ">
                        <input class="search-input form-control" type="text" name="search" placeholder="Search" />    
                    </div>
                    <div>
                        <button class="search-icon form-control">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>  
                </div>
            </form>              
        </div>
        <div class="card-body p-3">
           <div class="card">
           <div class="card-title ">
            <div class="d-flex p-3">
                <h2 class="" style="color: var(--nav-color);">User List</h2>
                <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
            </div> 
               
            </div>
            
                <div class="card-body">
                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer Name</th>
                                <th>Room Number</th>
                                <th>Checkin Time</th>
                                <th>Checkout Time</th>
                                <th>Extra Bed</th>
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (isset($_POST["search"]) && $_POST['search'] != '') {
                                $customer_rooms = get_customer_rooms_filter($mysqli, $_POST['search']);
                            } else {
                                $customer_rooms = get_customer_rooms_join($mysqli,$currentPage);
                            } ?>
                        <?php
                            if (isset($_POST["search"])) {
                                $i = 1;
                            } else {
                                $i = $currentPage + 1;
                            } ?>
                            <?php while ($customer_room = $customer_rooms->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $customer_room["customer_name"]?></td>
                                <td><?= $customer_room["room_no"]?></td>
                                <td><?= $customer_room["checkin_time"]?></td>
                                <td><?= $customer_room["checkout_time"]?></td>
                                <td><?= $customer_room["extra_bed"]?></td>
                                <td>
                                    <a href="?editId=<?= $customer_room['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-sm btn-danger  deleteSelect" data-value="<?=$customer_room['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                </td>
                              
                           
                            </tr>
                            <?php $i++; }?>
                           
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

<?php require_once("../layout/footer.php")?>