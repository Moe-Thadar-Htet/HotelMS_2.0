<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$staff_name= $staff_name_err ="";
$age  = $age_err = "";
$phone_no = $phone_no_err = "";
$email= $email_err = "";
$gender = $gender_err ="";
$role = $role_err = "";
$invalid = true;

?>
<?php 


$currentPage = 0;
    if (isset($_GET["pageNo"])) {
        $currentPage = (int) $_GET["pageNo"];
    }

    $pagTotal = get_staffs_pag_count($mysqli);
    if (isset($_GET['lest'])) {
        $currentPage = ($pagTotal * 7) - 7;
    }

if(isset($_GET["editId"])){
    $editId = $_GET["editId"];
    $staff = get_staff_id($mysqli, $editId);
    $staff_name = $staff["staff_name"];
    $age        = $staff["age"];
    $phone_no   = $staff["phone_no"];
    $email      = $staff["email"];
    $gender     = $staff["gender"];
    $role       = $staff["role"];

}

if(isset($_GET["deleteId"])){
    if(delete_staff($mysqli,$_GET["deleteId"])){
        echo"<script>location.replace('./add_staff.php')</script>";
    }
}
?>
<?php
  
    if(isset($_POST["staff_name"])){
        $staff_name = trim($_POST["staff_name"]);
        $age        = $_POST["age"];
        $phone_no   = $_POST["phone_no"];
        $email      = $_POST["email"];
        // $gender     = $_POST["gender"];
        $role       = $_POST["role"];
        $gender = $_POST['gender'];

        var_dump($gender);

        if($gender == ""){
            $gender_err == "choose one";
            $invalid = false;
        }
        if($staff_name === ""){
            $staff_name_err = "Staff name can't be blanked!";
            $invalid = false;
        }
        if($age === ""){
            $age_err = "Age can't be blanked!";
            $invalid = false;
        }else if( strlen($age) < 18 ){
            $age_err = "Age must be kk!";
            $invalid = false;
        }
        if($phone_no === ""){
            $phone_no_err = "Phone Number can't be blanked!";
            $invalid = false;
        }else if(!is_numeric($phone_no)){
            $phone_no_err = "Phone Number must be numeric!";
            $invalid = false;
        }
        if($email === ""){
            $email_err = "Email can't be blanked!";
            $invalid = false;
        } else {
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $email_err= "Invalid email format";
                $invalid = false;

            }
        }
        if($gender == ""){
            $gender_err = "Gender can't be blanked!";
            $invalid = false;

        }
        if($gender != "0" && $gender != "1"){
            $gender_err = "Gender can't be blanked!";
            $invalid = false;
        }
        if($role === ""){
            $role_err = "Role can't be blanked!";
            $invalid = false;
        }

        if(!$invalid){
            if(isset($_GET["editId"])){
                $update = update_staff($mysqli,$editId,$staff_name,$age,$phone_no,$email,$gender,$role);
                if($update){
                    echo"<script>location.replace(./add_staff.php)</script>";
                }
            }else{
                $add = add_staff($mysqli,$staff_name,$age,$phone_no,$email,$gender,$role);
                if($add){
                    echo"<script>location.replace(./add_staff.php)</script>";
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
                <h2 class="text-center" style="color: var(--nav-color);">Update Staff</h2>
                <?php }else{?>
                <h2 class="text-center" style="color: var(--nav-color);">Add Staff</h2>
                <?php }?>
            <?php ?>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group "> 
                    <label for="staff_name" class="form-label">Name</label>
                    <input type="text" name="staff_name" class="form-control" id="staff_name" value="<?= $staff_name ?>">
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $staff_name_err ?></div>
                </div>
                <div class="form-group "> 
                    <label for="age" class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" id="age" value="<?= $age ?>">
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $age_err ?></div>
                </div>
                <div class="form-group ">
                    <label for="phone_no" class="form-label">Phone Number</label>
                    <input type="tel" name="phone_no" class="form-control" id="phone_no" value="<?=$phone_no?>">
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $phone_no_err?></div>
                </div>
                <div class="form-group ">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?=$email?>">
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $email_err?></div>
                </div>
              
                <div class="form-group ">
                    <label for="gender">Gender</label>
                    <input type="radio" id="male" name="gender" value="0">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="1">
                    <label for="female">Female</label>
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $gender_err?></div> 

                </div> 
                <div class="form-group ">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" name="role" class="form-control" id="role" value="<?=$role?>">
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $role_err?></div>
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
            <h2 class="" style="color: var(--nav-color);">Staff List</h2>
            <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
        </div> 
            </div>
                <div class="card-body">
                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Staff Name</th>
                                <th>Age</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                        <?php if (isset($_POST["search"]) && $_POST['search'] != '') {
                                $staffs = get_staff_filter($mysqli, $_POST['search']);
                            } else {
                                $staffs = get_staffs($mysqli,$currentPage);
                            } ?>
                        <?php
                            if (isset($_POST["search"])) {
                                $i = 1;
                            } else {
                                $i = $currentPage + 1;
                            } ?>
                            <?php while ($staff = $staffs->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $staff["staff_name"]?></td>
                                <td><?= $staff["age"]?></td>
                                <td><?= $staff["phone_no"]?></td>
                                <td><?= $staff["email"]?></td> 
                                <td><?= $staff["gender"]?></td> 
                                <td><?= $staff["role"]?></td> 
                                <td>
                                    <a href="add_staff.php?editId=<?= $staff["id"]?>" class="btn btn-success btn-sm" ><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-sm deleteSelect" data-value="<?=$staff['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button> 
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