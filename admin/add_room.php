<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$pageTotal = get_user_pag_count($mysqli);
$currentPage = 0;

$room_no = $room_no_err ="";
$room_type = $room_type_err = "";
$single_bed = $single_bed_err = "";
$bed = $bed_error = "";
$double_bed = $double_bed_err = "";
$twin_bed = $twin_bed_err = "";
$price = $price_err ="";
$taken = $taken_err = "";
$invalid = true;
$validation_message="";

// $r = get_room_type($mysqli);
// var_dump($r);

if(isset($_GET["editId"])){
    $editId = $_GET["editId"];
    $edit_room          = get_room_id($mysqli,$editId);
    $room_no            = $edit_room['room_no'];    
    $selected_room_type = $edit_room['room_type'];  
    $single_bed         = $edit_room['single_bed']; 
    $double_bed         = $edit_room['double_bed']; 
    $twin_bed           = $edit_room['twin_bed'];    
    $price              = $edit_room['price'];  
}


if(isset($_POST["room_no"])){
    $room_no   = $_POST["room_no"];
    $room_type = $_POST["room_type"];
    $single_bed = $_POST["single_bed"];
    $double_bed = $_POST["double_bed"];
    $twin_bed   = $_POST["twin_bed"];
    $price      = $_POST["price"];

     if($room_no ===  ""){
        $room_no_err =" Room Number can't be blanked!";
        $invalid     = false;
     }
    //  }else if(!is_numeric($room_no)){
    //     $room_no_err = "Room Number must be numeric!";
    //     $invalid = false;
    // }
     if($room_type ===  ""){
        $room_type_err =" Room Type can't be blanked!";
        $invalid       = false;
     }
     if($single_bed ===  ""){
        $single_bed_err ="Single Bed can't be blanked!";
        $invalid = false;
        }else if(!is_numeric($single_bed)){
            $single_bed_err = "Single_bed must be numeric!";
            $invalid = false;
        }
     if($double_bed ===  ""){
        $double_bed_err ="Double Bed can't be blanked!";
        $invalid = false;
    }else if(!is_numeric($double_bed)){
        $double_bed_err = "Double_bed must be numeric!";
        $invalid = false;
    }
     if($twin_bed ===  ""){
        $twin_bed_err ="Twin Bed can't be blanked!";
        $invalid = false;
     }else if(!is_numeric($twin_bed)){
        $twin_bed_err = "Twin_bed must be numeric!";
        $invalid = false;
    }
     if($price ===  ""){
        $price_err =" Price can't be blanked!";
        $invalid   = false;
     }else if(!is_numeric($price)){
        $price_err = "Price must be numeric!";
        $invalid = false;
    }


     if($invalid){
        if(isset($_GET["editId"])){
            $update = update_room($mysqli,$editId,$room_no,$room_type,$single_bed, $double_bed, $twin_bed,$price,0);
            if($update){
                echo "<script>location.replace('./add_room.php')</script>";
            }
        }else{
            if(add_room($mysqli,$room_no,$room_type,$single_bed, $double_bed, $twin_bed,$price,0)){
                    echo "<script>location.replace('./add_room.php')</script>";
            }else{
                $invalid = true;
            } 
        }
    }
    }
     


?>

