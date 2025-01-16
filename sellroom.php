<!-- <style>
    #valid{
    height: 35px;
    color: red;
    padding-top: 5px;
    padding-left: 10px;
    font-size: 14px;
    font-style: italic;
    font-size:12px;
    }
   
</style> -->

<?php 

$customer_name = $customer_name_err = "";
$phone = $phone_err = "";
$division = $division_err ="";
$region = $region_err = "";
$citizen = $citizen_err = "";
$nrc_no = $nrc_no_err ="";
$phone_no = $phone_no_err ="";
$nrc = $nrc_err ="";
$email = $email_err ="";
$checkin = $checkin_err ="";
$checkout =$checkout_err = "";
$invalid = true;
$nrcstatus = true;
$status = true;

if(isset($_POST["customer_name"])){
    $roomIdValue = $_POST["roomId"];
    $customer_name = $_POST["customer_name"];
    $phone_no =  $_POST["phoneNumber"];
    $division =  $_POST["division"];
    $region =  $_POST["region"];
    $citizen =  $_POST["citizen"];
    $nrc_no =  $_POST["nrc_no"];
    $nrc = $division."/".$region. $citizen.$nrc_no;
    $email = $_POST["email"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];

    if($customer_name  === ""){
        $customer_name_err = "Customer Name doesn't blank! ";
        $invalid = false;
    }
    if($phone_no === ""){
        $phone_no_err = "Phone Number doesn't blank! ";
        $invalid = false;
    }
    if($division === ""){
        $division_err = "Division Code doesn't blank! ";
        $invalid = false;
        $nrcstatus = false;
    }
    if($region === ""){
        $region_err = "Region Name doesn't blank! ";
        $invalid = false;
        $nrcstatus = false;
    }
    if($citizen  === ""){
        $citizen_err = "Citizen doesn't blank! ";
        $invalid = false;
        $nrcstatus = false;
    }
    if($nrc_no  === ""){
        $nrc_no_err = "NRC Number doesn't blank! ";
        $invalid = false;
        $nrcstatus = false;
    }
    if(!$nrcstatus){
        $nrc_err = "Your NRC Code must be required!";
        $invalid = false;
    }
    if($email === ""){
        $email_err = "Email doesn't blank! ";
        $invalid = false;
    }
    if($checkin === ""){
        $checkin_err = "Checkin Date doesn't blank! ";
        $invalid = false;
    }
    if($checkout  === ""){
        $checkout_err = "Checkout Date doesn't blank! ";
        $invalid = false;
    }
    if($invalid){
        if($status){
            sell_customer($mysqli,$customer_name,$nrc,$phone_no,$email,$checkin,$checkout,$roomIdValue);
            echo "<script>location.replace('./index.php');</script>";
        }
    
    }
}

?>


<div class="modal fade" id="sellRoomModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Room Number: <span class="room-no-value"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="roomIdValue" name="roomId" value="<?= $roomIdValue ?>">
                    <div class="form-floating mt-2">
                        <input type="text" value="<?= $customer_name?>" name="customer_name" class="form-control" id="customer_name " placeholder="Enter customer name"  />
                        <label for="customer_name " class="form-label">Customer Name</label>
                        <div class="text-danger" id="valid"><?= $customer_name_err?></div>
                    </div>
                    <span class="">NRC</span>
                    <div class="card">
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
                        <input type="number" value="<?= $phone_no ?>" name="phoneNumber" class="form-control" id="phoneNumber" value="<?= $phone?>" />
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <div class="text-danger" id="valid"><?= $phone_no_err?></div>
                    </div>

                    <div class="form-floating mt-2">
                        <input type="text" value="<?= $email ?>" name="email" class="form-control" id="email" value="<?= $email?>" />
                        <label for="email" class="form-label">Email Address</label>
                        <div class="text-danger" id="valid"><?= $email_err?></div>
                    </div>

                    <div class="form-floating mt-2">
                        <div class="mt-4">Check-in Date
                            <input type="date" value="<?= $checkin?>" name="checkin" class="form-control" id="checkin" >
                            <div class="text-danger" id="valid"><?= $checkin_err?></div>
                        </div>
                        
                        <div class="mt-4">Check-out Date
                            <input type="date" value="<?= $checkout?>" name="checkout" class="form-control" id="checkout" >
                            <div class="text-danger" id="valid"><?= $checkout_err?></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-danger">Sell a Room</button>
                </div>
           
            </form>
        </div>
    </div>
</div>

