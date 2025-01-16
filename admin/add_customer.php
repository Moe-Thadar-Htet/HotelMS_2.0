<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<?php

$customer_name= $customer_name_err ="";
$division = $division_err ="";
$region   = $region_err ="";
$citizen  = $citizen_err = "";
$nrc_no   = $nrc_no_err  = "";
$nrc = $nrc_err = "";
$phone_no= $phone_no_err="";
$email= $email_err = "";
// $checkin = $checkin_err = "";
// $checkout = $checkout_err ="";
$invalid= true;
$status = true;


$currentPage = 0;
    if (isset($_GET["pageNo"])) {
        $currentPage = (int) $_GET["pageNo"];
    }

    $pagTotal = get_customers_pag_count($mysqli);
    if (isset($_GET['lest'])) {
        $currentPage = ($pagTotal * 7) - 7;
    }


if(isset($_GET["editId"])){
    $editId = $_GET["editId"];
    $customer = get_customer_id($mysqli,$editId);
    $customer_name   =$customer["customer_name"];
    $nrc    = $customer["nrc"];
    $phone_no =$customer["phone_no"];
    $email    = $customer["email"];
}

if(isset($_GET["deleteId"])){
    if(delete_customer($mysqli,$_GET["deleteId"]));
    echo"<script>Location.replace('./add_customer.php')</script>";

}

if(isset($_POST["customer_name"])){
    $customer_name   = $_POST["customer_name"];
    $division = $_POST["division"];
    $region = $_POST["region"];
    $citizen = $_POST["citizen"];
    $nrc_no = $_POST["nrc_no"];
    $nrc = $division."/".$region. $citizen.$nrc_no;
    $phone_no = $_POST["phone_no"];
    $email    = $_POST["email"];
    // $checkin  = $_POST["checkin"];
    // $checkout = $_POST["checkout"];

     if($customer_name === ""){
        $customer_name_err = "Customer Name can't be blanked!";
        $invalid     = false;
     }
     if($division === ""){
        $division_err = "Township Division can't be blanked!";
        $invalid = false;
        $status = false;
     }
      if($region === ""){
        $region_err = "Region can't be blanked!";
        $invalid = false;
        $status = false;
     }
      if($citizen === ""){
        $citizen_err = "Citizen Format can't be blanked!";
        $invalid = false;
        $status = false;
     }
     if($nrc_no === ""){
        $nrc_no_err = "NRC Code can't be blanked!";
        $invalid = false;
        $status = false;
     
     }
     if(!$status){
        if(!$nrc){
            $nrc_err = "Your NRC Code must be required!";
            $invalid = false;
        }
       
     }
     

     if($phone_no === ""){
        $phone_no_err = "Phone Number can't be blanked!";
        $invalid = false;
     }
     if($email === ""){
        $email_err =" Email can't be blanked!";
        $invalid   = false;
     }
    //  if($checkin === ""){
    //     $checkin_err ="Checkin Date can't be blanked!";
    //     $invalid   = false;
    //  }
    //  if($checkout === ""){
    //     $checkout_err =" Checkout Date can't be blanked!";
    //     $invalid   = false;
    //  }


     if($invalid){
        if(isset($_GET["editId"])){
            $update =update_customer($mysqli,$editId,$customer_name,$nrc,$phone_no,$email);
            if($update){
                echo "<script>location.replace('./add_customer.php')</script>";
            }
        }else{
            if(add_customer($mysqli,$customer_name,$nrc,$phone_no,$email)){
                echo "<script>location.replace('./add_customer.php')</script>";
            }else{
                $invalid = true;
            }      
            
        }
    }
 }
?>

