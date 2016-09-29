<?php 
include_once("../scripts/status.php");
if (isset($_SESSION["id"]) && $user_ok == true && $isAdmin == true) { 
    $uid = preg_replace('#[^0-9]#i', '', $_SESSION['id']);
    header("location: index.php");
    exit();
}
?>
<?php 
$greska="";
if (isset($_POST["username"]) && isset($_POST["password"])) {
	$username = $_POST["username"];
  $password = $_POST["password"]; 

  $sql = mysqli_query($db_conx, "SELECT * FROM korisnik WHERE Korisnicko_ime='$username' AND Lozinka='$password' LIMIT 1");

  $existCount = mysqli_num_rows($sql); 
  if ($existCount == 1) {
       while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){ 
             $id = $row["ID_korisnik"];
     }
     $_SESSION["id"] = $id;
     $_SESSION["username"] = $username;
     $_SESSION["password"] = $password;
     header("location: index.php");
     exit();
    } else {
    $greska= '<strong style="color:red">Ne postoji admin s tim podacima!</strong>';
  }
}
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin LogIn</title>
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
                    
                        <a href="../index.php" class="btn btn-warning">POČETNA</a>
                        <a href="#" class="btn btn-warning">AKCIJE</a>
                        <a href="#" class="btn btn-warning">NOVOSTI</a>
                        <a href="#" class="btn btn-warning">KONTAKT</a>
                        <a href="#" class="btn btn-warning">O NAMA</a>
                        <a href="#" class="btn btn-warning">FORUM</a>
                    
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
    <h2 align="center">Izbornik</h2><br>
    <div class="btn-group-vertical">
        <a href="../products.php?category=0" class="btn btn-warning" style="text-align: left;"><img src="../css/link0.png" style="padding-right: 10px;">TRADICIONALNE IGRE</a>
        <a href="../products.php?category=1" class="btn btn-warning" style="text-align: left;"><img src="../css/link3.png" style="padding-right: 10px;">KARTAŠKE IGRE</a>
        <a href="../products.php?category=2" class="btn btn-warning" style="text-align: left;"><img src="../css/link1.png" style="padding-right: 10px;">IGRE NA PLOČI</a>
        <a href="../products.php?category=3" class="btn btn-warning" style="text-align: left;"><img src="../css/link2.png" style="padding-right: 10px;">DODATNA OPREMA</a>
    </div>
</div>
   <div class="col-md-9">
   <h2 align="center">Admin LogIn</h2><br>
   <div class="trans-back">
              <?php echo $greska; ?>
      <form id="form1" name="form1" method="post" action="login.php">
        User Name:<br />
          <input name="username" type="text" id="username" size="40" />
        <br /><br />
        Password:<br />
       <input name="password" type="password" id="password" size="40" />
       <br />
       <br />
       <br />
         <input type="submit" name="button" id="button" class="btn btn-success" value="Log In" />
      </form>
            </div>
        </div>
    </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>