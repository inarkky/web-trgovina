<?php
session_start(); 
include_once("connect.php");

$user_ok = false;
$isAdmin = false;
$log_id = "";
$log_username = "";
$log_password = "";

function checkAdmin($conx,$id,$u,$p){
    $sql        = "SELECT * FROM korisnik WHERE ID_korisnik='$id' AND Korisnicko_ime='$u' AND Lozinka='$p' LIMIT 1";
    $query      = mysqli_query($conx, $sql);
    $row        = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $level      = $row['VK_uloga'];
    $sql_lvl    = "SELECT * FROM uloga WHERE ID_uloga = '$level' LIMIT 1";
    $query_lvl  = mysqli_query($conx, $sql_lvl);
    $row_lvl    = mysqli_fetch_array($query_lvl, MYSQLI_ASSOC);
    $lvl        = $row_lvl['Naziv_uloge'];
    if($lvl=='admin'){
        return true;
    }
}

function evalLoggedUser($conx,$id,$u,$p) {
    $sql = "SELECT * FROM korisnik WHERE ID_korisnik='$id' AND Korisnicko_ime='$u' AND Lozinka='$p' LIMIT 1";
    $query = mysqli_query($conx, $sql);
    $numrows = mysqli_num_rows($query);
    if ($numrows > 0) {
        return true;
    }
}

if (isset($_SESSION["id"]) && isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    $log_id = preg_replace('#[^0-9]#', '', $_SESSION['id']);
    $log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
    $log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);

    $user_ok = evalLoggedUser($db_conx,$log_id,$log_username,$log_password);
    $isAdmin = checkAdmin($db_conx,$log_id,$log_username,$log_password);
}

?>