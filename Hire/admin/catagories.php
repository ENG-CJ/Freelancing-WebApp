<?php include '../config/header.php';
include '../config/sidebar.php'; ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- <h1 class="mt-4">Users</h1> -->
                <ol class="breadcrumb mb-4">
                    <!-- <li class="breadcrumb-item active ">All Users</li> -->
                </ol>
                <div class="container">

                    <div class="row">

                        <div class="col-lg-3">
                            <button type="button" class="btn bg-success text-light p-2 float-start addNew">
                            <i class="fa-solid fa-plus"></i> ADD NEW</button>

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
                    <div class="text-muted">Copyright &copy; HireWebApp 2023</div>
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



<div class="modal fade bd-example-modal-lg categoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-muted text-capitalize">Register Categories</h6>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Current" class="text-secondary ml-2 mb-2">Execute Category </label>
                    <textarea class="form-control category" id="Current" rows="10" cols="8" placeholder="eg. Software Developer, Graphic Designer"></textarea>
                    <p class="text-muted" style="font-size: 13px">Put (,) Comma Between Words If You Want To Register More Then One Category. And Put Words In One Line Until Words Wraps Automatically</p>
                </div>

                <div class="form-group">

                    <button type="button" class="btn border-2  btn-success text-light save" value="Save" id="Current">
                        <i class="fa-regular fa-bookmark"></i> Save</button>
                    <input type="button" class="btn border-2  btn-danger text-light close" value="Close" id="Current">
                </div>
            </div>

            <input type="hidden" class="edit_category" />
        </div>

    </div>
</div>



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
        loadCategories();

        $(".addNew").click(() => {
            $(".category").val("");
            $(".save").html(' <i class="fa-regular fa-bookmark"></i> Save')
            $('.categoryModal').modal("show");
        })
        $(".close").click(() => {
            $(".category").val("");
            $('.categoryModal').modal("hide");
        })
        $(document).on("click", ".delete", function() {
            Delete($(this).attr("ID"), (response) => {
                if (response.error)
                    displayToast(response.error, "error", 3000);
                else {
                    displayToast(response.response, "success", 3000);
                    loadCategories();
                }
            })
        })
        $(document).on("click", ".edit", function() {
            getCategoryData($(this).attr("ID"), (response) => {
                console.log(response);
                $(".category").val(response.response.name);
                $(".edit_category").val(response.response.id);
                $(".save").html('<i class="fa-regular fa-pen-to-square"></i> Edit');
                $('.categoryModal').modal("show");
            })
        })

        function getCategoryData(id, callBack) {
            var data = {
                action: "getCategoryData",
                id: id
            };
            $.ajax({


                method: "POST",
                dataType: "JSON",
                data: data,
                url: "../api/tools.php",
                success: (response) => {
                    callBack(response);

                },
                error: (response) => {
                    displayToast(response['responseText'], "error", 4000);
                }
            })
        }

        function loadCategories() {
            $.ajax({
                method: "POST",
                data: {
                    "action": "loadCategories"
                },
                url: "../api/tools.php",
                success: (res) => {
                    $(".users").html("");
                    $(".users").html(res);
                    $(".categoriesTable").DataTable();
                },
                error: (res) => {
                    console.log(res)
                }
            })
        }
        $(".save").click((e) => {
            e.preventDefault();
            if ($(".category").val() == "")
                displayToast("Write At Least One Category Or More. Blank Cannot Be Allowed", "error", 2000);
            else {
                if ($(".save").text().includes("Save")) {
                    var data = {
                        action: "saveCategory",
                        category: $(".category").val()
                    }
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/tools.php",
                        beforeSend: () => {
                            $(".category").attr("disabled", true);
                            $(".category").html("Processing....");
                        },
                        success: (res) => {
                            if (res.error != "")
                               {
                                displayToast(res.error,"warning",3000);
                                loadCategories();
                               }
                            else {
                                displayToast(res.response,"success",3000);
                                loadCategories();
                            }
                            $(".category").attr("disabled", false);
                            $(".category").html("Save");
                        },
                        error: (res) => {
                            $(".category").attr("disabled", false);
                            $(".category").html("Save");
                            if (res.error != "")
                                alert(res['responseText']);
                            else {
                                alert(res.response);
                            }
                        },
                    })
                } else {

                    if ($(".category").val() == "")

                        $(".categoryModal").modal("hide");
                    else {
                        var data = {
                            action: "updateCategory",
                            category: $(".category").val(),
                            target: $(".edit_category").val(),
                        }
                        $.ajax({
                            method: "POST",
                            dataType: "JSON",
                            data: data,
                            url: "../api/tools.php",
                            beforeSend: () => {
                                $(".category").attr("disabled", true);
                                $(".category").html("Processing....");
                            },
                            success: (res) => {

                                displayToast(res.response,"success",3000);
                                loadCategories();
                                setTimeout(() => {
                                    $('.categoryModal').modal("hide");
                                }, 2000);

                                $(".category").attr("disabled", false);
                                $(".category").html("Save");
                            },
                            error: (res) => {
                                $(".category").attr("disabled", false);
                                $(".category").html("Save");
                              
                                    displayToast(res['responseText'],"error",3000);
                              
                            },
                        })
                    }



                }
            }

        })

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
                text: "Confirm To Remove This Category From The System",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var data = {
                        action: "delete",
                        id: id,
                        type: "category"
                    };
                    $.ajax({


                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/tools.php",
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
            } 
            else if (type == "warning") {
                iziToast.warning({

                    message: message,
                    backgroundColor: "#54B435",
                    titleColor: "white",
                    messageColor: "white",
                    position: "topRight",
                    timeout: timeout
                });
            } 
            else if (type == "ask") {
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