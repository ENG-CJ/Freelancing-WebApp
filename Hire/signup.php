<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin</title>
    <link href="../css/styles.css" rel="stylesheet" />


    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="./css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="./iziToast-master/dist/css/iziToast.css">
    <link rel="stylesheet" href="./iziToast-master/dist/css/iziToast.min.css">
</head>

<body style="background-color: #f4f4f4;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card mb-3 shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Your Free Account</h3>

                                </div>
                                <div class="card-body">

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control name" id="inputFirstName" type="text" placeholder="Enter your first name" />
                                                    <label for="inputFirstName">Full Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control username" id="inputLastName" type="text" placeholder="Enter your last name" />
                                                    <label for="inputLastName">username</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control email" id="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control password" id="inputPassword" type="password" placeholder="Create a password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control confirm" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='form-group mb-3'>
                                            <label for="inputPasswordConfirm" class='mb-2'>Mobile Number</label>
                                            <input class="form-control mobile" id="inputPasswordConfirm" type="number" placeholder="61xxxxxx" />


                                        </div>
                                        <div class="form-group">
                                            <select class="form-control account_type">
                                                <option value="">Select Section</option>

                                            </select>
                                        </div>
                                        <div class="employee-profile-description" style="display:none;">

                                            <div class="form-group mt-3">
                                                <select class="form-control section-employee">

                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <div class="tools-section" style="display: none;">
                                                    <div class="row freelancer-tools-selection">






                                                    </div>

                                                </div>

                                            </div>

                                            <div class="mt-3">
                                                <h6 class="text-muted">Some Of Your Description</h6>
                                                <textarea class="form-control description" placeholder="This Description Will Appear In Front Of Your Profile" rows="8"></textarea>
                                            </div>




                                            <div class="form-group mt-3">
                                                <label for="" class="mb-2">Social Media Links <span class="text-danger">*</span></label>
                                                <input type="url" name="" class='form-control mb-2 facebook' id="" placeholder="https://www.facebook.com/example">
                                                <input type="url" name="" class='form-control mb-2 github' id="" placeholder="https://www.github.com/example">
                                                <input type="url" name="" class='form-control mb-2 whatsapp' id="" placeholder="https://wapp.username">
                                            </div>

                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="profile" class="mb-2">Profile Pic</label>
                                            <input type="file" id="profile" class="form-control profile">
                                        </div>

                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><a class="btn btn-primary btn-block create" href="#">Create Account</a></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="./">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>

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
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; HireWebApp 2022</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="./jquery-3.3.1.min.js"></script>
    <script src="./iziToast-master/dist/js/iziToast.js"></script>
    <script src="./iziToast-master/dist/js/iziToast.min.js"></script>

    <script>
        $(document).ready(() => {
            var array = [];
            loadAccountTypes();
            loadCate();

            function loadAccountTypes() {
                var data = {
                    action: "loadAccountTypes",
                };

                $.ajax({


                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "./api/signup.php",
                    success: (response) => {
                        console.log(response)
                        let data = response.map((v) => v.Data);

                        data.forEach((value) => {
                            console.log(value)
                            $(".account_type").append(`
               
               <option value="${value}">${value}</option>
               
               `)
                        })
                    },
                    error: (response) => {

                    }
                })
            }

            function loadCate() {
                var data = {
                    action: "loadCate",
                };

                $.ajax({


                    method: "POST",
                    // dataType: "JSON",
                    data: data,
                    url: "./api/tools.php",
                    success: (response) => {
                        $(".section-employee").html(response);
                    },
                    error: (response) => {}
                })
            }
            $(".account_type").change((e) => {
                if ($(".account_type").val() == "freelancer Profile")
                    $(".employee-profile-description").css({
                        display: "block"
                    })
                else
                    $(".employee-profile-description").css({
                        display: "none"
                    })
            })




            $(".section-employee").change((e) => {
                // alert($(".section-employee").html())
                if ($(".section-employee").val() == "") {
                    $(".tools-section").css({
                        display: "none"
                    })

                } else {
                    $(".tools-section").css({
                        display: "block"
                    })

                    var data = {
                        action: "loadToolsFromCategories",
                        id: $(".section-employee").val()
                    };

                    $.ajax({


                        method: "POST",
                        // dataType: "JSON",
                        data: data,
                        url: "./api/tools.php",
                        success: (response) => {

                            $(".freelancer-tools-selection").html("");
                            $(".freelancer-tools-selection").html(response);
                        },
                        error: (response) => {}
                    })
                }
            })

            $(document).on("change", 'input[name=tools]', function(e) {
                // var array=[];
                array = [];
                $('input[name=tools]:checked').each(function() {
                    array.push($(this).val())
                })
                console.log((array))
            })



            function CheckEmailExistence(display) {
                $.ajax({
                    method: "POST",
                    url: "./api/users.php",

                    dataType: "JSON",
                    data: {
                        email: $(".email").val(),
                        action: "CheckEmailExistence",

                    },

                    success: (res) => {
                        display(res);
                    },
                    error: (res) => {
                        console.log(res);
                    },
                });
            }

            function CheckUserExistence(display) {
                $.ajax({
                    method: "POST",
                    url: "./api/users.php",

                    dataType: "JSON",
                    data: {
                        username: $(".username").val(),
                        action: "CheckUserExistence",

                    },

                    success: (res) => {
                        display(res);
                    },
                    error: (res) => {
                        console.log(res);
                    },
                });
            }


            function RegisterEmployer() {
                if ($(".profile").val() == "") {

                    var data = {
                        name: $(".name").val(),
                        username: $(".username").val(),
                        email: $(".email").val(),
                        password: $(".password").val(),
                        mobile: $(".mobile").val(),
                        type: $(".account_type").val(),
                        imageAvailable: "No",
                        action: "Register"
                    }
                    $.ajax({


                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "./api/signup.php",
                        success: (response) => {
                            displayToast(response.response, "success", 2000);
                            setTimeout(() => {
                                window.location = "./index.php"
                            }, 2000)

                        },
                        error: (response) => {
                            displayToast(response['responseText'], "success", 4000);
                        }
                    })
                } else {


                    var image = $(".profile")[0].files[0];
                    var extension = image['name'].split(".")[1];
                    if (extension.toLowerCase() != "jpg" && extension.toLowerCase() != "png" && extension.toLowerCase() != "jpeg") {
                        displayToast("Invalid Profile Format, Allowed Only JPEG, PNG and JPEG Files", "error", 2000);
                        return;
                    }
                    var formData = new FormData();
                    formData.append("name", $(".name").val());
                    formData.append("username", $(".username").val());
                    formData.append("email", $(".email").val());
                    formData.append("password", $(".password").val());
                    formData.append("mobile", $(".mobile").val());
                    formData.append("type", $(".account_type").val());
                    formData.append("imageAvailable", "Yes");
                    formData.append("action", "Register");

                    formData.append("profile", $(".profile")[0].files[0]);


                    $.ajax({


                        method: "POST",
                        dataType: "JSON",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,

                        url: "./api/signup.php",
                        success: (response) => {
                            displayToast(response.response, "success", 3000);
                            setTimeout(() => {
                                window.location = "./index.php"
                            }, 3000)

                        },
                        error: (response) => {
                            displayToast(response['responseText'], "success", 4000);
                        }
                    })

                }
            }


            $(".create").click((e) => {
                e.preventDefault();
                if ($(".name").val() == "" || $(".username").val() == "" || $(".email").val() == "" ||
                    $(".password").val() == "" || $(".mobile").val() == "" || $(".account_type").val() == "" ||
                    $(".confirm").val() == "") {
                    displayToast("All Information Must Provide..", "error", 2000);
                    return;
                }

                if (
                    $(".confirm").val() != $(".password").val()) {
                    displayToast("Confirm Password Must Match The Password", "error", 2000);
                    return;
                }

                if ($(".account_type").val() == "Employer Profile") {
                    // validate empty fields
                    CheckEmailExistence((response) => {
                        if (response.error) {
                            displayToast(response.error, "error", 2000);
                            return;
                        }
                        if (response.valid) {
                            displayToast(response.response, "error", 2000);

                        } else {

                            CheckUserExistence((response) => {

                                if (response.valid)
                                    displayToast(response.response, "error", 2000);
                                else {
                                    RegisterEmployer();
                                }




                            })

                        }
                    })


                } else if ($(".account_type").val() == "freelancer Profile") {

                    CheckEmailExistence((response) => {
                        if (response.error) {
                            displayToast(response.error, "error", 2000);
                            return;
                        }
                        if (response.valid) {
                            displayToast(response.response, "error", 2000);

                        } else {

                            CheckUserExistence((response) => {

                                if (response.valid)
                                    displayToast(response.response, "error", 2000);
                                else {
                                    // RegisterEmployer();
                                    if ($('.description').val() == "")
                                    displayToast("Describe Your Profile To Get And Enhanced Your Profile","error",2000);
                                    else if ($('.facebook').val() == "")
                                    displayToast("Provide Facebook Link to Enhance And engage to Your Client","error",2000);
                                    else if ($('.github').val() == "")
                                        displayToast("Provide github Link to Enhance And engage to Your Client","error",2000);
                                    else if ($('.whatsapp').val() == "")
                                        displayToast("Provide whatsapp Link to Enhance And engage to Your Client","error",2000);
                                    else if ($('.section-employee').val() == "")
                                        displayToast("Select Your Position Or The Profession","error",2000);
                                    else if (array.length == 0)
                                        displayToast("Select One Or More Skill For Your Profile","error",2000);
                                    else {
                                        RegisterFreelancer();
                                    }
                                }




                            })

                        }
                    })



                }

            })



            function RegisterFreelancer() {
                if ($(".profile").val() == "") {
                    var data = {
                        name: $(".name").val(),
                        username: $(".username").val(),
                        email: $(".email").val(),
                        password: $(".password").val(),
                        mobile: $(".mobile").val(),
                        type: $(".account_type").val(),
                        imageAvailable: "No",
                        action: "Register",
                        description: $(".description").val(),

                        categoryID: $(".section-employee").val(),
                        "Tools": array,
                        whatsapp: $(".whatsapp").val(),
                        github: $(".github").val(),
                        facebook: $(".facebook").val(),
                    }
                    $.ajax({


                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "./api/signup.php",
                        success: (response) => {
                            if (response.error != "")
                                displayToast(response.error, "error", 4000);
                            else {
                                displayToast(response.response, "success", 3000);
                                setTimeout(() => {
                                    window.location = "./index.php"
                                }, 3000)
                            }

                        },
                        error: (response) => {
                            displayToast(response['responseText'], "success", 4000);
                        }
                    })
                } else {

                    var image = $(".profile")[0].files[0];
                    var extension = image['name'].split(".")[1];
                    if (extension.toLowerCase() != "jpg" && extension.toLowerCase() != "png" && extension.toLowerCase() != "jpeg") {
                        displayToast("Invalid Profile Format, Allowed Only JPEG, PNG and JPEG Files", "error", 2000);
                        return;
                    }
                    var formData = new FormData();
                    formData.append("name", $(".name").val());
                    formData.append("username", $(".username").val());
                    formData.append("email", $(".email").val());
                    formData.append("description", $(".description").val());
                    formData.append("password", $(".password").val());
                    formData.append("mobile", $(".mobile").val());
                    formData.append("type", $(".account_type").val());
                    formData.append("imageAvailable", "Yes");
                    formData.append("whatsapp", $(".whatsapp").val());
                    formData.append("github", $(".github").val());
                    formData.append("facebook",  $(".facebook").val());
                    formData.append("Tools",  array);
                    formData.append("categoryID",  $(".section-employee").val());
                      
                      
                    formData.append("action", "Register");

                    formData.append("profile", $(".profile")[0].files[0]);


                    $.ajax({


                        method: "POST",
                        dataType: "JSON",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,

                        url: "./api/signup.php",
                        success: (response) => {
                            console.log(response)
                            displayToast(response.response, "success", 3000);
                            setTimeout(() => {
                                window.location = "./index.php"
                            }, 3000)

                        },
                        error: (response) => {
                            displayToast(response['responseText'], "error", 4000);
                        }
                    })
                }
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
        })
    </script>
</body>

</html>