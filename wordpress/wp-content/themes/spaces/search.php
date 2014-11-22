<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header(); ?>

<div class="row">

	<div class="eight columns sidebar-right">

		<?php if ( have_posts() ) { ?>

			<form method="get" id="searchform" class="searchform search" action="<?php echo home_url(); ?>/">
				<input type="text" name="s" id="s" value="<?php _e('To search type & hit enter', 'bean') ?>" onfocus="if(this.value=='<?php _e('To search type & hit enter', 'bean') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('To search type & hit enter', 'bean') ?>';" />
			</form><!-- END #searchform -->

			<?php global $query_string; query_posts( $query_string . '&posts_per_page='. get_option('posts_per_page') .'' ); ?>

			<ul id="grid-container" class="grid">
				<?php if (have_posts()) : while (have_posts()) : the_post(); 
					get_template_part( 'loop-post' ); //PULL LOOP-POST.PHP	
				endwhile; endif; 
				?>
			</ul><!-- END #grid-container -->
			
		<?php } else { ?>
		
			<div class="row">
				
					<h1 class="entry-title"><?php printf( __('Nothing Found', 'bean'), get_search_query()); ?></h1>
					<p><?php printf( __('Sorry, but we couldn&#39;t find anything for "%s".','bean'), get_search_query() ); ?></p>
						
					<form method="get" id="searchform" class="searchform search" action="<?php echo home_url(); ?>/">
						<input type="text" name="s" id="s" value="<?php _e('To search type & hit enter', 'bean') ?>" onfocus="if(this.value=='<?php _e('To search type & hit enter', 'bean') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('To search type & hit enter', 'bean') ?>';" />
					</form><!-- END #searchform -->
		

			</div><!-- END .row -->

		<?php } //END else ?>

	</div><!-- END .eight.columns.sidebar-right -->

	<div class="four columns sidebar">
		
		<?php dynamic_sidebar( 'Internal Sidebar' ); ?>
	
	</div><!-- END .four.columns.sidebar -->

</div><!-- END .row -->
		
<?php get_footer();