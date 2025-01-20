<?php require_once("../auth/login.php") ?>
<?php require_once("../layout/header.php")?>
<?php require_once("../layout/navbar.php")?>
<div class="role-div">

    <div class="role-container-total col-3">
        <div class="admin-total">
        <div class="card card-btn mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text d-flex align-items-center">
                        <i class="fa-solid fa-hotel me-3"></i>Booking Request
                    </span>
                    <span class="badge bg-danger rounded-pill">
                        <?= count(join_customer_booking($mysqli)->fetch_all());?>
                    </span>
                </div>
            </div>
       

            <div class="card card-btn mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text d-flex align-items-center">
                        <i class="fa-solid fa-bed me-3"></i>Total Room
                    </span>
                    <span class="badge bg-primary rounded-pill">
                        <?= count(get_room($mysqli)->fetch_all());?>
                    </span>
                </div>
            </div>
    

            <div class="card card-btn mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text d-flex align-items-center">
                        <i class="fa-solid fa-door-open me-3"></i>Total Room Type
                    </span>
                    <span class="badge bg-info rounded-pill">
                        <?= count(get_room_type($mysqli)->fetch_all());?>
                    </span>
                </div>
            </div>
    
            <div class="card card-btn mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text d-flex align-items-center">
                        <i class="fa-solid fa-users me-3"></i>Total Customer
                    </span>
                    <span class="badge bg-success rounded-pill">
                        <?= count(get_customer($mysqli)->fetch_all());?>
                    </span>
                </div>
            </div>
      
            <div class="card card-btn mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text d-flex align-items-center">
                        <i class="fa-solid fa-user-tie me-3"></i>Total Staff
                    </span>
                    <span class="badge bg-secondary rounded-pill">
                        <?= count(get_staff($mysqli)->fetch_all());?>
                    </span>
                </div>
            </div>
    
            <div class="card card-btn mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="admin-text d-flex align-items-center">
                        <i class="fa-solid fa-bookmark me-3"></i>Total Booking
                    </span>
                    <span class="badge bg-dark rounded-pill">
                        <?= count(get_booking($mysqli)->fetch_all());?>
                    </span>
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
            <!-- <button class="btn btn-admin  btn-md col-3">        
                <a href="../booking_request.php" class="card-title card-role"> <i class="fa-solid fa-list me-2"></i>Booking Request List</a>
            </button>     -->
        </div>  
    </div>

</div>

<style>
    
    .card-body {
        padding: 20px;
    }

    .admin-text {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .badge {
        font-size: 14px;
        padding: 6px 12px;
        color: #fff;
        font-weight: 700;
    }

    .card-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .card-btn i {
        font-size: 20px;
    }

    .text-primary { color: #007bff; }
    .text-success { color: #28a745; }
    .text-info { color: #17a2b8; }
    .text-warning { color: #ffc107; }
    .text-danger { color: #dc3545; }
    .text-dark { color: #343a40; }

    /* Responsive styling */
    @media (max-width: 768px) {
        .role-container-total {
            width: 100%;
            height: auto; /* Allow for dynamic height on smaller screens */
            position: relative;
        }

        .role-container {
            margin-left: 0; /* Reset margin-left for small screens */
        }

        .card-btn {
            margin-bottom: 15px;
        }
    }
</style>
  
      











<?php require_once("../layout/footer.php")?>
