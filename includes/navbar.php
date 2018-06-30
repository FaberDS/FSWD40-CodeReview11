<?php
  
    $loged_in= false;
    if(isset($_SESSION['user_is_logged_in'])){
            $loged_in = true;
            $fullname = $_SESSION['user_data']['fullname'];
           
            // echo "Session";  
             

            
        } else{
            // echo "Session failed";
        }
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PHP-Rent</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="branches.php">Our Branches</a>
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
      
    </ul>
    <?php if($loged_in){
        ?>
            <a class="nav-link disabled" href="action/logout.php"><i class='fas fa-sign-out-alt'></i></a>
        <?php
    } else{
        ?>
            <a class="nav-link disabled" href="index.php?login">Login</a>
            <a class="nav-link disabled" href="index.php?register">Register</a>
        <?php
    }
    ?>


     

  </div>
</nav>