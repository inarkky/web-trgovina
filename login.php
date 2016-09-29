<?php
include_once("scripts/status.php"); 

if ($user_ok == true) {
    header("location: index.php");
    exit();
}
?>
<?php
$error="";
if (isset($_POST["username"])) { 

    $username = mysqli_real_escape_string($db_conx, $_POST['username']);
    $password = mysqli_real_escape_string($db_conx, $_POST['password']);  

 
        $sql = "SELECT * FROM korisnik WHERE Korisnicko_ime='$username' AND Lozinka='$password'";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $db_id = $row['ID_korisnik'];
        $db_user = $row['Korisnicko_ime'];
        $db_pass = $row['Lozinka'];

        if ($password != $db_pass || $username != $db_user) {
            $error = "NETOCNI PODACI!";
        } else { 
            $_SESSION['id'] = $db_id;
            $_SESSION['username'] = $db_user;
            $_SESSION['password'] = $db_pass;

            header("location: index.php"); 
            exit();
        }

    
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
   <div class="col-md-9">
   <h2 align="center">Prijavite se</h2><br>
              <form action="login.php" method="POST">
                <div class="form-group"><h4 style="color: red;font-weight: bold;"><?php echo $error; ?></h4></div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" required placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" required placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-left" value="PRIJAVI SE">
                    <br>
                    <span class="pull-right"><a href="reg.php">Niste član? Registrirajte se ovdje.</a></span>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>


