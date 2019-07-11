<?php

// check if this requset from contact or not


if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Start assign the post to var 
  $user  = $_POST['username'];
  $email = $_POST['email'];
  $pass  = $_POST['pass'];
  $mess  = $_POST['mess'];
  $userLat  = strtoupper($user);


 // filter the input
  $user = filter_var($user, FILTER_SANITIZE_STRING);
  $mess = filter_var($mess, FILTER_SANITIZE_STRING);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  // Create Array Errors
  $formerror = array();
  if (!(strlen($user) >= 3 && strlen($user) <= 15)) {
    $formerror[0] = "<p class = 'alert alert-danger fade in alert-dismissible show'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true' style='font-size:20px'>×</span>
    </button>
    SORRY THE USERNAME MUST BIG 3 CHAR AND SMALL 15
    </p>";
  }

  if (!(strlen($pass) >= 5 && strlen($pass) <= 15)) {
    $formerror[1] = "<p class = 'alert alert-danger'> SORRY THE PASSWORD SHOULD BIG 5 AND SMALL 15</p>";
  }

  if (strlen($mess) <= 10) {
    $formerror[2] = "<p class = 'alert alert-danger'> SORRY THE MESS SHOULD BIG 10 </p>";
  }

  // sent the mess if there not error => mail(To, subject, Message, Header, Parameter);
  if(empty($formerror)){
   $header = 'from : ' . $email . '\r\n';
    @mail('ansmr002@gmail.com', 'contact-us', $mess, $header);
  }


}

// start session      
if(!empty($user) && !empty($pass)){
session_start();
$_SESSION['username'] = $user;
$_SESSION['email']   = $email;
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- fount Css -->
  <link rel="stylesheet" href="font/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway&display=swap">
  <!-- contact Css -->
  <link rel="stylesheet" href="css/contact.css">

  <title> Contact Form </title>
</head>

<body>

  <!-- start navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- End navbar -->

  <!-- start form -->
  <main>
    <h2 class="text-center"> WELCOME MR DO YOU WANT TO CONTACT US </h2>
    <div class="container">
      <p style='margin-bottom:-10px'> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione molestias recusandae rem animi unde ullam repellendus perspiciatis cum ad molestiae magni quo est, reiciendis dicta suscipit ut expedita saepe in?</p>
    </div>
  </main>

  <section class="web-site">
    <div class="container">

      <div class="row">
        <div class="col-md-5 col-sm-12 form-con">

          <form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <!-- Start Error -->
            <div class="container error">
              <?php
                  
              if (isset($formerror)) {
               if(count($formerror) > 0){
                echo '<h2 style="color:#777; font-weight: 700; margin-bottom:-10px"> ERRORS TABEL :</h2>' . "<br>";
               }else{
                echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
              </div>';

              $pass = "";
              $mess = "";
           }
                foreach ($formerror as $error) {
                  echo $error;
                }
              }

              ?>
            </div>
            <!-- End Error -->
            <div class="input-con">
              <i class="fas fa-user fa-fw"></i>
              <input type="text" class="user form-control" name="username" title="Enter Your Name" placeholder="Enter Name" autocomplete="off"    value =  "<?php if(!empty($_SESSION['username'])){echo  $_SESSION['username'] ;}?>" required />
              <div class = "alert alert-danger custom-alert" role="alert">   SORRY THE USERNAME MUST BIG 3 CHAR AND SMALL 15  </div>
            </div>
            <div class="input-con">
            <i class="fas fa-envelope fa-fw"></i>  
            <input type="Email" value = '<?php if(!empty($_SESSION['email'])){ echo $_SESSION['email'];}?>' required class="form-control email" name="email" title="Enter Your Email" placeholder="Enter Email" />
            </div>
            <div class="input-con">
              <i class="fas fa-lock fa-fw"></i>  
              <input type="password" value = "<?php if(isset($pass)){ echo $pass;}?>" required class="form-control pass" name="pass" title="Enter Your Password" placeholder="Enter Passord" />
              <div class = "alert alert-danger custom-alert" role="alert">SORRY THE PASSWORD SHOULD BIG 5 AND SMALL 15 </div>
            </div>
            <textarea required name="mess"  class="mess form-control"><?php if(isset($mess)){ echo $mess; }?></textarea>
            <div class = "alert alert-danger custom-alert" role="alert">   SORRY THE MESS SHOULD BIG 10  </div>
            <div class="input-con">
              <input type="submit" value="Send Message" class="btn btn-primary btn-block">
            </div>
          </form>
        </div>
        <div class="col-md-7 col-sm-12 img-con">
          <figure class="img">
            <img src="image/contact-us-4.png" class="img-fluid" alt="Countact Us" />
          </figure>
        </div>
      </div>
    </div>
  </section>
  <!-- end form -->

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
</body>

</html>