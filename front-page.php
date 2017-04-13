<?php
/**
 * The front page template file
 *
 * @package stache
 */

get_header(); ?>


	<?php 
	$featureimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
	?>
	<section id="feature-image" class="parallax-window" data-bleed="50" data-parallax="scroll" data-image-src="<?php echo $featureimage; ?>"></section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->

		<section id="offerings">
			<div class="container">
			<?php
			if( have_rows('feature_content') ):
				while ( have_rows('feature_content') ) : the_row();
					$title = get_sub_field('title');
					$link = get_sub_field('link');
					$text = get_sub_field('text');
					?>
					<div class="offering span4">
						<h2><?php echo $title; ?></h2>
						<?php echo $text; ?>
						<a href="<?php echo $link; ?>">See More</a>
					</div>
					<?php
				endwhile;
			endif;
			?>
			</div>
		</section>

	</div>

	<div id="brands">
		<div class="container">
		<?php $brands = get_field('brands', 'options'); if( $brands ): ?>
			<div class="brandicons">
			<?php foreach( $brands as $brand ): ?>
				<div class='brandicon'>
					<img src="<?php echo $brand['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				</div>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
		</div>
	</div>

<?php
get_footer();
