<?php session_start();
      require_once('db.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../sklep/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../sklep/css/jumbo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  .container {
    max-width: 1200px !important;
  }
</style>
<title>CubeCraft - Admin Panel</title>
</head>

<body>
  
  <?php if ($_SESSION['auth'] == TRUE) {

 $adres_ip_serwera_mysql_z_baza_danych = 'xxx';
 
 $nazwa_bazy_danych = 'sms';
 
 $login_bazy_danych = 'xxx';
 
 $haslo_bazy_danych = 'xxx';

  if( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,
 
              $login_bazy_danych,$haslo_bazy_danych) ) {
    echo 'Nie moge polaczyc sie z baza danych';
 	 exit (0);
 }

 if ( !mysql_select_db($nazwa_bazy_danych) ) {
    echo 'Blad otwarcia bazy danych';
 	 exit (0);
 }
 
 //Definiujemy zapytanie pobierające wszystkie wiersze z wszystkimi
 //polami z tabeli newsletter
 $zapytanie = "SELECT * FROM `sms`";
 //wykonujemy zdefiniowane zapytanie na bazie mysql
 $wynik = mysql_query($zapytanie);
 ?>

<div class="container">
    <div class="well">
      <div class="header">
        <nav>
          <ul class="nav nav-pills pull-right">
		    <li><a href="/panel/rcon">Konsola RCON</a></li>
            <li><a href="zapytanie.php?type=add">Dodaj produkt</a></li>
            <li><a href="/sklep">Strona główna sklepu</a></li>
            <li><a href="index.php?logout">Wyloguj się</a></li>
          </ul>
        </nav>
        <h1 class="text-muted"><a href="/sklep" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Powrót na stronę główną sklepu CubeCraft">CubeCraft</a></h1>
      </div>

  <div class="row"> <!-- row begin -->
    <div class="col-lg-12 col-md-12">
      <div>
          <div class="row clearfix">
            <div class="col-md-12 column">
              <?
                echo "<div class=\"table-responsive\">";
                echo "<table class=\"table table-striped table-bordered\"><tr>";
                echo "<th><strong>#</strong></th>";
                echo "<th><strong>Obrazek</strong></th>";
                echo "<th><strong>Cena</strong></th>";
                echo "<th><strong>SMSNumer</strong></th>";
                echo "<th><strong>SMSTreść</strong></th>";
                echo "<th><strong>Opis</strong></th>";
                echo "<th><strong>Komenda</strong></th>";
                echo "<th><strong>Akcja</strong></th>";
                echo "</tr>";

              while ( $row = mysql_fetch_row($wynik) ) {
                echo "</tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "<td>" . $row[4] . "</td>";
                echo "<td>" . $row[5] . "</td>";
                echo "<td class=\"cut-cell\">" . $row[6] . "</td>";
                echo "<td>" . $row[7] . "</td>";
                echo "<td><a class=\"btn btn-danger btn-xs\" href=\"zapytanie.php?type=delete&id=".$row[0]."\">Usun</a></br><a style=\"margin-top: 2px;\" class=\"btn btn-info btn-xs\" href=\"zapytanie.php?type=edit&id=".$row[0]."\">Edytuj</a></td>";
                echo "</tr>";
              }
                echo "</table>";
                echo "</div>";
              ?>
            </div>
          </div>
      </div>
    </div>
    </div> <!-- row end -->



      <footer class="footer">
        <div class="row">
            <div class="col-sm-6 col-md-6">
            <h4>© domena.pl 2014</h4>
          </div>
          <div class="col-sm-6 col-md-6">
            <a href="mailto:olszak94@gmail.com"><h4 class="pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="E-mail olszak94@gmail.com"><span class="label label-black">Realizacja: Rafał Olszewski</span></h4></a>
          </div>
        </div>
      </footer>

    </div>
  </div>

 <?

 
 
 //Zamykamy połączenie z bazą danych
 if ( !mysql_close() ) {
    echo 'Nie moge zakonczyc polaczenia z baza danych';
    exit (0);
 }
 
 
  }
  else {
          echo '<meta http-equiv="refresh" content="3; URL=index.php">';
          echo '<div style="padding: 15px;border: 1px solid transparent;border-radius: 4px;color: #a94442;background-color: #f2dede;border-color: #ebccd1;" role="alert"><b>Próba nieautoryzowanego dostępu...</b> trwa przenoszenie do formularza logowania</div>';
  }
  
  ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../sklep/js/bootstrap.min.js"></script>
  <script src="../sklep/js/init.js"></script>
</body>
  
</html>
