<?php include '../config/header.php';
include '../config/sidebar.php';
include '../connections/conn.php';
function getProjects()
{
    
    $conn = new Connections();
    $id = $_SESSION['profile_id'];
    $sql = "SELECT * from projects;";
    $result = $conn->connect()->query($sql);
    $number = 0;
    if ($result)
        $number = mysqli_num_rows($result);

    return $number;
}

function thousandsCurrencyFormat($num) {

    if($num>1000) {
  
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('k', 'm', 'b', 't');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
  
          return $x_display;
  
    }
  
    return $num;
  }
function displayTotalBalance()
{
    $conn = new Connections();
    $id = $_SESSION['profile_id'];
    $sql = "SELECT * FROM `transactions` ;";
    $result = $conn->connect()->query($sql);
    $number = "";
    if ($result) {
       
        $number =mysqli_num_rows($result);
    }

    return $number;
}
function getClients()
{
    $conn = new Connections();
    $id = $_SESSION['profile_id'];
    $sql = "SELECT * FROM `users` where AccountType='Employer Profile';";
    $result = $conn->connect()->query($sql);
    $number = 0;
    if ($result)
        $number = mysqli_num_rows($result);

    return $number;
}
function getUsers()
{
    $conn = new Connections();
    $id = $_SESSION['profile_id'];
    $sql = "SELECT * FROM `users`;";
    $result = $conn->connect()->query($sql);
    $number = 0;
    if ($result)
        $number = mysqli_num_rows($result);

    return $number;
}
function getCategories()
{
    $conn = new Connections();
    $id = $_SESSION['profile_id'];
    $sql = "SELECT * FROM `categories`;";
    $result = $conn->connect()->query($sql);
    $number = 0;
    if ($result)
        $number = mysqli_num_rows($result);

    return $number;
}
function getTools()
{
    $conn = new Connections();
    $id = $_SESSION['profile_id'];
    $sql = "SELECT * FROM `tools`;";
    $result = $conn->connect()->query($sql);
    $number = 0;
    if ($result)
        $number = mysqli_num_rows($result);

    return $number;
}



?>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- <h1 class="mt-4">Admin Dashboard</h1> -->
                <ol class="breadcrumb mb-4">
                    <!-- <li class="breadcrumb-item active">Dashboard For Freelancer</li> -->
                </ol>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-secondary border-2 shadow text-white mb-4">
                            <div class="card-body p-5" style="background: #3C486B;">
                                <div style="display: flex; align-items: center;">
                                    <div> <i class="fa-solid fa-building-shield fs-2"></i>
                                        <span class="fs-2 ml-2"><?php echo getProjects() ?></span>
                                    </div>

                                </div>
                                <p>Available Projects</p>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-secondary border-2 shadow text-white mb-4">
                            <div class="card-body p-5" style="background: #2F0F5D;">
                                <div style="display: flex; align-items: center;">
                                    <div> <i class="fa-solid fa-people-group fs-2"></i>
                                        <span class="fs-2 ml-2"><?php echo getClients() ?></span>
                                    </div>

                                </div>
                                <p>Clients</p>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-white border-2 shadow text-white mb-4">
                            <div class="card-body p-5" style="background: #FC4F00;">
                                <div style="display: flex; align-items: center;">
                                    <div><i class="fa-solid fa-user-group fs-2"></i>
                                        <span class="fs-2 ml-2"><?php echo getUsers() ?></span>
                                    </div>

                                </div>
                                <p> All Users</p>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-secondary border-2 shadow text-white mb-4">
                            <div class="card-body p-5" style="background: #2A2F4F;">
                                <div style="display: flex; align-items: center;">
                                    <div> <i class="fa-solid fa-sliders fs-2"></i>
                                        <span class="fs-2 ml-2"><?php echo getCategories() ?></span>
                                    </div>

                                </div>
                                <p>All Categories</p>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-secondary border-2 shadow text-white mb-4">
                            <div class="card-body p-5" style="background: #89375F;">
                                <div style="display: flex; align-items: center;">
                                    <div> <i class="fa-solid fa-anchor fs-2"></i>
                                        <span class="fs-2 ml-2"><?php echo getTools() ?></span>
                                    </div>

                                </div>
                                <p>All Tools</p>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-secondary border-2 shadow text-white mb-4">
                            <div class="card-body p-5" style="background: #245953;">
                                <div style="display: flex; align-items: center;">
                                    <div> <i class="fa-solid fa-credit-card fs-2"></i>
                                        <span class="fs-2 ml-2"><?php echo thousandsCurrencyFormat(displayTotalBalance()) ?></span>
                                    </div>

                                </div>
                                <p>All Transactions</p>

                            </div>

                        </div>
                    </div>
                    <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Outgoing Projects</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div> -->
                </div>
                <div class="row">
                    <div class="col-xl-7">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                View Profiles (limit)
                            </div>
                            <div class="card-body">
                                <div class="clientsTable">

                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                View Projects (limit)
                            </div>
                            <div class="card-body">
                                <div class="users">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; HireHero 2023</div>
                  
                </div>
            </div>
        </footer>
    </div>
</div>

<?php include '../config/footer.php' ?>
<script src="../jquery-3.3.1.min.js"></script>
<script>
    loadClients();
    loadProjects();

    function loadClients() {
        $.ajax({
            method: "POST",
            data: {
                "action": "loadClientsDashboard"
            },
            url: "../api/client.php",
            success: (res) => {
                $(".clientsTable").html("");
                $(".clientsTable").html(res);
            },
            error: (res) => {
                console.log(res)
            }
        })
    }

    function loadProjects() {
        $.ajax({
            method: "POST",
            data: {
                "action": "loadProjectsDashboard"
            },
            url: "../api/projects.php",
            success: (res) => {
                $(".users").html("");
                $(".users").html(res);
            },
            error: (res) => {
                console.log(res)
            }
        })
    }
</script>