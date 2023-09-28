<?php include '../config/header.php';
include '../config/sidebar.php'; ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- <h1 class="mt-4">Users</h1> -->
                <ol class="breadcrumb mb-4">
                    <!-- <li class="breadcrumb-item active ">Your Project Goes Here!</li> -->
                </ol>
                <div class="container">

                    <div class="row">

                        <div class="col-lg-3">
                            <button type="button" class="btn bg-success text-light p-2 float-start showModal">Setup new Project</button>

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
                    <!-- <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div> -->
                </div>
            </div>
        </footer>
    </div>
</div>



<div class="modal fade bd-example-modal-lg projectsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-muted text-capitalize">SETUP NEW PROJECT | ENHANCE YOUR PROFILE</h6>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">

                    <input class="form-control project_name" id="floating" placeholder="max 40 characetrs">
                    <label for="floating">Provide Project name</label>

                </div>
                <div class="form-floating mb-3">

                    <input class="form-control project_category" id="floating" placeholder="max 40 characetrs">
                    <label for="floating">Project Category</label>

                </div>

                <div class="form-group mb-3">
                    <select class="form-control project_type">
                        <option value="">Select Project Type</option>
                        <option value="Priced">Priced Project</option>
                        <option value="Normal">Normal Project</option>
                    </select>
                </div>
                <div class="form-group mb-3">

                    <textarea class="form-control description" cols="5" rows="2" id="floating" placeholder="Provide Project Description, This Description Will Appear in Front of  Project Card. Required 40 Characeers"></textarea>
                    <span class="text-success fw-bolder my-2 countCharacter">0/40</span>
                    <!-- <label for="floating">Project Description</label>  -->
                </div>
                <div class="form-group mb-3">

                    <textarea class="form-control MoreDescription" cols="5" rows="2" id="floating" placeholder="More Description, If You Need More Description (Optional)"></textarea>

                    <!-- <label for="floating">Project Description</label>  -->
                </div>
                <div class="form-floating mb-3 d-none project_price_group">

                    <input class="form-control project_price" id="floating" placeholder="Provide Price">
                    <label for="floating">Project Price $</label>

                </div>
                <div class="form-floating mb-3 d-none project_from_price_group">

                    <input class="form-control project_from_price" id="floating" placeholder="Provide Price">
                    <label for="floating">From Price $</label>

                </div>

                <div class="form-group mb-3">
                    <label>Project Poster</label>
                    <input class="form-control poster" type="file">
                </div>
                <input class="form-control project_id" type="hidden">
                <div class="form-group mb-3">
                    <label>Project Video Demo</label>
                    <input class="form-control project_video" type="file">
                </div>

                <div class="form-group mb-3">
                    <label>Owner/ Seller </label>
                    <select class="form-control currentUser">

                    </select>
                </div>
                <div class="form-group">

                    <input type="button" class="btn border-2 border-dark  btn-outline-light text-success save" value="Save" id="Current">
                </div>
            </div>
        </div>

    </div>
</div>




<!-- diaply modal -->
<div class="modal fade bd-example-modal-lg displayModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-muted text-capitalize">Details Specified Project</h6>
            </div>
            <div class="modal-body">

                <div class="row projectContent">

                </div>
                <div class="my-2">
                    <button class="btn btn-danger text-light fw-bolder w-25 closeModal">Close</button>
                </div>
            </div>

        </div>

    </div>
</div>


