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
				<div class="wrapper">
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
		
	<?php $counter = 0;  ?>
	<?php if( have_rows('repeater') ): while( have_rows('repeater') ): the_row(); // rows ?>

	<?php if( have_rows('column') ): while( have_rows('column') ): the_row(); $counter ++; // columns ?>

		<?php if($counter == 1) { ?>
		<?php $image = get_sub_field('image'); ?>
		<div class="service odd" style="background-image: url(<?php echo $image['url'] ?>);">
			<div class="ovewrlay">
				<a class="more" href="<?php the_sub_field( 'page_link' ); ?>">Read More</a>
			</div>
			<div class="container narrow">

				<div class="half">
					&nbsp;
				</div>
				
				<div class="half text">
					<div class="table">
						<div class="cell middle">
							<?php the_sub_field('content'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }
		// If the second item in the loop
		elseif($counter == 2) { 
		// Reset the counter
		$counter = 0; 
		?>
		<?php $image = get_sub_field('image'); ?>
		<div class="service even" style="background-image: url(<?php echo $image['url'] ?>);" >
			<div class="ovewrlay">
				<a class="more" href="<?php the_sub_field( 'page_link' ); ?>">Read More</a>
			</div>
			<div class="container narrow">
				
				<div class="half text">
					<div class="table">
						<div class="cell middle">
							<?php the_sub_field('content'); ?>
						</div>
					</div>
				</div>

				<div class="half">
					&nbsp;
				</div>

			</div>
		</div>
		<?php } //end the elseif $counter ?>
			
	<?php endwhile; endif; ?>
	<?php endwhile; endif; ?>
	
		<div class="fulllist">
			<div class="container narrow">
				<?php the_field( 'additional_content' ); ?>
			</div>
		</div>

	</div>

<?php
get_footer();
