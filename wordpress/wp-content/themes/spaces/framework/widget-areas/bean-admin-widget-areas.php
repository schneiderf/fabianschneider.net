<?php
/**
 * Bean Widget Areas Framework Add-on
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 *
 */
 
//GET CLASSES  
require_once(BEAN_FRAMEWORK_DIR . '/widget-areas/bean-admin-class.beanconditions.php' );
require_once(BEAN_FRAMEWORK_DIR . '/widget-areas/bean-admin-class.beansidebars.php' );
 
global $beansidebars;
$beansidebars = new Bean_Widget_Areas();
$beansidebars->init();