<?php include '../config/header.php';
include '../config/sidebar.php'; ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- <h1 class="mt-4">Users</h1> -->
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active ">All Users</li>
                </ol>
                <div class="container">

                    <div class="row">
                        <div class="col-lg-9 ">
                            <label class="bg-success text-light p-4 w-25 rounded-3 online">
                                25 Online Users
                            </label>
                            <label class="bg-success text-light p-4 w-25 rounded-3 offline">80 Offline Users</label>
                        </div>
                        <div class="col-lg-3">
                            <button type="button" class="btn bg-success text-light p-2 float-end  add">ADD NEW</button>

                        </div>
                    </div>



                </div>

                <div class="container">
                    <div class="row mt-4">

                        <div class="col-lg-12 col-md-12 col-sm-12 users">

                        </div>

                    </div>
                </div>



            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; HIRE HERO 2023</div>

                </div>
            </div>
        </footer>
    </div>
</div>



<?php include '../config/footer.php' ?>
<script src="../jquery-3.3.1.min.js"></script>
<script src="../jquery-3.3.1.min.js"></script>
<script src="../iziToast-master/dist/js/iziToast.js"></script>
<script src="../iziToast-master/dist/js/iziToast.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<div class="modal fade bd-example-modal-lg updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-muted text-capitalize">Add New User | Can Be Only Admin</h6>
            </div>
            <div class="modal-body updateData">

            </div>
        </div>
    </div>
</div>



<!-- users modal -->
<div class="modal fade bd-example-modal-lg projectsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-muted text-capitalize">Add New User | Can Be Only Admin</h6>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">

                    <input class="form-control fullName" id="floating" placeholder="max 40 characetrs">
                    <label for="floating">FullName</label>

                </div>
                <div class="form-floating mb-3">

                    <input class="form-control username" id="floating" placeholder="max 40 characetrs">
                    <label for="floating">Username</label>

                </div>
                <div class="form-floating mb-3">

                    <input class="form-control Email" id="floating" type="email" placeholder="max 40 characetrs">
                    <label for="floating">Email</label>

                </div>
                <div class="form-floating mb-3 pass">

                    <input class="form-control password" id="floating" type="email" placeholder="max 40 characetrs">
                    <label for="floating">Password</label>

                </div>


                <div class="form-group mb-3">
                    <select class="form-control type" disabled>

                        <option value="Admin">Admin</option>
                    </select>
                    <label class="fs-6">By Auto Only You Can Register Admin, You Can Edit The Rest Users</label>
                </div>




                <div class="form-group mb-3 mainProfile">
                    <label>Profile (Optional)</label>
                    <input class="form-control profile" type="file">
                </div>



                <div class="form-group">

                    <input type="button" class="btn border-2 border-dark  btn-outline-light text-success save" value="Save" id="Current">
                    <input type="button" class="btn border-2 border-dark  btn-outline-light text-success closeModal" value="Close" id="Current">
                </div>
            </div>
        </div>

    </div>
</div>



// DISPLAY

<div class="modal fade bd-example-modal-lg details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-muted text-capitalize header-one">Details View</h6>
            </div>
            <div class="modal-body details-body">



                <div class="form-group">

                    <!-- <input type="button" class="btn border-2 border-dark  btn-outline-light text-success save" value="Save" id="Current"> -->
                    <input type="button" class="btn border-2 border-dark  btn-outline-light text-danger closeModal" value="Close" id="Current">
                </div>
            </div>
        </div>

    </div>
</div>






