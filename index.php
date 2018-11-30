<?php get_header(); ?>

<br>
<?php language_attributes(); ?>
<br>
<?php bloginfo( 'charset' ); ?>
<br>
<?php echo ROOT_DIR ?>
<br>
<?php echo ROOT_URI ?>
<br>
<?php echo INC_DIR ?>
<br>
<?php echo INC_URI ?>
<br>

<?php get_products(); ?>

<?php get_footer(); ?>