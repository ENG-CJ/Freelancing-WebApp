<?php
include '../connections/conn.php';
session_start();



class Profile extends Connections
{

    private static string $updateFile = "";
    public function findUser()
    {
        extract($_POST);
        $response = array();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $response = array("error" => "Invalid Email Format Address");
        else {
            $sql = "SELECT *FROM Users where Email ='$email' AND Password='$password';";
            $signup = new Profile();
            $result = $signup->connect()->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['profile_id'] = $row['USERID'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['fullName'] = $row['FullName'];
                    $_SESSION['img'] = $row['Photo'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['type'] = $row['AccountType'];
                    $response = array("error" => "", "userType" => $_SESSION['type']);
                } else
                    $response = array("error" => "Incorrect Email Address Or Password");
            }
        }
        echo json_encode($response);
    }


    public function changePass()
    {
        extract($_POST);
        $response = array();
        if (Profile::GetOldPassword($oldPass, $id)) {
            if ($new == $oldPass)
                $response = array("error" => "New Password Cannot Same As Old Password...");
            else {
                $sql = "UPDATE users SET Password='$new' where USERID='$id';";
                $conn = new Profile();

                $Result = $conn->connect()->query($sql);
                if ($Result) {
                    $response = array("error" => "", "response" => "Your Security Info has Been Changed..");
                } else
                    $response = array("error" => $conn->connect()->error);
            }
        } else {
            $response = array("error" => "Incorrect Current Password Plz Provide Your Current Passwod To Proceed This Step");
        }

        echo json_encode($response);
    }
    public function disableAccount()
    {
        extract($_POST);
        $response = array();

        $sql = "UPDATE users SET AccountStatus='Blocked' where USERID='$id';";
        $conn = new Profile();

        $Result = $conn->connect()->query($sql);
        if ($Result) {
            session_unset();
            session_destroy();
            $response = array("error" => "", "response" => "Your Account Has Been Disabled You're No Longer This Account");
        } else
            $response = array("error" => $conn->connect()->error);


        echo json_encode($response);
    }


    public function updateProfile()
    {
        extract($_POST);
        $signup = new Profile();
        $response = array();
        if ($available == "No") {



            $sql = "UPDATE users SET FullName='$name', Email='$email',Mobile='$mobile' WHERE USERID='$user';";
            $result = $signup->connect()->query($sql);
            if ($result)
                $response = array("error" => "", "response" => "Your Profile Has Been Updated.😊");
            else
                $response = array("error" => $signup->connect()->error);
        } else {
            // search file exits 
            $fileName = $_FILES['img']['name'];
            $tmp = $_FILES['img']['tmp_name'];
            $extension = explode(".", $fileName);
            $actualExt = $extension[1];
            $actualName = $_SESSION['profile_id'] . "." . $actualExt;
            $path = "../uploads/" . $actualName;
            if (file_exists($path)) {
                if (unlink($path)) {
                    move_uploaded_file($tmp, $path);
                    $sql = "UPDATE users SET FullName='$name', Email='$email',Mobile='$mobile',Photo='$actualName' WHERE USERID='$user';";
                    $result = $signup->connect()->query($sql);
                    if ($result)
                        $response = array("error" => "", "response" => "Your Profile Has Been Updated.😊");
                    else
                        $response = array("error" => $signup->connect()->error);
                }
            } else {

                // if not exits
                if (Profile::readUserImage()) {
                    if (unlink(Profile::$updateFile)) {
                        $fileName = $_FILES['img']['name'];
                        $tmp = $_FILES['img']['tmp_name'];
                        $extension = explode(".", $fileName);
                        $actualExt = $extension[1];
                        $actualName = $_SESSION['profile_id'] . "." . $actualExt;
                        $path = "../uploads/" . $actualName;


                        move_uploaded_file($tmp, $path);
                        $sql = "UPDATE users SET FullName='$name', Email='$email',Mobile='$mobile',Photo='$actualName' WHERE USERID='$user';";
                        $result = $signup->connect()->query($sql);
                        if ($result)
                            $response = array("error" => "", "response" => "Your Profile Has Been Updated.😊");
                        else
                            $response = array("error" => $signup->connect()->error);
                    }
                } else {
                    $fileName = $_FILES['img']['name'];
                    $tmp = $_FILES['img']['tmp_name'];
                    $extension = explode(".", $fileName);
                    $actualExt = $extension[1];
                    $actualName = $_SESSION['profile_id'] . "." . $actualExt;
                    $path = "../uploads/" . $actualName;


                    move_uploaded_file($tmp, $path);
                    $sql = "UPDATE users SET FullName='$name', Email='$email',Mobile='$mobile',Photo='$actualName' WHERE USERID='$user';";
                    $result = $signup->connect()->query($sql);
                    if ($result)
                        $response = array("error" => "", "response" => "Your Profile Has Been Updated.😊");
                    else
                        $response = array("error" => $signup->connect()->error);
                }
            }
        }


        echo json_encode($response);
    }

