<?php
include '../connections/conn.php';
include "../AccessPoint/Access.php";
session_start();
if (!isset($_SESSION['profile_id'])) {
    header("location:../index.php");
    exit();
}

if (!AccessAuth::Auth($_SESSION['type'], "Employer Profile")) {
    header("location: ../index.php");
    exit();
}

$data = array();
$conn = new Connections();
$client = $_SESSION['profile_id'];
$sql = "SELECT hiredfreelancers.freelancerID , users.USERID,users.FullName,users.facebook,users.whatsapp,users.github,users.Photo
FROM users
LEFT JOIN hiredfreelancers
ON hiredfreelancers.freelancerID=users.USERID
WHERE hiredfreelancers.clientID='$client'";



$result = $conn->connect()->query($sql);
if ($result) {
    while ($rows = $result->fetch_assoc()) {
        $data[] = $rows;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HireApp - Client </title>
    <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="styles.css" rel="stylesheet" />


    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .gig {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
        }
    </style>
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Hire Me 😉</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="./index">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./dashboard">Hired Freelancers</a></li>
                    <li class="nav-item"><a class="nav-link" href="../chat/">Chats</a></li>

                    <li class="nav-item"><a class="nav-link" href="../Profile/profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link logout" href="#!">Logout <i class="fa-solid fa-right-from-bracket mr-1 text-light"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->

    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">


        <div class="container">
            <h6 style="margin: 10px 7px">Hired Freelancers</h6>
            <div class="row">

                <?php
                foreach ($data as $key => $value) {

                ?>

                    <div class="col-lg-4 col-md-12">
                        <div class="main-container mb-2">
                            <div class="card-details">
                                <img src="../uploads/<?php echo $value['Photo'] ?>" alt="">
                                <div class="content-details">
                                    <span class="name"><?php echo $value['FullName'] ?></span>
                                    <?php
                                    $sqlCat = "SELECT categories.Category FROM categories
                           LEFT JOIN experiencefreelancers on categories.ID=experiencefreelancers.category
                           WHERE experiencefreelancers.freelancerID='" . $value['USERID'] . "' LIMIT 1;";
                                    $resultCat = $conn->connect()->query($sqlCat);
                                    $row = $resultCat->fetch_assoc();
                                    ?>
                                    <span class="title text-muted text-secondary"><?php echo $row['Category']; ?></span>
                                    <?php
                                    ?>

                                    <span class="text-muted text-secondary"> ______________________</span>
                                    <span>Channels</span>
                                    <div class="channels">
                                        <a href="<?php echo $value['facebook'] ?>" target="__blank" class="fw-bolder "> <i class="fa-brands fa-facebook fw-bolder fs-4 mx-2 cursor-pointer"></i></a>
                                        <a href="<?php echo $value['whatsapp'] ?>" target="__blank" class="fw-bolder ">
                                            <i class="fa-brands fa-whatsapp fw-bolder fs-4 mx-2"></i></a>
                                        <a href="<?php echo $value['github'] ?>" target="__blank" class="fw-bolder ">
                                            <a href="<?php echo $value['github'] ?>" target="__blank" class="fw-bolder ">
                                                <i class="fa-brands fa-github fw-bolder fs-4 mx-2"></i></a>

                                    </div>
                                    <div class="button">
                                        <a href="../chat/DCChannel.php?freelancer_code=<?php echo $value['USERID'] ?>"><i class="fa-regular fa-comment-dots mr-2" style="margin-right: 6px"></i>Message</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php
                }

                ?>

            </div>

            <div style="margin-top: 10%; margin-left: 7px; margin-right: 7px;" class="">
                <h6 style="margin-top: 30px; margin-left: 7px; margin-right: 7px;">Transactions</h6>
                <hr />
                <div class="table-container">

                </div>
                <button class="btn btn-outline-success print-all-transactions">Print</button>

            </div>

        </div>




        </div>
    </section>












    <div class="modal continueModal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h6 class="text-muted text-capitalize">security settings</h6>
                </div> -->
                <div class="modal-body body-active">

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade transactionsDetails" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" class="session_id" />
                    <h5 class="modal-title" id="exampleModalLabel">Transaction Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body transactionsContainer" id="transactionsContainer">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger closeModal" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success print"><i class="fa-solid fa-print mr-2"></i>Print</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade allTransactionDeatils" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" class="session_id" />
                    <h5 class="modal-title" id="exampleModalLabel">Transaction Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body allTransactionsContainer" id="allTransactionsContainer">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger closeModal" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success print"><i class="fa-solid fa-print mr-2"></i>Print</button>

                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JS-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="../jquery-3.3.1.min.js"></script>
    <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
    <script src="../jquery-3.3.1.min.js"></script>

    <script src="./OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <script src="./printThis.js"></script>

    <script>
        $(document).ready((e) => {
            $(".print-all-transactions").click(() => {
                getTransactions((res) => {
                  $(".allTransactionsContainer").html(res)
                })
                $(".allTransactionsContainer").printThis();
              
            })


            function displayAllTransaction(display) {
                var data = {

                    action: "displayAllTransaction"
                }
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "../api/projects.php",
                    success: (response) => {
                        display(response);
                    },
                    error: (response) => {
                        console.log(response);
                    }
                })
            }











            $(document).on("click", ".print", function() {

                $(".transactionsContainer").printThis();

            })
            $(document).on("click", ".closeModal", function() {

                $(".transactionsDetails").modal("hide");

            })
            $(document).on("click", ".detail", function() {
                // alert("hello")
                getTransactionDetails($(this).attr("paymentID"), (response) => {
                    console.log(response);
                    $('.session_id').val(response.response.session)
                    $(".transactionsContainer").html(`
                    
                    <div class="logo">
                        <img src="http://localhost/HireApp/Hire/Contents/hireHero.png" width="100%"/>
                    </div>
                  

                    <div class="mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Purchased At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">$${response.response.amount}.00</th>
                                    <td>${response.response.Item_details.itemName}</td>
                                    <td>${response.response.PaymentMethod}</td>
                                    <td>${response.response.Date}</td>
                                </tr>
                              
                              
                            </tbody>
                        </table>
                    </div>

                    <div class="other mt-3">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <span><strong class="text-muted">Currency:</strong> ${response.response.currency}</span>
                            </div>
                            <div class="col-lg-6 col-md-12 d-flex flex-column">
                            <span><strong class="text-muted">Payment Status:</strong> <span class="text-success"><i class="fa-sharp fa-solid fa-check"></i> ${response.response.status}</span></span>
                            <span><strong class="text-muted">Total:</strong> $${response.response.amount}</span>
                            </div>
                            <hr/>
                          
                            <div class="col-lg-12 col-md-12 d-flex flex-column mt-3">
                            <span><strong class="text-muted">Customer Name: </strong> ${response.response.customer_details.customer_name}</span>
                            <span><strong class="text-muted">Email: </strong> ${response.response.customer_details.customer_email}</span>
                            <span><strong class="text-muted">Phone: </strong> ${response.response.customer_details.customer_phone}</span>
                            
                            </div>
                        </div>

                        <div class="description-text mt-3">


                            <p class="text-muted">This Transaction is Encoded By @ENG-CJ And Assigned The Email Reference- <strong> ${response.response.client_details.email}</strong> And Client Registered Name- <strong>${response.response.client_details.name}</strong></p>
                        </div>
                    </div>
                    
                    
                    `)
                })
                $(".transactionsDetails").modal("show");
            })

            $(document).on("click", ".copy", function() {
                $('.copy').removeClass("fa-solid fa-clone");
                $('.copy').addClass("fa-solid fa-check-double");
                navigator.clipboard.writeText($('.session_id').val())

                setTimeout(() => {
                    $('.copy').removeClass("fa-solid fa-check-double");
                    $('.copy').addClass("fa-solid fa-clone");
                }, 1000);
            })

            loadTransactions();

            function loadTransactions() {
                $.ajax({
                    method: "POST",
                    data: {
                        action: "loadTransactions"
                    },
                    url: "../api/projects.php",
                    success: (response) => {
                        $(".table-container").html(response);
                        $('#example').DataTable();
                        // console.log(response);
                    },
                    error: (response) => {
                        console.log(response);
                    }
                })
            }

            function getTransactionDetails(id, display) {
                var data = {
                    id: id,
                    action: "getTransactionDetails"
                }
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "../api/projects.php",
                    success: (response) => {
                        display(response);
                    },
                    error: (response) => {
                        console.log(response);
                    }
                })
            }
            function getTransactions(display) {
                var data = {
                    
                    action: "getTransactions"
                }
                $.ajax({
                    method: "POST",
                
                    data: data,
                    url: "../api/projects.php",
                    success: (response) => {
                        display(response);
                    },
                    error: (response) => {
                        console.log(response);
                    }
                })
            }


            $(document).on("click", ".hire", function() {
                $(".body-active").html(`
                <p>You're Hiring <strong>${$(".freelancerName").val()}</strong>  For Some Projects, Now You Can Contact This Person Directly, Using Current Communication Channels
                        <strong>Do You Want to Continue?</strong>
                    </p>
                    <button class="btn btn-success text-light fw-bolder continue">Continue</button>
                
                `)
                $(".continueModal").modal("show")
            })
            $(document).on("click", ".continue", function() {

                if ($(".continue").html() == "Continue") {
                    var data = {
                        "freelancerID": $(".freelancerID").val(),
                        "clientID": $(".clientID").val(),
                        "action": "Hire",
                    }

                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/hre.php",
                        beforeSend: () => {
                            $(".continue").attr("disabled", true);
                            $(".continue").html("Processing...");
                        },
                        success: (response) => {
                            $(".continue").attr("disabled", false);


                            $(".body-active").html(`

                     <div class="alert alert-success">
                        <strong>${response.response}</strong>
                     </div>
                     <button class="btn btn-success text-light fw-bolder continue">Close</button>

                    `)
                            console.log(response)
                        },
                        error: (response) => {
                            $(".continue").attr("disabled", false);
                            $(".continue").html("Continue");
                            $(".body-active").html(`
                    ${response['responseText']}
                    <button class="btn btn-success text-light fw-bolder continue">Continue</button>

                    `).css("color", "red")
                            console.log(response)
                        }
                    })
                } else {
                    $(".continueModal").modal("hide")

                }



            })
            setInterval(() => {
                loadSample();
            }, 1000);

            function loadSample() {
                $.ajax({
                    method: "POST",
                    // dataType: "JSON",
                    url: "../api/tools.php",
                    data: {
                        "action": "loadSample"
                    },
                    success: (response) => {
                        $(".categories").html("");
                        $(".categories").html(response);
                    },
                    error: () => {
                        alert(response['responseText']);

                    },
                })
            }
        })
        $(".logout").click((e) => {
            $.ajax({
                method: "POST",
                dataType: "JSON",
                url: "../api/signup.php",
                data: {
                    "action": "setOffline"
                },
                success: (response) => {
                    if (response.error == "")
                        window.location = "../index.php";
                    else
                        alert(response['error']);
                },
                error: () => {
                    alert(response['responseText']);

                },
            })
        })
    </script>

</body>

</html>