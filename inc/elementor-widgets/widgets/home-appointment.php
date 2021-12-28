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
		return 'eicon-button';
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
            'top_img',
            [
                'label' => esc_html__( 'Top Image', 'sunshine-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'bottom_img',
            [
                'label' => esc_html__( 'Bottom Image', 'sunshine-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'form_section_separator',
            [
                'label' => esc_html__( 'Form Contents Section', 'sunshine-companion' ),
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
                'default'   => esc_html__( 'Are You Attending?', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => esc_html__( 'Kindly respond before 30 August', 'sunshine-companion' ),
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
			'heighlighted_col', [
				'label' => __( 'Heighlighted Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .attending_area .main_attending_area .popup_box h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .attending_area .main_attending_area .popup_box .boxed_btn3' => 'background: {{VALUE}};',
					'{{WRAPPER}} .attending_area .main_attending_area .popup_box .boxed_btn3:hover' => 'color: {{VALUE}}; background: transparent',
				],
			]
        );
        $this->end_controls_section();

	}
    
	protected function render() {
    $settings       = $this->get_settings();
    $top_img       = !empty( $settings['top_img']['id'] ) ? wp_get_attachment_image( $settings['top_img']['id'], 'sunshine_wedding_counter_left_img_471x280', '', array('alt' => 'home appointment top image' ) ) : '';
    $bottom_img       = !empty( $settings['bottom_img']['id'] ) ? wp_get_attachment_image( $settings['bottom_img']['id'], 'sunshine_attending_bottom_thumb_350x346', '', array('alt' => 'home appointment bottom image' ) ) : '';
    $sec_title      = !empty( $settings['sec_title'] ) ?  $settings['sec_title'] : '';
    $sub_title      = !empty( $settings['sub_title'] ) ?  $settings['sub_title'] : '';
    $form_shortcode = !empty( $settings['form_shortcode'] ) ?  $settings['form_shortcode'] : '';
    $inner_page_class = is_front_page() ? 'attending_area' : 'attending_area plus_padding';
    ?>
    
    <!-- attend_area -->
    <div class="<?=esc_attr( $inner_page_class )?>">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
                    <div class="main_attending_area">
                        <?php
                            if ( $top_img ) { 
                                echo '<div class="flower_1 d-none d-lg-block">';
                                   echo $top_img;
                                echo '</div>';
                            }
                            if ( $bottom_img ) { 
                                echo '<div class="flower_2 d-none d-lg-block">';
                                   echo $bottom_img;
                                echo '</div>';
                            }
                        ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-7 col-lg-8">
                                <div class="popup_box ">
                                    <div class="popup_inner">
                                        <div class="form_heading text-center">
                                            <?php
                                                if ( $sec_title ) { 
                                                    echo '<h3>'.esc_html( $sec_title ).'</h3>';
                                                }
                                                if ( $sub_title ) { 
                                                    echo '<p>'.wp_kses_post( $sub_title ).'</p>';
                                                }
                                            ?>
                                        </div>
                                        <?php
                                            echo ($form_shortcode ? do_shortcode( $form_shortcode ) : '');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / attend_area -->
    <?php

    }
}
