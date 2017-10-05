<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package stache
 */

if ( ! function_exists( 'stache_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function stache_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'stache' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'stache' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'stache_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function stache_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'stache' ) );
		if ( $categories_list && stache_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'stache' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'stache' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'stache' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'stache' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'stache' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function stache_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'stache_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'stache_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so stache_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so stache_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in stache_categorized_blog.
 */
function stache_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'stache_categories' );
}
add_action( 'edit_category', 'stache_category_transient_flusher' );
add_action( 'save_post',     'stache_category_transient_flusher' );



// get average luminance, by sampling $num_samples times in both x,y directions
function get_avg_luminance($filename, $num_samples=20) {
	$img = imagecreatefromjpeg($filename);

	$width = imagesx($img);
	$height = imagesy($img);

	$x_step = intval($width/$num_samples);
	$y_step = intval($height/$num_samples);

	$total_lum = 0;
	$sample_no = 1;

	for ($x=0; $x<$width; $x+=$x_step) {
		for ($y=0; $y<$height; $y+=$y_step) {

			$rgb = imagecolorat($img, $x, $y);
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;

			// choose a simple luminance formula from here
			// http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
			$lum = ($r+$r+$b+$g+$g+$g)/6;

			$total_lum += $lum;

			// debugging code
			// echo "$sample_no - XY: $x,$y = $r, $g, $b = $lum<br />";
			$sample_no++;
		}
	}

	// work out the average
	$avg_lum  = $total_lum/$sample_no;
	return $avg_lum;
}