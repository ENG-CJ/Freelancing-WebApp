<?php
include '../connections/conn.php';
session_start();



class Users extends Connections
{

    private static function setOnline($id)
    {
        $sql = "UPDATE users SET loggedStatus='Online' where USERID='$id';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if (!$result)
            return;
    }
    public static function activate()
    {
        extract($_POST);
        $response = array();
        $sql = "UPDATE users SET AccountStatus='$state' where USERID='$id';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if ($result)
            $response = array("response" => "This Account Has Been Blocked From The System");
        else
            $response = array("response" => $Users->connect()->error);
        echo json_encode($response);
    }
    public  function setOffline()
    {
        $id = $_SESSION['profile_id'];
        $sql = "UPDATE users SET loggedStatus='Offline' where USERID='$id';";
        $Users = new Users();
        $response = array();
        $result = $Users->connect()->query($sql);
        if ($result) {
            $response = array("error" => "");
            session_unset();
            session_destroy();
            // exit();
        }
        $response = array("error" => $Users->connect()->error);
        echo json_encode($response);
    }
    public function findUser()
    {
        extract($_POST);
        $response = array();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $response = array("error" => "Invalid Email Format Address");
        else {
            $sql = "SELECT *FROM Users where Email ='$email' AND Password='$password';";
            $Users = new Users();
            $result = $Users->connect()->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = $result->fetch_assoc();
                    Users::setOnline($row['USERID']);
                    $_SESSION['profile_id'] = $row['USERID'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['fullName'] = $row['FullName'];
                    $_SESSION['img'] = $row['Photo'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['type'] = $row['AccountType'];
                    $_SESSION['state'] = $row['AccountStatus'];
                    $response = array("error" => "", "userType" => $_SESSION['type'], "state" => $_SESSION['state']);
                } else
                    $response = array("error" => "Incorrect Email Address Or Password");
            }
        }
        echo json_encode($response);
    }
    public function details()
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT *FROM Users where USERID ='$id';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if ($result) {
            while ($rows = $result->fetch_assoc()) {
                $response = array(
                    "response" => $rows
                );
            }
        }

