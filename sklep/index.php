<?php 
ob_start();
ini_set("session.cookie_lifetime","3600");
ini_set("session.gc_maxlifetime","3600");

session_start();
require_once('config/config.php');
$page = array("index","sklep","sms","przelew");

if(empty($_GET['action'])){
	$_GET['action']= 'index'; 
}

if(in_Array($_GET['action'], $page))$main = 'strony/'.$_GET['action'].'.php'; 
else $main   = 'strony/index.php'; 	

require_once('strony/header.php');
require_once($main);
require_once('strony/footer.php');

mysql_close();
ob_end_flush();
?>