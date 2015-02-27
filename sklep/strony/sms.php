<?php
	session_start();
	if(empty($_GET['key'])){
		Header("refresh:2;url=../../sklep/?action=index");
		die("<div class=\"alert alert-danger\" role=\"alert\">Blad! Brak uslugi lub wpisano recznie adres!</div>");
	}
	
	$result = mysql_query("SELECT * FROM sms WHERE id = '".mysql_real_escape_string(strip_tags(trim($_GET['key'])))."'");
	if(mysql_num_rows($result) == 0){
		Header("refresh:2;url=../../sklep/?action=index");
		die("<div class=\"alert alert-danger\" role=\"alert\">Blad! Brak uslugi lub wpisano recznie adres!</div>");
	}
	
	$row = mysql_fetch_array($result);
?>


	<div class="row"> <!-- row begin -->
		<div class="col-lg-12 col-md-12">
			<div class="well">
					<?php 
						if(isset($_SESSION['message'])){
							echo "<div class=\"alert alert-danger\" role=\"alert\">".$_SESSION['message']."</div>";
							session_destroy();
						}
					?>

					<div class="media">
					  <a class="media-left media-middle" href="#">
					    <img class="img-thumbnail img-responsive" src="id/<?php echo $row['sms_img']?>.png" />
					  </a>
					  <div class="media-body">
					    <h4 class="media-heading"><?php echo $row['sms_title']?></h4>
					    
					  </div>
					</div>


					<div class="row">
						
						<div class="col-sm-6 col-md-6">
							</br>
							<p><?php echo $row['sms_opis']?></p>
						</div>
						<div class="col-sm-12 col-md-12 hidden-lg hidden-md hidden-sm">
							<hr>
						</div>
						<div class="col-sm-6 col-md-6">
							<p>Wyślij sms o treści <span class="label label-primary"><?php echo $row['sms_tresc']?></span> na numer <span class="label label-primary"><?php echo $row['sms_numer']?></span> aby otrzymać kod</p>
							<p>Koszt wysyłki sms wynosi <?php echo $row['sms_cena']?></p>
							<form action="haspaid.php" method="POST" role="form">
								<div class="form-group">
									<input type="text" class="form-control" name="username" placeholder="Twój nick" required/>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="re_username" placeholder="Potwierdź nick" required/>
								</div>
								<input type="hidden" name="id" value="<?php echo $row['id']?>" />
								<input type="hidden" name="key" value="<?php echo $row['sms_numer']?>" />
								<div class="form-group">
									<input type="text" class="form-control" name="code" placeholder="Kod z sms" required/>
								</div>
								<input type="submit" class="btn btn-block btn-primary" value="Potwierdź"/>
							</form>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<hr>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-12">
							<p>Płatności sms w serwisie obsługuje ProfitSMS.pl</p>
							<p>
								<a href="http://www.profitsms.pl/regulaminy/Regulamin%20serwisu%20ProfitSMS%2001-04-2013.pdf">Regulamin</a> usługi znajduje się na stronie operatora usługi.
								</br>
								Wszelkie reklamaje można zgaszać pod tym <a href="http://profitsms.pl/page/kontakt/reklamacje">adresem</a>.
								</br>
								Kontakt z serwisem w sprawie płatności sms: <a href="mailto:twoj@gmail.com" alt="twoj@gmail.com">twoj@gmail.com</a>.
								</br>
								ProfitSMS obsługuje wystkie polskie sieci komórkowe.
								</br>
								</br>
								<img class="img-thumbnail center-block" src="img/sms_info.png" />
							</p>
						</div>
					</div>
			</div>
		</div>
    </div> <!-- row end -->


