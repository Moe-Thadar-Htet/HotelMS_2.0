<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>

<?php
$room_id = $room_id_err = "";
$checkin_date= $checkin_date_err = "";
$checkout_date = $checkout_date_err  = "";
$customer_id = $customer_id_err = "";
$invalid    = true;

    $currentPage = 0;
    if (isset($_GET["pageNo"])) {
        $currentPage = (int) $_GET["pageNo"];
    }

    $pagTotal = get_booking_pag_count($mysqli);
    if (isset($_GET['lest'])) {
        $currentPage = ($pagTotal * 7) - 7;
    }



if(isset($_GET["editId"])){
    $editId = $_GET["editId"];
    $booking = get_booking_id($mysqli,$editId);
    $room_id = $booking["room_id"];
    $checkin_date =  $booking["checkin_date"];
    $checkout_date =  $booking["checkout_date"];
    $customer_id=  $booking["customer_id"];

}

if(isset($_GET['deleteId'])){
    if(delete_booking($mysqli,$_GET['deleteId']));
    echo"<script>locatin.replace('./add_booking.php')</script>";
}

if(isset($_POST["room_id"])){
    $room_id = $_POST["room_id"];
    $checkin_date =  $_POST["checkin_date"];
    $checkout_date =  $_POST["checkout_date"];
    $customer_id=  $_POST["customer_id"];

    if($room_id === ""){
        $room_id_err = "Room ID does't blank!";
        $invalid     = false;
    }
    if($checkout_date === ""){
        $checkout_date_err = "Checkout Date does't blank!";
        $invalid     = false;
    }
    if($checkin_date === ""){
        $checkin_date_err = "Checkin Date does't blank!";
        $invalid     = false;
    }
    if($customer_id === ""){
        $customer_id_err = "Customer ID does't blank!";
        $invalid     = false;
    }
    
    

    if($invalid){
        if(isset($_GET["editId"])){
            $update = update_booking($mysqli,$editId,$room_id,$checkin_date,$checkout_date,$customer_id);
            if($update){
                echo "<script>location.replace('./add_booking.php')</script>";
            }
        }else{
            $add = add_booking($mysqli,$room_id,$checkin_date,$checkout_date,$customer_id);
            if($add){
                echo "<script>location.replace('./add_booking.php')</script>";
            }

        }
    }
}
?>

<div class="room">
    <div class="card-form col-4 mt-3 p-3">
        <div class="card-title ">
            <?php if (isset($_GET["editId"])){?>
                <h2 class="text-center title-color" >Update Booking</h2>
            <?php }else { ?>
                <h2 class="text-center title-color" >Add Booking</h2>
            <?php }?>   
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group"> 
                    <label for="room_id" class="form-label">Room ID</label>
                    <select name="room_id" class="form-select" id="room_id">
                    <option value="">Select Room ID</option> 
                        <?php $rooms= get_room($mysqli);
                        ?>
                        <?php while($room = $rooms->fetch_assoc()){  ?>
                        <option value="<?= $room["id"] ?>"

                        <?php 
                        if(isset($_GET["editId"])){
                            if($room["id"] == $room_id){
                                echo "selected";
                                }
                        }    
                        ?>><?= $room["id"]?></option>
                        <?php } ?>
                    </select>
                    <div class="text-danger" id="valid"><?= $room_id_err ?></div>    
                </div>
               
                <div class="form-group"> 
                    <label for="checkin_date" class="form-label">Checkin Date</label>
                    <input type="datetime-local" name="checkin_date" class="form-control" id="checkin_date" value="<?=$checkin_date?>"/>
                    <div class="text-danger" id="valid"><?= $checkin_date_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="checkout_date" class="form-label">Checkout Date</label>
                    <input type="datetime-local" name="checkout_date" class="form-control" id="checkout_date" value="<?=$checkout_date ?>"/>
                    <div class="text-danger" id="valid"><?= $checkout_date_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="customer_id" class="form-label">Customer ID</label>
                    <select name="customer_id" class="form-select" id="customer_id">
                        <option value="" selected>Select Customer ID</option>
                        <?php $customers =  get_customer($mysqli);
                            while($customer = $customers->fetch_assoc()){?>
                        <option value="<?= $customer['id']?>"
                        <?php if(isset($_GET['editId'])){
                            if($customer_id == $customer_id);
                            echo "selected";
                        }?>><?= $customer['id']?></option>
                        <?php }?>
                    </select>
                    <div class="text-danger" id="valid"><?= $customer_id_err ?></div>  
                </div>
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
                        <h2 class="" style="color: var(--nav-color);">Booking List</h2>
                        <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
                    </div> 
                
                </div>
                <div class="card-body">
                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room Id</th>
                                <th>Checkin Date</th>
                                <th>Checkout Date</th>
                                <th>Customer ID</th>
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (isset($_POST["search"]) && $_POST['search'] != '') {
                                $bookings = get_booking_filter($mysqli, $_POST['search']);
                            } else {
                                $bookings = get_bookings($mysqli,$currentPage);
                            } ?>
                        <?php
                            if (isset($_POST["search"])) {
                                $i = 1;
                            } else {
                                $i = $currentPage + 1;
                            } ?>
                            <?php while ($booking = $bookings->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $booking["room_id"]?></td>
                                <td><?= $booking["checkin_date"]?></td>
                                <td><?= $booking["checkout_date"]?></td>
                                <td><?= $booking["customer_id"]?></td>
                                <td>
                                    <a href="?editId=<?=$booking['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-sm btn-danger  deleteSelect" data-value="<?=$booking['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
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






  <!-- <div class="form-group"> 
                    <label for="room_id" class="form-label">Room ID</label>
                    <input type="text" name="room_id" class="form-control" id="room_id" value="<?=$room_id ?>">
                    <div class="text-danger" id="valid"><?= $room_id_err ?></div>
                </div> -->


<?php require_once("../layout/footer.php")?>