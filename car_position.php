<?php
     include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');
    
    if(isset($_SESSION['user_is_logged_in'])){
        $u_id = $_SESSION['user_data']['id'];
        $u_name = $_SESSION['user_data']['fullname'];
            
        }
     
    $db1 = new Pdocon;
 
    $db1->query('SELECT * FROM `cars`
                LEFT JOIN `locations`ON `cars`.`fk_location_id`= `locations`.`id`');

    $cars = $db1->fetchMultiple();
 
   
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto text-center m-5">
                <h2>Welcome  <?= $u_name;?></h2>
                <h5>This is a map of the actual position of your cars</h5>
                <div id="map" style="height: 30%;"></div>
                <div class="p-3 bg-light border rounded-bottom h5"id="msg"></div>
            </div>
        </div>
    </div>
  <script>
      var map;
      var $msg_box =document.getElementById('msg');
      $("#msg").hide();
      function initMap() {
          // The location of the branch
        
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 48.210033, lng: 16.363449 },
          zoom: 8
        });
        <?php 
            $i = 0;
            foreach($cars as $car) :
            $i ++;
        ?>
        var branch<?= $i;?> = {lat: <?= $car['lat'];?>, lng: <?= $car['lon'];?>};
        var marker = new google.maps.Marker({position: branch<?= $i;?>, map: map, customInfo: "The ID of this car is <em><?= $car['id'] ?></em><br> it's actual location is <em><?= $car['location'];?>.</em>"});
            marker.addListener('mouseover', function() {
            
                $("#msg").show();
                $msg_box.innerHTML =this.customInfo
                setTimeout(function() {
                    $("#msg").hide()
                }, 4000);
            });
  
        <?php
            endforeach;
        ?>
      }
      
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVvV88TFkXyRRYf72Ws0A2m0KEwkc44dc&callback=initMap"
    async defer></script>
<?php
    include('includes/footer.php');
?>