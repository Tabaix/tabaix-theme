<?php
/**
 * Template Name: Magazine Layout
 * Description: A robust layout for content heavy sites featuring a hero post, featured grid, and latest news.
 *
 * @package Tabaix
 */

get_header(); ?>

<main id="primary" class="site-main py-12">
    <div class="container">
        <!-- Hero Featured Post -->
        <?php
        $hero_args = array(
            'posts_per_page' => 1,
            'ignore_sticky_posts' => 1,
            'meta_key' => 'featured',
            'meta_value' => '1'
        );
        $hero_query = new WP_Query($hero_args);
        if ($hero_query->have_posts()) :
            while ($hero_query->have_posts()) : $hero_query->the_post();
        ?>
            <article class="relative rounded-3xl overflow-hidden shadow-lg mb-12 bg-gray-900 group">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="absolute inset-0 opacity-50 group-hover:opacity-60 transition-opacity duration-300">
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php endif; ?>
                <div class="relative z-10 p-8 md:p-16 flex flex-col justify-end min-h-[400px] md:min-h-[500px]">
                    <div class="mb-4">
                        <?php 
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo '<span class="bg-blue-600 text-white text-xs font-bold uppercase px-3 py-1 rounded-full">' . esc_html($categories[0]->name) . '</span>';
                        }
                        ?>
                    </div>
                    <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">
                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-200 transition-colors"><?php the_title(); ?></a>
                    </h2>
                    <p class="text-gray-200 text-lg md:text-xl max-w-3xl mb-6 line-clamp-2">
                        <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                    </p>
                    <div class="flex items-center text-gray-300 text-sm">
                        <span class="mr-4"><i class="fas fa-calendar mr-2"></i><?php echo get_the_date(); ?></span>
                        <span><i class="fas fa-user mr-2"></i><?php the_author(); ?></span>
                    </div>
                </div>
            </article>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <h3 class="text-2xl font-bold border-b-2 border-blue-600 pb-2 mb-6 inline-block"><?php esc_html_e('Latest Articles', 'tabaix'); ?></h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php
                    $latest_args = array(
                        'posts_per_page' => 6,
                        'ignore_sticky_posts' => 1,
                        'post__not_in' => isset($hero_query) ? wp_list_pluck($hero_query->posts, 'ID') : []
                    );
                    $latest_query = new WP_Query($latest_args);
                    if ($latest_query->have_posts()) :
                        while ($latest_query->have_posts()) : $latest_query->the_post();
                    ?>
                        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block h-48 overflow-hidden">
                                    <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300']); ?>
                                </a>
                            <?php endif; ?>
                            <div class="p-6">
                                <h4 class="text-xl font-bold mb-2 line-clamp-2"><a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-blue-600"><?php the_title(); ?></a></h4>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="text-blue-600 font-semibold text-sm hover:underline"><?php esc_html_e('Read More →', 'tabaix'); ?></a>
                            </div>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="sticky top-24">
                    <h3 class="text-2xl font-bold border-b-2 border-blue-600 pb-2 mb-6 inline-block"><?php esc_html_e('Trending', 'tabaix'); ?></h3>
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <ul class="space-y-6">
                            <?php
                            $trending_args = array(
                                'posts_per_page' => 5,
                                'orderby' => 'comment_count', // Simplified trending metric
                                'order' => 'DESC'
                            );
                            $trending_query = new WP_Query($trending_args);
                            $counter = 1;
                            if ($trending_query->have_posts()) :
                                while ($trending_query->have_posts()) : $trending_query->the_post();
                            ?>
                                <li class="flex items-start gap-4">
                                    <span class="text-3xl font-extrabold text-blue-200"><?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?></span>
                                    <div>
                                        <h5 class="text-sm font-bold leading-tight mb-1"><a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-blue-600"><?php the_title(); ?></a></h5>
                                        <span class="text-xs text-gray-500"><?php echo get_the_date(); ?></span>
                                    </div>
                                </li>
                            <?php
                                $counter++;
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
