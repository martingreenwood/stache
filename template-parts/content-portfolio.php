<?php
/**
 * Template part for displaying portfolio content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stache
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('span4'); ?>>
	<div class="entry-content">
		<h1>About</h1>
		<?php
			the_content();
		?>
	</div>
</article>
