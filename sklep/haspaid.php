<?php
session_start();
//Sprawdzanie i ladowanie wymaganych plikow
if(!file_exists("config/config.php")){
    Header("Location: ../sklep/?action=sklep");
    die();
} else include_once("config/config.php");
if(!file_exists("rcon.class.php")){
    Header("Location: ../sklep/?action=sklep");
    die();
} else include_once("rcon.class.php");
	
function rcommand($ip, $port, $password, $timeout, $user, $command){
    try{
        $Rcon = new MinecraftRcon;    
        $Rcon->Connect($ip, $port, $password, $timeout);
        $Data = $Rcon->Command($command);
        if($Data === false){
            saveError($user, $command);
            throw new MinecraftRconException("Problem z pobraniem wyniku");
        } else if(StrLen($Data) == 0){
            saveError($user, $command);
            throw new MinecraftRconException("Otrzymany wynik jest pusty");
        }

        echo HTMLSpecialChars($Data);
    } catch(MinecraftRconException $e){
        echo $e->getMessage();
    }

    $Rcon->Disconnect();
}

//sprawdza czy nick jest poprawny
function hasSelectedString($string){
    if(strlen($string > 16)) return false;
    $allowedChars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"," ","0","1","2","3","4","5","6","7","8","9","_");
    $string = str_split($string);
    foreach($string as $letter) {
        if(!in_array($letter, $allowedChars)){
            return false;
        }
    }
    return true;
}

function saveError($user, $command){
    mysql_query("INSERT INTO sms_backup (service, command) VALUES ('$servername', '$command')");
}

//wykonuje formularz
if($_POST) {
    //Pobieranie danych z formularza
    $id = mysql_real_escape_string(strip_tags(trim($_POST['id'])));
    $username = mysql_real_escape_string(strip_tags(trim($_POST['username'])));
    $reusername = mysql_real_escape_string(strip_tags(trim($_POST['re_username'])));

    if(!(isSet($id) || isSet($username) || isSet($reusername))){
        $_SESSION['message'] = "Musisz wypełnić wszystkie pola formularzu!";
        Header("Location: ../sklep/?action=sms&key=".$id."");
        die();
    }

    if(!isSet($username)){
        $_SESSION['message'] = "Podaj swój nick!";
        Header("Location: ../sklep/?action=sms&key=".$id."");
        die();
    }

    if($username !== $reusername){
        $_SESSION['message'] = "Podane nazwy użytkownika nie są identyczne!";
        Header("Location: ../sklep/?action=sms&key=".$id."");
        die();
    }

    if(!hasSelectedString($username)){
        $_SESSION['message'] = "Podany nick zawiera niedozwolone znaki!";
        Header("Location: ../sklep/?action=sms&key=".$id."");
        die();
    }
		
    $query = mysql_query("SELECT command FROM sms WHERE id = '".$id."'");
    if(mysql_num_rows($query) == 0){
        $_SESSION['message'] = "Blad, wybrana usługa została źle skonfigurowana. Zgłoś to administracji!";
        Header("Location: ../sklep/?action=sms&key=".$id."");
        die();
    }
        
    //Pobieranie danych z formularza
    $code = mysql_real_escape_string(strip_tags(trim($_POST['code'])));
    $key = mysql_real_escape_string(strip_tags(trim($_POST['key'])));
    $row = mysql_fetch_array($query);
    
    $handle =  fopen('http://profitsms.pl/check.php?apiKey='.$apiKey.'&code='.$code.'&smsNr='.$numer,'r'); 
    $status = fgets($handle,8); 
    fclose($handle); 

    switch($status){  
        case 1: 
			$time = time();
			$cmd = $row['command'];
            mysql_query("INSERT INTO sms_database (user, buy_time, smskey, service, command) VALUES ('$username', $time, '$code', '$id', '$cmd')");
            foreach(explode(";", $row['command']) as $key)
				rcommand($rconIp, $rconPort, $rconPass, 10, $username, trim(str_replace("{GRACZ}", $username, $key)));
				
            $_SESSION['message'] = "Twoja usluga zostala aktywowana!";
            Header("Location: ../sklep/?action=sms&key=".$id."");
            die();
        break; 
        case 0: 
            $_SESSION['message'] = "Podany kod jest nieprawidłowy, bądź wybrałeś złą usługe dla otrzymanego kodu.";
            Header("Location: ../sklep/?action=sms&key=".$id."");
            die();
        break;  
    }
    
    Header("Location: ../sklep/?action=sms&key=".$id."");
    die();
}

?>