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

	<div id="team">
		<div class="container">
		<?php $i = 1; $team = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => -1 ) ); ?>
			<div class="members row">
			<?php while ( $team->have_posts() ) : $team->the_post(); ?>
				<div class="member span6">

					<?php $teamimage = wp_get_attachment_url( get_post_thumbnail_id($team->ID)); ?>
					<div class="image"">
						<?php the_post_thumbnail( 'snap' ); ?>
					</div>

					<h2><?php the_title( ); ?></h2>
					<h3><?php the_field( 'sub_heading' ); ?></h3>
					<ul>
						<?php if (get_field( 'instagram' )): ?>
							<li><a href="<?php the_field( 'instagram' ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if (get_field( 'facebook' )): ?>
							<li><a href="<?php the_field( 'facebook' ); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if (get_field( 'twitter' )): ?>
							<li><a href="<?php the_field( 'twitter' ); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if (get_field( 'linkedin' )): ?>
							<li><a href="<?php the_field( 'linkedin' ); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if (get_field( 'google-plus' )): ?>
							<li><a href="<?php the_field( 'google-plus' ); ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if (get_field( 'tumblr' )): ?>
							<li><a href="<?php the_field( 'tumblr' ); ?>" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if (get_field( 'behance' )): ?>
							<li><a href="<?php the_field( 'behance' ); ?>" target="_blank"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
						<?php endif; ?>
					</ul>

					<?php the_content(); ?>

				</div>
				<?php
     			if($i % 2 == 0) {echo '</div><div class="members row">';} $i++;
     			?>
			<?php endwhile; wp_reset_query(); ?>
			</div>
		</div>
	</div>

<?php
get_footer();
