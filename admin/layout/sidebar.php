<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img src="../assets/images/remove.png" style="width:75px">
        </div>
        <div class="sidebar-brand-text mx-3">HB-Blog</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li 
        <?php  
            if(!isset($_GET['page'])):
        ?>
            class="nav-item active"
        <?php   
            else:
        ?>
            class="nav-item"
        <?php
            endif;       
        ?>
    >
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Charts -->

    <!-- category -->
    <li
        <?php  
            if(isset($_GET['page'])) {
                if($_GET['page'] === 'category' || $_GET['page'] === 'category-create' || $_GET['page'] === 'category-edit') {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item'";
                }
            } else {
                echo "class='nav-item'";
            }
        ?>  
    >
        <a class="nav-link" href="index.php?page=category">
            <i class="fas fa-fw fa-table"></i>
            <span>Category</span>
        </a>
    </li>

    <!-- blogs -->
    <li 
        <?php  
            if(isset($_GET['page'])) {
                if($_GET['page'] === 'blogs' || $_GET['page'] === 'blogs-create' || $_GET['page'] === 'blogs-edit') {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item'";
                }
            } else {
                echo "class='nav-item'";
            }
        ?>
    >
        <a class="nav-link" href="index.php?page=blogs">
            <i class="fas fa-fw fa-folder"></i>
            <span>Blog</span>
        </a>
    </li>

    <!-- users -->
    <li 
        <?php  
            if(isset($_GET['page'])) {
                if($_GET['page'] === 'users' || $_GET['page'] === 'users-create' || $_GET['page'] === 'users-edit') {
                    echo "class='nav-item active'";
                } else {
                    echo "class='nav-item'";
                }
            } else {
                echo "class='nav-item'";
            }
        ?>
    >
        <a class="nav-link" href="index.php?page=users">
            <i class="fas fa-user-alt"></i>
            <span>User</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>