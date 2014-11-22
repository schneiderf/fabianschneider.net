<?php 
$theme_style = get_theme_mod( 'theme_style');
if ($theme_style == 'theme_style_2') { $theme_style = ''; } 
else { $theme_style = 'dark'; }
?>

<div class="hidden-sidebar <?php echo $theme_style; ?> sidebar">

	<div class="hidden-sidebar-inner">

		<?php dynamic_sidebar( 'Hidden Sidebar' ); ?>
	
	</div><!-- END .hidden-sidebar-inner -->	

</div><!-- END .hidden-sidebar -->