<script>
    $(document).ready((e) => {

        $(".add").click(() => {
            $(".fullName").val("");
            $(".username").val("");
            $(".password").val("");
            $(".Email").val("");
            $(".profile").val("");
            $(".projectsModal").modal("show");
        })

        $(".closeModal").click(() => {
            $(".projectsModal").modal("hide");
        })


        $(document).on("click", ".activate", function(e) {
            activateOrDeactivate($(this).attr("activateID"), $(this).text())
        })
        $(document).on("click", ".edit", function(e) {
            getUserDetails($(this).attr("userID"), (data) => {
                console.log(data.response);
                $(".updateData").html(`
               <div class="form-floating mb-3">

<input class="form-control fullName" id="floating" value="${data.response.FullName}" placeholder="max 40 characetrs">
<label for="floating">FullName</label>

</div>
<div class="form-floating mb-3">

<input class="form-control username" id="floating" value="${data.response.Username}" placeholder="max 40 characetrs">
<label for="floating">Username</label>

</div>
<div class="form-floating mb-3">

<input class="form-control Email" id="floating" type="email" value="${data.response.Email}" placeholder="max 40 characetrs">
<label for="floating">Email</label>

</div>

<div class="form-group mb-3">
<select class="form-control type" disabled>

    <option value="Admin">Admin</option>
</select>
<label class="fs-6">By Auto Only You Can Register Admin, You Can Edit The Rest Users</label>
</div>
<input type="hidden" class="targetID" value="${data.response.USERID}"/>
<input type="button" class="btn border-2 border-dark  btn-outline-light text-success update" value="Edit" id="Current">
                    <input type="button" class="btn border-2 border-dark  btn-outline-light text-success closeModal" value="Close" id="Current">          
               `



                )
            })






            $(".updateModal").modal("show");
        })
        $(document).on("click", ".delete", function(e) {
            Delete($(this).attr("userID"), (response) => {
                displayToast(response['response'], "success", 4000);
                loadUsers();


            })



        })
        $(document).on("click", ".detail", function(e) {
            getUserDetails($(this).attr("userID"), (data) => {
                Display(data.response);
            })
        })
        $(document).on("click", ".update", function(e) {
            if (
                $(".fullName").val() == "" ||
                $(".username").val() == "" ||

                $(".email").val() == ""
            ) {
                displayToast("All Info Can't Be Empty..", "error", 3000);
                return;
            }
            UpdateUser($(".targetID").val(), (response) => {
                if (response.error)
                    displayToast(response.error, "error", 3000);
                else {
                    displayToast(response.response, "success", 3000);
                    loadUsers();
                    setTimeout(() => {
                        $(".updateModal").modal("hide");
                    }, 2000);
                }

            })
        })

        function getUserDetails(id, responseData) {
            $.ajax({


                method: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    action: "details"
                },
                url: "../api/users.php",
                success: (response) => {
                    responseData(response);

                },
                error: (response) => {
                    displayToast(response['responseText'], "error", 4000);
                }
            })
        }


        function Display(data) {

            console.log();
            console.log(data)
            $('.header-one').text("Details View @" + data.USERID);
            $('.details-body').html(`
            <div class="row">
              <div class="col-md-4">
                    <img src="../uploads/${data.Photo}" class="rounded-3" width="100%"/>
                </div>
              <div class="col-md-8">
                <div class="mb-2">
                    <span class="fw-bolder">Full-Name</span><br>
                    <span>${data.FullName}</span>
                </div>
                <div class="mb-2">
                    <span class="fw-bolder">Username</span><br>
                    <span>${data.Username}</span>
                </div>
                <div class="mb-2">
                    <span class="fw-bolder">Email</span><br>
                    <span>${data.Email}</span>
                </div>
                <div class="mb-2">
                    <span class="fw-bolder">AccountType</span><br>
                    <span>${data.AccountType}</span>
                </div>
                <div class="mb-2">
                    <span class="fw-bolder">Mobile</span><br>
                    <span>${data.Mobile}</span>
                </div>
                <hr/>
                <div class="mb-2">
                    <p>Links</p>
               <a target="${data.facebook.startsWith("https") ? "__blank" : ""}" class="text-primary" href="${data.facebook.startsWith("https") ? data.facebook : "#"}"> <i class="fa-brands fa-facebook fs-2"></i></a>
             <a target="${data.facebook.startsWith("https") ? "__blank" : ""}" class="text-success" href="${data.whatsapp.startsWith("https") ? data.whatsapp : "#"}">   <i class="fa-brands fa-whatsapp fs-2"></i></a>
              <a target="${data.facebook.startsWith("https") ? "__blank" : ""}" class="text-dark" href="${data.github.startsWith("https") ? data.github : "#"}">  <i class="fa-brands fa-github fs-2"></i></a>
                </div>
                </div>
              </div>
            
            
            `)
            $('.details').modal("show");
        }

        function Delete(id, callback) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success mr-1'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Confirm Delete This User From The System!",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var data = {
                        action: "delete",
                        id: id
                    };
                    $.ajax({


                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/users.php",
                        success: (response) => {
                            callback(response);

                        },
                        error: (response) => {
                            displayToast(response['responseText'], "error", 4000);
                        }
                    })
                }
            })
        }

        function activateOrDeactivate(target, currentState) {

            if (currentState == "Active") {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-success mr-1'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Confirm Block This User From The System!",
                    icon: 'warning',
                    showCancelButton: true,

                    confirmButtonText: 'Block',
                    cancelButtonText: 'Cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            action: "activate",
                            state: "Blocked",
                            id: target
                        };
                        $.ajax({


                            method: "POST",
                            dataType: "JSON",
                            data: data,
                            url: "../api/users.php",
                            success: (response) => {
                                displayToast(response.response, "success", 3000);
                                loadUsers();

                            },
                            error: (response) => {
                                displayToast(response['responseText'], "success", 4000);
                            }
                        })




                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {

                    }
                })

                // alert("Blocked From The System");
            } else {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-success mr-1'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Confirm To Activate This User.",
                    icon: 'warning',
                    showCancelButton: true,

                    confirmButtonText: 'Activate',
                    cancelButtonText: 'Cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            action: "activate",
                            state: "Active",
                            id: target
                        };
                        $.ajax({


                            method: "POST",
                            dataType: "JSON",
                            data: data,
                            url: "../api/users.php",
                            success: (response) => {
                                displayToast(response.response, "success", 3000);

                                loadUsers();
                            },
                            error: (response) => {
                                displayToast(response['responseText'], "success", 4000);
                            }
                        })


                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {

                    }
                })


            }
        }



        function UpdateUser(id, returnResponse) {

            var data = {
                name: $(".fullName").val(),
                username: $(".username").val(),
                email: $(".Email").val(),
                id: $(".targetID").val(),
                action: "Update"
            }
            $.ajax({


                method: "POST",
                dataType: "JSON",
                data: data,
                url: "../api/users.php",
                success: (response) => {

                    returnResponse(response);
                },
                error: (response) => {
                    displayToast(response['responseText'], "success", 4000);
                }
            })

        }


        $(".save").click(() => {
            if ($(".profile").val() == "") {
                if (
                    $(".fullName").val() == "" ||
                    $(".username").val() == "" ||
                    $(".password").val() == "" ||
                    $(".email").val() == ""
                ) {
                    displayToast("All Info Are Required...", "error", 3000);
                    return;
                }
                var data = {
                    name: $(".fullName").val(),
                    username: $(".username").val(),
                    email: $(".Email").val(),
                    password: $(".password").val(),
                    type: $(".type").val(),
                    imageAvailable: "No",
                    action: "Register"
                }
                $.ajax({


                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "../api/users.php",
                    success: (response) => {
                        if (response.error)
                            displayToast(response.error, "error", 3000);
                        else {
                            displayToast(response.response, "success", 3000);
                            setTimeout(() => {
                                $(".projectsModal").modal("hide");
                            }, 3000)
                        }
                        loadUsers();

                    },
                    error: (response) => {
                        displayToast(response['responseText'], "success", 4000);
                    }
                })
            } else {

                if (
                    $(".fullName").val() == "" ||
                    $(".username").val() == "" ||
                    $(".password").val() == "" ||
                    $(".Email").val() == ""
                ) {
                    displayToast("All Info Are Required...", "error", 3000);
                    return;
                }
                var formData = new FormData();
                formData.append("name", $(".name").val());
                formData.append("username", $(".username").val());
                formData.append("email", $(".Email").val());
                formData.append("password", $(".password").val());
                formData.append("mobile", $(".mobile").val());
                formData.append("type", $(".type").val());
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

                    url: "../api/users.php",
                    success: (response) => {
                        if (response.error)
                            displayToast(response.error, "error", 3000);
                        else {
                            displayToast(response.response, "success", 3000);
                            setTimeout(() => {
                                $(".projectsModal").modal("hide");
                            }, 3000)
                        }

                        loadUsers();
                    },
                    error: (response) => {
                        displayToast(response['responseText'], "success", 4000);
                    }
                })

            }
        })

        loadUsers();
        setInterval(() => {

            countOnlineUsers();
            countOfflineUsers();
        }, 1000);

        function loadUsers() {
            $.ajax({
                method: "POST",
                data: {
                    "action": "loadUsers"
                },
                url: "../api/users.php",
                success: (res) => {
                    $(".users").html("");
                    $(".users").html(res);
                    $('.usersTable').DataTable();
                },
                error: (res) => {
                    console.log(res)
                }
            })
        }


        function countOnlineUsers() {
            $.ajax({
                method: "POST",
                dataType: "JSON",
                data: {
                    "action": "countOnlineUsers"
                },
                url: "../api/users.php",
                success: (res) => {
                    if (res.number > 0) {
                        if (res.number > 1)
                            $(".online").html(`${res.number} Online Users`)
                        else
                            $(".online").html(`${res.number} Online User`)
                    } else
                        $(".online").html(`No One is Online`)
                },
                error: (res) => {
                    console.log(res)
                }
            })
        }

        function countOfflineUsers() {
            $.ajax({
                method: "POST",
                dataType: "JSON",
                data: {
                    "action": "countOfflineUsers"
                },
                url: "../api/users.php",
                success: (res) => {
                    if (res.number > 0) {
                        if (res.number > 1)
                            $(".offline").html(`${res.number} Offline Users`)
                        else
                            $(".offline").html(`${res.number} Offline User`)

                    } else
                        $(".offline").html(`No One is Offline`)
                },
                error: (res) => {
                    console.log(res)
                }
            })
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





    })
</script>