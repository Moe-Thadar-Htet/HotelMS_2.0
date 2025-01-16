<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$duty_name = $duty_name_err = "";
$start_time = $start_time_err ="";
$end_time = $end_time_err = "";
$invalid = true;
?>

<?php 

if(isset($_GET["editId"])){
    $editId = $_GET["editId"];
    $duty =  get_duty_id($mysqli,$editId);
    $duty_name = $duty["duty_name"];
    $start_time = $duty["start_time"];
    $end_time =$duty["end_time"];
    var_dump($end_time);

}

if(isset($_GET["deleteId"])){
    if(delete_duty($mysqli,$_GET["deleteId"])){
        echo"<script>location.repalce('./add_duty.php')</script>";
    }
}
if(isset($_POST["duty_name"])){
    $duty_name = $_POST["duty_name"];
    $start_time = $_POST["start_time"];
    // var_dump(  $start_time );
    $end_time = $_POST["end_time"];

    if($duty_name === ""){
        $duty_name_err = "Duty Name does't blank!";
        $invalid = false;
    }
    if($start_time === ""){
        $start_time_err = "Start Time does't blank!";
        $invalid = false;
    }
    if($end_time === ""){
        $end_time_err = "End Time does't blank!";
        $invalid = false;
    }

    if($invalid){
        if(isset($_GET["editId"])){
            $update = update_duty($mysqli,$editId,$duty_name,$start_time,$end_time);
            if($update){
                echo"<script>location.replace('./add_duty.php')</script>";
            }
        }else{
            $add = add_duty($mysqli,$duty_name,$start_time,$end_time);
            if($add){
                echo"<script>location.replace('./add_duty.php')</script>";
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
            <h2 class="text-center" style="color: var(--nav-color);">Update duty</h2>
            <?php }else{?>
            <h2 class="text-center" style="color: var(--nav-color);">Add duty</h2>
            <?php }?>
        <?php ?>
           
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group"> 
                    <label for="duty_name" class="form-label">Duty Name</label>
                    <input type="text" name="duty_name" class="form-control" id="duty_name" value="<?=$duty_name ?>">
                    <div class="text-danger" id="valid"  style="font-size:12px;"><?= $duty_name_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control" id="start_time" value="<?=$start_time ?>">
                    <div class="text-danger" id="valid"  style="font-size:12px;"><?= $start_time_err ?></div>
                </div>
                <div class="form-group"> 
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control" id="end_time" value="<?=$end_time ?>">
                    <div class="text-danger" id="valid"  style="font-size:12px;"><?= $end_time_err ?></div>
                </div>
                <div>
                <?php if(isset($_GET["editId"])){?>
                    <button class="btn col-2" type="submit" style="color:#fff;background-color:var(--nav-color);">Update</button> 
                <?php }else{?>
                    <button class="btn col-2" type="submit" style="color:#fff;background-color:var(--nav-color);">Add</button> 
                <?php }?>
                </div>   
            </form>
        </div>
    </div>

    <div class="card-form col-7 mt-3 p-3">
        <div class="d-flex p-3">
            <h2 class="" style="color: var(--nav-color);">Duty List</h2>
            <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
        </div> 
        <div class="card-body p-3">
           <div class="card">
                <div class="card-body">
                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Duty Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                        <?php $duties = get_duty($mysqli);$i = 1;?>
                        <?php while($duty = $duties->fetch_assoc()) {?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $duty["duty_name"]?></td>
                                <td><?= $duty["start_time"]?>AM</td>
                                <td><?= $duty["end_time"]?>PM</td>
                                <td>
                                    <a href="add_duty.php?editId=<?= $duty["id"]?>" class="btn btn-success btn-sm" ><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-sm deleteSelect" data-value="<?=$duty['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button> 
                                </td> 
                            </tr>
                            <?php $i++; } ?>
                           
                        </tbody>
                    </table>
                </div>
           </div> 
        </div>
    </div>
</div>

<?php require_once("../layout/footer.php")?>