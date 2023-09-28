<?php
include '../connections/conn.php';
session_start();



class Tools extends Connections
{


    public function categories()
    {
        extract($_POST);

        $sql = "SELECT *from categories;";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
?>

            <option value="">Select Category</option>
            <?php
            while ($rows = $result->fetch_assoc()) {
            ?>
                <option value="<?php echo $rows['ID'] ?>"><?php echo $rows['Category'] ?></option>
            <?php
            }
        }
    }
    public function loadToolsFromCategories()
    {

        extract($_POST);

        $sql = "SELECT tools.ID, tools.tool,categories.Category FROM tools
        INNER JOIN categories
        ON tools.Category=categories.ID
        WHERE tools.Category='$id';";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
            ?>


            <?php
            while ($rows = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4 mb-2 col-sm-6 ">
                    <label class="bg-success p-1 rounded-2 text-light fw-lighter">
                        <input type="checkbox" value="<?php echo $rows['ID'] ?>" class="tools" name="tools">
                        <?php echo $rows['tool'] ?>

                    </label>
                </div>

            <?php
            }
        }
    }
    public function loadCate()
    {
        extract($_POST);

        $sql = "SELECT *from categories;";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
            ?>

            <option value="">Select Profession</option>
            <?php
            while ($rows = $result->fetch_assoc()) {
            ?>
                <option value="<?php echo $rows['ID'] ?>"><?php echo $rows['Category'] ?></option>
                <?php
            }
        }
    }
    public function loadSample()
    {
        extract($_POST);

        $sql = "CALL readCategories();";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($rows = $result->fetch_assoc()) {
                    if ($rows['Number'] != 0) {
                    ?>
    
                        <div class="col-lg-4 col-md-12 mb-3">
                            <a href="./category?cid=<?php echo $rows['Category'] ?>" class="text-decoration-none text-light">
    
                                <div class="card border-1 shadow-lg bg-success p-4">
                                    <div class="header-title">
                                        <h5 class="lead"><?php echo $rows['Category'] ?>'s</h5>
                                    </div>
                                    <div class="">
                                        <i class="fa-solid fa-user mx-2"></i><span> <?php echo $rows['Number'] ?> Talented Persons</span>
                                    </div>
                                </div>
                            </a>
    
                        </div>
    
                <?php
                    }
                }


            }else{
                ?>
<h5 class="lead">No Categories Available🤦‍♀️</h5>

                <?php
            }
           
        }
    }

    public function loadTools()
    {
        extract($_POST);

        $sql = "SELECT categories.Category as CateName, 
        ifnull(tools.ID,0) as ID, ifnull(tools.tool,'') as Tool FROM categories
        LEFT JOIN tools
        ON categories.ID=tools.Category;;";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
            ?>

            <div class="table-responsive">
                <table class="table table-hover table-bordered toolsTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#ID</th>

                            <th scope="col">Tools <i class="fa-solid fa-bolt"></i></th>
                            <th scope="col">Actions <i class="fa-brands fa-artstation"></i></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $row => $value) {
                            if ($value['ID'] != 0 && $value['Tool'] != "") {
                        ?>

                                <tr>
                                    <td><?php echo $value['ID'] ?></td>

                                    <td title="<?php echo $value['CateName'] ?>"><?php echo $value['Tool'] ?></td>

                                    <td>
                                        <a href="#=<?php echo $value['ID'] ?>" ID="<?php echo $value['ID'] ?>" class="btn btn-success edit"><i class="fa-regular fa-pen-to-square text-light"></i></a>
                                        <a href="#DeleteCurrentProject=<?php echo $value['ID'] ?>" ID="<?php echo $value['ID'] ?>" class="btn btn-danger delete"><i class="fa-solid fa-minus text-light"></i></a>
                                    </td>
                                </tr>


                        <?php
                            }
                        }

                        ?>



                    </tbody>
                </table>
            </div>



        <?php


        }

        // echo json_encode($response);
    }



    public function delete()
    {
        extract($_POST);
        $response = array();

        if ($type == "category") {
            $sql = "SELECT *FROM tools WHERE Category='$id';";
            $Users = new Tools();
            $result = $Users->connect()->query($sql);
            if ($result) {

                if (mysqli_num_rows($result) > 0)
                    $response = array("error" => "This Category Cannot BE Deleted Because One Or More Tools Depends On.");
                else {
                    $sql_deleteion = "DELETE FROM categories WHERE ID='$id';";
                    $Users = new Tools();
                    $result_del = $Users->connect()->query($sql_deleteion);
                    if ($result_del) {

                        $response = array("error" => "", "response" => "Category Has Been Deleted Successfully...");
                    }
                }
            }
        } else {
            $sql = "DELETE FROM tools WHERE ID='$id';";
            $Users = new Tools();
            $result = $Users->connect()->query($sql);
            if ($result) {


                $response = array("error" => "", "response" => "Tool Has Been Deleted Successfully...");
            }
        }

        echo json_encode($response);
    }
    public function getCategoryData()
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT *FROM categories WHERE ID='$id';";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {

            $row = $result->fetch_assoc();
            $response = array("response" => [
                "name" => $row['Category'],
                "id" => $row['ID'],
            ]);
        }

        echo json_encode($response);
    }
    public function getToolsData()
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT *FROM tools WHERE ID='$id';";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {

            $row = $result->fetch_assoc();
            $response = array("response" => [
                "category" => $row['Category'],
                "id" => $row['ID'],
                "toolName" => $row['tool'],
            ]);
        }

        echo json_encode($response);
    }
    public function updateCategory()
    {
        extract($_POST);
        $response = array();

        $sql = "UPDATE categories set Category='$category' WHERE ID='$target';";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
            $response = array("response" => "Category Was Updated Successfully");
        }

        echo json_encode($response);
    }
    public function updateTools()
    {
        extract($_POST);
        $response = array();

        $sql = "UPDATE tools set Category='$categoryID', tool='$tool' WHERE ID='$targetID';";
        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
            $response = array("response" => "Tools Was Updated Successfully");
        }

        echo json_encode($response);
    }
    private static function findDuplicate($target, $targetTable = "categories", $tool = '')
    {



        $Exist = false;
        if ($targetTable == "categories") {
            $sql = "select *from categories WHERE Category='$target';";
            $Users = new Tools();
            $result = $Users->connect()->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0)
                    $Exist = true;
            }
        } else if ($targetTable == "tools") {
            $sql = "select *from tools WHERE Category='$target' AND tool='$tool' ;";
            $Users = new Tools();
            $result = $Users->connect()->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0)
                    $Exist = true;
            }
        }


        return $Exist;
    }

    public function loadCategories()
    {
        extract($_POST);

        $sql = "SELECT *from categories;";

        $Users = new Tools();
        $result = $Users->connect()->query($sql);
        if ($result) {
        ?>

            <table class="table table-bordered categoriesTable">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Category</th>
                        <th scope="col">Number Of Tools <i class="fa-solid fa-bolt"></i></th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row => $value) {
                    ?>

                        <tr>
                            <td><?php echo $value['ID'] ?></td>
                            <td><?php echo $value['Category'] ?></td>
                            <?php

                            $sql_counter = "SELECT COUNT(*) as counter FROM `tools` WHERE Category='" . $value['ID'] . "';";
                            $Users = new Tools();
                            $result_counter = $Users->connect()->query($sql_counter);
                            if ($result_counter) {
                                $row = $result_counter->fetch_assoc();
                            ?>
                                <td><?php echo $row['counter'] ?></td>

                            <?php
                            }

                            ?>




                            <td>


                                <a href="#=<?php echo $value['ID'] ?>" ID="<?php echo $value['ID'] ?>" class="btn btn-success edit"><i class="fa-regular fa-pen-to-square text-light"></i></a>
                                <a href="#DeleteCurrentProject=<?php echo $value['ID'] ?>" ID="<?php echo $value['ID'] ?>" class="btn btn-danger delete"><i class="fa-solid fa-minus text-light"></i></a>
                            </td>

                        <?php

                    }

                        ?>



                </tbody>
            </table>



<?php


        }

        // echo json_encode($response);
    }


    private static function setOnline($id)
    {
        //SETTING AND UPADTING USERS CURRENT STATUS
        $sql = "UPDATE users SET loggedStatus='Online' where USERID='$id';";
        $Tools = new Tools();
        $result = $Tools->connect()->query($sql);
        if (!$result)
            return;
    }
    public static function saveCategory()
    {
        //SETTING AND UPADTING USERS CURRENT STATUS
        extract($_POST);

        $arrayCategory = explode(",", $category);
        $response = array();
        $conn = new Tools();
        $error = "";
        for ($index = 0; $index < count($arrayCategory); $index++) {
            if (Tools::findDuplicate($arrayCategory[$index])) {
                $error = "Duplication Signal Detected. [" . $arrayCategory[$index] . "] Already Exist, This And All Below Actions Cannot Be Executed";
                break;
            } else {
                $id = rand(1000, 9999) . "C";
                $sql = "INSERT INTO categories Values('$id','$arrayCategory[$index]');";
                $result = $conn->connect()->query($sql);
                if (!$result) {
                    $error = $conn->connect()->error;
                    break;
                }
            }
        }

        $response = array("error" => $error, "response" => "All Categories has been saved...");

        echo json_encode($response);
    }
    public static function saveTools()
    {
        //SETTING AND UPADTING USERS CURRENT STATUS
        extract($_POST);
        $toolsCategory = explode(",", $tools);

        $response = array();
        $conn = new Tools();
        $error = "";
        for ($index = 0; $index < count($toolsCategory); $index++) {

            if (Tools::findDuplicate($id, "tools", $toolsCategory[$index])) {
                $error = "Duplication Signal Detected. [" . $toolsCategory[$index] . "] Already Exist for The Specified Category, This And All Below Actions Cannot Be Executed";
                break;
            } else {
                $sql = "INSERT INTO tools(`Category`,`tool`) Values('$id','$toolsCategory[$index]');";
                $result = $conn->connect()->query($sql);
                if (!$result) {
                    $error = $conn->connect()->error;
                    break;
                }
            }
        }

        $response = array("error" => $error, "response" => "All Tools has been saved...");

        echo json_encode($response);
    }
    public  function setOffline()
    {
        //SETTING AND UPADTING USERS CURRENT STATUS
        $id = $_SESSION['profile_id'];
        $sql = "UPDATE users SET loggedStatus='Offline' where USERID='$id';";
        $Tools = new Tools();
        $response = array();
        $result = $Tools->connect()->query($sql);
        if ($result) {
            $response = array("error" => "");
            session_unset();
            session_destroy();
            // exit();
        }
        $response = array("error" => $Tools->connect()->error);
        echo json_encode($response);
    }
    public function findUser()
    {
        extract($_POST);
        $response = array();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            // response checking method 
            $response = array("error" => "Invalid Email Format Address");
        else {
            $sql = "SELECT *FROM Users where Email ='$emauil' AND Password='$password';";
            $Tools = new Tools();
            $result = $Tools->connect()->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = $result->fetch_assoc();
                    Tools::setOnline($row['USERID']);
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
    public function Register()
    {
        extract($_POST);
        $Tools = new Tools();
        $response = array();
        if ($type == "Employer Profile") {
            if ($imageAvailable == "No") {

                $fileName = "../images/default.jpg";
                $file = explode("/", $fileName);
                $actualName = $file[2];
                $employerID = uniqid("EMPVH-");
                $sql = "CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','$actualName');";
                $result = $Tools->connect()->query($sql);
                if ($result)
                    $response = array("response" => "Your Account Has Been Configured.😊");
                else
                    $response = array("response" => $Tools->connect()->error);
            } else {
                $employerID = uniqid("EMPVH-");
                $tempFile = $_FILES['profile']['tmp_name'];
                $file_name = $_FILES['profile']['name'];
                $extension = explode(".", $file_name);
                $actualExt = $extension[1];
                $actualUserProfile = $employerID . "." . $actualExt;
                $uploadFile = "../uploads/" . $actualUserProfile;


                $sql = "CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','$actualUserProfile');";
                $result = $Tools->connect()->query($sql);
                if ($result) {
                    move_uploaded_file($tempFile, $uploadFile);
                    $response = array("response" => "Your Account Has Been Configured.😊");
                } else
                    $response = array("response" => $Tools->connect()->error);
            }
        } else if ($type == "Employee Profile") {
        }
        echo json_encode($response);
    }
    public function loadAccountTypes()
    {
        $conn = new Tools();
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
}

$action = $_POST['action'];
if (isset($action)) {
    $api = new Tools();
    $api->$action();
}

?>