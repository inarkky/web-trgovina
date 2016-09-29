<?php
include_once("scripts/status.php");

function makeLink($match) {
     $substr = substr($match, 0, 6);
     if ($substr != 'http:/' && $substr != 'https:') {
        $url = 'http://' . $match;
     } else {
        $url = $match;
     }

     return '<a href="' . $url . '">' . $match . '</a>';
}
function makeHyperlinks($text) {
    return preg_replace_callback('/((www\.|(http|https)+\:\/\/)[_.a-zA-Z0-9-]+\.[a-zA-Z0-9\/_:@=.+?,##%&~-]*[^.|\'|\# |!|\(|?|,| |>|<|;|\)])/', function($m) { return makeLink($m[1]); } , $text);
}

  $blabla='';
  $render='';
  $sql="SELECT * FROM novosti WHERE kategorija='about'";
  $query=mysqli_query($db_conx, $sql);
  while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $id=$row['id'];
    $naslov=$row['naslov'];
    $tekst=$row['full'];
    $slika='';

    $render.='
        <div>
          <table class="table">
            ' . $slika . '
            <tr><td><h2 style="font-style:bold;color:#4040bf;">' . $naslov . '</h2></td></tr> 
            <tr><td><span>' . $tekst . '</span></td></tr>  
          </table>
        </div>
    ';
  }
  $blabla = makeHyperlinks($render);

?>
<!DOCTYPE html>
<html>
<head>
<title>O NAMA</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8">
</head>
<body>

<?php include_once('header.php'); ?>
<div class="middle">
        <div class="container">
        <br><br>
  <?php include_once('sidebar.php'); ?><h2 align="center">O nama</h2><br>
   <div class="col-md-9">
            <div class="table-responsive trans-back">
              <?php echo $blabla; ?>

              <br><hr><h2 style="font-style:bold;color:#66bbcc;">Gdje smo</h2><br>
              <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:440px;width:700px;'><div id='gmap_canvas' style='height:440px;width:700px;'></div><div><small><a href="http://embedgooglemaps.com"> embed google map </a></small></div><div><small><a href="http://www.freedirectorysubmissionsites.com/">www.freedirectorysubmissionsites.com</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(51.68905033055675,0.1496464851562651),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(51.68905033055675,0.1496464851562651)});infowindow = new google.maps.InfoWindow({content:'<strong>Title</strong><br>London, United Kingdom<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
            </div>

</div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
