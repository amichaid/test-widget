<?php
/**
 * Plugin Name: Widget Test
 * Version: 1.0
 */

define('TEST_WIDGET_URL', plugin_dir_url(__FILE__));
define('TEST_WIDGET_VER', '1.0');

add_action('init', 'init_widget_test');
add_action('wp_enqueue_scripts', 'widget_test_enqueue_styles');

function init_widget_test()
{
    require 'class-test-widget.php';

    $test_widget = new Elementor_Test_Widget();

    // Let Elementor know about our widget
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type($test_widget);
}

function widget_test_enqueue_styles()
{
    wp_enqueue_style('test_widget_style', TEST_WIDGET_URL . '/assets/test-widget.css', array(), true);
}