<?php

/*
Widget Name: Livemesh Heading
Description: Create heading for display on the top of a section.
Author: LiveMesh
Author URI: http://portfoliotheme.org
*/

class LSOW_Heading_Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'lsow-heading',
            __('Livemesh Heading', 'livemesh-so-widgets'),
            array(
                'description' => __('Create heading for display on the top of a section.', 'livemesh-so-widgets'),
                'panels_icon' => 'dashicons dashicons-minus',
                'help' => 'http://portfoliotheme.org/widgets-bundle/heading-widget-documentation/'
            ),
            array(),
            array(
                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'livemesh-so-widgets'),
                ),

                'style' => array(
                    'type' => 'select',
                    'label' => __('Choose Style', 'livemesh-so-widgets'),
                    'state_emitter' => array(
                        'callback' => 'select',
                        'args' => array('style')
                    ),
                    'default' => 'style1',
                    'options' => array(
                        'style1' => __('Style 1', 'livemesh-so-widgets'),
                        'style2' => __('Style 2', 'livemesh-so-widgets'),
                    )
                ),

                'heading' => array(
                    'type' => 'text',
                    'label' => __('Heading Title', 'livemesh-so-widgets'),
                    'description' => __('Title for the heading.', 'livemesh-so-widgets'),
                ),

                'subtitle' => array(
                    'type' => 'text',
                    'label' => __('Subheading', 'livemesh-so-widgets'),
                    'description' => __('A subtitle displayed above the title heading.', 'livemesh-so-widgets'),
                    'state_handler' => array(
                        'style[style2]' => array('show'),
                        'style[style1]' => array('hide'),
                    ),
                ),

                'short_text' => array(
                    'type' => 'textarea',
                    'label' => __('Short Text', 'livemesh-so-widgets'),
                    'description' => __('Short text generally displayed below the heading title.', 'livemesh-so-widgets'),
                ),

            )
        );
    }

    function initialize() {

        $this->register_frontend_styles(array(
            array(
                'lsow-heading',
                plugin_dir_url(__FILE__) . 'css/style.css'
            )
        ));
    }

    function get_template_variables($instance, $args) {
        return array(
            'style' => $instance['style'],
            'heading' => $instance['heading'],
            'short_text' => !empty($instance['short_text']) ? $instance['short_text'] : '',
            'subtitle' => !empty($instance['subtitle']) ? $instance['subtitle'] : ''
        );
    }

}

siteorigin_widget_register('lsow-heading', __FILE__, 'LSOW_Heading_Widget');