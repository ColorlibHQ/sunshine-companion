<?php
namespace Sunshineelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Sunshine elementor hero section widget.
 *
 * @since 1.0
 */
class Sunshine_Hero extends Widget_Base {

	public function get_name() {
		return 'sunshine-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'sunshine-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'sunshine-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero slider content', 'sunshine-companion' ),
			]
        );
        $this->add_control(
            'bg_img',
            [
                'label' => esc_html__( 'Bg Image', 'sunshine-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( '14 Jan 2022', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'big_title',
            [
                'label' => esc_html__( 'Big Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => 'Anjelina & Jack <br>Wedding Ceremony',
            ]
        );
        $this->add_control(
            'summery_title',
            [
                'label' => esc_html__( 'Summary Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Get Married', 'sunshine-companion' ),
            ]
        );
        
        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'sunshine-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'border_berore_col', [
				'label' => __( 'Border 1 Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area_inner .slider_text:before' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_after_col', [
				'label' => __( 'Border 2 Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area_inner .slider_text:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'circle_bg_col', [
				'label' => __( 'Circle Bg Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area_inner .slider_text' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'sunshine-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area_inner .slider_text h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slider_area_inner .slider_text h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slider_area_inner .slider_text span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}
    
	protected function render() {
    $settings      = $this->get_settings();
    $bg_img        = !empty( $settings['bg_img']['url'] ) ? $settings['bg_img']['url'] : ''; 
    $sub_title     = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : ''; 
    $big_title     = !empty( $settings['big_title'] ) ? $settings['big_title'] : ''; 
    $summery_title = !empty( $settings['summery_title'] ) ? $settings['summery_title'] : ''; 
    $ornaments_img = SUNSHINE_DIR_IMGS_URI . 'ornaments.png';
    ?>
    
    <!-- slider_area -->
    <div class="slider_area ">
        <div class="slider_area_inner overlay2" <?php echo sunshine_inline_bg_img( esc_url( $bg_img ) ); ?>>
            <div class="slider_text text-center">
                <div class="text_inner">
                    <img src="<?=esc_url($ornaments_img)?>" alt="ornaments-img">
                    <?php 
                        if ( $sub_title ) { 
                            echo '<h4>'.esc_html( $sub_title ).'</h4>';
                        }
                        if ( $big_title ) { 
                            echo '<h3>'.wp_kses_post(nl2br($big_title)).'</h3>';
                        }
                        if ( $summery_title ) { 
                            echo '<span>'.esc_html( $summery_title ).'</span>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--/ slider_area -->
    <?php

    } 
}