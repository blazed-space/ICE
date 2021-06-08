<!--
	@Layouts::Defaults::Baseof
	@use
	 $p = new Ice_Page();
	 $p->set_page($page);
	 $p->set_content($content);
	 $p->set_bundle($bundle);
-->
<?php if(isset($page) && isset($content) && isset($bundle)): ?>
	<!DOCTYPE HTML>
	<html lang="en" dir="ltr" itemscope itemtype="https://schema.org/Organization">
		<head>

			
			

			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
			<meta name="robots" content="index,follow"><meta name="googlebot" content="index,follow">
			<meta name="screen-orientation" content="portrait"><meta name="mobile-web-app-capable" content="yes">
			<meta name="layoutmode" content="fitscreen/standard"><meta name="mobile-web-app-capable" content="yes">
			<meta name="apple-mobile-web-app-capable" content="yes">
			
			<link rel="icon" type="image/png" sizes="32x32" href="<?php echo Uri::base(); ?>assets/icons/favicon-32x32.png">
			<link rel="icon" type="image/png" sizes="96x96" href="<?php echo Uri::base(); ?>assets/icons/favicon-96x96.png">
			<link rel="icon" type="image/png" sizes="16x16" href="<?php echo Uri::base(); ?>assets/icons/favicon-16x16.png">
			<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo Uri::base(); ?>assets/icons/android-icon-192x192.png">
			<link rel="apple-touch-icon" sizes="57x57" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-57x57.png">
			<link rel="apple-touch-icon" sizes="60x60" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-60x60.png">
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-72x72.png">
			<link rel="apple-touch-icon" sizes="76x76" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-76x76.png">
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-114x114.png">
			<link rel="apple-touch-icon" sizes="120x120" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-120x120.png">
			<link rel="apple-touch-icon" sizes="144x144" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-144x144.png">
			<link rel="apple-touch-icon" sizes="152x152" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-152x152.png">
			<link rel="apple-touch-icon" sizes="180x180" href="<?php echo Uri::base(); ?>assets/icons/apple-icon-180x180.png">
			<link rel="apple-touch-startup-image" href="<?php echo Uri::base(); ?>assets/icons/assets/img/blz_logo.jpg">
			
			<?php
				echo $bundle->renderCss();
			?>

			<!--[if lt IE 9]><script>document.createElement(\'header\');document.createElement(\'nav\');document.createElement(\'main\');document.createElement(\'section\');document.createElement(\'article\');document.createElement(\'aside\');document.createElement(\'footer\');</script><![endif]-->


		</head>
		<body>
			<!-- Homepage BG -->
			<?php if($page === 1): ?>
				<div class="top"></div>
			<?php endif; ?>
			
			<!-- Header (.top) -->
			<header id="top">
				
			</header>
		
			<!-- Main Content (.content) -->
			 <main class="content">
			 	<?php 
					$content->bundle = $bundle;
					echo $content; 
				?>
			 </main>
			
			<!-- Page Footer -->
			 <footer>
				<noscript>
					<span>For the best browsing experience, please enable Javascript.</span>
				</noscript>
			 </footer>

			 <!-- Render JS bundle -->
			 <?php
				echo $bundle->renderJs();
			 ?>
		 </body>
	</html>
<?php endif; ?>