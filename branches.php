<?php
     include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');
    $db = new Pdocon;
    $db2 = new Pdocon;

     
    $db->query("SELECT * FROM `branch`
                LEFT JOIN `locations` ON `branch`.`fk_location_id`= `locations`.`id`
                LEFT JOIN `branch_address` ON `branch`.`fk_branch_address_id` = `branch_address`.`id`
                WHERE `locations`.`branch`= 'true'");
 
    $rows = $db->fetchMultiple();
     
    $db2->query("SELECT `cars`.`model`, `cars`.`fk_location_id` FROM `cars`
                LEFT JOIN `locations` ON `cars`.`fk_location_id`= `locations`.`id`");
 
    $cars = $db->fetchMultiple();
?>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
        
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto m-1">
            <div class="jumbotron">
                <h1>Our branches</h1>
                <?php
                    
                    $temp = 0;
                    foreach($rows as $row) :
                    $temp ++;
                    ?>
                    <div class="card" style="width: 90%;">
                        <div class="card-content d-flex flex-row" style="width: 100%">
                            <div class="card-body " style="width: 50%">
                                <h3 class="card-text"><?= $row['location'];?></h3>
                                <p class="card-text"><i class="fas fa-phone"></i>  <span><?= $row['telenr'];?></span></p>
                                <p class="card-text"><i class="far fa-clock"></i>  <span><?= $row['opening_hours'];?></span></p>
                                <p class="card-text"><i class="fas fa-address-book"></i>   <span><?= $row['street'];?></span></p>
                                <p class="card-text"><i class="fas fa-address-book"></i>   <span><?= $row['zipcode']." ".$row['city'];;?></span></p>
                                <p class="card-text"><i class="fas fa-address-book"></i>   <span><?= $row['country'];?></span></p>
                                <p class="card-text">Latitude: <span><?= $row['lat'];?>°</span></p>
                                <p class="card-text">Longitude: <span><?= $row['lon'];?>°</span></p>
                            </div>
                            <div class="card-body d-flex d-flex-reverse" style="width: 50%">
                                <img class="card-img-top" src="img/branch_img/<?= $row['img']; ?>" alt="<?= $row['location'];?> image" >
                            </div>
                  

                        </div>
                        
                        <div class="card-body d-flex d-flex-reverse" >
                            <a class="btn btn-primary btn-lg" href="branch_cars.php?loc_id=<?= $row['fk_location_id']?>">See available Cars at this branch</a>
                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
    </div>
</div>





<?php
$php_variable = count($rows); //Define our PHP variable. You can of course get the value of this variable however you need.
?>			
        <script> amountLocation = "<?php echo $php_variable; ?>";</script>


<script>
 

    //    var map;
    //   function initMap() {
    //     map = new google.maps.Map(document.getElementById('map'), {
    //       center: {lat: -34.397, lng: 150.644},
    //       zoom: 8
    //     });
    //   }
   

</script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVvV88TFkXyRRYf72Ws0A2m0KEwkc44dc&callback=initMap"
    async defer></script> -->
<?php
    include('includes/footer.php');
?>