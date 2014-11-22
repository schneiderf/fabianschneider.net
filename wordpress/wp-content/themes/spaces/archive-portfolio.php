<?php
/**
 * The template for displaying the default portfolio archive view
 *
 * Used to display archive-type pages for portfolio posts.
 * If you'd like to further customize these taxonomy views, you may create a
 * new template file for each specific one. This file has taxonomy-portfolio_category.php
 * and taxonomy-portfolio_tag.php pointing to it.
 * 
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header();

get_template_part( 'content', 'portfolio' ); //PULL CONTENT-PORTFOLIO.PHP

get_footer();