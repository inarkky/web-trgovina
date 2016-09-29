<?php
include_once("scripts/status.php");

$kategorija=mysqli_fetch_array(mysqli_query($db_conx, "SELECT * FROM novosti WHERE kategorija='novosti'"));
if(count($kategorija)<1){
  $render = '<li>Na zalost trennutno nema članaka!</li>';
}else{
$rez_p_page=4;
if (isset($_GET['page'])) {
  $page = mysqli_real_escape_string($db_conx, $_GET['page']);
} else {
  $page=1;
}
$start = ($page-1) * $rez_p_page;


$render='';
$sql="SELECT * FROM novosti WHERE kategorija='novosti' LIMIT $start, $rez_p_page";
$query=mysqli_query($db_conx, $sql);
while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
  $id=$row['id'];
  $naslov=$row['naslov'];
  $opis=$row['short'];
  $slika=$row['slika'];

  $slika ='<tr>
              <td><img src="' . $slika . '" style="width:300px;max-height:350px"></td>
            <td>';
    if($slika == '' || $slika == NULL){$slika='';}

  $form='<form action="novost.php" method="POST"><input type="hidden" name="id" value="' . $id . '"><input type="submit" class="btn btn-warning" name="ok" value="Nastavi čitati"></form>';

  $render.='
      <div class="table-responsive trans-back">
          <table class="table">
            ' . $slika . '
                <table>
                  <tr><td><h2 style="font-style:italic;color:#4040bf;">' . $naslov . '</h2></td></tr>
                  <tr><td>' . $opis . '<hr></td></tr>
                  <tr><td colspan="2" align="right">' . $form . '</td></tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
        <hr>
  ';
}

if($render==''){
    $render='<li>Na zalost trenutno nema članaka!</li>';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Novosti</title>
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
   <h2 align="center">Novosti</h2><br>

                <?php echo $render; ?>

<?php
if(count($kategorija)>0){
$page_sql = "SELECT * FROM novosti WHERE kategorija='novosti'";
$result = mysqli_query($db_conx, $page_sql);
$rows_total = mysqli_num_rows($result);
$pages_total = ceil($rows_total / $rez_p_page);

echo "<center><a class='btn btn-default' href='novosti.php?page=1'>Prva</a> ";

for ($i=1; $i<=$pages_total; $i++) {

echo "<a class='btn btn-default' href='novosti.php?page=" . $i . "'>" . $i . "</a> ";
};

echo "<a class='btn btn-default' href='novosti.php?page=" . $pages_total . "'>Zadnja</a></center> ";
 }
?>

            </div>
        </div>
    </div>
    <div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>
</body>
</html>
