<?php
//USTAWIENIA
$apiKey = "xxx";      # <-- apiKey z profitsms
$rconIp = "xxx";                  # <-- adres ip serwera
$rconPort = xxx;                      # <-- port laczenia sie z rcon
$rconPass = "xxx";                    # <-- haslo do laczenia sie z rcon
	
//Przypisywanie danych zmiennym
$host = 'xxx';					# <-- host bazy danych
$user = 'xxx';						# <-- user bazy danych
$pass =	'xxx';						# <-- haslo do bazy
$name = 'sms';						# <-- database

//Łączenie do MySQL
$connect = mysql_connect($host,$user,$pass) or die("Blad polaczenia z mysql, sprobuj ponownie!");
mysql_select_db($name,$connect) or die("Blad wyboru bazy danych!!");
mysql_query("SET NAMES 'utf8'");
?>
