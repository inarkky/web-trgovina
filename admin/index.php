<?php 
include_once("../scripts/status.php");
if (isset($_SESSION["id"]) && $user_ok == true && $isAdmin == true) { 
    $uid = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
}else{
	header('location: login.php');
	exit();
}
if(isset($_POST['ok'])){
	$oib=mysqli_real_escape_string($db_conx, $_POST['oib']);
	$ime=mysqli_real_escape_string($db_conx, $_POST['ime']);
	$pos=mysqli_real_escape_string($db_conx, $_POST['pos']);
	$adr=mysqli_real_escape_string($db_conx, $_POST['adr']);
	$tel=mysqli_real_escape_string($db_conx, $_POST['tel']);
	$rac=mysqli_real_escape_string($db_conx, $_POST['rac']);
	$bank=mysqli_real_escape_string($db_conx, $_POST['bank']);
	$mail=mysqli_real_escape_string($db_conx, $_POST['mail']);

	$sql="UPDATE poduzece SET Naziv_pod='$ime', Naziv_djelatnosti='$pos', Adresa_pod='$adr', Telefon_pod='$tel', Ziroracun='$rac', Naziv_banke='$bank', Email_pod='$mail' WHERE OIB='$oib'";

	$query=mysqli_query($db_conx, $sql);

}
$sql="SELECT * FROM poduzece LIMIT 1";
$query = mysqli_query($db_conx, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$oib=$row['OIB'];
$ime=$row['Naziv_pod'];
$pos=$row['Naziv_djelatnosti'];
$adr=$row['Adresa_pod'];
$tel=$row['Telefon_pod'];
$rac=$row['Ziroracun'];
$bank=$row['Naziv_banke'];
$mail=$row['Email_pod'];
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
                        <a href="../akcije.php" class="btn btn-warning">AKCIJE</a>
                        <a href="../novosti.php" class="btn btn-warning">NOVOSTI</a>
                        <a href="../kontakt.php" class="btn btn-warning">KONTAKT</a>
                        <a href="../o_nama.php" class="btn btn-warning">O NAMA</a>
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
   <div class="trans-back">
	<h2 align="center">Info poduzeća</h2>
  <form action="index.php" method="POST">
	<table style="margin-left:200px;margin-top:50px;">
		<tr>
			<td><label for="ime">Naziv poduzeća</label></td>
			<td><input type="text" name="ime" value="<?php echo $ime; ?>"></td>
		</tr>
		<tr>
			<td><label for="pos">Naziv Djelatnosti</label></td>
			<td><input type="text" name="pos" value="<?php echo $pos; ?>"></td>
		</tr>	
		<tr>
			<td><label for="adr">Adresa poduzeća</label></td>
			<td><input type="text" name="adr" value="<?php echo $adr; ?>"></td>
		</tr>	
		<tr>
			<td><label for="tel">Telefon poduzeća</label></td>
			<td><input type="text" name="tel" value="<?php echo $tel; ?>"></td>
		</tr>	
		<tr>
			<td><label for="rac">Žiroračun</label></td>
			<td><input type="text" name="rac" value="<?php echo $rac; ?>"></td>
		</tr>	
		<tr>
			<td><label for="bank">Naziv banke</label></td>
			<td><input type="text" name="bank" value="<?php echo $bank; ?>"></td>
		</tr>	
		<tr>
			<td><label for="mail">E-mail poduzeća</label></td>
			<td><input type="text" name="mail" value="<?php echo $mail; ?>"></td>
		</tr>	
		<tr>
			<td><input type="hidden" name="oib" value="<?php echo $oib ?>"></td>
			<td align="right"><input name="ok" type="submit" value="PROMJENI"></td>
		</tr>	
	</table>
  </form>
    </div>
        </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>