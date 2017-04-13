<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stache
 */

get_header(); ?>

	<?php 
	$featureimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
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

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile;
			?>

		</main>
	</div>

	<div id="portfolio">
		<div class="container narrow">
		<?php $i = 1; $team = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => -1 ) ); ?>
			<div class="grid">
			<div class="grid-sizer"></div>
			<?php while ( $team->have_posts() ) : $team->the_post(); ?>
				<div class="grid-item grid-item--width<?php the_field( 'portfolio_width' ); ?>">
					<a href="<?php the_permalink(); ?>">
					<?php $portfolio_image = get_field( 'portfolio_image' ); ?>
					<img src="<?php echo $portfolio_image['url']; ?>" alt="<?php echo $portfolio_image['alt']; ?>" />

					<div class="info">
						<div class="table"><div class="cell middle">
							<h2><?php the_title( ); ?></h2>
							<?php $terms = wp_get_post_terms( get_the_id(), 'project-attribute', $args ); ?>
							<hr>
							<h3><?php echo $terms[0]->name; ?></h3>
						</div></div>
					</div>
					</a>
				</div>
				
				<?php //if($i % 3 == 0) {echo '</div><div class="members row">';} $i++; ?>
			<?php endwhile; wp_reset_query(); ?>
			</div>
		</div>
	</div>

<?php
get_footer();
