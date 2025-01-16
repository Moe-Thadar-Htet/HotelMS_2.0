<?php 

    $name = $email = $phonenumber = $date = $checkout_date ="";
    $name_err = $email_err = $phonenumber_err = $date_err =$checkout_date_err= "";
    $division = $division_err ="";
    $region = $region_err = "";
    $citizen = $citizen_err = "";
    $nrc_no = $nrc_no_err ="";
    $nrc = $nrc_err ="";
    $invalid = true;




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
            $invalid = false;
        }
        if(empty($region)) {
            $region_err = "Region can't be  blank!";
            $invalid = false;
        }
        if(empty($citizen)) {
            $citizen_err = "Citizen can't be  blank!";
            $invalid = false;
        }
        if(empty($nrc_no)) {
            $nrc_no_err = "NRC Number can't be  blank!";
            $invalid = false;
        }
        if(empty($nrc)) {
            $nrc_err = "NRC must be required!";
            $invalid = false;
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

        if($name_err=="" && $email_err=="" && $phonenumber_err=="" && $date_err=="" && $checkout_date_err=="" && $invalid == true){
            $status = sell_booking($mysqli,$roomIdValue,$date,$checkout_date,$email,$name,$phonenumber,$nrc);
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
                    <h5 class="modal-title">Room Number: <span class="room-no-value"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mt-2">
                        <input type="text" name="name" value="<?= $name ?>" class="form-control" id="name" placeholder="Enter customer name" />
                        <div style="color: red;"><?= $name_err ?></div>
                        <label for="name" class="form-label">Customer Name</label>
                    </div>
                    <span class="">NRC</span>
                    <div class="card mb-5">
                        <div class="crad-body" style="height:250px;">
                            <div class="fornrc d-flex mt-3">
                                <div class="form-group ms-3 col-4">
                                    <label for="division" class="form-label"> Division</label>
                                    <select name="division" id="division" class="form-select">
                                        <option value="" selected>Select division</option>
                                        <option value="1" <?php if($division==1)echo "selected" ?>>1</option>
                                        <option value="2" <?php if($division==2)echo "selected" ?>>2</option>
                                        <option value="3" <?php if($division==3)echo "selected" ?>>3</option>
                                        <option value="4" <?php if($division==4)echo "selected" ?>>4</option>
                                        <option value="5" <?php if($division==5)echo "selected" ?>>5</option>
                                        <option value="6" <?php if($division==6)echo "selected" ?>>6</option>
                                        <option value="7" <?php if($division==7)echo "selected" ?>>7</option>
                                        <option value="8" <?php if($division==8)echo "selected" ?>>8</option>
                                        <option value="9" <?php if($division==9)echo "selected" ?>>9</option>
                                        <option value="10" <?php if($division==10)echo "selected" ?>>10</option>
                                        <option value="11" <?php if($division==11)echo "selected" ?>>11</option>
                                        <option value="12" <?php if($division==12)echo "selected" ?>>12</option>
                                        <option value="13" <?php if($division==13)echo "selected" ?>>13</option>
                                        <option value="14" <?php if($division==14)echo "selected" ?>>14</option>
                                    </select>                        
                                    <div class="text-danger" id="valid"><?= $division_err ?></div> 
                                </div>  
                
                                <div class="form-group  ms-5 col-6">
                                    <label for="region" class="form-label">Region</label>
                                    <select name="region" id="region" class="form-select">
                                    <option value="">Select region</option>
                                        <option value="1" <?php if($region==1)echo "selected" ?>>YAGANA</option>
                                        <option value="2" <?php if($region==2)echo "selected" ?>>KANTANA</option>
                                        <option value="3" <?php if($region==3)echo "selected" ?>>MADALA</option>
                                    </select>
                                    <div class="text-danger" id="valid"><?= $region_err ?></div>
                                    
                                </div>
                            </div>
                            <div class="fornrc d-flex">
                                <div class="form-group ms-3 col-4">
                                    <label for="citizen" class="form-label">Citizen</label>
                                    <select name="citizen" id="citizen" class="form-select">
                                    <option value="">Select Citizen</option>
                                        <option value="(C)" <?php if($citizen=="(C)")echo "selected" ?>>C (Citizen) </option>
                                        <option value="(AC)" <?php if($citizen=="(AC)")echo "selected" ?>>AC (Associated Citizen) </option>
                                        <option value="(NC)" <?php if($citizen=="(NC)")echo "selected" ?>>NC (Naturalized Cititzen) </option>
                                        <option value="(V)" <?php if($citizen=="(V)")echo "selected" ?>>V (National Verification) </option>
                                        <option value="(M)" <?php if($citizen=="(M)")echo "selected" ?>>M (Monk) </option>
                                        <option value="(N)" <?php if($citizen=="(N)")echo "selected" ?>>N (Nun) </option>
                                    </select>
                                    <div class="text-danger" id="valid"><?= $citizen_err?></div>
                                </div>
                                <div class="form-group ms-5 col-6">
                                    <label for="nrc_no" class="form-label">NRC Number</label>
                                    <input type="number" value="<?= $nrc_no?>" name="nrc_no" class="form-control" id="nrc_no" placeholder="Enter Your NRC Number" />
                                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $nrc_no_err ?></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="text-danger" id="valid"><?= $nrc_err ?></div>
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
                            <input type="date" name="checkout_date" class="form-control" value="<?php echo htmlspecialchars($checkout_date); ?>" id="checkout2">
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

