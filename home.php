<?php  
    include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');

    if(isset($_SESSION['user_is_logged_in'])){
        $fullname = $_SESSION['user_data']['fullname'];
        ?>
            <div class="container">
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
                <div class="row">
                    <?php
                        //Create a card for each car
   
                        $db->query('    SELECT * FROM `cars`
                                        LEFT JOIN `locations`
                                            ON `cars`.`fk_location_id` = `locations`.`id`
                                        LEFT JOIN `car_descriptions` 
                                            ON `cars`.`fk_car_description_id` = `car_descriptions`.`id`');

                        $results = $db->fetchMultiple();
 
                            
                        //Fetch all data and keep in a result set
                        $row = $db->fetchSingle();
                        if($row){
                            echo "data";
                        }
                    ?>
                </div>
    
            </div>

 
    