<nav class="nav">
    <div class="logo ms-0">
        <div class="logo-area">
            <a href="#"> <img class="profile" style="border-radius: 20px;" src="../asset/css/img/images.png"></a>
        </div>
    </div>
    <div>
        <h1 class="mt-4 dashboard">ADMIN DASHBOARD</h1>
    </div>
    <!-- <div id="search-wapper" class="mx-auto">
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
    </div> -->

    <div class="profile-wapper text-color-light">
        <div>
            <span class="text-color"><?= $user["user_name"]?></span>
        </div>
        <div class="dropdown">
            <div type="button" data-bs-toggle="dropdown">
                <img class="profile" style="border-radius: 20px;" src="../asset/css/img/admin.png">
            </div>
            <form method="post">
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><button name="logout" class="dropdown-item">Logout</button></li>
                </ul>
            </form>
        </div> 
    </div>
</nav>

   

   

 
 




