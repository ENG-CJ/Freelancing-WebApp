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

                        <div class="col-lg-12">

                            <!-- <div class="alert alert-warning"> -->
                                <p class="text-secondary text-muted fw-bold">You can view all your clients but you can't do any operation, you can directly contact by click the chat navigation
                                    Or simple clicking view button in the table
                                </p>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="clientsTable">

                    </div>


                </div>




            </div>
        </main>

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
                    <button class="btn btn-danger text-light fw-bolder w-25">Close</button>
                </div>
            </div>

        </div>

    </div>
</div>


<!-- // end -->
<?php include '../config/footer.php' ?>
<script src="../jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready((e) => {
        fetchCurrentUser();


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
                        <p class="fw-bolder m-0 p-0 text-muted"><i class="fa-regular fa-flag mx-1 text-muted"></i>100.00</p>
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
        $(document).on("click", ".update", function(e) {

            getProjectValue($(this).attr("projectID"), (response) => {
                console.log(response.response.name);
                clear($(".project_name"))
                $(".project_name").val(response.response.name);
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
        $(document).on("click", ".delete", function(e) {

            DeleteProject($(this).attr("projectID"), (response) => {
                alert(response.response)
            })
            // $(".projectsModal").modal("show")
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
            )
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

        loadClients();

        function loadClients() {
            $.ajax({
                method: "POST",
                data: {
                    "action": "loadClients"
                },
                url: "../api/client.php",
                success: (res) => {
                    $(".clientsTable").html("");
                    $(".clientsTable").html(res);
                    $('.clientTableData').DataTable();
                },
                error: (res) => {
                    console.log(res)
                }
            })
        }

        $(".save").click((e) => {
            e.preventDefault();
            if ($(".save").val() == "Save") {
                if ($(".project_type").val() == "")
                    alert("Fill");
                else if ($(".description").val() == "")
                    alert("Fill");
                else if ($(".poster").val() == "")
                    alert("Fill");
                else if ($(".description").val().length != 40)
                    alert("Project Description Required to be 40 characters");
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
                    data.append("action", "setupProject")
                    // var data = {
                    //     action: "setupProject",
                    //     project_name: $(".project_name").val(),
                    //     project_type: $(".project_type").val(),
                    //     project_description: $(".description").val(),
                    //     project_poster: $(".poster")[0].files[0],
                    //     assigned: $(".currentUser").val(),

                    // }
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
                            if (res.error != "")
                                alert(res.error);
                            else {
                                alert(res.response);
                                //loadTools();
                            }
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
            } else if ($(".save").val() == "Save Changes") {

                if ($(".description").val().length != 40) {
                    alert("Project Description Required to be 40 characters");
                    return;
                }


                // update changes
                var PriceHasDisableMode = (document.querySelector(".project_price_group").classList.contains("d-none"));
                if (PriceHasDisableMode) {
                    if ($(".poster").val() == "" && $(".project_video").val() == "") {
                        var data = {
                            id: $(".project_id").val(),
                            project_name: $(".project_name").val(),
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
                    } else if ($(".poster").val() != "" && $(".project_vide").val() == "") {

                        var data = new FormData();
                        data.append("project_name", $(".project_name").val())
                        data.append("id", $(".project_id").val())
                        data.append("project_type", $(".project_type").val())
                        data.append("description", $(".description").val())
                        data.append("poster", $(".poster")[0].files[0])

                        data.append("moreDescription", $(".MoreDescription").val())
                        data.append("price_project", $(".project_price").val())
                        data.append("from_price", $(".project_from_price").val())
                        data.append("file", "yes")
                        data.append("poster_available", "yes")

                        data.append("action", "updateProject")
                        RequestUpdate(data, "yes");

                    }





                } else {

                    if ($(".poster").val() == "" && $(".project_video").val() == "") {
                        var data = {
                            id: $(".project_id").val(),
                            project_name: $(".project_name").val(),
                            project_type: $(".project_type").val(),
                            description: $(".description").val(),
                            moreDescription: $(".MoreDescription").val(),
                            price_project: $(".project_price").val(),
                            from_price: $(".project_from_price").val(),
                            file: "No",

                            action: "updateProject"
                        }

                        // ajax

                        RequestUpdate(data);
                        // end request
                    } else if ($(".poster").val() != "" && $(".project_video").val() == "") {
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
                        data.append("file", "yes")
                        data.append("poster_available", "yes")

                        data.append("action", "updateProject")
                        RequestUpdate(data, "yes");

                    } else if ($(".poster").val() == "" && $(".project_video").val() != "") {
                        // alert("HELLO")
                        var data = new FormData();
                        data.append("project_name", $(".project_name").val())
                        data.append("id", $(".project_id").val())
                        data.append("project_type", $(".project_type").val())
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
                    // cache: false,
                    // contentType: false,
                    // processData: false,
                    url: "../api/projects.php",
                    beforeSend: () => {
                        $(".save").attr("disabled", true);
                        $(".save").html("Processing....");
                    },
                    success: (res) => {
                        if (res.error != "")
                            alert(res.error);
                        else {
                            alert(res.response);
                            //loadTools();
                        }
                        $(".save").attr("disabled", false);
                        $(".save").html("Save");
                        loadProjects();
                    },
                    error: (res) => {
                        $(".save").attr("disabled", false);
                        $(".save").html("Save");
                        alert(res.response);
                        if (res.error != "")
                            alert(res['responseText']);
                        else {
                            alert(res.response);
                        }
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
                        alert(res.file)
                        if (res.error != "")
                            alert(res.error);
                        else {
                            alert(res.file);
                            //loadTools();
                        }
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
    })
</script>