<div class="room">
    <div class="card-form col-4 mt-3 p-3">
        <div class="card-title ">
                <?php if (isset($_GET["editId"])){?>
                    <h2 class="text-center" style="color: var(--nav-color);">Update Room</h2>
                <?php }else { ?>
                    <h2 class="text-center" style="color: var(--nav-color);">Add Room</h2>
                <?php }?>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group"> 
                    <label for="room_no" class="form-label">Room Number</label>
                    <input type="text" name="room_no" class="form-control" id="room_no" value="<?= $room_no ?>">
                    <div class="text-danger" id="valid"  style="font-size:12px;"><?= $room_no_err ?></div>
                </div>
                
                <div class="form-group">
                    <label for="room_type" class="form-label">Room Type</label>
                    <select name="room_type" class="form-select" id="room_type">
                    <option value="">Select Room Type</option> 
                        <?php $room_types= get_room_type($mysqli);
                        ?>
                        <?php while($room_type = $room_types->fetch_assoc()){  ?>
                        <option value="<?= $room_type["id"] ?>"

                        <?php 
                        if(isset($_GET["editId"])){
                            if($room_type["id"] == $selected_room_type){
                                echo "selected";
                                }
                        }    
                        ?>><?= $room_type["room_type_name"]?></option>
                        <?php } ?> 
                    </select>                                  
                    <div class="text-danger err" id="valid"  style="font-size:12px;"><?= $room_type_err?></div>
                </div>
                <div class="form-group"> 
                    <label for="single_bed" class="form-label">Single Bed</label>
                    <input type="text" name="single_bed" class="form-control" id="single_bed" value="<?=$single_bed?>">
                    <div class="text-danger err" id="valid" style="font-size:12px;"><?= $single_bed_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="double_bed" class="form-label">Double Bed</label>
                    <input type="text" name="double_bed" class="form-control" id="double_bed" value="<?=$double_bed ?>">
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $double_bed_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="twin_bed" class="form-label">Twin Bed</label>
                    <input type="text" name="twin_bed" class="form-control" id="twin_bed" value="<?=$twin_bed?>">
                    <div class="text-danger err" id="valid" style="font-size:12px;"><?= $twin_bed_err ?></div>
                </div>
                <div class="form-group">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" id="price" value="<?=$price?>">
                    <div class="text-danger err" id="valid" style="font-size:12px;"><?= $price_err?></div>
                </div>
                <!-- <div class="form-group">
                    <input type="checkbox" name="taken" id="taken" class="form-check-input"/>
                    <label for="taken"  class="form-label">Taken</label>
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $taken_err?></div>
                
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
<?php if(isset($_GET['deleteId'])){
   if(delete_room($mysqli,$_GET["deleteId"])){
    echo "<script>location.replace('./add_room.php')</script>";
}
} ?>

    <div class="card-form col-7 mt-3 p-3">
    <!-- <div id="search-wapper" class="search-form">
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
        </div> -->
        
        <div class="card-body p-3">
           <div class="card">
            <div class="card-title">
                <div class="d-flex p-3">
                    <h2 class="" style="color: var(--nav-color);">Room List</h2>
                    <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
                </div> 
            </div>
                <div class="card-body">
              <!--  require_once("../layout/selectfloor.php") -->
                    <form action="" method="post" id="select-floor" class="mb-3">
                        <select name="floor" id="floor">
                            <?php
                                $selected = '1';
                            if(isset($_POST['floor'])){
                                $selected = $_POST['floor'];
                            }?>
                            <option value="1" <?php if($selected=='1') echo "selected"?>>1st Floor</option>
                            <option value="2" <?php if($selected=='2') echo "selected"?>>2nd Floor</option>
                            <option value="3" <?php if($selected=='3') echo "selected"?>>3rd Floor</option>
                            <option value="4" <?php if($selected=='4') echo "selected"?>>4th Floor</option>
                            <option value="5" <?php if($selected=='5') echo "selected"?>>5th Floor</option>
                        </select>
                    </form>

                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Room No</th>
                                <th>Room Type Id</th>
                                <th>Single Bed</th>
                                <th>Double Bed</th>
                                <th>Twin Bed</th>
                                <th>Price</th>
                                <th style="width: 100px;">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $rooms = get_room_by_floor($mysqli,"10");
                            if(isset($_POST['floor'])){
                                $rooms = get_room_by_floor($mysqli,$_POST['floor']);
                            }
                            $i =1;?>
                            <?php while($room= $rooms->fetch_assoc()){ ?>
                            <tr>
                                <td><?=$i ?></td>
                                <td><?=$room["room_no"] ?></td>
                                <td><?=$room["room_type_name"] ?></td>
                                <td><?=$room["single_bed"] ?></td>
                                <td><?=$room["double_bed"] ?></td>
                                <td><?=$room["twin_bed"] ?></td>
                                <td class="text-end"><?= number_format($room["price"])." MMK" ?></td>
                                <td>
                                    <a href="?editId=<?=$room['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-sm btn-danger  deleteSelect" data-value="<?=$room['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php $i++;}?>
                            

                        </tbody>
                    </table>
                </div>
           </div> 
        </div>
    </div>
</div>

<script>
    // window.onload = function() {
    //     const floorSelect = document.getElementById('floorSelect');
        
    //     floorSelect.value = "1";
    // };

    $('#floor').on("change",function(){
        $('#select-floor').submit();
    });
</script>

<?php require_once("../layout/footer.php")?>