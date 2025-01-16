<?php require_once("./storage/db.php")?>
<?php require_once("./storage/user_crud.php")?>



<?php 
if(isset($_COOKIE['user'])){
    header(header: "location:./home.php");
}
?>


<?php 
    $result = get_user($mysqli);
    $users = $result->fetch_all();
    $admin = array_filter($users,function($user){
        return $user["5"] == 1;
    });
    if(!$admin){
        $admin_password = password_hash("admin", PASSWORD_BCRYPT);
        add_user($mysqli,"admin","admin@gmail.com",$admin_password,"0911111",1);
    }

    $email =  $email_err ="";
    $password = $password_err ="";

    if(isset($_POST["email"])){
        $email =  $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);

        if($email === ""){
            $email_err= "User Email Cannot be blanked!";
        }
        
        if($password === ""){
            $password_err = "User Password Cannot be blanked!";
        }

        if($email_err === "" && $password_err === ""){
            $user = get_user_with_email($mysqli,$email);
            if(!$user){
                $email_err = "User Email does not exist";
            }else{
            if(password_verify($password,$user['password'])){
                setcookie('user', json_encode($user), time()+1000*60*60*24*2,'/');
                header('location:./home.php');
            }else{
                $password_err = "User Password does not match!";


            }
        }
 
    }
}



?>

    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/css/style.css">
    <link rel="stylesheet" href="./asset/icon/css/all.min.css">
    <script src="./asset/js/bootstrap.min.js"></script>
    <script src="./asset/js/jquery.min.js"></script>
</head>
<body>
    <div class="main">

        <div class="card mx-auto my-5 login-container">
            <div class="card-body p-4">
                <h3 class="text-center">LogIn Form</h3>
                <?php if (isset($_GET['invalid'])) {?>
                    <div class="alert alert-danger "><?= $_GET['invalid'] ?></div>
                <?php } ?>
                <form method="post">
                    <div class="form-floating mt-5">
                        <input type="email" name="email" class="form-control" id="email" value="<?= $email?>" placeholder="Enter your email"/>
                        <label for="email" class="form-label">User Email</label>
                        <div id="valid"><?= $email_err?></div>
                    </div>

                    <div class="form-floating mt-2">
                        <input type="password" name="password" class="form-control" id="password" value="<?= $password?>"  placeholder="Enter your password"/>
                        <label for="password" class="form-label">Password</label>
                        <div id="valid"><?= $password_err?></div>
                    </div>

                    <div class="form-check d-flex align-items-center justify-content-between mt-3">
                        <div>
                            <input type="checkbox" class="form-check-input" id="showpassword"/>
                            <label for="showpassword" class="form-check-label">Show password</label>
                        </div>
                        <a href="forgot_password.php" class="btn btn-link p-0 text-decoration-none">Forgot Password?</a>
                    </div>

                    <button class="custom-btn mt-3 ">Log In</button>
                </form>
            </div>
        </div>

        <script>
            let showpassword = $("#showpassword");
            let password = $("#password");
            showpassword.on("click",()=>{
               if(showpassword.is(":checked")){
                password.get(0).type ="text";
                console.log(password);
               }else{
                password.get(0).type ="password";
               }
            })
        </script>
    </di>
</body>
</html>
        
