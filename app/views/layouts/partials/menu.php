<!--
	@Layouts::Partials::Menu
	@use Layout_Main::do_menu($curr_page);
-->
<?php if(isset($color) && isset($brand)): ?>
	<nav class="navbar is-<?php echo $color; ?>" role="navigation" aria-label="main navigation">
		<div class="navbar-brand"><?php echo $brand; ?>
			<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="blznav" id="burger" onmouseup="tb('blznav','burger');">
				<span aria-hidden="true"></span> 
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
			</a>
		</div>
		<div id="blznav" class="navbar-menu">
			<div class="navbar-end">
				<?php echo Layout_Menu::do_build_menu($curr_page); ?>
			</div>
		</div>
	</nav>
<?php endif; ?>