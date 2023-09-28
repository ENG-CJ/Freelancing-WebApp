<?php
include "../../connections/conn.php";
include '../../paymentGateway/config.php';
$conn = new Connections();
$sql = "SELECT DISTINCT(projectCategory) FROM projects;";
$result = $conn->connect()->query($sql);
$data = array();
if ($result) {
  while ($rows = $result->fetch_assoc()) {
    $data[] = array("category" => $rows['projectCategory']);
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buy Projects</title>

  <link rel="stylesheet" href="shop.css" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body>
  <header>
    <div class="main">
      <div class="nav-container">
        <a href="#" class="brand">Hire Hero</a>
      </div>
      <nav>
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="../dashboard.php">Hired Freelancers</a></li>
          <li><a href="../../chat/">Chats</a></li>
          <li><a href="../../Profile/profile"><i class="fa-solid fa-user" style="margin-right: 7px"></i>Profile</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="hero-section">
    <div class="content">
      <h1>Clear scope.
        Upfront price.
        No surprises</h1>
      <p>Complete your most pressing work with Project Catalog. Browse and buy predefined projects in just a few clicks. The Best And The Best Price Through best payment Integrations!</p>
    </div>
  </div>
  <div class="container-bg">

    <div class="search-project-container">
      <div class="filter">
        <select name="" id="" class="filter-project">
          <option value="">Filter By Category (All)</option>
          <?php
          if (count($data) > 0) {
            foreach ($data as $key => $value) {
          ?>
              <option value="<?php echo $value['category'] ?>"><?php echo $value['category'] ?></option>

          <?php
            }
          }
          ?>


        </select>
        <!-- <button class="search">Search</button> -->
      </div>
    </div>



    <div class="main-card-container">





    </div>

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../../jquery-3.3.1.min.js"></script>
  <script src="../../iziToast-master/dist/js/iziToast.js"></script>
  <script src="../../iziToast-master/dist/js/iziToast.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://js.stripe.com/v3/" difer></script>
  <script>
    $(".filter-project").on("change", function() {
      if ($(".filter-project").val() == "") {
        getAllProjects((res) => {
          console.log(res)
          $(".main-card-container").html("");
          res.map((responseData) => {
            const {
              projectID,
              projectName,
              type,
              poster,
              category,
              Price,
              Description,
              ProjectVideo
            } = (responseData.response.project_details)
            const {
              fullName,
              id,
              Photo
            } = (responseData.response.developer_details)


            $(".main-card-container").append(`
        <div class="project_card">
        <div class="project-image">
          <img src="../../posters/${poster}" width="100%" alt="" />
        </div>
        <div class="project-details">
          <div class="project-name">
            <span class="name">${projectName}</span>
          </div>
          <div class="project-descr">
            <p>
             ${Description} 
            </p>
          </div>
          <div class="project-price">
            <span>From Price: $${Price}</span>
            <span class="_category">Category: ${category}</span>
          </div>
        </div>

        <div class="button">
          <button class="buy">Buy</button>
          <button class="view" userID=${id}>View</button>
        </div>
        <hr />
        <div class="owner-details">
          <div class="avatar">
            <img src="../../uploads/${Photo}" width="15%" alt="" />

            <div class="owner-name">
              <span class="name">${fullName}</span>
              <span class="title">${responseData.response.developer_details.category.dev_category}</span>
            </div>
          </div>
        </div>

      </div>
        
        `)
          })
        })


      } else {
        filterProjects($(this).val(), response => {
          console.log(response);

          $(".main-card-container").html("");
          response.map((responseData) => {
            console.log(responseData)
            const {
              projectID,
              projectName,
              type,
              poster,
              category,
              Price,
              Description,
              ProjectVideo
            } = (responseData.response.project_details)
            const {
              fullName,
              id,
              Photo
            } = (responseData.response.developer_details)
            const {
              dev_category
            } = (responseData.response.developer_details.category)


            $(".main-card-container").append(`
        <div class="project_card">
        <div class="project-image">
          <img src="../../posters/${poster}" width="100%" alt="" />
        </div>
        <div class="project-details">
          <div class="project-name">
            <span class="name">${projectName}</span>
          </div>
          <div class="project-descr">
            <p>
             ${Description} 
            </p>
          </div>
          <div class="project-price">
            <span>From Price: $${Price}</span>
            <span class="_category">Category: ${category}</span>
          </div>
        </div>

        <div class="button">
          <button class="buy">Buy</button>
          <button class="view" userID=${id}>View</button>
        </div>
        <hr />
        <div class="owner-details">
          <div class="avatar">
            <img src="../../uploads/${Photo}" width="15%" alt="" />

            <div class="owner-name">
              <span class="name">${fullName}</span>
        
              <span class="title">${responseData.response.developer_details.category.dev_category}</span>
            </div>
          </div>
        </div>

      </div>
        
        `)
          })
        })
      }

      ;
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
        url: "../../api/projects.php",
        success: (response) => {
          display(response);
        },
        error: (response) => {
          console.log(response);
        }
      })
    }

    $(document).on("click", '.view', function() {
      var id = $(this).attr("userID");
      window.location = "../freelancer?freelancerCode=" + id;
    })



    getAllProjects((res) => {
      console.log(res)
      res.map((responseData) => {
        const {
          projectID,
          projectName,
          type,
          poster,
          category,
          Price,
          Description,
          ProjectVideo,
          MoreDescription
        } = (responseData.response.project_details)
        const {
          fullName,
          id,
          Photo
        } = (responseData.response.developer_details)


        $(".main-card-container").append(`
        <div class="project_card">
        <div class="project-image">
          <img src="../../posters/${poster}" width="100%" alt="" />
        </div>
        <div class="project-details">
          <div class="project-name">
            <span class="name project_name">${projectName}</span>
          </div>
          <div class="project-descr">
            <p>
             ${Description} 
            </p>
          </div>
          <div class="project-price">
            <span>From Price: $${Price}</span>
            <span class="_category">Category: ${category}</span>
          </div>
        </div>

        <div class="button">

          <button projectID=${projectID} Price=${Price} projectName=${responseData.response.project_details.projectName} Description=${MoreDescription} class="buy">Buy</button>
          <button class="view" userID=${id} >View</button>
        </div>
        <hr />
        <div class="owner-details">
          <div class="avatar">
            <img src="../../uploads/${Photo}" width="15%" alt="" />

            <div class="owner-name">
              <span class="name">${fullName}</span>
              <span class="title">${responseData.response.developer_details.category.dev_category}</span>
            </div>
          </div>
        </div>

      </div>
        
        `)
      })
    })

    $(document).on("click", ".buy", function() {

      // // var price = ($(this).attr('Price'))
      // // var id = ($(this).attr('projectID'));
      // // var more = ($(this).attr('Description'));
      // var name = ($(this).attr('projectName'));

      var id = ($(this).attr('projectID'))

      var stripe = Stripe("<?php echo $publishableKey ?>");
      var data = {
        id: id,
        action: "getProject"
      }

      $.ajax({
        method: "POST",
        dataType: "JSON",
        data: data,
        url: "../../api/projects.php",
        beforeSend: () => {
          $(".buy").attr("disabled", true)
          $(".buy").html(".....");
        },
        success: (response) => {
          console.log(response);

          $(".buy").attr("false", false)
          $(".buy").html("Buy");
          sendPaymentProcess(response, (dataResponse) => {
           
            stripe.redirectToCheckout({
              sessionId: dataResponse.id
            })
            $(".buy").attr("disabled", false)
            $(".buy").html("Buy");
          })


        },
        error: (response) => {
          console.log(response);
          $(".buy").attr("disabled", false)
          $(".buy").html("Buy");

        }
      })




      // var data = {
      //   projectID: id,
      //   project_name: name,
      //   description: more,
      //   amount: price,
      //   "buy": "buy"
      // }

      // $.ajax({
      //   method: "POST",
      //   dataType: "JSON",
      //   data: data,
      //   url: "../../paymentGateway/process.php",
      //   beforeSend: () => {
      //     $(".buy").attr("disabled",true)

      //   },
      //   success: (response) => {
      //     // console.log(response);
      //     stripe.redirectToCheckout({
      //       sessionId: response.id
      //     })
      //     $(".buy").attr("disabled",true)

      //   },
      //   error: (response) => {
      //     console.log(response);
      //     $(".buy").attr("disabled",true)

      //   }
      // })

    })



    function getAllProjects(display) {
      var data = {

        action: "readAllProjects"
      }
      $.ajax({
        method: "POST",
        dataType: "JSON",
        data: data,
        url: "../../api/projects.php",
        success: (response) => {
          display(response);
        },
        error: (response) => {
          console.log(response);
        }
      })
    }

    function sendPaymentProcess(data, display) {
      var data = {
        projectID: data.response.id,
        project_name: data.response.name,
        description: data.response.moreDescription,
        amount: data.response.price,
        "buy": "buy"
      }

      $.ajax({
        method: "POST",
        dataType: "JSON",
        data: data,
        url: "../../paymentGateway/process.php",
        beforeSend: () => {
          $(".buy").attr("disabled", true)
         

        },
        success: (response) => {
          $(".buy").attr("disabled", false)
        
          display(response)
          // // console.log(response);
          // stripe.redirectToCheckout({
          //   sessionId: response.id
          // })
          // $(".buy").attr("disabled", true)

        },
        error: (response) => {
          console.log(response);
          $(".buy").attr("disabled", false)

        }
      })
    }

    function filterProjects(category, display) {
      var data = {
        category: category,
        action: "filterProjects"
      }
      $.ajax({
        method: "POST",
        dataType: "JSON",
        data: data,
        url: "../../api/projects.php",
        success: (response) => {
          display(response);
        },
        error: (response) => {
          console.log(response);
        }
      })
    }
  </script>
</body>

</html>