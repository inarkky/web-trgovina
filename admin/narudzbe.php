<?php
include_once("../scripts/status.php");
if (isset($_SESSION["id"]) && $user_ok == true && $isAdmin == true) { 
    $uid = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
}else{
	header('location: login.php');
	exit();
}	
	//$add= basename($_SERVER['PHP_SELF']);
	$fajlovi ='';
	$path = "../pdfs/"; 
    $dir_handle = @opendir($path) or die("Folder $path ne postoji!");  
    while ($file = readdir($dir_handle)) { 
    if($file == "." || $file == ".." || $file == "download.php" ) 
        continue; 
        $fajlovi .='<a href="../pdfs/download.php?file=' . $file . '">' . $file . '</a><br />'; 
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

	<h2 align="center">Narudžbe</h2><br>
    <div class="trans-back">
  		<?php echo $fajlovi; ?>
    </div>
        </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>



