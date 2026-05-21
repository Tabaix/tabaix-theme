<?php
/**
 * Plugin Name: Tabaix Amazon Pro
 * Description: An independent, lightning-fast Amazon Affiliate plugin connected to your custom Vercel scraper.
 * Version: 1.0.0
 * Author: Tabaix
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TABAIX_AMZ_VERSION', '1.0.0');
define('TABAIX_AMZ_PATH', plugin_dir_path(__FILE__));
define('TABAIX_AMZ_URL', plugin_dir_url(__FILE__));

class Tabaix_Amazon_Pro {
    
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_shortcode('tabaix_amazon', [$this, 'render_shortcode']);
        add_action('add_meta_boxes', [$this, 'add_search_metabox']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    public function add_settings_page() {
        add_options_page(
            'Tabaix Amazon Pro',
            'Tabaix Amazon Pro',
            'manage_options',
            'tabaix-amazon-pro',
            [$this, 'settings_page_html']
        );
    }

    public function register_settings() {
        register_setting('tabaix_amazon_group', 'tabaix_amazon_vercel_url');
        register_setting('tabaix_amazon_group', 'tabaix_amazon_tracking_id');
    }

    public function settings_page_html() {
        ?>
        <div class="wrap">
            <h1>Tabaix Amazon Pro Settings</h1>
            <p>Connect your independent Vercel Scraper API here.</p>
            <form method="post" action="options.php">
                <?php settings_fields('tabaix_amazon_group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Vercel API URL (e.g. https://your-app.vercel.app)</th>
                        <td><input type="text" name="tabaix_amazon_vercel_url" value="<?php echo esc_attr(get_option('tabaix_amazon_vercel_url')); ?>" style="width:100%; max-width:400px;" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Amazon Tracking ID (e.g. tabaix-20)</th>
                        <td><input type="text" name="tabaix_amazon_tracking_id" value="<?php echo esc_attr(get_option('tabaix_amazon_tracking_id')); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function enqueue_admin_assets($hook) {
        if ($hook === 'post.php' || $hook === 'post-new.php') {
            wp_enqueue_script('tabaix-amz-admin-js', TABAIX_AMZ_URL . 'assets/admin.js', ['jquery'], TABAIX_AMZ_VERSION, true);
            wp_localize_script('tabaix-amz-admin-js', 'tabaixAmzData', [
                'apiUrl' => get_option('tabaix_amazon_vercel_url')
            ]);
            wp_enqueue_style('tabaix-amz-admin-css', TABAIX_AMZ_URL . 'assets/admin.css', [], TABAIX_AMZ_VERSION);
        }
    }

    public function add_search_metabox() {
        add_meta_box(
            'tabaix_amazon_search',
            '🔍 Tabaix Amazon Search (Live API)',
            [$this, 'search_metabox_html'],
            ['post', 'page', 'tool'],
            'side',
            'high'
        );
    }

    public function search_metabox_html() {
        $api_url = get_option('tabaix_amazon_vercel_url');
        if (empty($api_url)) {
            echo '<p style="color:red;">Please set your Vercel API URL in the plugin settings first.</p>';
            return;
        }
        ?>
        <div id="tabaix-amz-search-app">
            <div style="display:flex; gap:5px; margin-bottom: 10px;">
                <input type="text" id="tabaix-amz-search-input" placeholder="Search products..." style="width:100%;" />
                <button type="button" id="tabaix-amz-search-btn" class="button button-primary">Search</button>
            </div>
            <div id="tabaix-amz-results" style="max-height: 300px; overflow-y: auto;"></div>
        </div>
        <?php
    }

    public function render_shortcode($atts) {
        $atts = shortcode_atts([
            'asin' => '',
            'title' => '',
            'price' => '',
            'image' => '',
            'rating' => '5.0'
        ], $atts);

        if (empty($atts['asin'])) return '';

        $tracking_id = get_option('tabaix_amazon_tracking_id');
        $affiliate_link = "https://www.amazon.com/dp/{$atts['asin']}?tag={$tracking_id}";

        ob_start();
        ?>
        <div class="tabaix-amz-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:20px; display:flex; gap:20px; align-items:center; background:#fff; box-shadow:0 4px 6px rgba(0,0,0,0.05); margin-bottom: 20px;">
            <div class="tabaix-amz-img" style="flex-shrink:0; width:120px; text-align:center;">
                <img src="<?php echo esc_url($atts['image']); ?>" alt="Product Image" style="max-width:100%; height:auto;" />
            </div>
            <div class="tabaix-amz-info" style="flex-grow:1;">
                <h4 style="margin:0 0 10px 0; font-size:18px;"><a href="<?php echo esc_url($affiliate_link); ?>" target="_blank" rel="nofollow sponsored" style="color:#0f172a; text-decoration:none;"><?php echo esc_html($atts['title']); ?></a></h4>
                <div style="color:#fbbf24; margin-bottom:10px;">⭐⭐⭐⭐⭐ <?php echo esc_html($atts['rating']); ?></div>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:24px; font-weight:bold; color:#2563eb;"><?php echo esc_html($atts['price']); ?></span>
                    <a href="<?php echo esc_url($affiliate_link); ?>" class="btn btn-primary" target="_blank" rel="nofollow sponsored" style="background:#f59e0b; color:#fff; padding:8px 16px; border-radius:6px; text-decoration:none; font-weight:bold;">Buy on Amazon</a>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

new Tabaix_Amazon_Pro();
