<?php 
include_once("../scripts/status.php");
if (isset($_SESSION["id"]) && $user_ok == true && $isAdmin == true) { 
    $uid = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
}else{
    header('location: login.php');
    exit();
}
if(isset($_POST['ok'])){
    $i = mysqli_real_escape_string($db_conx, $_POST['id']);
    $ime=mysqli_real_escape_string($db_conx, $_POST['ime']);
    $opis=mysqli_real_escape_string($db_conx, $_POST['opis']);
    $tekst=mysqli_real_escape_string($db_conx, $_POST['tekst']);
    $kategorija=mysqli_real_escape_string($db_conx, $_POST['kategorija']);
    $sql0 = "UPDATE novosti SET naslov='$ime', short='$opis', full='$tekst', kategorija='$kategorija' WHERE id='$i'";
    $query0 = mysqli_query($db_conx, $sql0);
    $newname='images/cl_' . $i . '.jpg';
    if (isset($_FILES['slika']['tmp_name'])) {
      $add = '../' . $newname;
      move_uploaded_file($_FILES['slika']['tmp_name'], $add);
      $sql1 = "UPDATE novosti SET slika='$newname' WHERE id='$novi'";
      $query1 = mysqli_query($db_conx, $sql1);
    } 

    header('location: news.php');
    exit();
}
if(isset($_POST['del'])){
    $i = mysqli_real_escape_string($db_conx, $_POST['id']);
    $sql0 = "DELETE FROM novosti WHERE id='$i'";
    $query0 = mysqli_query($db_conx, $sql0);
    $filename='../images/cl_' . $i . '.jpg';
    unlink($filename);
    header('location: news.php');
    exit();
}
if(isset($_POST['edit'])){
    $i = mysqli_real_escape_string($db_conx, $_POST['id']);
    $sql0 = "SELECT * FROM novosti WHERE id='$i' LIMIT 1";
    $query0 = mysqli_query($db_conx, $sql0);
    $row = mysqli_fetch_array($query0);
    $ime=$row['naslov'];
    $short=$row['short'];
    $full=$row['full'];

    $rend='
         <form action="news_edit.php" method="POST" enctype="multipart/form-data">
            <table style="margin-left:200px;margin-top:25px;">
                <tr>
                    <td><label>Naslov: </label></td>
                    <td><input type="text" name="ime" value="' . $ime . '" required></td>
                </tr>
                <tr>
                    <td><label>Kratki opis: </label></td>
                    <td><textarea name="opis" required>' . $short . '</textarea></td>
                </tr>   
                <tr>
                    <td><label>Tekst: </label></td>
                    <td><textarea name="tekst" required>' . $full . '</textarea></td>
                </tr>
                <tr>
                    <td><label>Kategorija: </label></td>
                    <td><select name="kategorija"><option value="novosti" selected>Novosti</option><option value="about" selected>O nama</option></select></td>
                </tr>       
                <tr>
                    <td><label>Slika: </label></td>
                    <td><input type="file" name="slika" id="slika"></td>
                </tr>       
                <tr>
                    <td><input type="hidden" name="id" value="' . $i . '"></td>
                    <td align="right"><input name="ok" class="btn btn-primary" type="submit" value="POTVRDI"></td>
                </tr>   
            </table>
          </form>
    ';

}else{
    $rend="Proizvod nije odabran!";
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
                    
                        <<a href="../index.php" class="btn btn-warning">NASLOVNA</a>
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
  <h2 align="center">UREDI ČLANAK</h2>
  <div class="trans-back">
    <?php echo $rend; ?>
    </div>
    <br>
  </div>
</div>
</div>
<div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>