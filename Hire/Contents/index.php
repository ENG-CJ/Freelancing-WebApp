<?php
session_start();
include "../AccessPoint/Access.php";
if (!isset($_SESSION['profile_id'])) {
    header("location: ../index.php");
    exit();
}

if(!AccessAuth::Auth($_SESSION['type'],"Employer Profile")){
    header("location: ../../401.html");
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hire Hero</title>
    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Hire Hero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./dashboard">Hired Freelancers</a></li>

                    <li class="nav-item"><a class="nav-link" href="../chat/">Chats</a></li>
                    <li class="nav-item"><a class="nav-link" href="./shopping/shop">Projects</a></li>

                    <li class="nav-item"><a class="nav-link" href="../Profile/profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link logout" href="#!">Logout <i class="fa-solid fa-right-from-bracket mr-1 text-light"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Boost Your Business</h1>
                        <p class="lead text-white-50 mb-4">Forget the old rules. You can have the best people.
                            Right now. Right here. </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Watch Video</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0" >
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                    <h2 class="h4 fw-bolder">Web Design </h2>
                    <p>Boost Your Website Style By Hiring Web Designers.</p>

                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                    <h2 class="h4 fw-bolder">Software Development</h2>
                    <p>Access And Control Your Business Activities Here Are Pro Software Developers.</p>

                </div>
                <div class="col-lg-4">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                    <h2 class="h4 fw-bolder">Graphic Design</h2>
                    <p>Make You Business Best and Best Brand Offic By Graphic Innovators.</p>

                </div>
            </div>
        </div>
    </section>


    <section class="bg py-5 border-bottom">
    <div class="container px-5 my-5">
    <div class="row gx-5 justify-content-center">
    <div class="col-lg-6 col-xl-6" data-aos="fade-right">
       <img class="img-fluid" src="./creative.png">
    </div>
    <div class="col-lg-6 col-xl-6 text-left" data-aos="fade-left">
        <h1 class="fw-bolder fs-1">Hire App , it’s free.</h1>
      <div class="characetrs my-3 text-left">
        <h5><i class="fa-solid fa-hat-cowboy-side text-secondary mx-2"></i>No Credit Cards</h5>
        <div style="margin-left:50px">
        <p>Register and browse professionals, explore projects.</p>
        </div>
      </div>
      <div class="characetrs my-3 text-left">
        <h5><i class="fa-solid fa-code mx-2"></i>Hire Well Talented</h5>
        <div style="margin-left:50px">
        <p>Hire Talent Person Right Now Right Here.</p>
        </div>
      </div>
      <div class="characetrs my-3 text-left">
        <h5><i class="fa-solid fa-hat-cowboy-side text-secondary mx-2"></i>24/7 Support</h5>
        <div style="margin-left:50px">
        <p>Hire Online freelancers that you will support 24/7.</p>
        </div>
      </div>
      <!-- <button class="btn btn-success border-2 fw-bold">SignIn For Free</button> -->

    </div>
    
    </div>
    </div>

    </section>


    <section class="bg-dark py-5 text-light">
    <div class="container p-3">
    <h1 class="fw-bolder fs-1">Browse Categories.</h1>
    <p>Browse Talent Persons By Categories</p>

    <div class="row my-4 categories">
       

        <!-- <div class="col-lg-4 col-md-12 mb-3">
           <div class="card border-1 shadow-lg bg-success p-4 ">
             <div class="header-title">
                <h5 class="lead">Software Developer</h5>
             </div>
             <div class="">
             <i class="fa-solid fa-user mx-2"></i><span >100 Talented Persons</span>
             </div>
           </div>
        </div> -->
        <h5 class="lead">Fetching Data From The Server......</h5>
      
    
       
    </div>
    </div>
    </section>

    <section class="bg-light py-5 border-bottom">
    <div class="container px-5 my-5">
    <div class="row gx-5 justify-content-center">
    <div class="col-lg-6 col-xl-5" data-aos="zoom-in-right">
   <div class="header-line">
   <!-- <h2 class="fw-bolder fs-1">Buy a Project</h2> -->
   <!-- <span class="text-muted">Buy Project For Your School Or University With RFL</span> -->
   </div>
   <div class="body-line ">
   <div class="jumbotron">
  <h1 class="display-4 fw-bold text-muted">Buy a Project</h1>
  <p class="lead">Work with the largest network of independent professionals and get things done—from quick turnarounds to big transformations..</p>
  <hr class="my-4">
  <a href="./shopping/shop" class="btn btn-success border-2 fw-bold"> <i class="fa-solid fa-arrow-up-right-from-square mx-2"></i>Explore Now</a>

</div>
  <!-- <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum quae dolore neque suscipit eius nulla mollitia, saepe officiis fuga. Quos facilis doloribus dolor quasi id eius, at aut! Porro, aliquam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim quia voluptas sint quidem unde, aliquam optio voluptatibus ducimus, quam debitis repudiandae? Laudantium aspernatur nemo dolor. Quo mollitia non asperiores dolorum!</p> -->
   </div>
   <div class="Body">
   </div>

    </div>
    <div class="col-lg-6 col-xl-7" data-aos="zoom-out">
    <img class="w-100 rounded-2" src="../images/work.jpg">
    </div>
    </div>
    </div>
    </section>




    <section class="py-5 border-bottom bg-gradient">
    <div class="container px-5 my-5">
    <div class="row gx-5 justify-content-center">
   
    <div class="col-lg-12 col-xl-12">
   <div class="header-line">
   <h2 class="fw-bolder fs-1 mb-3">TRUSTED & CONNECTED BY</h2>
   <!-- <span class="text-muted">Buy Project For Your School Or University With RFL</span> -->
   </div>
   <div class="body-line ">
   <img src="../images/just.png" class="img-fluid" style="width: 30%">
   <img src="../images/jtech-LOGO-1.png" class="img-fluid ml-2" style="width: 30%">
   <img src="../images/preme.png" class="img-fluid ml-2" style="width: 30%">
   <img src="../images/just.png" class="img-fluid ml-2" style="width: 30%">
   <img src="../images/just.png" class="img-fluid ml-2" style="width: 30%">
   <img src="../images/just.png" class="img-fluid ml-2" style="width: 30%">
</div>
   <!-- <div class="Body mt-3">
    <button class="btn btn-success border-2 fw-bold"> <i class="fa-solid fa-arrow-up-right-from-square mx-2"></i>Meet Experts</button>
   </div> -->

    </div>
   
    </div>
    </div>
    </section>
    <!-- Pricing section-->
   
    <section class="py-5 border-bottom">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">Client testimonials</h2>
                <p class="lead mb-0">Clients love Hiring Most Incredible Talented Persons</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <!-- Testimonial 1-->
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                                <div class="ms-4">
                                    <p class="mb-1">Waa Ku Mahadsantihin Waxaa Fududeyseeen Shaqooyin-kee bananka laga Radin Jiray Haddane Online Ah!</p>
                                    <div class="small text-muted">- Mohamed Abdullahi, Mogadishu-Somalia</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 2-->
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                                <div class="ms-4">
                                    <p class="mb-1">Waxaan Aad Ugu Riyaaqay Shaqada Dagdagsiimada badan oo aad ku helaysid 24saac gudahood waliba dadka graphic design-ka xirfadda uleh aad baan 
                                        ubogaadinayaa!</p>
                                    <div class="small text-muted">- Salmaan Ali, Mogadishu-Somalia</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section-->
    <section class="bg-light py-5">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                <h2 class="fw-bolder">Subscribe Our Daily Updates</h2>
                <p class="lead mb-0">Only Existing Email Can Subscribe</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="email" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">example@gmail.com</label>
                         
                        </div>
                    
                    
                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-primary btn-lg " id="submitButton" type="submit">Subscribe</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-5">
            <p class="m-0 text-center text-white">Copyright &copy; HIRE HERO APP 2023</p>
        </div>
    </footer>




    <div class="modal  fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content bg-dark">
                <!-- <div class="modal-header">
                    <h6 class="text-muted text-capitalize">security settings</h6>
                </div> -->
                <div class="modal-body ">
                    <video id="my-video" class="video-js" controls preload="auto" loop="true" width="750" height="400" 
                        data-setup="{}">
                        <source src="../video.mp4" type="video/mp4" />
                        <!-- <source src="MY_VIDEO.webm" type="video/webm" /> -->
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="../jquery-3.3.1.min.js"></script>
    <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();

        $(document).ready((e)=>{
           setInterval(()=>{
            loadSample();
           },1000);

            function loadSample() {
            $.ajax({
                method: "POST",
                // dataType: "JSON",
                url: "../api/tools.php",
                data: {
                    "action": "loadSample"
                },
                success: (response) => {
                    $(".categories").html("");
                    $(".categories").html(response);
                },
                error: () => {
                    alert(response['responseText']);
                  
                },
            })
        }

        
        })
        $(".logout").click((e) => {
            $.ajax({
                method: "POST",
                dataType: "JSON",
                url: "../api/signup.php",
                data: {
                    "action": "setOffline"
                },
                success: (response) => {
                    if (response.error == "")
                        window.location = "../index.php";
                    else
                        alert(response['error']);
                },
                error: () => {
                    alert(response['responseText']);
                    
                },
            })
        })
    </script>

</body>

</html>