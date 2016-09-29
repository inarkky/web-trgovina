<?php
include_once("scripts/status.php");

if ($user_ok != true) { 
        header('location:index.php');
        exit();
}

if ($_GET['kid'] != $_SESSION['id']){
  header('location:user.php?kid=' . $_SESSION['id']);
  exit();
}

if (isset($_GET['kid']) && isset($_POST['ok'])) { 
  $ime=mysqli_real_escape_string($db_conx, $_POST['ime']);
  $pre=mysqli_real_escape_string($db_conx, $_POST['pre']);
  $tel=mysqli_real_escape_string($db_conx, $_POST['tel']);
  $mail=mysqli_real_escape_string($db_conx, $_POST['mail']);
  $adr=mysqli_real_escape_string($db_conx, $_POST['adr']);
  $post=mysqli_real_escape_string($db_conx, $_POST['post']);
  $mjesto=mysqli_real_escape_string($db_conx, $_POST['mjesto']);
  $dr=mysqli_real_escape_string($db_conx, $_POST['dr']);
  $id=mysqli_real_escape_string($db_conx, $_GET['kid']);

  $sql="UPDATE korisnik SET Ime='$ime', Prezime='$pre', Mob_tel='$tel', Email_kor='$mail', Adresa='$adr', Post_broj='$post', Mjesto='$mjesto', Drzava='$dr' WHERE ID_korisnik='$id'";
  $q=mysqli_query($db_conx, $sql);

  header('location:user.php?kid=' . $id);
  exit();
}

if(isset($_GET['kid'])){
  $i=mysqli_real_escape_string($db_conx, $_GET['kid']);
  $render='';
  $sql="SELECT * FROM korisnik WHERE ID_korisnik='$i' LIMIT 1";
  $query=mysqli_query($db_conx, $sql);
  while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $Ime=$row['Ime'];
    $Prezime=$row['Prezime'];
    $Email_kor=$row['Email_kor'];
    $Mob_tel=$row['Mob_tel'];
    $Adresa=$row['Adresa'];
    $Post_broj=$row['Post_broj'];
    $Mjesto=$row['Mjesto'];
    $Drzava=$row['Drzava'];

    $render.='
        <div class="trans-back">
          <form action="user.php?kid=' . $i . '" method="POST">
            <div class="form-group">Ime:
                <input type="text" name="ime" class="form-control" required value="' . $Ime . '">Prezime:<input type="text" name="pre" class="form-control" required value="' . $Prezime . '">
            </div>  
            <div class="form-group">Telefon/mobitel:
                <input type="text" name="tel" class="form-control" required value="' . $Mob_tel . '">E-mail:<input type="text" name="mail" class="form-control" required value="' . $Email_kor . '">
            </div> 
            <div class="form-group">Adresa:
                <input type="text" name="adr" class="form-control" required value="' . $Adresa . '">
                Poštanski broj:
                <input type="text" name="post" class="form-control" required value="' . $Post_broj . '">
                Mjesto:
                <input type="text" name="mjesto" class="form-control" required value="' . $Mjesto . '">
                Država:
                <input type="text" name="dr" class="form-control" required value="' . $Drzava . '">
            </div> 
            <input type="submit" value="PROMJENI" class="btn btn btn-info" name="ok">
          </form>
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
<title><?php echo $Ime . ' ' . $Prezime; ?></title>
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
   <h2 align="center">Promjeni info</h2><br>
              <?php echo $render; ?>
            </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
