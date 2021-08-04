<?php

namespace TeamGrid;
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// if class already defined, bail out
if ( class_exists( 'TeamGrid\Shortcode' ) ) {
	return;
}


/**
 * This class will create meta boxes for Shortcode
 *
 * @package    TeamGrid
 * @subpackage TeamGrid/includes
 * @author     Rao <raoabid491@gmail.com>
 */
class Shortcode {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * The counter of shortcode usage on the plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $counter;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->counter     = 1;

		$this->register_shortcode_hooks();
	}

	/**
	 * Register Shortcode Hooks
	 */
	public function register_shortcode_hooks() {

		add_shortcode( 'team_grid', [ $this, 'team_grid' ] );

	}


	/**
	 * Team Grid Shortcode
	 * @shortcode team_grid
	 */
	public function team_grid( $atts = [], $content = null, $tag = '' ) {

		// normalize attribute keys, lowercase
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		$atts = shortcode_atts( array(
			// Update the default Values
			'class' => '',
			'id'    => 'team-grid-instance-' . absint( $this->counter )
		), $atts );

		// Do Some Sanitization of $atts
		$atts['class'] = $this->sanitize_shortcode_attr_class( $atts['class'] );
		$atts['id']    = sanitize_html_class( $atts['id'] );

		wp_enqueue_script( $this->plugin_name );
		wp_enqueue_style( $this->plugin_name );

		return $this->get_html_output_team_grid( $atts, $content, $tag );

	}

	/**
	 *
	 */
	public function sanitize_shortcode_attr_class( $classes ) {

		$classes = array_map( function ( $class ) {
			return sanitize_html_class( $class );
		}, explode( ' ', $classes ) );

		return implode( ' ', $classes );

	}

	/**
	 *
	 */
	public function get_html_output_team_grid( $atts, $content, $tag ) {


		$members_args = [
			'post_type'      => 'team_grid_member',
			'status'         => 'publish',
			'posts_per_page' => - 1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC'
		];

//		add_filter( 'posts_orderby', array( $this, 'filter_query_post_menu_order_asc' ) );
		$members = new \WP_Query( $members_args );
//		remove_filter( 'posts_orderby', array( $this, 'filter_query_post_menu_order_asc' ) );
		ob_start();


		if ( $members->have_posts() ) {
			team_grid()->template->get_template_part( 'team-grid-start' );
			while ( $members->have_posts() ) {
				$members->the_post();
				team_grid()->template->get_template_part( 'team-grid-member-part' );
			}
			team_grid()->template->get_template_part( 'team-grid-end' );
		} else {
			echo 'No Team Members Found';
		}

		wp_reset_postdata();

		// Increase the counter for next shortcode instance
		$this->counter ++;

		// return output
		return ob_get_clean();

	}

	/**
	 *
	 */
	public function filter_query_post_menu_order_asc( $query ) {
		$query .= ', wp_posts.menu_order DESC';

		return $query;
	}

}