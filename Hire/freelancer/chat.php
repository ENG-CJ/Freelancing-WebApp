<?php
include('../connections/conn.php');
session_start();
if (!isset($_SESSION['profile_id'])) {
  header("location: ../index");
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
            <?php

            if ($current_client['image'] == "default.jpg") {
            ?>
              <img src="../images/<?php echo $current_client['image'] ?>" alt="Image" />
            <?php
            } else {
            ?>
              <img src="../uploads/<?php echo $current_client['image'] ?>" alt="Image" />
            <?php
            }
            ?>
            <!-- <img src="../uploads/<?php echo $current_client['image'] ?>" alt="Image" /> -->
            <div class="col-1">
              <span class="user_name"><?php echo $current_client['name'] ?></span>
              <p class="status_online">
                <i class="fa-solid fa-signal" style="margin-right: 10px"></i>Online
              </p>
            </div>
          </div>

          <a href="../Contents/" class="logout"><i class="fa-solid fa-arrow-left" style="margin-right: 10px"></i>Back</a>
        </div>
      </div>

      <div class="chat-body">
        <?php
        if (count($freelancers) == 0) {
        ?>
          <div class="error-message" style="text-align: center; margin-top: 100px; color: gray">
            <p>Freelancers Your Hired Will Appear Here😊</p>
          </div>
        <?php
        } else {
        ?>

          <div class="users_container">
            <div class="row_users">
              <?php
              foreach ($freelancers as $row => $values) {
              ?>

    <a href="./DCChannel.php?freelancer_code=<?php echo $values['id']?>" style="text-decoration: none">
    <div class="content" style="margin-bottom: 20px;">
                  <div class="user-details">
                    <img src="../uploads/<?php echo $values['image'] ?>" />
                    <div>
                      <span class="user_name"><?php echo $values['username'] ?></span>
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
      <div class="chat-footer">
        <div class="footer">
          <p>
            <i class="fa-solid fa-circle-info" style="margin-right: 10px"></i>Freelancers That you hired Appears Here And You Can Chat Directly
            By Clicking Their Username
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>

  
  </script>
</body>

</html>



