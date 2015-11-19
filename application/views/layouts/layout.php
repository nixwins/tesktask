<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
	<head>
		<title> <?php //echo $titlePage; ?></title>
		<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet"  />
		<link href="<?php echo base_url("assets/css/main.css"); ?>" rel="stylesheet"  />
	</head>
	
	<body>
		<div class="container">
			<?php 
				require_once 'content.php'; 
				require_once 'footer.php'
			?>
		
		</div>
	
		
	</body>
	
</html>