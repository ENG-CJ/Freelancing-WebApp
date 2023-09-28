<?php
include '../config/header.php';
include '../config/sidebar.php';
include('../connections/conn.php');

if (!isset($_SESSION['profile_id'])) {
    header("location: ../index");
    exit();
}
if (!isset($_GET['freelancer_code'])) {
    header("location: ./");
    exit();
}



/**
 * this is freelancer arrays numbers code
 */
$freelancers = [];
$current_client = [];
$conn = new Connections();
if ($_SESSION['type'] == "freelancer Profile") {
    $id = $_SESSION['profile_id'];
    $client = $_GET['freelancer_code'];
    $sql_client = "SELECT users.FullName,users.loggedStatus,users.Photo from users where USERID='$client'";

    $sql = "SELECT
   *
 FROM
    hiredfreelancers
 RIGHT JOIN users ON users.USERID = hiredfreelancers.freelancerID
 WHERE
    hiredfreelancers.freelancerID = '$id'";

    $result = $conn->connect()->query($sql);
    $result_client = $conn->connect()->query($sql_client);
    if ($result) {
        while ($rows = $result->fetch_assoc()) {
            $sql_client_info = "SELECT users.USERID, users.FullName,users.loggedStatus,users.Photo from users where USERID='" . $rows['clientID'] . "'";
            $result_client_info = $conn->connect()->query($sql_client_info);
            while ($rows_client_info = $result_client_info->fetch_assoc()) {
                $freelancers[] = array(
                    "username" => $rows_client_info['FullName'],
                    "id" => $rows_client_info['USERID'],
                    "image" => $rows_client_info['Photo'],
                    "status" => $rows_client_info['loggedStatus']
                );
            }
        }
    }
    if ($result_client) {
        if(mysqli_num_rows($result_client)>0){
        $row = $result_client->fetch_assoc();
        $current_client = array(
            "name" => $row['FullName'],
            "status" => $row['loggedStatus'],
            "image" => $row['Photo'],
        );
    }
    }
}


?>


