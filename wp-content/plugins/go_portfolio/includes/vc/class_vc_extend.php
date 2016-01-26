<?php
/**
 * Common functions
 *
 * @package   Go – Responsive Portfolio for WP
 * @author    Granth <granthweb@gmail.com>
 * @link      http://granthweb.com
 * @copyright 2015 Granth
 */

/**
 * Visual Composer Extend class
 */


/* Prevent direct call */
if ( ! defined( 'WPINC' ) ) { die; }

class GW_GoPortfolio_VCExtend {

	protected static $instance = null;

	public function __construct() {
         add_action( 'init', array( $this, 'integrateWithVC' ) );
    }
 
	/**
	 * Return an instance of this class
	 */
	 
	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self;
		}
		
		return self::$instance;
	}
 
	/**
	 * Add to Visual Composer
	 */ 
 
    public function integrateWithVC() {

		/* Get portfolio data */
		$portfolios = get_option( GW_Go_Portfolio::plugin_prefix() . '_portfolios' );		

		if ( !empty( $portfolios ) ) {
			foreach ( $portfolios as $portfolio ) {
				$dropdown_data[$portfolio['name']] = $portfolio['id'];
			}
		} else {
			$dropdown_data[0] = __('No portfolio(s) found!', 'go_portfolio_textdomain' );
		}
		
		if ( function_exists( 'vc_map' ) ) {
		
			vc_map( array (
				'name' => __('Go Portfolio', 'go_portfolio_textdomain' ),
				'description' => __( 'Responsive portfolios & galleries', 'go_portfolio_textdomain' ),
				'base' => 'go_portfolio',
				'category' => __( 'Content', 'go_portfolio_textdomain' ),	
				'class' => '',
				'controls' => 'full',
				'icon' => plugin_dir_url( __FILE__ ) . 'assets/go_portfolio_32x32.png',
				'params' => array(
					array(
						"type" => "dropdown",
						'heading' => __( 'Portfolio name', 'go_portfolio_textdomain' ),
						'param_name' => 'id',
						'value' => $dropdown_data,
						'description' => __('Select portfolio', 'go_portfolio_textdomain' ),
						'admin_label' => true
					)
				)
			) );

		}
				
    }

}

/* Init */
GW_GoPortfolio_VCExtend::get_instance();
