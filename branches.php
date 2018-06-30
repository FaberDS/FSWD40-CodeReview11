<?php
     include('includes/header.php');

    include('config/pdocon.php');
    include('includes/functions.php');
    $db = new Pdocon;

     
    $db->query("SELECT `locations`.`location` FROM `locations` WHERE `locations`.`branch`= 'true'");
 
    $rows = $db->fetchMultiple();
   
?>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
<div class="container">
    <div id="amount" ><?= count($rows);?></div>
    <div class="row">
        <div class="col-md-10 col-sm-12 mx-auto m-5">
            <div class="jumbotron">
                <h1>Our branches</h1>
                <?php
                    foreach($rows as $row) :?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p class="card-text"><?= $row['location'];?></p>
                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
<div id="map"></div>
<div id="map2"></div>
<div id="map3"></div>
<div id="map4"></div>
<div id="map5"></div>




<?php
$php_variable = count($rows); //Define our PHP variable. You can of course get the value of this variable however you need.
?>			
        <script> amountLocation = "<?php echo $php_variable; ?>";</script>


<script>
 

       var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
   

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVvV88TFkXyRRYf72Ws0A2m0KEwkc44dc&callback=initMap"
    async defer></script>
<?php
    include('includes/footer.php');
?>