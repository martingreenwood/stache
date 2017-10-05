<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stache
 */

global $post;

$post_date = strtotime($post->post_date);

get_header(); ?>

	<?php 
	$featureimage = get_field( 'post_header_image' );
	?>
	<section id="feature-image" class="parallax-window" data-bleed="50" data-parallax="scroll" data-image-src="<?php echo $featureimage[url]; ?>">
		<div class="caption table">
			<div class="cell bottom">
				<div class="wrapper">
					<h1><?php echo get_the_title(  ); ?></h1>
					<hr>
					<h2><?php echo date("jS M Y", $post_date); ?></h2>
				</div>
			</div>
		</div>
	</section>

	<section id="wrapper">

		<div class="container narrow">

			<div id="primary" class="content-area span9">
				<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					the_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

				</main>
			</div>
			<?php get_sidebar(); ?>
		
		</div>

	</section>

<?php
get_footer();
