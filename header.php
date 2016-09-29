<header class="top" role="header">
    <br>
        <div class="container">
            <a href="index.php" class="navbar-brand pull-left">
                <img id="logo" src="css/12767486_10206844636526955_1280307777_n.png">
            </a>
            
            <h1 align="center"><b>Wizard store</b></h1>
            <div class="row">
                <nav class="navbar-collapse collapse" style="padding-top: 16px;" role="navigation">
                <div class="btn-group pull-left">
                    
                        <a href="index.php" class="btn btn-warning">POČETNA</a>
                        <a href="akcije.php" class="btn btn-warning">AKCIJE</a>
                        <a href="novosti.php" class="btn btn-warning">NOVOSTI</a>
                        <a href="kontakt.php" class="btn btn-warning">KONTAKT</a>
                        <a href="o_nama.php" class="btn btn-warning">O NAMA</a>
                        <a href="#" class="btn btn-warning">FORUM</a>
                    
                    </div>
                    <div class="input-group pull-left">
                    <form action="search.php" method="GET" style="display: inline-flex;">
                        <input type="text" class="form-control" name="q">
                        <div class="input-group-btn">
                            <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                    </div>
                    <div class="btn-group pull-right">
<?php if ($user_ok == true) { 
    $je_korisnik=$_SESSION['id'];
    $sql=mysqli_fetch_array(mysqli_query($db_conx, "SELECT * FROM korisnik WHERE ID_korisnik='$je_korisnik'"));
    $ime_korisnika=$sql['Ime'];
    $pre_korisnika=$sql['Prezime'];
    echo '<a href="user.php?kid=' . $je_korisnik . '" class="btn btn-warning">' . $ime_korisnika . ' ' . $pre_korisnika . '</a>
          <a href="logout.php" class="btn btn-warning">ODJAVA</a>';
    }else{
?>                      <a href="login.php" class="btn btn-warning">PRIJAVA</a>
                        <a href="reg.php" class="btn btn-warning">REGISTRACIJA</a>
<?php } ?>                    
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="banner">
        <div class="container">
            <img src="css/12755429_10206844745369676_2020078953_o.jpg" />
        </div>
    </div>