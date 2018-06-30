<?php
    include("includes/header.php");
    include("includes/functions.php");
    if(isset($_SESSION['user_data'])){
        redirect('home.php');
    }
?>
<div class="container-fluid">

    <h1>Welcome on Index</h1>
    <div class="jumbotron jumbotron-fluid" id="index_jumbo">
        <div class="container">
        <h1 class="display-4">Welcome to PHP-rent</h1>
        <p class="lead">For each case we have the right car. Just login and check our full range offer!</p>
        <p class="lead mt-5 text-center">
            <a class="btn btn-lg btn-info m-5" href="index.php?login">Login</a>
            <a class="btn btn-lg btn-info m-5" href="index.php?register">Register</a>
        </p>
       
    </div>
</div>

</div>
<div class="msg"><?php showmsg(); ?></div>

<?php if(isset($_SESSION['user_is_logged_in'])){
            $fullname = $_SESSION['user_data']['email'];
           
            // echo "Sesseion";  
        } else{
            // echo "Session failed";
        }
        ?>
        <?php if(isset($_GET['login'])){
            ?>  
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-6 mx-auto">
                            <form class="form-horizontal" role="form" method="post" action="action/login.php">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email"></label>
                                    <div class="col-sm-10">
                                    <input type="email" name="username" class="form-control" id="email" placeholder="Enter Email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd"></label>
                                    <div class="col-sm-10"> 
                                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <div class="col-sm-offset-2 col-sm-10 text-center">
                                    <button type="submit" class="btn btn-primary text-center" name="submit_login">Login</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
              
            
            
            
            
            
            <?php

           
           
             
        } elseif(isset($_GET['register'])){
            ?>
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-6 mx-auto">
                        <form class="form-horizontal" role="form" method="post" action="action/register.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name"></label>
                            <div class="col-sm-10">
                            <input type="name" name="name" class="form-control" id="name" placeholder="Enter Full Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="sex"></label>
                            <div class="col-sm-10">
                            <select type="" name="sex" class="form-control" id="sex" >
                                <option value="">Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Secret">N/A</option>
                            </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email"></label>
                            <div class="col-sm-10">
                            <input type="email" name="username" class="form-control" id="email" placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd"></label>
                            <div class="col-sm-10"> 
                            <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
                            </div>
                        </div>
                        

                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label><input type="checkbox" required> Accept Agreement</label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10 text-center">
                            <button type="submit" class="btn btn-primary pull-right" name="submit_login">Register</button>
                            <a class="pull-left btn btn-danger" href="../index.php"> Cancel</a>
                            </div>
                        </div>
                    </form>
                        
                </div>
                </div>
            <?php
        }
        ?>
    


<?php
    include("includes/footer.php");
?>