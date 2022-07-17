<?php

if ( ! function_exists( 'tobel_core_add_sticky_sidebar_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function tobel_core_add_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'TobelCore_Sticky_Sidebar_Widget';

		return $widgets;
	}

	add_filter( 'tobel_core_filter_register_widgets', 'tobel_core_add_sticky_sidebar_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TobelCore_Sticky_Sidebar_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'tobel_core_sticky_sidebar' );
			$this->set_name( esc_html__( 'Tobel Sticky Sidebar', 'tobel-core' ) );
			$this->set_description( esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar', 'tobel-core' ) );
		}

		public function load_assets() {
			wp_enqueue_script( 'gsap' );
		}

		public function render( $atts ) {
		}
	}
}
