<?php
include '../connections/conn.php';
session_start();
if (!isset($_SESSION['profile_id'])) {
    header("location:../index.php");
    exit();
}

$email = $_SESSION['profile_id'];
$sql = "SELECT *FROM users where USERID='$email';";
$conn = new Connections();
$result = $conn->connect()->query($sql);
$data = array();
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Hire App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../../css/styles.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../iziToast-master/dist/css/iziToast.css">
    <link rel="stylesheet" href="../iziToast-master/dist/css/iziToast.min.css">
</head>

<body class="" style="background-color: #f4f4f4;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Hire Hero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../Contents/index">Home</a></li>
                  
                    <li class="nav-item"><a class="nav-link logout" href="#!">Logout <i class="fa-solid fa-right-from-bracket mr-1 text-light"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">

            <main>
                <div class="container">




                    <div class="row justify-content-center">

                        <div class="col-lg-5">

                            <div class="card shadow-lg border-0 rounded-lg mt-5 profile-card">
                                <div class="card-body">
                                    <div class="header text-center mb-2">
                                        <h6>Profile</h6>
                                        <hr>
                                    </div>
                                    <?php
                                    foreach ($data as $key => $value) {
                                    ?>

                                        <div class="profile-img text-center">
                                            <img class="img-fluid img" style="cursor:pointer;border-radius: 50%; width: 40%; height:auto;" src="../uploads/<?php echo $value['Photo'] ?>">
                                        </div>

                                        <div class="profile-content text-center mt-3">
                                            <div class="user">
                                                <span><?php echo $value['Username'] ?> | <?php echo $value['AccountType'] ?></span>
                                            </div>
                                            <div class="account-state">
                                                <span>Account State | <span class="text-success"><?php echo $value['AccountStatus'] ?></span></span>
                                            </div>
                                        </div>

                                    <?php

                                    }



                                    ?>


                                </div>

                            </div>
                        </div>

                        <!-- col 5 -->
                        <div class="col-lg-5">
                            <div class="card border-0 rounded-lg mt-5">
                                <div class="card-body">
                                    <div class="main-header">
                                        <p>Manage Your Profile Settings</p>
                                        <hr>
                                    </div>
                                    <?php

                                    foreach ($data as $key => $values) {

                                    ?>
                                        <!-- <form enctype="multipart/form-data" -->
                                        <form enctype="multipart/form-data">
                                            <input type="hidden" class="updateEmail" value="<?php echo $_SESSION['profile_id'] ?>">
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group ">
                                                        <label for="name">FullName</label>
                                                        <input type="text" class="form-control name" value="<?php echo $values['FullName'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="name">Email</label>
                                                        <input type="text" class="form-control email" value="<?php echo $values['Email'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="name">Mobile</label>
                                                        <input type="number" class="form-control mobile" value="<?php echo $values['Mobile'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="name">Profile</label>
                                                        <input type="file" class="form-control profile">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    <?php
                                    }





                                    ?>


                                </div>
                            </div>

                            <!-- 2 -->
                            <div class="card border-0 rounded-lg mt-3">
                                <div class="card-body">
                                    <div class="main-header">
                                        <p>Security Setting Settings</p>
                                        <hr>
                                    </div>
                                    <?php

                                    foreach ($data as $key => $val) {

                                    ?>

                                        <form>
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group ">
                                                        <label for="name">Password</label>
                                                        <input type="password" class="form-control password" disabled value="<?php echo $values['Password'] ?>">
                                                        <p class="text-muted text-primary" style="font-size: 12px; ">For Security Reason You Can't Enable This Field Plz Provide Security Info Below Fields</p>
                                                    </div>

                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <!-- <div class="form-group "> -->
                                                    <!-- <button type="button" class="btn btn-success border-1 bg-transparent text-danger">Change</button> -->
                                                    <!-- </div> -->
                                                    <button type="button" class="btn btn-success border-1 bg-transparent text-success change" data-toggle="modal" data-target=".bd-example-modal-lg">Change</button>

                                                </div>



                                            </div>
                                        </form>

                                    <?php
                                    }


                                    ?>

                                </div>
                            </div>

                            <!-- 3 -->
                            <div class="card border-0 rounded-lg mt-3">
                                <div class="card-body">
                                    <div class="main-header">
                                        <p>Other Settings</p>
                                        <hr>
                                    </div>

                                    <form>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group ">
                                                    <label for="name">
                                                        <input type="checkbox" class="name" checked disabled> Account Status </label>

                                                    <p class="text-muted text-primary" style="font-size: 12px; ">All Users Can See Your Account Status When You're Active</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger  disable bg-transparent border-1 border-danger text-danger">Disable</button>
                                                    <p class="text-danger ml-1 mt-1" style="font-size: 16px;">NOTE: if You Disable Your Account You Can't Enable Again Until the Admin Approves Your request</p>

                                                </div>
                                            </div>


                                        </div>
                                    </form>

                                </div>
                            </div>
                            <button type="button" class="btn btn-success saveChanges bg-success border-1 border-light text-white mt-2">Save Changes</button>

                            <!-- end -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-2">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Hire Hero 2023</div>
                       
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!-- // modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="text-muted text-capitalize">security settings</h6>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Current">Current Password</label>
                        <input type="password" class="form-control current" id="Current">
                    </div>
                    <div class="form-group">
                        <label for="Current">New Password</label>
                        <input type="password" class="form-control new" id="Current">
                    </div>
                    <div class="form-group">

                        <input type="button" class="btn border-2 border-dark  btn-outline-light text-success changePass" value="Change" id="Current">
                        <input type="button" class="btn border-2 border-dark  btn-danger text-light closeModalForm" value="Close" id="Current">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end modal -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../js/scripts.js"></script>


    <script src="../iziToast-master/dist/js/iziToast.js"></script>
    <script src="../iziToast-master/dist/js/iziToast.min.js"></script>
    <script src="../jquery-3.3.1.min.js"></script>
    <!-- <script src="../../node_modules/sweetalert2/src/sweetalert2.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(() => {

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


            const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
            $(".disable").click((e) => {
                

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You Won't Be able to To Login Again Until admin Approved Your Request",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Disable it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Disable();
                        // swalWithBootstrapButtons.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        
                    }
                })
            })


            function Disable(){
                var data = {
                       
                        id: $(".updateEmail").val(),
                        action: "disableAccount"
                    }
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/profile.php",
                        beforeSend: () => {
                            $(".disable").attr("disabled", true);
                        },
                        success: (response) => {
                            console.log(response)
                            $(".disable").attr("disabled", false);
                            if (response.error != '')
                                displayToast(response.error, "error", 3000);
                            else {
                                {
                                     swalWithBootstrapButtons.fire(
                            'Disabled!',
                            'Your Account Has been Disabled You"re No Longer This account.',
                            'success'
                        );
                        setTimeout(() => {
                            window.location="../index.php";
                        }, 3000);
                                }
                            }
                        },
                        error: (response) => {
                            $(".disable").attr("disabled", false);
                            displayToast(response['responseText'], "error", 3000);
                        },
                    })
            }


            $(".closeModalForm").click((e) => {
                $(".modal").modal("hide");
            })
            $(".changePass").click((e) => {
                e.preventDefault();
                if ($(".current").val() == "" || $(".new").val() == "")
                    displayToast("Current Password and New Password Must Provide.....", "error", 3000);


                else {

                    var data = {
                        "oldPass": $(".current").val(),
                        "new": $(".new").val(),
                        id: $(".updateEmail").val(),
                        action: "changePass"
                    }
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/profile.php",
                        beforeSend: () => {
                            $(".changePass").attr("disabled", true);
                        },
                        success: (response) => {
                            console.log(response)
                            $(".changePass").attr("disabled", false);
                            if (response.error != '')
                                displayToast(response.error, "error", 3000);
                            else {
                                displayToast(response.response, "success", 3000);
                            }
                        },
                        error: (response) => {
                            $(".changePass").attr("disabled", false);
                            displayToast(response['responseText'], "error", 3000);
                        },
                    })
                }
            })
            $(".profile").on("change", function(e) {
                var result = URL.createObjectURL(e.target.files[0]);
                console.log(e.target.files[0])
                $(".img").attr("src", result);
            })

            $(".saveChanges").click((e) => {
                e.preventDefault()

                if (

                    $(".name").val() == "" ||
                    $(".email").val() == "" ||
                    $(".mobile").val() == ""

                )
                    displayToast("All Fields Can't be Empty ", "error", 3000);
                else {
                    if ($(".profile").val() == "") {
                        var data = {
                            "email": $(".email").val(),
                            "name": $(".name").val(),
                            "mobile": $(".mobile").val(),
                            "user": $(".updateEmail").val(),
                            "available": "No",
                            action: "updateProfile"
                        }
                        $.ajax({
                            method: "POST",
                            dataType: "JSON",
                            data: data,
                            url: "../api/profile.php",
                            beforeSend: () => {
                                $(".saveChanges").attr("disabled", true);
                            },
                            success: (response) => {
                                console.log(response)
                                $(".saveChanges").attr("disabled", false);
                                if (response.error != '')
                                    displayToast(response.error, "error", 3000);
                                else {
                                    displayToast(response.response, "success", 3000);
                                }
                            },
                            error: () => {
                                $(".saveChanges").attr("disabled", false);
                                displayToast(response['responseText'], "error", 3000);
                            },
                        })
                    } else {
                        console.log($(".updateEmail").val())
                        var formData = new FormData();
                        formData.append("name", $(".name").val())
                        formData.append("email", $(".email").val())
                        formData.append("mobile", $(".mobile").val())
                        formData.append("available", "Yes")
                        formData.append("action", "updateProfile")
                        formData.append("img", $(".profile")[0].files[0])
                        formData.append("user", $(".updateEmail").val())

                        $.ajax({
                            method: "POST",
                            dataType: "JSON",
                            data: formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            url: "../api/profile.php",
                            beforeSend: () => {
                                $(".saveChanges").attr("disabled", true);
                            },
                            success: (response) => {
                                console.log(response)
                                $(".saveChanges").attr("disabled", false);
                                if (response.error != '')
                                    displayToast(response.error, "error", 3000);
                                else {
                                    displayToast(response.response, "success", 3000);
                                }
                            },
                            error: () => {
                                $(".saveChanges").attr("disabled", false);
                                displayToast(response['responseText'], "error", 3000);
                            },
                        })


                    }
                }
            })




            $(".login").click((e) => {
                e.preventDefault();
                if ($(".email").val() == "" || $(".password").val() == "")
                    displayToast("Email And Password is Required....", "error", 3000);
                else {
                    var data = {
                        "email": $(".email").val(),
                        "password": $(".password").val(),
                        action: "findUser"
                    }
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "./api/signup.php",
                        beforeSend: () => {
                            $(".login").attr("disabled", true);
                        },
                        success: (response) => {
                            console.log(response)
                            $(".login").attr("disabled", false);
                            if (response.error != '')
                                displayToast(response.error, "error", 3000);
                            else {
                                if (response.userType == "Employer Profile")
                                    window.location = "./Contents/"
                                else {

                                }
                            }
                        },
                        error: () => {
                            $(".login").attr("disabled", false);
                            displayToast(response['responseText'], "error", 3000);
                        },
                    })
                }
            })
        })


        function CheckEmail(email) {
            // var regx= 
            return "test@gmail.com".match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        }

        function displayToast(message, type, timeout) {
            if (type == "error") {
                iziToast.error({
                    title: 'Error Encountered! ',
                    message: message,
                    backgroundColor: "#D83A56",
                    titleColor: "white",
                    messageColor: "white",
                    position: "topRight",
                    timeout: timeout
                });
            } else if (type == "success") {
                iziToast.success({

                    message: message,
                    backgroundColor: "#54B435",
                    titleColor: "white",
                    messageColor: "white",
                    position: "topRight",
                    timeout: timeout
                });
            } else if (type == "ask") {
                iziToast.question({
                    timeout: timeout,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: "Condirm!",
                    message: message,
                    position: 'topRight',
                    titleColor: "#86E5FF",
                    messageColor: "white",
                    backgroundColor: "#0081C9",
                    iconColor: "white",
                    buttons: [
                        ['<button style="background: #DC3535; color: white;"><b>YES</b></button>', function(instance, toast) {
                            alert("Ok Deleted...");
                            instance.hide({
                                transitionOut: 'fadeOut'
                            }, toast, 'button');

                        }, true],
                        ['<button style="background: #ECECEC; color: #2b2b2b;">NO</button>', function(instance, toast) {
                            alert("Retuned");
                            instance.hide({
                                transitionOut: 'fadeOut'
                            }, toast, 'button');

                        }],
                    ],
                    onClosing: function(instance, toast, closedBy) {
                        //  console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function(instance, toast, closedBy) {
                        // console.info('Closed | closedBy: ' + closedBy);
                    }
                });
            }
        }
        // end
    </script>
</body>


</html>