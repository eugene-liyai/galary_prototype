<?php
/*  The template for main sidebar
 */

?>

<?php if(is_active_sidebar('main_sidebar')) : ?>
    <aside class="">
        <?php dynamic_sidebar('main-sidebar'); ?>
    </aside>
<?php endif; ?>