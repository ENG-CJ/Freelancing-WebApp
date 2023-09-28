<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Hire App</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./iziToast-master/dist/css/iziToast.css">
    <link rel="stylesheet" href="./iziToast-master/dist/css/iziToast.min.css">
</head>

<body class="" style="background-color: #f4f4f4;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-floating mb-3">
                                            <input class="form-control email" id="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input showPassword" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Show Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="ForgotPassword.html">Forgot Password?</a>
                                            <a class="btn btn-primary login" href="">Login</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="signup.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>

                        <!-- col 5 -->
                        <div class="col-lg-5">
                            <div class="card border-0 rounded-lg mt-5">
                                <div class="card-body">
                                    <div class="main-header">
                                        <p><span class="fw-bold">SOM HIRE APP</span> Waa app loogu tala-galay in lagu xusho shaqaale iskood u shaqeeysta.
                                            app-kaan wuxuu bixiyaa</p>
                                        <hr>
                                    </div>

                                    <div class="card-service">
                                        <div class="service-1">
                                            <div class="service-img">
                                                <img class="img-fluid" src="./images/webdesign.jpg">
                                            </div>
                                            <div class="label-service">
                                                <label>Web Design Creators</label>
                                                <p class='text-muted'>Hire Web Designers To Meet Beautiful Web</p>
                                            </div>
                                        </div>
                                        <div class="service-1">
                                            <div class="service-img">
                                                <img class="img-fluid" src="./images/mobile-app.jpg">
                                            </div>
                                            <div class="label-service">
                                                <label>Mobile App Developers</label>
                                                <p class='text-muted'>Gain User-Friendly App And Hire Our Developers</p>
                                            </div>
                                        </div>
                                        <div class="service-1">
                                            <div class="service-img">
                                                <img class="img-fluid" src="./images/adobe.jpg">
                                            </div>
                                            <div class="label-service">
                                                <label>Graphic Design Innovators</label>
                                                <p class='text-muted'>Label Your Business Best and Best Brand</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-2">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; HireApp 2022</div>
                       
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../js/scripts.js"></script>

    <script src="./jquery-3.3.1.min.js"></script>
    <script src="./iziToast-master/dist/js/iziToast.js"></script>
    <script src="./iziToast-master/dist/js/iziToast.min.js"></script>

    <script>
        $(document).ready(() => {


            $(".showPassword").on("change", function(e) {
                if ($(".password").attr("type") == "password") {
                    $(".password").attr("type", "text");
                    return;
                }

                $(".password").attr("type", "password");

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
                                if (response.state == "Active") {
                                    if (response.userType == "Employer Profile")
                                        window.location = "./Contents/"
                                    else if (response.userType == "freelancer Profile")
                                        window.location = "./freelancer/"
                                    else if (response.userType == "Admin")
                                        window.location = "./Admin/"
                                    else {
                                        window.location = "../401.html"
                                    }
                                } else
                                    window.location = "./Blocked";

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