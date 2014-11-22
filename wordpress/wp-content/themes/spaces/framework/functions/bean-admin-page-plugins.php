<?php 
/**
 * Generates the page that directs to the ThemeBeans plugins page
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 */
 
function bean_plugins_page() 
{ ?>
    <script type="text/javascript">
        //<![CDATA[
            window.location.replace("http://themebeans.com/plugins/?ref=wp_plugins_sidebar");
        //]]>
    </script>
<?php }