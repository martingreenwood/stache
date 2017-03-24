<?php
/**
 * The front page template file
 *
 * @package stache
 */

get_header(); ?>


	<section>

		<div class="container">
			
			<div class="laptop">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/laptop-user.jpg">
				<div class="glow">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/glow.png">
				</div>
			</div>

		</div>

	</section>

	<section>

		<div class="container">
			
			<div class="switchbox">
				<a class="switch" href="#">Switch On</a>
			</div>
			<div class="lightsoff">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/lightsoff.jpg">
				<div class="lightson">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/lightson.jpg">
				</div>
			</div>

		</div>

	</section>

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
	</div><!-- #primary -->

<?php
get_footer();
