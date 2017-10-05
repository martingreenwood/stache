<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stache
 */

?>

<?php $featureimage = wp_get_attachment_url( get_post_thumbnail_id( ) ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?> >
	<a href="<?php the_permalink(); ?>">
		<div class="entry-image" style="background-image: url(<?php echo $featureimage; ?>);">
			<div class="overlay"></div>
		</div>
		<div class="entry-content">
			<h2><?php the_title( ); ?></h2>
			<hr>
			<p><?php the_date(); ?> / <?php comments_number( 'no comments', 'one comment', '% comments' ); ?></p>
		</div>
	</a>
</article>
