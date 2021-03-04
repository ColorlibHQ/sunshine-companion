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
 * Sunshine elementor home appointment section widget.
 *
 * @since 1.0
 */
class Sunshine_Home_Appointment extends Widget_Base {

	public function get_name() {
		return 'sunshine-home-appointment-section';
	}

	public function get_title() {
		return __( 'Home Appointment', 'sunshine-companion' );
	}

	public function get_icon() {
		return 'eicon-play-o';
	}

	public function get_categories() {
		return [ 'sunshine-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Home Appointment Section content ------------------------------
        $this->start_controls_section(
            'home_appointment_content',
            [
                'label' => __( 'Home Appointment Section', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'left_img',
            [
                'label' => esc_html__( 'Left Image', 'sunshine-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'right_section_separator',
            [
                'label' => esc_html__( 'Right Section', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Make an Appointment', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => esc_html__( 'Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.', 'sunshine-companion' ),
            ]
        );
        
        $this->add_control(
            'form_shortcode',
            [
                'label' => esc_html__( 'Form Shortcode', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        
        $this->end_controls_section(); // End about us content

        //------------------------------ Style title ------------------------------
        
        // Home Contact Section Styles
        $this->start_controls_section(
            'home_contact_sec_style', [
                'label' => __( 'Home Contact Section Styles', 'sunshine-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'sub_title_col', [
				'label' => __( 'Sub title Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .messege_area .section_title .sub_heading' => 'color: {{VALUE}};',
				],
			]
        );
        $this->add_control(
			'sec_title_col', [
				'label' => __( 'Big Title Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .messege_area .section_title h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .messege_area .section_title .seperator' => 'background: {{VALUE}};',
				],
			]
        );

        $this->add_control(
            'btn_styles_seperator',
            [
                'label' => esc_html__( 'Button Styles', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
			'btn_border_txt_col', [
				'label' => __( 'Button Border & Text Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .messege_area .messege .boxed-btn' => 'color: {{VALUE}} !important; border-color: {{VALUE}};',
				],
			]
        );
        $this->add_control(
			'btn_hvr_border_bg_col', [
				'label' => __( 'Button Hover Border & Bg Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .messege_area .messege .boxed-btn:hover' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
        );
        $this->add_control(
			'btn_hvr_txt_col', [
				'label' => __( 'Button Hover Text Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .messege_area .messege .boxed-btn:hover' => 'color: {{VALUE}} !important;;',
				],
			]
        );
        $this->end_controls_section();

	}
    
	protected function render() {
    $settings       = $this->get_settings();
    $left_img       = !empty( $settings['left_img']['id'] ) ? wp_get_attachment_image( $settings['left_img']['id'], 'sunshine_appointment_left_thumb_459x786', '', array('alt' => 'home appointment left image' ) ) : '';
    $sec_title      = !empty( $settings['sec_title'] ) ?  $settings['sec_title'] : '';
    $sub_title      = !empty( $settings['sub_title'] ) ?  $settings['sub_title'] : '';
    $form_shortcode = !empty( $settings['form_shortcode'] ) ?  $settings['form_shortcode'] : '';
    ?>
    
    <div class="appointment_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-md-6 col-lg-6">
                    <div class="appiontment_thumb d-none d-lg-block">
                        <?php
                            if ( $left_img ) { 
                                echo $left_img;
                            }
                        ?>
                    </div>
                </div>
                <div class="col-xl-6 offset-xl-1 col-md-6 col-md-12 col-lg-6">
                    <div class="appointment_info">
                        <div class="opacity_icon d-none d-lg-block">
                            <i class="flaticon-balance"></i>
                        </div>
                        <?php
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                            if ( $sub_title ) { 
                                echo '<p>'.wp_kses_post( $sub_title ).'</p>';
                            }
                            echo ($form_shortcode ? do_shortcode( $form_shortcode ) : '');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    }
}
