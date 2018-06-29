<?php
ob_start();
session_start();
require('../config/pdocon.php');
session_start();//session is a way to store information (in variables) to be used across multiple pages.

unset($_SESSION['user_is_logged_in']);
session_unset();

session_destroy(); 

header("Location:../index.php");//use for the redirection to some page  


?>