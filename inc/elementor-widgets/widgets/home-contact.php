<?php
namespace Sunshineelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Sunshine elementor home contact section widget.
 *
 * @since 1.0
 */
class Sunshine_Home_Contact extends Widget_Base {

	public function get_name() {
		return 'sunshine-home-contact';
	}

	public function get_title() {
		return __( 'Home Contact', 'sunshine-companion' );
	}

	public function get_icon() {
		return 'eicon-click';
	}

	public function get_categories() {
		return [ 'sunshine-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Home Contact content ------------------------------
        $this->start_controls_section(
            'home_contact_content',
            [
                'label' => __( 'Home Contact Settings', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Location', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => 'Mas Montagnette, 19 West 21th Str.  <br><span>+1 843-853-1810</span>',
            ]
        );
        $this->add_control(
            'office_locations_settings_separator',
            [
                'label' => esc_html__( 'Office Locations', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_control(
            'office_locations', [
                'label' => __( 'Create New', 'sunshine-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'sunshine-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Where to stay', 'sunshine-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Text', 'sunshine-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => '4:00p – 12:00p <br>The Secret Shrine Club',
                    ],
                ],
                'default' => [
                    [
                        'title' => __( 'Where to stay', 'sunshine-companion' ),
                        'text' => '4:00p – 12:00p <br>The Secret Shrine Club',
                    ],
                    [
                        'title' => __( 'Activities', 'sunshine-companion' ),
                        'text' => '4:00p – 12:00p <br>The Secret Shrine Club',
                    ],
                ]
            ]
        );
        
        $this->end_controls_section(); // End left content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'about_sec_style', [
                'label' => __( 'About Section Styles', 'sunshine-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'heighlighted_col', [
				'label' => __( 'Heighlighted Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location_area .location_info .location_inner h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .location_area .location_info .location_inner p span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .location_area .location_info .location_inner .address_info .single_address h4' => 'color: {{VALUE}};',
				],
			]
        );

        $this->end_controls_section();

    }


	protected function render() {
    $settings         = $this->get_settings();      
    $sec_title        = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title        = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $office_locations = !empty( $settings['office_locations'] ) ? $settings['office_locations'] : '';
    ?>

    <section class="location_area">
        <div class="location_info">
            <div class="location_inner">
                <div class="location_top text-center">
                    <?php 
                        if ( $sec_title ) { 
                            echo '<h3>'.esc_html( $sec_title ).'</h3>';
                        }
                        if ( $sub_title ) { 
                            echo '<p>'.wp_kses_post( nl2br( $sub_title ) ).'</p>';
                        }
                    ?>
                </div>
                <div class="address_info d-flex justify-content-between">
                    <?php 
                        if( is_array( $office_locations ) && count( $office_locations ) > 0 ) {
                            foreach( $office_locations as $item ) {
                                $title = ( !empty( $item['title'] ) ) ? $item['title'] : '';
                                $text = ( !empty( $item['text'] ) ) ? $item['text'] : '';
                                ?>
                                <div class="single_address text-center">
                                    <?php 
                                        if ( $title ) { 
                                            echo '<h4>'.esc_html( $title ).'</h4>';
                                        }
                                        if ( $text ) { 
                                            echo '<p>'.wp_kses_post( nl2br( $text ) ).'</p>';
                                        }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                    ?> 
                </div>
            </div>
        </div>
    </section>
    <?php
    }
}