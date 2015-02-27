<?php session_start();
      require_once('db.php');
      error_reporting(E_ALL);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../sklep/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../sklep/css/jumbo.css" rel="stylesheet" type="text/css" />
<title>CubeCraft - Admin Panel</title>
</head>

<body>

<div class="container">
    <div class="well">
      <div class="header">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li><a href="zapytanie.php?type=add">Dodaj produkt</a></li>
            <li><a href="/sklep">Strona główna sklepu</a></li>
            <li><a href="index.php?logout">Wyloguj się</a></li>
          </ul>
        </nav>
        <h1 class="text-muted"><a href="/sklep" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Powrót na stronę główną sklepu domena.pl">domena.pl</a></h1>
      </div>

  <div class="row"> <!-- row begin -->
    <div class="col-lg-12 col-md-12">
      <div>
          <div class="row clearfix">
            <div class="col-md-12 column">
  
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
	
	if($_GET['type'] == 'delete'){
		$sql = 'DELETE FROM `sms` WHERE `id` = '.$_GET['id'];
		mysql_query($sql) or die(mysql_error());
		header('Location: index.php');
	} 
	else if($_GET['type'] == 'edit'){
		if(!$_POST){
			$sql = 'SELECT * FROM `sms` WHERE `id` = '.$_GET['id'];
			$row = mysql_fetch_row(mysql_query($sql));
			echo '<form class="form-horizontal" action="zapytanie.php?type=edit" method="post">
	<div class="form-group">
		<label for="inputId" class="col-sm-2 control-label">ID #</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputId" name="id" value="'.$row[0].'" >
		</div>
	</div>
	<div class="form-group">
		<label for="inputObrazek" class="col-sm-2 control-label">Obrazek</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputObrazek" name="sms_img" value="'.$row[1].'" >
		</div>
	</div>
	<div class="form-group">
		<label for="inputCena" class="col-sm-2 control-label">Cena</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputCena" name="sms_cena" value="'.$row[3].'" >
		</div>
	</div>
	<div class="form-group">
		<label for="inputSmsNumer" class="col-sm-2 control-label">SMSNumer</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputSmsNumer" name="sms_numer" value="'.$row[4].'" >
		</div>
	</div>
	<div class="form-group">
		<label for="inputSmsTresc" class="col-sm-2 control-label">SMSTresc</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputSmsTresc" name="sms_tresc" value="'.$row[5].'" >
		</div>
	</div>
	<div class="form-group">
		<label for="inputOpis" class="col-sm-2 control-label">Opis</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputOpis" name="sms_opis" value="'.$row[6].'" >
		</div>
	</div>
	<div class="form-group">
		<label for="inputKomenda" class="col-sm-2 control-label">Komenda</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputKomenda" name="command" value="'.$row[7].'" >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="hidden" name="id_p" value="'.$_GET['id'].'">
			<input type="submit" class="btn btn-success btn-block" value="Edytuj">
		</div>
	</div>
</form>';
		}
		else{
			echo 1;
			$sql = 'UPDATE `sms` SET `id`='.$_POST['id'].', `sms_img`=\''.$_POST['sms_img'].'\', `sms_title`=\''.$_POST['sms_title'].'\', `sms_cena`=\''.$_POST['sms_cena'].'\', `sms_numer`=\''.$_POST['sms_numer'].'\', `sms_tresc`=\''.$_POST['sms_tresc'].'\', `sms_opis`=\''.$_POST['sms_opis'].'\', `command`=\''.$_POST['command'].'\' WHERE id ='.$_POST['id_p'];
			mysql_query($sql) or die(mysql_error());
			echo 2;
			header('Location: index.php');
		}
	}
	else if($_GET['type'] == 'add'){
		if(!$_POST){
			
			echo '<form class="form-horizontal" action="zapytanie.php?type=add" method="post">
	<div class="form-group">
		<label for="inputObrazek" class="col-sm-2 control-label">Obrazek</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputObrazek" name="sms_img">
		</div>
	</div>
	<div class="form-group">
		<label for="inputCena" class="col-sm-2 control-label">Cena</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputCena" name="sms_cena">
		</div>
	</div>
	<div class="form-group">
		<label for="inputSmsNumer" class="col-sm-2 control-label">SMSNumer</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputSmsNumer" name="sms_numer">
		</div>
	</div>
	<div class="form-group">
		<label for="inputSmsTresc" class="col-sm-2 control-label">SMSTresc</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputSmsTresc" name="sms_tresc">
		</div>
	</div>
	<div class="form-group">
		<label for="inputOpis" class="col-sm-2 control-label">Opis</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputOpis" name="sms_opis">
		</div>
	</div>
	<div class="form-group">
		<label for="inputKomenda" class="col-sm-2 control-label">Komenda</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputKomenda" name="command">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" class="btn btn-success btn-block" value="Dodaj">
		</div>
	</div>
</form>';
		}
		else{
			echo 1;
			$sql = "INSERT INTO `sms` (
`id` ,
`sms_img` ,
`sms_title` ,
`sms_cena` ,
`sms_numer` ,
`sms_tresc` ,
`sms_opis` ,
`command`
)
VALUES (NULL, '".$_POST['sms_img']."', '".$_POST['sms_title']."', '".$_POST['sms_cena']."', '".$_POST['sms_numer']."', '".$_POST['sms_tresc']."' , '".$_POST['sms_opis']. "', '".$_POST['command']."');";
			mysql_query($sql) or die(mysql_error());
			echo 2;
			header('Location: index.php');
		}
	}
}
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

   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../sklep/js/bootstrap.min.js"></script>
  <script src="../sklep/js/init.js"></script>
</body>
  
</html>
