<?php
include '../connections/conn.php';
include "../AccessPoint/Access.php";
include "../paymentGateway/config.php";
session_start();
if (!isset($_SESSION['profile_id'])) {
    header("location:../index.php");
    exit();
}

if (!AccessAuth::Auth($_SESSION['type'], "Employer Profile")) {
    header("location: ../index.php");
    exit();
}

$code = $_GET['freelancerCode'];
$sql_2 = "SELECT *FROM users LEFT JOIN categories on users.USERID=categories.ID where USERID='$code';";
$sql_3 = "SELECT categories.Category FROM categories LEFT JOIN experiencefreelancers on categories.ID=experiencefreelancers.category
where experiencefreelancers.freelancerID='$code' LIMIT 1;";
$conn = new Connections();
$result_2 = $conn->connect()->query($sql_2);
$result_3 = $conn->connect()->query($sql_3);
$row = $result_3->fetch_assoc();
$data = array();
if ($result_2) {
    while ($rows = $result_2->fetch_assoc()) {
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
    <title>Hire Hero App</title>
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
            <a class="navbar-brand" href="#!">Hire Hero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./dashboard">Hired Freelancers</a></li>
                    <li class="nav-item"><a class="nav-link" href="../chat/">Chats</a></li>
                    <li class="nav-item"><a class="nav-link" href="./shopping/shop.php">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Profile/profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link logout" href="#!">Logout <i class="fa-solid fa-right-from-bracket mr-1 text-light"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->

    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">

        <div class="container px-5 my-5">

            <div class="row gx-5">
                <?php

                foreach ($data as $key => $value) {
                ?>
                    <!-- col-1 -->
                    <div class="col-lg-7 col-md-12 mt-3">
                        <div class="card shadow rounded-2 border-0 p-3">
                            <h5 class='fs-3 fw-bolder'>DESCRIPTION</h5>
                            <p class='mt-2 text-muted'> <?php echo $value['Description'] ?> </p>


                            <div class="my-5">

                                <div class="row no-gutters">
                                    <?php
                                    $sql_3 = "SELECT *
                                FROM projects
                                WHERE Owner='" . $value['USERID'] . "' AND ProjectType='Normal';";
                                    $result_3 = $conn->connect()->query($sql_3);

                                    if (mysqli_num_rows($result_3) > 0) {

                                    ?>

                                        <h5 class='fs-5 fw-bolder text-muted ml-5'>Projects I've Already Done!</h5>
                                        <?php
                                        foreach ($result_3 as $key => $project) {
                                        ?>

                                            <div class="col-lg-6 col-md-12 my-2">
                                                <div class="card border-success">
                                                    <div class="card-body">
                                                        <img src="../posters/<?php echo $project['Poster'] ?>" class=" img-fluid rounded-2">
                                                        <div class="mt-3">
                                                            <span class="lead fw-bold"><?php echo $project['ProjectName'] ?></span>
                                                            <p><?php echo $project['Description'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>


                                </div>



                            </div>
                            <div class="my-3">
                                <div class="row no-gutters">
                                    <?php
                                    $sql_3 = "SELECT *
                                FROM projects
                                WHERE Owner='" . $value['USERID'] . "' AND ProjectType='Priced';";
                                    $result_3 = $conn->connect()->query($sql_3);

                                    if (mysqli_num_rows($result_3) > 0) {

                                    ?>

                                        <h5 class='fs-5 fw-bolder text-muted ml-5'>Priced Project</h5>
                                        <?php
                                        foreach ($result_3 as $key => $project) {
                                        ?>

                                            <div class="col-lg-6 col-md-12 my-2">
                                                <div class="card border-success">
                                                    <div class="card-body">
                                                        <img src="../posters/<?php echo $project['Poster'] ?>" style="height: 200px; width: 100%" class="rounded-2">
                                                        <div class="mt-3">
                                                            <span class="fw-bold project_name"><?php echo $project['ProjectName'] ?></span>
                                                            <p id="description"><?php echo $project['Description'] ?></p>
                                                        </div>
                                                        <a projectPrice="<?php echo $project['ProjectPrice'] ?>" more="<?php echo $project['MoreDescription'] ?>" projectID="<?php echo $project['ID'] ?>" ProjectName="<?php echo $project['ProjectName'] ?>" href="#<?php echo $project['ID'] ?>" class="btn btn-success border-2 fw-bold buy"><i class="fa-solid fa-angle-right mx-1"></i>Buy Now</a>
                                                        <a href="#<?php echo $project['ID'] ?>" projectID="<?php echo $project['ID'] ?>" class="btn btn-outline-success border-2 fw-bold view"><i class="fa-regular fa-eye mx-1"></i>View</a>

                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>


                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- enc col-1 data -->

                    <div class="col-lg-5 col-md-12">

                        <div class="container-y freelancer-container">
                            <?php
                            if ($value['Photo'] == "default.jpg") {
                            ?>
                                <img class="round" src="../images/<?php echo $value['Photo'] ?>" />



                            <?php
                            } else {
                            ?>
                                <img class="round" src="../uploads/<?php echo $value['Photo'] ?>" />


                            <?php
                            }

                            ?>
                            <h4> <?php echo $value['FullName'] ?> </h4>
                            <h5 style="font-size: 16px"> <?php

                                                            echo $row['Category'] ?> </h5>
                            <?php

                            if ($value['loggedStatus'] == "Online") {
                            ?>
                                <p class="fw-bold">Active Status: <i class="fa-solid fa-signal mr-1 text-success" style="margin-right: 6px"></i>Online</p>


                            <?php
                            } else  if ($value['loggedStatus'] == "Offline") {
                            ?>
                                <p class="fw-bold">Active Status: <i class="fa-solid fa-signal mr-1 text-danger" style="margin-right: 6px"></i>Offline</p>


                            <?php
                            } else if ($value['loggedStatus'] == "") {
                            ?>
                                <p class="fw-bold">Active Status: <i class="fa-solid fa-signal mr-1 text-danger" style="margin-right: 6px"></i>Offline</p>

                            <?php
                            }

                            ?>
                            <!-- <p>Active Status: <i class="fa-solid fa-signal"></i></p> -->
                            <div class="buttons">
                                <button freelancerName="<?php echo $value['FullName'] ?>" freelancerID="<?php echo $value['USERID'] ?>" class="main-btn hire">
                                    <i class="fa-solid fa-arrow-right" style="margin-right: 5px;"></i>Hire
                                </button>
                                <!-- <button class="main-btn secondary">
                                    Following
                                </button> -->
                            </div>

                            <div class="skills">
                                <h5>Skills</h5>
                                <hr>
                                <div class="languages">
                                    <ul>
                                        <?php
                                        $sql_2 = "SELECT tools.tool
                                        FROM tools
                                        LEFT JOIN experiencefreelancers
                                        ON experiencefreelancers.toolID=tools.ID
                                        WHERE experiencefreelancers.freelancerID='" . $value['USERID'] . "';";
                                        $result_2 = $conn->connect()->query($sql_2);
                                        while ($rows = $result_2->fetch_assoc()) {
                                        ?>
                                            <li><?php echo $rows['tool'] ?></li>
                                            <!-- <p class="bg-success p-2 fw-bolder rounded text-light">
                                                <i class="fa-brands fa-creative-commons-remix mx-2 text-light"></i><?php echo $rows['tool'] ?>
                                            </p> -->

                                        <?php
                                        }


                                        ?>


                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>


                    <input type="hidden" class="freelancerName" value="<?php echo $value['FullName'] ?>" />
                    <input type="hidden" class="freelancerID" value="<?php echo $value['USERID'] ?>" />
                    <input type="hidden" class="clientID" value="<?php echo $_SESSION['profile_id']; ?>" />
                    <input type="hidden" class="receiverEmail" value="<?php echo $value['Email']; ?>" />
                <?php
                }


                ?>




            </div>
        </div>
    </section>











    <!-- Pricing section-->


    <!-- Contact section-->

    <footer class="py-5 bg-dark">
        <div class="container px-5">
            <p class="m-0 text-center text-white">Copyright &copy; HIRE HERO APP 2023</p>
        </div>
    </footer>


    <div class="modal fade detailsModal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Project Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body body-modal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



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

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="../jquery-3.3.1.min.js"></script>
    <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
    <script src="https://js.stripe.com/v3/" difer></script>

    <script>
        $(document).ready((e) => {

            $(".buy").click(function() {
                var price = ($(this).attr('projectPrice'))
                var id = ($(this).attr('projectID'));
                var more = ($(this).attr('more'));
                var name = ($(this).attr('ProjectName'));
                // var name = $(".project_name").text();
                var description = $("#description").text();
                var stripe = Stripe("<?php echo $publishableKey ?>");

                var data = {
                    projectID: id,
                    project_name: name,
                    description: more,
                    amount: price,
                    "buy": "buy"
                }
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "../paymentGateway/process.php",

                    success: (response) => {
                        // console.log(response);
                        stripe.redirectToCheckout({
                            sessionId: response.id
                        })

                    },
                    error: (response) => {
                        console.log(response);

                    }
                })

            })






            $('.close').click(() => {
                $(".detailsModal").modal("hide");
            })

            function getProjectValue(id, display) {
                var data = {
                    id: id,
                    action: "getProject"
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

            $('.view').click(function() {

                // alert($(this).attr("projectID"));
                getProjectValue($(this).attr("projectID"), (response) => {
                    console.log(response);
                    $(".body-modal").html(
                        `
                        <video controls  src="../videos/${response.response.demoVideo}" class="w-100"></video>
                        <span>Current Price: <strong>$${response.response.price}</strong></span><br/>
                        <span>Old Price: <strong class="text-danger"><strike>$${response.response.fromPrice}</strike></strong></span>
                        _______________________________________________________
                      
                        <span class="fw-bold">${response.response.name}</span>
                        <p>${response.response.moreDescription}</p>
                        `
                    )
                    $(".detailsModal").modal("show")
                })
            })


            $(document).on("click", ".hire", function() {
                $(".body-active").html(`
                <p>You're Hiring <strong>${$(".freelancerName").val()}</strong>  For Some Projects, Now You Can Contact This Person Directly, Using Current Communication Channels
                        <strong>Do You Want to Continue?</strong>
                    </p>
                    <button class="btn btn-success text-light fw-bolder continue">Continue</button>
                
                `).css("color", "black")
                $(".continueModal").modal("show")
            })
            $(document).on("click", ".continue", function() {

                if ($(".continue").html() == "Continue") {
                    var data = {
                        "freelancerID": $(".freelancerID").val(),
                        "clientID": $(".clientID").val(),
                        "receiverEmail": $(".receiverEmail").val(),
                        "fullName": $(".freelancerName").val(),
                        "action": "Hire",
                    }

                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/hire.php",
                        beforeSend: () => {
                            $(".continue").attr("disabled", true);
                            $(".continue").html("Processing...");
                        },
                        success: (response) => {
                            $(".continue").attr("disabled", false);

                            if (response.error != "") {
                                $(".body-active").html(`

                     <div class="alert alert-danger">
                        <strong>${response.error} <a href="./dashboard">Hired Section</a></strong>
                     </div>
                     <button class="btn btn-success text-light fw-bolder continue">Close</button>

                    `)
                            } else {
                                $(".body-active").html(`

<div class="alert alert-success">
   <strong>${response.response}</strong>
</div>
<button class="btn btn-success text-light fw-bolder continue">Close</button>

`)
                                setTimeout(() => {
                                    window.location = "./dashboard";
                                }, 5000);
                            }


                            console.log(response)
                        },
                        error: (response) => {
                            $(".continue").attr("disabled", false);
                            $(".continue").html("Close");
                            $(".body-active").html(`
                    ${response['responseText']}
                    <button class="btn btn-success text-light fw-bolder continue">Close</button>

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