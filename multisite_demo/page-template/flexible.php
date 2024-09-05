<?php
  /*Template Name: flexible Page */
  
  get_header();
  ?>

<?php if( have_rows('flexible') ): ?>
<?php while( have_rows('flexible') ): the_row(); ?>

<?php get_template_part( 'section/banner' ); ?>
<?php get_template_part( 'section/show-post-section' ); ?>
<?php get_template_part( 'section/grid-box-section' ); ?>
<?php get_template_part( 'section/see-all-section' ); ?>
<?php get_template_part( 'section/partner-logo-section' ); ?>
<?php get_template_part( 'section/schedule-section' ); ?>
<?php get_template_part( 'section/standings-points-table' ); ?>
<?php get_template_part( 'section/team-ticket-section' ); ?>
<?php get_template_part( 'section/team-store-section' ); ?>
<?php get_template_part( 'section/player-stats-section' ); ?>



<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>