<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cv-corp
 */

?>
	</main><!-- #main -->
			<footer id="footer" class="<?php if(getRoleCurrentUser() === 'candidate'){ echo 'candidate';} elseif(getRoleCurrentUser() === 'recruiter' || getRoleCurrentUser() === 'administrator'){ echo 'rec';} ?>">
				<div class="container_footer">
						<div class="box_footer_0">
							<h2>CV CORP</h2>
							<p>Copyright 2021 - tous droits réservés</p>
						</div>
						<div class="box_footer_0">
							<h2>Nos services</h2>
							<ul>
								<li><a href="<?= path('/cv')?>">Création de CV</a></li>
								<li><a href="<?= path('/login')?>">Inscription</a></li>
							</ul>
						</div>
						<div class="box_footer_0">
							<h2>Données</h2>
							<ul>
								<li><a href="<?= path('/cookies')?>">Données personnelles et cookies</a></li>
								<li><a href="<?= path('/mention-juridique')?>">Mentions légales</a></li>
							</ul>
						</div>
						<div class="box_footer_1">
							<h2>Contact</h2>
							<ul>
								<li><a href="<?= path('/contact'); ?>">Nous Contacter</a></li>
							</ul>
						</div>
					</div>
			</footer>
 </div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
