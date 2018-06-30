<?php  
    include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');
    if(isset($_SESSION['user_is_logged_in'])){
     $u_id = $_SESSION['user_data']['id'];
           
    }
    $db = new Pdocon;
    $db2 = new Pdocon;
    $db3 = new Pdocon;
    $db4 = new Pdocon;
    $db5 = new Pdocon;

    $db->query('SELECT DISTINCT `cars`.`brand` FROM `cars`');
    $db2->query('SELECT DISTINCT `cars`.`class` FROM `cars`');
    $db3->query('SELECT DISTINCT `cars`.`available` FROM `cars`');
    $db4->query('SELECT * FROM `users` WHERE `users`.`id`='.$u_id.'' );
    $db5->query('SELECT * FROM `locations` WHERE `locations`.`branch`= "true"');

    $brands = $db->fetchMultiple();
    $classes = $db2->fetchMultiple();
    $avails = $db3->fetchMultiple();
    $admin = $db4->fetchSingle();
    $branches = $db5->fetchMultiple();

        ?>
        <div class="container">
            <h1>Our Fleet</h1>
                <div class="msg"><?php showmsg(); ?></div>

                <!-- echo "<a class='dropdown-item' href='details.php?pub_id=".$pub_nam['publisher_id']."'>".$pub_nam['publisher_name']."</a>"; -->
                <?php
                            if($admin['role'] == 'Admin'){
                                ?>
        
                                    
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-lg btn-block"  aria-haspopup="true" aria-expanded="false">
                                       <a href="report.php" class="text-white">List all Locations for Admin</a>
                                        </button>
                                 
                                <?php
                            }
                        ?>
                <div class="row">
                    
                    <div class="btn-group mx-auto m-5" role="group" aria-label="Button group with nested dropdown">
                         <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Classes
                            </button>
                            
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    
                                    <a href="home.php?class=all" class="dropdown-item">All Classes</a>
                                    <div class="dropdown-divider"></div>
                                <?php 
                                        foreach($classes as $class) :
                                        
                                ?>
                                    <a href="home.php?class=<?= $class['class']; ?>" class="dropdown-item"><?= $class['class']; ?></a>
                                <?php    
                                        endforeach;
                                
                                ?>
                            </div>
                            
                        </div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort by Brands
                            </button>
                            
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    
                                    <a href="home.php?brand=all" class="dropdown-item">All Brands</a>
                                    <div class="dropdown-divider"></div>
                                    
                                <?php 
                                        foreach($brands as $brand) :
                                ?>
                                    <a href="home.php?brand=<?= $brand['brand']; ?>" class="dropdown-item"><?= $brand['brand']; ?></a>
                                <?php    
                                        endforeach;
                                
                                ?>
                            </div>
                            
                        </div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Availability
                            </button>
                            
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    
                                    <a href="home.php?brand=all" class="dropdown-item">All</a>
                                    <div class="dropdown-divider"></div>
                                    
                                <?php 
                                        foreach($avails as $avail) :
                                ?>
                                    <a href="home.php?available=<?= $avail['available']; ?>" class="dropdown-item"><?= $avail['available']; ?></a>
                                <?php    
                                        endforeach;
                                
                                ?>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>

                <div class="row" id="cars_row">
                    <?php
                        //Create a card for each car
                        $select_stat = "";
                        

                        if(isset($_GET['brand'])){
                            echo "";
                            $select_val = $_GET['brand'];
                            if($select_val !== "all"){
                                $select_stat = "WHERE `cars`.`brand` ='".$select_val."'";

                            }

                        }
                        if(isset($_GET['class'])){
                            $select_val = $_GET['class'];
                            if($select_val !== "all"){
                                $select_stat = "WHERE `cars`.`class` ='".$select_val."'";

                            }

                        }
                        if(isset($_GET['available'])){
                            $select_val = $_GET['available'];
                            if($select_val !== "all"){
                                $select_stat = "WHERE `cars`.`available` ='".$select_val."'";

                            }else{
                                 $select_stat = "";
                            }

                        }
                        
                        $db->query('SELECT * FROM `cars`
                                        LEFT JOIN `locations`
                                            ON `cars`.`fk_location_id` = `locations`.`id`
                                        LEFT JOIN `car_descriptions` 
                                            ON `cars`.`fk_car_description_id` = `car_descriptions`.`id`
                                        '.$select_stat.'');

                        $rows = $db->fetchMultiple();
 
                            
                        //Fetch all data and keep in a result set
                        if($rows){
                            
                            foreach($rows as $row) :?>
                           
                            <div class="card col-md-6 col-sm-12" >
                                <img class="card-img-top" src='img/car_img/<?= $row['img']?>' alt="Image <?= $row['brand'].$row['model'];?>">
                                <div class="card-header">
                                    <small><h4><?= $row['brand']. " " .$row['model'] ;?></h4><?= $row['type'];?></small>
                                </div>

                                <div class="card-body">
                                    <h5><?= $row['class'];?></h5>
                                    <div class="col-6 float-left">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><i class="fas fa-users"></i><?= $row['passengers'];?></li>
                                            <li class="list-group-item"><i class="fas fa-door-open"></i><?= $row['doors'];?></li>
                                            <li class="list-group-item"><img src="img/logos/aircondition.png" style="width: 25px; height: 25px;" alt="aircondition logo"><?= $row['air_condition'];?></li>
                                        </ul>
                                    </div>
                                    <div class="col-6 float-left">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><i class="fas fa-suitcase"></i> <?= $row['bags'];?></li>
                                            <li class="list-group-item"><i class="fas fa-cogs"></i><?= $row['transmittion'];?></li>
                                            <li class="list-group-item"><p>Available: 
                                                <span class="<?= $row['available'];?>">
                                                    <?php
                                                        
                                                        if($row['available'] == 'true'){
                                                            echo "<i class='far fa-check-circle'></i>";
                                                        } else {
                                                            echo "<i class='fas fa-times-circle'></i>"; 
                                                        }
                                                    ?>
                                                </span></p></li>
                                        </ul>
                                    </div>
                                    
                                    
                                </div>
                                <div class="card-footer">
                                    <div class=" text-center">
                                        <p class="btn btn-success btn-lg btn-block" ><?= $row['price'];?>,00 €</p> 
                                        <a href="#" class="btn btn-lg btn-primary text-center home_book_btn">Book now</a>
                                    </div>
                                </div>
                            </div>

                            
                        <?php endforeach ;

                    }?>
                </div>
    
            </div>
<?php
    include("includes/footer.php");
?>
