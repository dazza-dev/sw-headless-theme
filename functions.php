<?php

/**
 * SW Headless Theme Functions
 *
 * Minimal headless WordPress theme.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register menu locations
 */
function sw_headless_register_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary', 'sw-headless'),
        'footer'  => __('Footer', 'sw-headless'),
    ));
}
add_action('after_setup_theme', 'sw_headless_register_menus');

/**
 * Theme setup
 */
function sw_headless_theme_setup()
{
    // Enable menus
    add_theme_support('menus');

    // Enable featured images
    add_theme_support('post-thumbnails');

    // Enable title tag
    add_theme_support('title-tag');

    // Enable custom logo (useful for API)
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'sw_headless_theme_setup');

/**
 * Disable theme/plugin editor (security)
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/**
 * Expose custom logo to WPGraphQL
 */
function sw_headless_register_graphql_fields()
{
    // Check if WPGraphQL is active
    if (!function_exists('register_graphql_field')) {
        return;
    }

    // Register siteLogoUrl field that returns just the URL
    register_graphql_field('RootQuery', 'siteLogoUrl', [
        'type' => 'String',
        'description' => __('The URL of the site logo', 'sw-headless'),
        'resolve' => function () {
            $custom_logo_id = get_theme_mod('custom_logo');
            if ($custom_logo_id) {
                $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                return $logo_url ?: null;
            }
            return null;
        }
    ]);

    // Register siteLogo field that returns MediaItem object
    register_graphql_field('RootQuery', 'siteLogo', [
        'type' => 'MediaItem',
        'description' => __('The site logo as MediaItem', 'sw-headless'),
        'resolve' => function () {
            $custom_logo_id = get_theme_mod('custom_logo');
            if ($custom_logo_id) {
                return get_post($custom_logo_id);
            }
            return null;
        }
    ]);
}
add_action('graphql_register_types', 'sw_headless_register_graphql_fields');

/**
 * Clean up WordPress for headless usage
 */
function sw_headless_cleanup()
{
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Remove unnecessary meta tags
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'sw_headless_cleanup');
