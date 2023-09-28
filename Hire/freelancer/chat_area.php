<?php
include('../connections/conn.php');
session_start();
if (!isset($_SESSION['profile_id'])) {
    header("location: ../index");
    exit();
}
if (!isset($_GET['freelancer_code'])) {
    header("location: ./");
    exit();
}

$freelancers = [];
$current_client = [];
$conn = new Connections();
if ($_SESSION['type'] == "Employer Profile") {
    $id = $_SESSION['profile_id'];
    $sql_client = "SELECT users.FullName,users.loggedStatus,users.Photo from users where USERID='$id'";
    $sql = "SELECT users.USERID,users.Username,users.FullName,users.Photo,users.loggedStatus
  FROM users
  LEFT JOIN hiredfreelancers
  ON users.USERID=hiredfreelancers.freelancerID
  WHERE hiredfreelancers.clientID='$id'";

    $result = $conn->connect()->query($sql);
    $result_client = $conn->connect()->query($sql_client);
    if ($result) {
        while ($rows = $result->fetch_assoc()) {
            $freelancers[] = array(
                "username" => $rows['FullName'],
                "id" => $rows['USERID'],
                "image" => $rows['Photo'],
                "status" => $rows['loggedStatus']
            );
        }
    }
    if ($result_client) {
        $row = $result_client->fetch_assoc();
        $current_client = array(
            "name" => $row['FullName'],
            "status" => $row['loggedStatus'],
            "image" => $row['Photo'],
        );
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HIRE-OU-CHAT</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="chat-container">

        <div class="chat-card">
            <div class="chat-header">
                <div class="row">
                    <div class="content">

                        <img src="../uploads/EMPVH-6402d6fe08f7e.jpg" class="user_image" alt="Image" />


                        <div class="col-1">
                            <span class="user_name">ALI</span>
                            <p class="status_online">

                            </p>
                        </div>
                    </div>

                    <a href="../Contents/" class="logout"><i class="fa-solid fa-arrow-left" style="margin-right: 10px"></i>Back</a>
                </div>
            </div>

            <div class="chat-body-container area-chatting">

            </div>
            <div class="chat-footer">
                <div class="send-area">
                    <input cols="3" rows="3" class="message">
                    <button type="button" class="sendMessage"><i class="fa-solid fa-paper-plane"></i></button>
                    <button type="button"><i class="fa-solid fa-paperclip"></i></button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo $_GET['freelancer_code'] ?>" class="toUser">
    <input type="hidden" value="<?php echo $_SESSION['profile_id'] ?>" class="fromUser">

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
                    id: $(".toUser").val()
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

                      res.state=="Online"?
                       $(".status_online").html(`  <i class="fa-solid fa-signal" style="margin-right: 10px"></i>${res.state}`).css("color","rgb(71, 143, 71)")
                       :                        $(".status_online").html(`  <i class="fa-solid fa-signal" style="margin-right: 10px"></i>${res.state}`).css("color","red")
;
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
        $(".message").on("change",function(){
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
                    // fetchMessages()
                },
                error: (res) => {
                    console.log(res)
                }
            })
        })
    </script>

</body>

</html>