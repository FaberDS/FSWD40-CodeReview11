<?php
     include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');
    
    if(isset($_SESSION['user_is_logged_in'])){
        $u_id = $_SESSION['user_data']['id'];
            
        }
     
    $db1 = new Pdocon;
    $db2 = new Pdocon;
  
   
    $db1->query('   SELECT `cars`.`id` 
                    as ID, `locations`.`location` 
                    as loc,COUNT(*) 
                    as cou FROM `cars`
                    JOIN `locations` 
                    ON `cars`.`fk_location_id` = `locations`.`id`
                    GROUP BY fk_location_id 
                    ORDER BY cou DESC ');
    
   
    $branches = $db1->fetchMultiple();

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-11 mx-auto bg-light text-center m-5">
                <h1>Welcome Admin </h1>
                <div class="table-responsive">  
                    <table class="table table-striped">
                        <thead>
                            <tr class="h4">
                                <th>Location Name:</th>
                                <th>Amount of Cars:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($branches as $branch) :
                            ?>
                            <tr>
                                <td><?= $branch['loc'];?></td>
                                <td><?= $branch['cou'];?>
                                    
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                    </div> 
            </div>
        </div>
    </div>
    
<?php
    include('includes/footer.php');
?>