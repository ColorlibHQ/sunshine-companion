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
 * Sunshine elementor Wedding Countdown section widget.
 *
 * @since 1.0
 */
class Sunshine_Wedding_Countdown extends Widget_Base {

	public function get_name() {
		return 'sunshine-wedding-countdown';
	}

	public function get_title() {
		return __( 'Wedding Countdown', 'sunshine-companion' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return [ 'sunshine-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Wedding Countdown content ------------------------------
        $this->start_controls_section(
            'wedding_countdown_content',
            [
                'label' => __( 'Wedding Countdown Settings', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'right_img',
            [
                'label' => esc_html__( 'Right Image', 'sunshine-companion' ),
                'description' => esc_html__( 'Best size is 188x216', 'sunshine-companion' ),
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
                'label' => esc_html__( 'Bottom Left Image', 'sunshine-companion' ),
                'description' => esc_html__( 'Best size is 471x280', 'sunshine-companion' ),
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
                'default'   => esc_html__( '14. January. 2022', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'big_title',
            [
                'label' => esc_html__( 'Big Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'THE. WEDDING. Countdown', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'event_time',
            [
                'label' => esc_html__( 'Select Time', 'sunshine-companion' ),
                'type' => Controls_Manager::DATE_TIME,
                'label_block' => true,
                // 'default'   => esc_html__( 'THE. WEDDING. Countdown', 'sunshine-companion' ),
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
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .weeding_countdown_area .section_title span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_title_col', [
                'label' => __( 'Sec Title Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .weeding_countdown_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_val_col', [
                'label' => __( 'Counter Value Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .weeding_countdown_area .countdown_area .countdown_wrap h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_title_col', [
                'label' => __( 'Counter Title Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .weeding_countdown_area .countdown_area .countdown_wrap span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }


	protected function render() {

    // call load widget script
    $this->load_widget_script(); 

    $settings           = $this->get_settings();      
    $right_img         = !empty( $settings['right_img']['id'] ) ? wp_get_attachment_image( $settings['right_img']['id'], 'sunshine_wedding_counter_right_img_188x216', '', array( 'alt' => 'right image' ) ) : '';
    $bottom_img         = !empty( $settings['bottom_img']['id'] ) ? wp_get_attachment_image( $settings['bottom_img']['id'], 'sunshine_wedding_counter_left_img_471x280', '', array( 'alt' => 'left image' ) ) : '';
    $sub_title          = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $big_title          = !empty( $settings['big_title'] ) ? $settings['big_title'] : '';
    $event_time         = !empty( $settings['event_time'] ) ? $settings['event_time'] : '';
    $section_img        = SUNSHINE_DIR_IMGS_URI . 'flowers.png';
    ?>
    
    <!-- wedding_countdown -->
    <div class="weeding_countdown_area">
        <div class="flowaers_top d-none d-lg-block">
            <?php 
                if ( $right_img ) { 
                    echo $right_img;
                }
            ?>
        </div>
        <div class="flowaers_bottom d-none d-lg-block">
            <?php 
                if ( $bottom_img ) { 
                    echo $bottom_img;
                }
            ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center">
                        <img src="<?=esc_url($section_img)?>" alt="flowers-img">
                        <?php 
                            if ( $sub_title ) { 
                                echo '<span>'.esc_html($sub_title ).'</span>';
                            }
                            if ( $big_title ) { 
                                echo '<h3>'.esc_html($big_title ).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div id="clock" class="countdown_area counter_bg" data-event-time="<?=esc_attr($event_time)?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ wedding_countdown -->
    <?php
    }
    
    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // testmonial_active
            if ( $('#clock').length > 0 ) {
				var clock = $('#clock');
				var eventTime = clock.data('event-time');
				clock.countdown(eventTime, function (event) {
					$(this).html(event.strftime(
						'<div class="countdown_wrap d-flex"><div  class="single_countdown"><h3>%D</h3><span>Days</span></div><div class="single_countdown"><h3>%H</h3><span>Hours</span></div><div class="single_countdown"><h3>%M</h3><span>Minutes</span></div><div class="single_countdown"><h3>%S</h3><span>Seconds</span></div></div>'
					));
				});
			}
        })(jQuery);
        </script>
        <?php 
        }
    }	
}