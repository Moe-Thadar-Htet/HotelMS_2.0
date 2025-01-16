<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$duty_id = $duty_id_err = "";
$staff_id = $staff_id_err ="";
$start_date = $start_date_err ="";
$end_date = $end_date_err = "";
$invalid = true;

?>
<?php 

    $currentPage = 0;
        if (isset($_GET["pageNo"])) {
            $currentPage = (int) $_GET["pageNo"];
        }

        $pagTotal = get_duty_staff_pag_count($mysqli);
        if (isset($_GET['lest'])) {
            $currentPage = ($pagTotal * 7) - 7;
        }


if(isset($_GET["editId"])){
    $editId = $_GET["editId"];
    $duty_staff =  get_duty_staff_id($mysqli,$editId);
    $duty_id = $duty_staff["duty_id"];
    $staff_id = $duty_staff["staff_id"];
    $start_date = $duty["start_date"];
    $end_date =$duty["end_date"];
    // var_dump($end_time);

}

if(isset($_GET["deleteId"])){
    if(delete_duty($mysqli,$_GET["deleteId"])){
        echo"<script>location.repalce('./add_duty_staff.php')</script>";
    }
}
if(isset($_POST["duty_id"])){
    $duty_id = $_POST["duty_id"];
    $staff_id = $_POST["staff_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    if($duty_id === ""){
        $duty_id_err = "Duty ID does't blank!";
        $invalid = false;
    }
    if($staff_id === ""){
        $staff_id_err = "Staff ID does't blank!";
        $invalid = false;
    }
    if($start_date === ""){
        $start_date_err = "Start date does't blank!";
        $invalid = false;
    }
    if($end_date === ""){
        $end_date_err = "End date does't blank!";
        $invalid = false;
    }

    if($invalid){
        if(isset($_GET["editId"])){
            $update = update_duty_staff($mysqli,$editId,$duty_id,$staff_id,$start_date,$end_date);
            if($update){
                echo"<script>location.replace('./add_duty_staff.php')</script>";
            }
        }else{
            $add = add_duty_staff($mysqli,$duty_id,$staff_id,$start_date,$end_date);
            if($add){
                echo"<script>location.replace('./add_duty_staff.php')</script>";
            }
            
       
    }


}
}

?>

<div class="room">
    <div class="card-form col-4 mt-3 p-3">
        <div class="card-title ">
        <?php 
            if(isset($_GET["editId"])){?>
            <h2 class="text-center" style="color: var(--nav-color);">Update Duty_Staff</h2>
            <?php }else{?>
            <h2 class="text-center" style="color: var(--nav-color);">Add Duty_Staff</h2>
            <?php }?>
        <?php ?>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group ">
                    <label for="duty_id" class="form-label">Select Duty</label>
                    <select name="duty_id" class="form-select" id="duty_id">
                    <option value="" selected>Select Duty ID</option>
                    <?php $duties= get_duty($mysqli);?>
                    <?php while($duty = $duties->fetch_assoc()){  ?>
                    <option value="<?= $duty["id"] ?>"

                    <?php 
                    if(isset($_GET["editId"])){
                        if($duty["id"] == $duty_id){
                            echo "selected";
                            }
                    }    
                    ?>><?= $duty["duty_name"]?></option>
                        <?php } ?> 
                    </select>
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $duty_id_err ?></div>
                </div>
                <div class="form-group ">
                    <label for="staff_id" class="form-label">Select Staff</label>
                    <select name="staff_id" class="form-select" id="staff_id">
                    <option value="" selected>Select Staff</option>
                    <?php $staffs = get_staff($mysqli);?>
                    <?php while($staff = $staffs->fetch_assoc()){  ?>
                    <option value="<?= $staff["id"] ?>"

                    <?php 
                    if(isset($_GET["editId"])){
                        if($staff["id"] == $staff_id){
                            echo "selected";
                            }
                    }    
                    ?>><?= $staff["id"]?></option>
                        <?php } ?> 
                        
                    </select>
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $staff_id_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" id="start_date" value="<?=$start_date ?>">
                    <div class="text-danger" id="valid"  style="font-size:12px;"><?= $start_date_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="end_date" value="<?=$end_date ?>">
                    <div class="text-danger" id="valid"  style="font-size:12px;"><?= $end_date_err ?></div>
                </div>
                <div>
                    <button class="btn col-2" type="submit" style="color:#fff;background-color:var(--nav-color);">Add</button> 
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
            <div class="card-title">
            <div class="d-flex p-3">
                <h2 class="" style="color: var(--nav-color);">Duty Staff Detail List</h2>
                <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
            </div> 
            </div>
                <div class="card-body">
                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Duty Name</th>
                                <th>Staff Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                        <?php
                            if (isset($_POST["search"]) && $_POST['search'] != '') {
                                $duty_staffs = get_duty_staff_filter($mysqli, $_POST['search']);
                            } else {
                                $duty_staffs = get_duty_staffs($mysqli,$currentPage);
                            } ?>
                        <?php
                            if (isset($_POST["search"])) {
                                $i = 1;
                            } else {
                                $i = $currentPage + 1;
                            } ?>
                            <?php while ($duty_staff = $duty_staffs->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $duty_staff["duty_name"]?></td>
                                <td><?= $duty_staff["staff_id"]?></td>
                                <td><?= $duty_staff["start_date"]?></td>
                                <td><?= $duty_staff["end_date"]?></td>
                                <td>
                                    <a href="add_duty.php?editId=<?= $duty_staff["id"]?>" class="btn btn-success btn-sm" ><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-sm deleteSelect" data-value="<?=$duty_staff['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button> 
                                </td> 
                            </tr>
                            <?php $i++; } ?>
                           
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