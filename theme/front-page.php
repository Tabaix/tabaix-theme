<?php
/**
 * The front page template file
 *
 * @package Tabaix
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			
			if ( get_the_content() ) {
				// User has built a Gutenberg layout
				the_content();
			} else {
				// Fallback to classic hardcoded homepage
				get_template_part('template-parts/hero/hero', 'homepage');
				get_template_part('template-parts/sections/tools', 'grid');
				get_template_part('template-parts/sections/deals', 'carousel');
				get_template_part('template-parts/sections/guides', 'grid');
				get_template_part('template-parts/sections/newsletter');
			}
		}
	}
	?>
</main><!-- #main -->

<?php
get_footer();
