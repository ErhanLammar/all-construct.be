<?php

/*
Widget Name: Livemesh Clients
Description: Display list of your clients in a multi-column grid.
Author: LiveMesh
Author URI: http://portfoliotheme.org
*/

class LSOW_Client_Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'lsow-clients',
            __('Livemesh Clients', 'livemesh-so-widgets'),
            array(
                'description' => __('Display one or more clients in a multi-column grid.', 'livemesh-so-widgets'),
                'panels_icon' => 'dashicons dashicons-minus',
                'help' => 'http://portfoliotheme.org/widgets-bundle/odometer-widget-documentation/'
            ),
            array(),
            array(
                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'livemesh-so-widgets'),
                ),

                'clients' => array(
                    'type' => 'repeater',
                    'label' => __('Clients', 'livemesh-so-widgets'),
                    'item_name' => __('Client', 'livemesh-so-widgets'),
                    'item_label' => array(
                        'selector' => "[id*='clients-name']",
                        'update_event' => 'change',
                        'value_method' => 'val'
                    ),
                    'fields' => array(
                        'name' => array(
                            'type' => 'text',
                            'label' => __('Client Name', 'livemesh-so-widgets'),
                            'description' => __('The name of the client/customer.', 'livemesh-so-widgets'),
                        ),

                        'image' => array(
                            'type' => 'media',
                            'label' => __('Client Logo', 'livemesh-so-widgets'),
                            'library' => 'image',
                            'description' => __('The logo image for the client/customer.', 'livemesh-so-widgets'),
                        ),
                    )
                ),

                'settings' => array(
                    'type' => 'section',
                    'label' => __('Settings', 'livemesh-so-widgets'),
                    'fields' => array(

                        'per_line' => array(
                            'type' => 'slider',
                            'label' => __('Columns per row', 'livemesh-so-widgets'),
                            'min' => 1,
                            'max' => 6,
                            'integer' => true,
                            'default' => 4
                        ),
                    )
                ),

            )
        );
    }

    function initialize() {

        $this->register_frontend_scripts(
            array(
                array(
                    'lsow-waypoints',
                    LSOW_PLUGIN_URL . 'assets/js/jquery.waypoints' . SOW_BUNDLE_JS_SUFFIX . '.js',
                    array('jquery'),
                    LSOW_VERSION
                ),
            )
        );

        $this->register_frontend_styles(array(
            array(
                'lsow-clients',
                plugin_dir_url(__FILE__) . 'css/style.css'
            )
        ));
    }

    function get_template_variables($instance, $args) {
        return array(
            'clients' => !empty($instance['clients']) ? $instance['clients'] : array(),
            'settings' => $instance['settings']
        );
    }

}

siteorigin_widget_register('lsow-clients', __FILE__, 'LSOW_Client_Widget');