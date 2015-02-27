<?php
  /*Połączenie z bazą danych*/
  $dbhost = 'xxx'; 	
  $dblogin = 'xxx';
  $dbpass = 'xxx';
  $dbselect = 'panel';
  mysql_connect($dbhost,$dblogin,$dbpass);
  mysql_select_db($dbselect) or die("Błąd przy wyborze bazy danych");
  mysql_query("SET CHARACTER SET UTF8");
?>