<!-- Admin_Navigation_Bar -->
<div id="nav" class="navbar navbar-dark navbar-expand fixed-top" style="background-color: #1A1A1A;">
        <div class="container">
            <a href="index.html" class="navbar-brand me-5" style="color: #F5F5F5;">
                Reception
            </a>
      
            
            <?php
                if($user["role"] === "1"){?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../admin/index.php" class="nav-link"  >
                            <span class="nav-text btn btn-outline-light ms-auto" id="home">Home<i class="fa fa-home "style="padding-left: 5px;"></i></span>
                        </a>
                    <li>

                    <li class="nav-item">
                        <a href="./index.php?allRoom" class="nav-link" >
                            <span class="nav-text btn btn-outline-info ms-auto" 
                            style="<?php
                            if(isset($_GET['allRoom'])){
                                echo "background-color: #10CAF0;color:#000000;";
                            } 
                            ?>"
                            id="all-room">All Rooms <i class="fa fa-bed"></i></span>
                        </a>
                    <li>
                    <li class="nav-item">
                        <a href="./index.php?available" class="nav-link ">
                            <span class="nav-text btn btn-outline-success ms-auto"
                            style="<?php
                            if(isset($_GET['available'])){
                                echo "background-color: #198753;color:#FFFFFF;";
                            } 
                            ?>"
                            id="available">Available <i class="fa fa-broom"></i></span>
                        </a>
                        <li>
                            <li class="nav-item">
                                <a href="./index.php?soldout" class="nav-link ">
                                    <span class="nav-text btn btn-outline-danger ms-auto"
                                    style="<?php
                                    if(isset($_GET['soldout'])){
                                            echo "background-color: #DC3444;color:#FFFFFF;";
                                        } 
                                    ?>"
                                    id="sold-out">Sold Out<i class="fa fa-exclamation-triangle" style="padding-left: 5px;"></i></span>
                                </a>
                            </li>
                        </li>
                    </li>
                    
                    <li class="nav-item">
                        <a href="./index.php?booked" class="nav-link ">
                            <span class="nav-text btn btn-outline-warning ms-auto"
                            style="<?php
                                    if(isset($_GET['booked'])){
                                            echo "background-color: #FFC007;color:#000000;";
                                        } 
                                    ?>"
                            id="booked">Booked<i class="fas fa-calendar-check" style="padding-left: 5px;"></i>
                            </span>
                        </a>
                    <li>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top: 8px;">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                    Profile <i class="fa fa-user"></i>
                                </a>
                            </li>
                            <li>
                                <form method="post">
                                    <button class="dropdown-item d-flex justify-content-between align-items-center" name="logout">
                                        Logout <i class="fa fa-sign-out-alt"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </ul>               
            <?php }else{
               if($user["role"] === "2"){?>
               <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="./index.php?allRoom" class="nav-link" >
                            <span class="nav-text btn btn-outline-info ms-auto" 
                            style="<?php
                            if(isset($_GET['allRoom'])){
                                echo "background-color: #10CAF0;color:#000000;";
                            } 
                            ?>"
                            id="all-room">All Rooms <i class="fa fa-bed"></i></span>
                        </a>
                    <li>
                    <li class="nav-item">
                        <a href="./index.php?available" class="nav-link ">
                            <span class="nav-text btn btn-outline-success ms-auto"
                            style="<?php
                            if(isset($_GET['available'])){
                                echo "background-color: #198753;color:#FFFFFF;";
                            } 
                            ?>"
                            id="available">Available <i class="fa fa-broom"></i></span>
                        </a>
                        <li>
                            <li class="nav-item">
                                <a href="./index.php?soldout" class="nav-link ">
                                    <span class="nav-text btn btn-outline-danger ms-auto"
                                    style="<?php
                                    if(isset($_GET['soldout'])){
                                            echo "background-color: #DC3444;color:#FFFFFF;";
                                        } 
                                    ?>"
                                    id="sold-out">Sold Out<i class="fa fa-exclamation-triangle" style="padding-left: 5px;"></i></span>
                                </a>
                            </li>
                        </li>
                    </li>
                    
                    <li class="nav-item">
                        <a href="./index.php?booked" class="nav-link ">
                            <span class="nav-text btn btn-outline-warning ms-auto"
                            style="<?php
                                    if(isset($_GET['booked'])){
                                            echo "background-color: #FFC007;color:#000000;";
                                        } 
                                    ?>"
                            id="booked">Booked<i class="fas fa-calendar-check" style="padding-left: 5px;"></i>
                            </span>
                        </a>
                    <li>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top: 8px;">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                    Profile <i class="fa fa-user"></i>
                                </a>
                            </li>
                            <li>
                                <form method="post">
                                    <button class="dropdown-item d-flex justify-content-between align-items-center" name="logout">
                                        Logout <i class="fa fa-sign-out-alt"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </ul>       
            <?php }
            } ?>
                
                
            
        </div>
    </div>

    