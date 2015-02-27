<?php session_start();
      require_once('db.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../sklep/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../sklep/css/jumbo.css" rel="stylesheet" type="text/css" />
<title>domena.pl - Admin Panel</title>
</head>

<body>
  
  <?php
    /* jeżeli nie wypełniono formularza - to znaczy nie istnieje zmienna login, hasło i sesja auth
     * to wyświetl formularz logowania
     */
    if (!isset($_POST['login']) && !isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
  ?>
  
<div class="container">
		<div class="well">
			<div class="header">
				<nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation"><a href="/sklep">Strona główna sklepu</a></li>
					</ul>
				</nav>
				<h1 class="text-muted"><a href="/sklep" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Powrót na stronę główną sklepu domena.pl">domena.pl</a></h1>
			</div>

	<div class="row"> <!-- row begin -->
		<div class="col-lg-12 col-md-12">
			<div class="well">
					<div class="row clearfix">
						<div class="col-md-12 column">
							<form role="form" name="form-logowanie" action="index.php" method="post">
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											 <label for="inputEmail1">Login</label><input type="text" class="form-control" id="inputEmail1" name="login" />
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											 <label for="inputPassword">Hasło</label><input type="password" class="form-control" id="inputPassword" name="password" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-push-4 col-sm-push-4 col-md-push-4 col-lg-push-4">
										<div class="form-group">
											<input type="submit" class="btn btn-success btn-block" name="zaloguj" value="Zaloguj" />
										</div>
									</div>
								</div>
									
							</form>
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
  
  <?php
  }
    /* jeżeli istnieje zmienna login oraz password i sesja z autoryzacją użytkownika jest FALSE to wykonaj
     * skrypt logowania
     */
	elseif (isset($_POST['login']) && isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
      
        // jeżeli pole z loginem i hasłem nie jest puste      
		if (!empty($_POST['login']) && !empty($_POST['password'])) {
          
		// dodaje znaki unikowe dla potrzeb poleceń SQL
		$login = mysql_real_escape_string($_POST['login']);
		$password = mysql_real_escape_string($_POST['password']);
        
        // szyfruję wpisane hasło za pomocą funkcji md5()
        $password = md5($password);
		
        /* zapytanie do bazy danych
         * mysql_num_rows - sprawdzam ile wierszy odpowiada zapytaniu mysql_query
         * mysql_query - pobierz wszystkie dane z tabeli user gdzie login i hasło odpowiadają wpisanym danym
         */
		$sql = mysql_num_rows(mysql_query("SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'"));
		
			// jeżeli powyższe zapytanie zwraca 1, to znaczy, że dane zostały wpisane poprawnie i rejestruję sesję
			if ($sql == 1) {
              
                // zmienne sesysje user (z loginem zalogowanego użytkownika) oraz sesja autoryzacyjna ustawiona na TRUE
				$_SESSION['user'] = $login;
				$_SESSION['auth'] = TRUE;
                
                // przekierwuję użytkownika na stronę z ukrytymi informacjami
				echo '<meta http-equiv="refresh" content="3; URL=hide.php">';
				echo '<div style="padding: 15px;border: 1px solid transparent;border-radius: 4px;color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;" role="alert"><b>Proszę czekać...</b> trwa logowanie i wczytywanie danych</div>';
			}
            
            // jeżeli zapytanie nie zwróci 1, to wyświetlam komunikat o błędzie podczas logowania
			else {
				echo '<div style="padding: 15px;border: 1px solid transparent;border-radius: 4px;color: #a94442;background-color: #f2dede;border-color: #ebccd1;" role="alert">Błąd podczas logowania do systemu. <a href="index.php">Wróć do formularza</a></div>';
			}
		}
        
        // jeżeli pole login lub hasło nie zostało uzupełnione wyświetlam błąd
		else {
				echo '<div style="padding: 15px;border: 1px solid transparent;border-radius: 4px;color: #a94442;background-color: #f2dede;border-color: #ebccd1;" role="alert">Błąd podczas logowania do systemu. <a href="index.php">Wróć do formularza</a></div>';

		}
	}
    
    // jeżeli sesja auth jest TRUE to przekieruj na ukrytą podstronę
	elseif ($_SESSION['auth'] == TRUE && !isset($_GET['logout'])) {
		echo '<meta http-equiv="refresh" content="3; URL=hide.php">';
		echo '<div style="padding: 15px;border: 1px solid transparent;border-radius: 4px;color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;" role="alert"><b>Proszę czekać...</b> trwa logowanie i wczytywanie danych</div>';
	}
    
    // wyloguj się
	elseif ($_SESSION['auth'] == TRUE && isset($_GET['logout'])) {
		$_SESSION['user'] = '';
		$_SESSION['auth'] = FALSE;
		echo '<meta http-equiv="refresh" content="3; URL=index.php">';
		echo '<div style="padding: 15px;border: 1px solid transparent;border-radius: 4px;color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;" role="alert"><b>Proszę czekać...</b> trwa wylogowywanie</div>';
	}
  ?>

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../sklep/js/bootstrap.min.js"></script>
  <script src="../sklep/js/init.js"></script>
</body>
  
</html>
