<?php

require_once './views/PlayersView.php';
$view = new PlayersView();
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
	    <?php $view->render(); ?>
	</body>
	</html>
<?php 
}