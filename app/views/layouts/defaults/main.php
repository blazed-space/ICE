<?php if(isset($bundle) && isset($content)): ?>
    
    <!-- Base Assets -->
	<?php $bundle->start(); ?>
        <script type="text/javascript" src="/assets/js/base.js"></script>
		<!-- // -->
		<link media="screen" type="text/css" href="/assets/css/base.css">
	<?php $bundle->end(); ?>

    <header>
        <?php 
            echo Layout_Menu::do_menu($page); 
        ?>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
        &copy;2021 Blazed Labs LLC
    </footer>

<?php endif; ?>