<!-- // end -->
<?php include '../config/footer.php' ?>
<script src="../jquery-3.3.1.min.js"></script>
<script src="../iziToast-master/dist/js/iziToast.js"></script>
<script src="../iziToast-master/dist/js/iziToast.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready((e) => {
        fetchCurrentUser();

        $('.closeModal').click(() => {
            $('.displayModal').modal("hide");
        })

        $(document).on("click", ".detail", function() {
            getProjectValue($(this).attr('projectID'), (response) => {
                console.log(response)
                if (response.response.type == "Priced") {
                    $(".projectContent").html(`
<div class="col-lg-7">
                    <div class="my-2">
                        <span class="lead text-muted">Project</span>
                        <p class="fw-bolder m-0 p-0"> <i class="fa-solid fa-location-arrow mx-1 text-muted"></i>${response.response.name}</p>
                    </div>
                    <div class="my-2">
                        <span class="lead text-muted">Category</span>
                        <p class="fw-bolder m-0 p-0"> <i class="fa-solid fa-location-arrow mx-1 text-muted"></i>${response.response.category}</p>
                    </div>
                    <div class="my-2">
                        <span class="lead text-muted">Project Type</span>
                        <p class="fw-bolder m-0 p-0"> <i class="fa-solid fa-tape mx-1 text-muted"></i>${response.response.type}</p>
                    </div>
                    <div class="my-2">
                        <span class="lead text-bolder mb-5">Description</span>
                        <p class="fw-bold m-0 p-0 "> <i class="fa-solid fa-file-medical mx-1 text-muted"></i>${response.response.description}</p>
                    </div>
                    <div class="my-2">
                        <span class="text-bolder">Current Price</span>
                        <p class="fw-bolder m-0 p-0 text-muted"> <i class="fa-solid fa-dollar-sign text-danger mx-1"></i>${response.response.price}</p>
                    </div>
                    <div class="my-2">
                        <span class="text-bolder">Old Price</span>
                        <p class="fw-bolder m-0 p-0 text-muted"> <i class="fa-solid fa-dollar-sign text-danger mx-1"></i><strike>${response.response.fromPrice}</strike></p>
                    </div>
                    <div class="my-2">
                        <span class="text-bolder">Number Of Purchased</span>
                        <p class="fw-bolder m-0 p-0 text-muted"><i class="fa-regular fa-flag mx-1 text-muted"></i>${response.response.count}</p>
                    </div>
                <hr>
               
                </div>
                <div class="col-lg-5">
                    <video src="../videos/${response.response.demoVideo}" class="img-fluid w-100 rounded-3" controls></video>
                </div>



`)
                } else {
                    $(".projectContent").html(`
<div class="col-lg-7">
                    <div class="my-2">
                        <span class="lead text-muted">Project</span>
                        <p class="fw-bolder m-0 p-0"> <i class="fa-solid fa-location-arrow mx-1 text-muted"></i>${response.response.name}</p>
                    </div>
                    <div class="my-2">
                        <span class="lead text-muted">Project Type</span>
                        <p class="fw-bolder m-0 p-0"> <i class="fa-solid fa-tape mx-1 text-muted"></i>${response.response.type}</p>
                    </div>
                    <div class="my-2">
                        <span class="lead text-bolder mb-5">Description</span>
                        <p class="fw-bold m-0 p-0 "> <i class="fa-solid fa-file-medical mx-1 text-muted"></i>${response.response.description}</p>
                    </div>
                    <div class="my-2">
                        <span class="lead text-bolder mb-5">More Details</span>
                        <p class="fw-bold m-0 p-0 "> <i class="fa-solid fa-file-medical mx-1 text-muted"></i>${response.response.moreDescription}</p>
                    </div>
                   
                  
                <hr>
               
                </div>
                <div class="col-lg-5">
                    <video src="../videos/${response.response.demoVideo}" class="img-fluid w-100 rounded-3" controls></video>
                   
                  

                </div>
                


`)
                }

                $(".displayModal").modal("show")
            })
        })





        //? changing price to noraml
        $(".project_type").on("change", function() {
            if ($(this).val() == "Priced") {
                $(".project_price_group").removeClass("d-none")
                $(".project_from_price_group").removeClass("d-none")
            } else if ($(this).val() == "Normal") {
                $(".project_price_group").addClass("d-none")
                $(".project_from_price_group").addClass("d-none")
            } else {
                $(".project_price_group").addClass("d-none")
                $(".project_from_price_group").addClass("d-none")
            }
        })

        //  updating project
        $(document).on("click", ".update", function(e) {
            $('.poster').val("");
            $('.project_video').val("");
            getProjectValue($(this).attr("projectID"), (response) => {
                console.log(response);
                clear($(".project_name"))
                $(".project_name").val(response.response.name);
                $(".project_category").val(response.response.category);

                if (response.response.type == "Priced") {
                    $(".project_price").val(response.response.price);
                    $(".project_from_price").val(response.response.fromPrice);
                    $(".project_price_group").removeClass("d-none")
                    $(".project_from_price_group").removeClass("d-none")
                } else {
                    $(".project_price_group").addClass("d-none")
                    $(".project_from_price_group").addClass("d-none")
                }

                $(".project_type").val(response.response.type);
                $(".description").val(response.response.description);
                // $(".description").val(response.response.description);
                $(".MoreDescription").val(response.response.moreDescription);
                $(".countCharacter").html($(".description").val().length + "/40").removeClass("text-danger").addClass("text-success");

                $(".project_id").val(response.response.id);
                $(".save").val("Save Changes")

                $(".projectsModal").modal("show")

            })

            // $(".projectsModal").modal("show")
        })

        //  delete project

        $(document).on("click", ".delete", function(e) {
            // confirm
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success mr-1'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Confirm To Delete This Record?",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'Delete it!',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    DeleteProject($(this).attr("projectID"), (response) => {
                        // alert()
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            response.response,
                            'success'
                        )
                        loadProjects();
                    })


                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {

                }
            })



        })

        $(document).on("click", ".showModal", function() {
            clear($(".project_name"),

                $(".project_type"),
                $(".project_price"),
                $(".project_from_price"),
                $(".description"),
                $(".MoreDescription"),
                $(".poster"),
                $(".project_video"),
                $(".project_category")
            )
            $(".project_price_group").addClass("d-none")
            $(".project_from_price_group").addClass("d-none")
            $(".save").val("Save")
            $(".projectsModal").modal("show")
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

        function DeleteProject(id, display) {
            var data = {
                id: id,
                action: "deleteProject"
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

        $(".description").on("keyup", function(e) {
            if ($(".description").val().length <= 40) {
                $(".description").css({
                    border: "1px solid gray"
                })
                $(".countCharacter").html($(".description").val().length + "/40").removeClass("text-danger").addClass("text-success");
            } else {
                $(".description").css({
                    border: "1px solid red"
                })
                $(".countCharacter").html($(".description").val().length + "/40").removeClass("text-success").addClass("text-danger");
            }
        })


        function clear(...values) {
            values.forEach((value) => {
                value.val("");
            })
        }


        function fetchCurrentUser() {
            var data = {
                action: "fetchCurrentUser",
            };

            $.ajax({


                method: "POST",
                // dataType: "JSON",
                data: data,
                url: "../api/projects.php",
                success: (response) => {
                    console.log(response)
                    // let data = response.map((v) => v.Data);

                    // $(".categories").html("");

                    $(".currentUser").html(response)
                    $(".currentUser").attr("disabled", true)



                },
                error: (response) => {
                    console.log(response)
                }
            })
        }

        loadProjects();

        function loadProjects() {
            $.ajax({
                method: "POST",
                data: {
                    "action": "loadProjects"
                },
                url: "../api/projects.php",
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

        function validate(...values) {
            values.map(value => {
                if (value.val() == "")
                    alert("hello")
                return;
            })

        }
        // display toast
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
        $(".save").click((e) => {
            e.preventDefault();
            if ($(".save").val() == "Save") {
                if (
                    $(".project_name").val() == "" ||
                    $(".project_type").val() == "" ||
                    $(".description").val() == "" ||
                    $(".MoreDescription").val() == "" ||
                    $(".poster").val() == "" ||
                    $(".project_video").val() == "" ||
                    $(".project_category").val() == ""


                )
                    displayToast("All Information Are Required. Plz Fill Required Info To Setup new project", "error", 3000);
                else if ($(".description").val().length != 40)
                    displayToast("Project Description Required to be 40 characters", "error", 3000);
                else {
                    if ($(".project_type").val() == "Priced") {
                        var poster_image = $(".poster")[0].files[0].name;
                        var poster_video = $(".project_video")[0].files[0].name;

                        var extension = poster_image.split(".")[1];
                        var video_extension = poster_video.split(".")[1];

                        if (extension.toLowerCase() != "jpg" && extension.toLowerCase() != "png")
                            displayToast("Poster Image Must Be JPG or PNG Files ", "error", 3000);
                        else if (video_extension.toLowerCase() != "mp4")
                            displayToast("Project Video Must MP4 Only", "error", 3000);


                        else if ($(".project_price").val() == "")
                            displayToast("The Price For The Priced Project is Required..", "error", 3000);

                        else {
                            var data = new FormData();
                            data.append("project_name", $(".project_name").val())
                            data.append("project_type", $(".project_type").val())
                            data.append("project_description", $(".description").val())
                            data.append("project_poster", $(".poster")[0].files[0])
                            data.append("assigned", $(".currentUser").val())
                            data.append("moreDescription", $(".MoreDescription").val())
                            data.append("project_price", $(".project_price").val())
                            data.append("project_from_price", $(".project_from_price").val())
                            data.append("project_video", $(".project_video")[0].files[0])
                            data.append("project_category", $(".project_category").val())
                            data.append("action", "setupProject")

                            $.ajax({
                                method: "POST",
                                dataType: "JSON",
                                data: data,
                                cache: false,
                                contentType: false,
                                processData: false,
                                url: "../api/projects.php",
                                beforeSend: () => {
                                    $(".save").attr("disabled", true);
                                    $(".save").html("Processing....");
                                },
                                success: (res) => {

                                    displayToast(res.response, "success", 3000);
                                    $(".projectsModal").modal("hide");
                                    $(".save").attr("disabled", false);
                                    $(".save").html("Save");
                                    loadProjects();
                                },
                                error: (res) => {
                                    $(".save").attr("disabled", false);
                                    $(".save").html("Save");
                                    if (res.error != "")
                                        alert(res['responseText']);
                                    else {
                                        alert(res.response);
                                    }
                                },
                            })
                        }
                    } else {

                        var poster_image = $(".poster")[0].files[0].name;
                        var poster_video = $(".project_video")[0].files[0].name;

                        var extension = poster_image.split(".")[1];
                        var video_extension = poster_video.split(".")[1];

                        if (extension.toLowerCase() != "jpg" && extension.toLowerCase() != "png")
                            displayToast("Poster Image Must Be JPG or PNG Files ", "error", 3000);
                        else if (video_extension.toLowerCase() != "mp4")
                            displayToast("Project Video Must MP4 Only", "error", 3000);
                        else {
                            var data = new FormData();
                            data.append("project_name", $(".project_name").val())
                            data.append("project_type", $(".project_type").val())
                            data.append("project_description", $(".description").val())
                            data.append("project_poster", $(".poster")[0].files[0])
                            data.append("assigned", $(".currentUser").val())
                            data.append("moreDescription", $(".MoreDescription").val())
                            data.append("project_price", $(".project_price").val())
                            data.append("project_from_price", $(".project_from_price").val())
                            data.append("project_video", $(".project_video")[0].files[0])
                            data.append("project_category", $(".project_category").val())
                            data.append("action", "setupProject")

                            $.ajax({
                                method: "POST",
                                dataType: "JSON",
                                data: data,
                                cache: false,
                                contentType: false,
                                processData: false,
                                url: "../api/projects.php",
                                beforeSend: () => {
                                    $(".save").attr("disabled", true);
                                    $(".save").html("Processing....");
                                },
                                success: (res) => {
                                    displayToast(res.response, "success", 3000);
                                    $(".projectsModal").modal("hide");
                                    $(".save").attr("disabled", false);
                                    $(".save").html("Save");
                                    loadProjects();
                                },
                                error: (res) => {
                                    $(".save").attr("disabled", false);
                                    $(".save").html("Save");
                                    if (res.error != "")
                                        alert(res['responseText']);
                                    else {
                                        alert(res.response);
                                    }
                                },
                            })
                        }


                    }

                }
            } else if ($(".save").val() == "Save Changes") {

                if (
                    $(".project_name").val() == "" ||
                    $(".project_type").val() == "" ||
                    $(".description").val() == "" ||
                    $(".project_category").val() == "" ||
                    $(".MoreDescription").val() == ""




                ) {
                    displayToast("Some Information are Required. So Cannot Be Update That Info As Blank Info", "error", 3000);
                    return;
                }
                if ($(".description").val().length != 40) {
                    displayToast("Project Description Required to be 40 characters", "error", 3000);
                    return;
                }


                // update changes
                var PriceHasDisableMode = (document.querySelector(".project_price_group").classList.contains("d-none"));
                if (PriceHasDisableMode) {

                    if ($(".poster").val() == "" && $(".project_video").val() == "") {
                        var data = {
                            id: $(".project_id").val(),
                            project_name: $(".project_name").val(),
                            project_category: $(".project_category").val(),
                            project_type: $(".project_type").val(),
                            description: $(".description").val(),
                            moreDescription: $(".MoreDescription").val(),
                            price_project: "0.00",
                            from_price: "0.00",
                            file: "No",

                            action: "updateProject"
                        }

                        // ajax

                        RequestUpdate(data);
                        // end request

                        // NOTE: if the poster is not empty but project video
                    } else if ($(".poster").val() != "" && $(".project_video").val() == "") {

                        var poster_image = $(".poster")[0].files[0].name;
                        var extension = poster_image.split(".")[1];

                        if (extension.toLowerCase() != "jpg" && extension.toLowerCase() != "png")
                            displayToast("Poster Image Must Be JPG or PNG Files ", "error", 3000);
                        else {
                            var data = new FormData();
                            data.append("project_name", $(".project_name").val())
                            data.append("id", $(".project_id").val())
                            data.append("project_type", $(".project_type").val())
                            data.append("description", $(".description").val())
                            data.append("poster", $(".poster")[0].files[0])

                            data.append("moreDescription", $(".MoreDescription").val())
                            data.append("price_project", $(".project_price").val())
                            data.append("from_price", $(".project_from_price").val())
                            data.append("project_category", $(".project_category").val())
                            data.append("file", "yes")
                            data.append("poster_available", "yes")

                            data.append("action", "updateProject")
                            RequestUpdate(data, "yes");
                        }


                        // NOTE: if the poster is  empty but project video isn't
                    } else if ($(".poster").val() == "" && $(".project_video").val() != "") {


                        var project_vide = $(".project_video")[0].files[0].name;
                        var extension = project_vide.split(".")[1];

                        if (extension.toLowerCase() != "mp4")
                            displayToast("project_vide Must Be MP4 Files ", "error", 3000);
                        else {
                            var data = new FormData();
                            data.append("project_name", $(".project_name").val())
                            data.append("id", $(".project_id").val())
                            data.append("project_type", $(".project_type").val())
                            data.append("project_category", $(".project_category").val())
                            data.append("description", $(".description").val())
                            data.append("video", $(".project_video")[0].files[0])

                            data.append("moreDescription", $(".MoreDescription").val())
                            data.append("price_project", $(".project_price").val())
                            data.append("from_price", $(".project_from_price").val())
                            data.append("file", "yes")
                            data.append("poster_available", "no")
                            data.append("video_available", "yes")

                            data.append("action", "updateProject")
                            RequestUpdate(data, "yes");
                        }


                    } else {

                    }





                } else {
                    if ($(".project_price").val() == "") {
                        displayToast("The Price For The Priced Project is Required..", "error", 3000);
                        return;
                    }

                    if ($(".poster").val() == "" && $(".project_video").val() == "") {


                        var data = {
                            id: $(".project_id").val(),
                            project_name: $(".project_name").val(),
                            project_type: $(".project_type").val(),
                            description: $(".description").val(),
                            moreDescription: $(".MoreDescription").val(),
                            price_project: $(".project_price").val(),
                            from_price: $(".project_from_price").val(),
                            project_category: $(".project_category").val(),
                            file: "No",

                            action: "updateProject"
                        }

                        // ajax

                        RequestUpdate(data);
                        // end request
                    } else if ($(".poster").val() != "" && $(".project_video").val() == "") {

                        var poster_image = $(".poster")[0].files[0].name;
                        var extension = poster_image.split(".")[1];

                        if (extension.toLowerCase() != "jpg" && extension.toLowerCase() != "png") {
                            displayToast("Poster Image Must Be JPG or PNG Files ", "error", 3000);
                            return
                        }
                        // alert("HELLO")
                        var data = new FormData();
                        data.append("project_name", $(".project_name").val())
                        data.append("id", $(".project_id").val())
                        data.append("project_type", $(".project_type").val())
                        data.append("description", $(".description").val())
                        data.append("poster", $(".poster")[0].files[0])

                        data.append("moreDescription", $(".MoreDescription").val())
                        data.append("price_project", $(".project_price").val())
                        data.append("from_price", $(".project_from_price").val())
                        data.append("project_category", $(".project_category").val())
                        data.append("file", "yes")
                        data.append("poster_available", "yes")

                        data.append("action", "updateProject")
                        RequestUpdate(data, "yes");

                    } else if ($(".poster").val() == "" && $(".project_video").val() != "") {

                        var project_video = $(".project_video")[0].files[0].name;
                        var extension = project_video.split(".")[1];

                        if (extension.toLowerCase() != "mp4") {
                            displayToast("project_video Must Be MP4 Files", "error", 3000);
                            return
                        }
                        // alert("HELLO")
                        var data = new FormData();
                        data.append("project_name", $(".project_name").val())
                        data.append("id", $(".project_id").val())
                        data.append("project_type", $(".project_type").val())
                        data.append("description", $(".description").val())
                        data.append("project_category", $(".project_category").val())
                        data.append("video", $(".project_video")[0].files[0])

                        data.append("moreDescription", $(".MoreDescription").val())
                        data.append("price_project", $(".project_price").val())
                        data.append("from_price", $(".project_from_price").val())
                        data.append("file", "yes")
                        data.append("poster_available", "no")
                        data.append("video_available", "yes")

                        data.append("action", "updateProject")
                        RequestUpdate(data, "yes");

                    } else {
                        alert("ALL FIELDS BE UPDATED")
                    }

                }






            }


        })



        function RequestUpdate(data, uploadingFile = "no") {
            if (uploadingFile == "no") {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "../api/projects.php",
                    beforeSend: () => {
                        $(".save").attr("disabled", true);
                        $(".save").html("Processing....");
                    },
                    success: (res) => {

                        displayToast(res.response, "success", 3000);

                        $(".save").attr("disabled", false);
                        $(".save").html("Save");
                        loadProjects();
                    },
                    error: (res) => {
                        $(".save").attr("disabled", false);
                        $(".save").html("Save");
                        displayToast(res.response['responseText'], "error", 3000);

                    },
                })
            } else if (uploadingFile == "yes") {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "../api/projects.php",
                    beforeSend: () => {
                        $(".save").attr("disabled", true);
                        $(".save").html("Processing....");
                    },
                    success: (res) => {
                        displayToast(res.response, "success", 3000);


                        $(".save").attr("disabled", false);
                        $(".save").html("Save");
                        loadProjects();
                    },
                    error: (res) => {
                        $(".save").attr("disabled", false);
                        $(".save").html("Save");

                        displayToast(res['responseText'], "error", 3000);

                    },
                })
            }

        }
    })
</script>