    private static function readUserImage()
    {
        $id = $_SESSION["profile_id"];
        $sql = "SELECT Photo from users where USERID='$id';";
        $conn = new Profile();
        $file = "";
        $Result = $conn->connect()->query($sql);
        if ($Result) {
            $row = $Result->fetch_assoc();
            Profile::$updateFile = "../uploads/" . $row['Photo'];
            if (file_exists(Profile::$updateFile))
                return true;
        } else {
            return false;
        }

        return false;
    }
    private static function GetOldPassword($password, $userID)
    {
        $id = $_SESSION["profile_id"];
        $sql = "SELECT Password from users where USERID='$userID';";
        $conn = new Profile();
        $file = "";
        $Result = $conn->connect()->query($sql);
        if ($Result) {
            if (mysqli_num_rows($Result) > 0) {
                $row = $Result->fetch_assoc();
                if ($password == $row['Password'])
                    return true;
            }
        } else {
            return false;
        }

        return false;
    }
    public function loadAccountTypes()
    {
        $conn = new Profile();
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







    // for testing api
    private static function getReturnNoValue($password, $userID)
    {
        $id = $_SESSION["profile_id"];
        $sql = "SELECT Password from tools where experiencefreelancers.category='';";
        $conn = new Profile();
        $file = "";
        $Result = $conn->connect()->query($sql);
        if ($Result) {
            if (mysqli_num_rows($Result) > 0) {
                $row = $Result->fetch_assoc();
                if ($password == $row['Password'])
                    return true;
            }
        } else {
            return false;
        }

        return false;
    }


    public function isLoggedOrCookie($currentUser)
    {
        $user = new Profile();
        $responseArray = array();
        $sql = "SELECT *FROM tool inner join categories on tool.categoryID=categories.ID";
        $connQuery = $user->connect()->query($sql);
        if ($connQuery) {

            $error = "";
            while ($rows = $connQuery->fetch_assoc()) {
                $responseArray[] = array(
                    "username" => $rows['Username'],
                    "Email" => $rows['Email'],
                    "Photo" => $rows['Photo'],
                    "ToolID" => $rows['toolID'],
                    "isAvailable" => true
                );
            }
            $responseArray["Error"] = "No Error Occured, Valid is Passed...";
        } else
            $responseArray = array("Error" => "Something went wrong. error said: " . $user->connect()->error);

        echo json_encode($responseArray);
    }


    // cookie
    public function findCookie()
    {
        extract($_POST);
        $response = array();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $response = array("error" => "Invalid Email Format Address");
        else {
            $sql = "SELECT *FROM experiencefreelancers
                    LEFT JOIN tools
                    ON experiencefreelancers.toolID=tools.ID
                    LEFT JOIN categories ON
                    experiencefreelancers.category=categories.ID
                    LEFT JOIN users
                    ON experiencefreelancers.freelancerID=users.USERID
                    WHERE experiencefreelancers.freelancerID='EMPVH-64071be02307e';
            
            ";
            $signup = new Profile();
            $result = $signup->connect()->query($sql);
            if ($result) {
                $error = "";
                while ($rows = $connQuery->fetch_assoc()) {
                    $response[] = array(
                       "FREELANCER-ID"=>$rows['freelancerID'],
                       "category"=>$rows['categoryID'],
                       "Description"=>$rows['Description'],
                       "name"=>$rows['FullName'],
                       "Mobile"=>$rows['Mobile'],
                       "Tool"=>$rows['toolID'],
                       "isAvailable"=>"Yes"
                    );
                }
                $responseArray["Error"] = "No Error Occured, Valid is Passed...";
            }
            else
            $responseArray["Error"] = "No Error Occured, Valid is Passed...";
        }
        echo json_encode($response);
    }
}

$action = $_POST['action'];
if (isset($action)) {
    $api = new Profile();
    $api->$action();
}
