<?php
     include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');
    
    if(isset($_SESSION['user_is_logged_in'])){
        $u_id = $_SESSION['user_data']['id'];
            
        }
     
    $db1 = new Pdocon;
    $db2 = new Pdocon;
    
   
    $db1->query('SELECT * FROM `users` WHERE `users`.`id`='.$u_id.'' );
    $db2->query('SELECT * FROM `locations` WHERE `locations`.`branch`= "true"');
        //have to count cars per location and print

    $admin = $db1->fetchSingle();
    $branches = $db2->fetchMultiple();
 
   
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto text-center m-5">
                <h2>Welcome Admin <?= $admin['full_name'];?></h2>
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th>Location Name:</th>
                            <th>Amount of Cars:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($branches as $branch) :
                        ?>
                        <tr>
                            <td><?= $branch['location'];?></td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
    include('includes/footer.php');
?>