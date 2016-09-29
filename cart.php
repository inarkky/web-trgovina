<?php 
include_once("scripts/status.php");
if ($user_ok != true) { 
    header('location:index.php');
    exit();
}
?>
<?php 
if (isset($_POST['pid'])) {
    $pid = mysqli_real_escape_string($db_conx, $_POST['pid']);
	$postoji = false;
	$i = 0;
	if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) < 1) { 
		$_SESSION["cart"] = array(0 => array("item_id" => $pid, "kol" => 1));
	} else {
		foreach ($_SESSION["cart"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  array_splice($_SESSION["cart"], $i-1, 1, array(array("item_id" => $pid, "kol" => $each_item['kol'] + 1)));
					  $postoji = true;
				  } 
		      } 
	       } 
		   if ($postoji == false) {
			   array_push($_SESSION["cart"], array("item_id" => $pid, "kol" => 1));
		   }
	}
	header("location: cart.php"); 
    exit();
}
?>
<?php 
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {

	$iterator=1;
	foreach ($_SESSION["cart"] as $each_item) { 
			$item_id = $each_item['item_id'];
			$item_kol= $each_item['kol'];;
			$sql = mysqli_query($db_conx, "UPDATE proizvod SET Kol_lager=Kol_lager-'$item_kol' WHERE ID_pro='$item_id' LIMIT 1");
	} 

    unset($_SESSION["cart"]);
    header('location:cart.php?success=true');
    exit();
}
?>
<?php 
if (isset($_POST['nova_kolicina']) && $_POST['nova_kolicina'] != "") {
	$nova_kolicina = mysqli_real_escape_string($db_conx, $_POST['nova_kolicina']);
	$kol = mysqli_real_escape_string($db_conx, $_POST['kol']);
	$kol = preg_replace('#[^0-9]#i', '', $kol); 
	if ($kol >= 1000) { $kol = 999; }
	if ($kol < 1) { $kol = 1; }
	if ($kol == "") { $kol = 1; }
	$i = 0;
	foreach ($_SESSION["cart"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $nova_kolicina) {
					  array_splice($_SESSION["cart"], $i-1, 1, array(array("item_id" => $nova_kolicina, "kol" => $kol)));
				  } 
		      } 
	} 
}
?>
<?php 
if (isset($_POST['did']) && $_POST['did'] != "") {
 	$did = $_POST['did'];
	if (count($_SESSION["cart"]) <= 1) {
		unset($_SESSION["cart"]);
	} else {
		unset($_SESSION["cart"]["$did"]);
		sort($_SESSION["cart"]);
	}
}
?>
<?php 
$conv="";
$cartOutput = "";
$cartTotal = "";
$koliko = '';
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) < 1) {
    $cartOutput = "<h2 align='center'>Košarica je prazna</h2> <hr>";
} else {
	$i = 0; 
    foreach ($_SESSION["cart"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysqli_query($db_conx, "SELECT * FROM proizvod WHERE ID_pro='$item_id' LIMIT 1");
		while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
			$Naziv_pro = $row["Naziv_pro"];
			$Cijena_kn = $row["Cijena_kn"];
			$Opis_pro = $row["Opis_pro"];
			$Kol_lager = $row["Kol_lager"];
		}

$valuta='kn';
if(isset($_POST['currency'])){
	$c=mysqli_real_escape_string($db_conx, $_POST['currency']);
	$url = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
	$xml = simplexml_load_file($url);
	$x='';
	$y='';
	$z='';
	foreach($xml->Cube->Cube->Cube as $books){
		$a = $books["currency"];
		if ($a=='USD'){
			$x=$books["rate"];
		}else if($a=='HRK'){
			$y=$books["rate"];
		}
	}
	if($c=='HRK'){
		$z=number_format("$Cijena_kn", 2);
		$valuta='kn';
	}else if($c=='EUR'){
		$z=number_format("$Cijena_kn"/"$y", 2);
		$valuta='€';
	}else if ($c=='USD'){
		$z=number_format("$Cijena_kn"/"$y"*"$x", 2);
		$valuta='$';
	}

	$Cijena_kn=$z;
}


		$Cijena_kntotal = $Cijena_kn * $each_item['kol'];
		$cartTotal = $Cijena_kntotal + $cartTotal;

		$koliko .= "$item_id-".$each_item['kol'].","; 
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><a href="product.php?id=' . $item_id . '">' . $Naziv_pro . '</a><br /><img src="images/' . $item_id . '.jpg" alt="' . $Naziv_pro. '" width="50px" height="50px" border="1" /></td>';
		$cartOutput .= '<td><div class="cipi">' . $Cijena_kn . ' ' . $valuta . '</div></td>';
		$cartOutput .= '<td><form action="cart.php" method="post" oninput="level.value = kol.valueAsNumber">
		<table><tr><td>
		<input name="kol" id="kol" type="range" min="1" max="' . $Kol_lager . '" value="' . $each_item['kol'] . '"></td><td style="padding:0 10px"><output for="kol" name="level">' . $each_item['kol'] . '</output></td>

		<td><input name="adjustBtn' . $item_id . '" class="btn btn-info" type="submit" value="PRIMJENI" />
		<input name="nova_kolicina" type="hidden" value="' . $item_id . '" /></td></tr></table>
		</form></td>';
		$cartOutput .= '<td><div class="cips">' . $Cijena_kntotal . ' ' . $valuta . '</div></td>';
		$cartOutput .= '<td><form action="cart.php" method="post"><input name="deleteBtn' . $item_id . '" class="btn btn-danger" type="submit" value="OBRIŠI" /><input name="did" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
    $global=$cartTotal;
	$cartTotal = "<div class='uk' style='font-size:18px; margin-top:12px;' align='right'>Ukupno u Košarici: ".$cartTotal." " . $valuta . "
		
	</div>";

	$conv="<hr><div class='trans-back'>
	<form action='cart.php' method='POST'>
		<button type=\"submit\" class=\"btn btn-warning\" name='currency' value='HRK'>HRK</button>
		<button type=\"submit\" class=\"btn btn-warning\" name='currency' value='EUR'>EUR</button>
		<button type=\"submit\" class=\"btn btn-warning\" name='currency' value='USD'>USD</button>
	</form>
	</div>";













if(isset($_POST['email'])){

	$commm=mysqli_real_escape_string($db_conx, $_POST['napomena']);
	$addd=mysqli_real_escape_string($db_conx, $_POST['nova_adresa']);
	$postarina=25;
	if ($global >= 400){
		$postarina=0;
 	}
 	$najukupnije = $global+$global*0.25+$postarina;
 	$sss="INSERT INTO narudzba(Datum_nar, Napomena, Postarina, Ukupno_pdv, adresa_dostave) VALUES (CURDATE(), '$commm', '$postarina', '$najukupnije', '$addd')";
	$unesi_u_narudzbu=mysqli_query($db_conx, $sss);
	$id_od_narudzbe=mysqli_insert_id($db_conx);

    require("scripts/fpdf.php");

    //kostruktor za fpdf
	$pdf = new FPDF('P','pt','A4');//orijentacija, mjera, format
	$pdf->AddPage();//stvaramo stranicu

	//header
	$pdf->SetFont('Arial','B',8);//postavke fonta(arial, bold, 8px)
	$pdf->Cell(520, 13, 'DATUM: ' . date('d.m.Y'), 'B', 2);//stvaramo field dimenzija 200x13, dodajemo tekst, border, gdje se nalazi kursor(2-novi red)

	$pdf->SetXY(30, 70);//koordinate kursora (ekvivalent position-top/position-left u css-u)
	//naslov
	$pdf->SetFont('Arial', 'B', 18);
	$pdf->Cell(150, 16, "NARUDZBA - " . $id_od_narudzbe);
	
	$pdf->Ln(50);//line break

	//info firma
	$poduzece=mysqli_fetch_array(mysqli_query($db_conx, "SELECT * FROM poduzece LIMIT 1"));
	$pdf->SetXY(30, 120);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(200, 13, $poduzece['Naziv_pod'], 0, 2);
	$pdf->Cell(200, 13, $poduzece['Adresa_pod'], 0, 2);
	$pdf->Cell(200, 13, $poduzece['Email_pod'], 0, 2);
	$pdf->Cell(200, 13, $poduzece['Telefon_pod'], 0, 2);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(200, 13, $poduzece['Ziroracun'], 0, 2);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(200, 13, $poduzece['Naziv_banke'], 0, 2);

	//info korisnik
	$kik=$_SESSION["id"];
	$korisnik=mysqli_fetch_array(mysqli_query($db_conx, "SELECT * FROM korisnik WHERE ID_korisnik='$kik' LIMIT 1"));
	$pdf->SetXY(370, 120);
	$pdf->Cell(150, 13, $korisnik['Ime'] . ' ' . $korisnik['Prezime'], 0, 2);
	$pdf->Cell(150, 13, $korisnik['Email_kor'], 0, 2);
	$pdf->Cell(150, 13, $korisnik['Mob_tel'], 0, 2);
	$pdf->Cell(150, 13, $korisnik['Adresa'], 0, 2);
	$pdf->Cell(150, 13, $korisnik['Post_broj'] . ' ' . $korisnik['Mjesto'], 0, 2);
	$pdf->Cell(150, 13, $korisnik['Drzava'], 0, 2);

	$pdf->Ln(70);

	$pdf->SetFont('Arial','B',11);
	$pdf->SetXY(30, 250);
	$pdf->Cell(50, 16, "R.Br.", "B", 2);

	$pdf->SetXY(80, 250);
	$pdf->Cell(220, 16, "Naziv", "B", 2);

	$pdf->SetXY(300, 250);
	$pdf->Cell(50, 16, "Kolicina", "B", 2);

	$pdf->SetXY(350, 250);
	$pdf->Cell(100, 16, "Cijena", "B", 2);

	$pdf->SetXY(450, 250);
	$pdf->Cell(100, 16, "Iznos", "B", 2);

	$pdf->SetFont('Arial','',10);
	$pdf->SetY(270);

$iterator=1;
foreach ($_SESSION["cart"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysqli_query($db_conx, "SELECT * FROM proizvod WHERE ID_pro='$item_id' LIMIT 1");
		while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
			$Naziv_pro = $row["Naziv_pro"];
			$Cijena_kn = $row["Cijena_kn"];
		}
		$Cijena_kntotal = $Cijena_kn * $each_item['kol'];
		$cartTotal = $Cijena_kntotal + $cartTotal;

		$pdf->SetX(30);
		$pdf->Cell(50, 20, $iterator, 0, 0);

		$pdf->SetX(80);
		$pdf->Cell(220, 20, $Naziv_pro, 0, 0);

		$pdf->SetX(300);
		$pdf->Cell(50, 20, 'x' . $each_item['kol'], 0, 0);

		$pdf->SetX(350);
		$pdf->Cell(100, 20, $Cijena_kn . ' HRK', 0, 0);

		$pdf->SetX(450);
		$pdf->Cell(100, 20, $Cijena_kntotal . ' HRK', 0, 2);

		$item_k=$each_item['kol'];
		$user_id=$_SESSION['id'];
		$sss="INSERT INTO Kosarica(Kolicina, Ukupno, VK_proizvod, VK_korisnik, VK_narudzba) VALUES ('$item_k', '$Cijena_kntotal', '$item_id', '$user_id', '$id_od_narudzbe')";
		$unesi_u_narudzbu=mysqli_query($db_conx, $sss);


		$iterator++;
} 
	
	$pdf->SetX(30);
	$pdf->Cell(520, 1, '', 'B', 2);
	$pdf->Cell(520, 2, '', 'B', 2);
	$pdf->Ln(20);

	$pdf->SetX(30);
	$pdf->SetFont('Arial','B', 11);
	$pdf->Cell(100, 16, 'ZA PLATITI:', '0', 0);

	$pdf->SetX(150);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(100, 16, $cartTotal . ' HRK', '0', 2);

	$pdf->SetX(30);
	$pdf->SetFont('Arial','B', 11);
	$pdf->Cell(100, 16, 'ADRESA DOSTAVE:', '0', 0);

	$pdf->SetX(150);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(100, 16, $addd, '0', 2);

	$pdf->SetX(30);
	$pdf->SetFont('Arial','B', 11);
	$pdf->Cell(100, 16, 'ROK DOSTAVE:', '0', 0);

	$addd=mysqli_real_escape_string($db_conx, $_POST['nova_adresa']);
	$pdf->SetX(150);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(100, 16, '4-7 dana', '0', 2);

	$pdf->SetX(30);
	$pdf->SetFont('Arial','B', 11);
	$pdf->Cell(100, 16, 'ROK PLACANJA:', '0', 0);

	$addd=mysqli_real_escape_string($db_conx, $_POST['nova_adresa']);
	$pdf->SetX(150);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(100, 16, '2 dana', '0', 2);

if ($cartTotal < 400){
	$pdf->SetX(30);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(100, 16, 'POSTARINA:', '0', 0);

	$pdf->SetX(150);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(100, 16, '25 HRK', '0', 2);
}
	$pdf->SetX(30);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(120, 25, 'UKUPNO:(+PDV)', 'B', 0);

	$pdf->SetX(150);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(400, 25, $cartTotal+$cartTotal*0.25+$postarina . ' HRK', 'B', 2);

	$pdf->SetX(30);
	$pdf->SetFont('Arial','', 9);
	$pdf->Cell(100, 25, 'Uplatiti u navedenom roku na ziroracun naveden gore.', '0', 0);

	
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(145, 145, 145);//boja u rgb(255, 255, 255)<-bijela
	//$pdf->SetXY(30, 670);
	$pdf->Ln(50);
	$disklejmer = 'Postovani, zahvaljujemo što ste odabrali Wizard store internet naručivanje kako biste obavili svoju kupnju. U prilogu vam dostavljamo narudzbu u kojoj se nalaze sve informacije o proizvodima koje ste narucili. Zelimo biti sigurni da se u potpunosti zadovoljni uslugom Wizard storea. Ukoliko iz bilo kojeg razloga niste zadovoljni, molimo Vas da nas kontaktirate na wizardstore.hr@gmail.com. Hvala sto kupujete u Wizard store online trgovini. Srdacan pozdrav, Vas Wizard store VAZNA NAPOMENA: Molimo da ne odgovarate na posiljatelja ove poruke obzirom da je ista automatski generirana od strane sustava za internetsko placanje.';
	$pdf->MultiCell(0, 15, $disklejmer, 0, "J");


	$pdf->Ln(50);
	$text = $commm;
	$pdf->MultiCell(0, 15, $text, 0, "J");//dimenzije, string, border, centriranje


	//stvaramo pdf
	$pdfdoc = $pdf->Output("", "S");//ime, destinacija(S znaci return as string jer nam kao string treba za mail)


    $to = $korisnik['Email_kor'];
    $from = "neki_mail@gmail.com";//stavi svoju adresu tu - mail ide u sent
    $subject = "Racun";
    $message = "<p>PDF je u privitku.</p>";

    $separator = md5(time());
    $eol = PHP_EOL;//end of line
    $filename = "racun.pdf";

    $narnarnaru='pdfs/nar_' . $id_od_narudzbe . '.pdf';
	$pdf->Output($narnarnaru,'F');

    
    $attachment = chunk_split(base64_encode($pdfdoc));
    //headeri
    $headers = "From: ".$from.$eol;
    $headers .= "MIME-Version: 1.0".$eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol;
    $headers .= "Content-Transfer-Encoding: 7bit".$eol;
    $headers .= "This is a MIME encoded message.".$eol;
    //poruka
    $mess = "--".$separator.$eol;
    $mess .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
    $mess .= "Content-Transfer-Encoding: 8bit".$eol;
    $mess .= $message.$eol;
    //privitak
    $mess .= "--".$separator.$eol;
    $mess .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
    $mess .= "Content-Transfer-Encoding: base64".$eol;
    $mess .= "Content-Disposition: attachment".$eol;
    $mess .= $attachment.$eol;
    $mess .= "--".$separator."--";
    
    //saljii
    mail($to, $subject, $mess, $headers);
    header('location:cart.php?cmd=emptycart');
    exit();
}






















}
?>
<!DOCTYPE html>
<html>
<head>
<title>Kosarica</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8">
<script>
<?php if(isset($_GET['success']) && $_GET['success'] === 'true'){
    echo 'alert("Narudzba je izvrsena i poslana na mail!!");';
}
?>
</script>
</head>
<body>


<?php include_once('header.php'); ?>
<div class="middle">
        <div class="container">
        <br><br>
  <?php include_once('sidebar.php'); ?>
   <div class="col-md-9">
   <h2 align="center">Košarica</h2><br>
              <div class="table-responsive trans-back">
          <table class="table">
          <thead>
          <tr>
          	<th>PROIZVOD</th>
          	<th>CIJENA</th>
          	<th style="text-align: center;">KOLIČINA</th>
          	<th>UKUPNO</th>
          	<th>OBRIŠI</th>
          </tr></thead>
		<?php echo $cartOutput; ?>
	</table>
	<?php echo $cartTotal; ?>

	<button type="button" class=" pull-right btn btn-success" data-toggle="modal" <?php if(!isset($_SESSION["cart"]) || count($_SESSION["cart"]) < 1){ echo 'disabled'; } ?> data-target="#myModal">DOVRŠI KUPOVINU</button>

	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <div class="modal-content">
	    <form action="cart.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Dovrši narudžbu</h4>
	      </div>
	      <div class="modal-body">
	        	<table><tr><td>
				<input type="text" name="nova_adresa" required placeholder="Adresa za dostavu">
				</td></tr><tr><td><textarea name="napomena" placeholder="Dodatne napomene"></textarea>
				</td></tr><tr><td> Rok dostave: 4-7 dana
				</td></tr><tr><td> Rok placanja: 2 dana
				</td></tr></table><input type="hidden" name="email" value="<?php echo $global; ?>">
				
	      </div>
	      <div class="modal-footer">
	        <a href="cart.php" class="btn btn-danger pull-right">ODUSTANI</a>
	        <input type="submit" class="btn btn-success pull-left" value="DOVRŠI KUPOVINU">
	      </div>
	      </form>
	    </div>

	  </div>
	</div>

	</div>

	<?php echo $conv; ?>
            </div>
        </div>
    </div>


   	<div class="bottom"><p align="center" style="color: #66bbff; margin-bottom:0px;height:30px">wizard store 2015/2016</p></div>

</body>
</html>