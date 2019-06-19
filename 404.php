<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="full-content-area clear default-template">
		<main id="main" class="site-main wrapper" role="main">

			<section class="error-404 not-found text-center">
				<header class="page-header">
					<div class="icondiv"><span><i class="fas fa-exclamation-triangle"></i></span></div>
					<div class="txt404" style="display:none;"><span>404</span></div>
					<h1 class="page-title"><?php esc_html_e( "We're sorry, the page you requested could not be found.", 'acstarter' ); ?></h1>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
