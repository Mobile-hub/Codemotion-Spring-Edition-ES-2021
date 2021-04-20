<?php
/**
 * The sidebar containing the main footer columns widget areas
 *
 * @subpackage fBachFlowers
 * @author tishonator
 * @since fBachFlowers 1.0.0
 *
 */
?>

<div id="footer-cols">

	<div id="footer-cols-inner">

		<?php 
			/**
			 * Display widgets dragged in 'Footer Columns 1' widget areas
			 */
		?>
		<div class="col3a">
			<?php dynamic_sidebar( 'footer-column-1-widget-area' ); ?>
		</div><!-- .col3a -->
		
		<?php 
			/**
			 * Display widgets dragged in 'Footer Columns 2' widget areas
			 */
		?>
		<div class="col3b">
			<?php dynamic_sidebar( 'footer-column-2-widget-area' ); ?>	
		</div><!-- .col3b -->
		
		<?php 
			/**
			 * Display widgets dragged in 'Footer Columns 3' widget areas
			 */
		?>
		<div class="col3c">
			<?php dynamic_sidebar( 'footer-column-3-widget-area' ); ?>		
		</div><!-- .col3c -->
		
		<div class="clear">
		</div><!-- .clear -->

	</div><!-- #footer-cols-inner -->

</div><!-- #footer-cols -->