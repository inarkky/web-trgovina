<?php
include_once("scripts/status.php");

if(isset($_GET['id'])){
  $i=mysqli_real_escape_string($db_conx, $_GET['id']);
  $render='';
  $sql="SELECT * FROM proizvod WHERE ID_pro='$i' LIMIT 1";
  $query=mysqli_query($db_conx, $sql);
  while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $id=$row['ID_pro'];
    $ime=$row['Naziv_pro'];
    $opis=$row['Opis_pro'];
    $cijena=$row['Cijena_kn'];
    $kol=$row['Kol_lager'];
    $slika=$row['Slika_pro'];
    $kkk=$row['VK_pkat'];
    $akcija=$row['akcija'];
    $stara_cijena=$row['stara_cijena'];

    $kategorija=mysqli_fetch_array(mysqli_query($db_conx, "SELECT * FROM kategorija_proizvod WHERE ID_pkat=$kkk"));

    $form="";
    if ($user_ok == true) { 
        $form='<form action="cart.php" method="POST"><input type="hidden" name="pid" value="' . $id . '"><input type="submit" class="btn btn-warning" name="ok" value="STAVI U KOŠARICU"></form>';
    }

    $render.='
        <div class="table-responsive trans-back">
          <table class="table">
            <tr>
              <td><img src="' . $slika . '" style="width:300px;max-height:350px"></td>
              <td>
                <table>
                  <tr><td><span style="font-style:italic;color:#66bbcc;">' . $kategorija['Naziv_pkat'] . '</span></td></tr>
                  <tr><td>' . $opis . '<hr></td></tr>';
    if($akcija==1){$render .= ' <tr><td colspan="2"> <h5 class="pull-right" style="text-decoration: line-through;">' . $stara_cijena . ' kn</h5></td></tr>';}
    $render.='<tr><td>Dostupno jos: ' . $kol . ' komada.</td><td id="ovdje">' . $cijena . ' HRK</td></tr>
                  <tr><td colspan="2" align="right">' . $form . '</td></tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
    ';
  }
}else{
  $render="GRESKA: Proizvod ne postoji";
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $ime; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8">
<script>
  function swap(a){ 
    var b = <?php echo $cijena; ?>;
    var url = "scripts/ajax_parser.php";
    $.post(url,{m:b, c:a},function(data){
      $("#ovdje").html(data).show();
    });
  }  
</script>
</head>
<body>

<?php include_once('header.php'); ?>
<div class="middle">
        <div class="container">
        <br><br>
  <?php include_once('sidebar.php'); ?>
   <div class="col-md-9">
   <h2 align="center"><?php echo $ime; ?></h2><br>
              <?php echo $render; ?>
              <br>
              <div class="trans-back">
<input type="button" class="btn btn-warning" value="HRK" onmousedown="javascript:swap('HRK')">
<input type="button" class="btn btn-warning" value="EUR" onmousedown="javascript:swap('EUR')">
<input type="button" class="btn btn-warning" value="USD" onmousedown="javascript:swap('USD')">
            </div></div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
