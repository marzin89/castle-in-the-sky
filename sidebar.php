<!-- Widgetområde -->
<?php
    // Om widgetområdet innehåller widgets
    if ( is_active_sidebar( 'widget-area' ) ) { 
?>
<section id="sidebar-primary" class="sidebar">
    <?php 
        // Visa widgetområdet
        dynamic_sidebar( 'widget-area' ); 
    ?>
</section>
<?php } ?>