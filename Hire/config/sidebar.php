<?php
session_start();
if (!isset($_SESSION['profile_id'])) {
    header("location: ../index");
    exit();
}

?>
<?php
if ($_SESSION['type'] == "freelancer Profile") {
?>

    <!-- freelancer -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Ur Dashboard</div>
                        <a class="nav-link" href="../freelancer/">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>



                        <div class="sb-sidenav-menu-heading">Menus</div>
                        <a class="nav-link" href="../freelancer/projects.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area text-light"></i></div>
                            Projects
                        </a>
                        <a class="nav-link" href="../freelancer/clients.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table text-light"></i></div>
                            Clients
                        </a>
                        <a class="nav-link" href="../freelancer/DCChannel.php?freelancer_code=default">
                            <div class="sb-nav-link-icon"><i class="fas fa-table text-light"></i></div>
                            Chats
                        </a>

                    </div>
                </div>
                <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin | Freelancer
                    </div> -->


            </nav>

        </div>
    </div>
    <!-- end -->

<?php
} else if($_SESSION['type']=="Admin"){
?>


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Admin Dashboard</div>
                        <a class="nav-link" href="../admin/">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">User and Admins</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../admin/ViewUsers.php">Manage Users</a>
                                <!-- <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a> -->
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Categories
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="../admin/catagories.php">
                                    Categories
                                    <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                                </a>

                                <a class="nav-link collapsed" href="../admin/tools.php">
                                    Tools
                                    <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                                </a>
                            
                            </nav>
                        </div>
                        <!-- <div class="sb-sidenav-menu-heading">Freelancers</div>
                        <a class="nav-link" href="../freelancer/projects.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area text-light"></i></div>
                            Projects
                        </a> -->
                      

                    </div>
                </div>
                <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin | Freelancer
                    </div> -->


            </nav>

        </div>
    </div>
<?php
}
else{
    header("location: ../../401.html");
    exit();
}

?>