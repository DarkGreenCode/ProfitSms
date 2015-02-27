<?php
	$page = 1;
	$perPage = 6;
	if(!empty($_GET['page'])) $page = mysql_real_escape_string($_GET['page']);
	
	$result = mysql_query("SELECT * FROM sms");
	$num_rows = mysql_num_rows($result);
	
	$limit = ($page == 1 ? 0 : $page * $perPage - $perPage);
	$result = mysql_query("SELECT * FROM sms LIMIT ".$limit.", ".$perPage);
	
	$pages = ceil($num_rows / $perPage);
?>


	<div id="karuzela">
		<div class="well">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			    <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img class="img-responsive" src="img/jumbo-bg.jpg" alt="">
			      <div class="carousel-caption">
			        <h1>CraftTrak</h1>
					<p class="lead">Sprawdzaj swoje statystyki na kilofie<span class="label label-success"></span></p>
					<p><a class="btn btn-lg btn-success" href="../../sklep/?action=sms&key=170" role="button">KUP TERAZ</a></p>
			      </div>
			    </div>
			    <div class="item">
			      <img class="img-responsive" src="img/jumbo-bg.jpg" alt="">
			      <div class="carousel-caption">
			        <h1>Power</h1>
					<p class="lead">Za mało powera pod twoją gildie<span class="label label-success"></span></p>
					<p><a class="btn btn-lg btn-success" href="../../sklep/?action=sms&key=130" role="button">KUP TERAZ</a></p>
			      </div>
			    </div>
			    <div class="item">
			      <img class="img-responsive" src="img/jumbo-bg.jpg" alt="">
			      <div class="carousel-caption">
			        <h1>Hajsownik</h1>
					<p class="lead">Nie chesz zarabiać a chcesz byc bogaty <span class="label label-success"></span></p>
					<p><a class="btn btn-lg btn-success" href="../../sklep/?action=sms&key=110" role="button">KUP TERAZ</a></p>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>

	<div class="row">
      <?
    	while($row = mysql_fetch_array($result)){
			echo "
			<div class=\"col-sm-6 col-md-4\">
			<a href=\"?action=sms&key=".$row['id']."\">
				<div class=\"thumbnail\">
					<img class=\"img-responsive\" src=\"id/".$row['sms_img'].".png\" style=\"height: 200px; width: 100%; display: block;\" />
					<div class=\"caption\">
						<h4 style=\"text-align:center;\">".$row['sms_title']."</h4>
						<p><a href=\"?action=sms&key=".$row['id']."\" class=\"btn btn-block btn-primary\" role=\"button\">ZAMÓW USŁUGĘ</a></p>
					</div>
				</div>
			</a>
			</div>";
		}
      ?>

    </div>

    <div class="row">
    	<div class="col-sm-6 col-md-6">
	    	<nav>
			  <ul class="pagination pagination-lg">
			  <?
			  for($i = 0; $i < $pages; $i++){
					$x = $i + 1;
					echo "<li><a href=?action=sklep&page=".$x.">".$x."</a></li>";
				}
			  ?>
			  </ul>
			</nav>
		</div>
    </div>



