<?php
/**
 * Template Name: Sidebar Left (Content Right)
 * Description: A page template displaying a sticky sidebar on the left and content on the right.
 *
 * @package Tabaix
 */

get_header(); ?>

<div class="container py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Left Sidebar -->
        <aside class="w-full lg:w-1/3 order-2 lg:order-1">
            <div class="sticky top-24 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                <?php else : ?>
                    <h3 class="text-xl font-bold mb-4"><?php esc_html_e('Sidebar', 'tabaix'); ?></h3>
                    <p class="text-gray-600"><?php esc_html_e('Add widgets to Sidebar 1 in Appearance > Widgets to populate this area.', 'tabaix'); ?></p>
                <?php endif; ?>
            </div>
        </aside>

        <!-- Right Content -->
        <main id="primary" class="site-main w-full lg:w-2/3 order-1 lg:order-2 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <header class="entry-header mb-8 pb-6 border-b border-gray-100">
                    <?php the_title( '<h1 class="entry-title text-3xl font-bold text-gray-900">', '</h1>' ); ?>
                </header>
                
                <div class="entry-content prose max-w-none">
                    <?php the_content(); ?>
                </div>
                <?php
            endwhile;
            ?>
        </main>

    </div>
</div>

<?php get_footer(); ?>
