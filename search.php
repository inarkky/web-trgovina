<?php
include_once("scripts/status.php");

if(!isset($_GET['q'])){
  header('location: index.php');
  exit();
}


$rez_p_page=9;
if (isset($_GET['page'])) {
  $page = mysqli_real_escape_string($db_conx, $_GET['page']);
} else {
  $page=1;
}
$start = ($page-1) * $rez_p_page;


$greska="";
$render='';
$q = $_GET['q'];     
  $min = 3;     
  if(strlen($q) >= $min){          
      $q = htmlspecialchars($q);
      $q = mysqli_real_escape_string($db_conx, $q);
      $query = mysqli_query($db_conx, "SELECT * FROM proizvod WHERE (Naziv_pro LIKE '%$q%') AND Kol_lager>0 LIMIT $start, $rez_p_page");         
      if(mysqli_num_rows($query) > 0){ 
          while($row = mysqli_fetch_array($query)){
              $id=$row['ID_pro'];
              $ime=$row['Naziv_pro'];
              $cijena=$row['Cijena_kn'];
              $akcija=$row['akcija'];
              $stara_cijena=$row['stara_cijena'];

              $form="";
                if ($user_ok == true) { 
                    $form='<form action="cart.php" method="POST"><input type="hidden" name="pid" value="' . $id . '"><input type="submit" class="btn btn-warning" name="ok" value="STAVI U KOŠARICU"></form>';
                }


              $render.='
                  <li style="background: white;">
                    <a href="product.php?id=' . $id . '">
                      <img src="images/' . $id . '.jpg" alt="slika"/>
                      <hr>
                      <h4>' . $ime . '</h4>
                    </a>
                    <h5 style="color:red; font-weight:bold;" class="pull-left">' . $cijena . ' kn</h5>
                    ';
                    if($akcija==1){ $render .= '<h5 class="pull-left" style="text-decoration: line-through;">' . $stara_cijena . ' kn</h5>';}
              $render.=  $form . '
                  </li>
              ';
          } 
      }
      else{ 
          $greska="Nema proizvoda koji sadrze taj upit.";
      }
       
  }
  else{
      $greska= "Najmanje " . $min . " slova";
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Trazilica</title>
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
  <?php include_once('sidebar.php'); ?>
   <div class="col-md-9">
   <h2 align="center">Najnovije u ponudi</h2><br>
                <?php echo $greska; ?>
              <ul class="rig columns-3">
                <?php echo $render; ?>
              </ul>

<?php

$page_sql = "SELECT * FROM proizvod WHERE (Naziv_pro LIKE '%$q%') AND Kol_lager>0";
$result = mysqli_query($db_conx, $page_sql);
$rows_total = mysqli_num_rows($result);
$pages_total = ceil($rows_total / $rez_p_page);

echo "<center><a class='btn btn-default' href='search.php?q=" . $q . "&page=1'>Prva</a> ";

for ($i=1; $i<=$pages_total; $i++) {

echo "<a class='btn btn-default' href='search.php?q=" . $q . "&page=" . $i . "'>" . $i . "</a> ";
};

echo "<a class='btn btn-default' href='search.php?q=" . $q . "&page=" . $pages_total . "'>Zadnja</a></center> ";
?>

            </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
