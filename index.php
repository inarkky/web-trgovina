<?php
include_once("scripts/status.php");

$render='';
$sql="SELECT * FROM proizvod WHERE Kol_lager>0 ORDER BY ID_pro DESC LIMIT 9";
$query=mysqli_query($db_conx, $sql);
while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
  $id=$row['ID_pro'];
  $ime=$row['Naziv_pro'];
  $cijena=$row['Cijena_kn'];
  $akcija=$row['akcija'];
  $stara_cijena=$row['stara_cijena'];

  $form="";
    if ($user_ok == true) { 
        $form='<form action="cart.php" method="POST" class="pull-right"><input type="hidden" name="pid" value="' . $id . '"><input type="submit" class="btn btn-warning" name="ok" value="STAVI U KOŠARICU"></form>';
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
?>
<!DOCTYPE html>
<html>
<head>
<title>IME TRGOVINE</title>
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
              <ul class="rig columns-3">
                <?php echo $render; ?>
              </ul>
            </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
