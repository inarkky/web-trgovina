<?php

if(isset($_POST['m']) && isset($_POST['c'])){

	include_once('connect.php');

	$m=mysqli_real_escape_string($db_conx, $_POST['m']);
	$c=mysqli_real_escape_string($db_conx, $_POST['c']);

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
		$z=number_format("$m", 2) . ' HRK';
	}else if($c=='EUR'){
		$z=number_format("$m"/"$y", 2) . ' €';
	}else if ($c=='USD'){
		$z='$' . number_format("$m"/"$y"*"$x", 2);
	}

	echo $z;

}else{
	header('location:../index.php');
	exit();
}
?>