<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cv-corp
 */

get_header();
?>

<section id="404-box">
    <div class="error-code">
        <div title="404">404</div>

    </div>
    <div class="liens">
          <a href="<?= path(); ?>">retour au menu principal</a>
    </div>
</section>

<?php
get_footer();
