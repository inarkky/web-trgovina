<?php
include_once("scripts/status.php");

if(isset($_POST['posalji'])){

  $ime=mysqli_real_escape_string($db_conx, $_POST['ime']);
  $email=mysqli_real_escape_string($db_conx, $_POST['email']);
  $subject=mysqli_real_escape_string($db_conx, $_POST['subject']);
  $comment=mysqli_real_escape_string($db_conx, $_POST['comment']);

  $to = 'neki_mail@gmail.com@gmail.com';
  $from = $email;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

$message = $comment . '<hr>' . $ime;

if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
    header("location:kontakt.php");
    exit();

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Kontakt</title>
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
   <h2 align="center">Kontakt</h2><br>
      <div class="trans-back">
                  <p>Pišite nam ukoliko imate bilo kakvih pitanja ili problema vezano uz kupnju na našem webshopu, ali i ako imate prijedloge, sugestije ili želje vezano uz dostupnost proizvoda, kvalitetu usluge itd. Na sve Vaše upite rado ćemo odgovoriti i to najkasnije do kraja idućeg radnog dana. Također, možete nas kontaktirati i na broj telefona ili putem nee od naših mreža.</p><hr>
                  <form action="kontakt.php" class="form-horizontal" method="POST">
<fieldset>

<div class="form-group">
  <label class="col-md-4 control-label">Ime</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="ime" placeholder="Vaše ime" class="form-control" required type="text">
    </div>
  </div>
</div>

       <div class="form-group">
  <label class="col-md-4 control-label">E-mail</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email" placeholder="Vaš e-mail" class="form-control" required type="text">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Subjekt</label>  
   <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
  <input name="subject" placeholder="Subjekt poruke" class="form-control" type="text">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Poruka</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
          <textarea style="height:150px;" class="form-control" name="comment" placeholder="Vaša poruka"></textarea>
  </div>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button name="posalji" type="submit" class="btn btn-warning" >POŠALJI</button>
  </div>
</div>

</fieldset>
</form>
      </div>
            </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
