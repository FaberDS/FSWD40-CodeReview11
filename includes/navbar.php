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
    <?php if($loged_in){
        ?>
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="branches.php">Our Branches</a>
      </li>
      <?php 
        if(isset($_SESSION['user_data']['role'])){
          if(($_SESSION['user_data']['role'] == 'Admin')){

          
      ?>
          <li class="nav-item">
            <a class="nav-link" href="car_position.php">See Locations of all cars</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="report.php">Get Report</a>
          </li>
      <?php
            }
            }

      ?>
      
      
    </ul>
    
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