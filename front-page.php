<?php
/**
 * The front page template file
 *
 * @package Tabaix
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php
	// Hero Section
	get_template_part('template-parts/hero/hero', 'homepage');

	// Tools Grid Section
	get_template_part('template-parts/sections/tools', 'grid');

	// Deals Carousel Section
	get_template_part('template-parts/sections/deals', 'carousel');

	// Guides Grid Section
	get_template_part('template-parts/sections/guides', 'grid');

	// Newsletter Section
	get_template_part('template-parts/sections/newsletter');
	?>
</main><!-- #main -->

<?php
get_footer();
