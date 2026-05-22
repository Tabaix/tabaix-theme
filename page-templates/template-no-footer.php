<?php
/**
 * Template Name: Funnel (Header, No Footer)
 * Description: A page template that includes the header but removes the footer. Great for sales funnels or sign-up flows.
 *
 * @package Tabaix
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container py-12">
        <?php
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>
</main>

<?php wp_footer(); ?>
</body>
</html>
