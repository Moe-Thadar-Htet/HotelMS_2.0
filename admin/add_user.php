<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$user_name= $user_name_err ="";
$email= $email_err = "";
$password = $password_err = "";
$phone_number = $phone_number_err = "";
$role = $role_err = "";
$invalid = true;

?>
<?php 
    $currentPage = 0;
    if (isset($_GET["pageNo"])) {
        $currentPage = (int) $_GET["pageNo"];
    }

    $pagTotal = get_users_pag_count($mysqli);
    if (isset($_GET['lest'])) {
        $currentPage = ($pagTotal * 7) - 7;
    }


if(isset($_GET["editId"])){
    $editId = $_GET["editId"];
    $user = get_user_id($mysqli, $editId);
    $user_name = $user["user_name"];
    $email      = $user["email"];
    $password = $user["password"];
    $phone_number = $user["phone_number"];
    $role       = $user["role"];

}

if(isset($_GET["deleteId"])){
    if(delete_user($mysqli,$_GET["deleteId"])){
        echo"<script>location.replace('./add_user.php')</script>";
    }
}
?>
<?php
  
    if(isset($_POST["user_name"])){
        $user_name = trim($_POST["user_name"]);
        $email =  $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $phone_number = $_POST["phone_number"];
        $role         = $_POST["role"];

        if($user_name === ""){
            $user_name_err = "User name can't be blanked!";
            $invalid = false;
        }else if(is_numeric($phone_number)){
            $user_name_err = "Use Name can't be number!";
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
        if($password === ""){
            $pssword_err = "Password cant't be blanked!";
            $invalid = false;
        }else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/", $password)) {
            $passwordErr = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.";
            $invalid = false;
        }
        
        if($phone_number === ""){
            $phone_number_err = "Phone Number can't be blanked!";
            $invalid = false;
        }else if(!is_numeric($phone_number)){
            $phone_number_err = "Phone Number must be numeric!";
            $invalid = false;
        }
        
        if($role === ""){
            $role_err = "Role can't be blanked!";
            $invalid = false;
        } 

        if($invalid){
            $hashpassword = password_hash($password, PASSWORD_BCRYPT);
            if($hashpassword){
                if(isset($_GET["editId"])){
                    $hashpasswords =password_hash($user["password"], PASSWORD_BCRYPT);

                    $update = update_user($mysqli,$_GET["editId"],$user_name,$email,$hashpasswords,$phone_number,$role);
                    if($update){
                        echo "<script>location.repalce('./add_user.php')</script>";
                    }else{
                    $add = add_user($mysqli,$user_name,$email,$hashpassword,$phone_number,$role);
                    if($add){
                        echo "<script>location.repalce('./add_user.php')</script>";
                        }   
                    } 
                }
                
            }
        }

    }?>


<div class="room">
    <div class="card-form col-4 mt-3 p-3">
        <div class="card-title ">
        <?php 
                if(isset($_GET["editId"])){?>
                <h2 class="text-center" style="color: var(--nav-color);">Update User</h2>
                <?php }else{?>
                <h2 class="text-center" style="color: var(--nav-color);">Add User</h2>
                <?php }?>
            <?php ?>
        </div>
        <div class="card-body">
            <div class="form-div">
                <form method="post">
                    <div class="form-group "> 
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" name="user_name" class="form-control" id="user_name" value="<?= $user_name?>">
                        <div class="text-danger" id="valid" style="font-size:12px;"><?= $user_name_err ?></div>
                    </div>
                    <div class="form-group ">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?= $email ?>">
                        <div class="text-danger" id="valid" style="font-size:12px;"><?= $email_err?></div>
                    </div>

                    <div class="form-group ">
                        <label for="password" class="form-label">password</label>
                        <input type="tel" name="password" class="form-control" id="password" value="">
                        <div class="text-danger" id="valid" style="font-size:12px;"><?= $password_err?></div>
                    </div>

                    <div class="form-group ">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" name="phone_number" class="form-control" id="phone_number" value="<?= $phone_number?>">
                        <div class="text-danger" id="valid" style="font-size:12px;"><?= $phone_number_err?></div>
                    </div>
                
                    <div class="form-group ">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" name="role" class="form-control" id="role" value="<?= $role?>">
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
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                        <?php
                            if (isset($_POST["search"]) && $_POST['search'] != '') {
                                $users = get_user_filter($mysqli, $_POST['search']);
                            } else {
                                $users = get_users($mysqli,$currentPage);
                            } ?>
                        <?php
                            if (isset($_POST["search"])) {
                                $i = 1;
                            } else {
                                $i = $currentPage + 1;
                            } ?>
                            <?php while ($user = $users->fetch_assoc()) { ?>
                            
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $user["user_name"]?></td>
                                <td><?= $user["email"]?></td>
                                <td><?= $user["phone_number"]?></td>
                                <td><?= $user["role"]?></td> 
                                <td> 
                                <a href="add_user.php?editId=<?= $user["id"]?>" class="btn btn-success btn-sm" ><i class="fa fa-pen"></i></a>  
                                    <button class="btn btn-danger btn-sm deleteSelect" data-value="<?=$user['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button> 
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