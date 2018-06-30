
<?php
ob_start();
session_start();
//Include functions
include('../includes/functions.php');

?>

 
<?php

//require or include your database connection file
//require database class files
require('../config/pdocon.php');
    
//instatiating our database objects
$db = new Pdocon;

    //Collect and process Data on login submission
if(isset($_POST['submit_login'])){
    
    $raw_username       =   cleandata($_POST['username']);
    
    $raw_password       =   cleandata($_POST['password']);
    
    
    $c_username         =   valemail($raw_username);            
    
    $hashed_password    =   hashpassword($raw_password);
      
    
    $db->query('SELECT * FROM users WHERE email=:email AND `password`= :password');
    
    $db->bindValue(':email', $c_username, PDO::PARAM_STR);
    $db->bindValue(':password',$hashed_password, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    
    if($row){
        
        
        $d_name         =   $row['full_name'];
        
        
        $_SESSION['user_data'] = array(
        
        
        'fullname'      =>   $row['fullname'],
        'id'            =>   $row['id'],
        'email'         =>   $row['email'],

        );
        $_SESSION['user_is_logged_in']  =  true;
        
        redirect('../home.php');
        
        
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong>' . $d_name . ' you are logged in! 
                </div>');
        
        
        
        
    }else{
        redirect('../index.php?login');
         keepmsg('<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User does not exist. Register or Try Again
            </div>');

    }    
    
    
    
    
}
 

?>
  