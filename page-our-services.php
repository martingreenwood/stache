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

	<div id="services">
		<div class="container narrow">
		<?php if( have_rows('repeater') ): while( have_rows('repeater') ): the_row(); // rows ?>
			<div class="service">
			<?php if( have_rows('column') ): while( have_rows('column') ): the_row(); // columns ?>
				<?php $columnwidth = get_sub_field( 'column_width' ); ?>
				<?php if( have_rows('column_content') ): while ( have_rows('column_content') ) : the_row(); ?>

					<?php if( get_row_layout() == 'image' ): ?>
						<div class="span<?php echo $columnwidth; ?>">
							<?php $image = get_sub_field('image'); ?>
							<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
						</div>
					<?php elseif( get_row_layout() == 'content' ): ?>
						<div class="span<?php echo $columnwidth; ?>">
							<?php the_sub_field('content'); ?>
						</div>
					<?php endif; ?>

				<?php endwhile; endif; ?>
			<?php endwhile; endif; ?>
			
			</div>
		<?php endwhile; endif; ?>
			<div class="fulllist">
				<?php the_field( 'additional_content' ); ?>
			</div>
		</div>
	</div>

<?php
get_footer();
