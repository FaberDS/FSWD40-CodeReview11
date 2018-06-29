<?php 
include('../includes/header.php'); 


//Include functions
include('../includes/functions.php');




?>

 
<?php
/************** Register new Admin ******************/


//require database class files
require('../config/pdocon.php');


//instatiating our database objects
$db = new Pdocon;


//Collect and clean values from the form // Collect image and move image to upload_image folder

if(isset($_POST['submit_login'])){

    $raw_name           =   cleandata($_POST['name']);
    $raw_sex            =   cleandata($_POST['sex']);
    $raw_email          =   cleandata($_POST['username']);
    $raw_password       =   cleandata($_POST['password']);
    
    
    $c_name             =   sanitize($raw_name);
    $c_sex              =   sanitize($raw_sex);
    $c_email            =   valemail($raw_email);
    $c_password         =   sanitize($raw_password);
    
    $hashed_Pass        =   hashpassword($c_password);
        
    
    $db->query("SELECT * FROM users WHERE email = :email");
    
    $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    
    if($row){
        redirect('../index.php?register');
        keepmsg('<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User already Exist. Register or Try Again
            </div>');
        
    }else{
        
        $db->query("INSERT INTO users(`id`, `full_name`, `email`, `password`, `sex`) VALUES(NULL, :fullname, :email, :password, :sex) ");
        
        $db->bindvalue(':fullname', $c_name, PDO::PARAM_STR);
        $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
        $db->bindvalue(':password', $hashed_Pass, PDO::PARAM_STR);
        $db->bindvalue(':sex', $c_sex, PDO::PARAM_STR);
        
        $run = $db->execute();
        
        if($run){
            redirect('../index.php?login');
            keepmsg('<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Your registration was successfully.  Please Login
                  </div>');
            
        }else{
            redirect('../index.php?register');

            keepmsg('<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> Admin user could not be registered. Please try again later
            </div>');
        }
        
        
    }
    
    
    
}



?>
