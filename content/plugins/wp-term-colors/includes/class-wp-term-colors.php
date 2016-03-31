<?php

/**
 * Term Colors Class
 *
 * @since 0.1.2
 *
 * @package Plugins/Terms/Metadata/Color
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_Term_Colors' ) ) :
/**
 * Main WP Term Colors class
 *
 * @since 0.1.0
 */
final class WP_Term_Colors extends WP_Term_Meta_UI {

	/**
	 * @var string Plugin version
	 */
	public $version = '0.2.0';

	/**
	 * @var string Database version
	 */
	public $db_version = 201601070001;

	/**
	 * @var string Metadata key
	 */
	public $meta_key = 'color';

	/**
	 * Hook into queries, admin screens, and more!
	 *
	 * @since 0.1.0
	 */
	public function __construct( $file = '' ) {

		// Setup the labels
		$this->labels = array(
			'singular'    => esc_html__( 'Color',  'wp-term-colors' ),
			'plural'      => esc_html__( 'Colors', 'wp-term-colors' ),
			'description' => esc_html__( 'Assign a custom color to visually separate each item.', 'wp-term-colors' )
		);

		// Call the parent and pass the file
		parent::__construct( $file );
	}

	/** Assets ****************************************************************/

	/**
	 * Enqueue quick-edit JS
	 *
	 * @since 0.1.0
	 */
	public function enqueue_scripts() {

		// Enqueue the color picker
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );

		// Enqueue fancy coloring; includes quick-edit
		wp_enqueue_script( 'term-color', $this->url . 'assets/js/term-color.js',  array( 'wp-color-picker', 'jquery' ), $this->db_version, true );
		wp_enqueue_style( 'term-color', $this->url . 'assets/css/term-color.css', array( 'wp-color-picker' ), $this->db_version );
	}

	/**
	 * Add help tabs for `color` column
	 *
	 * @since 0.1.2
	 */
	public function help_tabs() {
		get_current_screen()->add_help_tab(array(
			'id'      => 'wp_term_color_help_tab',
			'title'   => __( 'Term Color', 'wp-term-colors' ),
			'content' => '<p>' . __( 'Terms can have unique colors to help separate them from each other.', 'wp-term-colors' ) . '</p>',
		) );
	}

	/**
	 * Return the formatted output for the colomn row
	 *
	 * @since 0.1.2
	 *
	 * @param string $meta
	 */
	protected function format_output( $meta = '' ) {
		return '<i class="term-color" data-color="' . esc_attr( $meta ) . '" style="background-color: ' . esc_attr( $meta ) . '"></i>';
	}
}
endif;
