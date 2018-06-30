<?php  
    include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');
    if(isset($_SESSION['user_is_logged_in'])){
     $u_id = $_SESSION['user_data']['id'];

    }elseif(!isset($_GET['loc_id'])){
        redirect('branches.php'); 
    }else{
        redirect("index.php");
    }
    $db = new Pdocon;
    $db2 = new Pdocon;
    if(isset($_GET['loc_id'])){
  
        $location_id = $_GET['loc_id'];
        
    }
                               

     $db->query("SELECT `cars`.`type`, `cars`.`available`, `cars`.`brand`, `cars`.`price`, `cars`.`img` FROM `cars`
                WHERE `cars`.`fk_location_id` = $location_id");

    $db2->query("SELECT `branch`.`img`, `branch_address`.`city`, `locations`.`location`, `locations`.`lat`, `locations`.`lon`, `branch_address`.`zipcode`, `branch_address`.`street`, `branch`.`opening_hours`,`branch`.`telenr`  FROM `branch`
                LEFT JOIN  `branch_address` ON `branch`.`fk_branch_address_id`= `branch_address`.`id`
                LEFT JOIN  `locations` ON `branch`.`fk_location_id`= `locations`.`id`
                WHERE `branch`.`fk_location_id` = $location_id");
    $rows = $db->fetchMultiple();
    $branch = $db2->fetchSingle();
?>
    
    <div class="container">
        <div class="row">
            
            <div class="col-md-11 col-sm-11 mx-auto">
                
                    <div class="card" style="width: 100%;">
                        <div class="card-content p-2 d-flex flex-row" style="width: 50% max-width: 100%;">
                        <img class="card-img-top" src="img/branch_img/<?= $branch['img']; ?>" alt="<?= $branch['location'];?> image" >
                            <div class="card-body " style="width: 50%">
                                <h3 class="card-text"><?= $branch['location'];?></h3>
                                <p class="card-text"><i class="fas fa-phone"></i>  <span><?= $branch['telenr'];?></span></p>
                                <p class="card-text"><i class="far fa-clock"></i>  <span><?= $branch['opening_hours'];?></span></p>
                                <p class="card-text"><i class="fas fa-address-book"></i>   <span><?= $branch['street'];?></span></p>
                                <p class="card-text"><i class="fas fa-address-book"></i>   <span><?= $branch['zipcode']." ".$branch['city'];;?></span></p>
                                <p class="card-text">Latitude: <span><?= $branch['lat'];?>°</span></p>
                                <p class="card-text">Longitude: <span><?= $branch['lon'];?>°</span></p>
                            </div>
                            <div class="card-body d-flex d-flex-reverse" style="width: 100%%">
                                
                            </div>
                  

                        </div>
                        <div class="p-2" id="map"></div>
                        <div class="p-3 bg-light border rounded-bottom h5" id="msg"></div>

                        
                        
                    </div>
                
            </div>
            <div class="col-md-8 col-sm-12 mx-auto">
                
                <h3>Available cars at this branch</h3>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th scope="col">IMG</th>
                            <th scope="col">Type</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Price</th>
                            <th scope="col">Available Status</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($rows as $row) :
                            ?>
                            <tr>
                                <th scope="row"><img src="img/car_img/<?= $row['img'] ?>" alt="" style="width: 100%" ></th>
                                <td><?= $row['type'] ?></td>
                                <td><?= $row['brand'] ?></td>
                                <td><?= $row['price'] ?></td>
                                <td><span class="<?= $row['available'];?>">
                                                        <?php
                                                            
                                                            if($row['available'] == 'true'){
                                                                echo "<i class='far fa-check-circle'></i>";
                                                            } else {
                                                                echo "<i class='fas fa-times-circle'></i>"; 
                                                            }
                                                        ?>
                                                    </span></td>
                                <td class="text-dark"><a href="#"><i class="fas fa-pen"></i></a>          <a href="#"><i class="fas fa-book"></i></a>  </td>
                                <td></td>
                            </tr>
                            <?php
                                endforeach ;
                            ?>
                            
                        </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <script>
      var map;
      var $msg_box =document.getElementById('msg');
      $("#msg").hide();
      function initMap() {
          // The location of the branch
        var branch = {lat: <?= $branch['lat'];?>, lng: <?= $branch['lon'];?>};
        map = new google.maps.Map(document.getElementById('map'), {
          center: branch,
          zoom: 12
        });
        var marker = new google.maps.Marker({position: branch, map: map,customInfo: "This is the <em><?= $branch['location'];?></em> Rental Station!"});
        marker.addListener('mouseover', function() {
            
            $("#msg").show();
            $msg_box.innerHTML =this.customInfo
            setTimeout(function() {
                $("#msg").hide()
            }, 3000);
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVvV88TFkXyRRYf72Ws0A2m0KEwkc44dc&callback=initMap"
    async defer></script>


<?php
   
?>
    
<?php
    include("includes/footer.php");
?>