<div class="room">
    <div class="card-form col-3 mt-3 p-3">
        <div class="card-title ">
            <?php if (isset($_GET["editId"])){?>
                <h2 class="text-center title-color" >Update Customer</h2>
            <?php }else { ?>
                <h2 class="text-center title-color">Add Customer</h2>
            <?php }?>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group"> 
                    <label for="customer_name" class="form-label">Name</label>
                    <input type="text" name="customer_name" class="form-control" id="customer_name" value="<?= $customer_name ?>">
                    <div class="text-danger" id="valid"><?= $customer_name_err ?></div>
                </div>
                <div class="form-group ">
                    <span >NRC</span> 
                    <div class="card mt-2">
                        <div class="crad-body" style="height:250px;">
                            <div class="fornrc d-flex mt-3">
                                <div class="form-group ms-3 col-4">
                                    <label for="division" class="form-label"> Division</label>
                                    <select name="division" id="division" class="form-select">
                                    <option value="">Select division</option> 
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>     
                                    </select>
                                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $division_err ?></div>
                                </div>
                                <div class="form-group  ms-3 col-6">
                                    <label for="region" class="form-label">Region</label>
                                    <select name="region" id="region" class="form-select">
                                    <option value="">Select region</option>
                                        <option value="KAYANA">KAYANA</option>
                                        <option value="BAMANA">BAMANA</option>
                                        <option value="YAKANA">YAKANA</option>
                                        <option value="SAKANA">SAKANA</option>
                                        <option value="MAKANA">MAKANA</option>
                                     
                                    </select>
                                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $region_err ?></div>
                                </div>

                            </div>

                            <div class="fornrc d-flex">
                                <div class="form-group ms-3 col-4">
                                    <label for="citizen" class="form-label">Citizen</label>
                                    <select name="citizen" id="citizen" class="form-select">
                                    <option value="">Select citizen</option>
                                        <option value="(C)">C (Citizen) </option>
                                        <option value="(AC)">AC (Associated Citizen) </option>
                                        <option value="(NC)">NC (Naturalized Cititzen) </option>
                                        <option value="(V)">V (National Verification) </option>
                                        <option value="(M)">M (Monk) </option>
                                        <option value="(N)">N (Nun) </option>
                                    </select>
                                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $citizen_err?></div>
                                </div>
                                <div class="form-group ms-4 col-6">
                                    <label for="nrc_no" class="form-label">NRC Number</label>
                                    <input type="number" name="nrc_no" class="form-control" id="nrc_no" placeholder="Enter Your NRC Number" />
                                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $nrc_no_err ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger" id="valid" style="font-size:12px;"><?= $nrc_err ?></div>
                </div>
             
                <div class="form-group ">
                    <label for="phone_no" class="form-label">Phone Number</label>
                    <input type="text" name="phone_no" class="form-control" id="phone_no" value="<?=$phone_no?>">
                    <div class="text-danger" id="valid" ><?= $phone_no_err?></div>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?=$email?>">
                    <div class="text-danger" id="valid"><?= $email_err?></div>
                </div>
                <!-- <div class="form-group"> 
                    <label for="checkin" class="form-label">Checkin Date</label>
                    <input type="datetime-local" name="checkin" class="form-control" id="checkin" value="<?=$checkin?>"/>
                    <div class="text-danger" id="valid">></div>
                </div>
                <div class="form-group"> 
                    <label for="checkout" class="form-label">Checkout Date</label>
                    <input type="datetime-local" name="checkout" class="form-control" id="checkout" value="<?=$checkout ?>"/>
                    <div class="text-danger" id="valid"></div>
                </div> -->
              
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

    <div class="card-form col-8 mt-3 p-3">
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
        
        <div class="card-body">
           <div class="card">
            <div class="card-title">
                <div class="d-flex p-3">
                    <h2 class="" style="color: var(--nav-color);">Customer List</h2>
                    <a href="./index.php" class="btn btn-success btn-md ms-auto">Home</a>
                </div> 
            </div>
                <div class="card-body">
                    <table class="table table-bordered  table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>NRC</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <!-- <th>Checkin Date</th>
                                <th>Checkout Date</th> -->
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                        <?php if (isset($_POST["search"]) && $_POST['search'] != '') {
                                $customers = get_customer_filter($mysqli, $_POST['search']);
                            } else {
                                $customers = get_customers($mysqli,$currentPage);
                            } ?>
                        <?php
                            if (isset($_POST["search"])) {
                                $i = 1;
                            } else {
                                $i = $currentPage + 1;
                            } ?>
                            <?php while ($customer = $customers->fetch_assoc()) { ?>
                            
                            <tr>
                                <td><?= $i?></td>
                                <td><?= $customer["customer_name"]?></td>
                                <td><?= $customer["nrc"]?></td>
                                <td><?= $customer["phone_no"]?></td>
                                <td><?= $customer["email"]?></td>
                              
                                <td>
                                    <a href="?editId=<?= $customer['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-sm btn-danger  deleteSelect" data-value="<?=$customer['id']?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            
                            <?php $i++;} ?>
                      
                            
                           
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
</div>

<?php require_once("../layout/footer.php")?>