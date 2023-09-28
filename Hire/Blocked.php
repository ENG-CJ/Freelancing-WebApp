<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blocked Page</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <div id="layoutError">
        <div id="layoutError_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 mb-4">
                            <div class="text-center mt-4">
                                <img class="mb-4 img-error img-fluid" src="./images/missing.gif" />
                                <p class="lead">This User request is Blocked From Logging The System Or Disabled. Contact AdminHelper To Fix Your Issue
                                    </a>
                                    <button type="button" class="btn btn-success border-1 bg-transparent text-success change report">Report Issue</button>

                                </p>
                                <a href="./index.php">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Return to Login
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <div class="modal fade bd-example-modal-lg reportModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="text-muted text-capitalize">Report Issue</h6>
                </div>
                <div class="modal-body">
                    <div class="message-area">

                    </div>
                    <div class="form-group">
                        <label for="Current">Profile Username</label>
                        <input type="text" class="form-control username" placeholder="Your Username" id="Current">
                    </div>
                    <div class="form-group">
                        <label for="Current">Email Address</label>
                        <input type="email" class="form-control email" id="Current" placeholder="example@gmail.com [user email]">
                    </div>
                    <div class="form-group">
                        <label for="Current">Issue Description</label>
                        <textarea cols="10" rows="8" class="form-control issue" placeholder="Describe Your Issue, So We Can Fix Your Issue"></textarea>
                    </div>
                    <div class="form-group">

                        <input type="button" class="btn   btn-danger text-light sendEmail" value="Report" id="Current">
                        <input type="button" class="btn     btn-danger text-light close" value="Close" id="Current">
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./jquery-3.3.1.min.js"></script>

    <script src="./iziToast-master/dist/js/iziToast.js"></script>
    <script src="./iziToast-master/dist/js/iziToast.min.js"></script>

    <script>
        $(document).ready((e) => {
            $(".report").click(() => {
                $(".username").val("")
                $(".email").val("")
                $(".issue").val("")
                $(".reportModal").modal("show");
            })
            $(".close").click(() => {
                $(".username").val("")
                $(".email").val("")
                $(".issue").val("")
                $(".reportModal").modal("hide");
            })

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
                            // console.insafo('Closed | closedBy: ' + closedBy);
                        }
                    });
                }
            }
            $(".sendEmail").click((e) => {

                e.preventDefault();
                if ($(".username").val() == "" || $(".email").val() == "" || $(".issue").val() == "") {
                    $(".message-area").html(`
                <div class="alert alert-danger">
                        <strong>Provide Your Issue And Username Currently Connected</strong>
                    </div>
                
                `)

                    setTimeout(() => {
                        $(".message-area").html("");
                    }, 3000);
                } 
                else if($(".issue").val().length <80){
                    $(".message-area").html(`
                <div class="alert alert-danger">
                        <strong>Your issue Must be greater then 200 characters</strong>
                    </div>
                
                `)

                    setTimeout(() => {
                        $(".message-area").html("");
                    }, 3000);
                }
                else {
                    var data = {
                        "send": "send",
                        "email": $(".email").val(),
                        "username": $(".username").val(),
                        "issue": $(".issue").val(),
                    }
                    $.ajax({
                        method: "post",
                        dataType: "json",
                        data: data,
                        url: "./contact_email.php",
                        beforeSend: () => {
                            $(".sendEmail").attr("disabled", true);
                            $(".sendEmail").html("Reporting......");
                        },
                        success: (response) => {
                            console.log(response);
                            $(".sendEmail").attr("disabled", false);
                            $(".sendEmail").html("Report");
                            if (response.error != "") {
                                $(".message-area").html(`
                <div class="alert alert-danger">
                        <strong>${response.error}</strong>
                    </div>
                
                `)
                                setTimeout(() => {
                                    $(".message-area").html("");
                                }, 5000);
                            } else {
                                $(".message-area").html(`
                <div class="alert alert-success">
                        <strong>${response.response}</strong>
                    </div>
                
                `)
                                setTimeout(() => {
                                    $(".message-area").html("");
                                }, 5000);

                            }
                        },
                        error: (response) => {
                            console.log(response['responseText'])
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>