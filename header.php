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
		<div class="container_header">
				<a href="<?= path(); ?>" class="box_header_logo">	
					<img src="<?= asset('img/logoheader.svg'); ?>" alt="">
				</a>
				<div class="box_header_nav">
					<ul>
						<?php if (getRoleCurrentUser() === 'recruiter'){ ?>
						<li><a href="<?= path('dashboard'); ?>">Dashboard</a></li>
						<?php } else {?>
						<li><a href="<?= path(); ?>">Accueil</a></li>
						<li><a href="<?= path('/cv'); ?>">Créer votre CV</a></li>
						<?php }
						if(is_user_logged_in()){?>
						<li class="cta_button"><a href="<?= path('/compte'); ?>" >Mon compte</a></li>
						<li class="cta_button"><a href="<?php echo wp_logout_url( get_home_url() ); ?>" title="Logout">Déconnexion</a></li>
						<?php } else { ?>
						<li class="cta_button"><a href="<?= path('/register'); ?>">Inscription</a></li>
						<li class="cta_button"><a href="<?= path('/login'); ?>">Connexion</a></li>
						<?php } ?>
					</ul>
				</div>
		</div>
	</header><!-- #header -->
	
	<main id="main">
