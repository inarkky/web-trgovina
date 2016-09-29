<?php
if (!isset($_POST['rss'])){
	header('location: ../index.php');
	exit();
}
include_once('connect.php');
$rss=mysqli_real_escape_string($db_conx, $_POST['rss']);
$cur_page=mysqli_real_escape_string($db_conx, $_POST['cur_page']);

$to = $rss;
$subject = 'Newsletter';
$from = 'neki_mail@gmail.com';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

$message = '<html><head><style type="text/css">';
$message .= '.btn{display:inline-block;width:100%;line-height:1.4em;background:#0CF;}';
$message .= '</style></head>';
$message .= '<body style="background:#000;padding:10px">';
$message .= '<div style="padding:20px;background:#FFF;width:800px;margin: 0 auto;">';
$message .= '<table style="width:100%;"><tr><td align="left">';
$message .= '<img style="height:53;width:50px;" src="https://gallery.mailchimp.com/b7092016cb46b2d4ebad91896/images';
$message .= '/d23cbc59-a2af-4552-b7cb-8da9d7c1ebb0.png"></td><td align="right">';
$message .= '<a href="#" style="color: #666;font-weight:bold;text-decoration:none;">';
$message .= 'Pregledajte naš newsletter u broweseru</a></td></tr>';
$message .= '</table><br><br><img src="https://gallery.mailchimp.com/';
$message .= 'b7092016cb46b2d4ebad91896/images/21c379a6-a11c-4fc1-ad4f-da8c4392914f';
$message .= '.jpg"><br><table style="width:100%;"><tr><td align="center"><br>';
$message .= '<h2>Novosti u našoj ponudi!</h2>';
$message .= '<p>Od početka mjeseca ožujka nudimo nove artikle u našem Web dućanu. Neki od novosti';
$message .= 'uključuju:</p><table cellspacing="15"><tr ><td style="width:164px;height:173px">';
$message .= '<img style="width:164px;height:173" src="https://gallery.mailchimp.com';
$message .= '/b7092016cb46b2d4ebad91896';
$message .= '/images/7334a521-b526-4aa9-997e-59d050ccac02.jpg"></td><td style=';
$message .= '"width:164px;height:173px"><img style="width:164px;height:173" src="';
$message .= 'https://gallery.mailchimp.com/';
$message .= 'b7092016cb46b2d4ebad91896/images/958e8fcc-fa21-45ac-9856-580fb79a83c5';
$message .= '.jpeg"></td><td style="width:164px;height:173px"><img style="width:';
$message .= '164px;height:173" src="https://';
$message .= 'gallery.mailchimp.com/b7092016cb46b2d4ebad91896/images/';
$message .= '4dceca7b-d7d8-4fb9-b322-fae5ad9f5f0b.jpg"></td></tr><tr><td>';
$message .= '<strong>Zombie Dice</strong></td><td><strong>Caylus</strong></td>';
$message .= '<td><strong>Betrayal at House</strong></td></tr><tr><td>75,00 kn';
$message .= '</td><td>350,00 kn</td><td>430 kn</td></tr><tr><td>';
$message .= '<input class="btn" name="Kupi" type="button" value="Kupi">';
$message .= '</td><td>';
$message .= '<input class="btn" name="Kupi" type="button" value="Kupi">';
$message .= '</td><td>';
$message .= '<input class="btn" name="Kupi" type="button" value="Kupi">';
$message .= '</td></tr></table><br><p>Ostale ponude i novitete možete pregledati';
$message .= ' u našem Web dućanu.</p><p>Vaš,</p><p>Wizard Store</p></td></tr></table><hr><br>';
$message .= '<table style="width:100%;"><tr align="center"><td align="center">Kontaktirajte nas:</td>';
$message .= '</tr><tr><td align="center">wizardstore.hr@gmail.com</td></tr></table>';
$message .= '</div></body></html>';

if(mail($to, $subject, $message, $headers)){
    echo 'JEEEJ';
} else{
    echo 'Mail nije poslan';
}


    header("location:../$cur_page");
    exit();

?>