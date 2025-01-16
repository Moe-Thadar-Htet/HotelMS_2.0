<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$room_type_name = $room_type_name_err = "";
$description = $description_err ="";

    $currentPage = 0;
        if (isset($_GET["pageNo"])) {
            $currentPage = (int) $_GET["pageNo"];
        }

        $pagTotal = get_room_types_pag_count($mysqli);
        if (isset($_GET['lest'])) {
            $currentPage = ($pagTotal * 7) - 7;
        }


if(isset($_GET["editId"])){
    $editId          = $_GET["editId"];
    $room_type       = get_room_type_id($mysqli,$editId);
    $room_type_name  =$room_type["room_type_name"];
    $description     = $room_type["description"];
    var_dump($description );
}


if(isset($_POST["room_type_name"])){
    $room_type_name  = $_POST["room_type_name"];
    $description = $_POST["description"];

     if($room_type_name  === ""){
        $room_type_name_err ="Room Type Name can't be blanked!";
     }

     if($description === ""){
        $description_err ="Decription can't be blanked!"; 
     }

     if($room_type_name_err == "" && $description_err == ""){
        if(isset($_GET["editId"])){
            $room_type = update_room_type($mysqli,$editId,$room_type_name,$description);
            echo "<script>location.replace('./add_room_type.php')</script>";
        }else{
            $room_type = add_room_type($mysqli,$room_type_name,$description);
            echo "<script>location.replace('./add_room_type.php')</script>";

        }
    }

}

?>

<div class="room">
    <div class="card-form col-4 mt-3 p-3">
        <div class="card-title ">
            <?php if (isset($_GET["editId"])){?>
                <h2 class="text-center" style="color: var(--nav-color);">Update Room Type</h2>
            <?php }else { ?>
                <h2 class="text-center" style="color: var(--nav-color);">Add Room Type</h2>
            <?php }?>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group"> 
                    <label for="room_type_name" class="form-label">Room Type Name</label>
                    <input type="text" name="room_type_name" class="form-control" id="room_type_name" value="<?=$room_type_name?>">
                    <div class="text-danger" id="valid"><?= $room_type_name_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" name="description" class="form-control" id="description" value="<?=$description ?>" placeholder="Enter Description "><?=$description ?></textarea>
                    <div class="text-danger" id="valid"><?= $description_err ?></div>
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

    <?php 
    if(isset($_GET["deleteId"])){
        if(delete_room_type($mysqli,$_GET["deleteId"])){
            echo "<script>location.replace('./add_room_type.php')</script>";
        }
        }
    
    ?>

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
            <div class="card-title">
                <div class="d-flex p-3">
                    <h2 class="" style="color: var(--nav-color);">Room Type Detail List</h2>
                    <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
                </div> 
            </div>
                <div class="card-body">
                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Room Type Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                        <?php
                            if (isset($_POST["search"]) && $_POST['search'] != '') {
                                $room_types = get_room_types_filter($mysqli, $_POST['search']);
                            } else {
                                $room_types = get_room_types($mysqli,$currentPage);
                            } ?>
                        <?php
                            if (isset($_POST["search"])) {
                                $i = 1;
                            } else {
                                $i = $currentPage + 1;
                            } ?>
                            <?php while ($room_type = $room_types->fetch_assoc()) { ?>
                            
                                 
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $room_type['room_type_name']?></td>
                                <td><?= $room_type['description']?></td>
                                <td>
                                    <a href="./add_room_type.php?editId=<?=$room_type['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-sm btn-danger  deleteSelect" data-value="<?=$room_type['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                </td>
                           
                            </tr>
                            <?php $i++;}?>
                           
                        </tbody>
                    </table>
                    <?php if (!isset($_POST['search'])) {
                            require_once("../layout/pagination.php");
                        } else if (isset($_POST['search']) && $_POST['search'] == "") {
                            require_once("../layout/pagination.php");
                        } ?>
                </div>
                </div>
           </div> 
        </div>
    </div>
</div>

<?php require_once("../layout/footer.php")?>