        echo json_encode($response);
    }
    private static function isExistUserOrEmail($targetValue, $isUsername = true)
    {
        extract($_POST);
        $response = array();
        $isExist = false;
        if ($isUsername) {
            $sql = "SELECT *FROM Users where Username ='$targetValue';";
            $Users = new Users();
            $result = $Users->connect()->query($sql);
            if ($result) {
                mysqli_num_rows($result) > 0 ? $isExist = true : $isExist = false;
            }
        } else {
            $sql = "SELECT *FROM Users where Email ='$targetValue';";
            $Users = new Users();
            $result = $Users->connect()->query($sql);
            if ($result) {
                mysqli_num_rows($result) > 0 ? $isExist = true : $isExist = false;
            }
        }

        return $isExist;
    }
    public function Register()
    {
        extract($_POST);
        $Users = new Users();
        $response = array();
        if ($type == "Employer Profile") {
            if ($imageAvailable == "No") {

                $fileName = "../images/default.jpg";
                $file = explode("/", $fileName);
                $actualName = $file[2];
                $employerID = uniqid("EMPVH-");
                $sql = "CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','$actualName');";
                $result = $Users->connect()->query($sql);
                if ($result)
                    $response = array("response" => "Your Account Has Been Configured.😊");
                else
                    $response = array("response" => $Users->connect()->error);
            } else {
                $employerID = uniqid("EMPVH-");
                $tempFile = $_FILES['profile']['tmp_name'];
                $file_name = $_FILES['profile']['name'];
                $extension = explode(".", $file_name);
                $actualExt = $extension[1];
                $actualUserProfile = $employerID . "." . $actualExt;
                $uploadFile = "../uploads/" . $actualUserProfile;


                $sql = "CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','$actualUserProfile');";
                $result = $Users->connect()->query($sql);
                if ($result) {
                    move_uploaded_file($tempFile, $uploadFile);
                    $response = array("response" => "Your Account Has Been Configured.😊");
                } else
                    $response = array("response" => $Users->connect()->error);
            }
        } else if ($type == "Admin") {



            if ($imageAvailable == "No") {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                    $response = array("error" => "You Provided Invalid Email Format Plz Make Sure The Email.");
                else if (Users::isExistUserOrEmail($username))
                    $response = array("error" => "This Username Already Taken.");
                else if (Users::isExistUserOrEmail($email, false))
                    $response = array("error" => "This Email Address Already Taken.");

                else {
                    $fileName = "../images/default.jpg";
                    $file = explode("/", $fileName);
                    $actualName = $file[2];
                    $employerID = uniqid("EMPVH-");
                    $sql = "CALL add_user('$employerID','$name','$username','000','$email','$password','$type','Active','NoDes','null','null','null','$actualName');";
                    $result = $Users->connect()->query($sql);
                    if ($result)
                        $response = array("response" => "User Has been Created Successfully.😊", "error" => "");
                    else
                        $response = array("response" => $Users->connect()->error);
                }
            } else {
                $tempFile = $_FILES['profile']['tmp_name'];
                $file_name = $_FILES['profile']['name'];
                $extension = explode(".", $file_name);
                $actualExt = $extension[1];
                $extensions = ['jpg', 'png', 'jpeg'];

                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                    $response = array("error" => "You Provided Invalid Email Format Plz Make Sure The Email.");
                else if (Users::isExistUserOrEmail($username))
                    $response = array("error" => "This Username Already Taken.");
                else if (Users::isExistUserOrEmail($email, false))
                    $response = array("error" => "This Email Address Already Taken.");
                else if (!in_array(strtolower($actualExt), $extensions))
                    $response = array("error" => "Invalid Image Format. Plz Provide PNG OR JPG File");


                else {
                    $employerID = uniqid("EMPVH-");

                    $actualUserProfile = $employerID . "." . $actualExt;
                    $uploadFile = "../uploads/" . $actualUserProfile;
                    $sql = "CALL add_user('$employerID','$name','$username','000','$email','$password','$type','Active','NoDes','null','null','null','$actualUserProfile');";


                    // $sql = "CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','$actualUserProfile');";
                    $result = $Users->connect()->query($sql);
                    if ($result) {
                        move_uploaded_file($tempFile, $uploadFile);
                        $response = array("response" => "User Has been Created Successfully.😊", "error" => "");
                    } else
                        $response = array("response" => $Users->connect()->error);
                }
            }
        }
        echo json_encode($response);
    }
    public function loadAccountTypes()
    {
        $conn = new Users();
        $response = array();
        if ($conn->connect()->connect_error)
            $response = array("State" => false, "error" => $conn->connect()->error);

        $sql = "SELECT Type from accounttypes;";
        $Result = $conn->connect()->query($sql);
        if ($Result) {
            while ($rows = $Result->fetch_assoc()) {
                $response[] = array("Data" => $rows['Type']);
            }
        } else {
            $response = array("State" => false, "error" => $conn->connect()->error);
        }

        echo json_encode($response);
    }



    public function countOnlineUsers()
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT loggedStatus FROM `users` WHERE loggedStatus='Online';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if ($result) {
            $n = mysqli_num_rows($result);
            $response = array("number" => $n);
        }
        echo json_encode($response);
    }
    public function countOfflineUsers()
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT loggedStatus FROM `users` WHERE loggedStatus='Offline' || loggedStatus='';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if ($result) {
            $n = mysqli_num_rows($result);
            $response = array("number" => $n);
        }
        echo json_encode($response);
    }
    public function delete()
    {
        extract($_POST);
        $response = array();

        $sql = "DELETE FROM users WHERE USERID='$id';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if ($result) {

            $response = array("response" => "User Has Been Deleted Successfully...");
        }
        echo json_encode($response);
    }
    public function Update()
    {
        extract($_POST);
        $response = array();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $response = array("error" => "Invalid Email Format.Plz Make Sure The Email.");
        else {
            $sql = "UPDATE users set FullName='$name', Username='$username', Email='$email' WHERE USERID='$id';";
            $Users = new Users();
            $result = $Users->connect()->query($sql);
            if ($result) {

                $response = array("error" => "", "response" => "User Has Been Updated Successfully...");
            }
        }

        echo json_encode($response);
    }

    public static function CheckEmailExistence()
    {
        extract($_POST);
        $response = array();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $response = array("error" => "Invalid Email Format.", "status" => true);
        else {
            $sql = "select *from users WHERE Email='$email';";
            $Users = new Users();
            $result = $Users->connect()->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0)
                    $response = array("valid" => true, "error" => "", "response" => "This Email Already Taken. Choose new One");

                else
                    $response = array("valid" => false, "error" => "");
            }
        }

        echo json_encode($response);
    }
    public static function CheckUserExistence()
    {
        extract($_POST);
        $response = array();


        $sql = "select *from users WHERE Username='$username';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0)
                $response = array("valid" => true, "error" => "", "response" => "This Username Already Taken. Choose new One");

            else
                $response = array("valid" => false, "error" => "");
        }


        echo json_encode($response);
    }

    public function loadUsers()
    {
        extract($_POST);

        $sql = "SELECT *from users WHERE USERID!='@MainAdmn';";
        $Users = new Users();
        $result = $Users->connect()->query($sql);
        if ($result) {
?>

            <div class="">
                <table class="table table-bordered usersTable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Username</th>

                            <th scope="col">Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Current</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $row => $value) {
                        ?>

                            <tr>
                                <td><?php echo $value['USERID'] ?></td>

                                <td><?php echo $value['Username'] ?></td>

                                <td><?php echo $value['AccountType'] ?></td>
                                <?php
                                if ($value['AccountStatus'] == "Active") {
                                ?>
                                    <td><label activateID="<?php echo $value['USERID'] ?>" class="btn btn-success p-2 text-light activate"><?php echo $value['AccountStatus'] ?></label></td>
                                <?php

                                } else {
                                ?>
                                    <td><label activateID="<?php echo $value['USERID'] ?>" class="btn btn-danger p-2 text-light activate"><?php echo $value['AccountStatus'] ?></label></td>
                                <?php
                                }



                                ?>

                                <?php
                                if ($value['loggedStatus'] == "Online") {
                                ?>
                                    <!-- <td><label class="btn btn-success p-2 text-light"><img src="../images/online.png" class="img-fluid w-25"> <?php echo $value['loggedStatus'] ?></label></td> -->
                                    <td class="text-success" style="font-size: 16px"><i class="fa-solid fa-signal mr-1 text-success"></i>Online</td>
                                <?php
                                } else if ($value['loggedStatus'] == "Offline") {
                                ?>
                                    <td class="text-danger" style="font-size: 16px"><i class="fa-solid fa-signal mr-1 text-danger"></i>Offline</td>
                                <?php
                                } else if ($value['loggedStatus'] == "") {
                                ?>
                                    <td class="text-danger" style="font-size: 16px"><i class="fa-solid fa-signal mr-1 text-danger"></i>Offline</td>
                                <?php
                                }
                                ?>

                                <?php

                                if ($value['AccountType'] == "Admin") {
                                ?>
                                    <td>

                                        <a href="#UpdateCurrentProject=<?php echo $value['USERID'] ?>" userID="<?php echo $value['USERID'] ?>" class="btn btn-success edit"><i class="fa-regular fa-pen-to-square text-light"></i></a>
                                        <a href="#DeleteCurrentProject=<?php echo $value['USERID'] ?>" userID="<?php echo $value['USERID'] ?>" class="btn btn-danger delete"><i class="fa-solid fa-minus text-light"></i></a>
                                        <a class="btn btn-secondary detail mt-2" userID="<?php echo $value['USERID'] ?>"><i class="fa-solid fa-circle-info text-light"></i></a>
                                    </td>



                                <?php
                                } else {
                                ?>
                                    <td>

                                        <!-- <a  href="#UpdateCurrentProject=<?php echo $value['USERID'] ?>" userID="<?php echo $value['USERID'] ?>" class="btn btn-success update"><i class="fa-regular fa-pen-to-square text-light"></i></a> -->
                                        <a href="#DeleteCurrentProject=<?php echo $value['USERID'] ?>" userID="<?php echo $value['USERID'] ?>" class="btn btn-danger delete"><i class="fa-solid fa-minus text-light"></i></a>
                                        <a class="btn btn-secondary detail mt-1" userID="<?php echo $value['USERID'] ?>"><i class="fa-solid fa-circle-info text-light"></i></a>
                                    </td>


                                <?php
                                }
                                ?>
                            </tr>



                        <?php
                        }

                        ?>



                    </tbody>
                </table>
            </div>





<?php


        }

        // echo json_encode($response);
    }
}

$action = $_POST['action'];
if (isset($action)) {

    $api = new Users();
    $api->$action();
}
