<?php
/**
 * The template for displaying the contact page
 * 
 * @package stache
 */

get_header(); ?>

	<?php 
	$featureimage = wp_get_attachment_url( get_post_thumbnail_id());
	?>
	<section id="feature-image" class="parallax-window" data-bleed="50" data-parallax="scroll" data-image-src="<?php echo $featureimage; ?>">
		<div class="caption table">
			<div class="cell bottom">
				<div class="container">
					<h1><?php the_title(); ?></h1>
					<hr>
					<h2><?php the_field( 'sub_heading' ); ?></h2>
				</div>
			</div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container narrow" role="main">

			<section class="contactdeets span6">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile;
				?>

				<?php 
				$location = get_field('office_location');
				if( !empty($location) ):
				?>

				<div id="map" data-zoom="13" data-map-info="WEAREBEARD HQ" data-map-color="#020100" data-map-saturation="-50" data-map-lightness="" data-map-scroll="false" data-map-drag="true" data-map-zoom-control="true" data-map-double-click="false" data-map-default="true">
						<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-icon="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder-wab@2x.png"></div>
				</div>

				<?php endif; ?>

			</section>

			<section class="contactform span6">
			<?php 
				$form_object = get_field('contact_form');
				gravity_form_enqueue_scripts($form_object['id'], true);
				gravity_form($form_object['id'], false, false, false, '', true, 1); 
			?>
			</section>

		</main>
	</div>

<?php
get_footer();
