<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lakesmtb
 */

?>
<!--
* Built by Pixel Pudu 
* http://www.pixelpudu.com/
-->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class($pagename); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="site-branding">
						<div class='site-logo'>
			   				<?php
			                    if ( function_exists( 'the_custom_logo' ) ):
			                        the_custom_logo();
			                    else: ?>
			                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			                    <?php endif; ?>
						</div>
					</div><!-- .site-branding -->

					<?php if(get_field('enable_header_banner', 'option')): 
					$banner_image = get_field('banner_image', 'option');
					?>
					<div id="header-banner">
						<a href="<?php the_field('banner_link', 'option'); ?>"><img src="<?php echo $banner_image['sizes']['banner']; ?>"/></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="menu">
			<div class="container">
				<div class="row">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'lakesmtb' ); ?></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
