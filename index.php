<?php
$isHome = true;
$value = $_GET["view"];
if (file_exists('./views/'.$value.'View.php')) {
	require_once './views/'.$value.'View.php';
	$view = new PlayersView();
	$isHome = false;
} else {
	require_once './views/LandingView.php';
	$view = new LandingView();
}

$isCLI = php_sapi_name() === 'cli';

if ($isCLI) {
	$view->cli();
} else {
?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php
			foreach($view->css() as $cssFile) {
				$file = __DIR__."/assets/".$cssFile;
				if (file_exists($file)) { ?>
					<link rel="stylesheet" href="<?php echo "/assets/".$cssFile; ?>">
				<?php 
				}
			}
		?>
	</head>
	<body>
		<?php if(!$isHome) { ?>
			<a href="/">Home</a><hr />
	    <?php }
	    	$view->render();
	    ?>
	</body>
	</html>
<?php 
}


