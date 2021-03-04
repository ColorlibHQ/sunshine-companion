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
 * Sunshine elementor love story section widget.
 *
 * @since 1.0
 */
class Sunshine_Love_Story extends Widget_Base {

	public function get_name() {
		return 'sunshine-love-story';
	}

	public function get_title() {
		return __( 'Love Story', 'sunshine-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'sunshine-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Love Story content ------------------------------
        $this->start_controls_section(
            'love_story_content',
            [
                'label' => __( 'Love Story Settings', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Our. Love. Story', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'for_whom_left_settings_separator',
            [
                'label' => esc_html__( 'For Whom Left Content', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'left_img',
            [
                'label' => esc_html__( 'Left Image', 'sunshine-companion' ),
                'description' => esc_html__( 'Best size is 247x247', 'sunshine-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'for_whom_left',
            [
                'label' => esc_html__( 'For Whom', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Groom', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'name_left',
            [
                'label' => esc_html__( 'Name', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Jack Wonner', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'left_text',
            [
                'label' => esc_html__( 'Text', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => esc_html__( 'Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here content here, making it look like readable English. Many desktop publishing packages and web page editors now use.', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'left_socials_separator',
            [
                'label' => esc_html__( 'Social Profiles', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'fb_url',
            [
                'label' => esc_html__( 'Facebook URL', 'sunshine-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );
        $this->add_control(
            'tw_url',
            [
                'label' => esc_html__( 'Twitter URL', 'sunshine-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );
        $this->add_control(
            'ins_url',
            [
                'label' => esc_html__( 'Instagram URL', 'sunshine-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );

        // Time schedule content
        $this->add_control(
            'time_schedule_settings_separator',
            [
                'label' => esc_html__( 'Time schedule Content', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
		$this->add_control(
            'time_schedule_contents', [
                'label' => __( 'Create New', 'sunshine-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'sunshine-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Fast Meet', 'sunshine-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Text', 'sunshine-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.', 'sunshine-companion' ),
                    ],
                ],
                'default' => [
                    [
                        'title' => __( 'Fast Meet', 'sunshine-companion' ),
                        'text' => __( 'Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.', 'sunshine-companion' ),
                    ],
                    [
                        'title' => __( 'He Proposed', 'sunshine-companion' ),
                        'text' => __( 'Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.', 'sunshine-companion' ),
                    ],
                    [
                        'title' => __( 'Love Story', 'sunshine-companion' ),
                        'text' => __( 'Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.', 'sunshine-companion' ),
                    ],
                    [
                        'title' => __( 'Wedding Day', 'sunshine-companion' ),
                    ],
                ]
            ]
        );

        // Right content
        $this->add_control(
            'for_whom_right_settings_separator',
            [
                'label' => esc_html__( 'For Whom Right Content', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'right_img',
            [
                'label' => esc_html__( 'Right Image', 'sunshine-companion' ),
                'description' => esc_html__( 'Best size is 247x247', 'sunshine-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'for_whom_right',
            [
                'label' => esc_html__( 'For Whom', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Bride', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'name_right',
            [
                'label' => esc_html__( 'Name', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Anjelina Kona', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'right_text',
            [
                'label' => esc_html__( 'Text', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => esc_html__( 'Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here content here, making it look like readable English. Many desktop publishing packages and web page editors now use.', 'sunshine-companion' ),
            ]
        );
        $this->add_control(
            'right_socials_separator',
            [
                'label' => esc_html__( 'Social Profiles', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'right_fb_url',
            [
                'label' => esc_html__( 'Facebook URL', 'sunshine-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );
        $this->add_control(
            'right_tw_url',
            [
                'label' => esc_html__( 'Twitter URL', 'sunshine-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );
        $this->add_control(
            'right_ins_url',
            [
                'label' => esc_html__( 'Instagram URL', 'sunshine-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
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
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_title_col', [
                'label' => __( 'Sec Title Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_text_col', [
                'label' => __( 'Sec Text Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'list_circle_col', [
                'label' => __( 'List Item Icon Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info ul li::before' => 'color: {{VALUE}};',
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
            'btn_txt_col', [
                'label' => __( 'Button Text & Border Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info .boxed-btn3-white-2' => 'color: {{VALUE}} !important; border-color: {{VALUE}}',
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info .boxed-btn3-white-2:hover' => 'background: {{VALUE}} !important; border-color: transparent',
                ],
            ]
        );
        $this->add_control(
            'btn_hvr_col', [
                'label' => __( 'Button Hover Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_sunshine_area .welcome_sunshine_info .boxed-btn3-white-2:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_section();

    }


	protected function render() {
    $settings       = $this->get_settings();      
    $section_img    = SUNSHINE_DIR_IMGS_URI . 'flowers.png';
    $sec_title      = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';

    // Left contents
    $left_img       = !empty( $settings['left_img']['id'] ) ? wp_get_attachment_image( $settings['left_img']['id'], 'sunshine_love_story_thumb_247x247', '', array( 'alt' => 'left image' ) ) : '';
    $for_whom_left  = !empty( $settings['for_whom_left'] ) ? $settings['for_whom_left'] : '';
    $name_left      = !empty( $settings['name_left'] ) ? $settings['name_left'] : '';
    $left_text      = !empty( $settings['left_text'] ) ? $settings['left_text'] : '';
    $fb_url         = !empty( $settings['fb_url']['url'] ) ? $settings['fb_url']['url'] : '';
    $tw_url         = !empty( $settings['tw_url']['url'] ) ? $settings['tw_url']['url'] : '';
    $ins_url        = !empty( $settings['ins_url']['url'] ) ? $settings['ins_url']['url'] : '';

    // Time schedules
    $time_schedule_contents = !empty( $settings['time_schedule_contents'] ) ? $settings['time_schedule_contents'] : '';
    
    // Right contents
    $right_img       = !empty( $settings['right_img']['id'] ) ? wp_get_attachment_image( $settings['right_img']['id'], 'sunshine_love_story_thumb_247x247', '', array( 'alt' => 'right image' ) ) : '';
    $for_whom_right  = !empty( $settings['for_whom_right'] ) ? $settings['for_whom_right'] : '';
    $name_right      = !empty( $settings['name_right'] ) ? $settings['name_right'] : '';
    $right_text      = !empty( $settings['right_text'] ) ? $settings['right_text'] : '';
    $right_fb_url    = !empty( $settings['right_fb_url']['url'] ) ? $settings['right_fb_url']['url'] : '';
    $right_tw_url    = !empty( $settings['right_tw_url']['url'] ) ? $settings['right_tw_url']['url'] : '';
    $right_ins_url  = !empty( $settings['right_ins_url']['url'] ) ? $settings['right_ins_url']['url'] : '';
    ?>
    
    <!-- our_love-story -->
    <div class="love_story_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center">
                        <img src="<?=esc_url($section_img)?>" alt="flowers-img">
                        <?php 
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_lover_story text-center">
                        <?php 
                            if ( $left_img ) { 
                                echo '<div class="story_thumb">';
                                    echo $left_img;
                                echo '</div>';
                            }
                            if ( $for_whom_left ) { 
                                echo '<span>'.esc_html( $for_whom_left ).'</span>';
                            }
                            if ( $name_left ) { 
                                echo '<h3>'.esc_html( $name_left ).'</h3>';
                            }
                            if ( $left_text ) { 
                                echo '<p>'.wp_kses_post(nl2br( $left_text ) ).'</p>';
                            }
                        ?>
                        <div class="social_links">
                            <ul>
                                <?php 
                                if ( $fb_url ) { 
                                    echo '<li><a href="'.esc_url($fb_url).'"> <i class="fa fa-facebook"></i> </a></li>';
                                }
                                if ( $tw_url ) { 
                                    echo '<li><a href="'.esc_url($tw_url).'"> <i class="fa fa-twitter"></i> </a></li>';
                                }
                                if ( $ins_url ) { 
                                    echo '<li><a href="'.esc_url($ins_url).'"> <i class="fa fa-instagram"></i> </a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="weding_time_line text-center">
                        <?php 
                        if( is_array( $time_schedule_contents ) && count( $time_schedule_contents ) > 0 ) {
                            foreach( $time_schedule_contents as $item ) {
                                $title = ( !empty( $item['title'] ) ) ? $item['title'] : '';
                                $text = ( !empty( $item['text'] ) ) ? $item['text'] : '';
                                ?>
                                <div class="single_time_line">
                                    <?php 
                                        if ( $title ) { 
                                            echo '<h3>'.esc_html( $title ).'</h3>';
                                        }
                                        if ( $text ) { 
                                            echo '<p>'.wp_kses_post(nl2br( $text ) ).'</p>';
                                        }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="single_lover_story text-center">
                        <?php 
                            if ( $right_img ) { 
                                echo '<div class="story_thumb">';
                                    echo $right_img;
                                echo '</div>';
                            }
                            if ( $for_whom_right ) { 
                                echo '<span>'.esc_html( $for_whom_right ).'</span>';
                            }
                            if ( $name_right ) { 
                                echo '<h3>'.esc_html( $name_right ).'</h3>';
                            }
                            if ( $right_text ) { 
                                echo '<p>'.wp_kses_post(nl2br( $right_text ) ).'</p>';
                            }
                        ?>
                        <div class="social_links">
                            <ul>
                                <?php 
                                    if ( $right_fb_url ) { 
                                        echo '<li><a href="'.esc_url($right_fb_url).'"> <i class="fa fa-facebook"></i> </a></li>';
                                    }
                                    if ( $right_tw_url ) { 
                                        echo '<li><a href="'.esc_url($right_tw_url).'"> <i class="fa fa-twitter"></i> </a></li>';
                                    }
                                    if ( $right_ins_url ) { 
                                        echo '<li><a href="'.esc_url($right_ins_url).'"> <i class="fa fa-instagram"></i> </a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ our_love-story -->
    <?php
    }
}