<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HIRE-OU-CHAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body> -->
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="container">
                    <div class="chat-container my-3">

                        <div class="flex">
                            <div class="chat-card">
                                <?php
                                if ($_GET['freelancer_code'] != "default") {
                                ?>
                                    <div class="chat-header">
                                        <div class="row-content">
                                            <div class="content">

                                                <img src="../images/loading-pic.gif" class="user_image" alt="Image" />


                                                <div class="col-1">
                                                    <span class="user_name"></span>

                                                </div>
                                            </div>

                                            <p class="status_online">

                                            </p>
                                            <!-- <a href="../Contents/" class="logout"><i class="fa-solid fa-arrow-left" style="margin-right: 10px"></i>Back</a> -->
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                <div class="chat-body-container area-chatting">
                                    <div class="image">
                                        <img src="../images/loading-chats.gif" />
                                    </div>
                                </div>
                                <?php

                                if ($_GET['freelancer_code'] != "default") {
                                ?>
                                    <div class="chat-footer">
                                        <div class="send-area">
                                            <input cols="3" rows="3" class="message" placeholder="Start typing...">
                                            <button type="button" class="sendMessage"><i class="fa-solid fa-paper-plane"></i></button>
                                            <!-- <button type="button"><i class="fa-solid fa-paperclip"></i></button> -->
                                        </div>
                                    </div>

                                <?php
                                }

                                ?>
                            </div>


                            <div class="freelancers-area">
                                <div class="active-freelancers">
                                    <?php

                                    if (count($freelancers) == 0) {
                                    ?>
                                        <div class="error-message" style="text-align: center; margin-top: 100px; color: gray">
                                            <p>Your Clients Will Appear Here😊</p>
                                        </div>
                                    <?php
                                    } else {
                                    ?>

                                        <div class="users_container">
                                            <div class="row_users">

                                                <?php

                                                foreach ($freelancers as $row => $values) {

                                                ?>

                                                    <a href="./DCChannel.php?freelancer_code=<?php echo $values['id'] ?>" style="text-decoration: none">
                                                        <div class="content" style="margin-bottom: 20px;">
                                                            <div class="user-details">
                                                                <img src="../uploads/<?php echo $values['image'] ?>" />
                                                                <div>
                                                                    <span class="name"><?php echo $values['username'] ?></span>
                                                                    <!-- <h1><?php echo $values['username'] ?></h1> -->
                                                                    <p class="message-detector">
                                                                        Click User Control To Chat Directly
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if ($values['status'] == "Online") {
                                                            ?>
                                                                <i class="fa-solid fa-circle" style="color: green"></i>
                                                            <?php
                                                            } else 
           if ($values['status'] == "Offline") {
                                                            ?>
                                                                <i class="fa-regular fa-circle" style="color: red"></i>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <i class="fa-regular fa-circle" style="color: red"></i>
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>
                                                    </a>

                                                <?php
                                                }

                                                ?>

                                            </div>
                                        </div>

                                    <?php
                                    }


                                    ?>

                                </div>


                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_GET['freelancer_code'] ?>" class="toUser">
                    <input type="hidden" value="<?php echo $_SESSION['profile_id'] ?>" class="fromUser">
                    <input type="hidden" value="<?php echo $_GET['freelancer_code'] ?>" class="clientInfo">
                </div>
            </div>
        </main>
    </div>
</div>
<script src="../jquery-3.3.1.min.js"></script>

<script>
    $(document).ready(() => {

        setInterval(() => {
            fetchTargetUser();
            fetchMessages();
        }, 700)


        function fetchMessages() {
            var data = {
                action: "fetchMessages",
                toUser: $(".toUser").val(),
                fromUser: $(".fromUser").val(),
            }

            $.ajax({

                method: "POST",
                // dataType: "JSON",
                data: data,
                url: '../api/chat.php',
                success: (res) => {


                    $(".area-chatting").html(res);



                    //             $(".are-chatting").html("");
                    //         $(".area-chatting").html(
                    //             `
                    //             <div class="error-message" style="text-align: center; margin-top: 100px; color: gray">
                    //     <p>Messages Will Appear Here😊</p>
                    // </div>
                    //             `
                    //         )



                },
                error: (res) => {
                    console.log(res)
                }
            })
        }


        function fetchTargetUser() {
            var data = {
                action: "fetchTargetUser",
                id: $(".clientInfo").val()
            }

            $.ajax({

                method: "POST",
                dataType: "JSON",
                data: data,
                url: '../api/chat.php',
                success: (res) => {
                    // console.log(res)
                    $(".user_image").attr("src", `../uploads/${res.image}`)
                    $(".user_name").html(res.username);

                    res.state == "Online" ?
                        $(".status_online").html(`  <i class="fa-solid fa-signal" style="margin-right: 10px"></i>${res.state}`).css("color", "rgb(71, 143, 71)") :
                        $(".status_online").html(`  <i class="fa-solid fa-signal" style="margin-right: 10px"></i>${res.state}`).css("color", "red");
                },
                error: (res) => {
                    console.log(res)
                }
            })
        }


    })

    // $(".message").on("keyup",function(){
    //     console.log("hello")
    // })
    $(".message").on("change", function() {
        console.log("down")
    })

    $(".sendMessage").click((e) => {
        var data = {
            action: "sendMessage",
            toUser: $(".toUser").val(),
            fromUser: $(".fromUser").val(),
            message: $(".message").val()
        }
        $.ajax({

            method: "POST",
            dataType: "JSON",
            data: data,
            url: '../api/chat.php',
            success: (res) => {
                $(".message").val("");
                // fetchMessages()
            },
            error: (res) => {
                console.log(res)
            }
        })
    })
</script>

<!-- </body>

</html> -->