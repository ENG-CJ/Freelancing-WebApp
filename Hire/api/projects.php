<?php
include '../connections/conn.php';
session_start();



class Project extends Connections
{

    public function deleteProject()
    {
        extract($_POST);

        $conn = new Project();

        $sql = "DELETE FROM projects WHERE ID='$id';";
        $result = $conn->connect()->query($sql);
        $response = array();
        if ($result) {
            $response = array("error" => "", "response" => "Project was Removed Successfully");
        } else
            $response = array("error" => "", "response" => $conn->connect()->error);
        echo json_encode($response);
    }

    public function getProject()
    {
        extract($_POST);

        $conn = new Project();

        $sql = "SELECT *FROM Projects where ID='$id';";
        $result = $conn->connect()->query($sql);
        $response = array();
        $id_owner=$_SESSION['profile_id'];
        $sql_number_ofPurchased = "SELECT COUNT(transactions.ItemID) as counter FROM `transactions` 
                                    JOIN projects on transactions.ItemID=projects.ID
                                    JOIN users ON projects.Owner=users.USERID
                                    WHERE projects.Owner='$id_owner' AND transactions.ItemID='$id';";

        $result_purchased = $conn->connect()->query($sql_number_ofPurchased);
        if ($result) {
            $row = $result->fetch_assoc();
            $count= $result_purchased->fetch_assoc();
            $response = array("response" => [
                "id" => $row['ID'],
                "name" => $row['ProjectName'],
                "category" => $row['projectCategory'],
                "description" => $row['Description'],
                "moreDescription" => $row['MoreDescription'],
                "type" => $row['ProjectType'],
                "price" => $row['ProjectPrice'],
                "fromPrice" => $row['FromPrice'],
                "poster" => $row['Poster'],
                "demoVideo" => $row['ProjectVideo'],
                "count"=> $count['counter']
            ]);
        } else
            $response = array("error" => "", "response" => $conn->connect()->error);
        echo json_encode($response);
    }
    public function readAllProjects()
    {
        extract($_POST);

        $conn = new Project();

        $sql = "SELECT users.USERID,users.FullName,users.Photo,ID,ProjectName,projectCategory,ProjectType,ProjectPrice,
        ProjectVideo,MoreDescription,Poster,projects.Description  FROM projects
        INNER JOIN users ON projects.Owner=users.USERID WHERE ProjectType='Priced';";
        $result = $conn->connect()->query($sql);
        $response = array();
        $category = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $sql_3 = "SELECT categories.Category FROM categories LEFT JOIN experiencefreelancers on categories.ID=experiencefreelancers.category
                where experiencefreelancers.freelancerID='" . $row['USERID'] . "' LIMIT 1;";
                $result_3 = $conn->connect()->query($sql_3);
                while ($row_categories = $result_3->fetch_assoc()) {
                    $category = array("dev_category" => $row_categories['Category']);
                }
                $response[] = array("response" => [
                    "project_details" => [
                        "projectID" => $row['ID'],
                        "projectName" => $row['ProjectName'],
                        "category" => $row['projectCategory'],
                        "type" => $row['ProjectType'],
                        "Price" => $row['ProjectPrice'],
                        "ProjectVideo" => $row['ProjectVideo'],
                        "poster" => $row['Poster'],
                        "Description" => $row['Description'],
                        "MoreDescription" => $row['MoreDescription'],
                    ],
                    "developer_details" => [
                        "fullName" => $row['FullName'],
                        "id" => $row['USERID'],
                        "Photo" => $row['Photo'],
                        "category" => $category

                    ],



                ]);
            }
        } else
            $response = array("error" => "", "response" => $conn->connect()->error);
        echo json_encode($response);
    }
    public function filterProjects()
    {
        extract($_POST);

        $conn = new Project();

        $sql = "SELECT users.USERID,users.FullName,users.Photo,ID,ProjectName,projectCategory,ProjectType,ProjectPrice,
        ProjectVideo,Poster,projects.Description  FROM projects
        INNER JOIN users ON projects.Owner=users.USERID WHERE ProjectType='Priced' && projectCategory='$category';";
        $result = $conn->connect()->query($sql);
        $response = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $sql_3 = "SELECT categories.Category FROM categories LEFT JOIN experiencefreelancers on categories.ID=experiencefreelancers.category
                where experiencefreelancers.freelancerID='" . $row['USERID'] . "' LIMIT 1;";
                $result_3 = $conn->connect()->query($sql_3);
                while ($row_categories = $result_3->fetch_assoc()) {
                    $category = array("dev_category" => $row_categories['Category']);
                }
                $response[] = array("response" => [
                    "project_details" => [
                        "projectID" => $row['ID'],
                        "projectName" => $row['ProjectName'],
                        "category" => $row['projectCategory'],
                        "type" => $row['ProjectType'],
                        "Price" => $row['ProjectPrice'],
                        "ProjectVideo" => $row['ProjectVideo'],
                        "poster" => $row['Poster'],
                        "Description" => $row['Description'],
                    ],
                    "developer_details" => [
                        "fullName" => $row['FullName'],
                        "id" => $row['USERID'],
                        "Photo" => $row['Photo'],
                        "category" => $category

                    ],


                ]);
            }
        } else
            $response = array("error" => "", "response" => $conn->connect()->error);
        echo json_encode($response);
    }


    public function getTransactionDetails()
    {
        extract($_POST);

        $conn = new Project();

        $sql = "SELECT *FROM transactions
        JOIN projects ON transactions.ItemID=projects.ID
        JOIN users ON transactions.ClientID=users.USERID
        WHERE transactions.ClientID='" . $_SESSION['profile_id'] . "' AND  transactions.paymentID='$id';";
        $result = $conn->connect()->query($sql);
        $response = array();
        if ($result) {
            $row = $result->fetch_assoc();
            $response = array("response" => [
                "paymentID" => $row['paymentID'],
                "session" => $row['SessionID'],
                "amount" => $row['amount'],
                "currency" => $row['currency'],
                "status" => $row['Status'],
                "PaymentMethod" => $row['PaymentMethod'],
                "Date" => $row['CreatedDate'],

                "Item_details" => [
                    "itemID" => $row['ItemID'],
                    "itemName" => $row['ProjectName'],
                    "Description" => $row['Description'],
                    "OwnerCode" => $row['Owner'],
                ],
                "client_details" => [
                    "clientID" => $row['ClientID'],
                    "name" => $row['FullName'],
                    "mobile" => $row['Mobile'],
                    "email" => $row['Email'],
                    "photo" => $row['Photo'],
                ],
                "customer_details" => [

                    "customer_name" => $row['customer_name'],
                    "customer_email" => $row['customer_email'],
                    "customer_phone" => $row['customer_phone'],
                ],
                "poster" => $row['Poster'],
                "demoVideo" => $row['ProjectVideo'],
            ]);
        } else
            $response = array("error" => "", "response" => $conn->connect()->error);
        echo json_encode($response);
    }
    public function getTransactions()
    {
        extract($_POST);

        $conn = new Project();

        $sql = "SELECT *FROM transactions
        JOIN projects ON transactions.ItemID=projects.ID
        JOIN users ON transactions.ClientID=users.USERID
        WHERE transactions.ClientID='" . $_SESSION['profile_id'] . "'";
        $result = $conn->connect()->query($sql);
        $response = array();
        $totalAmount = 0;
        $mail = "";
        $name = "";
        if ($result) {

            // $totalAmount += $row['amount'];
?>

            <div class="logo">
                <img src="http://localhost/HireApp/Hire/Contents/hireHero.png" width="100%" />
            </div>


            <div class="mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Payment</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Project</th>
                            <th scope="col">Method</th>
                            <th scope="col">Owner Code</th>
                            <th scope="col">Purchased At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $totalAmount += $row['amount'];
                            $mail = $row['Email'];
                            $name = $row['FullName'];
                        ?>
                            <tr>
                                <td scope="row"><?php echo $row['paymentID'] ?></td>
                                <td scope="row">$<?php echo $row['amount'] ?>.00</td>
                                <td scope="row"><?php echo $row['ProjectName'] ?></td>
                                <td scope="row"><?php echo $row['PaymentMethod'] ?></td>
                                <td scope="row"><?php echo $row['Owner'] ?></td>
                                <td scope="row"><?php echo $row['CreatedDate'] ?></td>

                            </tr>

                        <?php

                        }

                        ?>



                    </tbody>
                </table>
            </div>

            <div class="other mt-3">
                <span>Total: <strong>$<?php echo number_format($totalAmount) ?></strong></span>
                <div class="description-text mt-3">


                    <p class="text-muted">This Transaction is Encoded By @ENG-CJ And Assigned The Email Reference- <strong> <?php echo $mail ?></strong> And Client Registered Name- <strong><?php echo $name ?></strong></p>
                </div>
            </div>


        <?php
            // $response= array("response" => [
            //     "paymentID" => $row['paymentID'],
            //     "session" => $row['SessionID'],
            //     "amount" => $row['amount'],
            //     "currency" => $row['currency'],
            //     "status" => $row['Status'],
            //     "PaymentMethod" => $row['PaymentMethod'],
            //     "Date" => $row['CreatedDate'],

            //     "Item_details" => [
            //         "itemID" => $row['ItemID'],
            //         "itemName" => $row['ProjectName'],
            //         "Description" => $row['Description'],
            //         "OwnerCode" => $row['Owner'],
            //     ],
            //     "client_details" => [
            //         "clientID" => $row['ClientID'],
            //         "name" => $row['FullName'],
            //         "mobile" => $row['Mobile'],
            //         "email" => $row['Email'],
            //         "photo" => $row['Photo'],
            //     ],
            //     "customer_details" => [

            //         "customer_name" => $row['customer_name'],
            //         "customer_email" => $row['customer_email'],
            //         "customer_phone" => $row['customer_phone'],
            //     ],
            //     "poster" => $row['Poster'],
            //     "demoVideo" => $row['ProjectVideo'],
            // ]);

            $response[] = array("error" => "", "total" => number_format($totalAmount));
        } else
            $response = array("error" => "true", "response" => $conn->connect()->error);
        // echo json_encode($response);
    }



    public function setupProject()
    {
        extract($_POST);
        $Project = new Project();
        $response = array();


        $projectID = uniqid("Pr-");
        $tempFile = $_FILES['project_poster']['tmp_name'];
        $file_name = $_FILES['project_poster']['name'];
        $extension = explode(".", $file_name);
        $actualExt = $extension[1];

        $tempFileProjectVideo = $_FILES['project_video']['tmp_name'];
        $projectVideoName = $_FILES['project_video']['name'];
        $projectVideoExtension = explode(".", $projectVideoName);
        $projectVideoActualExtension = $projectVideoExtension[1];


        $actualProjectPoster = $projectID . "." . $actualExt;
        $actualProjectVideo = $projectID . "." . $projectVideoActualExtension;
        $uploadFile = "../posters/" . $actualProjectPoster;
        $projectUploadPath = "../videos/" . $actualProjectVideo;


        $sql = "INSERT INTO projects VALUES('$projectID','$project_name','$project_category','$project_type','$project_description','$actualProjectPoster',
                '$moreDescription','$project_price','$project_from_price','$actualProjectVideo','$assigned');";
        $result = $Project->connect()->query($sql);
        if ($result) {
            move_uploaded_file($tempFile, $uploadFile);
            move_uploaded_file($tempFileProjectVideo, $projectUploadPath);
            $response = array("response" => "Your Project Has Been Configured.😊");
        } else
            $response = array("response" => $Project->connect()->error);



        echo json_encode($response);
    }
    public function updateProject()
    {
        extract($_POST);
        $Project = new Project();
        $response = array();

        if ($file == "No") {
            $sql = "UPDATE projects SET ProjectName='$project_name',projectCategory='$project_category',ProjectType='$project_type',Description='$description',
                MoreDescription='$moreDescription',ProjectPrice='$price_project',FromPrice='$from_price' WHERE ID='$id';";
            $result = $Project->connect()->query($sql);
            if ($result) {

                $response = array("response" => "Your Project Has Been Updated Successfully.😊");
            } else
                $response = array("response" => $Project->connect()->error);
        } else   if ($file == "yes" && $poster_available == "yes") {

            $tempFile = $_FILES['poster']['tmp_name'];
            $file_name = $_FILES['poster']['name'];
            $extension = explode(".", $file_name);
            $actualExt = $extension[1];

            $path = "../posters/" . $id . "." . strtolower($actualExt);
            $updatedPosterName = $id . "." . strtolower($actualExt);
            // $current_file=
            // find file existing
            if (file_exists($path)) {


                if (unlink($path)) {
                    $sql = "UPDATE projects SET ProjectName='$project_name',projectCategory='$project_category',ProjectType='$project_type',Description='$description',
                MoreDescription='$moreDescription',ProjectPrice='$price_project',FromPrice='$from_price',Poster='$updatedPosterName' WHERE ID='$id';";
                    $result = $Project->connect()->query($sql);
                    if ($result) {
                        move_uploaded_file($tempFile, $path);
                        $response = array("response" => "Your File Has Been Updated Successfully..");
                    }
                }
            } else {

                if (!($Project->getExistProjectPoster($id)))
                    $response = array("response" => "Error Occurred While Fetching Filename....");
                else {
                    if (file_exists($Project->getExistProjectPoster($id))) {

                        $tempFile = $_FILES['poster']['tmp_name'];
                        $file_name = $_FILES['poster']['name'];
                        $extension = explode(".", $file_name);
                        $actualExt = $extension[1];

                        $path = "../posters/" . $id . "." . strtolower($actualExt);
                        $updatedPosterName = $id . "." . strtolower($actualExt);
                        // $current_file=

                        if (unlink($Project->getExistProjectPoster($id))) {
                            $sql = "UPDATE projects SET ProjectName='$project_name',projectCategory='$project_category',ProjectType='$project_type',Description='$description',
                        MoreDescription='$moreDescription',ProjectPrice='$price_project',FromPrice='$from_price',Poster='$updatedPosterName' WHERE ID='$id';";
                            $result = $Project->connect()->query($sql);
                            if ($result) {
                                move_uploaded_file($tempFile, $path);
                                $response = array("response" => "Your File Has Been Updated Successfully");
                            }
                        }
                    } else {
                        $tempFile = $_FILES['poster']['tmp_name'];
                        $file_name = $_FILES['poster']['name'];
                        $extension = explode(".", $file_name);
                        $actualExt = $extension[1];

                        $path = "../posters/" . $id . "." . strtolower($actualExt);
                        $updatedPosterName = $id . "." . strtolower($actualExt);
                        $sql = "UPDATE projects SET ProjectName='$project_name',projectCategory='$project_category',ProjectType='$project_type',Description='$description',
                        MoreDescription='$moreDescription',ProjectPrice='$price_project',FromPrice='$from_price',Poster='$updatedPosterName' WHERE ID='$id';";
                        $result = $Project->connect()->query($sql);
                        if ($result) {
                            move_uploaded_file($tempFile, $path);
                            $response = array("response" => "Your File Has Been Updated Successfully");
                        }


                        $response = array("file" => "fully");
                    }
                }
            }
        } else   if ($file == "yes" && $video_available == "yes") {

            $tempFile = $_FILES['video']['tmp_name'];
            $file_name = $_FILES['video']['name'];
            $extension = explode(".", $file_name);
            $actualExt = $extension[1];

            $path = "../videos/" . $id . "." . strtolower($actualExt);
            $updatedPosterName = $id . "." . strtolower($actualExt);
            // $current_file=
            // find file existing
            if (file_exists($path)) {


                if (unlink($path)) {
                    $sql = "UPDATE projects SET ProjectName='$project_name',projectCategory='$project_category',ProjectType='$project_type',Description='$description',
                MoreDescription='$moreDescription',ProjectPrice='$price_project',FromPrice='$from_price',ProjectVideo='$updatedPosterName' WHERE ID='$id';";
                    $result = $Project->connect()->query($sql);
                    if ($result) {
                        move_uploaded_file($tempFile, $path);
                        $response = array("response" => "Your File Has Been Updated Successfully");
                    }
                }
            } else {

                if (!($Project->getExistProjectPoster($id, "video")))
                    $response = array("file" => "Error Occurred While fetching filename....");
                else {
                    if (file_exists($Project->getExistProjectPoster($id, "video"))) {

                        $tempFile = $_FILES['video']['tmp_name'];
                        $file_name = $_FILES['video']['name'];
                        $extension = explode(".", $file_name);
                        $actualExt = $extension[1];

                        $path = "../videos/" . $id . "." . strtolower($actualExt);
                        $updatedPosterName = $id . "." . strtolower($actualExt);
                        // $current_file=

                        if (unlink($Project->getExistProjectPoster($id, "video"))) {
                            $sql = "UPDATE projects SET ProjectName='$project_name',projectCategory='$project_category',ProjectType='$project_type',Description='$description',
                        MoreDescription='$moreDescription',ProjectPrice='$price_project',FromPrice='$from_price',ProjectVideo='$updatedPosterName' WHERE ID='$id';";
                            $result = $Project->connect()->query($sql);
                            if ($result) {
                                move_uploaded_file($tempFile, $path);
                                $response = array("response" => "Your File Has Been Updated Successfully");
                            }
                        }
                    } else {
                        $tempFile = $_FILES['video']['tmp_name'];
                        $file_name = $_FILES['video']['name'];
                        $extension = explode(".", $file_name);
                        $actualExt = $extension[1];

                        $path = "../videos/" . $id . "." . strtolower($actualExt);
                        $updatedPosterName = $id . "." . strtolower($actualExt);
                        $sql = "UPDATE projects SET ProjectName='$project_name',projectCategory='$project_category',ProjectType='$project_type',Description='$description',
                        MoreDescription='$moreDescription',ProjectPrice='$price_project',FromPrice='$from_price',ProjectVideo='$updatedPosterName' WHERE ID='$id';";
                        $result = $Project->connect()->query($sql);
                        if ($result) {
                            move_uploaded_file($tempFile, $path);
                            $response = array("response" => "Your File Has Been Updated Successfully");
                        }


                        // $response=array("file"=>"fully");
                    }
                }
            }
        }




        echo json_encode($response);
    }

    public function fetchCurrentUser()
    {
        extract($_POST);

        $userID = $_SESSION['profile_id'];
        $sql = "SELECT *from users where USERID='$userID';";
        $Users = new Project();
        $result = $Users->connect()->query($sql);
        if ($result) {

            $row = $result->fetch_assoc();
        ?>

            <option value="<?php echo $row['USERID'] ?>"><?php echo $row['FullName'] ?></option>
        <?php

        }
    }
    public function getExistProjectPoster($id, $fileType = "poster"): string | bool
    {
        // extract($_POST);

        $file = "";
        if ($file == "poster") {
            try {
                $sql = "SELECT Poster from projects where ID='$id';";
                $Users = new Project();
                $result = $Users->connect()->query($sql);

                if ($result) {

                    $row = $result->fetch_assoc();
                    $file = "../posters/" . $row['Poster'];
                } else {

                    return false;
                }
            } catch (Exception $ex) {
                return false;
            }
        } else if ($fileType == "video") {
            try {
                $sql = "SELECT ProjectVideo from projects where ID='$id';";
                $Users = new Project();
                $result = $Users->connect()->query($sql);

                if ($result) {

                    $row = $result->fetch_assoc();
                    $file = "../videos/" . $row['ProjectVideo'];
                } else {
                    return false;
                }
            } catch (Exception $ex) {
                return false;
            }
        }

        return $file;
    }


    public function loadToolsFromCategories()
    {

        extract($_POST);

        $sql = "SELECT tools.ID, tools.tool,categories.Category FROM tools
        INNER JOIN categories
        ON tools.Category=categories.ID
        WHERE tools.Category='$id';";
        $Users = new Project();
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
        $Users = new Project();
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
        $Users = new Project();
        $result = $Users->connect()->query($sql);
        if ($result) {

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
        }
    }

    public function loadTransactions()
    {
        extract($_POST);

        $sql = "SELECT transactions.paymentID,transactions.amount,transactions.Status,projects.ProjectName
        FROM projects
        INNER JOIN transactions
        ON projects.ID=transactions.ItemID
        WHERE transactions.ClientID='" . $_SESSION['profile_id'] . "';";
        $Users = new Project();
        $result = $Users->connect()->query($sql);
        if ($result) {
            ?>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Payment Code</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Project</th>

                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row => $value) {
                    ?>

                        <tr>
                            <td><?php echo $value['paymentID'] ?></td>
                            <td>$<?php echo $value['amount'] ?></td>
                            <td class="text-success fw-bold"><?php echo $value['Status'] ?></td>
                            <td><?php echo $value['ProjectName'] ?></td>
                            <!-- <td><?php echo $value['Owner'] ?></td> -->
                            <td>

                                <a class="btn btn-secondary detail" paymentID="<?php echo $value['paymentID'] ?>"><i class="fa-solid fa-circle-info text-light"></i></a>
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

    public function loadProjects()
    {
        extract($_POST);

        $sql = "SELECT ID,ProjectName,ProjectType,ProjectPrice from projects WHERE Owner='" . $_SESSION['profile_id'] . "';";
        $Users = new Project();
        $result = $Users->connect()->query($sql);
        if ($result) {
        ?>

            <table class="table table-bordered usersTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Project</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price</th>

                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row => $value) {
                    ?>

                        <tr>
                            <td><?php echo $value['ID'] ?></td>
                            <td><?php echo $value['ProjectName'] ?></td>
                            <td><?php echo $value['ProjectType'] ?></td>
                            <td><?php echo "$" . $value['ProjectPrice'] ?></td>
                            <!-- <td><?php echo $value['Owner'] ?></td> -->
                            <td>
                                <a href="#UpdateCurrentProject=<?php echo $value['ID'] ?>" projectID="<?php echo $value['ID'] ?>" class="btn btn-success update"><i class="fa-regular fa-pen-to-square text-light"></i></a>
                                <a href="#DeleteCurrentProject=<?php echo $value['ID'] ?>" projectID="<?php echo $value['ID'] ?>" class="btn btn-danger delete"><i class="fa-solid fa-minus text-light"></i></a>
                                <a class="btn btn-secondary detail" projectID="<?php echo $value['ID'] ?>"><i class="fa-solid fa-circle-info text-light"></i></a>
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
    public function loadProjectsDashboard()
    {
        extract($_POST);

        if ($_SESSION['type'] == "Admin") {
            $sql = "SELECT ProjectName,ProjectType,projectCategory from projects ;";
            $Users = new Project();
            $result = $Users->connect()->query($sql);
            if ($result) {
            ?>

                <table class="table table-bordered usersTable">
                    <thead>
                        <tr>

                            <th scope="col">Project</th>
                            <th scope="col">Type</th>
                            <th scope="col">Category</th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $row => $value) {
                        ?>

                            <tr>

                                <td><?php echo $value['ProjectName'] ?></td>
                                <td><?php echo $value['ProjectType'] ?></td>
                                <td><?php echo $value['projectCategory'] ?></td>



                            <?php

                        }

                            ?>



                    </tbody>
                </table>



            <?php


            }
            return;
        }
        $sql = "SELECT ProjectName,ProjectType,ProjectPrice from projects WHERE Owner='" . $_SESSION['profile_id'] . "';";
        $Users = new Project();
        $result = $Users->connect()->query($sql);
        if ($result) {
            ?>

            <table class="table table-bordered usersTable">
                <thead>
                    <tr>

                        <th scope="col">Project</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price</th>



                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row => $value) {
                    ?>

                        <tr>

                            <td><?php echo $value['ProjectName'] ?></td>
                            <td><?php echo $value['ProjectType'] ?></td>
                            <td><?php echo "$" . $value['ProjectPrice'] ?></td>



                        <?php

                    }

                        ?>



                </tbody>
            </table>



        <?php


        }

        // echo json_encode($response);
    }

    public function loadCategories()
    {
        extract($_POST);

        $sql = "SELECT *from categories;";
        $Users = new Project();
        $result = $Users->connect()->query($sql);
        if ($result) {
        ?>

            <table class="table table-bordered usersTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>

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
        $Project = new Project();
        $result = $Project->connect()->query($sql);
        if (!$result)
            return;
    }
    public static function saveCategory()
    {
        //SETTING AND UPADTING USERS CURRENT STATUS
        extract($_POST);
        $arrayCategory = explode(",", $category);
        $response = array();
        $conn = new Project();
        $error = "";
        for ($index = 0; $index < count($arrayCategory); $index++) {
            $id = rand(1000, 9999) . "C";
            $sql = "INSERT INTO categories Values('$id','$arrayCategory[$index]');";
            $result = $conn->connect()->query($sql);
            if (!$result) {
                $error = $conn->connect()->error;
                break;
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
        $conn = new Project();
        $error = "";
        for ($index = 0; $index < count($toolsCategory); $index++) {

            $sql = "INSERT INTO tools(`Category`,`tool`) Values('$id','$toolsCategory[$index]');";
            $result = $conn->connect()->query($sql);
            if (!$result) {
                $error = $conn->connect()->error;
                break;
            }
        }

        $response = array("error" => $error, "response" => "All Project has been saved...");

        echo json_encode($response);
    }
    public  function setOffline()
    {
        //SETTING AND UPADTING USERS CURRENT STATUS
        $id = $_SESSION['profile_id'];
        $sql = "UPDATE users SET loggedStatus='Offline' where USERID='$id';";
        $Project = new Project();
        $response = array();
        $result = $Project->connect()->query($sql);
        if ($result) {
            $response = array("error" => "");
            session_unset();
            session_destroy();
            // exit();
        }
        $response = array("error" => $Project->connect()->error);
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
            $Project = new Project();
            $result = $Project->connect()->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = $result->fetch_assoc();
                    Project::setOnline($row['USERID']);
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
        $Project = new Project();
        $response = array();
        if ($type == "Employer Profile") {
            if ($imageAvailable == "No") {

                $fileName = "../images/default.jpg";
                $file = explode("/", $fileName);
                $actualName = $file[2];
                $employerID = uniqid("EMPVH-");
                $sql = "CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','$actualName');";
                $result = $Project->connect()->query($sql);
                if ($result)
                    $response = array("response" => "Your Account Has Been Configured.😊");
                else
                    $response = array("response" => $Project->connect()->error);
            } else {
                $employerID = uniqid("EMPVH-");
                $tempFile = $_FILES['profile']['tmp_name'];
                $file_name = $_FILES['profile']['name'];
                $extension = explode(".", $file_name);
                $actualExt = $extension[1];
                $actualUserProfile = $employerID . "." . $actualExt;
                $uploadFile = "../uploads/" . $actualUserProfile;


                $sql = "CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','$actualUserProfile');";
                $result = $Project->connect()->query($sql);
                if ($result) {
                    move_uploaded_file($tempFile, $uploadFile);
                    $response = array("response" => "Your Account Has Been Configured.😊");
                } else
                    $response = array("response" => $Project->connect()->error);
            }
        } else if ($type == "Employee Profile") {
        }
        echo json_encode($response);
    }
    public function loadAccountTypes()
    {
        $conn = new Project();
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
    $api = new Project();
    $api->$action();
}

?>