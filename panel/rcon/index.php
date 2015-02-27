<?php
session_start();
if ($_SESSION['auth'] == TRUE){

	require 'rcon.php';
	require 'minecraft_string.php';
	
	$server = 'xxx';
	$port = 23456;
	$password = 'xxx';
	
	$command = isset($_GET['rcon']) && !empty($_GET['rcon']) ? $_GET['rcon'] : 'version';
	
	if ($command[0] == '/') {
		$command = substr($command, 1);
	}

	try
	{
		$rcon = new RCon($server, $port, $password);
		$return =  nl2br(minecraft_string($rcon->command($command)));
	}
	catch(Exception $e)
	{
		$return = $e->getMessage( );
	}
	if (isset($_GET['rcon'])) die($return);
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<link href="../../sklep/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../../sklep/css/jumbo.css" rel="stylesheet" type="text/css" />
		
		<style type="text/css">
			#console {
				height: 500px;
				min-height:400px;
				background:rgba(0, 0, 0, 0.07);
				border-radius: 4px;
				padding: 10px 20px;
			}
		</style>
	</head>
	<body>


<div class="container">
		<div class="well">
			<div class="header">
				<nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation"><a href="/sklep">Strona główna sklepu</a></li>
					</ul>
				</nav>
				<h1 class="text-muted"><a href="/sklep" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Powrót na stronę główną sklepu CubeCraft">CubeCraft</a></h1>
			</div>

	<div class="row"> <!-- row begin -->
		<div class="col-lg-12 col-md-12">
			<div>
					<div class="row clearfix">
						<div class="col-md-12 column">
							<div>
							<h3 style="margin-bottom: 47px">Konsola</h3>
								<div id="console">
									<?php echo $return ?>
								</div>
								<div class="input-group" style="margin-top: 5px;">
								  <span class="input-group-addon" id="basic-addon1">Komenda:</span>
								  <input type="text" placeholder="tutaj..." class="form-control"> 
								</div>
								
							</div>
						</div>
					</div>
			</div>
		</div>
    </div> <!-- row end -->



			<footer class="footer">
				<div class="row">
			    	<div class="col-sm-6 col-md-6">
						<h4>© CubeCraft 2014</h4>
					</div>
					<div class="col-sm-6 col-md-6">
						<a href="mailto:olszak94@gmail.com"><h4 class="pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="E-mail olszak94@gmail.com"><span class="label label-black">Realizacja: Rafał Olszewski</span></h4></a>
					</div>
				</div>
			</footer>

		</div>
	</div>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  <script src="../../sklep/js/bootstrap.min.js"></script>
		  <script src="../../sklep/js/init.js"></script>
		<script src="jquery.inputhistory.js"></script>
		<script>
			$('input').focus().inputHistory(function(value) {	 
				$('#console').html($('#console').html() + '<br><strong>&gt; ' + value + '</strong>');
				$.get('?rcon=' + encodeURIComponent(value), function(data){$('#console').html($('#console').html() + '<br>' + data).animate({ scrollTop: $('#console')[0].scrollHeight}, 800); });
			});
		</script>
	</body>
</html>
<?php
}
else{
	die('Nie zalogowany');
}
?>