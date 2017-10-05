<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package stache
 */

get_header(); ?>

	<section id="feature-image" class="parallax-window" data-bleed="50" data-parallax="scroll" data-image-src="http://local.wearebeard.com/wp-content/uploads/2017/09/blog.jpg">
		<div class="caption table">
			<div class="cell bottom">
				<div class="wrapper">
					<h1>Search Results:</h1>
					<hr>
					<h2><?php printf( esc_html__( '%s', 'stache' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</div>
			</div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main " role="main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main>
	</div>

<?php
get_footer();
