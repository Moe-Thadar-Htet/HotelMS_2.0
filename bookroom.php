<?php 

    $name = $email = $phonenumber = $date = $checkout_date ="";
    $name_err = $email_err = $phonenumber_err = $date_err =$checkout_date_err= "";
    $division = $division_err ="";
    $region = $region_err = "";
    $citizen = $citizen_err = "";
    $nrc_no = $nrc_no_err ="";
    $nrc = $nrc_err ="";


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $division =  $_POST["division"];
        $region =  $_POST["region"];
        $citizen =  $_POST["citizen"];
        $nrc_no =  $_POST["nrc_no"];
        $nrc = $division."/".$region. $citizen.$nrc_no;
        $email = $_POST["email"];
        $phonenumber = $_POST["phonenumber"];
        $date = $_POST["date"];
        $checkout_date = $_POST["checkout_date"];
        $roomIdValue = $_POST['roomId'];
        if(empty($name)) {
            $name_err = "Name can't be  blank!";
        } else {
            $name = htmlspecialchars(trim($name));
            if(!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $name_err = "Only letters and white space allowed in name.";
            }
        }
        if(empty($division)) {
            $division_err = "Division can't be  blank!";
        }
        if(empty($region)) {
            $region_err = "Region can't be  blank!";
        }
        if(empty($citizen)) {
            $citizen_err = "Citizen can't be  blank!";
        }
        if(empty($nrc_no)) {
            $nrc_no_err = "NRC Number can't be  blank!";
        }
        if(empty($nrc)) {
            $nrc_err = "NRC must be required!";
        }
       

        if(empty($email)) {
            $email_err = "Email is Required";
        } else {
            $email = htmlspecialchars(trim($email));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format.";
            }
        }

        if(empty($phonenumber)) {
            $phonenumber_err = "Phone Number is Required";
        } else {
            $phonenumber = htmlspecialchars(trim($phonenumber));
            if(!preg_match('/^\d+$/', $phonenumber)) {
                $phonenumber_err = "Only numbers are allowed.";
            }
        }

        if(empty($date)) {
            $date_err = "Choose your checkout Date.";
        }
        if(empty($checkout_date)) {
            $checkout_date_err = "Choose your checkout Date.";
        }

        if($name_err=="" && $email_err=="" && $phonenumber_err=="" && $date_err=="" && $checkout_date_err==""){
            $status = sell_booking($mysqli,$roomIdValue,$date,$checkout_date,$email,$name,$phonenumber);
            if($status){
                echo "<script>location.replace('./index.php');</script>";
            }else{
                $email_err = "Customer doen't have with this Email!";
            }
        }
    }


?>


<div class="modal fade" id="bookRoomModal">
    <div class="modal-dialog">
        <form method="post">
        <input type="hidden" class="roomIdValue" name="roomId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Room Number: <span class="room-no-value"></span>  </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mt-2">
                        <input type="text" name="name" value="<?= $name ?>" class="form-control" id="name" placeholder="Enter customer name" />
                        <div style="color: red;"><?= $name_err ?></div>
                        <label for="name" class="form-label">Customer Name</label>
                    </div>

                    <div class="form-floating mt-2">
                        <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>"  id="email"  placeholder="Enter customer email" />
                        <div style="color: red;"><?= $email_err ?></div>
                        <label for="email" class="form-label">Email Address</label>
                    </div>

                    <div class="form-floating mt-2">
                        <input type="text" name="phonenumber" value="<?php echo htmlspecialchars($phonenumber); ?>"class="form-control" id="phonenumber" placeholder="Phone Number" />
                        <div style="color: red;"><?= $phonenumber_err ?></div>
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                    </div>

                    <div class="form-floating mt-2">
                        <div class="mt-4">Check-in Date
                            <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($date); ?>" id="checkin2">
                            <div style="color: red;"><?= $date_err ?></div>
                        </div>
                    </div>
                    <div class="form-floating mt-2">
                        <div class="mt-4">Check-Out Date
                            <input type="date" name="checkout_date" class="form-control" value="<?php echo htmlspecialchars($checkout_date); ?>" id="checkin2">
                            <div style="color: red;"><?= $checkout_date_err ?></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Book</button>
                </div>
            </div>
        </form>
    </div>
</div>

