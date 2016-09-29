<?php 
include_once("../scripts/status.php");
if (isset($_SESSION["id"]) && $user_ok == true && $isAdmin == true) { 
    $uid = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
}else{
	header('location: login.php');
	exit();
}
if(isset($_POST['ime'])){
    $i = mysqli_real_escape_string($db_conx, $_POST['ime']);
    $o = mysqli_real_escape_string($db_conx, $_POST['opis']); 
    $c = mysqli_real_escape_string($db_conx, $_POST['cijena']);
    $k = mysqli_real_escape_string($db_conx, $_POST['kolicina']); 
    $y = mysqli_real_escape_string($db_conx, $_POST['kat']); 

    $sql0 = "INSERT INTO proizvod (Naziv_pro, Opis_pro, Cijena_kn, Kol_lager, VK_pkat) VALUES ('$i', '$o', '$c', '$k', '$y')";
    $query0 = mysqli_query($db_conx, $sql0);
    $novi=mysqli_insert_id($db_conx);
    $newname = 'images/' . $novi . '.jpg';
    if (isset($_FILES['slika']['tmp_name'])) {
      $add = '../' . $newname;
      move_uploaded_file($_FILES['slika']['tmp_name'], $add);
      $sql1 = "UPDATE proizvod SET Slika_pro='$newname' WHERE ID_pro='$novi'";
      $query1 = mysqli_query($db_conx, $sql1);
    } 

    header('location: products.php');

}
$out="";
$opcije=mysqli_query($db_conx, "SELECT * FROM kategorija_proizvod");
while($row=mysqli_fetch_array($opcije, MYSQLI_ASSOC)){
	$id=$row['ID_pkat'];
	$ime=$row['Naziv_pkat'];

	$out .= '<option value="' . $id . '">' . $ime . '</option>'; 
}
$rend="";
$op=mysqli_query($db_conx, "SELECT * FROM proizvod");
while($row=mysqli_fetch_array($op, MYSQLI_ASSOC)){
	$id=$row['ID_pro'];
	$ime=$row['Naziv_pro'];
  $akcija=$row['akcija'];

  $babymaybe="";

  if($akcija != 0){ $babymaybe ='<span class="glyphicon glyphicon-ok" style="color:green"></span>';}

	$rend .= '
	<tr><form action="edit.php" method="POST"><input type="hidden" name="id" value="' . $id . '">
		<td>' . $id . '</td>
		<td>' . $ime . '</td>
    <td>' . $babymaybe . '</td>
		<td><input class="btn btn-info" type="submit" name="edit" value="UREDI"></td>
		<td><input class="btn btn-danger" type="submit" name="del" value="OBRISI"></td>

	</form></tr>
	'; 
}
?>
<!DOCTYPE html>
<html>
<head>
<title>IME TRGOVINE</title>
<meta charset="utf-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/style.css" type="text/css" charset="utf-8">
</head>

<body>

<header class="top" role="header">
    <br>
        <div class="container">
            <a href="index.php" class="navbar-brand pull-left">
                <img id="logo" src="../css/12767486_10206844636526955_1280307777_n.png">
            </a>
            
            <h1 align="center"><b>Wizard store</b></h1>
            <div class="row">
                <nav class="navbar-collapse collapse" style="padding-top: 16px;" role="navigation">
                <div class="btn-group">
                    
                        <a href="../index.php" class="btn btn-warning">NASLOVNA</a>
                        <a href="#" class="btn btn-warning">AKCIJE</a>
                        <a href="#" class="btn btn-warning">NOVOSTI</a>
                        <a href="#" class="btn btn-warning">KONTAKT</a>
                        <a href="#" class="btn btn-warning">O NAMA</a>
                        <a href="#" class="btn btn-warning">FORUM</a>
                    
                    </div>
                    <div class="btn-group pull-right">
                    
                        <a href="../logout.php" class="btn btn-warning">LOGOUT</a>
                    
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="banner">
        <div class="container">
            <img src="../css/12755429_10206844745369676_2020078953_o.jpg" />
        </div>
    </div>
<div class="middle">
        <div class="container">
        <br><br>
  <div class="col-md-3 content">
    <h2 align="left">Izbornik</h2><br>
    <div class="btn-group-vertical">
            <a href="index.php" class="btn btn-warning" style="text-align: left;">INFO O PODUZEĆU</a>
        <a href="products.php" class="btn btn-warning" style="text-align: left;">PROIZVODI</a>
        <a href="narudzbe.php" class="btn btn-warning" style="text-align: left;">NARUDŽBE</a>
        <a href="news.php" class="btn btn-warning" style="text-align: left;">NOVOSTI</a>
        <a href="../logout.php" class="btn btn-warning" style="text-align: left;">LOGOUT</a>
    </div>
</div>
   <div class="col-md-9">
  <h2 align="center">NOVI PROIZVOD</h2>
  <div class="trans-back">
  <form action="products.php" method="POST" enctype="multipart/form-data">
	<table style="margin-left:200px;margin-top:25px;">
		<tr>
			<td><label>Naziv proizvoda: </label></td>
			<td><input type="text" name="ime" value="" required></td>
		</tr>
		<tr>
			<td><label>Opis proizvoda: </label></td>
			<td><textarea name="opis" required></textarea></td>
		</tr>	
		<tr>
			<td><label>Cijena: </label></td>
			<td><input type="text" name="cijena" value="" required> kn</td>
		</tr>	
		<tr>
			<td><label>Količina: </label></td>
			<td><input type="text" name="kolicina" value="" required></td>
		</tr>
		<tr>
			<td><label>Kategorija: </label></td>
			<td><select name="kat"><?php echo $out; ?></select></td>
		</tr>		
		<tr>
			<td><label>Slika: </label></td>
			<td><input type="file" name="slika" id="slika"></td>
		</tr>		
		<tr>
			<td></td>
			<td align="right"><input name="ok" class="btn btn-primary" type="submit" value="DODAJ"></td>
		</tr>	
	</table>
  </form>
  </div>
  <br>
  <div class="trans-back">
  <h2 align="center">LISTA PROIZVODA</h2>
  <div class="table-responsive"><table class="table table-hover table-condensed">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>IME PROIZVODA</th>
                                <th>NA AKCIJI</th>
                                <th colspan="2" align="center">OPERACIJE</th>
                              </tr>
                            </thead>
		<?php echo $rend; ?></table>
	</table>
    </div>
    </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>