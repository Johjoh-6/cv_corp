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
			<nav id="box_header_nav">
				<ul>
					<?php if (getRoleCurrentUser() === 'recruiter' || getRoleCurrentUser() === 'administrator'){ ?>
					<li><a href="<?= path('/dashboard'); ?>">Dashboard</a></li>
					<?php } else {?>
					<li><a href="<?= path(); ?>">Accueil</a></li>
					<li><a href="<?= path('/cv'); ?>">Créer votre CV</a></li>
					<?php }
					if(is_user_logged_in()){
						if (getRoleCurrentUser() === 'candidate'){ ?>
						<li class="cta_button"><a href="<?= path('/mycv'); ?>" >Mes CV</a></li>
						<?php } ?>
						<li class="cta_button"><a href="<?= path('/compte'); ?>" >Mon compte</a></li>
						<li class="cta_button"><a href="<?php echo wp_logout_url( get_home_url() ); ?>" title="Logout">Déconnexion</a></li>
					<?php } else { ?>
					<li class="cta_button"><a href="<?= path('/register'); ?>">Inscription</a></li>
					<li class="cta_button"><a href="<?= path('/login'); ?>">Connexion</a></li>
					<?php } ?>
				</ul>
			</nav>
			<div id="box_header_nav_phone">
				<nav>
					<?php if (getRoleCurrentUser() === 'recruiter' || getRoleCurrentUser() === 'administrator'){ ?>
					<a href="<?= path('/dashboard'); ?>">Dashboard</a>
					<?php } else {?>
					<a  href="<?= path(); ?>">Accueil</a>
					<a  href="<?= path('/cv'); ?>">Créer votre CV</a>
					<?php }
					if(is_user_logged_in()){
						if (getRoleCurrentUser() === 'candidate'){ ?>
						<a class="cta_button_phone" href="<?= path('/mycv'); ?>" >Mes CV</a>
						<?php } ?>
						<a class="cta_button_phone" href="<?= path('/compte'); ?>" >Mon compte</a>
						<a class="cta_button_phone" href="<?php echo wp_logout_url( get_home_url() ); ?>" title="Logout">Déconnexion</a>
					<?php } else { ?>
					<a class="cta_button_phone"  href="<?= path('/register'); ?>">Inscription</a>
					<a class="cta_button_phone" href="<?= path('/login'); ?>">Connexion</a>
					<?php } ?>
					</nav>
			</div>		
			<div id="menu-burger" >
				<i class="fas fa-bars"></i>
			</div>
		</div>
	</header><!-- #header -->
	
	<main id="main">
