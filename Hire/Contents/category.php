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

$id = $_GET['cid'];
$sql = "CALL readFreelancers('$id');";
$conn = new Connections();
$result = $conn->connect()->query($sql);
$data = array();
$tools = array();
if ($result) {
    while ($rows = $result->fetch_assoc()) {
        $data[] = $rows;
    }
} else
    print_r($conn->connect()->error)
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hire Me | Hire</title>
    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* main menu */
        .profile-image img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 6px;
            margin-top: 10px;
        }

        .freelancers-card-container .profile-image .user-description {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .user-description span {
            font-size: 14px;
            font-weight: bold;
            opacity: 0.7;
        }

        .user-description h6 {
            font-size: 19px;
            font-family: sans-serif;
            font-weight: bold;
        }

        .freelancer-description {
            margin-bottom: 10px;
        }

        .freelancer-description p {
            font-size: 17px;
            text-align: center;
            margin: 0px 20px;
            font-family: sans-serif;
            font-weight: normal;
            opacity: 0.8;
        }

        .freelancers-card-container {
            background-color: white;
            box-shadow: 0px -1px 34px -6px rgba(0, 0, 0, 0.53);
            -webkit-box-shadow: 0px -1px 34px -6px rgba(0, 0, 0, 0.53);
            -moz-box-shadow: 0px -1px 34px -6px rgba(0, 0, 0, 0.53);
            /* padding: 10px; */
            max-width: 390px;
            min-height: 320px;
            text-align: center;
            border-radius: 10px;
        }

        .buttons-container button {
            width: 150px;
            padding: 14px;
            background-color: rgb(29, 29, 69);
            border-radius: 8px;
            color: white;
            font-weight: bold;
            outline: none;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .skills-main-container {
            background-color: rgb(29, 29, 69);
            text-align: left;
            color: white;
            border-radius: 4px;
        }

        .inner-conatiner {
            padding: 9px;
        }

        .title-skills {
            margin: 9px 0px;
        }

        .title-skills hr {
            opacity: 0.5;
            margin-top: 9px;
        }

        .all-skills {
            margin: 20px 0px;
        }

        .all-skills ul li {
            /* display: inline; */
            list-style: none;
            /* margin-right: 8px; */
            margin: 0 7px 7px 0;
            display: inline-block;
            flex-direction: row;

            border: 1px solid whitesmoke;
            padding: 7px 6px;

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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="./">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./dashboard">Hired Freelancers</a></li>

                    <li class="nav-item"><a class="nav-link" href="../chat/">Chats</a></li>
                    <li class="nav-item"><a class="nav-link" href="./shopping/shop">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Profile/profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link logout" href="#!">Logout <i class="fa-solid fa-right-from-bracket mr-1 text-light"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-6 fw-bolder text-white mb-2">Hire Most Talented</h1>
                        <!-- <h1 class="display-3 fw-bolder text-white mb-2"><?php echo $_GET['cid'] ?>'s</h1> -->
                        <p class="lead text-white-50 mb-4">Hire Experienced <?php echo $_GET['cid'] ?>'s</p>
                        <!-- <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Watch Video</a>

                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="container px-5 my-5">


            <!-- custom card -->

            <div class="row gx-5">

                <?php
                $name = "";
                $test = false;

                foreach ($data as $key => $value) {
                    if ($value['USERID'] != null) {
                ?>
                        <div class="col-lg-4 mb-5 mb-lg-4">
                            <div class="freelancers-card-container">
                                <div class="profile-image">
                                    <img src="../uploads/<?php echo $value['Photo'] ?>" alt="">
                                    <div class="user-description">
                                        <h6><?php echo $value['FullName'] ?></h6>
                                        <span><?php

                                                echo $value['Category'] ?></span>
                                    </div>
                                </div>
                                <div class="freelancer-description">
                                    <p><?php echo substr($value['Description'], 0, 117) ?>.</p>
                                </div>
                                <div class="buttons-container">
                                    <button class="view-more text-decoration-none rounded-1">
                                        <a class='text-decoration-none text-white' href="./freelancer?freelancerCode=<?php echo $value['USERID'] ?>">View More</a>
                                    </button>
                                    <!-- <button class="view-more">View More</button> -->
                                </div>

                                <div class="skills-main-container">
                                    <div class="inner-conatiner">
                                        <div class="title-skills">
                                            <span>Skills</span>
                                            <hr>
                                        </div>

                                        <div class="all-skills">
                                            <ul>
                                                <?php
                                                $sql_2 = "SELECT tools.tool
                                            FROM tools
                                            LEFT JOIN experiencefreelancers
                                            ON experiencefreelancers.toolID=tools.ID
                                            WHERE experiencefreelancers.freelancerID='" . $value['USERID'] . "' LIMIT 3;";
                                                $result_2 = $conn->connect()->query($sql_2);
                                                while ($row = $result_2->fetch_assoc()) {
                                                ?>

                                                    <li><?php echo $row['tool'] ?></li>


                                                    <!-- <div class="col-lg-4">
                                        <label for="" class="bg-success p-1 text-light" style="border-radius: 9px;font-size: 11px"><?php echo $row['tool'] ?></label>

                                    </div> -->
                                                <?php

                                                }

                                                ?>



                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!--- col-1 closed-->
                <?php
                    }
                }
                ?>


            </div> <!--- card closed-->






            <!--  end custom card -->


















        </div>
    </section>







    <section class="bg-light py-5 border-bottom">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <div class="header-line">
                        <!-- <h2 class="fw-bolder fs-1">Buy a Project</h2> -->
                        <!-- <span class="text-muted">Buy Project For Your School Or University With RFL</span> -->
                    </div>
                    <div class="body-line ">
                        <div class="jumbotron">
                            <h1 class="display-4 fw-bold text-muted">Buy a Project</h1>
                            <p class="lead">Work with the largest network of independent professionals and get things done—from quick turnarounds to big transformations..</p>
                            <hr class="my-4">
                            <a href="./shopping/shop" class="btn btn-success border-2 fw-bold"> <i class="fa-solid fa-arrow-up-right-from-square mx-2"></i>Explore Now</a>

                        </div>
                    </div>
                    <div class="Body">
                        <!-- <button class="btn btn-success border-2 fw-bold"> <i class="fa-solid fa-arrow-up-right-from-square mx-2"></i>Buy Now</button> -->
                    </div>

                </div>
                <div class="col-lg-6 col-xl-7">
                    <img class="w-100 rounded-2" src="../images/work.jpg">
                </div>
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




    <div class="modal  fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content bg-dark">
                <!-- <div class="modal-header">
                    <h6 class="text-muted text-capitalize">security settings</h6>
                </div> -->
                <div class="modal-body ">
                    <video id="my-video" class="video-js" controls preload="auto" loop="true" width="750" height="400" data-setup="{}">
                        <source src="../video.mp4" type="video/mp4" />
                        <!-- <source src="MY_VIDEO.webm" type="video/webm" /> -->
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
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

    <script>
        $(document).ready((e) => {
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