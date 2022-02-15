<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cv-corp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="header" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			<ul>
				<li>
					<a href="<?= path(); ?>">Home</a>
				</li>
				<li>
					<a href="<?= path('/login'); ?>">Login</a>
				</li>
			</ul>
		</nav>
	</header><!-- #header -->
	<main id="main">
		
