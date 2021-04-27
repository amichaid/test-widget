<?php

/**
 * Class Elementor_Test_Widget
 */
class Elementor_Test_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'test_widget';
    }

    public function get_title()
    {
        return __('Test Widget', 'test_widget');
    }

    public function get_icon()
    {
        return 'eicon-custom-css';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'test_widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Card Title', 'test_widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => __('Title', 'test_widget'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Card Description', 'test_widget'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => __('Description', 'test_widget'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Card Image', 'test_widget'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        if (!isset($settings) || !is_array($settings) || empty($settings)) {
            return;
        }

        // Get settings.
        $img_settings = $settings['image'];
        $title = $settings['title'];
        $description = $settings['description'];

        // Start card.
        echo '<div class="test-widget">';

        // Card image.
        if (isset($img_settings) && is_array($img_settings) && !empty($img_settings)) {

            $img_id = $img_settings['id'];

            if (isset($img_id) && is_int($img_id) && 0 < $img_id) {

                $img_array = wp_get_attachment_image_src($img_id, 'thumbnail', false);
                $img_url = $img_array[0];

                if (isset($img_url) && !empty($img_url)) {

                    echo '<div class="test-widget-img-container">';
                    echo '<img src="' . esc_url($img_url) . '"/>';
                    echo '</div>';

                }
            }
        }

        // Card content.
        echo '<div class="test-widget-content">';

        // Card title.
        if (isset($title) && is_string($title) && !empty($title)) {
            echo '<div class="test-widget-title">' . esc_html($title) . '</div>';
        }

        // Card description.
        if (isset($description) && is_string($description) && !empty($description)) {
            echo '<div class="test-widget-description">' . esc_html($description) . '</div>';
        }

        echo '</div>'; // Card content end.
        echo '</div>'; // Card end.
    }
}