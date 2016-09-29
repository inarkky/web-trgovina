<?php
include_once("scripts/connect.php"); 
$user_ok=false;
?>
<?php
if (isset($_POST["username"])) { 

    $username = mysqli_real_escape_string($db_conx, $_POST['username']);
    $password = mysqli_real_escape_string($db_conx, $_POST['password']);
    $ime = mysqli_real_escape_string($db_conx, $_POST['ime']);
    $prezime = mysqli_real_escape_string($db_conx, $_POST['prezime']); 
    $adresa = mysqli_real_escape_string($db_conx, $_POST['adresa']);
    $email = mysqli_real_escape_string($db_conx, $_POST['email']); 
    $tel = mysqli_real_escape_string($db_conx, $_POST['tel']);
    $post = mysqli_real_escape_string($db_conx, $_POST['post']); 
    $mjesto = mysqli_real_escape_string($db_conx, $_POST['mjesto']);
    $drzava = mysqli_real_escape_string($db_conx, $_POST['drzava']); 
    $spol = mysqli_real_escape_string($db_conx, $_POST['kat']);
    $datum = mysqli_real_escape_string($db_conx, $_POST['date']); 

 
        $sql = "INSERT INTO korisnik (Ime, Prezime, Spol, Datum_rodjenja, Adresa, Email_kor, Mob_tel, Post_broj, Mjesto, Korisnicko_ime, Lozinka, Drzava, VK_uloga) VALUES ('$ime', '$prezime', '$spol', '$datum', '$adresa', '$email', '$tel', '$post', '$mjesto', '$username', '$password', '$drzava', '2')";
        $query = mysqli_query($db_conx, $sql);

            header("location: login.php"); 
            exit();

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Prijava</title>
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
  <div class="col-md-2"></div>
   <div class="col-md-4">
   <h2 align="center">Registrirajte se</h2><br>
        <form action="reg.php" method="POST">
            <div class="form-group">
                <input type="text" name="ime" class="form-control" required placeholder="ime">
            </div>
            <div class="form-group">
                <input type="text" name="prezime" class="form-control" required placeholder="prezime">
            </div>
            <div class="form-group">
                <input type="text" name="adresa" class="form-control" required placeholder="adresa">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" required placeholder="email">
            </div>
            <div class="form-group">
                <input type="text" name="tel" class="form-control" required placeholder="telefon">
            </div>
            <div class="form-group">
                <input type="text" name="post" class="form-control" required placeholder="postanski broj">
            </div>
            <div class="form-group">
                <input type="text" name="mjesto" class="form-control" required placeholder="mjesto">
            </div>
            <div class="form-group">
                <input type="text" name="drzava" class="form-control" required placeholder="drzava">
            </div>
            <div class="form-group">
                <select name="spol" class="form-control"><option value="M" selected>Musko</option><option value="Z">Zensko</option></select>
            </div>
            <div class="form-group">
                <input type="date" name="datum" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" class="form-control" required placeholder="username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="REGISTRIRAJ SE">
            </div>
        </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>


