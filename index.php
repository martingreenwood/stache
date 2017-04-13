<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stache
 */

get_header(); ?>

	<?php 
	$pageID = get_id_by_slug('blog');
	$featureimage = wp_get_attachment_url( get_post_thumbnail_id( $pageID ) );
	?>
	<section id="feature-image" class="parallax-window" data-bleed="50" data-parallax="scroll" data-image-src="<?php echo $featureimage; ?>">
		<div class="caption table">
			<div class="cell bottom">
				<div class="container">
					<h1><?php echo get_the_title( $pageID ); ?></h1>
					<hr>
					<h2><?php the_field( 'sub_heading', $pageID ); ?></h2>
				</div>
			</div>
		</div>
	</section>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'blog' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main>
	</div>

<?php
get_footer();
