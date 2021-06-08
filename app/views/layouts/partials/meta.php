<!--
	@Layouts::Partials::Meta
	@use Layout_Main::do_meta($curr_page, $ml);
-->
<?php if(isset($page) && isset($ml)): ?>
	<!-- Blazed Labs LLC Common Organization Schema -->
		<?php echo Ice_Generate::do_schema(); ?>
	<!-- Meta tags -->
		<!-- General -->
		<?php
			$s = \Config::get('ice.schema');
			$c = $s['company'];
			$pt = Ice_Generate::do_title($page);
			$pd = $s['name'] . ' - ' . $pt;
		?>
		<!-- 1. Essential -->
		<?php if($ml >= 1): ?>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
			<meta name="robots" content="index,follow"><!-- All Search Engines -->
			<meta name="googlebot" content="index,follow"><!-- Google Specific -->
		<?php endif; ?>
		<!-- 2. Misc -->
		<?php if($ml >= 2): ?>
			<meta name="screen-orientation" content="portrait">
			<meta name="mobile-web-app-capable" content="yes">
			<meta name="layoutmode" content="fitscreen/standard">
			<meta name="description" content="<?php echo $pd; ?>" />
			<meta itemprop="name" content="<?php echo $s['name']; ?>">
			<meta itemprop="description" content="<?php echo $pd; ?>">
			<meta itemprop="image" content="<?php echo $s['logo']; ?>">
		<?php endif; ?>
		<!-- 3. Mobile -->
		<?php if($ml >= 3): ?>
			<!-- 3.1. Android  -->
			<meta name="theme-color" content="<?php echo $s['color']; ?>">
			<meta name="mobile-web-app-capable" content="yes">
			<!-- 3.2. iOS -->
			<meta name="apple-mobile-web-app-title" content="<?php echo $s['name']; ?>">
			<meta name="apple-mobile-web-app-capable" content="yes">
			<meta name="apple-mobile-web-app-status-bar-style" content="default">
			<!-- 3.3. Windows  -->
			<meta name="msapplication-config" content="<?php echo Uri::base(); ?>assets/browserconfig.xml">
			<meta name="msapplication-navbutton-color" content="white">
			<meta name="msapplication-TileColor" content="white">
			<meta name="msapplication-tap-highlight" content="no">
			<meta name="application-name" content="<?php echo $s['name']; ?>">
			<meta name="msapplication-tooltip" content="<?php echo $pt; ?>">
			<meta name="msapplication-starturl" content="/">
			<meta name="msapplication-TileImage" content="<?php echo Uri::base(); ?>assets/icons/ms-icon-144x144.png">
			<!-- 3.4. UC Mobile Browser  -->
			<meta name="full-screen" content="no">
			<meta name="browsermode" content="application">
		<?php endif; ?>
		<!-- 4. Social -->
		<?php if($ml >= 4): ?>
			<!-- 4.1. Social - FACEBOOK -->
			<meta property="og:url" content="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<meta property="og:type" content="website">
			<meta property="og:title" content="<?php echo $pt; ?>">
			<meta property="og:image" content="<?php echo $s['logo']; ?>">
			<meta property="og:image:alt" content="<?php echo $c; ?> Logo.">
			<meta property="og:description" content="<?php echo $pd; ?>">
			<meta property="og:site_name" content="<?php echo $s['name']; ?>">
			<meta property="og:locale" content="en_US">
			<meta property="article:author" content="<?php echo $c; ?>">
			<!-- 4.2. Social - TWITTER -->
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@BlazedLabs">
			<meta name="twitter:url" content="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<meta name="twitter:title" content="<?php echo $s['name']; ?>">
			<meta name="twitter:description" content="<?php echo $pd; ?>">
			<meta name="twitter:image" content="<?php echo $s['logo']; ?>">
			<meta name="twitter:image:alt" content="<?php echo $c; ?> Logo.">
		<?php endif; ?>

	<!-- Links & Polyfill -->
		<!-- Title -->
		<title><?php echo $pd; ?></title>
		<!-- Info -->
		<link rel="index" href="<?php echo Uri::base(true); ?>">
		<link rel="author" href="<?php echo Uri::base(); ?>assets/humans.txt" />
		<link rel="me" href="<?php echo Uri::base(true); ?>" type="text/html">
		<link rel="me" href="mailto:<?php echo \Config::get('misc.contact_email'); ?>">
		<?php 
			//create inline webmanifest
			echo Ice_Generate::do_manifest(); 
		?> 
		<!-- Icons -->
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
		
	<!-- Legacy IE Compatibility (POLYFILL For Semantic HTML Elements) -->
			<!--[if lt IE 9]><script>document.createElement(\'header\');document.createElement(\'nav\');document.createElement(\'main\');document.createElement(\'section\');document.createElement(\'article\');document.createElement(\'aside\');document.createElement(\'footer\');</script><![endif]-->

		
<?php endif; ?>