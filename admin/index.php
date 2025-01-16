<?php require_once("../auth/login.php") ?>
<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<div class="role-div">

    <div class="role-container-total col-3">
        <div class="admin-total">
            <div class="card card-btn">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="admin-text"><i class="fa-solid fa-hotel me-2 mt-3"></i>Booking request</span>
                        <span class="d-inline"><?= count(get_booking($mysqli)->fetch_all());?></span>
                    </div>
                </div>

            </div>
       

            <div class="card card-btn mt-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text"><i class="fa-solid fa-hotel me-2 mt-3"></i>Total Room</span>
                    <span class="d-inline"><?= count(get_room($mysqli)->fetch_all());?></span>
                    
                </div>

            </div>
    

            <div class="card card-btn mt-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text"><i class="fa-solid fa-bed me-2 mt-3"></i>Total Room Type</span>
                    <span class="d-inline"><?= count(get_room_type($mysqli)->fetch_all());?></span>

                </div>

            </div>
    
            <div class="card card-btn mt-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text"><i class="fa-solid fa-users me-2 mt-3"></i>Total Customer </span>
                    <span class="d-inline"><?= count(get_customer($mysqli)->fetch_all());?></span>
                
                </div>

            </div>
      
            <div class="card card-btn mt-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text"><i class="fa-solid fa-user-tie me-2 mt-3"></i>Total Staff</span>
                    <span class="d-inline"><?= count(get_staff($mysqli)->fetch_all());?></span>
                </div>

            </div>
    
            <div class="card card-btn mt-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text"><i class="fa-solid fa-bookmark me-2 mt-3"></i>Total Booking</span>
                    <span class="d-inline"><?= count(get_booking($mysqli)->fetch_all());?></span>
                   
                </div>
            </div>       

        </div>
    

    </div>
    <div class="role-container col-9">
        <div class="admin-btn ">
            <button class="btn btn-admin btn-md col-3 ms-5">
                <a href="./index.php" class="card-title card-role"><i class="fa-solid fa-home me-2"></i>Home</a>
            </button>
            <button class="btn btn-admin  btn-md col-3  ">        
                <a href="./add_room.php" class="card-title card-role"> <i class="fa-solid fa-hotel me-2"></i>Room</a>
            </button>
            <button class="btn btn-admin  btn-md col-3">        
                <a href="./add_room_type.php" class="card-title card-role"> <i class="fa-solid fa-bed me-2"></i>Room Type</a>
            </button>    
        </div>

        <div class="admin-btn mt-4">
            <button class="btn btn-admin  btn-md col-3 ms-5">
                <a href="./add_customer_room.php" class="card-title card-role"><i class="fa-solid fa-bookmark me-2"></i>Customer Room Detail</a>
            </button>
            <button class="btn btn-admin  btn-md col-3">        
                <a href="./add_booking.php" class="card-title card-role"> <i class="fa-solid fa-phone me-2"></i>Booking</a>
            </button>
            <button class="btn btn-admin btn-md col-3">        
                <a href="./add_customer.php" class="card-title card-role"> <i class="fa-solid fa-users me-2"></i>Customer</a>
            </button>    
        </div>
        <div class="admin-btn mt-4">
            <button class="btn btn-admin btn-md col-3 ms-5">
                <a href="./add_staff.php" class="card-title card-role" ><i class="fa-solid fa-user-tie me-2"></i>Staff</a>
            </button>
            <button class="btn btn-admin btn-md col-3">        
                <a href="./add_duty.php" class="card-title card-role"><i class="fa-solid fa-circle-check me-2"></i>Duty</a>
            </button>
            <button class="btn btn-admin  btn-md col-3">        
                <a href="./add_duty_staff.php" class="card-title card-role"><i class="fa-solid fa-business-time me-2"></i>Duty Staff Detail</a>
            </button>    
        </div>
        <div class="admin-btn mt-4">
            <button class="btn btn-admin btn-md col-3 ms-5">
                <a href="./add_user.php" class="card-title card-role"><i class="fa-solid fa-user me-2"></i>User</a>
            </button>
            <button class="btn btn-admin  btn-md col-3">        
                <a href="../reception/index.php"  class="card-title card-role"> <i class="fa-solid fa-list me-2"></i>Reception view</a>
            </button>
            <button class="btn btn-admin  btn-md col-3">        
                <a href="./add_booking_request.php" class="card-title card-role"> <i class="fa-solid fa-home me-2"></i>Booking Request</a>
            </button>    
        </div>  
    </div>

</div>

  
      











<?php require_once("../layout/footer.php")?>
