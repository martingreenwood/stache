<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stache
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class($pagename); ?>>
<div id="page" class="site">

	<div id="loader">
		<div id="loading">
			<div id="progstat"></div>
			<div id="progress"></div>
		</div>
	</div>

	<?php 
	$featureimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
	$terms = wp_get_post_terms( $post->ID, 'project-attribute' );
	$header_mode = "";
	$header_mode = get_field( 'header_mode' );
	?>
	<header id="masthead" class="<?php echo $header_mode; ?> site-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="site-branding">
					<?php if ( function_exists( 'the_custom_logo' ) ): ?>
						<?php the_custom_logo(); ?>
					<?php endif; ?>
				</div>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle menu-icon dark">
					  <span></span>
					  <span></span>
					  <span></span>
					  <span></span>
					</button>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>

					<div id="sentence-wrapper" class="hide">
						<?php 
						$base_slogans = get_field( 'slogans', 'options' );
						shuffle($base_slogans);
						
						$slogans = "beard";
						if($base_slogans)
						{
							foreach($base_slogans as $base_slogan)
							{
								$slogans .= " | " . $base_slogan['slogan'];
							}
						}
						?>
						<h2>We Are 
							<span id="js-rotating">
								<?php echo $slogans; ?>
							</span>
						</h2>
					</div>

				</nav>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">
