<?php include '../config/header.php';
include '../config/sidebar.php'; ?>

<style>
    .dataTables_filter input{
        float: right;
        width: 100% !important;
        margin-right: auto;
    }
</style>

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
                  
                </div>
            </div>
        </footer>
    </div>
</div>



<div class="modal fade bd-example-modal-lg toolsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-muted text-capitalize">Register/Edit Tools For The Categories</h6>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <select class="form-control categories">
                        <option value="">Select Category</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="Current" class="text-secondary ml-2 mb-2">Execute Tools </label>
                    <textarea class="form-control tools" id="Current" rows="10" cols="8" placeholder="eg. Java, C#, PHP,Photoshop,Figma,adobeXd"></textarea>
                    <p class="text-muted" style="font-size: 13px">Put (,) Comma Between Words If You Want To Register More Then One Tool For The Specified category. And Put Words In One Line Until Words Wraps Automatically</p>
                </div>

                <input type="hidden" class="tool_id" />
                <div class="form-group">

                    <input type="button" class="btn btn-success text-light save" value="Save" id="Current">
                    <input type="button" class="btn btn-danger text-light close" value="Close" id="Current">
                </div>
            </div>
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
            $(".tools").val("");

            $(".categories").val("");
            $(".save").val("Save")
            $(".toolsModal").modal("show")
        })
        $(".close").click(() => {
            $(".tools").val("");
            $(".categories").val("");
            $(".toolsModal").modal("hide")
        })

        function getToolsData(id, callBack) {
            var data = {
                action: "getToolsData",
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



        $(document).on("click", ".delete", function() {
            Delete($(this).attr("ID"), (response) => {
                if (response.error)
                    displayToast(response.error, "error", 3000);
                else {
                    displayToast(response.response, "success", 3000);
                    loadTools();
                }
            })
        })
        $(document).on("click", ".edit", function() {
            getToolsData($(this).attr("ID"), (response) => {
                console.log(response)
                $(".categories").val(response.response.category)
                $(".tools").val(response.response.toolName)
                $(".tool_id").val(response.response.id)

                $(".save").val("Edit")
                $(".toolsModal").modal("show");
            })
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
                text: "Confirm To Remove This Tools From The System",
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
                        type: "tools"
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


        function loadCategories() {
            var data = {
                action: "categories",
            };

            $.ajax({


                method: "POST",
                // dataType: "JSON",
                data: data,
                url: "../api/tools.php",
                success: (response) => {
                    // console.log(response)
                    // let data = response.map((v) => v.Data);

                    $(".categories").html("");

                    $(".categories").html(response)


                },
                error: (response) => {
                    console.log(response)
                }
            })
        }

        loadTools();

        function loadTools() {
            $.ajax({
                method: "POST",
                data: {
                    "action": "loadTools"
                },
                url: "../api/tools.php",
                success: (res) => {
                    $(".users").html("");
                    $(".users").html(res);
                    $(".toolsTable").DataTable();
                },
                error: (res) => {
                    console.log(res)
                }
            })
        }
        $(".save").click((e) => {
            e.preventDefault();
            if ($('.save').val() == "Save") {
                if ($(".categories").val() == "")
                    displayToast("Category Must Provide... ", "error", 2000);
                else if ($(".tools").val() == "")
                    displayToast("All Tools You Want To Register Must Provide... ", "error", 2000);
                else {
                    var data = {
                        action: "saveTools",
                        id: $(".categories").val(),
                        tools: $(".tools").val()
                    }
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/tools.php",
                        beforeSend: () => {
                            $(".save").attr("disabled", true);
                            $(".save").html("Processing....");
                        },
                        success: (res) => {
                            if (res.error != "") {
                                displayToast(res.error, "warning", 3000);
                                loadTools();
                            } else {
                                displayToast(res.response, "success", 3000);

                                loadTools();
                                setTimeout(() => {
                                    $(".toolsModal").modal("hide");
                                }, 3000);
                            }
                            $(".save").attr("disabled", false);
                            $(".save").html("Save");
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
                if ($(".categories").val() == "")
                    displayToast("Can't Update When Category is Empty... ", "error", 2000);
                else if ($(".tools").val() == "")
                    displayToast("Can't Update When Tool Name is Empty.. ", "error", 2000);
                else {
                    var data = {
                        action: "updateTools",
                        targetID: $(".tool_id").val(),
                        categoryID: $(".categories").val(),
                        tool: $(".tools").val()
                    }
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        data: data,
                        url: "../api/tools.php",
                        beforeSend: () => {
                            $(".save").attr("disabled", true);
                            $(".save").html("Processing....");
                        },
                        success: (res) => {

                            displayToast(res.response, "success", 3000);

                            loadTools();
                            setTimeout(() => {
                                $(".toolsModal").modal("hide");
                            }, 3000);

                            $(".save").attr("disabled", false);
                            $(".save").html("Save");
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
            } else if (type == "warning") {
                iziToast.warning({

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