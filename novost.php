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

if(isset($_POST['id'])){
  $i=mysqli_real_escape_string($db_conx, $_POST['id']);
  $blabla='';
  $render='';
  $sql="SELECT * FROM novosti WHERE id='$i' LIMIT 1";
  $query=mysqli_query($db_conx, $sql);
  while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $id=$row['id'];
    $naslov=$row['naslov'];
    $tekst=$row['full'];
    $slika=$row['slika'];

    $render.='
        <div class="table-responsive trans-back">
          <table class="table">
            <tr>
              <td><img src="' . $slika . '" style="width:100%;"></td>
            </tr>
            <tr><td><h2 style="font-style:bold;color:#4040bf;">' . $naslov . '</h2></td></tr> 
            <tr><td><span>' . $tekst . '</span></td></tr>  
          </table>
        </div>
    ';
  }
  $blabla = makeHyperlinks($render);
}else{
  $blabla="GRESKA: Clanak ne postoji";
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $naslov; ?></title>
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
  <?php include_once('sidebar.php'); ?><br><br><br><br>
   <div class="col-md-9">
   
              <?php echo $blabla; ?>
              <br>
</div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
