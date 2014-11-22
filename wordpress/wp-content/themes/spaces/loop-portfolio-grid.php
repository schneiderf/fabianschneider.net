<?php
/**
 * The content loop file for portfolio grid templates.
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
$terms =  get_the_terms( $post->ID, 'portfolio_category' ); 
$term_list = null;
if( is_array($terms) ) { foreach( $terms as $term ) { $term_list .= $term->term_id; $term_list .= ' '; } }
?>

<?php if ( ( function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
	
     <li id="portfolio-<?php the_ID(); ?>" <?php post_class("$term_list item"); ?>>
          
          <div id="post-<?php the_ID(); ?>" class="portfolio">
          	
               <a class="entry-link" title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>"></a> 
              
               <?php the_post_thumbnail('grid-feat'); ?>
              
               <div class="overlay">
                    <h5>
                        <a title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h5>
               </div>
        
          </div>
    
     </li>

<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) )