<?php
namespace Sunshineelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Sunshine elementor gallery section widget.
 *
 * @since 1.0
 */
class Sunshine_Gallery extends Widget_Base {

	public function get_name() {
		return 'sunshine-gallery';
	}

	public function get_title() {
		return __( 'Gallery', 'sunshine-companion' );
	}

	public function get_icon() {
		return 'eicon-gallery-justified';
	}

	public function get_categories() {
		return [ 'sunshine-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Gallery content ------------------------------
		$this->start_controls_section(
			'gallery_content',
			[
				'label' => __( 'Gallery content', 'sunshine-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'sunshine-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Gallery.  Photos', 'sunshine-companion' ),
            ]
        );

        $this->add_control(
            'gallery_settings_seperator',
            [
                'label' => esc_html__( 'Galleries', 'sunshine-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

		$this->add_control(
            'galleries', [
                'label' => __( 'Create New', 'sunshine-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ img_size }}}',
                'fields' => [
                    [
                        'name' => 'item_img',
                        'label' => __( 'Item Image', 'sunshine-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default'     => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'img_size',
                        'label' => __( 'Select Image Size', 'sunshine-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::SELECT,
                        'default' => 'sunshine_gallery_thumb_482x410',
                        'options' => [
                            'sunshine_gallery_thumb_601x410' => '601x410',
                            'sunshine_gallery_thumb_482x410' => '482x410',
                            'sunshine_gallery_thumb_721x410' => '721x410',
                        ]
                    ],
                ],
                'default'   => [
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_601x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_482x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_721x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_482x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_721x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_601x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_601x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_482x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [      
                        'img_size'    => 'sunshine_gallery_thumb_721x410',
                        'item_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
		);
		$this->end_controls_section(); // End service content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_room_section', [
                'label' => __( 'Style Service Section', 'sunshine-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'sunshine-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $galleries = !empty( $settings['galleries'] ) ? $settings['galleries'] : '';
    $section_img    = SUNSHINE_DIR_IMGS_URI . 'flowers.png';
    $i = 0;
    ?>
    
    <!-- gallery_area  -->
    <div class="gallery_area">
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
        </div>
        <div class="container-fluid p-0">
            <div class="row grid no-gutters">
                <?php 
                if( is_array( $galleries ) && count( $galleries ) > 0 ) {
                    foreach( $galleries as $item ) {
                        $i++;
                        $img_url = !empty( $item['item_img']['url'] ) ? $item['item_img']['url'] : '';
                        $img_size = ( !empty( $item['img_size'] ) ) ? $item['img_size'] : '';
                        
                        // Get the img size
                        switch ($img_size) {
                            case 'sunshine_gallery_thumb_482x410':
                                $dynamic_class = 'col-xl-3 ';
                                break;
                            case 'sunshine_gallery_thumb_721x410':
                                $dynamic_class = 'col-xl-5 ';
                                break;
                            
                            default:
                                $dynamic_class = 'col-xl-4 ';
                                break;
                        }

                        // $bg_img = !empty( $item['item_img']['id'] ) ? wp_get_attachment_image( $item['item_img']['id'], $img_size, '', array( 'alt' => 'gallery image '.$i ) ) : '';
                        ?>
                        <div class="<?=esc_attr($dynamic_class)?>col-md-6 col-lg-6 grid-item">
                            <div class="single_gallery gallery_imag_<?=esc_attr($i)?>" <?php echo sunshine_inline_bg_img( esc_url( $img_url ) ); ?>>
                                <a class="popup-image" href="<?=esc_url($img_url)?>">
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>       
        </div>
    </div>
    <!--/ gallery_area  -->
    <?php
    }
}