<?php

if ( ! function_exists( 'tobel_core_add_social_icons_group_widget' ) ) {
	/**
	 * function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function tobel_core_add_social_icons_group_widget( $widgets ) {
		$widgets[] = 'TobelCore_Social_Icons_Group_Widget';

		return $widgets;
	}

	add_filter( 'tobel_core_filter_register_widgets', 'tobel_core_add_social_icons_group_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TobelCore_Social_Icons_Group_Widget extends QodeFrameworkWidget {
		public $no_of_icons = 5;

		public function map_widget() {
			$this->set_base( 'tobel_core_social_icons_group' );
			$this->set_name( esc_html__( 'Tobel Social Group', 'tobel-core' ) );
			$this->set_description( sprintf( esc_html__( 'Use this widget to add a group of up to %s social icons to a widget area.', 'tobel-core' ), $this->no_of_icons ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'tobel-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'layout',
					'title'      => esc_html__( 'Layout', 'tobel-core' ),
					'options'    => array(
						'vertical'   => esc_html__( 'Vertical', 'tobel-core' ),
						'horizontal' => esc_html__( 'Horizontal', 'tobel-core' ),
					),
				)
			);

			for ( $i = 1; $i <= $this->no_of_icons; $i ++ ) {

				$this->set_widget_option(
					array(
						'field_type' => 'text',
						'name'       => 'icon_text_' . $i,
						'title'      => sprintf( esc_html__( 'Social Text %s', 'tobel-core' ), $i ),

					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_text_color_' . $i,
						'title'      => sprintf( esc_html__( 'Social %s Text Color', 'tobel-core' ), $i ),

					)
				);

				$this->set_widget_option(
					array(
						'field_type' => 'text',
						'name'       => 'icon_text_font_size_' . $i,
						'title'      => sprintf( esc_html__( 'Social %s Text Font Size', 'tobel-core' ), $i ),

					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'text',
						'name'       => 'link_' . $i,
						'title'      => sprintf( esc_html__( 'Link %s', 'tobel-core' ), $i ),
					)
				);

				$this->set_widget_option(
					array(
						'field_type'    => 'select',
						'name'          => 'target_' . $i,
						'title'         => sprintf( esc_html__( 'Link %s Target', 'tobel-core' ), $i ),
						'options'       => tobel_core_get_select_type_options_pool( 'link_target', false ),
						'default_value' => '_blank',
					)
				);

			}
		}


		public function render( $atts ) {
			$holder_classes = $this->get_holder_classes( $atts );
			?>
				<div class="qodef-social-icons-group">

					<?php

					for ( $i = 1; $i <= $this->no_of_icons; $i ++ ) {

						$styles = array();

						if ( ! empty( $atts[ 'icon_text_font_size_' . $i ] ) ) {
							if ( qode_framework_string_ends_with_space_units( $atts[ 'icon_text_font_size_' . $i ] ) ) {
								$styles[] = 'font-size: ' . $atts[ 'icon_text_font_size_' . $i ];
							} else {
								$styles[] = 'font-size: ' . intval( $atts[ 'icon_text_font_size_' . $i ] ) . 'px';
							}
						}

						if ( ! empty( $atts[ 'icon_text_color_' . $i ] ) ) {
							$styles[] = 'color: ' . $atts[ 'icon_text_color_' . $i ];
						}

						if ( ! empty( $atts[ 'icon_text_' . $i ] ) ) {
							?>
							<span <?php qode_framework_class_attribute( $holder_classes ); ?>>
								<?php if ( ! empty( $atts[ 'link_' . $i ] ) ) : ?>
									<a itemprop="url" href="<?php echo esc_url( $atts[ 'link_' . $i ] ); ?>" target="<?php echo esc_attr( $atts[ 'target_' . $i ] ); ?>" <?php qode_framework_inline_style( $styles ); ?>>
								<?php endif; ?>
								<?php echo esc_html( $atts[ 'icon_text_' . $i ] ); ?>
								<?php if ( ! empty( $atts[ 'link_' . $i ] ) ) : ?>
									</a>
								<?php endif; ?>
							</span>
							<?php
						}
					}
					?>
				</div>
			<?php
		}

		public function get_holder_classes( $atts ) {
			$classes = array();

			$classes[] = 'qodef-social-icons-item';
			$classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $classes );
		}


	}
}
