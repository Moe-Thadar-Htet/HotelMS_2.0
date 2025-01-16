<?php require_once("./storage/db.php") ?>
<?php require_once("./storage/user_crud.php") ?>

<?php

$error_message = "";
$user = null;
$step = 1;

if(isset($_COOKIE['reset_user'])){
    $user = json_decode($_COOKIE['reset_user'],true);
}

if (isset($_POST["email"])) {
    $user = get_user_with_email($mysqli, $_POST["email"]);
    if(!$user){
        $error_message = "User doesn't match!";
    }else{
        setcookie('reset_user', json_encode($user), time()+1000*60*5,'');
        $step = 2;
    }
}

if (isset($_POST['username'])) {
    if ($user['user_name'] != $_POST['username']) {
        $error_message = "User doesn't match!";
        $step = 2;
    }else{
        $step = 3;
    }
}
if (isset($_POST['phone'])) {
    if ($user['phone_number'] != $_POST['phone']) {
        $error_message = "Phone Number doesn't match!";
        $step = 3;
    }else{
    $step = 4;
    }
}
if (isset($_POST['new_password'])) {
    update_password($mysqli, $user['id'], $_POST['new_password']);
    $step = 5;
}
?>


<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Step 1</title>
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/css/style.css">
</head>
<?php if ($step == 1) { ?>
    <div class="main">
        <div class="card mx-auto my-5 forgot-password-container">
            <div class="card-body p-4">
                <h3 class="text-center">Forgot Password - Step 1</h3>
                <p class="text-center text-muted">Enter your registered email address.</p>
                <?php if(!empty($error_message)) { ?>
                    <div class="alert alert-danger"><?= $error_message ?></div>
                <?php } ?>
                <form method="post">
                    <div class="form-floating mt-4">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required />
                        <label for="email" class="form-label">Email Address</label>
                    </div>
                    <button class="custom-btn mt-4 w-100">Next</button>
                </form>
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-link">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
<?php } else if ($step == 2) { ?>
    <div class="main">
        <div class="card mx-auto my-5 forgot-password-container">
            <div class="card-body p-4">
                <h3 class="text-center">Forgot Password - Step 2</h3>
                <p class="text-center text-muted">Enter your username associated with the email.</p>
                <?php if(!empty($error_message)) { ?>
                    <div class="alert alert-danger"><?= $error_message ?></div>
                <?php } ?>
                <form method="post" >
                    <div class="form-floating mt-4">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" required />
                        <label for="username" class="form-label">Username</label>
                    </div>
                    <button class="custom-btn mt-4 w-100">Next</button>
                </form>
            </div>
        </div>
    </div>
<?php } else if ($step == 3) { ?>
    <div class="main">
        <div class="card mx-auto my-5 forgot-password-container">
            <div class="card-body p-4">
                <h3 class="text-center">Forgot Password - Step 3</h3>
                <p class="text-center text-muted">Enter your registered phone number.</p>
                <?php if(!empty($error_message)) { ?>
                    <div class="alert alert-danger"><?= $error_message ?></div>
                <?php } ?>
                <form method="post" >
                    <div class="form-floating mt-4">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone number" required />
                        <label for="phone" class="form-label">Phone Number</label>
                    </div>
                    <button class="custom-btn mt-4 w-100">Next</button>
                </form>
            </div>
        </div>
    </div>
<?php } else if($step==4) { ?>
    <div class="main">
        <div class="card mx-auto my-5 forgot-password-container">
            <div class="card-body p-4">
                <h3 class="text-center">Reset Password</h3>
                <form method="post"  onsubmit="return validatePassword()">
                    <div class="form-floating mt-4">
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter your new password" required />
                        <label for="new_password" class="form-label">New Password</label>
                    </div>
                    <div class="form-floating mt-4">
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm your new password" required />
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div id="error_message" style="color: red; display: none;">Passwords do not match!</div>
                    </div>
                    <button class="custom-btn mt-4 w-100">Reset</button>
                </form>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="main">
        <div class="card mx-auto my-5 forgot-password-container">
            <div class="card-body p-4">
                <h3 class="text-center">Successful reset Password!</h3>
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-link">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function validatePassword() {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (newPassword !== confirmPassword) {
            document.getElementById('error_message').style.display = 'block';
            return false;
        } else {
            document.getElementById('error_message').style.display = 'none';
            return true;
        }
    }
</script>
</body>

</html>
