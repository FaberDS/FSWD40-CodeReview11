  <?php  
        include('includes/header.php');

        include('config/pdocon.php');
        include('includes/functions.php');

        if(isset($_SESSION['user_is_logged_in'])){
            $fullname = $_SESSION['user_data']['fullname'];
           ?>
                <div class="card">
   
                    <small class="pull-right">Hello <?= $fullname?> </small>
                </div>
           <?php
            echo "Sesseion";  
        } else{
            echo "Session not loged in !!!!";
        }
        
        ?>
        <div class="msg"><?php showmsg(); ?></div>

  
 
    